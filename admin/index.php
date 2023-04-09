<?php

session_start();

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


?>

<?php require '../layout/sidebar.php'; ?>
<div id="main">
    <?php require '../layout/navbar-admin.php'; ?>
    <div class="content">
        <h2>
            Halo selamat datang <?= $_SESSION["nama_lengkap"]; ?> <br />
            Ini adalah Halaman Admin
        </h2>
    </div>
</div>
<?php require '../layout/footer-admin.php'; ?>