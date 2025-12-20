<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role_name'] !== 'admin') {
    header("Location: sign-in.php");
    exit();
}
?>
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 fixed-start" id="sidenav-main"
    style="height: 100vh !important; top: 0; bottom: 0; margin: 0; border-radius: 0;">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="#" target="_blank">
            <img src="../assets/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">Soft UI Dashboard 3</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main" style="height: calc(100vh - 200px);">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link  " href="../pages/dashboard.php">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>shop </title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                    <g transform="translate(1716.000000, 291.000000)">
                                        <g transform="translate(0.000000, 148.000000)">
                                            <path class="color-background opacity-6"
                                                d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z">
                                            </path>
                                            <path class="color-background"
                                                d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z">
                                            </path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link " href="../pages/product.php">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="12px" height="12px" viewBox="0 0 42 42" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>product</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-1869.000000, -293.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                    <g transform="translate(1716.000000, 291.000000)">
                                        <g id="product" transform="translate(153.000000, 2.000000)">
                                            <path class="color-background opacity-6"
                                                d="M21,0 L2.3,10.5 L21,21 L39.7,10.5 L21,0 Z"></path>
                                            <path class="color-background"
                                                d="M1.75,13.5 L1.75,36.75 C1.75,37.71775 2.53225,38.5 3.5,38.5 L19.25,38.5 L19.25,21 L1.75,13.5 Z M22.75,38.5 L38.5,38.5 C39.46775,38.5 40.25,37.71775 40.25,36.75 L40.25,13.5 L22.75,21 L22.75,38.5 Z M21,24.5 L24.5,22.75 L24.5,15.75 L17.5,15.75 L17.5,22.75 L21,24.5 Z">
                                            </path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Product</span>
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link " href="../pages/category.php">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="12px" height="12px" viewBox="0 0 42 42" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>category</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-1869.000000, -293.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                    <g transform="translate(1716.000000, 291.000000)">
                                        <g id="category" transform="translate(153.000000, 2.000000)">
                                            <path class="color-background opacity-6"
                                                d="M3.5,15.75 L15.75,15.75 L15.75,3.5 L3.5,3.5 L3.5,15.75 Z M26.25,15.75 L38.5,15.75 L38.5,3.5 L26.25,3.5 L26.25,15.75 Z">
                                            </path>
                                            <path class="color-background"
                                                d="M3.5,38.5 L15.75,38.5 L15.75,26.25 L3.5,26.25 L3.5,38.5 Z M26.25,38.5 L38.5,38.5 L38.5,26.25 L26.25,26.25 L26.25,38.5 Z">
                                            </path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Categories</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="../pages/banner-intro.php">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="12px" height="12px" viewBox="0 0 42 42" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>banner-intro</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-1869.000000, -293.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                    <g transform="translate(1716.000000, 291.000000)">
                                        <g id="banner-intro" transform="translate(153.000000, 2.000000)">
                                            <path class="color-background opacity-6"
                                                d="M10.5,15.75 C13.4005,15.75 15.75,13.4005 15.75,10.5 C15.75,7.5995 13.4005,5.25 10.5,5.25 C7.5995,5.25 5.25,7.5995 5.25,10.5 C5.25,13.4005 7.5995,15.75 10.5,15.75 Z">
                                            </path>
                                            <path class="color-background"
                                                d="M40.25,5.25 L1.75,5.25 C0.78225,5.25 0,6.03225 0,7 L0,35 C0,35.96775 0.78225,36.75 1.75,36.75 L40.25,36.75 C41.21775,36.75 42,35.96775 42,35 L42,7 C42,6.03225 41.21775,5.25 40.25,5.25 Z M38.5,33.25 L3.5,33.25 L3.5,8.75 L38.5,8.75 L38.5,33.25 Z M26.25,14 L12.25,29.75 L5.25,22.75 L5.25,33.25 L36.75,33.25 L36.75,24.5 L26.25,14 Z">
                                            </path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Banner Intro</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="../pages/banner-content.php">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="12px" height="12px" viewBox="0 0 42 42" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>banner-content</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-1869.000000, -293.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                    <g transform="translate(1716.000000, 291.000000)">
                                        <g id="banner-content" transform="translate(153.000000, 2.000000)">
                                            <path class="color-background opacity-6"
                                                d="M12.25,17.5 L8.75,17.5 L8.75,1.75 C8.75,0.78225 9.53225,0 10.5,0 L31.5,0 C32.46775,0 33.25,0.78225 33.25,1.75 L33.25,12.25 L29.75,12.25 L29.75,3.5 L12.25,3.5 L12.25,17.5 Z">
                                            </path>
                                            <path class="color-background"
                                                d="M40.25,14 L24.5,14 C23.53225,14 22.75,14.78225 22.75,15.75 L22.75,38.5 L19.25,38.5 L19.25,22.75 C19.25,21.78225 18.46775,21 17.5,21 L1.75,21 C0.78225,21 0,21.78225 0,22.75 L0,40.25 C0,41.21775 0.78225,42 1.75,42 L40.25,42 C41.21775,42 42,41.21775 42,40.25 L42,15.75 C42,14.78225 41.21775,14 40.25,14 Z M12.25,36.75 L7,36.75 L7,33.25 L12.25,33.25 L12.25,36.75 Z M35,36.75 L22.75,36.75 L22.75,33.25 L35,33.25 L35,36.75 Z M35,29.75 L7,29.75 L7,26.25 L35,26.25 L35,29.75 Z M35,22.75 L26.25,22.75 L26.25,19.25 L35,19.25 L35,22.75 Z">
                                            </path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Banner content</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../pages/video.php">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="12px" height="12px" viewBox="0 0 42 42" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>video</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-1869.000000, -293.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                    <g transform="translate(1716.000000, 291.000000)">
                                        <g id="video" transform="translate(153.000000, 2.000000)">
                                            <path class="color-background opacity-6"
                                                d="M38.5,5.25 L3.5,5.25 C1.566,5.25 0,6.816 0,8.75 L0,33.25 C0,35.184 1.566,36.75 3.5,36.75 L38.5,36.75 C40.434,36.75 42,35.184 42,33.25 L42,8.75 C42,6.816 40.434,5.25 38.5,5.25 Z M38.5,33.25 L3.5,33.25 L3.5,8.75 L38.5,8.75 L38.5,33.25 Z">
                                            </path>
                                            <path class="color-background" d="M17.5,14 L17.5,28 L28,21 L17.5,14 Z">
                                            </path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Video</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="../pages/category-post.php">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="12px" height="12px" viewBox="0 0 42 42" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>blog-category</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-1869.000000, -293.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                    <g transform="translate(1716.000000, 291.000000)">
                                        <g id="blog-category" transform="translate(153.000000, 2.000000)">
                                            <path class="color-background opacity-6"
                                                d="M10,0 C4.477,0 0,4.477 0,10 L0,20 L20,40 L40,20 L40,10 C40,4.477 35.523,0 30,0 L10,0 Z M10,15 C7.239,15 5,12.761 5,10 C5,7.239 7.239,5 10,5 C12.761,5 15,7.239 15,10 C15,12.761 12.761,15 10,15 Z">
                                            </path>
                                            <path class="color-background"
                                                d="M40.25,14 L24.5,14 C23.532,14 22.75,14.782 22.75,15.75 L22.75,38.5 L40.25,38.5 C41.218,38.5 42,37.718 42,36.75 L42,15.75 C42,14.782 41.218,14 40.25,14 Z M35,33.25 L29.75,33.25 L29.75,29.75 L35,29.75 L35,33.25 Z M35,26.25 L29.75,26.25 L29.75,22.75 L35,22.75 L35,26.25 Z">
                                            </path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Blog-Category</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="../pages/post.php">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="12px" height="12px" viewBox="0 0 42 42" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>post</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-1869.000000, -293.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                    <g transform="translate(1716.000000, 291.000000)">
                                        <g id="post" transform="translate(153.000000, 2.000000)">
                                            <path class="color-background opacity-6"
                                                d="M12.25,17.5 L8.75,17.5 L8.75,1.75 C8.75,0.78225 9.53225,0 10.5,0 L31.5,0 C32.46775,0 33.25,0.78225 33.25,1.75 L33.25,12.25 L29.75,12.25 L29.75,3.5 L12.25,3.5 L12.25,17.5 Z">
                                            </path>
                                            <path class="color-background"
                                                d="M40.25,14 L24.5,14 C23.53225,14 22.75,14.78225 22.75,15.75 L22.75,38.5 L19.25,38.5 L19.25,22.75 C19.25,21.78225 18.46775,21 17.5,21 L1.75,21 C0.78225,21 0,21.78225 0,22.75 L0,40.25 C0,41.21775 0.78225,42 1.75,42 L40.25,42 C41.21775,42 42,41.21775 42,40.25 L42,15.75 C42,14.78225 41.21775,14 40.25,14 Z M12.25,36.75 L7,36.75 L7,33.25 L12.25,33.25 L12.25,36.75 Z M35,36.75 L29.75,36.75 L29.75,33.25 L35,33.25 L35,36.75 Z M35,29.75 L7,29.75 L7,26.25 L35,26.25 L35,29.75 Z M35,22.75 L29.75,22.75 L29.75,19.25 L35,19.25 L35,22.75 Z">
                                            </path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Blog</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link " href="../pages/banner.php">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="12px" height="12px" viewBox="0 0 42 42" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>banner</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-1869.000000, -293.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                    <g transform="translate(1716.000000, 291.000000)">
                                        <g id="banner" transform="translate(153.000000, 2.000000)">
                                            <path class="color-background opacity-6"
                                                d="M10,12 C11.657,12 13,10.657 13,9 C13,7.343 11.657,6 10,6 C8.343,6 7,7.343 7,9 C7,10.657 8.343,12 10,12 Z M35,28 L7,28 L15,16 L21,24 L26,19 L35,28 Z">
                                            </path>
                                            <path class="color-background"
                                                d="M38.5,0 L3.5,0 C1.566,0 0,1.566 0,3.5 L0,31.5 C0,33.434 1.566,35 3.5,35 L38.5,35 C40.434,35 42,33.434 42,31.5 L42,3.5 C42,1.566 40.434,0 38.5,0 Z M38.5,31.5 L3.5,31.5 L3.5,3.5 L38.5,3.5 L38.5,31.5 Z">
                                            </path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Banner</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="../pages/flash-sale.php">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="12px" height="12px" viewBox="0 0 42 42" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>flash-sale</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-1869.000000, -293.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                    <g transform="translate(1716.000000, 291.000000)">
                                        <g id="flash-sale" transform="translate(153.000000, 2.000000)">
                                            <path class="color-background opacity-6"
                                                d="M22.75,0 L5.25,22.75 L17.5,22.75 L14,35 L22.75,22.75 L22.75,0 Z">
                                            </path>
                                            <path class="color-background"
                                                d="M36.75,19.25 L24.5,19.25 L28,7 L19.25,19.25 L19.25,42 L36.75,19.25 Z">
                                            </path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Flash-Sale</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="../pages/article-title.php">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="12px" height="12px" viewBox="0 0 42 42" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>article-title</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-1869.000000, -293.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                    <g transform="translate(1716.000000, 291.000000)">
                                        <g id="article-title" transform="translate(153.000000, 2.000000)">
                                            <path class="color-background opacity-6"
                                                d="M3.5,0 L38.5,0 C40.434,0 42,1.566 42,3.5 L42,14 L0,14 L0,3.5 C0,1.566 1.566,0 3.5,0 Z M10.5,10.5 L31.5,10.5 L31.5,7 L10.5,7 L10.5,10.5 Z">
                                            </path>
                                            <path class="color-background"
                                                d="M0,17.5 L42,17.5 L42,38.5 C42,40.434 40.434,42 38.5,42 L3.5,42 C1.566,42 0,40.434 0,38.5 L0,17.5 Z M7,24.5 L35,24.5 L35,21 L7,21 L7,24.5 Z M7,31.5 L35,31.5 L35,28 L7,28 L7,31.5 Z M7,38.5 L24.5,38.5 L24.5,35 L7,35 L7,38.5 Z">
                                            </path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Article Title</span>
                </a>
            </li>
            
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="../pages/profile.php">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="12px" height="12px" viewBox="0 0 46 42" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>customer-support</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-1717.000000, -291.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                    <g transform="translate(1716.000000, 291.000000)">
                                        <g transform="translate(1.000000, 0.000000)">
                                            <path class="color-background opacity-6"
                                                d="M45,0 L26,0 C25.447,0 25,0.447 25,1 L25,20 C25,20.379 25.214,20.725 25.553,20.895 C25.694,20.965 25.848,21 26,21 C26.212,21 26.424,20.933 26.6,20.8 L34.333,15 L45,15 C45.553,15 46,14.553 46,14 L46,1 C46,0.447 45.553,0 45,0 Z">
                                            </path>
                                            <path class="color-background"
                                                d="M22.883,32.86 C20.761,32.012 17.324,31 13,31 C8.676,31 5.239,32.012 3.116,32.86 C1.224,33.619 0,35.438 0,37.494 L0,41 C0,41.553 0.447,42 1,42 L25,42 C25.553,42 26,41.553 26,41 L26,37.494 C26,35.438 24.776,33.619 22.883,32.86 Z">
                                            </path>
                                            <path class="color-background"
                                                d="M13,28 C17.432,28 21,22.529 21,18 C21,13.589 17.411,10 13,10 C8.589,10 5,13.589 5,18 C5,22.529 8.568,28 13,28 Z">
                                            </path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link  " href="../pages/sign-up.php">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="12px" height="20px" viewBox="0 0 40 40" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>spaceship</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-1720.000000, -592.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                    <g transform="translate(1716.000000, 291.000000)">
                                        <g transform="translate(4.000000, 301.000000)">
                                            <path class="color-background"
                                                d="M39.3,0.706666667 C38.9660984,0.370464027 38.5048767,0.192278529 38.0316667,0.216666667 C14.6516667,1.43666667 6.015,22.2633333 5.93166667,22.4733333 C5.68236407,23.0926189 5.82664679,23.8009159 6.29833333,24.2733333 L15.7266667,33.7016667 C16.2013871,34.1756798 16.9140329,34.3188658 17.535,34.065 C17.7433333,33.98 38.4583333,25.2466667 39.7816667,1.97666667 C39.8087196,1.50414529 39.6335979,1.04240574 39.3,0.706666667 Z M25.69,19.0233333 C24.7367525,19.9768687 23.3029475,20.2622391 22.0572426,19.7463614 C20.8115377,19.2304837 19.9992882,18.0149658 19.9992882,16.6666667 C19.9992882,15.3183676 20.8115377,14.1028496 22.0572426,13.5869719 C23.3029475,13.0710943 24.7367525,13.3564646 25.69,14.31 C26.9912731,15.6116662 26.9912731,17.7216672 25.69,19.0233333 L25.69,19.0233333 Z">
                                            </path>
                                            <path class="color-background opacity-6"
                                                d="M1.855,31.4066667 C3.05106558,30.2024182 4.79973884,29.7296005 6.43969145,30.1670277 C8.07964407,30.6044549 9.36054508,31.8853559 9.7979723,33.5253085 C10.2353995,35.1652612 9.76258177,36.9139344 8.55833333,38.11 C6.70666667,39.9616667 0,40 0,40 C0,40 0,33.2566667 1.855,31.4066667 Z">
                                            </path>
                                            <path class="color-background opacity-6"
                                                d="M17.2616667,3.90166667 C12.4943643,3.07192755 7.62174065,4.61673894 4.20333333,8.04166667 C3.31200265,8.94126033 2.53706177,9.94913142 1.89666667,11.0416667 C1.5109569,11.6966059 1.61721591,12.5295394 2.155,13.0666667 L5.47,16.3833333 C8.55036617,11.4946947 12.5559074,7.25476565 17.2616667,3.90166667 L17.2616667,3.90166667 Z">
                                            </path>
                                            <path class="color-background opacity-6"
                                                d="M36.0983333,22.7383333 C36.9280725,27.5056357 35.3832611,32.3782594 31.9583333,35.7966667 C31.0587397,36.6879974 30.0508686,37.4629382 28.9583333,38.1033333 C28.3033941,38.4890431 27.4704606,38.3827841 26.9333333,37.845 L23.6166667,34.53 C28.5053053,31.4496338 32.7452344,27.4440926 36.0983333,22.7383333 L36.0983333,22.7383333 Z">
                                            </path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Sign Up</span>
                </a>
            </li>
        </ul>
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // 1. Lấy tên file hiện tại
        var path = window.location.pathname;
        var currentPage = path.split("/").pop().split('?')[0];

        if (currentPage === "" || currentPage === "index.php") currentPage = "dashboard.php";

        // --- DÒNG KIỂM TRA 1: Kiểm tra xem trang hiện tại script nhận diện là gì ---
        console.log("--- DEBUG SIDEBAR ---");
        console.log("Trang hiện tại (currentPage):", currentPage);

        var navLinks = document.querySelectorAll('#sidenav-main .nav-link');

        navLinks.forEach(function(link) {
            link.classList.remove('active');

            // 2. Lấy tên file đích từ href của link
            var linkHref = link.getAttribute('href');
            var linkPage = linkHref.split("/").pop().split('?')[0];

            // --- DÒNG KIỂM TRA 2: Xem danh sách các link mà sidebar đang duyệt qua ---
            // console.log("Đang kiểm tra menu link:", linkPage); 

            // 3. Logic so sánh
            if (currentPage === linkPage) {
                console.log("=> KHỚP: Menu '" + linkPage + "' sẽ được Active.");
                link.classList.add('active');
            }

            // Nhóm Sản phẩm (Product)
            var productGroup = ['product.php', 'add-product.php', 'edit-product.php',
                'add-product-process.php'
            ];
            if (productGroup.includes(currentPage) && linkPage === 'product.php') {
                link.classList.add('active');
            }

            // Nhóm Danh mục sản phẩm (Category)
            var categoryGroup = ['category.php', 'add-category.php', 'edit-category.php'];
            if (categoryGroup.includes(currentPage) && linkPage === 'category.php') {
                link.classList.add('active');
            }

            // Nhóm Banner chính
            var bannerGroup = ['banner.php', 'add-banner.php', 'edit-banner.php'];
            if (bannerGroup.includes(currentPage) && linkPage === 'banner.php') {
                link.classList.add('active');
            }

            // Nhóm Banner Intro
            var bannerIntroGroup = ['banner-intro.php', 'add-banner-intro.php',
                'edit-banner-intro.php'
            ];
            if (bannerIntroGroup.includes(currentPage) && linkPage === 'banner-intro.php') {
                link.classList.add('active');
            }

            // Nhóm Banner Content
            var bannerContentGroup = ['banner-content.php', 'add-banner-content.php',
                'edit-banner-content.php'
            ];
            if (bannerContentGroup.includes(currentPage) && linkPage === 'banner-content.php') {
                link.classList.add('active');
            }

            // Nhóm Flash Sale
            var flashSaleGroup = ['flash-sale.php', 'add-flash-sale.php', 'edit-flash-sale.php'];
            if (flashSaleGroup.includes(currentPage) && linkPage === 'flash-sale.php') {
                link.classList.add('active');
            }

            // Nhóm Video
            var videoGroup = ['video.php', 'add-video.php', 'edit-video.php'];
            if (videoGroup.includes(currentPage) && linkPage === 'video.php') {
                link.classList.add('active');
            }

            // Nhóm Bài viết (Post)
            var postGroup = ['post.php', 'add-post.php', 'edit-post.php'];
            if (postGroup.includes(currentPage) && linkPage === 'post.php') {
                link.classList.add('active');
            }

            // Nhóm Danh mục bài viết (Category Post)
            var categoryPostGroup = ['category-post.php', 'add-category-post.php',
                'edit-category-post.php'
            ];
            if (categoryPostGroup.includes(currentPage) && linkPage === 'category-post.php') {
                link.classList.add('active');
            }

            // Nhóm Tiêu đề bài báo (Article Title)
            var articleTitleGroup = ['article-title.php', 'add-article-title.php',
                'edit-article-title.php'
            ];
            if (articleTitleGroup.includes(currentPage) && linkPage === 'article-title.php') {
                link.classList.add('active');
            }
            // Nhóm Tiêu đề bài báo (Profile)
            var profileTitleGroup = ['profile.php'];
            if (profileTitleGroup.includes(currentPage) && linkPage === 'profile.php') {
                link.classList.add('active');
            }
        });
    });
    </script>
    <script>
