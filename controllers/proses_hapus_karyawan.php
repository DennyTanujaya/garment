<?php 
include ("../config/connection.php");
$id = $_GET['id'];
if(mysqli_query($connect, "DELETE FROM karyawan WHERE id_karyawan='$id'")or die(mysqli_error($connect))){
header("location:../views/karyawan_list.php?pesan=hapus");
} else {
	header("location:../views/karyawan_list.php?pesan=hapusgagal");
}
?>