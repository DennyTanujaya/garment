<?php
	session_start();
	if(!isset($_SESSION['nama_user'])){
		header("location:index.php");
	} else {
		date_default_timezone_set('Asia/Jakarta');
		include ("../config/connection.php");
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$query_mysql = mysqli_query($connect,"select * from surat_jalan_cmt WHERE no_surat_jalan='$id'");
			$data = mysqli_fetch_array($query_mysql);
			$query_mysql_seri = mysqli_query($connect,"select * from surat_jalan_cmt WHERE no_surat_jalan='$id'");
			$dataNoSeri = mysqli_fetch_all($query_mysql_seri);
			
			if(isset($_POST['buttonSubmitUpdate'])){ //check if form was submitted
				$id = $_GET['id'];
				$modifyDate = date('d-m-Y  h:i:s a');
				$modifyBy = $_SESSION['nama_user'];
				
				$no_seri = $_POST['no_seri'];
				$no_surat_jalan = $_POST['no_surat_jalan'];
				$quantity = $_POST['quantity'];
				$tanggal_masuk = $_POST['tanggal_masuk'];
				
				$jumlah = count($no_seri);
				for($i = 0; $i < $jumlah; $i++){
					$query_mysql_stock = mysqli_query($connect,"select * from noseri WHERE no_seri='$no_seri[$i]'");
					$dataStock = mysqli_fetch_array($query_mysql_stock);

					$qty_total = $dataStock['qty'] + $quantity[$i];
					mysqli_query($connect, "UPDATE noseri SET qty='$qty_total' WHERE no_seri='$no_seri[$i]'");
					//Insert Invoice
					mysqli_query($connect, "UPDATE surat_jalan_cmt SET quantity_masuk='$quantity[$i]', tanggal_masuk='$tanggal_masuk[$i]', status='Masuk' WHERE no_surat_jalan='$no_surat_jalan' AND no_seri='$no_seri[$i]'")or die(mysqli_error($connect));
					header("location:../views/surat_jalan_cmt.php?pesan='update'");
				}
			}
		} else {
			header("location:../home.php");
		}
?>

<html>
<head>
	<title>Seranno</title>
	<link rel="stylesheet" type="text/css" href="../assets/style.css">
	<script type="text/javascript" src="../assets/jquery.js"></script>
	<link rel="stylesheet" href="../assets/jquery/jquery-ui.css">
	<script src="../assets/jquery/jquery-ui.min.js"></script>
</head>
<body>
<div class="content">
	<?php include('navbar.php'); ?>
	<div id="halaman">
		<div class="judul">		
			<h1>Surat Jalan Bordir Pages</h1>
		</div>
		<br/>
		<?php
			include "../config/connection.php";
			$id = $_GET['id'];
			$query_mysql = mysqli_query($connect,"select * from surat_jalan_cmt where no_surat_jalan = '$id'")or die(mysqli_error($connect));
			$data = mysqli_fetch_array($query_mysql);
		?>
		<div class="container">
			<h3>Update data</h3>
			<form action="#" method="post">	
			<div class="row">
				<div class="col-25">
					<label for="no_invoice">Nama</label>
				</div>
				<div class="col-75">
					<input type="text" name="id_karyawan" value="<?php echo $data['id_karyawan']; ?>"readonly>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="no_surat_jalan">No. Surat Jalan</label>
				</div>
				<div class="col-75">
					<input type="text" name="no_surat_jalan" value="<?php echo $data['no_surat_jalan']; ?>" readonly>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="tanggal_cetak">Tanggal Cetak</label>
				</div>
				<div class="col-75">
					<input type="date" name="tanggal_gajian" value="<?php echo $data['tanggal_gajian']; ?>" readonly>
				</div>
			</div>
			
			<br /><br />
			<!-- Perhitungan No Seri -->
			<?php
				if(!empty($data['no_seri'])){
					foreach($dataNoSeri as $row){
			?>
			<div class="row">
				<div class="col-25">
					<label for="no_seri">No. Seri</label>
				</div>
				<div class="col-75">
					<input type="text" name="no_seri[]" value="<?php echo $row[4]; ?>" readonly>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="deskripsi">Deskripsi</label>
				</div>
				<div class="col-75">
					<input type="text" name="deskripsi[]" value="<?php echo $row[5]; ?>" readonly>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="warna">Warna</label>
				</div>
				<div class="col-75">
					<input type="text" name="warna[]" value="<?php echo $row[6]; ?>" readonly>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="rincian_warna">Rincian Warna</label>
				</div>
				<div class="col-75">
					<input type="text" name="rincian_warna[]" value="<?php echo $row[7]; ?>" readonly>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="quantity">Quantity</label>
				</div>
				<div class="col-75">
					<input type="text" name="quantity[]" value="<?php echo $row[8]; ?>">
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="tanggal_keluar">Tanggal Keluar</label>
				</div>
				<div class="col-75">
					<input type="date" name="tanggal_keluar[]" value="<?php echo $row[10]; ?>" readonly>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="tanggal_masuk">Tanggal Masuk</label>
				</div>
				<div class="col-75">
					<input type="date" name="tanggal_masuk[]" value="<?php echo $row[11]; ?>">
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="harga">Harga per Lusin</label>
				</div>
				<div class="col-75">
					<input type="text" name="harga[]" value="<?php echo $row[12]; ?>" readonly>
				</div>
			</div>
			<?php } 
				}
			?>
			<div class="row">
				<input type="submit" value="Simpan" name="buttonSubmitUpdate">
			</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>
<?php } ?>