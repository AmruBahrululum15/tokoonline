<?php 
error_reporting(0);
include 'db.php';
$kontak = mysqli_query($conn,"SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 11");
$a = mysqli_fetch_object($kontak);

 $produk = mysqli_query($conn,"SELECT * FROM tb_product WHERE product_id='".$_GET['id']."' ");
 $p = mysqli_fetch_object($produk);
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
  <!--detail Produk --->
  <div class="section">
    <div class="container">
        <h3>Detail Produk</h3>
        <div class="box">
         <div class="col-2">
            <img src="produk/<?php echo $p->product_image ?>" width="100%">
         </div>
         <div class="col-2">
            <h3><?php echo $p->product_name?></h3>
            <h4>Rp.<?php echo number_format($p->product_price) ?> </h4>
            <p>Deksripsi: <br>
          <?php echo $p->product_description ?>   
        </p>
        <p>
    <i class="fab fa-whatsapp whatsapp-icon"></i>
    <a href="https://wa.me/6281288027217?text=Hai%20saya%20tertarik%20dengan%20produk%20Anda" class="whatsapp-link" target="_blank">
    Hubungi WhatsApp
</a>

</p>


         </div>
        </div>
    </div>
  </div>

   
     <!--- Kontak --->
     <div class="footer">
        <div class="container">
        <h4>Hubungi Kami</h4>

        <?php if($a): ?>
            <p><i class="fas fa-map-marker-alt"></i> <?php echo $a->admin_address; ?></p>
            <p><i class="fas fa-envelope"></i> <?php echo $a->admin_email; ?></p>
            <p><i class="fas fa-phone"></i> <?php echo $a->admin_telp; ?></p>
            <p><i class="fab fa-whatsapp"></i> <a href="https://wa.me/<?php echo $a->admin_telp; ?>" style="color: green;">WhatsApp</a></p>
        <?php else: ?>
            <p>Informasi kontak tidak tersedia.</p>
        <?php endif; ?>
        
        <small>&copy; 2024 - Amalora.co</small>
        </div>
    </div>
</body>
</html>
