<?php 
session_start();
require 'db.php';

// Check if the user is logged in
if (!isset($_SESSION['status_login'])) {
    echo '<script>window.location="login.php";</script>';
    exit(); // Exit to prevent further execution
}
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
            <h3>Dashboard</h3>
            <div class="box">
            <h4>Selamat datang <?php echo isset($_SESSION['admin_name']) ? $_SESSION['admin_name'] : ''; ?> di Toko Online</h4>

            </div>
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
