        <?php
    require "../Components/navbar-admin.php";
    ?>

        <main class="container-fluid px-4">
            <div class="row g-4 my-3">
                <div class="col-lg-3 col-md-6">
                    <div class="card p-3 stat-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0 text-muted">New Projects</p>
                                <h2 class="fw-bold"><?php echo $newProjects; ?></h2>
                            </div>
                            <div class="stat-icon"><i class="fas fa-briefcase"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card p-3 stat-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0 text-muted">New Clients</p>
                                <h2 class="fw-bold"><?php echo $newClients; ?></h2>
                            </div>
                            <div class="stat-icon"><i class="fas fa-users"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card p-3 stat-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0 text-muted">Conversion Rate</p>
                                <h2 class="fw-bold"><?php echo $conversionRate; ?>%</h2>
                            </div>
                            <div class="stat-icon"><i class="fas fa-chart-line"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card p-3 stat-card">
                         <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0 text-muted">Support Tickets</p>
                                <h2 class="fw-bold"><?php echo $supportTickets; ?></h2>
                            </div>
                            <div class="stat-icon"><i class="fas fa-question-circle"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 my-4">
                <div class="col-lg-8">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Projects Overview</h5>
                            <canvas id="mainChart"></canvas>
                        </div>
                    </div>
                </div>
                 <div class="col-lg-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                             <h5 class="card-title mb-3">Employee Satisfaction</h5>
                             <canvas id="satisfactionChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row my-4">
                <h3 class="fs-4 mb-3">Recent Invoices</h3>
                <div class="col">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Invoice#</th><th>Customer</th><th>Status</th><th>Due Date</th><th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td>INV-001</td><td>Elizabeth W.</td><td><span class="badge bg-success">Paid</span></td><td>10/05/2025</td><td>$1200.00</td></tr>
                                    <tr><td>INV-002</td><td>Andrew D.</td><td><span class="badge bg-warning text-dark">Pending</span></td><td>20/07/2025</td><td>$152.00</td></tr>
                                    <tr><td>INV-003</td><td>John Smith</td><td><span class="badge bg-danger">Overdue</span></td><td>01/07/2025</td><td>$341.00</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="../Layouts/admin_script.js"></script>
</body>
</html>
