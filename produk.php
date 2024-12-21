<?php 
error_reporting(0);
include 'db.php';
$kontak = mysqli_query($conn,"SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
$a = mysqli_fetch_object($kontak);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!---Header--->
    <header>
        <div class="container">
            <h1><a href="index.php">Amalora.co</a></h1>
            <ul>
                <li><a href="produk.php">Produk</a></li>
            </ul>
        </div>
    </header>
    <!--- search --->
    <div class="search">
        <div class="container">
         <form action="produk.php" method="GET">
            <input type="text" name="search" placeholder="Cari Produk" value="<?php echo $_GET['search'] ?>">
           <input type="hidden" name="kat" value="<?php echo $_GET['kat']?>">
            <input type="submit" name="cari" value="Cari Produk">
         </form>
        </div>
    </div>

    <!---new product--->
    <div class="section">
        <div class="container">
        <h3>Produk</h3>
        <div class="box">
            <?php 
            // Inisialisasi variabel where
            $where = ''; 

            // Periksa apakah parameter search dan kat telah diatur dan tidak kosong
            if((isset($_GET['search']) && $_GET['search'] != '') || (isset($_GET['kat']) && $_GET['kat'] != '')){
                $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
                $kat = isset($_GET['kat']) ? mysqli_real_escape_string($conn, $_GET['kat']) : '';
                $where = "AND product_name LIKE '%$search%' AND category_id LIKE '%$kat%' ";
            }

            // Query untuk mengambil produk
            $produk = mysqli_query($conn,"SELECT * FROM tb_product WHERE product_status = 1 $where ORDER BY product_id DESC");

            if(mysqli_num_rows($produk) > 0){
                while($p = mysqli_fetch_array($produk)){
            ?>
                <div class="col-4">
                    <a href="detail-produk.php?id=<?php echo $p['product_id']?>">
                    <img src="produk/<?php echo $p['product_image'] ?>" alt="">
                    <p class="nama"><?php echo $p['product_name'] ?></p>
                    <p class="harga">Rp <?php echo number_format($p['product_price'], 0, ',', '.') ?></p>
                </div>
                </a>
            <?php }} else { ?>
                <p>Produk tidak ada</p>
            <?php } ?>
        </div>
        </div>
    </div>
    <!--footer--->
    <div class="footer">
        <div class="container">
        <h4>Hubungi Kami</h4>
            <p><i class="fas fa-map-marker-alt"></i> <?php echo $a->admin_address; ?></p>
            <p><i class="fas fa-envelope"></i> <?php echo $a->admin_email; ?></p>
            <p><i class="fas fa-phone"></i> <?php echo $a->admin_telp; ?></p>
            <p><i class="fab fa-whatsapp"></i> <a href="https://wa.me/<?php echo $a->admin_telp; ?>">WhatsApp</a></p>
            <small>&copy; 2024 - Amalora.co</small>
        </div>
    </div>
</body>
</html>
