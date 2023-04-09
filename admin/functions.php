<?php 
    // echo __DIR__;
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

    // proses checkout
    function checkout($data){
        global $conn;

        foreach($_SESSION["cart"] as $product_id => $result){
            $barang = query("SELECT * FROM produk WHERE id_produk = '$product_id'")[0];
            $total_harga = $result * $barang["harga"];
            $tanggal = $data["tanggal_transaksi"];
            $alamat = $data["alamat"];
            $no_telp = $data["no_telp"];
            $nama_lengkap = $data["nama_lengkap"];
            $nama_produk = $data["nama_produk"];
            $harga = $data["harga"];
            $price = $total_harga;
            $foto = $data["foto"];
            $st = 'proses';

            // Masukin ke database
            $query_checkout = "INSERT INTO transaksi VALUES(
                NULL,
                '$tanggal',
                '$alamat',
                '$no_telp',
                '$nama_lengkap',
                '$nama_produk',
                '$harga',
                '$price',
                '$foto',
                '$st'
            )";

            mysqli_query($conn, $query_checkout);
        }
        return mysqli_affected_rows($conn);
    }

    // pengurangan stok
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

    // register dan crud user
    function tambahUser($data){
        global $conn;

        $nama_lengkap = htmlspecialchars($data['nama_lengkap']);
        $username = htmlspecialchars($data['username']);
        $password = htmlspecialchars($data['password']);
        $foto = $_FILES['foto']['name'];
        $files = $_FILES['foto']['tmp_name'];
        $roles = htmlspecialchars($data['roles']);
        
        $query = "INSERT INTO user VALUES('', '$nama_lengkap', '$username', '$password', '$foto', '$roles')";
        move_uploaded_file($files, "image/".$foto);
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }
    
    function hapusUser($id){
        global $conn;

        $query = "DELETE FROM user WHERE id_user='$id'";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }
    function updateUser($data){
        global $conn;

        $id = htmlspecialchars($data['id_user']);
        $nama_lengkap = htmlspecialchars($data['nama_lengkap']);
        $username = htmlspecialchars($data['username']);
        $password = htmlspecialchars($data['password']);
        $foto = $_FILES['foto']['name'];
        $files = $_FILES['foto']['tmp_name'];
        $roles = htmlspecialchars($data['roles']);

        if(empty($foto)){ // empty = buat ngecek klo isi variable trsbt kosong / gak ada isinya, klo gak ada isinya bakal diisi dengan nilai TRUE klo ada isinya diisi dengan nilai FALSE
            $query = "UPDATE user SET nama_lengkap = '$nama_lengkap', username = '$username', password = '$password', roles = '$roles' WHERE id_user = '$id'";
            mysqli_query($conn, $query);
            return mysqli_affected_rows($conn);
        }else{
            $query = "UPDATE user SET nama_lengkap = '$nama_lengkap', username = '$username', password = '$password', foto = '$foto', roles = '$roles' WHERE id_user = '$id'";
            move_uploaded_file($files, "image/".$foto);
            mysqli_query($conn, $query);
        }

        return mysqli_affected_rows($conn);
    }

    // crud produk
    function tambahProduk($data){
        global $conn;

        $nama_produk = htmlspecialchars($data['nama_produk']);
        $foto = $_FILES['foto']['name'];
        $files = $_FILES['foto']['tmp_name'];
        $harga = $data['harga'];
        $stok = htmlspecialchars($data['stok']);
        $deskripsi = htmlspecialchars($data['deskripsi']);
        
        $query = "INSERT INTO produk VALUES('', '$nama_produk', '$foto', '$harga', '$stok', '$deskripsi')";
        move_uploaded_file($files, "../image/" . $foto);
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }

    function hapusProduk($id){
        global $conn;

        $query = "DELETE FROM produk WHERE id_produk='$id'";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }

    function updateProduk($data){
        global $conn;

        $id = htmlspecialchars($data['id_produk']);
        $nama_produk = htmlspecialchars($data['nama_produk']);
        $harga = $data['harga'];
        $foto = $_FILES['foto']['name'];
        $files = $_FILES['foto']['tmp_name'];
        $stok = $data['stok'];
        $deskripsi = htmlspecialchars($data['deskripsi']);

        if(empty($foto)){ // empty = buat ngecek klo isi variable trsbt kosong / gak ada isinya
            $query = "UPDATE produk SET nama_produk = '$nama_produk', harga = '$harga', stok = '$stok', deskripsi = '$deskripsi' WHERE id_produk = '$id'";
            mysqli_query($conn, $query);
        }else{
            $query = "UPDATE produk SET nama_produk = '$nama_produk', harga = '$harga', foto = '$foto', stok = '$stok', deskripsi = '$deskripsi' WHERE id_produk = '$id'";
            move_uploaded_file($files, "image/".$foto);
            mysqli_query($conn, $query);
        }

        return mysqli_affected_rows($conn);
    }
    function tolakProduk($id){
        global $conn;
        mysqli_query($conn, "UPDATE transaksi SET status = 'ditolak' WHERE id_transaksi = '$id'");
    }

    function terimaProduk($id){
        global $conn;
        mysqli_query($conn, "UPDATE transaksi SET status = 'terverifikasi' WHERE id_transaksi = '$id'");
    }

    function editProduk($data){
        global $conn; 
        
        $id = htmlspecialchars($data["id_produk"]);
        $nama_produk = htmlspecialchars($data["nama_produk"]);
        $foto = $_FILES["foto"]["name"];
        $files = $_FILES["foto"]["tmp_name"];
        $harga = htmlspecialchars($data["harga"]);
        $stok = htmlspecialchars($data["stok"]);
        $deskripsi = htmlspecialchars($data["deskripsi"]);

        if(empty($foto)){
            $query = "UPDATE produk SET
            nama_produk = '$nama_produk',
            harga = '$harga',
            stok = '$stok',
            deskripsi = '$deskripsi' WHERE id_produk = '$id'";

            mysqli_query($conn, $query);
            return mysqli_affected_rows($conn);
        }else{
            $query = "UPDATE produk SET
            nama_produk = '$nama_produk',
            foto = '$foto',
            harga = '$harga',
            stok = '$stok',
            deskripsi = '$deskripsi' WHERE id_produk = '$id'";
            move_uploaded_file($files,"image/".$foto);

            mysqli_query($conn, $query);
            return mysqli_affected_rows($conn);
        }
    }
?>