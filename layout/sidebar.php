<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/sidebar1.css">
</head>
<body>
    <?php require 'modal.php' ?>
    <div id="sidebar">
        <a href="index.php" class="sidebar-brand">Admin Dashboard</a>
        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a class="sidebar-link" href="user.php"><i class="fa-solid fa-users me-2"></i>Data user</a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="produk.php"><i class="fa-solid fa-boxes me-2"></i>Data produk</a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="transaksi.php"><i class="fa-solid fa-chart-line me-2"></i>Data transaksi</a>
            </li>
            <li class="sidebar-item">
                <a href="../logout.php"class="sidebar-link" data-bs-toggle="modal" data-bs-target="#logoutModal"><i class="fa-solid fa-arrow-right-from-bracket me-2"></i>Logout</a>
            </li>
        </ul>
    </div>
    