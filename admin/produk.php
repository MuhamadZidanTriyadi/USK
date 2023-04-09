<?php 
require 'functions.php';

// session_start();

if(!isset($_SESSION["username"])){
    echo "
    <script type='text/javascript'>
        alert('Silahkan login terlebih dahulu')
        window.location = '../login/index.php';
    </script>
    ";
}

if($_SESSION["roles"] != "Admin"){
    echo "
    <script type='text/javascript'>
        alert('Mohon maaf anda bukan admin, enggak bisa masuk kesini!')
        window.location = '../login/index.php';
    </script>
    ";
}


$produk = mysqli_query($conn, "SELECT * FROM produk");

?>

<?php require '../layout/sidebar.php'; ?>
<div id="main">
    <?php require '../layout/navbar-admin.php'; ?>
    <div class="content">
        <h1>Data Produk</h1>
    <a class= "btn btn-primary my-2" href="tambah_produk.php">Tambah</a>
    <table class="table table-responsive table-hover">
        <tr>
            <th>No.</th>
            <th>Nama Produk</th>
            <th>Foto</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
        
        <?php $i = 1; ?>
        <?php foreach($produk as $data) : ?>
        <tr>
            <td><?= $i; ?></td>
            <td><?= $data["nama_produk"]; ?></td>
            <td><img src="../image/<?= $data["foto"]; ?>" alt="" width="70"></td>
            <td>Rp. <?= number_format($data["harga"]); ?></td>
            <td><?= $data["stok"]; ?></td>
            <td><?= $data["deskripsi"]; ?></td>
            <td>
                <a class="text-primary me-2" href="edit_produk.php?id=<?= $data["id_produk"]; ?>"><i class="fa-solid fa-pen"></i></a>
                <a class="text-danger" href="hapus_produk.php?id=<?= $data["id_produk"]; ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data?');"><i class= "fa-solid fa-trash"></i></a>
            </td>
        </tr>
        <?php 
if (isset($_GET['id'])) {
    
    include 'functions.php';

    $id = $_GET['id'];
    $status = 2;

    // Ambil data jumlah pada transaksi
    $queryTransaksi = "SELECT * FROM transaksi WHERE id_transaksi = '$id'";
    $resultTransaksi = mysqli_query($conn, $queryTransaksi);
    $dataTransaksi = mysqli_fetch_assoc($resultTransaksi);
    $jumlah = $dataTransaksi['Jumlah'];
    
   // Kurangi stok pada printer_tb dengan jumlah tersebut
   $queryPrinter = "SELECT * FROM produk WHERE id_produk = '".$dataTransaksi['id_transaksi']."'";
   $resultPrinter = mysqli_query($conn, $queryPrinter);
   $dataPrinter = mysqli_fetch_assoc($resultPrinter);
   $stokBaru = $dataPrinter['stok'] - $jumlah;
   $queryUpdateStok = "UPDATE produk SET stok = '$stokBaru' WHERE id_produk = '".$dataTransaksi['id_transaksi']."'";
   $resultUpdateStok = mysqli_query($conn, $queryUpdateStok);
   
   // Ubah status transaksi
   $queryUpdateStatus = "UPDATE transaksi SET status='$status' WHERE id_transaksi = '$id'";
   $run = mysqli_query($conn, $queryUpdateStatus);
    
    if ($run) {
        // Jika stok pada printer_tb habis (0), hapus data printer_tb sesuai idPrinter
        if ($stokBaru == 0) {
            $queryHapusPrinter = "DELETE FROM produk WHERE id_produk = '".$dataTransaksi['id_transaksi']."'";
            $resultHapusPrinter = mysqli_query($conn, $queryHapusPrinter);
        }
        header("location:dashboard.php");
    }
}
?>
        <?php $i++; ?>
        <?php endforeach; ?>
    </table>
</div>

</div>
<!-- <?php require '../layout/footer-admin.php'; ?> -->