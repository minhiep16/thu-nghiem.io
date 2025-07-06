<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$cart_count = isset($_SESSION['cart']) && is_array($_SESSION['cart']) ? count($_SESSION['cart']) : 0;

$isLoggedIn = isset($_SESSION['id']);
$userName = $isLoggedIn ? ($_SESSION['name'] ?? 'User') : '';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        :root {
            --primary-text-color: #333;
            --hover-color: #000;
            --border-color: #e5e5e5;
        }
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            color: var(--primary-text-color);
            background-color: #f0f2f5;
        }
        .site-header {
            background-color: #fff;
            border-bottom: 1px solid var(--border-color);
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        .site-header .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header-logo img {
            height: 100px;
            display: block;
        }
        .main-navigation {
            display: flex;
            align-items: center;
        }
        .main-navigation ul {
            margin: 0;
            padding: 0;
            list-style: none;
            display: flex;
            align-items: center;
        }
        .main-navigation li {
            margin: 0 18px;
            position: relative;
        }
        .main-navigation a {
            color: var(--primary-text-color);
            text-decoration: none;
            text-transform: uppercase;
            font-size: 14px;
            font-weight: 600;
            padding: 20px 0;
            display: block;
            position: relative;
            transition: color 0.3s ease;
        }
        .main-navigation a::after {
            content: '';
            position: absolute;
            bottom: 10px;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: #000;
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }
        .main-navigation a:hover::after {
            transform: scaleX(1);
        }
        .main-navigation .menu-item-has-children > a {
            display: flex;
            align-items: center;
        }
        .main-navigation .menu-item-has-children > a .fa-chevron-down {
            font-size: 10px;
            margin-left: 8px;
        }
        .sub-menu {
            position: absolute;
            top: 100%;
            left: -20px;
            background-color: #fff;
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            list-style: none;
            padding: 10px 0;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.3s ease;
        }
        .menu-item-has-children:hover > .sub-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        .sub-menu li {
            margin: 0;
        }
        .sub-menu a {
            padding: 12px 20px;
            font-size: 14px;
            font-weight: 400;
            text-transform: none;
            white-space: nowrap;
        }
        .sub-menu a:hover {
            background-color: #f5f5f5;
        }
        /* --- CSS CHO MENU DỌC --- */
        .sub-menu .menu-item-has-children > a {
            justify-content: space-between;
        }
        .sub-menu .menu-item-has-children .sub-menu {
            position: static;
            display: none;
            border: none;
            box-shadow: none;
            width: 100%;
            padding: 0;
            margin: 0;
            opacity: 1;
            visibility: visible;
            transform: none;
            transition: none;
        }
        .sub-menu > .menu-item-has-children:hover > .sub-menu {
            display: block;
        }
        .sub-menu .sub-menu a {
            padding-left: 35px;
            background-color: #fff;
        }
        .sub-menu .sub-menu a:hover {
             background-color: #f5f5f5;
        }
        .sub-menu > .menu-item-has-children > a {
            font-weight: bold;
            background-color: #f0f0f0;
        }
         .sub-menu .fa-chevron-down {
            font-size: 10px;
            margin-left: 15px;
            transition: transform 0.3s ease;
        }
        .sub-menu > .menu-item-has-children:hover > a > .fa-chevron-down {
            transform: rotate(180deg);
        }

        /* --- FOOTER.CSS --- */
        .site-footer {
            background-color: #1a1a1a;
            color: #ffffff;
            line-height: 1.7;
        }
        .footer-top {
            display: flex;
            gap: 40px;
            border-bottom: 1px solid #333;
        }
        .footer-logo-container {
            flex-basis: 25%;
            display: flex;
            align-items: center;
            justify-content: center;
            border-right: 1px solid #333;
            padding: 20px 40px;
        }
        .footer-logo {
            max-width: 150px;
            height: auto;
        }
        .footer-info-grid {
            flex-basis: 75%;
            display: flex;
            justify-content: space-between;
            gap: 30px;
        }
        .Info_block {
            flex: 1;
            padding: 50px;
        }
        .info-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .info-header .icon {
            font-size: 24px;
            color: #FFC107;
            margin-right: 15px;
            width: 30px;
            text-align: center;
        }
        .info-header h3 {
            margin: 0;
            font-size: 16px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .Info_block p,
        .Info_block address {
            margin: 0;
            font-style: normal;
            font-size: 14px;
            color: #ccc;
        }
        .footer-map iframe {
            width: 100%;
            height: 450px;
            border: 0;
        }
        .footer-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 5%;
            background-color: #111;
            font-size: 13px;
            color: #aaa;
            flex-wrap: wrap;
        }
        .social-icons {
            display: flex;
            gap: 25px;
        }
        .social-icons a {
            color: #aaa;
            font-size: 25px;
            transition: color 0.3s ease;
        }
        .social-icons a:hover {
            color: #FFC107;
        }
        .banquyen {
            text-decoration: none;
            color:rgb(247, 247, 246);
        }
    
        .mobile-menu-toggle { display: none; background: none; border: none; font-size: 24px; cursor: pointer; color: var(--primary-text-color); }
        .main-navigation .login-button a{background-color:#000;color:#fff;padding:10px 20px;border-radius:5px;transition:background-color .3s ease}.main-navigation .login-button a:hover{background-color:#333}.main-navigation .login-button a::after{display:none}.main-navigation .cart-icon a{position:relative;padding:20px 10px;font-size:18px}.main-navigation .cart-icon a::after{display:none}.cart-counter{position:absolute;top:8px;right:-5px;background-color:red;color:#fff;border-radius:50%;width:18px;height:18px;line-height:18px;font-size:11px;font-weight:700;text-align:center}.cart-link{position:relative;display:inline-block}#cart-count-badge{position:absolute;top:-8px;right:-12px;background-color:#e94560;color:#fff;border-radius:50%;padding:2px 6px;font-size:11px;font-weight:700;border:1px solid #fff}

        @media (max-width: 992px) {
            .site-header .container { flex-wrap: wrap; }
            .main-navigation { width: 100%; order: 3; }
            .mobile-menu-toggle { display: block; margin-left: auto; }
            .header-logo { order: 1; }
            .main-navigation ul li.cart-icon,
            .main-navigation ul li.login-button,
            .main-navigation ul li.menu-item-has-children > a[href="dashboard.php"] {
                display: none;
            }
             .main-navigation ul { 
                display: none; 
                flex-direction: column;
                width: 100%; 
                background-color: #fff; 
                box-shadow: 0 4px 10px rgba(0,0,0,0.1); 
                border-top: 1px solid var(--border-color); 
                margin-top: 15px;
            }
            .main-navigation.mobile-menu-active ul { display: flex; }
            .main-navigation li { margin: 0; width: 100%; text-align: left; border-bottom: 1px solid var(--border-color); }
            .main-navigation li:last-child { border-bottom: none; }
            .main-navigation a { padding: 15px 20px; }
            .main-navigation a::after { display: none; }
            .sub-menu { position: static; display: none; border: none; box-shadow: none; width: 100%; background-color: #f8f8f8; padding: 0; }
            .menu-item-has-children:hover > .sub-menu { display: none; }
            .menu-item-has-children.open > .sub-menu { display: block; }
            .sub-menu > .menu-item-has-children > a { font-weight: 600; }
            .sub-menu a { padding-left: 40px !important; }
            .sub-menu .sub-menu a { padding-left: 60px !important; background-color: #f0f0f0; }
            .sub-menu .fa-chevron-down { transition: transform 0.3s ease; }
            .sub-menu .menu-item-has-children.open > a > .fa-chevron-down { transform: rotate(180deg); }

            .footer-top {
                flex-direction: column;
                text-align: center;
            }
            .footer-logo-container {
                border-right: none;
                border-bottom: 1px solid #333;
                padding: 30px;
                flex-basis: auto;
            }
            .footer-info-grid {
                flex-direction: column;
                gap: 0;
            }
            .Info_block {
                padding: 20px 30px;
            }
            .info-header {
                justify-content: center;
            }
        }

        @media (max-width: 768px) {
            .footer-bottom {
                flex-direction: column;
                gap: 15px;
            }
        }
    </style>
</head>
<body>
    <header class="site-header">
        <div class="container">
            <a href="/unitop-php1/Modules/Home.php" class="header-logo">
                <img src="unitop-php1/Assets/img/logo .png" alt="Logo">
            </a>
            <button class="mobile-menu-toggle" aria-label="Toggle Menu" aria-expanded="false">
                <i class="fas fa-bars"></i>
            </button>
            <nav class="main-navigation">
                <ul>
                    <li><a href="/unitop-php1/Modules/Home.php">Trang Chủ</a></li>
                    <li class="menu-item-has-children">
                        <a href="#">Dịch Vụ <i class="fas fa-chevron-down"></i></a>
                        <ul class="sub-menu">
                            <li class="menu-item-has-children">
                                <a href="#">Sửa xe <i class="fas fa-chevron-down"></i></a>
                                <ul class="sub-menu">
                                    <li><a href="/unitop-php1/Modules/Chassis.php">Khung gầm & Phụ kiện </a></li>
                                    <li><a href="/unitop-php1/Modules/suaDongco.php">Động cơ</a></li>
                                    <li><a href="/unitop-php1/Modules/bao-Duong.php">Toàn diện</a></li>
                                    
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#">Rửa xe <i class="fas fa-chevron-down"></i></a>
                                <ul class="sub-menu">
                                    <li><a href="/unitop-php1/Modules/Wash.php">Rửa xe chi tiết</a></li>
                                    <li><a href="/unitop-php1/Modules/PPF.php">Dán PPF</a></li>
                                    <li><a href="/unitop-php1/Modules/Wrap.php">Dán xe</a></li>
                                    
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="/unitop-php1/Modules/vechungtoi.php">Về Chúng Tôi</a></li>
                    <li><a href="/unitop-php1/Modules/dat-lich.php">Liên Hệ</a></li>
                    
                    <li class="cart-icon">
                        <a href="/unitop-php1/Modules/cart.php" class="cart-link" aria-label="Giỏ hàng">
                            <i class="fas fa-shopping-cart"></i>
                            <?php if ($cart_count > 0): ?>
                                <span id="cart-count-badge" class="cart-counter"><?php echo $cart_count; ?></span>
                            <?php else: ?>
                                <span id="cart-count-badge" class="cart-counter" style="display: none;"></span>
                            <?php endif; ?>
                        </a>
                    </li>
                    <?php if ($isLoggedIn): ?>
                        <li class="menu-item-has-children">
                            <a href="dashboard.php">
                                <i class="fas fa-user"></i>&nbsp; <?php echo htmlspecialchars($userName); ?>
                                <i class="fas fa-chevron-down"></i>
                            </a>
                            <ul class="sub-menu">
                                <li><a href="logout.php">Đăng xuất</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="login-button">
                            <a href="/unitop-php1/Modules/login.php">Đăng Nhập</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const menuToggle = document.querySelector('.mobile-menu-toggle');
            const mainNav = document.querySelector('.main-navigation');

            if (menuToggle && mainNav) {
                menuToggle.addEventListener('click', function () {
                    mainNav.classList.toggle('mobile-menu-active');
                });
            }
            
            const menuItemsWithSub = document.querySelectorAll('.main-navigation .menu-item-has-children');
            menuItemsWithSub.forEach(function (item) {
                const link = item.querySelector('a:first-child');
                link.addEventListener('click', function (event) {
                    if (window.innerWidth <= 992) {
                        const subMenu = item.querySelector('.sub-menu');
                        if (subMenu) {
                             event.preventDefault(); 
                             item.classList.toggle('open');
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>