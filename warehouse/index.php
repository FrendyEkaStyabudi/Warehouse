<?php
require_once 'database.php';
require_once 'gudang.php';

// KONEKSI KE DATABASE
$database = new Database();
$db = $database->getConnection();

// MEMBUAT OBJEK GUDANG
$gudang = new Gudang($db);

// MEMBACA DATA GUDANG
$stmt = $gudang->read();
$num = $stmt->rowCount();

// EXAMPLE DYNAMIC DATA
$title = "Daftar Gudang";

// START OUTPUT BUFFERING TO CAPTURE THE CONTENT
ob_start();
?>
<link rel="stylesheet" href="style.css">

<h1>List Gudang</h1>

<a href="view-create.php" class="btn btn-add">Tambah Gudang</a>


<?php
// Assuming you already have $stmt from your query
if ($num > 0) {
    echo "<table class='table table-bordered'>";
    echo "<thead class='table-dark'><tr><th>ID</th><th>Name</th><th>Location</th><th>Capacity(m&sup2)</th><th>Status</th><th>Opening Hour</th><th>Closing Hour</th><th>Aksi</th></tr></thead>";
    echo "<tbody>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        echo "<tr>";
        echo "<td>{$id}</td>";
        echo "<td>{$name}</td>";
        echo "<td>{$location}</td>";
        echo "<td>{$capacity}</td>";
        echo "<td>{$status}</td>";
        echo "<td>{$opening_hour}</td>";
        echo "<td>{$closing_hour}</td>";
        echo "<td>";
        echo "<a href='view-edit.php?id={$id}' class='btn btn-success'>Edit</a> ";
        echo "<a href='delete.php?id={$id}' class='btn btn-danger' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'>Hapus</a>";
        echo "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
} else {
    echo "<p class='alert alert-info'>Tidak ada data pelanggan.</p>";
}

// Capture the content for the layout
$content = ob_get_clean();

// Include the layout template and pass the content
include 'layout.php';
?>