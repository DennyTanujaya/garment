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
			<h2>Invoice</h2>
		</div>
		<br/>
		<div class="container">
			<div class="row">
				<div class="col-30">
				<?php echo $data['seller']; ?><br />
				Jl. Galunggung Blok D 1 No. 38<br />
				Cengkareng<br />
				Telp: 021-5456835 Handphone: 08119444988
				</div>
				<div class="col-75">
					No. Invoice: <?php echo $data['no_invoice'];?><br />
					Tanggal Penjualan: <?php echo $data['tanggal_penjualan'];?><br />
					Customer: <?php echo $data['nama_customer'];?>
				</div>
			</div>
			<br /><br />
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
			<?php 
				if(!empty($data['note'])){
			?>
			<div class="row">
				<div class="col-75">
					<p>Notes:</p>
					<p><?php echo $data['note']; ?></p>
				</div>
			</div>
			<?php } ?>
			<div class="row">
				<div class="col-75">
					<p>Pembayaran harap transfer ke Rekening:</p>
					<p><?php echo $data['nama_rekening']; ?>
					<p><?php echo 'Cabang '.$data['cabang']; ?>
					<p><?php echo $data['nomor_rekening'].' A/N '.$data['atas_nama']; ?></p>
				</div>
				<div class="col-30">
					Hormat Kami,
					<br /><br /><br /><br />
					Jiu Nobellius Kimsanto
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	window.print();
</script>
</body>
</html>
<?php } ?>