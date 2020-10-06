<?php
	session_start();
	if(!isset($_SESSION['nama_user'])){
		header("location:index.php");
	} else {
		date_default_timezone_set('Asia/Jakarta');
		include ("../config/connection.php");
		include ("../assets/function.php");
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$query_mysql = mysqli_query($connect,"select * from kasbon_uang WHERE id_kasbon='$id'");
			$data = mysqli_fetch_array($query_mysql);
			
			if(isset($_POST['buttonSubmitUpdate'])){ //check if form was submitted
				$id = $_GET['id'];
				$tanggal_gajian = $_POST['tanggal_gajian'];
				
				mysqli_query($connect, "UPDATE kasbon_uang SET tanggal_gajian='$tanggal_gajian', status='Terbayarkan' WHERE id_kasbon='$id'");
				header("location:../views/kasbon_uang.php?pesan='update'");
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
			<h1>Kasbon Uang Pages</h1>
		</div>
		<br/>
		<?php
			include "../config/connection.php";
			$id = $_GET['id'];
			$query_mysql = mysqli_query($connect,"select * from kasbon_uang JOIN karyawan ON karyawan.id_karyawan=kasbon_uang.id_karyawan where id_kasbon = '$id'")or die(mysqli_error($connect));
			$data = mysqli_fetch_array($query_mysql);
		?>
		<div class="container">
			<h3>Update data</h3>
			<form action="#" method="post">	
			<div class="row">
				<div class="col-25">
					<label for="nama">Nama</label>
				</div>
				<div class="col-75">
					<input type="text" name="id_karyawan" value="<?php echo $data['nama_karyawan']; ?>"readonly>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="tanggal_kasbon">Tanggal Kasbon</label>
				</div>
				<div class="col-75">
					<input type="text" name="tanggal_kasbon" value="<?php echo $data['tanggal_kasbon']; ?>" readonly>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="tanggal_gajian">Tanggal Gajian</label>
				</div>
				<div class="col-75">
					<input type="date" name="tanggal_gajian" value="<?php echo $data['tanggal_gajian']; ?>">
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="jumlah">Jumlah</label>
				</div>
				<div class="col-75">
					<input type="text" name="jumlah" value="<?php echo rupiah($data['jumlah']); ?>">
				</div>
			</div>
			
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