<?php 
include ("../config/connection.php");
$id = $_GET['id'];
if(mysqli_query($connect, "DELETE FROM stock WHERE id_stock='$id'")or die(mysql_error())){
header("location:../views/stock_list.php?pesan=hapus");
} else {
	header("location:../views/stock_list.php?pesan=hapusgagal");
}
?>