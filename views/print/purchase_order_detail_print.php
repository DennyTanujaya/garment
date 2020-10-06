<?php
	session_start();
	if(!isset($_SESSION['nama_user'])){
		header("location:../index.php");
	} else {
		date_default_timezone_set('Asia/Jakarta');
		include ("../../config/connection.php");
		include ("../../assets/function.php");
		
		if(isset($_GET['id_purchase_order'])){
			$id = $_GET['id_purchase_order'];
			$query_mysql = mysqli_query($connect,"select * from purchase_order LEFT JOIN supplier ON supplier.id_supplier = purchase_order.id_supplier WHERE purchase_order.id_purchase_order='$id'")or die(mysql_error());
			$data = mysqli_fetch_assoc($query_mysql);
			$dataPO = mysqli_fetch_all($query_mysql);
			$totalPO = mysqli_num_rows($query_mysql);
		} else if(isset($_GET['no_po'])) {
			$no_po = $_GET['no_po'];
			$query_mysql = mysqli_query($connect,"select * from purchase_order LEFT JOIN supplier ON supplier.id_supplier = purchase_order.id_supplier WHERE purchase_order.no_po='$no_po'")or die(mysql_error());
			$data = mysqli_fetch_array($query_mysql);
			$query_mysql_po = mysqli_query($connect,"select * from purchase_order LEFT JOIN supplier ON supplier.id_supplier = purchase_order.id_supplier WHERE purchase_order.no_po='$no_po'")or die(mysql_error());
			$dataPO = mysqli_fetch_all($query_mysql_po);
			$totalPO = mysqli_num_rows($query_mysql);
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
	<script type="text/javascript">
		$('.amount').keyup(function() {
			var result = 0;
			$('#total').attr('value', function() {
				$('.amount').each(function() {
					if ($(this).val() !== '') {
						result += parseInt($(this).val());
					}
				});
				return result;
			});
		});
		
		$("#input2,#input1").keyup(function () {
			$('#output').val($('#input1').val() * $('#input2').val());
		});
	</script>
</head>
<body>
<div class="content_print">
	<div id="halaman">
		<div class="judul">		
			<h2>Purchase Order Details</h2>
		</div>
		<br/>
		<div class="container">
			<div class="row">
				<div class="col-25">
					<label for="no_po">No. PO</label>
				</div>
				<div class="col-75">.
					<p><?php echo $data['no_po'];?></p>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="tgl_pembelian">Tanggal Pembelian</label>
				</div>
				<div class="col-75">
					<p><?php echo $data['tgl_pembelian'];?></p>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="tgl_masuk_barang">Tanggal Masuk Barang</label>
				</div>
				<div class="col-75">
					<p><?php echo $data['tgl_masuk_barang'];?></p>
				</div>
			</div>	
			<div class="row">
				<div class="col-25">
					<label for="No. Surat Jalan">No. Surat Jalan</label>
				</div>
				<div class="col-75">
					<p><?php echo $data['no_surat_jalan'];?></p>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="supplier">Supplier</label>
				</div>
				<div class="col-75">
					<p><?php echo $data['nama_supplier'];?></p>
				</div>
			</div>
			
			<table border="1" class="demo-table">
				<tr>
					<th>No.</th>
					<th>Nama Bahan</th>
					<th>Jenis Bahan</th>
					<th>Warna Bahan</th>
					<th>Bahan Per Roll</th>
					<th>Bahan Per Kilo</th>
					<th>Harga Per Kilo</th>
					<th>Total Harga Bahan</th>
				</tr>
				<?php
				$nomor=1;
				$grandTotal = 0;
				foreach($dataPO as $row){
					$total = $row[11] * $row[12];
					$grandTotal += $total;
				?>
				<tr>
					<td><?php echo $nomor++; ?></td>
					<td><?php echo $row[7]; ?></a></td>
					<td><?php echo $row[8]; ?></td>
					<td><?php echo $row[9]; ?></td>
					<td><?php echo $row[20]; ?></td>
					<td><?php echo $row[11]; ?></td>
					<td><?php echo rupiah($row[12]); ?></td>
					<td><?php echo rupiah($total); ?></td>
				</tr>
				<?php } ?>
				<tr>
					<td colspan="7">Total</td>
					<td><?php echo rupiah($grandTotal);?></td>
				</tr>
			</table>
		</div>
	</div>
</div>
	<script>
		window.print();
	</script>
</body>
</html>
<?php } ?>