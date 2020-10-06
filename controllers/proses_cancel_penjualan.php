<?php 
include ("../config/connection.php");
$id = $_GET['no_invoice'];
if(mysqli_query($connect, "UPDATE penjualan SET cancellation='YES' WHERE no_invoice = '$id'")){
	$query_mysql_penjualan = mysqli_query($connect,"select * from penjualan WHERE no_invoice='$id'");
	$dataPenjualan= mysqli_fetch_all($query_mysql_penjualan);
	foreach($dataPenjualan AS $row){
		$no_surat_jalan_penjualan = $row['15'];
		$query_mysql_no_seri = mysqli_query($connect,"select * from surat_jalan_penjualan WHERE no_surat_jalan='$no_surat_jalan_penjualan'");
		$dataNoSeri= mysqli_fetch_array($query_mysql_no_seri);
		if($no_surat_jalan_penjualan == $dataNoSeri['no_surat_jalan']){
			$no_invoice = 'empty';
			mysqli_query($connect, "UPDATE surat_jalan_penjualan SET no_invoice='$no_invoice' WHERE no_surat_jalan='$no_surat_jalan_penjualan'");
		}
	}
	header("location:../views/penjualan.php?pesan=hapus");
} else {
	header("location:../views/penjualan.php?pesan=hapusgagal");
}
?>