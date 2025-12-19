<?php
require_once '../../config.php';
require_once '../models/db.php';
require_once '../models/flash_sale.php';

if (isset($_GET['id'])) {
    $flashModel = new FlashSales();
    $flashModel->delete($_GET['id']);
    header("Location: flash-sale.php?success=deleted");
}