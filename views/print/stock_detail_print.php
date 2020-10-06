<?php
	session_start();
	if(!isset($_SESSION['nama_user'])){
		header("location:../index.php");
	} else {
		date_default_timezone_set('Asia/Jakarta');
		include ("../../config/connection.php");
		include ("../../assets/function.php");

		$no_seri = $_GET['no_seri'];
		$query_mysql = mysqli_query($connect,"select * from noseri JOIN stock ON stock.nomor_seri=noseri.no_seri WHERE nomor_seri='$no_seri' AND quantity > 0")or die(mysql_error());
		$stock = mysqli_fetch_array($query_mysql);
		
		$query_mysql_seri = mysqli_query($connect,"select * from noseri JOIN stock ON stock.nomor_seri=noseri.no_seri WHERE nomor_seri='$no_seri' AND quantity > 0")or die(mysql_error());
		$stockSeri = mysqli_fetch_all($query_mysql_seri);
		
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
			<h2>Stock Details</h2>
		</div>
		<br/>
		<div class="container">
			<div class="row">
				<div class="col-25">
					<label for="no_seri">No. Seri</label>
				</div>
				<div class="col-75">.
					<p><?php echo $stock['no_seri'];?></p>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="quantity">Quantity</label>
				</div>
				<div class="col-75">
					<p><?php echo $stock['qty'];?></p>
				</div>
			</div>
			
			<table border="1" class="demo-table">
				<tr>
					<th>No.</th>
					<th>No. PO</th>
					<th>No. Surat Jalan</th>
					<th>Tanggal Masuk</th>
					<th>Brand</th>
					<th>Nama Bahan</th>
					<th>Jenis Bahan</th>
					<th>Warna Bahan</th>
					<th>Quantity</th>
					<th>Satuan</th>
					<th>Size</th>
					<th>Harga Bahan</th>
				</tr>
				<?php
				$nomor=1;
				foreach($stockSeri as $row){
				?>
				<tr>
					<td><?php echo $nomor++; ?></td>
					<td><a href="purchase_order_details.php?no_po=<?php echo $row[5]; ?>"><?php echo $row[5]; ?></a></td>
					<td><?php echo $row[6]; ?></td>
					<td><?php echo $row[7]; ?></td>
					<td><?php echo $row[9]; ?></td>
					<td><?php echo $row[10]; ?></td>
					<td><?php echo $row[11]; ?></td>
					<td><?php echo $row[14]; ?></td>
					<td><?php echo $row[12]; ?></td>
					<td><?php echo $row[16]; ?></td>
					<td><?php echo $row[13]; ?></td>
					<td><?php echo rupiah($row[15]); ?></td>
				</tr>
				<?php } ?>
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