<?php
    require_once 'database.php';
    require_once 'gudang.php';

    $database = new Database();
    $db = $database->getConnection();

    $pelanggan = new Gudang($db);

    $pelanggan->id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Missing ID.');
    $pelanggan->delete();

    header("Location: index.php");
    exit;
?>