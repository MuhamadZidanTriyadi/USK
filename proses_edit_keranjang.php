<?php 
session_start();

$id = $_POST["id_produk"];
$qty = $_POST["qty"];

$_SESSION["cart"][$id] = $qty;

header('Location: keranjang.php');

?>