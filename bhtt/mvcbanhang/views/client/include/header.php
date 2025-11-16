<?php session_start(); ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang chủ - Bán điện thoại</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #ec4899;
            --hover-color: #be185d;
            --text-color: #3a223b;
            --border-color: #f9a8d4;
            --background-light: #fff1f7;
            --background-white: #fff0f6;
            --shadow: 0 2px 12px 0 rgba(236,72,153,0.07);
        }
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }
        body {
            background: var(--background-light);
        }
        a {
            text-decoration: none;
            color: var(--text-color);
            transition: color 0.2s;
        }
        #header {
            width: 100%;
            background: var(--background-white);
            box-shadow: var(--shadow);
            border-radius: 0 0 18px 18px;
            overflow: hidden;
        }
        #nav_1 {
            height: 38px;
            line-height: 38px;
            font-size: 15px;
            background: linear-gradient(90deg, #f9a8d4 0%, #fff1f7 100%);
            padding: 0 18px;
            border-bottom: 1px solid var(--border-color);
        }
        .nav_ul {
            display: flex;
            justify-content: flex-end;
            gap: 18px;
        }
        .nav_li {
            padding: 0 10px;
            position: relative;
        }
        .border_r {
            border-right: 1px solid var(--border-color);
            padding-right: 12px;
        }
        .nav_li a {
            color: var(--primary-color);
            font-weight: 500;
            transition: color 0.2s;
        }
        .nav_li a:hover {
            color: var(--hover-color);
        }
        #search {
            display: flex;
            align-items: center;
            height: 90px;
            padding: 0 32px;
            background: var(--background-white);
            gap: 32px;
            border-bottom: 1px solid var(--border-color);
        }
        .logo {
            flex: 1;
            display: flex;
            align-items: center;
        }
        .logo img {
            height: 64px;
            object-fit: contain;
            filter: drop-shadow(0 2px 8px rgba(37,99,235,0.08));
        }
        .form_search {
            flex: 5;
            display: flex;
            gap: 12px;
            background: #fce7f3;
            border-radius: 10px;
            box-shadow: 0 1px 6px 0 rgba(236,72,153,0.06);
            padding: 6px 10px;
        }
        .txt_search {
            flex: 4;
            padding: 12px 14px;
            border: 1px solid var(--primary-color);
            border-radius: 8px;
            font-size: 16px;
            outline: none;
            transition: border 0.2s;
        }
        .txt_search:focus {
            border: 1.5px solid var(--hover-color);
        }
        .btn_search {
            flex: 1;
            padding: 12px 0;
            border: none;
            background: linear-gradient(90deg, var(--primary-color), #f472b6);
            color: white;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            box-shadow: 0 2px 8px 0 rgba(236,72,153,0.10);
            transition: background 0.2s, box-shadow 0.2s;
        }
        .btn_search:hover {
            background: linear-gradient(90deg, var(--hover-color), #ec4899);
            box-shadow: 0 4px 16px 0 rgba(236,72,153,0.13);
        }
        #menu {
            background: linear-gradient(90deg, var(--primary-color) 60%, #f472b6 100%);
            height: 58px;
            box-shadow: 0 2px 8px 0 rgba(236,72,153,0.07);
        }
        .menu_ul {
            display: flex;
            justify-content: space-around;
            align-items: center;
            height: 100%;
        }
        .menu_li {
            flex: 1;
        }
        .menu_li a {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            font-size: 18px;
            font-weight: bold;
            color: #fff;
            border-radius: 8px;
            margin: 0 4px;
            transition: background 0.2s, color 0.2s, box-shadow 0.2s;
        }
        .menu_li a:hover {
            background: #fff;
            color: var(--primary-color);
            box-shadow: 0 2px 8px 0 rgba(236,72,153,0.10);
        }
        /* Banner slideshow */
        #banner {
            width: 98%;
            height: 340px;
            margin: 18px auto 0 auto;
            overflow: hidden;
            position: relative;
            border-radius: 18px;
            box-shadow: 0 4px 24px 0 rgba(236,72,153,0.10);
            background: #fce7f3;
        }
        .slider {
            width: 100%;
            height: 100%;
            position: relative;
        }
        .slide {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            opacity: 0;
            transition: opacity 1.2s cubic-bezier(0.4,0,0.2,1);
            border-radius: 18px;
        }
        .slide.active {
            opacity: 1;
            z-index: 1;
        }
        /* Responsive */
        @media (max-width: 900px) {
            #search { flex-direction: column; height: auto; gap: 12px; padding: 12px; }
            .form_search { width: 100%; }
            .logo { justify-content: center; }
            #banner { height: 180px; }
            .menu_li a { font-size: 15px; }
        }
        @media (max-width: 600px) {
            #header { border-radius: 0; }
            #banner { height: 120px; }
            .logo img { height: 40px; }
            .form_search { padding: 4px 4px; }
            .txt_search, .btn_search { font-size: 13px; padding: 8px 6px; }
        }
    </style>
</head>
<body>
    <div id="header">
        <div id="nav_1">
            <ul class="nav_ul">
                <li class="nav_li">
                    <a href="#"><i class="far fa-bell"></i> Khuyến mãi</a>
                </li>
                <!-- Icon giỏ hàng ở giữa -->
                <li class="nav_li">
                    <a href="./client.php?controller=client&action=cart" title="Giỏ hàng"><i class="fa fa-shopping-cart"></i></a>
                </li>
                <li class="nav_li">
                    <a href="#"><i class="far fa-question-circle"></i> Hỗ trợ</a>
                </li>
                <?php if (isset($_SESSION['client']) && $_SESSION['client']): ?>
                    <li class="nav_li"><a href="./client.php?controller=client&action=logout" class="border_r">Đăng xuất</a></li>
                    <li class="nav_li"><?= $_SESSION['client']['username'] ?></li>
                <?php else: ?>
                    <li class="nav_li"><a href="#" class="border_r">Đăng ký</a></li>
                    <li class="nav_li"><a href="./auth.php">Đăng nhập</a></li>
                <?php endif ?>
            </ul>
        </div>

        <div id="search">
            <div class="logo">
                <a href="./client.php">
                    <img src="./images/logo.png" alt="Logo cửa hàng điện thoại" />
                </a>
            </div>
            <form action="./client.php" method="GET" class="form_search">
                <input type="hidden" name="controller" value="client">
                <input type="hidden" name="action" value="search">
                <input type="text" class="txt_search" placeholder="Tìm kiếm điện thoại..." name="search" value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>" />
                <button class="btn_search" type="submit">Tìm kiếm</button>
            </form>
        </div>

        <div id="menu">
            <ul class="menu_ul">
                <li class="menu_li"><a href="./client.php">Trang chủ</a></li>
                <?php if (isset($category)): ?>
                    <?php foreach ($category as $cat): ?>
                        <li class="menu_li">
                            <a href="./client.php?controller=client&action=findCategory&category_id=<?= $cat['id'] ?>">
                                <?= $cat['name'] ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
                <li class="menu_li"><a href="./tintuc.php">Tin tức công nghệ</a></li>
                <li class="menu_li"><a href="./contact.php">Liên hệ</a></li>
            </ul>
        </div>

        <!-- Banner Slideshow -->
        <div id="banner">
            <div class="slider">
                <img src="./images/banner1.png" class="slide active" alt="Banner 1" />
                <img src="./images/banner4.png" class="slide" alt="Banner 2" />
                <img src="./images/banner5.png" class="slide" alt="Banner 3" />
            </div>
        </div>
    </div>

    <!-- Script chuyển slide -->
    <script>
        let slideIndex = 0;
        const slides = document.querySelectorAll('.slide');

        function showNextSlide() {
            slides[slideIndex].classList.remove('active');
            slideIndex = (slideIndex + 1) % slides.length;
            slides[slideIndex].classList.add('active');
        }

        setInterval(showNextSlide, 4000);
    </script>
</body>
</html>
