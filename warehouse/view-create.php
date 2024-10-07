<?php
require_once 'database.php';
require_once 'gudang.php';

// Koneksi ke database
$database = new Database();
$db = $database->getConnection();

// Membuat objek gudang
$gudang = new Gudang($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $gudang->name = $_POST['name'];
    $gudang->location = $_POST['location'];
    $gudang->capacity = $_POST['capacity'];
    $gudang->status = $_POST['status'];
    $gudang->opening_hour = $_POST['opening_hour'];
    $gudang->closing_hour = $_POST['closing_hour'];
    
    if ($gudang->create()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal menambahkan Gudang.";
    }
}
ob_start();
?>
<link rel="stylesheet" href="style.css">

    <h1>Add New Gudang</h1>

    <form action="view-create.php" method="POST">
        <div class="mb-2">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" id="name" required><br>
        </div>

        <div class="mb-2">
            <label for="loation">Location:</label>
            <input type="text" class="form-control" name="location" id="location" required><br>

        </div>

        <div class="mb-2">
            <label for="capacity">Capacity:</label>
            <input type="text" class="form-control" name="capacity" id="capacity" required><br><br>

        </div>

        <div class="mb-2">
            <label for="status">Status:</label>
            <input type="text" class="form-control" name="status" id="status" required><br><br>

        </div>

        <div class="mb-2">
            <label for="opening_hour">Opening Hour:</label>
            <input type="time" class="form-control" name="opening_hour" id="opening_hour" required><br><br>

        </div>

        <div class="mb-2">
            <label for="closing_hour">Closing Hour:</label>
            <input type="time" class="form-control" name="closing_hour" id="closing_hour" required><br><br>

        </div>

        <input type="submit" class="btn btn-primary w-100" value="Tambah Gudang">
    </form>

    <br>
    <a href="index.php" class="back-button">Kembali ke Daftar Gudang</a>

<?php
    $content = ob_get_clean();

    // Include the layout template and pass the content
    include 'layout.php';
?>


