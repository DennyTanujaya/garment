<?php 
include ("../config/connection.php");
$id = $_GET['id'];
if(mysqli_query($connect, "DELETE FROM purchase_order WHERE id_purchase_order='$id'")or die(mysql_error())){
	header("location:../views/purchase_order_list.php?pesan=hapus");
} else {
	header("location:../views/purchase_order_list.php?pesan=hapusgagal");
}
?>