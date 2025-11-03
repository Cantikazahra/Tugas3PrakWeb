<?php
include 'php/koneksi.php';
$id = $_GET['id'];
$sql = "SELECT * FROM pendaftar WHERE id = $id";
$query = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_assoc($query);

if (mysqli_num_rows($query) < 1) {
    die("Data tidak ditemukan");
}

$fasilitas = explode(',', $data['fasilitas']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Pendaftar</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <div class="header">
        <h1>Form Update Pendaftar</h1>
        <br><br>

        <form id="formDaftar" action="php/prosesUpdate.php" method="POST">
            <input name="id" type="text" value="<?php echo $data['id']; ?>">
            <br><br>

            <label for="nama">Nama : </label>
            <input id="nama" name="nama" type="text" value="<?php echo $data['nama']; ?>" required>
            <br><br>

            <label for="email">Email : </label>
            <input id="email" name="email" type="email" value="<?php echo $data['email']; ?>" required>
            <br><br>

            <div class="section-title">Paket Bimbingan</div>
            <label><input type="radio" name="paket" value="Paket Intensif SBMPTN" <?= $data['paket'] == 'Paket Intensif SBMPTN' ? 'checked' : '' ?>> Paket Intensif SBMPTN</label>
            <label><input type="radio" name="paket" value="Paket Reguler" <?= $data['paket'] == 'Paket Reguler' ? 'checked' : '' ?>> Paket Reguler</label>
            <label><input type="radio" name="paket" value="Paket Supercamp SBMPTN" <?= $data['paket'] == 'Paket Supercamp SBMPTN' ? 'checked' : '' ?>> Paket Supercamp SBMPTN</label>
            <br><br>

            <div class="section-title">Fasilitas Tambahan</div>
            <label><input type="checkbox" name="fasilitas[]" value="Modul Cetak Lengkap" <?= in_array('Modul Cetak Lengkap', $fasilitas) ? 'checked' : '' ?>> Modul Cetak Lengkap</label>
            <label><input type="checkbox" name="fasilitas[]" value="Modul PDF" <?= in_array('Modul PDF', $fasilitas) ? 'checked' : '' ?>> Modul PDF</label>
            <label><input type="checkbox" name="fasilitas[]" value="Video Rekaman Kelas" <?= in_array('Video Rekaman Kelas', $fasilitas) ? 'checked' : '' ?>> Video Rekaman Kelas</label>
            <label><input type="checkbox" name="fasilitas[]" value="Grup Diskusi Telegram" <?= in_array('Grup Diskusi Telegram', $fasilitas) ? 'checked' : '' ?>> Grup Diskusi Telegram</label>
            <br><br>

            <div class="section-title">Lokasi Cabang : </div>
            <select id="lokasi" name="lokasi">
                <option value="" selected disabled>Pilih Lokasi Cabang</option>
                <option value="Jakarta Pusat" <?= $data['lokasi'] == 'Jakarta Pusat' ? 'selected' : '' ?>>Jakarta Pusat</option>
                <option value="Surabaya" <?= $data['lokasi'] == 'Surabaya' ? 'selected' : '' ?>>Surabaya</option>
                <option value="Yogyakarta" <?= $data['lokasi'] == 'Yogyakarta' ? 'selected' : '' ?>>Yogyakarta</option>
                <option value="Makassar" <?= $data['lokasi'] == 'Makassar' ? 'selected' : '' ?>>Makassar</option>
                <option value="Aceh" <?= $data['lokasi'] == 'Aceh' ? 'selected' : '' ?>>Aceh</option>
            </select>
            <br><br>

            <div class="section-title">Metode Pembayaran : </div>
            <select id="metode_pembayaran" name="metode_pembayaran">
                <option value="" selected disabled>Pilih Metode Pembayaran</option>
                <option value="Transfer Bank" <?= $data['metode_pembayaran'] == 'Transfer Bank' ? 'selected' : '' ?>>Transfer Bank +3000</option>
                <option value="Tunai" <?= $data['metode_pembayaran'] == 'Tunai' ? 'selected' : '' ?>>Tunai</option>
                <option value="E-Wallet" <?= $data['metode_pembayaran'] == 'E-Wallet' ? 'selected' : '' ?>>E-Wallet +2000</option>
            </select>
            <br><br>

            <label for="catatan">Note </label> <br>
            <textarea id="catatan" name="catatan" rows="4" placeholder="Write your additional note here"
                style="width: 450px; height: 150px;"></textarea>
            <br>

            <div class="actions">
                <button type="button" onclick="clearInputs()">Reset</button>
                <button type="submit">Update</button>
            </div>
        </form>
        <br><a href="index.php" class="btn btn-light">Kembali ke Dashboard</a>
    </div>

    <script>
        const form = document.getElementById("formDaftar");
        form.addEventListener("submit", function(event) {
            const nama = form.nama.value;
            const paket = form.paket.value;
            const yakin = confirm("Halo, " + nama +
                ". Anda memilih paket bimbel: " + paket +
                ".\nApakah Anda yakin ingin melanjutkan?");
        })
    </script>
    <script>
        function clearInputs() {
            const form = document.getElementById("formDaftar");
            form.querySelectorAll('input[type="text"], input[type="email"], textarea').forEach(el => {
                if (el.name !== 'id') {
                    el.value = '';
                }
            });
            form.querySelectorAll('input[type="radio"], input[type="checkbox"]').forEach(el => el.checked = false);
            form.querySelectorAll('select').forEach(el => el.selectedIndex = 0);
        }
    </script>
</body>

</html>