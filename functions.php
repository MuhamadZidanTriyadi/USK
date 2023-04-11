<?php 
session_start();
require 'koneksi.php';

function query($query){
    global $conn;
    $rows = [];
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function checkout($data){
    global $conn;
    foreach($_SESSION['cart'] as $produk_id => $result):
        $barang = query("SELECT * FROM produk WHERE id_produk = '$produk_id'")[0];
        $totalHarga = $result * $barang["harga"];
        $tanggal = $data['tanggal_transaksi'];
        $alamat = $data['alamat'];
        $no_telp = $data['no_telp'];
        $nama_lengkap = $_SESSION['nama_lengkap'];
        $nama_produk = $barang['nama_produk'];
        $price = $totalHarga;
        $foto = $barang['foto'];
        $id = $barang['id_produk'];
        $stok = $barang['stok'];
        $sisa = $stok - $result;
        $st = 'proses';
        
        if ($sisa <= 0) {
            // hapus produk jika stok habis
            $hapusProduk = mysqli_query($conn, "DELETE FROM produk WHERE id_produk = '$id'");
            unset($_SESSION['cart'][$produk_id]);
            continue;
        }
        
        $queryCheckout = "INSERT INTO transaksi VALUES(NULL,'$tanggal','$alamat', '$no_telp', '$nama_lengkap', '$nama_produk','$price','$foto','$st')";
        mysqli_query($conn, $queryCheckout);
        if ($queryCheckout) {
            $updateStok = mysqli_query($conn, "UPDATE produk SET stok = '$sisa' WHERE id_produk = '$id'");
        }
    endforeach; 
    unset($_SESSION['cart']);
    return mysqli_affected_rows($conn);
}