// Chức năng lưu và tải cấu hình từ LocalStorage
document.addEventListener("DOMContentLoaded", function() {
    
    // 1. Tải cấu hình cũ khi load trang
    loadConfig();

    // 2. Lắng nghe sự kiện click thay đổi màu Sidebar
    window.sidebarColor = function(el) {
        var color = el.getAttribute("data-color");
        var parent = el.parentElement.children;
        for (var i = 0; i < parent.length; i++) {
            parent[i].classList.remove('active');
        }
        el.classList.add('active');
        
        // Cập nhật thuộc tính trên sidebar (Soft UI dùng attribute này để đổi màu)
        var sidebar = document.querySelector('.sidenav');
        sidebar.setAttribute('data-color', color);
        
        // Lưu vào máy người dùng
        localStorage.setItem('sidebarColor', color);
    };

    // 3. Lắng nghe sự kiện click thay đổi kiểu Sidebar (White / Transparent)
    window.sidebarType = function(el) {
        var type = el.getAttribute("data-class"); // bg-white hoặc bg-transparent
        var body = document.querySelector("body");
        var sidebar = document.querySelector(".sidenav");
        
        // Xử lý giao diện nút bấm
        var buttons = el.parentElement.querySelectorAll(".btn");
        buttons.forEach(btn => btn.classList.remove("active"));
        el.classList.add("active");

        // Thay đổi class của sidebar
        if (type === 'bg-transparent') {
            sidebar.classList.remove('bg-white');
            sidebar.classList.add('bg-transparent');
        } else {
            sidebar.classList.remove('bg-transparent');
            sidebar.classList.add('bg-white');
        }

        localStorage.setItem('sidebarType', type);
    };

    // 4. Lắng nghe sự kiện Fixed Navbar
    window.navbarFixed = function(el) {
        var navbar = document.getElementById('navbarBlur');
        var isChecked = el.checked;
        
        if (isChecked) {
            navbar.classList.add('navbar-fixed');
            navbar.setAttribute('navbar-scroll', 'true');
        } else {
            navbar.classList.remove('navbar-fixed');
            navbar.setAttribute('navbar-scroll', 'false');
        }
        
        localStorage.setItem('navbarFixed', isChecked);
    };

    // Hàm thực hiện load dữ liệu đã lưu
    function loadConfig() {
        // Load màu sắc
        var savedColor = localStorage.getItem('sidebarColor');
        if (savedColor) {
            var sidebar = document.querySelector('.sidenav');
            if(sidebar) sidebar.setAttribute('data-color', savedColor);
            
            // Cập nhật trạng thái Active cho nút màu trong Configurator
            var colorDots = document.querySelectorAll('.badge.filter');
            colorDots.forEach(dot => {
                if(dot.getAttribute('data-color') === savedColor) {
                    colorDots.forEach(d => d.classList.remove('active'));
                    dot.classList.add('active');
                }
            });
        }

        // Load kiểu Sidebar
        var savedType = localStorage.getItem('sidebarType');
        if (savedType) {
            var sidebar = document.querySelector('.sidenav');
            var btns = document.querySelectorAll('[onclick="sidebarType(this)"]');
            if (savedType === 'bg-white') {
                sidebar.classList.remove('bg-transparent');
                sidebar.classList.add('bg-white');
            } else {
                sidebar.classList.remove('bg-white');
                sidebar.classList.add('bg-transparent');
            }
            // Cập nhật nút active
            btns.forEach(btn => {
                if(btn.getAttribute('data-class') === savedType) btn.classList.add('active');
                else btn.classList.remove('active');
            });
        }

        // Load Navbar Fixed
        var savedNavbar = localStorage.getItem('navbarFixed');
        var navSwitch = document.getElementById('navbarFixed');
        if (savedNavbar === 'true') {
            if(navSwitch) navSwitch.checked = true;
            var navbar = document.getElementById('navbarBlur');
            if(navbar) navbar.classList.add('navbar-fixed');
        }
    }
});
</script>
</aside>