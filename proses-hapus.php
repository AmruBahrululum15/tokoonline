<?php  
include 'db.php';

if (isset($_GET['idk'])) {
    // Menghapus kategori
    $delete = mysqli_query($conn, "DELETE FROM tb_category WHERE category_id = '".$_GET['idk']."' ");
    echo '<script>window.location="data-kategori.php"</script>';
}
if (isset($_GET['idp'])) {
    $produk = mysqli_query($conn, "SELECT product_image FROM tb_product WHERE product_id = '".$_GET['idp']."' ");
    $p = mysqli_fetch_object($produk);

    if (file_exists('./produk/'.$p->product_image)) {
        unlink('./produk/'.$p->product_image);
    } else {
        echo 'File gambar tidak ditemukan!';
    }

    $delete = mysqli_query($conn, "DELETE FROM tb_product WHERE product_id = '".$_GET['idp']."' ");
    if ($delete) {
        // Penghapusan berhasil
        echo '<script>window.location="data-produk.php"</script>';
    } else {
        // Penghapusan gagal
        echo 'Gagal menghapus produk: ' . mysqli_error($conn);
    }
}
