<?php
	session_start();
	if(!isset($_SESSION['nama_user'])){
		header("location:../index.php");
	} else {
		date_default_timezone_set('Asia/Jakarta');
		include ("../config/connection.php");
		if(isset($_POST['submit'])){ //check if form was submitted
			$id = $_GET['id'];
			$modifyDate = date('d-m-Y  h:i:s a');
			$modifyBy = $_SESSION['nama_user'];
			
			$harga = $_POST['harga'];
			
			if(mysqli_query($connect, "UPDATE salary_saldo SET harga='$harga' WHERE id_salary_saldo = '$id'")){
				header("location:../views/salary_saldo.php?pesan='update'");
			} else {
				header("location:../views/salary_saldo.php?pesan='updategagal'");
			}
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
			<h1>Salary Saldo Pages</h1>
		</div>
		<br/>
		<?php
			include "../config/connection.php";
			$id = $_GET['id'];
			$query_mysql = mysqli_query($connect,"select * from salary_saldo where id_salary_saldo = '$id'")or die(mysql_error());
			while($data = mysqli_fetch_array($query_mysql)){
		?>
		<div class="container">
			<h3>Update data baru</h3>
			<form action="#" method="post">		
				<div class="row">
					<div class="col-25">
						<label for="jenis_kegiatan">Jenis Kegiatan</label>
					</div>
					<div class="col-75">
						<input type="text" name="jenis_kegiatan" value="<?php echo $data['jenis_kegiatan']; ?>" readonly>
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="size">Size</label>
					</div>
					<div class="col-75">
						<input type="text" name="size" value="<?php echo $data['size']; ?>" readonly>
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="lokasi">Lokasi</label>
					</div>
					<div class="col-75">
						<input type="text" name="lokasi" value="<?php echo $data['lokasi']; ?>" readonly>
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="Harga">Harga</label>
					</div>
					<div class="col-75">
						<input type="text" name="harga" value="<?php echo $data['harga']; ?>">
					</div>
				</div>
				<?php } ?>
				<div class="row">
					<input type="submit" value="Simpan" name="submit">
				</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>
<?php } ?>