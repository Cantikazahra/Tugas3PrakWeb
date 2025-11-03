<?php
include 'php/koneksi.php';
$id = $_GET['id'];

$result = mysqli_query($koneksi, "SELECT * FROM pendaftar WHERE id=$id");
$data = mysqli_fetch_assoc($result);

$nama = $data['nama'];
$email = $data['email'];
$paket = isset($data['paket']) ? $data['paket'] : 'Undefined';
$fasilitas = !empty($data['fasilitas']) ? explode(',', $data['fasilitas']) : [];
$lokasi = $data['lokasi'];
$metode_pembayaran = $data['metode_pembayaran'];
$note = empty($data['catatan']) ? "-" : $data['catatan'];

$price1 = 0;
$price2 = 0;
$price3 = 0;
$tax = 0;
$price4 = 0;
$hargatotal = 0;
$taxes = 0;

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

if (!empty($fasilitas)) {
    foreach ($fasilitas as $fas) {
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
$hargatotal += $taxes + $price4;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bimbel Babarsari - Form Pendaftaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <div class="text-center my-3">
        <center>
            <h1>Data Pendaftaran Bimbel</h1>
            <div id="result" class="d-flex justify-content-center">
                <table class="table table-striped">
                    <tr>
                        <th>Nama</th>
                        <td><?= "$nama" ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?= "$email" ?></td>
                    </tr>
                    <tr>
                        <th>Paket Bimbel</th>
                        <td><?= "$paket" ?></td>
                    </tr>
                    <tr>
                        <th>Lokasi Belajar</th>
                        <td><?= "$lokasi" ?></td>
                    </tr>
                    <tr>
                        <th>Fasilitas Tambahan</th>
                        <td>
                            <?php
                            if (!empty($fasilitas)) {
                                echo implode(", ", array_map('trim', $fasilitas));
                            } else {
                                echo "-";
                            }
                            ?>
                        </td>

                    </tr>
                    <tr>
                        <th>Pajak</th>
                        <td><?= $tax ?>%</td>
                    </tr>
                    <tr>
                        <th>Catatan</th>
                        <td><?= "$note" ?></td>
                    </tr>
                    <tr>
                        <th>Metode Pembayaran</th>
                        <td><?= "$metode_pembayaran" ?></td>
                    </tr>
                    <tr>
                        <th>Total Biaya</th>
                        <td>
                            <table style="border-collapse: collapse; width: 100%;">
                                <tr>
                                    <td>Paket</td>
                                    <td>Rp <?= $price1 ?></td>
                                </tr>
                                <tr>
                                    <td>Lokasi Belajar</td>
                                    <td>Rp <?= $price2 ?></td>
                                </tr>
                                <tr>
                                    <td>Fasilitas Tambahan</td>
                                    <td>Rp <?= $price3 ?></td>
                                </tr>
                                <tr>
                                    <td>Biaya Layanan</td>
                                    <td>Rp <?= $price4 ?></td>
                                </tr>
                                <tr>
                                    <td>Total Pembayaran</td>
                                    <th>Rp <?= $hargatotal ?></th>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="text-center my-3">
                <a href="index.php" class="btn btn-light">Kembali ke Dashboard</a>
        </center>
    </div>
</body>

</html>