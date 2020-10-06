<?php
	session_start();
	if(!isset($_SESSION['nama_user'])){
		header("location:../index.php");
	} else {
		date_default_timezone_set('Asia/Jakarta');
		include ("../../config/connection.php");
		include ("../../assets/function.php");
		
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$query_mysql = mysqli_query($connect,"select * from surat_jalan_penjualan WHERE no_surat_jalan='$id'");
			$data = mysqli_fetch_array($query_mysql);
			$query_mysql_seri = mysqli_query($connect,"select * from surat_jalan_penjualan WHERE no_surat_jalan='$id'");
			$dataNoSeri = mysqli_fetch_all($query_mysql_seri);
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
			<h2>Surat Jalan</h2>
		</div>
		<br/>
		<div class="container">
			<div class="row">
				<div class="col-25">
					No. Surat Jalan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $data['no_surat_jalan'];?><br />
					Tanggal Surat Jalan&nbsp;&nbsp;&nbsp;: <?php echo $data['tanggal_surat_jalan'];?><br />
				</div>
			</div>
			<br /><br />
			<table style="font-size:12px;">
				<tr>
					<th>No.</th>
					<th>No Seri</th>
					<th>Quantity</th>
					<th>Description</th>
				</tr>
				<?php
				$nomor=1;
				$grandTotal = 0;
				foreach($dataNoSeri as $row){
				?>
				<tr>
					<td><?php echo $nomor++; ?></td>
					<td><?php echo $row[3]; ?></a></td>
					<td><?php echo $row[4]; ?></td>
					<td><?php echo $row[5]; ?></td>
				</tr>
				<?php } ?>
			</table
		</div>
	</div>
</div>
<script>
	window.print();
</script>
</body>
</html>
<?php } ?>