<?php 
include ("../config/connection.php");
$id = $_GET['id'];
if(mysqli_query($connect, "DELETE FROM inventaris WHERE id_inventaris='$id'")or die(mysql_error())){
header("location:../views/inventaris.php?pesan=hapus");
} else {
	header("location:../views/inventaris.php?pesan=hapusgagal");
}
?>