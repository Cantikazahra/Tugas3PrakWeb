<?php 
$server = "localhost"; // 127.0.0.1
$user = "root";
$password = "";
$database = "bimbel_babarsari";

$koneksi = mysqli_connect($server, $user, $password, $database);
if (!$koneksi){
    die("koneksi gagal: " . mysqli_connect_error());
}
?>