<?php 
include ("../config/connection.php");
$id = $_GET['id'];
if(mysqli_query($connect, "DELETE FROM penjualan WHERE id_penjualan='$id'")or die(mysql_error())){
	header("location:../views/penjualan.php?pesan=hapus");
} else {
	header("location:../views/penjualan.php?pesan=hapusgagal");
}
?>