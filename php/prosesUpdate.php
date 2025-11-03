<?php
include 'koneksi.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$paket = $_POST['paket'];
$fasilitas = isset($_POST['fasilitas']) ? implode(',', $_POST['fasilitas']) : '';
$lokasi = $_POST['lokasi'];
$metode_pembayaran = $_POST['metode_pembayaran'];
$catatan = $_POST['catatan'];

$price1 = 0;
$price2 = 0;
$price3 = 0;
$tax = 0;
$price4 = 0;
$hargatotal = 0;
$taxes = 0;
$total_biaya = 0;

if ($paket == "Paket Intensif SBMPTN") {
    $price1 = 500000;
    $tax = 10;
} else if ($paket == "Paket Reguler") {
    $price1 = 750000;
    $tax = 10;
} else if ($paket == "Paket Supercamp SBMPTN") {
    $price1 = 1000000;
    $tax = 10;
} else {
    $tax = 0;
}

if ($lokasi == "Jakarta Pusat") {
    $price2 = 100000;
} else if ($lokasi == "Yogyakarta") {
    $price2 = 80000;
} else if ($lokasi == "Aceh") {
    $price2 = 120000;
} else if ($lokasi == "Surabaya") {
    $price2 = 150000;
} else if ($lokasi == "Makassar") {
    $price2 = 115000;
}

if (!empty($_POST['fasilitas'])) {
    foreach ($_POST['fasilitas'] as $fas) {
        if ($fas == "Modul Cetak Lengkap") {
            $price3 += 50000;
        } else if ($fas == "Modul PDF") {
            $price3 += 25000;
        } else if ($fas == "Video Rekaman Kelas") {
            $price3 += 75000;
        } else if ($fas == "Grup Diskusi Telegram") {
            $price3 += 40000;
        }
    }
}

if ($metode_pembayaran == "Transfer Bank") {
    $price4 = 3000;
} else if ($metode_pembayaran == "E-Wallet") {
    $price4 = 2000;
} else if ($metode_pembayaran == "Tunai") {
    $price4 = 0;
}

$hargatotal = $price1 + $price2 + $price3;
$taxes = $hargatotal * ($tax / 100);
$total_biaya = $hargatotal + $taxes + $price4;

$sql = "UPDATE pendaftar SET
    nama = '$nama',
    email = '$email',
    paket = '$paket',
    fasilitas = '$fasilitas',
    lokasi = '$lokasi',
    metode_pembayaran = '$metode_pembayaran',
    catatan = '$catatan',
    total_biaya = '$total_biaya'
WHERE id = $id";

$query = mysqli_query($koneksi, $sql);

if ($query) {
    header('Location: ../index.php');
    exit;
} else {
    die("Gagal menyimpan perubahan: " . mysqli_error($koneksi));
}
