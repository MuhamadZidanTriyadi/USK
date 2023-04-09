<?php
session_start();
require 'functions.php';
$id = $_GET["id"];
    if (tolakProduk($id)) {
        echo "
            <script type='text/javascript'>
            alert('Produk Gagal Ditolak');
            window.location = 'transaksi.php';
            </script>
            ";
        } else {
            echo "
            <script type='text/javascript'>
            alert('Produk Berhasil Ditolak');
            window.location = 'transaksi.php';
        </script>
    ";
    }