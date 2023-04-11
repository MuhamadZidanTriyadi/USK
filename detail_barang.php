<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>
</head>
<body>
    <h1>Detail Produk</h1

    <?php 
        include 'koneksi.php';

        $id = $_GET['id'];

        $data = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk = '$id'");

        while($olah = mysqli_fetch_array($data)){
            ?>
            <br>
                <h1>Nama Produk : <?= $olah['nama_produk']; ?></h1>
                <img src="image/<?= $olah['foto']; ?>" alt="" width="200px"><br>
                <h3>Harga : <?= "Rp. " . number_format($olah['harga'], 0, ',', '.') . " ,-"; ?></h3>
                <h3>Stok : <?= $olah['stok']; ?></h3>
                <h4>Deskripsi : <?= $olah['deskripsi']; ?></h4>
                <a href="index.php">Kembali</a>
            <?php
        }
    ?>
    
</body>
</html>