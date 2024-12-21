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
   <script src="https://cdn.ckeditor.com/4.25.0-lts/standard/ckeditor.js"></script>
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
            <h3>Tambah Data Produk</h3>
            <div class="box">
               <form action="" method="POST" enctype="multipart/form-data">
                <select class="input-control" name="kategori" required>
                    <option value="">---Pilih----</option>
                    <?php
                    $kategori = mysqli_query($conn,"SELECT * FROM tb_category ORDER BY category_id DESC");
                    while($r = mysqli_fetch_array($kategori)){
                        ?>
                        <option value="<?php echo $r['category_id']?>"><?php echo $r['category_name']; ?></option>
                   <?php } ?>
                </select>
                <input type="text" name="nama" placeholder="Nama Produk"class="input-control" required>
                <input type="text" name="harga" placeholder="Harga"class="input-control" required>
                <input type="file" name="gambar"class="input-control" required>
                <textarea id="deksripsi" name="deksripsi" placeholder="Deskripsi"></textarea> <br><br>
                <select class="input-control" name="status" >
                    <option value="">---pilih---</option>
                    <option value="1">Aktif</option>
                    <option value="0">Tidak Aktif</option>
                </select>
                <input type="submit" name="submit" value="submit"class="btn">

            </form>
             <?php
             if (isset($_POST['submit'])){
                
                // memnampung inputan dari form
                  
                $kategori = $_POST['kategori'];
                $nama     = $_POST['nama'];
                $harga    = $_POST['harga'];
                $deksripsi = $_POST['deksripsi'];
                $status    = $_POST['status'];

                // menampung data file yang diupload
                     
                $filename = $_FILES['gambar']['name'];
                $temp_name = $_FILES ['gambar']['tmp_name'];

                $type1 = explode('.',$filename );
                $type2 = $type1[1];

                $newname = 'produk'.time().'.'.$type2;

                //menampung data form file yang diizinkan 
                $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif', 'webp');

                // validasi format file
                 if(!in_array($type2, $tipe_diizinkan)){
                    echo '<script>alert("format file tidak diizinkan")</script>';
                 } else {

                    //jika format file sesuai dengan yang ada di dlaam arrat tipe diizinkan
                                    // proses upload file sekaligus insert database
                    
                                    move_uploaded_file($temp_name,'./produk/'.$newname);

                                    $insert = mysqli_query($conn, "INSERT INTO tb_product VALUES (
                                        null,
                                        '".$kategori."',
                                        '".$nama."',
                                        '".$harga."',
                                        '".$deksripsi."',
                                        '".$newname."',
                                        '".$status."',
                                        null
                                    )");
                 if ($insert) {
                    echo '<script>alert("Data berhasil disimpan!"); window.location="tambah-produk.php";</script>';
                } else {
                    echo 'Gagal menyimpan data: '.mysqli_error($conn);
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
    <!-- Script untuk memanggil CKEditor -->
<script src="https://cdn.ckeditor.com/ckeditor5/32.0.0/classic/ckeditor.js"></script> <!-- Gantilah ke versi terbaru jika perlu -->
<script>
    ClassicEditor
        .create(document.querySelector('#deksripsi'))
        .catch(error => {
            console.error(error);
        });
</script>
</body>
</html>
