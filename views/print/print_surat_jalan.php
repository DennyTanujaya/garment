<?php
	session_start();
	if(!isset($_SESSION['nama_user'])){
		header("location:../index.php");
	} else {
		date_default_timezone_set('Asia/Jakarta');
		include ("../../config/connection.php");
		include ("../../assets/function.php");
		if(isset($_GET['id'])){
		$no_surat_jalan = $_GET['id'];
		$query_mysql = mysqli_query($connect,"select * from surat_jalan WHERE no_surat_jalan='$no_surat_jalan'");
		$surat_jalan = mysqli_fetch_array($query_mysql);
		
		$query_mysql_surat = mysqli_query($connect,"select * from surat_jalan WHERE no_surat_jalan='$no_surat_jalan'");
		$surat_jalan_all = mysqli_fetch_all($query_mysql_surat);
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
			<h2>Surat Jalan</h2>
		</div>
		<br/>
		<div class="container">
			<div class="row">
				<div class="col-25">
					<label for="no_surat_jalan">No. Surat Jalan</label>
				</div>
				<div class="col-75">.
					<p><?php echo $surat_jalan['no_surat_jalan'];?></p>
				</div>
			</div>
			<?php
				if($surat_jalan['no_po'] != 'Vendor'){
			?>
			<div class="row">
				<div class="col-25">
					<label for="no_po">No. PO</label>
				</div>
				<div class="col-75">
					<p><?php echo $surat_jalan['no_po'];?></p>
				</div>
			</div>
			<?php } ?>
			<div class="row">
				<div class="col-25">
					<label for="tanggal_surat_jalan">Tanggal Surat Jalan</label>
				</div>
				<div class="col-75">
					<p><?php echo $surat_jalan['tanggal_surat_jalan'];?></p>
				</div>
			</div>
			<table border="1" class="demo-table">
				<tr>
					<th>No.</th>
					<th>No. Seri</th>
					<th>Nama Vendor</th>
					<th>Quantity</th>
					<th>Description</th>
				</tr>
				<?php
				$nomor=1;
				foreach($surat_jalan_all as $row){
				?>
				<tr>
					<td><?php echo $nomor++; ?></td>
					<td><?php echo $row[3]; ?></td>
					<td><?php echo $row[5]; ?></td>
					<td><?php echo $row[6]; ?></td>
					<td><?php echo $row[7]; ?></td>
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