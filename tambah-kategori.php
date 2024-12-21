<?php 
session_start();
include 'db.php';

// Check if the user is logged in
if (!isset($_SESSION['status_login'])) {
    echo '<script>window.location="login.php";</script>';
    exit(); // Exit to prevent further execution
}
$query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE admin_id = '" . $_SESSION['id'] . "'");
$data = mysqli_fetch_object($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!---Header--->
    <header>
        <div class="container">
            <h1><a href="dashboard.php">TOKO AMRU</a></h1>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="data-kategori.php">Data Kategori</a></li>
                <li><a href="data.php">Data Produk</a></li>
                <li><a href="keluar.php">Keluar</a></li> <!-- Corrected to match the logout script -->
            </ul>
        </div>
    </header>

    <!---Content--->
    <div class="section">
        <div class="container">
            <h3>Tambah Data Kategori</h3>
            <div class="box">
               <form action="" method="POST">
                <input type="text" name="nama" placeholder="Nama Kategori"class ="input-control" requried>
                <input type="submit" name="submit" value="submit"class="btn">

            </form>
             <?php
             if (isset($_POST['submit'])){

                $nama = ucwords($_POST['nama']);

                $insert = mysqli_query($conn, "INSERT INTO tb_category VALUES (
                                             null,
                                             '".$nama."') ");
                 if($insert){
                   
                    echo '<script>alert("Tambah data berhasil")</script>';
                    echo '<script>window.location="data-kategori.php"</script>';
                 } else {
                    echo 'gagal';
                 }                           
             }       
            ?>
            </div>
                       
    </div>

    <!---Footer--->
    <footer>
        <div class="container">
            <small>Copyright &copy 2024 Amru Bahrul Ulum</small>
        </div>
    </footer>
</body>
</html>
