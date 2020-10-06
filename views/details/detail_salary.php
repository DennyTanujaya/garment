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
			$query_mysql = mysqli_query($connect,"select * from salary LEFT JOIN karyawan ON karyawan.id_karyawan = salary.id_karyawan WHERE salary.id_karyawan='$id'");
			$data = mysqli_fetch_array($query_mysql);
			$query_mysql_tanggal_penggajian = mysqli_query($connect,"select * from salary WHERE id_karyawan='$id' GROUP BY tanggal_gajian")or die(mysqli_error($connect));
			$dataTanggalPenggajian = mysqli_fetch_all($query_mysql_tanggal_penggajian);
		} else {
			header("location:../home.php");
		}
?>

<html>
<head>
	<title>Seranno</title>
	<link rel="stylesheet" type="text/css" href="../../assets/style.css">
	<script type="text/javascript" src="../../assets/jquery.js"></script>
	<link rel="stylesheet" href="../../assets/jquery/jquery-ui.css">
	<script src="../../assets/jquery/jquery-ui.min.js"></script>
</head>
<body>
<div class="content">
	<?php include('navbar.php'); ?>
	<div id="halaman">
		<div class="judul">		
			<h1>Details Salary</h1>
		</div>
		<br/>
		<div class="container">
			<div class="row">
				<div class="col-25">
					<label for="nama_karyawan">Nama Karyawan</label>
				</div>
				<div class="col-75">
					<p><?php echo $data['nama_karyawan'];?></p>
				</div>
			</div>
			<br /><br />
			<table border="1" class="demo-table">
				<tr>
					<th>No.</th>
					<th>Tanggal Penggajian</th>
					<th>Action</th>
				</tr>
				<?php
				$nomor=1;
				foreach($dataTanggalPenggajian as $row){
				?>
				<tr>
					<td><?php echo $nomor++; ?></td>
					<td><?php echo $row[7]; ?></a></td>
					<td><a href="../print/print_detail_salary.php?id_karyawan=<?php echo $data['id_karyawan']; ?>&tanggal_penggajian=<?php echo $row[7]; ?>" class="ahrefButton" target='_BLANK'>Print</a>
					<a href="../../controllers/proses_hapus_salary.php?id_karyawan=<?php echo $data['id_karyawan']; ?>&tanggal_penggajian=<?php echo $row[7]; ?>" class="ahrefButton">Hapus</a></td>
				</tr>
				<?php } ?>
			</table>
	</div>
</div>
</body>
</html>
<?php } ?>