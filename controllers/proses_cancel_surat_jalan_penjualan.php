<?php 
include ("../config/connection.php");
$id = $_GET['no_surat_jalan'];
if(mysqli_query($connect, "UPDATE surat_jalan_penjualan SET cancellation='YES' WHERE no_surat_jalan = '$id'")){
	$query_mysql_penjualan = mysqli_query($connect,"select * from surat_jalan_penjualan WHERE no_surat_jalan='$id'");
	$dataPenjualan= mysqli_fetch_all($query_mysql_penjualan);
	foreach($dataPenjualan AS $row){
		$no_seri = $row['3'];
		$query_mysql_no_seri = mysqli_query($connect,"select * from noseri WHERE no_seri='$no_seri'");
		$dataNoSeri= mysqli_fetch_array($query_mysql_no_seri);
		if($no_seri == $dataNoSeri['no_seri']){
			$qty = $dataNoSeri['qty'] + $row[4];
			mysqli_query($connect, "UPDATE noseri SET qty='$qty' WHERE no_seri = '$no_seri'");
		}
	}
	header("location:../views/surat_jalan_penjualan.php?pesan=hapus");
} else {
	header("location:../views/surat_jalan_penjualan.php?pesan=hapusgagal");
}
?>