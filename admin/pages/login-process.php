<?php
session_start();
require_once '../../config.php'; // Chứa các hằng số DB_HOST, DB_USER...
require_once '../models/db.php';
require_once '../models/user.php';

$userModel = new Users();

if (isset($_POST['btn-login'])) {
    $gmail = $_POST['gmail'];
    $password = $_POST['password'];

    $user = $userModel->checkLogin($gmail, $password);

    if ($user) {
        // Lưu thông tin vào session
        $_SESSION['user'] = $user;

        // Phân quyền điều hướng
        if ($user['role_name'] == 'admin') {
            header("Location: dashboard.php");
        } 
        else if ($user['role_name'] == 'customer') {
            header("Location: sign-in.php");
        }
        else {
            header("Location: ../../index.php"); // Trang cho customer
        }
        exit();
    } else {
        // Sai tài khoản hoặc mật khẩu
        header("Location: sign-in.php?error=1");
        exit();
    }
}