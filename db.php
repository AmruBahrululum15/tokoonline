<?php 
$hostname = 'localhost' ;
$username = 'root';
$password ='';
$dbname ='db_bukawarung';

$conn = mysqli_connect($hostname,$username,$password,$dbname) or die ('gagal koneksi ke database');
?>