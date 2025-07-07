<?php

session_start();

$appData = [
    'isLoggedIn' => isset($_SESSION['id']),
    'userName'   => isset($_SESSION['id']) ? ($_SESSION['name'] ?? 'Người dùng') : '',
    'userEmail'  => isset($_SESSION['id']) ? ($_SESSION['email'] ?? '') : ''
];

require "../Components/navbar.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet"/>
    <link rel="stylesheet" href="../Assets/styles/vechungtoi.css">
    <title>Về Chúng Tôi</title>
</head>
<body>

    <?php
    $servername = "localhost";
    $username   = "root";
    $password   = "";
    $dbname     = "datlich";

    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->set_charset("utf8mb4");

    $reviews = [];
    if ($conn->connect_error) {
    } else {
        $sql = "SELECT name, rating, comment, submission_date FROM reviews ORDER BY submission_date DESC";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $reviews[] = $row; 
            }
        }
        $conn->close();
    }
    ?>

    <main>
        <section class="hero-section">
            <div class="container">
                <h1>CHÚNG TÔI LÀM ĐƯỢC GÌ</h1>
                <div class="hero-content">
                    <div class="hero-text" >
                        
                        <p>
                            Tại <strong>Car Care</strong>, chúng tôi không chỉ coi xe hơi là một phương tiện, mà đó còn là một tài sản và niềm đam mê. Được thành lập bởi đội ngũ chuyên gia giàu kinh nghiệm, chúng tôi ra đời với sứ mệnh mang đến những giải pháp chăm sóc và sửa chữa xe toàn diện, chuyên nghiệp và đáng tin cậy nhất cho khách hàng.
                        </p>
                        <ul>
                            <li>Kỹ thuật viên chuyên môn cao, được đào tạo bài bản.</li>
                            <li>Hệ thống trang thiết bị hiện đại, đảm bảo độ chính xác tuyệt đối.</li>
                            <li>Quy trình làm việc nhanh gọn, chuyên nghiệp, đúng tiêu chuẩn quốc tế.</li>
                            <li>Không gian xưởng dịch vụ sạch sẽ, ngăn nắp, tạo sự thoải mái cho khách hàng.</li>
                            <li>Chi phí dịch vụ cạnh tranh, hoàn toàn tương xứng với chất lượng.</li>
                        </ul>
                    </div>

                    <div class="hero-image" >
                        <img src="../Assets/img/Rolls-Royce-Cullinan-Black-Badge16-1.jpg" alt="Xưởng dịch vụ chuyên nghiệp">
                    </div>
                </div>
            </div>
        </section>
        <div class="number-list">
            <div class="number-block">
                <div class="icons">
                <i class="ri-user-community-line"></i> 
                </div>
                <div class="spinner" id="customerSpinner"></div> 
                <div class="number hidden" id="customerCount">12</div> 
                <div class="description">Khách hàng</div>
            </div>
            <div class="number-block">
                <div class="icons">
                <i class="ri-car-line"></i> 
                </div>
                <div class="spinner" id="brandSpinner"></div> 
                <div class="number hidden" id="brandCount">20</div> 
                <div class="description">Thương Hiệu Xe</div>
            </div>
            <div class="number-block">
                <div class="icons">
                    <i class="ri-verified-badge-line"></i>
                </div>
                <div class="spinner" id="serviceSpinner"></div> 
                <div class="number hidden" id="serviceCount">31</div> 
                <div class="description">Lượt Dịch Vụ</div>
            </div>
        </div>

         <div class= "slideshow" id="slideshow">
                <div class="mySlides fade">
                    <img src="../Assets/img/McLaren-720S-Spider-Art-Car-Wrapping-2.jpg" style="width:100%">
                </div>

                <div class="mySlides fade">
                    <img src="../Assets/img/McLaren-720S-Spider-Art-Car-Wrapping-3.jpg" style="width:100%">
                </div>

                <div class="mySlides fade">
                    <img src="../Assets/img/McLaren-720S-Spider-Art-Car-Wrapping-6.jpg" style="width:100%">
                </div>

                <div class="mySlides fade">
                    <img src="../Assets/img/McLaren-720S-Spider-Art-Car-Wrapping-8.jpg" style="width:100%">
                </div>

                <div style="text-align:center" class="dot-container">
                    <span class="dot"></span> 
                    <span class="dot"></span> 
                    <span class="dot"></span> 
                    <span class="dot"></span>
                </div>
            </div>

       <div class="member-section">
            <div class="container">
                <h1>GẶP GỠ ĐỘI NGŨ CỦA CHÚNG TÔI</h1>
                <p class="section-subtitle">Những con người đầy nhiệt huyết đứng sau thành công của chúng tôi.</p>
                <div class="member-grid">
                    
                    <div class="member-card">
                        <div class="member-card-image-wrapper">
                            <img src="../Assets/img/trung.jpg" alt="Lê Xuân Trung">
                            <div class="member-social-links">
                                <a href="https://www.facebook.com/le.xuan.trung.116164?locale=vi_VN" aria-label="Facebook"><i class="ri-facebook-fill"></i></a>
                                <a href="./vechungtoi.php" aria-label="Instagram"><i class="ri-instagram-line"></i></a>
                                <a href="mailto:trunglx5217@ut.edu.vn" aria-label="Email"><i class="ri-mail-line"></i></a>
                            </div>
                        </div>
                        <div class="member-card-info">
                            <h3 class="member-name">Lê Xuân Trung</h3>
                        </div>
                    </div>

                    <div class="member-card">
                        <div class="member-card-image-wrapper">
                            <img src="../Assets/img/nghia.png" alt="Lê Đại Nghĩa">
                            <div class="member-social-links">
                                <a href="https://www.facebook.com/ainghiale.483464?locale=vi_VN" aria-label="Facebook"><i class="ri-facebook-fill"></i></a>
                                <a href="./vechungtoi.php" aria-label="Instagram"><i class="ri-instagram-line"></i></a>
                                <a href="mailto:nghiald9074@ut.edu.vn" aria-label="Email"><i class="ri-mail-line"></i></a>
                            </div>
                        </div>
                        <div class="member-card-info">
                            <h3 class="member-name">Lê Đại Nghĩa</h3>
                            
                        </div>
                    </div>
                    
                    <div class="member-card">
                        <div class="member-card-image-wrapper">
                            <img src="../Assets/img/dat.jpg" alt="Đặng Phát Đạt">
                             <div class="member-social-links">
                                <a href="https://www.facebook.com/dongianlameem?locale=vi_VN" aria-label="Facebook"><i class="ri-facebook-fill"></i></a>
                                <a href="./vechungtoi.php" aria-label="Instagram"><i class="ri-instagram-line"></i></a>
                                <a href="mailto:datdp7465@ut.edu.vn" aria-label="Email"><i class="ri-mail-line"></i></a>
                            </div>
                        </div>
                        <div class="member-card-info">
                            <h3 class="member-name">Đặng Phát Đạt</h3>
                            
                        </div>
                    </div>
                    
                    <div class="member-card">
                        <div class="member-card-image-wrapper">
                            <img src="../Assets/img/hiep.jpg" alt="Nông Hoàng Minh Hiệp">
                            <div class="member-social-links">
                                <a href="https://www.facebook.com/minh.hiep.127064/?locale=vi_VN" aria-label="Facebook"><i class="ri-facebook-fill"></i></a>
                                <a href="./vechungtoi.php" aria-label="Instagram"><i class="ri-instagram-line"></i></a>
                                <a href="mailto:hiepnhm4842@ut.edu.vn" aria-label="Email"><i class="ri-mail-line"></i></a>
                            </div>
                        </div>
                        <div class="member-card-info">
                            <h3 class="member-name">Nông Hoàng Minh Hiệp</h3>
                        
                        </div>
                    </div>

                    <div class="member-card">
                        <div class="member-card-image-wrapper">
                            <img src="../Assets/img/hao.jpg" alt="Trịnh Nguyễn Phi Hào">
                            <div class="member-social-links">
                                <a href="https://www.facebook.com/phihaokc2005?locale=vi_VN" aria-label="Facebook"><i class="ri-facebook-fill"></i></a>
                                <a href="./vechungtoi.php" aria-label="Instagram"><i class="ri-instagram-line"></i></a>
                                <a href="mailto:haotnp3612@ut.edu.vn" aria-label="Email"><i class="ri-mail-line"></i></a>
                            </div>
                        </div>
                        <div class="member-card-info">
                            <h3 class="member-name">Trịnh Nguyễn Phi Hào</h3>
                            
                        </div>
                    </div>

                </div>
            </div>
        </div>

    <section class="review-submission-section">
        <div class="container">
            <div class="submission-card">
                <div class="submission-info">
                    <i class="ri-feedback-line"></i>
                    <h3>Chia sẻ trải nghiệm của bạn</h3>
                    <p>Mỗi đánh giá của bạn là nguồn động lực quý giá, giúp chúng tôi không ngừng cải thiện và mang đến dịch vụ tốt nhất. Vui lòng chia sẻ cảm nhận của bạn!</p>
                </div>

                <div class="submission-form">
                    <form id="review-form" novalidate>
                        <h4>Đánh giá của bạn</h4>
                        
                        <div class="form-group">
                            <label>Chất lượng dịch vụ*</label>
                            <div class="star-rating-input" id="rating-stars">
                                <i class="ri-star-line" data-value="1" title="Tệ"></i>
                                <i class="ri-star-line" data-value="2" title="Không tốt"></i>
                                <i class="ri-star-line" data-value="3" title="Bình thường"></i>
                                <i class="ri-star-line" data-value="4" title="Tốt"></i>
                                <i class="ri-star-line" data-value="5" title="Tuyệt vời"></i>
                            </div>
                            <input type="hidden" name="rating" id="rating" value="" required>
                        </div>

                        <div class="form-group">
                            <label for="name">Tên của bạn*</label>
                            <input type="text" id="name" name="name" placeholder="Ví dụ: Nguyễn Văn A" required>
                        </div>

                        <div class="form-group">
                            <label for="comment">Bình luận của bạn</label>
                            <textarea id="comment" name="comment" rows="4" placeholder="Hãy cho chúng tôi biết cảm nhận chi tiết của bạn..."></textarea>
                        </div>
            
                        <button type="submit" class="submit-btn">GỬI ĐÁNH GIÁ</button>
                        <p id="form-status"></p>
                    </form>
                </div>
            </div>
        </div>
    </section>

        <section class="reviews-display-section">
            <div class="container">
                <h1>ĐÁNH GIÁ TỪ KHÁCH HÀNG</h1>
                <div class="review-filter-nav">
                    <button class="filter-btn active" data-filter="all">Tất cả</button>
                    <button class="filter-btn" data-filter="5"> <i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i></i></button>
                    <button class="filter-btn" data-filter="4"> <i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i></i></button>
                    <button class="filter-btn" data-filter="3"> <i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i></i></button>
                    <button class="filter-btn" data-filter="2"> <i class="ri-star-fill"></i><i class="ri-star-fill"></i></i></button>
                    <button class="filter-btn" data-filter="1"> <i class="ri-star-fill"></i></button>
                </div>
                <div class="reviews-list">
                    <?php if (!empty($reviews)): ?>
                        <?php foreach ($reviews as $review): ?>
                            <div class="review-card" data-rating="<?php echo htmlspecialchars($review['rating']); ?>">
                                <div class="review-header">
                                    <h3 class="review-author"><?php echo htmlspecialchars($review['name']); ?></h3>
                                    <div class="review-rating">
                                        <?php 
                                            // Lặp để hiển thị các ngôi sao dựa trên điểm đánh giá
                                            for ($i = 1; $i <= 5; $i++): 
                                                if ($i <= $review['rating']):
                                        ?>
                                            <i class="ri-star-fill"></i> <?php else: ?>
                                            <i class="ri-star-line"></i> <?php 
                                                endif; 
                                            endfor; 
                                        ?>
                                    </div>
                                    <p class="review-comment">
                                    <?php 
                                        echo nl2br(htmlspecialchars($review['comment'])); 
                                    ?>
                                </p>
                                </div>

                                <div class="review-footer">
                                    <span class="review-date">
                                        Ngày: <?php echo date_format(date_create($review['submission_date']), 'd/m/Y'); ?>
                                    </span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="no-reviews">Chưa có đánh giá nào. Hãy là người đầu tiên đánh giá!</p>
                    <?php endif; ?>
                </div>
            </div>
         </section>
    </main>
    <script src="../Layouts/vechungtoi.js"></script>
</body>
</html>

<?php
require "../Components/footer.php";
?>