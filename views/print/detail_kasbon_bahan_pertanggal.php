<?php
	session_start();
	if(!isset($_SESSION['nama_user'])){
		header("location:../index.php");
	} else {
		date_default_timezone_set('Asia/Jakarta');
		include ("../../config/connection.php");
		include ("../../assets/function.php");
		
		if(isset($_GET['id_karyawan'])){
			$id = $_GET['id_karyawan'];
			$tanggal_kasbon = $_GET['tanggal_kasbon'];
			$query_mysql = mysqli_query($connect,"select * from kasbon_bahan LEFT JOIN karyawan ON karyawan.id_karyawan = kasbon_bahan.id_karyawan WHERE kasbon_bahan.id_karyawan='$id' AND kasbon_bahan.tanggal_kasbon='$tanggal_kasbon'");
			$data = mysqli_fetch_array($query_mysql);
			$query_mysql_salary = mysqli_query($connect,"select * from kasbon_bahan WHERE kasbon_bahan.id_karyawan='$id' AND kasbon_bahan.tanggal_kasbon='$tanggal_kasbon'");
			$dataSalary = mysqli_fetch_all($query_mysql_salary);
			$lokasi = $data['lokasi'];
		} else {
			header("location:../home.php");
		}
?>

<html>
<head>
	<title>Serrano</title>
	<link rel="stylesheet" type="text/css" href="../../assets/style.css">
	<script type="text/javascript" src="../../assets/jquery.js"></script>
	<link rel="stylesheet" href="../../assets/jquery/jquery-ui.css">
	<script src="../../assets/jquery/jquery-ui.min.js"></script>
</head>
<body>
<div class="content">
	<div id="halaman">
		<br/>
		<div class="container">
			<div class="row">
				<div class="col-25">
					Nama Karyawan
				</div>
				<div class="col-75">
					<?php echo $data['nama_karyawan'];?>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					Tanggal Kasbon
				</div>
				<div class="col-75">
					<?php echo $data['tanggal_kasbon'];?>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					Note
				</div>
				<div class="col-75">
					<?php echo $data['note'];?>
				</div>
			</div>
			<br /><br />
			<table border="1" class="demo-table">
				<tr>
					<th>No Seri</th>
					<th>Quantity</th>
					<th>Jumlah</th>
				</tr>
				<?php
				$nomor=1;
				$total = 0;
				foreach($dataSalary as $row){
					$total += $row[6];
				?>
				<tr>
					<td><?php echo $row[4]; ?></td>
					<td><?php echo $row[5]; ?></td>
					<td><?php echo rupiah($row[6]); ?></a></td>
				</tr>
				<?php } ?>
				<tr>
					<td colspan='2'>Total</td>
					<td><?php echo rupiah($total); ?></td>
				</tr>
			</table>
	</div>
</div>
</body>
</html>
<?php } ?>