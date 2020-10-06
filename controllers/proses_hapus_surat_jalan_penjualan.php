<?php 
include ("../config/connection.php");
$id = $_GET['id_karyawan'];
$tanggal_gajian = $_GET['tanggal_penggajian'];
if(mysqli_query($connect, "DELETE FROM surat_jalan_penjualan WHERE no_surat_jalan='$id'")or die(mysql_error())){
header("location:../views/surat_jalan_penjualan.php?pesan=hapus");
} else {
	header("location:../views/surat_jalan_penjualan.php?pesan=hapusgagal");
}
?>