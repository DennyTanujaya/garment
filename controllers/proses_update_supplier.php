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
			
			$nama_supplier = $_POST['nama_supplier'];
			$alamat_supplier = $_POST['alamat_supplier'];
			$no_telepon_supplier = $_POST['no_telepon_supplier'];
			
			if(mysqli_query($connect, "UPDATE supplier SET nama_supplier='$nama_supplier', alamat_supplier='$alamat_supplier', no_tlp_supplier='$no_telepon_supplier' WHERE id_supplier = '$id'")){
				header("location:../views/supplier_list.php?pesan='update'");
			} else {
				header("location:../views/supplier_list.php?pesan='updategagal'");
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
			<h1>Supplier Pages</h1>
		</div>
		<br/>
		<?php
			include "../config/connection.php";
			$id = $_GET['id'];
			$query_mysql = mysqli_query($connect,"select * from supplier where id_supplier = '$id'")or die(mysql_error());
			while($data = mysqli_fetch_array($query_mysql)){
		?>
		<div class="container">
			<h3>Update data baru</h3>
			<form action="#" method="post">		
				<div class="row">
					<div class="col-25">
						<label for="nama_supplier">Nama Supplier</label>
					</div>
					<div class="col-75">
						<input type="text" name="nama_supplier" value="<?php echo $data['nama_supplier']; ?>">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="alamat_supplier">Alamat Supplier</label>
					</div>
					<div class="col-75">
						<textarea name="alamat_supplier" style="height:200px"><?php echo $data['alamat_supplier']; ?></textarea>
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="no_telepon_supplier">Nomor Telepon Supplier</label>
					</div>
					<div class="col-75">
						<input type="text" name="no_telepon_supplier" value="<?php echo $data['no_tlp_supplier']; ?>">
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