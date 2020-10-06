<?php 
include ("../config/connection.php");
$id = $_GET['id'];
if(mysqli_query($connect, "DELETE FROM daftar_inventaris WHERE id_barang='$id'")or die(mysql_error())){
header("location:../views/daftar_inventaris.php?pesan=hapus");
} else {
	header("location:../views/daftar_inventaris.php?pesan=hapusgagal");
}
?>