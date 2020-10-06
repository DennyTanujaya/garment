<?php
	session_start();
	if(!isset($_SESSION['nama_user'])){
		header("location:index.php");
	} else {
		date_default_timezone_set('Asia/Jakarta');
		include ("../config/connection.php");
		if(isset($_POST['submit'])){ //check if form was submitted
			$id = $_GET['id'];
			$modifyDate = date('d-m-Y  h:i:s a');
			$modifyBy = $_SESSION['nama_user'];
			
			$nama_customer = $_POST['nama_customer'];
			$alamat_customer = $_POST['alamat_customer'];
			$no_telepon_customer = $_POST['no_telepon_customer'];
			$kode_customer = $_POST['kode_customer'];
			
			if(mysqli_query($connect, "UPDATE customer SET nama_customer='$nama_customer', alamat_customer='$alamat_customer', no_telepon_customer='$no_telepon_customer', kode_customer='$kode_customer' WHERE id_customer = '$id'")){
				header("location:../views/customer.php?pesan='update'");
			} else {
				header("location:../views/customer.php?pesan='updategagal'");
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
			<h1>Customer Pages</h1>
		</div>
		<br/>
		<?php
			include "../config/connection.php";
			$id = $_GET['id'];
			$query_mysql = mysqli_query($connect,"select * from customer where id_customer = '$id'")or die(mysql_error());
			while($data = mysqli_fetch_array($query_mysql)){
		?>
		<div class="container">
			<h3>Update data baru</h3>
			<form action="#" method="post">		
				<div class="row">
					<div class="col-25">
						<label for="kode_customer">Kode Customer</label>
					</div>
					<div class="col-75">
						<input type="text" name="kode_customer" value="<?php echo $data['kode_customer']; ?>">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="nama_customer">Nama Customer</label>
					</div>
					<div class="col-75">
						<input type="text" name="nama_customer" value="<?php echo $data['nama_customer']; ?>">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="alamat_customer">Alamat Customer</label>
					</div>
					<div class="col-75">
						<textarea name="alamat_customer" style="height:200px"><?php echo $data['alamat_customer']; ?></textarea>
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="no_telepon_customer">Nomor Telepon Customer</label>
					</div>
					<div class="col-75">
						<input type="text" name="no_telepon_customer" value="<?php echo $data['no_telepon_customer']; ?>">
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