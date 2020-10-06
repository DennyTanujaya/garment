<?php 
include ("../config/connection.php");
$id = $_GET['id'];
if(mysqli_query($connect, "DELETE FROM supplier WHERE id_supplier='$id'")or die(mysql_error())){
header("location:../views/supplier_list.php?pesan=hapus");
} else {
	header("location:../views/supplier_list.php?pesan=hapusgagal");
}
?>