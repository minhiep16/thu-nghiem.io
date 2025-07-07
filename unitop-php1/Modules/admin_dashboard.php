<?php
    require "../Components/navbar-admin.php";

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $adminName = $_SESSION['name'] ?? 'Admin';

    $servername = "localhost"; 
    $username = "root";
    $password = ""; 
    $dbname = "datlich"; 

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $conn->set_charset("utf8mb4");

    // --- DỮ LIỆU CHO THẺ THỐNG KÊ ---
    // Lấy số lượng người đặt lịch
    $sql_appointments = "SELECT COUNT(*) AS total_appointments FROM appointments";
    $result_appointments = $conn->query($sql_appointments);
    $totalAppointments = $result_appointments->fetch_assoc()['total_appointments'] ?? 0;

    // Lấy số lượng bình luận
    $sql_reviews = "SELECT COUNT(*) AS total_reviews FROM reviews";
    $result_reviews = $conn->query($sql_reviews);
    $totalReviews = $result_reviews->fetch_assoc()['total_reviews'] ?? 0;

    // Lấy số lượng đơn hàng mới
    $sql_orders = "SELECT COUNT(*) AS total_new_orders FROM orders WHERE status = 'pending'";
    $result_orders = $conn->query($sql_orders);
    $totalNewOrders = $result_orders->fetch_assoc()['total_new_orders'] ?? 0;

    // --- DỮ LIỆU CHO BIỂU ĐỒ ---
    
    // 1. Dữ liệu Biểu đồ cột: Lịch hẹn trong 7 ngày qua
    // *** Giả định bạn có cột `appointment_date` trong bảng `appointments` ***
    $appointments_chart_data = [];
    $sql_app_chart = "SELECT DATE(appointment_date) as day, COUNT(*) as count 
                      FROM appointments 
                      WHERE appointment_date >= CURDATE() - INTERVAL 6 DAY AND appointment_date < CURDATE() + INTERVAL 1 DAY
                      GROUP BY day 
                      ORDER BY day ASC";
    $result_app_chart = $conn->query($sql_app_chart);
    $app_data = [];
    while ($row = $result_app_chart->fetch_assoc()) {
        $app_data[$row['day']] = $row['count'];
    }

    $app_labels = [];
    $app_counts = [];
    for ($i = 6; $i >= 0; $i--) {
        $date = date('Y-m-d', strtotime("-$i days"));
        $app_labels[] = date('d/m', strtotime($date));
        $app_counts[] = $app_data[$date] ?? 0;
    }
    $appointments_chart_json = json_encode(['labels' => $app_labels, 'data' => $app_counts]);


    // 2. Dữ liệu Biểu đồ tròn: Phân loại bình luận theo rating
    // *** Giả định bạn có cột `rating` (1-5 sao) trong bảng `reviews` ***
    $sql_rev_chart = "SELECT rating, COUNT(*) as count FROM reviews GROUP BY rating";
    $result_rev_chart = $conn->query($sql_rev_chart);
    $rev_labels = [];
    $rev_counts = [];
    while ($row = $result_rev_chart->fetch_assoc()) {
        $rev_labels[] = $row['rating'] . ' Sao';
        $rev_counts[] = $row['count'];
    }
    $reviews_chart_json = json_encode(['labels' => $rev_labels, 'data' => $rev_counts]);


    // Dữ liệu bảng đơn hàng gần đây
    $sql_recent_orders = "SELECT id, customer_name, total_amount, status, order_date FROM orders ORDER BY order_date DESC LIMIT 5";
    $recent_orders = $conn->query($sql_recent_orders);

    $conn->close();
?>

         <main class="container-fluid px-4">
            <h1 class="mt-4">Tổng quan</h1>
            
            <div class="row g-4 my-3">
                <div class="col-lg-4 col-md-6">
                    <div class="card p-3 stat-card shadow-sm">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><p class="mb-0 text-muted">Số lịch hẹn</p><h2 class="fw-bold"><?php echo $totalAppointments; ?></h2></div>
                            <div class="stat-icon"><i class="fas fa-calendar-alt"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card p-3 stat-card shadow-sm">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><p class="mb-0 text-muted">Số bình luận</p><h2 class="fw-bold"><?php echo $totalReviews; ?></h2></div>
                            <div class="stat-icon"><i class="fas fa-comments"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card p-3 stat-card shadow-sm">
                        <div class="d-flex justify-content-between align-items-center">
                           <div><p class="mb-0 text-muted">Số đơn hàng mới</p><h2 class="fw-bold"><?php echo $totalNewOrders; ?></h2></div>
                           <div class="stat-icon"><i class="fas fa-shopping-cart"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 my-4">
                <div class="col-lg-8">
                    <div class="card shadow-sm h-100">
                        <div class="card-header">
                            <h3 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Thống kê lịch hẹn (7 ngày qua)</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="appointmentsChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header">
                           <h3 class="mb-0"><i class="fas fa-chart-pie me-2"></i>Phân loại bình luận</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="reviewsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm mt-4">
                <div class="card-header"><h3 class="mb-0"><i class="fas fa-history me-2"></i>Đơn hàng gần đây</h3></div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover recent-orders-table">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Mã ĐH</th>
                                    <th scope="col">Khách hàng</th>
                                    <th scope="col">Tổng tiền</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Ngày đặt</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($recent_orders && $recent_orders->num_rows > 0): ?>
                                    <?php while($order = $recent_orders->fetch_assoc()): ?>
                                    <tr>
                                        <th scope="row">#<?php echo $order['id']; ?></th>
                                        <td><?php echo htmlspecialchars($order['customer_name']); ?></td>
                                        <td><?php echo number_format($order['total_amount']); ?> VNĐ</td>
                                        <td><span class="badge status-<?php echo $order['status']; ?>"><?php echo ucfirst($order['status']); ?></span></td>
                                        <td><?php echo date('d/m/Y H:i', strtotime($order['order_date'])); ?></td>
                                    </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr><td colspan="5" class="text-center">Chưa có đơn hàng nào.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="../Layouts/admin_script.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Dữ liệu từ PHP
    const appointmentsChartData = <?php echo $appointments_chart_json; ?>;
    const reviewsChartData = <?php echo $reviews_chart_json; ?>;

    // 2. Vẽ Biểu đồ Cột (Lịch hẹn)
    const ctxAppointments = document.getElementById('appointmentsChart');
    if (ctxAppointments) {
        new Chart(ctxAppointments, {
            type: 'bar',
            data: {
                labels: appointmentsChartData.labels,
                datasets: [{
                    label: 'Số lịch hẹn',
                    data: appointmentsChartData.data,
                    backgroundColor: 'rgba(13, 110, 253, 0.7)',
                    borderColor: 'rgba(13, 110, 253, 1)',
                    borderWidth: 1,
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    }

    // 3. Vẽ Biểu đồ Tròn (Bình luận)
    const ctxReviews = document.getElementById('reviewsChart');
    if (ctxReviews) {
        new Chart(ctxReviews, {
            type: 'pie',
            data: {
                labels: reviewsChartData.labels,
                datasets: [{
                    label: 'Số bình luận',
                    data: reviewsChartData.data,
                    backgroundColor: [
                        '#dc3545', // 1 Sao
                        '#fd7e14', // 2 Sao
                        '#ffc107', // 3 Sao
                        '#198754', // 4 Sao
                        '#0d6efd'  // 5 Sao
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });
    }
});
</script>

</body>
</html>