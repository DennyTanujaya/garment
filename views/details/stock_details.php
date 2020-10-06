<?php
	session_start();
	if(!isset($_SESSION['nama_user'])){
		header("location:../index.php");
	} else {
		date_default_timezone_set('Asia/Jakarta');
		include ("../../config/connection.php");
		include ("../../assets/function.php");

		$no_seri = $_GET['no_seri'];
		$query_mysql = mysqli_query($connect,"select * from noseri JOIN stock ON stock.nomor_seri=noseri.no_seri WHERE nomor_seri='$no_seri' AND quantity > 0");
		$stock = mysqli_fetch_array($query_mysql);
		
		$query_mysql_seri = mysqli_query($connect,"select * from noseri JOIN stock ON stock.nomor_seri=noseri.no_seri WHERE nomor_seri='$no_seri' AND quantity > 0");
		$stockSeri = mysqli_fetch_all($query_mysql_seri);
		
?>

<html>
<head>
	<title>Seranno</title>
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
<div class="content">
	<?php include('navbar.php'); ?>
	<div id="halaman">
		<div class="judul">		
			<h1>Details Stock</h1>
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
					<th>Nama Bahan</th>
					<th>Jenis Bahan</th>
					<th>Warna Bahan</th>
					<th>Quantity</th>
					<th>Size</th>
					<th>Harga Bahan</th>
					<th>Action</th>
				</tr>
				<?php
				$nomor=1;
				foreach($stockSeri as $row){
				?>
				<tr>
					<td><?php echo $nomor++; ?></td>
					<td><a href="purchase_order_details.php?no_po=<?php echo $row[6]; ?>"><?php echo $row[6]; ?></a></td>
					<td><?php echo $row[3]; ?></td>
					<td><?php echo $row[8]; ?></td>
					<td><?php echo $row[11]; ?></td>
					<td><?php echo $row[12] ?></td>
					<td><?php echo $row[15]; ?></td>
					<td><?php echo $row[13]; ?></td>
					<td><?php echo $row[14]; ?></td>
					<td><?php echo rupiah($row[16]); ?></td>
					<td>
						<a href="../../controllers/proses_update_stock.php?id=<?php echo $row[0]; ?>" class="ahrefButton">Edit</a>
						<a href="../../controllers/proses_hapus_stock.php?id=<?php echo $row[0]; ?>" onclick="return confirm(‘Yakin Hapus?’)" class="ahrefButton">Hapus</a>						
					</td>
				</tr>
				<?php } ?>
			</table>
		</div>
	</div>
</div>
</body>
</html>
<?php } ?>