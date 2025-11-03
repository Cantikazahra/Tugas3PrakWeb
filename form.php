<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bimbel Babarsari - Form Pendaftaran</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <div class="header">
        <h1>Bimbel Babarsari</h1>
        <form id="formDaftar" action="php/prosesTambah.php" method="POST">

            <label for="name">Nama : </label>
            <input id="nama" name="nama" type="text" required>
            <br><br>

            <label for="email">Email : </label>
            <input id="email" name="email" type="email" required>
            <br><br>

            <div class="section-title">Paket Bimbingan</div>
            <label><input type="radio" name="paket" value="Paket Intensif SBMPTN"> Paket Intensif SBMPTN</label>
            <label><input type="radio" name="paket" value="Paket Reguler"> Paket Reguler</label>
            <label><input type="radio" name="paket" value="Paket Supercamp SBMPTN"> Paket Supercamp SBMPTN</label>
            <br><br>

            <div class="section-title">Fasilitas Tambahan</div>
            <label><input type="checkbox" name="fasilitas[]" value="Modul Cetak Lengkap"> Modul Cetak Lengkap <br></label>
            <label><input type="checkbox" name="fasilitas[]" value="Modul PDF"> Modul PDF <br></label>
            <label><input type="checkbox" name="fasilitas[]" value="Video Rekaman Kelas"> Video Rekaman Kelas <br></label>
            <label><input type="checkbox" name="fasilitas[]" value="Grup Diskusi Telegram"> Grup Diskusi Telegram <br></label>
            <br><br>

            <div class="section-title">Lokasi Cabang : </div>
            <select id="lokasi" name="lokasi">
                <option value="" selected disabled>Pilih Lokasi Cabang</option>
                <option value="Jakarta Pusat">Jakarta Pusat</option>
                <option value="Surabaya">Surabaya</option>
                <option value="Yogyakarta">Yogyakarta</option>
                <option value="Makassar">Makassar</option>
                <option value="Aceh">Aceh</option>
            </select>
            <br><br>

            <div class="section-title">Metode Pembayaran : </div>
            <select id="metode_pembayaran" name="metode_pembayaran">
                <option value="" selected disabled>Pilih Metode Pembayaran</option>
                <option value="Transfer Bank">Transfer Bank +3000</option>
                <option value="Tunai">Tunai</option>
                <option value="E-Wallet">E-Wallet +2000</option>
            </select>
            <br><br>

            <label for="catatan">Note </label> <br>
            <textarea id="catatan" name="catatan" rows="4" placeholder="Write your additional note here"
                style="width: 450px; height: 150px;"></textarea>
            <br>

            <div class="actions">
                <button type="button" onclick="clearInputs()">Reset</button>
                <button type="submit">Submit</button>
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