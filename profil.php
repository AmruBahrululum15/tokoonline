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
    <title>Profile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!---Header--->
    <header>
        <div class="container">
            <h1><a href="dashboard.php">Amalora.co</a></h1>
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
            <h3>Profil</h3>
            <div class="box">
               <form action="" method="POST">
                <input type="text" name="nama" placeholder="Nama Lengkap"class ="input-control"value="<?php echo $data->admin_name ?>" requried>
                <input type="text" name="user" placeholder="Username"class ="input-control"value="<?php echo $data->username ?>" requried>
                <input type="text" name="hp" placeholder="No Hp"class ="input-control"value="<?php echo $data->admin_telp?>" requried>
                <input type="email" name="email" placeholder="Email"class ="input-control"value="<?php echo $data->admin_email ?>" requried>
                <input type="text" name="alamat" placeholder="Alamat"class ="input-control"value="<?php echo $data->admin_address ?>" requried>
                <input type="submit" name="submit" value="Ubah profil"class="btn">

            </form>
            <?php
            if (isset($_POST['submit'])){
                $nama = ucwords($_POST['nama']);
                $user = $_POST['user'];
                $hp = $_POST['hp'];
                $email = $_POST['email'];
                $alamat = ucwords($_POST['alamat']);

                $update = mysqli_query($conn, "UPDATE tb_admin SET 
                admin_name = '" . $nama . "',
                username = '" . $user . "',
                admin_telp = '" . $hp . "',
                admin_email = '" . $email . "',
                admin_address = '" . $alamat . "' 
                WHERE admin_id = '" . $data->admin_id . "'");
             
                 if ($update){
                 echo '<script>alert("Ubah Data Berhasil")</script>';
                 echo '<script>window.location="profil.php"</script>';
            } else {
                echo 'gagal'. mysqli_error($conn);
            }
        }
               ?>                 
            
            </div>
            <h3>Ubah Password</h3>
            <div class="box">
               <form action="" method="POST">
                <input type="password" name="pass1" placeholder="Password Baru"class ="input-control" requried>
                <input type="password" name="pass2" placeholder="Konfirmasi Password"class ="input-control" requried>
              
                <input type="submit" name="ubah_password" value="Ubah Password"class="btn">
               </form>
                <?php
            if (isset($_POST['ubah_password'])){
                
                $pass1 = $_POST['pass1'];
                $pass2 = $_POST['pass2'];
              
                if($pass2 != $pass1){
                    echo '<script>alert("password baru Tidak Sesuai")</script>';
                }else {
                    $u_pass = mysqli_query($conn, "UPDATE tb_admin SET 
                password = '" . $pass1 . "' 
                WHERE admin_id = '" . $data->admin_id . "'");
                if ($u_pass){
                    echo '<script>alert("Ubah Data Berhasil")</script>';
                    echo '<script>window.location="profil.php"</script>';
               } else {
                   echo 'gagal'. mysqli_error($conn);
                }
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
