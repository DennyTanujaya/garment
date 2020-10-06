<?php 
include ("../config/connection.php");
$id = $_GET['id'];
if(mysqli_query($connect, "DELETE FROM customer WHERE id_customer='$id'")or die(mysql_error())){
header("location:../views/customer.php?pesan=hapus");
} else {
	header("location:../views/customer.php?pesan=hapusgagal");
}
?>