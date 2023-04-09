<?php
// session_start();
require 'functions.php';

if (!isset($_SESSION["username"])) {
    echo "
    <script type='text/javascript'>
        alert('Silahkan login terlebih dahulu')
        window.location = '../login/index.php';
    </script>
    ";
}

if (isset($_POST["kirim"])) {
    if (tambahProduk($_POST) > 0) {
        echo "
            <script type='text/javascript'>
                alert('Data produk berhasil ditambahkan');
                window.location = 'produk.php';
            </script>
        ";
    } else {
        echo "
        <script type='text/javascript'>
            alert('Data produk gagal ditambahkan');
            window.location = 'produk.php';
        </script>
    ";
    }
}


?>

<?php require '../layout/sidebar.php' ?>

<div id="main">
    <?php require '../layout/navbar-admin.php' ?>
    <div class="box">

        <h3>Tambah Data Produk</h3>

        <form action="" method="POST" enctype="multipart/form-data">
            <label for="nama_produk">Nama Produk</label><br />
            <input type="text" name="nama_produk" id="nama_produk" class="form-control"><br /> <br />

            <label for="foto">Foto</label><br />
            <input type="file" name="foto" id="foto" class="form-control"><br /> <br />

            <label for="harga">Harga</label><br />
            <input type="text" name="harga" id="harga" class="form-control"><br /> <br />


            <label for="stok">Stok</label><br />
            <input type="text" name="stok" id="stok" class="form-control"><br /> <br />

            <label for="deskripsi">Deskripsi</label><br />
            <textarea name="deskripsi" id="deskripsi" cols="30" rows="5" class="form-control"></textarea><br /> <br />

            <button type="submit" name="kirim">Tambah</button>
        </form>

    </div>
</div>
<?php require '../layout/footer-admin.php' ?>