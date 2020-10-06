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
			$tanggal_gajian = $_GET['tanggal_penggajian'];
			$query_mysql = mysqli_query($connect,"select * from surat_jalan_sablon WHERE id_karyawan='$id' AND tanggal_gajian='$tanggal_gajian'");
			$data = mysqli_fetch_array($query_mysql);
			$query_mysql_salary = mysqli_query($connect,"select * from surat_jalan_sablon WHERE id_karyawan='$id' AND tanggal_gajian='$tanggal_gajian'");
			$dataSalary = mysqli_fetch_all($query_mysql_salary);
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
			<h2>Slip Gaji</h2>
		</div>
		<br/>
		<div class="container">
			<div class="row">
				<div class="col-25">
					<label for="nama_karyawan">Nama</label>
				</div>
				<div class="col-75">
					<p><?php echo $data['id_karyawan'];?></p>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="no_surat_jalan">No. Surat Jalan</label>
				</div>
				<div class="col-75">
					<p><?php echo $data['no_surat_jalan'];?></p>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="tanggal_gajian">Tanggal Cetak</label>
				</div>
				<div class="col-75">
					<p><?php echo $data['tanggal_gajian'];?></p>
				</div>
			</div>
			<br /><br />
			<table border="1" class="demo-table">
				<tr>
					<th>Quantity</th>
					<th>Warna</th>
					<th>Rincian Warna</th>
					<th>Deskripsi</th>
					<th>Tanggal Keluar</th>
					<th>Tanggal Masuk</th>
					<th>Harga Per Lusin</th>
					<th>Total</th>
				</tr>
				<?php
				$nomor=1;
				foreach($dataSalary as $row){
				?>
				<tr>
					<td><?php echo $row[9]; ?> Pcs</td>
					<td><?php echo $row[6]; ?></a></td>
					<td><?php echo $row[7]; ?></td>
					<td><?php echo $row[5]; ?></td>
					<td><?php echo $row[10]; ?></td>
					<td><?php echo $row[11]; ?></td>
					<td style="text-align:left">
						<?php
							$ongkos = $row[12];
							if(is_float($row[9] + 0)){
								$whole = (int) $row[9];  // 100
								$frac = $row[9] - $whole; // .09
								$fracInt = ltrim($frac, '0.');
								$desimal = round($fracInt/12, 2);
								$qty = $whole + $desimal;
								$total = $qty * $ongkos;
							}else if(is_numeric($row[9])){
								$desimal = $row[9];
								$total = $desimal * $ongkos;
							}
							$totalGaji[] = $total;
							echo $row[9].' x '.rupiah($ongkos);
						?>
					</td>
					<td>
						<?php
							echo rupiah($total);
						?>
					</td>
				</tr>
				<?php } ?>
				<tr>
					<td colspan="7">Total</td>
					<td>
					<?php
						$totalgaji = 0;
						foreach($totalGaji as $item){
							$totalgaji +=$item;
						}
						echo rupiah($totalgaji);
					?></td>
				</tr>
			</table>
	</div>
</div>
<script>
	window.print();
</script>
</body>
</html>
<?php } ?>