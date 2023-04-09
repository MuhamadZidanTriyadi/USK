<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'printer2');

function query($query){
    global $conn;

    $result = mysqli_query($conn, $query);
    $rows = [];

    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }

    return $rows;
}
function checkout($data){
    global $conn;
    
    foreach($_SESSION['cart'] as $product_id => $result):
        ?>
        <?php
        $barang = query("SELECT * FROM produk WHERE id_produk = '$product_id'")[0];

        $totalHarga = $result*$barang["harga"];
        $tanggal_transaksi = $data["tanggal_transaksi"];
        $alamat = $data["alamat"];
        $no_telp = $data["no_telp"];
        $nama_lengkap = $data["nama_lengkap"];
        $nama_produk = $data["nama_produk"];
        $harga = $data["harga"];
        $price = $totalHarga;
        $id = $barang["id_produk"];
        $stok = $barang["stok"];
        $sisa = $stok - $result;
        $foto = $barang["foto"];
        $status = 'proses';

        // Masukkan ke database
        $queryCheckout = "INSERT INTO transaksi VALUES(
            NULL,
            '$tanggal_transaksi',
            '$alamat',
            '$no_telp',
            '$nama_lengkap',
            '$nama_produk',
            '$harga',
            '$price',
            '$foto',
            '$status')";
        // Masukkan ke database
        unset($_SESSION['cart']);
        mysqli_query($conn, $queryCheckout);
        if($queryCheckout){
            $updateStok = mysqli_query($conn, " UPDATE produk SET stok = '$sisa' WHERE id_produk = '$id'");
        }
        ?>
        <?php endforeach;
        return mysqli_affected_rows($conn);
    }
    function hapusPesanan($id){
        global $conn;
        mysqli_query($conn, "DELETE FROM transaksi WHERE id_transaksi = $id");
        return mysqli_affected_rows($conn);
    }
    function penguranganStok($id, $stok){
        global $conn;

        // jadi bikin variable buat nampung value stok/qty yang diinput user
        $stok = $_POST['qty'];
    
        // cara nguranginnya adalah stok - $stok, maksudnya 'stok' ini adalah stok yang ada di database dan ;$stok' ini isi stok yang diinput user
        // next buka checkout.php, liat komenan yang gw buat di atas form
        $query = "UPDATE produk SET stok = stok - '$stok' WHERE id_produk='$id'";
        mysqli_query($conn, $query);
    
        return mysqli_affected_rows($conn);
    }
    function pesanProduk($id){
        global $conn;
    
    
        $stok = $_POST["qty"];
        $query = "UPDATE produk SET stok= stok - '$stok' WHERE id_produk= '$id'";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }
    function simpan_transaksi(){
        
    }
?>