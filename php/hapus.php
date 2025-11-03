<?php
include 'koneksi.php';

$id = $_GET['id'];

$sql = "DELETE FROM pendaftar WHERE id=$id";
$query = mysqli_query($koneksi, $sql);

if ($query) {
    header('Location: ../index.php');
} else {
    die("Gagal menghapus data: " . mysqli_error($koneksi));
}
?>