<?php
include 'php/koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pendaftaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <h1 class="text-center">Data Pendaftaran Bimbel</h1>
    <br>

    <a href="form.php" class="btn btn-primary d-inline-flex align-items-center">Tambah Data</a>
    <br><br>

    <table class="table table-striped">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Paket</th>
            <th>Total Biaya</th>
            <th>Aksi</th>
        </tr>
        <?php
        $id = 1;
        $sql = "SELECT * FROM pendaftar";
        $query = mysqli_query($koneksi, $sql);

        if (mysqli_num_rows($query) > 0) {
            while ($data = mysqli_fetch_assoc($query)) {
        ?>
                <tr>
                    <td><?php echo $id++; ?></td>
                    <td><?php echo $data['nama']; ?></td>
                    <td><?php echo $data['paket']; ?></td>
                    <td><?php echo "Rp " . number_format($data['total_biaya'], 0, ',', '.'); ?></td>
                    <td>
                        <a href="updateData.php?id=<?php echo $data['id']; ?>" class="btn btn-primary btn-sm">Edit</a> |

                        <a href="php/hapus.php?id=<?php echo $data['id']; ?>" class="btn btn-primary btn-sm">Hapus</a> |
                        <a href="detail.php?id=<?php echo $data['id']; ?>" class="btn btn-primary btn-sm">Detail</a>
                    </td>
                </tr>
            <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="5" style="text-align: center"> Tidak ada data </td>
            </tr>
        <?php
        }
        ?>

    </table>
</body>

</html>