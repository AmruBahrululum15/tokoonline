<?php 
session_start();
include 'db.php';

// Check if the user is logged in
if (!isset($_SESSION['status_login'])) {
    echo '<script>window.location="login.php";</script>';
    exit(); // Exit to prevent further execution
}

// Ambil data produk berdasarkan ID
$produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '".$_GET['id']."' ");
if(mysqli_num_rows($produk) == 0){
    echo '<script>window.location="data-produk.php"</script>';
}
$p = mysqli_fetch_object($produk);

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
                <li><a href="keluar.php">Keluar</a></li>
            </ul>
        </div>
    </header>

    <!---Content--->
    <div class="section">
        <div class="container">
            <h3>Edit Data Produk</h3>
            <div class="box">
               <form action="" method="POST" enctype="multipart/form-data">
                <select class="input-control" name="kategori" required>
                    <option value="">---Pilih----</option>
                    <?php
                    $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                    while ($r = mysqli_fetch_array($kategori)) {
                        ?>
                        <option value="<?php echo $r['category_id']; ?>" <?php echo ($r['category_id'] == $p->category_id) ? 'selected' : ''; ?>><?php echo $r['category_name']; ?></option>
                    <?php } ?>
                </select>
                <input type="text" name="nama" placeholder="Nama Produk" class="input-control" value="<?php echo $p->product_name ?>" required>
                <input type="text" name="harga" placeholder="Harga" class="input-control" value="<?php echo $p->product_price ?>" required>
                <img src="produk/<?php echo $p->product_image ?>" width="100px">
                <input type="hidden" name="foto" value="<?php echo $p->product_image ?>"> <!-- Menggunakan hidden untuk foto lama -->
                <input type="file" name="gambar" class="input-control">
                <textarea id="deskripsi" name="deskripsi" placeholder="Deskripsi"><?php echo $p->product_description ?></textarea> <br><br>
                <select class="input-control" name="status" >
                    <option value="">---pilih---</option>
                    <option value="1" <?php echo ($p->product_status == 1) ? 'selected' : ''; ?>>Aktif</option>
                    <option value="0" <?php echo ($p->product_status == 0) ? 'selected' : ''; ?>>Tidak Aktif</option>
                </select>
                <input type="submit" name="submit" value="submit" class="btn">
            </form>

            <?php
             if (isset($_POST['submit'])){
                // Data input dari form
                $kategori = $_POST['kategori'];
                $nama     = $_POST['nama'];
                $harga    = $_POST['harga'];
                $deskripsi = $_POST['deskripsi'];  // Konsisten penggunaan nama variabel
                $status   = $_POST['status'];
                $foto = $_POST['foto']; // Mengambil gambar lama jika tidak diupdate

                // Data gambar baru
                $filename = $_FILES['gambar']['name'];
                $temp_name = $_FILES['gambar']['tmp_name'];

                // Jika admin mengganti gambar
                if ($filename != '') {
                    $type1 = explode('.', $filename);
                    $type2 = $type1[1];
    
                    $newname = 'produk' . time() . '.' . $type2;
                    $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif', 'webp');

                    if (!in_array($type2, $tipe_diizinkan)) {
                        echo '<script>alert("format file tidak diizinkan")</script>';
                    } else {
                        // Hapus gambar lama jika ada
                        if (file_exists('./produk/' . $foto)) {
                            unlink('./produk/' . $foto);
                        }
                        move_uploaded_file($temp_name, './produk/' . $newname);
                        $namagambar = $newname;
                    }
                } else {
                    // Jika admin tidak mengganti gambar
                    $namagambar = $foto;
                }

                // Query update produk
                $update = mysqli_query($conn, "UPDATE tb_product SET
                            category_id = '".$kategori."',
                            product_name = '".$nama."',
                            product_price = '".$harga."',
                            product_description = '".$deskripsi."',
                            product_image = '".$namagambar."',
                            product_status = '".$status."' 
                            WHERE product_id = '".$p->product_id."' ");
                
                if ($update) {
                    echo '<script>alert("Ubah Data berhasil!"); window.location="data-produk.php";</script>';
                } else {
                    echo 'Gagal menyimpan data: '.mysqli_error($conn);
                } 
            }
            ?>
            </div>
        </div>
    </div>

    <!---Footer--->
    <footer>
        <div class="container">
            <small>Copyright &copy 2024 Amru Bahrul Ulum</small>
        </div>
    </footer>

    <!-- Script untuk memanggil CKEditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/32.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#deskripsi'))
            .catch(error => {
                console.error(error);
            });
    </script>
</body>
</html>
