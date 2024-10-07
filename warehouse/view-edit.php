<?php
require_once 'database.php';
require_once 'gudang.php';

// Koneksi ke database
$database = new Database();
$db = $database->getConnection();

// Membuat objek Gudang
$gudang = new Gudang($db);

// Mendapatkan ID gudang dari URL
$gudang->id = isset($_GET['id']) ? $_GET['id'] : die('Error: ID tidak ditemukan.');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $gudang->name = $_POST['name'];
    $gudang->location = $_POST['location'];
    $gudang->capacity = $_POST['capacity'];
    $gudang->status = $_POST['status'];
    $gudang->opening_hour = $_POST['opening_hour'];
    $gudang->closing_hour = $_POST['closing_hour'];
    
    if ($gudang->update()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal mengupdate gudang.";
    }
} else {
    // Mendapatkan data gudang berdasarkan ID
    $stmt = $gudang->show($gudang->id);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    /* var_dump($data);
    exit; */

    $gudang->name = $data['name'];
    $gudang->location = $data['location'];
    $gudang->capacity = $data['capacity'];
    $gudang->status = $data['status'];
    $gudang->opening_hour = $data['opening_hour'];
    $gudang->closing_hour = $data['closing_hour'];
}

ob_start();
?>
<link rel="stylesheet" href="style.css">

<h1>Edit Gudang</h1>

<form action="view-edit.php?id=<?php echo $gudang->id; ?>" method="POST">
    <div class="mb-2">
        <label for="name">Nama:</label>
        <input type="text" class="form-control" name="name" id="name" value="<?php echo $gudang->name; ?>" required><br>

    </div>

    <div class="mb-2">
        <label for="location">Location:</label>
        <input type="text" class="form-control" name="location" id="location" value="<?php echo $gudang->location; ?>" required><br>

    </div>
    
    <div class="mb-2">
        <label for="capacity">Capacity:</label>
        <input type="text" class="form-control" name="capacity" id="capacity" value="<?php echo $gudang->capacity; ?>" required><br><br>

    </div>

    <div class="mb-2">
        <label for="status">Status:</label>
        <input type="text" class="form-control" name="status" id="status" value="<?php echo $gudang->status; ?>" required><br><br>

    </div>

    <div class="mb-2">
        <label for="opening_hour">Opening Hour:</label>
        <input type="time" class="form-control" name="opening_hour" id="opening_hour" value="<?php echo $gudang->opening_hour; ?>" required><br><br>

    </div>

    <div class="mb-2">
        <label for="closing_hour">Closing Hour:</label>
        <input type="time" class="form-control" name="closing_hour" id="closing_hour" value="<?php echo $gudang->closing_hour; ?>" required><br><br>

    </div>

    <input type="submit" class="btn btn-warning w-100" value="Update Gudang">
</form>

<br>
<a href="index.php" class="back-button">Kembali ke Daftar Gudang</a>

<?php
    $content = ob_get_clean();

    // Include the layout template and pass the content
    include 'layout.php';
?>