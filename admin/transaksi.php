<?php
require 'functions.php';

// session_start();

if (!isset($_SESSION["username"])) {
    echo "
    <script type='text/javascript'>
        alert('Silahkan login terlebih dahulu')
        window.location = '../login/index.php';
    </script>
    ";
}

if ($_SESSION["roles"] != "Admin") {
    echo "
    <script type='text/javascript'>
        alert('Mohon maaf anda bukan admin, enggak bisa masuk kesini!')
        window.location = '../login/index.php';
    </script>
    ";
}


$transaksi = mysqli_query($conn, "SELECT * FROM transaksi WHERE status = 'proses'");
$tolak = mysqli_query($conn, "SELECT * FROM transaksi WHERE status ='ditolak'");
$verifikasi = mysqli_query($conn, "SELECT * FROM transaksi WHERE status ='terverifikasi'");

?>

<?php require '../layout/sidebar.php'; ?>
<div id="main">
    <?php require '../layout/navbar-admin.php'; ?>
    <div class="content">
        <h1>Data Transaksi</h1>
        <hr>
        <h3>Produk Request</h3>
        <table class="table tbale-responsive table-hover mg-3">
            <tr>
                <th>No.</th>
                <th>Tanggal Transaksi</th>
                <th>Nama Pemesan</th>
                <th>Alamat</th>
                <th>No Telephone</th>
                <th>Produk Yang Di Pesan</th>
                <th>Total Harga</th>
                <th>Foto</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>

            <?php $i = 1; ?>
            <?php foreach ($transaksi as $data) : ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td><?= $data["tanggal_transaksi"]; ?></td>
                    <td><?= $data["nama_lengkap"]; ?></td>
                    <td><?= $data["alamat"]; ?></td>
                    <td><?= $data["no_telp"]; ?></td>
                    <td><?= $data["nama_produk"]; ?></td>
                    <td>Rp. <?= number_format($data["subtotal"]);  ?></td>
                    <td><img src="../image/<?= $data["foto"]; ?>" alt="" width="70"></td>
                    <td><?= $data["status"]; ?></td>
                    <td>
                        <a class="text-success me-2" href="verifikasi.php?id=<?= $data["id_transaksi"]; ?>" onclick="return confirm('Apakah anda yakin ingin verifikasi pesanan?');"><i class="fa-solid fa-check"></i></a>
                        <a class="text-danger me-3" href="tolak.php?id=<?= $data["id_transaksi"]; ?>" onclick="return confirm('Apakah anda yakin ingin menolak pesanan?');"><i class="fa-solid fa-xmark"></i></a>
                    </td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        </table>
        <h3>Produk Selesai - Terverifikasi</h3>
        <table class="table table-responsive table-hover mg-3">
            <tr>
                <th>No.</th>
                <th>Tanggal Transaksi</th>
                <th>Nama Pemesan</th>
                <th>Alamat</th>
                <th>No Telephone</th>
                <th>Produk Yang Di Pesan</th>
                <th>Total Harga</th>
                <th>Foto</th>
                <th>Status</th>
            </tr>

            <?php $i = 1; ?>
            <?php foreach ($verifikasi as $data) : ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td><?= $data["tanggal_transaksi"]; ?></td>
                    <td><?= $data["nama_lengkap"]; ?></td>
                    <td><?= $data["alamat"]; ?></td>
                    <td><?= $data["no_telp"]; ?></td>
                    <td><?= $data["nama_produk"]; ?></td>
                    <td>Rp. <?= number_format($data["subtotal"]) ; ?></td>
                    <td><img src="../image/<?= $data["foto"]; ?>" alt="" width="70"></td>
                    <td><?= $data["status"]; ?></td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        </table>
        <h3>Produk Selesai Ditolak</h3>
        <table class="table table-responsive table-hover mg-3">
            <tr>
                <th>No.</th>
                <th>Tanggal Transaksi</th>
                <th>Nama Pemesan</th>
                <th>Alamat</th>
                <th>No Telephone</th>
                <th>Produk Yang Di Pesan</th>
                <th>Total Harga</th>
                <th>Foto</th>
                <th>Status</th>
            </tr>

            <?php $i = 1; ?>
            <?php foreach ($tolak as $data) : ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td><?= $data["tanggal_transaksi"]; ?></td>
                    <td><?= $data["nama_lengkap"]; ?></td>
                    <td><?= $data["alamat"]; ?></td>
                    <td><?= $data["no_telp"]; ?></td>
                    <td><?= $data["nama_produk"]; ?></td>
                    <td>Rp. <?= number_format($data["subtotal"]); ?></td>
                    <td><img src="../image/<?= $data["foto"]; ?>" alt="" width="70"></td>
                    <td><?= $data["status"]; ?></td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        </table>

    </div>
</div>
<?php require '../layout/footer-admin.php'; ?>