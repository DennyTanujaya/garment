<?php 
include ("../config/connection.php");
$id = $_GET['id'];
if(mysqli_query($connect, "DELETE FROM retur WHERE id_retur = '$id'")){
	$query_mysql_purchase_order = mysqli_query($connect,"select * from retur WHERE id_retur='$id'");
	$dataPurchaseOrder= mysqli_fetch_array($query_mysql_purchase_order);
	$id_purchase_order = $dataPurchaseOrder['id_purchase_order'];
	mysqli_query($connect, "UPDATE purchase_order SET status_return='0' WHERE id_purchase_order='$id_purchase_order'");
	header("location:../views/return.php?pesan=hapus");
} else {
	header("location:../views/return.php?pesan=hapusgagal");
}
?>