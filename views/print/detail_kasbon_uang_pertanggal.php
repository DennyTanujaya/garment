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
			$query_mysql = mysqli_query($connect,"select * from kasbon_uang LEFT JOIN karyawan ON karyawan.id_karyawan = kasbon_uang.id_karyawan WHERE kasbon_uang.id_karyawan='$id' AND kasbon_uang.tanggal_kasbon='$tanggal_kasbon'");
			$data = mysqli_fetch_array($query_mysql);
			$query_mysql_salary = mysqli_query($connect,"select * from kasbon_uang WHERE kasbon_uang.id_karyawan='$id' AND kasbon_uang.tanggal_kasbon='$tanggal_kasbon'");
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
		<div class="judul">		
			<h1>Details Kasbon</h1>
		</div>
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
			<div class="row">
				<div class="col-25">
					Tenor
				</div>
				<div class="col-75">
					<?php echo $data['tenor'];?>
				</div>
			</div>
			<br /><br />
			<table border="1" class="demo-table">
				<tr>
					<th>No.</th>
					<th>Jumlah</th>
					<th>status</th>
					<th>Action</th>
				</tr>
				<?php
				$nomor=1;
				foreach($dataSalary as $row){
				?>
				<tr>
					<td><?php echo $nomor++; ?></td>
					<td><?php echo rupiah($row[3]); ?></a></td>
					<td><?php echo $row[6]; ?> </td>
					<td><a href="../../controllers/proses_update_kasbon_uang.php?id=<?php echo $row[0]; ?>" class="ahrefButton">Update</a></td>
				</tr>
				<?php } ?>
			</table>
	</div>
</div>
</body>
</html>
<?php } ?>