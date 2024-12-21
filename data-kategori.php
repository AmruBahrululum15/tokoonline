<?php 
session_start();
include 'db.php';

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
    <title>Kategori</title>
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
            <h3>Kategori</h3>
            <div class="box">
           
                          
                            <a href="tambah-kategori.php" class="btn btn-info">Tambah Data</a>
                        
              <table  border="1" cellspacing="0" class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                    
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                   if(mysqli_num_rows($kategori)> 0){
                    while ($row = mysqli_fetch_array($kategori)){
                          ?>
                    
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $row['category_name'] ?> </td>
                   
                        <td>
                 <a href="edit-kategori.php?id=<?php echo $row['category_id'] ?>" class="btn btn-edit">Edit</a> 
            <a href="proses-hapus.php?idk=<?php echo $row['category_id'] ?>" onclick="return confirm('yakin ingin dihapus?')"class="btn btn-hapus" >Hapus</a>
             </td>


                    </td>
                    </tr>
                    <?php }} else { ?>
                        <tr>
                            <td colspan="3"> Tidak ada data</td>
                        </tr>
                        <?php } ?>
                </tbody>
              </table>

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
