<?php
	session_start();
	if(!isset($_SESSION['nama_user'])){
		header("location:../index.php");
	} else {
		date_default_timezone_set('Asia/Jakarta');
		include ("../../config/connection.php");
		include ("../../assets/function.php");
		
		if(isset($_GET['no_invoice'])){
			$id = $_GET['no_invoice'];
			$query_mysql = mysqli_query($connect,"select * from penjualan LEFT JOIN customer ON customer.id_customer = penjualan.id_customer WHERE penjualan.no_invoice='$id'");
			$data = mysqli_fetch_array($query_mysql);
			$query_mysql_seri = mysqli_query($connect,"select * from penjualan LEFT JOIN surat_jalan_penjualan ON surat_jalan_penjualan.no_surat_jalan=penjualan.no_surat_jalan_penjualan WHERE penjualan.no_invoice='$id'");
			$dataNoSeri = mysqli_fetch_all($query_mysql_seri);
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
			<h1>Details Penjualan</h1>
		</div>
		<br/>
		<div class="container">
			<div class="row">
				<div class="col-25">
					<label for="no_invoice">No. Invoice</label>
				</div>
				<div class="col-75">
					<p><?php echo $data['no_invoice'];?></p>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="tanggal_penjualan">Tanggal Penjualan</label>
				</div>
				<div class="col-75">
					<p><?php echo $data['tanggal_penjualan'];?></p>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="customer">Customer</label>
				</div>
				<div class="col-75">
					<p><?php echo $data['nama_customer'];?></p>
				</div>
			</div><br /><br />
			<table border="1" class="demo-table">
				<tr>
					<th>No.</th>
					<th>No. Surat Jalan</th>
					<th>Tanggal Surat Jalan</th>
					<th>No. Seri</th>
					<th>Quantity</th>
					<th>Description</th>
					<th>Harga Satuan</th>
					<th>Harga Total</th>
				</tr>
				<?php
				$nomor=1;
				$grandTotal = 0;
				foreach($dataNoSeri as $row){
					$total = $row[21] * $row[23];
				?>
				<tr>
					<td><?php echo $nomor++; ?></td>
					<td><?php echo $row[18]; ?></a></td>
					<td><?php echo $row[19]; ?></td>
					<td><?php echo $row[20]; ?></td>
					<td><?php echo $row[21]; ?></td>
					<td><?php echo $row[22]; ?></td>
					<td><?php echo rupiah($row[23]); ?></td>
					<td><?php echo rupiah($total); ?></td>
				</tr>
				<?php
					$grandTotal += $total;
				} 
				?>
				<tr>
					<td colspan="7">Total</td>
					<td><b><?php echo rupiah($grandTotal);?></b></td>
				</tr>
			</table>
	</div>
</div>
</body>
</html>
<?php } ?>