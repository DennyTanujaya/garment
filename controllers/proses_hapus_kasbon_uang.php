<?php 
include ("../config/connection.php");
$id = $_GET['id_karyawan'];
$tanggal_kasbon = $_GET['tanggal_kasbon'];
if(mysqli_query($connect, "DELETE FROM kasbon_uang WHERE id_karyawan='$id' AND tanggal_kasbon='$tanggal_kasbon'")or die(mysql_error())){
header("location:../views/details/detail_kasbon_uang.php?pesan=hapus");
} else {
	header("location:../views/details/detail_kasbon_uang.php?pesan=hapusgagal");
}
?>