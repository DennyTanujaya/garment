<?php 
include ("../config/connection.php");
$id = $_GET['id_karyawan'];
$tanggal_gajian = $_GET['tanggal_penggajian'];
if(mysqli_query($connect, "DELETE FROM surat_jalan_cmt WHERE id_karyawan='$id' AND tanggal_gajian='$tanggal_gajian'")or die(mysql_error())){
header("location:../views/details/detail_surat_jalan_cmt.php?pesan=hapus");
} else {
	header("location:../views/details/detail_surat_jalan_cmt.php?pesan=hapusgagal");
}
?>