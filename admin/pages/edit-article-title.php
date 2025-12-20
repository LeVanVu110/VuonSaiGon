<?php
require_once '../../config.php';
require_once '../models/db.php';
require_once '../models/post.php';
require_once '../models/article_title.php';

$postModel = new Posts();
$titleModel = new ArticleTitles();

// 1. Lấy ID từ URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$detail = $titleModel->getArticleTitleById($id);

// Nếu không tìm thấy dữ liệu, quay về trang danh sách
if (!$detail) {
    header("Location: article-title.php");
    exit();
}

// 2. Lấy danh sách bài viết để chọn
$posts = $postModel->getPostsPage(1, 1000); 

// 3. Lấy danh sách mục cha hiện tại của bài viết này
$parents = $titleModel->getParentsByPost($detail['post_id']);

// 4. Xử lý khi nhấn nút Lưu (Update)
if (isset($_POST['btn-update'])) {
    $title = $_POST['title'];
    $post_id = $_POST['post_id'];
    $content = $_POST['content'];
    $parent_id = $_POST['parent_id'];

    if ($titleModel->update($id, $title, $post_id, $content, $parent_id)) {
        echo "<script>window.location.href='article-title.php?success=update';</script>";
        exit();
    } else {
        $error = "Không thể cập nhật dữ liệu!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        Soft UI Dashboard 3 by Creative Tim
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,800" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="https://demos.creative-tim.com/soft-ui-dashboard/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/soft-ui-dashboard/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.1.0" rel="stylesheet" />
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body class="g-sidenav-show bg-gray-100">
    <?php include "sidebar.php"; ?>
    <main class="main-content position-relative min-vh-100 border-radius-lg" style="margin-left: 250px;">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a>
                        </li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tables</li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">Tables</h6>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                        <div class="input-group">
                            <span class="input-group-text text-body"><i class="fas fa-search"
                                    aria-hidden="true"></i></span>
                            <input type="text" class="form-control" placeholder="Type here...">
                        </div>
                    </div>
                    <ul class="navbar-nav  justify-content-end">
                        <li class="nav-item d-flex align-items-center">
                            <a class="btn btn-outline-primary btn-sm mb-0 me-3" href="logout.php">Logout</a>
                        </li>
                        <!-- <li class="nav-item d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">Sign In</span>
              </a>
            </li> -->
                        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item px-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0">
                                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                            </a>
                        </li>
                        <li class="nav-item dropdown pe-2 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-bell cursor-pointer"></i>
                            </a>
                            <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4"
                                aria-labelledby="dropdownMenuButton">
                                <li class="mb-2">
                                    <a class="dropdown-item border-radius-md" href="javascript:;">
                                        <div class="d-flex py-1">
                                            <div class="my-auto">
                                                <img src="../assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="text-sm font-weight-normal mb-1">
                                                    <span class="font-weight-bold">New message</span> from Laur
                                                </h6>
                                                <p class="text-xs text-secondary mb-0 ">
                                                    <i class="fa fa-clock me-1"></i>
                                                    13 minutes ago
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="mb-2">
                                    <a class="dropdown-item border-radius-md" href="javascript:;">
                                        <div class="d-flex py-1">
                                            <div class="my-auto">
                                                <img src="../assets/img/small-logos/logo-spotify.svg"
                                                    class="avatar avatar-sm bg-gradient-dark  me-3 ">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="text-sm font-weight-normal mb-1">
                                                    <span class="font-weight-bold">New album</span> by Travis Scott
                                                </h6>
                                                <p class="text-xs text-secondary mb-0 ">
                                                    <i class="fa fa-clock me-1"></i>
                                                    1 day
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item border-radius-md" href="javascript:;">
                                        <div class="d-flex py-1">
                                            <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
                                                <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                                    <title>credit-card</title>
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <g transform="translate(-2169.000000, -745.000000)"
                                                            fill="#FFFFFF" fill-rule="nonzero">
                                                            <g transform="translate(1716.000000, 291.000000)">
                                                                <g transform="translate(453.000000, 454.000000)">
                                                                    <path class="color-background"
                                                                        d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z"
                                                                        opacity="0.593633743"></path>
                                                                    <path class="color-background"
                                                                        d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z">
                                                                    </path>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </svg>
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="text-sm font-weight-normal mb-1">
                                                    Payment successfully completed
                                                </h6>
                                                <p class="text-xs text-secondary mb-0 ">
                                                    <i class="fa fa-clock me-1"></i>
                                                    2 days
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="container-fluid py-4 text-start">
            <div class="card shadow-lg col-12">
                <div class="card-header pb-0">
                    <h6>Chỉnh sửa Mục lục bài viết</h6>
                    <?php if(isset($error)): ?>
                    <div class="alert alert-danger text-white"><?= $error ?></div>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold">1. Bài viết gốc</label>
                                <select name="post_id" id="post_id" class="form-select form-control" required
                                    onchange="loadParents(this.value)">
                                    <?php foreach($posts as $p): ?>
                                    <option value="<?= $p['post_id'] ?>"
                                        <?= ($p['post_id'] == $detail['post_id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($p['title']) ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold">2. Thuộc mục cha (Cấp độ)</label>
                                <select name="parent_id" id="parent_id" class="form-select form-control">
                                    <option value="0">Mục Chính (Cấp 1)</option>
                                    <?php foreach($parents as $pa): ?>
                                    <?php if($pa['article_title_id'] != $id): ?>
                                    <option value="<?= $pa['article_title_id'] ?>"
                                        <?= ($pa['article_title_id'] == $detail['parent_id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($pa['title']) ?>
                                    </option>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label font-weight-bold">3. Tiêu đề mục chi tiết</label>
                                <input type="text" name="title" class="form-control"
                                    value="<?= htmlspecialchars($detail['title']) ?>" required>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label font-weight-bold">4. Nội dung chi tiết</label>
                                <textarea name="content" class="form-control"
                                    rows="15"><?= htmlspecialchars($detail['content']) ?></textarea>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <a href="article-title.php" class="btn btn-secondary me-2">Hủy bỏ</a>
                            <button type="submit" name="btn-update" class="btn bg-gradient-info">Cập nhật thay
                                đổi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <?php include "options.php"; ?>
    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
    </script>
    <script>
    function generateSlug() {
        let name = document.getElementById('cat_name').value;
        let slug = name.toLowerCase()
            .normalize('NFD').replace(/[\u0300-\u036f]/g, '') // Bỏ dấu
            .replace(/[^\w ]+/g, '')
            .replace(/ +/g, '-');
        document.getElementById('cat_slug').value = slug;
    }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    function loadParents(postId) {
        const parentSelect = $('#parent_id');
        const currentId = <?= $id ?>; // ID của mục đang sửa

        if (postId !== "") {
            $.ajax({
                url: "get_parents.php",
                method: "POST",
                data: {
                    post_id: postId
                },
                success: function(data) {
                    // Sau khi nhận HTML từ get_parents.php, bạn có thể lọc bỏ option có value trùng với currentId nếu cần
                    parentSelect.html(data);
                }
            });
        } else {
            parentSelect.html('<option value="0">Mục Chính (Cấp 1)</option>');
        }
    }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/soft-ui-dashboard.min.js?v=1.1.0"></script>
</body>

</html>