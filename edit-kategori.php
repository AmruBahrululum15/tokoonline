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
  $kategori = mysqli_query($conn,"SELECT * FROM tb_category WHERE category_id = '".$_GET['id']."'");
  if(mysqli_num_rows($kategori)==0){
    echo '<script>window.location="data-kategori.php"</script>';
  }
  $k = mysqli_fetch_object($kategori);

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
                <li><a href="data-produk.php">Data Produk</a></li>
                <li><a href="keluar.php">Keluar</a></li> <!-- Corrected to match the logout script -->
            </ul>
        </div>
    </header>

    <!---Content--->
    <div class="section">
        <div class="container">
            <h3>Edit Data Kategori</h3>
            <div class="box">
               <form action="" method="POST">
                <input type="text" name="nama" placeholder="Nama Kategori"class ="input-control" value="<?php echo $k->category_name?>"requried>
                <input type="submit" name="submit" value="submit"class="btn">

            </form>
             <?php
             if (isset($_POST['submit'])){

                $nama = ucwords($_POST['nama']);
                   
                $update = mysqli_query($conn,"UPDATE tb_category SET 
                                      category_name = '".$nama."'
                                      WHERE category_id = '".$k->category_id."' ");
               
                 if($update){
                   
                    echo '<script>alert("Edit data berhasil")</script>';
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
