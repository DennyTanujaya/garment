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
			
			$no_po = $_POST['no_po'];
			$tanggal_masuk = $_POST['tanggal_masuk'];
			$nomor_seri = $_POST['nomor_seri'];
			$merek_stock = $_POST['merek'];
			$nama_bahan = $_POST['nama_bahan'];
			$jenis_bahan = $_POST['jenis_bahan'];
			$quantity = $_POST['quantity'];
			$size = $_POST['size'];
			$warna_bahan = $_POST['warna_bahan'];
			$harga_bahan = $_POST['harga_bahan'];
			$satuan = $_POST['satuan'];
			
			if(mysqli_query($connect, "UPDATE stock SET tanggal_masuk='$tanggal_masuk', nomor_seri='$nomor_seri', merek_stock='$merek_stock', nama_bahan='$nama_bahan', jenis_bahan='$jenis_bahan', quantity='$quantity', size='$size', warna_bahan='$warna_bahan', harga_bahan='$harga_bahan', satuan='$satuan', modifyBy='$modifyBy', modifyDate='$modifyDate' WHERE id_stock = '$id'")){
				header("location:../views/stock_list.php?pesan=update");
			} else {
				header("location:../views/stock_list.php?pesan=updategagal");
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
			<h1>Stock Pages</h1>
		</div>
		<br/>
		<?php
			include "../config/connection.php";
			$id = $_GET['id'];
			$query_mysql = mysqli_query($connect,"select * from stock where id_stock = '$id'")or die(mysql_error());
			while($data = mysqli_fetch_array($query_mysql)){
		?>
		<div class="container">
			<h3>Update data</h3>
			<form action="#" method="post">		
				<div class="row">
					<div class="col-25">
						<label for="no_po">Nomor PO</label>
					</div>
					<div class="col-75">
						<input type="text" name="no_po" value="<?php echo $data['id_purchase_order']; ?>" >
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="tanggal_masuk">Tanggal Masuk</label>
					</div>
					<div class="col-75">
						<input type="text" name="tanggal_masuk" id='my_date_picker1' value="<?php echo $data['tanggal_masuk']; ?>">
					</div>
				</div>
				<div class="row">
				<div class="col-25">
					<label for="nomor_seri">Nomor Seri</label>
				</div>
				<div class="col-75">
					<input type="text" name="nomor_seri" value="<?php echo $data['nomor_seri']; ?>">
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="merek_stock">Merek</label>
				</div>
				<div class="col-75">
					<select name="merek">
						<?php if($data['merek_stock'] == 'Phank') { ?>
							<option value="Phank" selected>Phank</option>
							<option value="Theda">Theda</option>
							<option value="Seranno">Seranno</option>
							<option value="Sielie">Sielie</option>
						<?php } else if($data['merek_stock'] == 'Theda') {?>
							<option value="Theda" selected>Theda</option>
							<option value="Phank">Phank</option>
							<option value="Seranno">Seranno</option>
							<option value="Sielie">Sielie</option>
						<?php } else if($data['merek_stock'] == 'Seranno') {?>
							<option value="Sielie" selected>Sielie</option>
							<option value="Phank">Phank</option>
							<option value="Theda">Theda</option>
							<option value="Seranno">Seranno</option>
						<?php } else { ?>
						<option value="">Silahkan Pilih Merek</option>
						<option value="Phank">Phank</option>
						<option value="Theda">Theda</option>
						<option value="Seranno">Seranno</option>
						<option value="Sielie">Sielie</option>
						<?php } ?>
					</select>
				</div>
			</div>
				<div class="row">
					<div class="col-25">
						<label for="nama_bahan">Nama Bahan</label>
					</div>
					<div class="col-75">
						<input type="text" name="nama_bahan" value="<?php echo $data['nama_bahan']; ?>">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="jenis_bahan">Jenis Bahan</label>
					</div>
					<div class="col-75">
						<input type="text" name="jenis_bahan" value="<?php echo $data['jenis_bahan']; ?>">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="quantity">Quantity</label>
					</div>
					<div class="col-75">
						<input type="text" name="quantity" value="<?php echo $data['quantity']; ?>">
					</div>
				</div>
				<div class="row">
				<div class="col-25">
					<label for="Size">Size</label>
				</div>
				<div class="col-75">
					<select name="size">
						<?php if($data['size'] == 'Small') { ?>
						<option value="Small" Selected>Small</option>
						<option value="Medium">Medium</option>
						<option value="Large">Large</option>
						<option value="Extra Large">Extra Large</option>
						<option value="Dewasa">Dewasa</option>
						<option value="Jumbo">Jumbo</option>
						<option value="Tanggung Badan">Tanggung Badan</option>
						<?php } else if($data['size'] == 'Medium') { ?>
						<option value="Small">Small</option>
						<option value="Medium" selected>Medium</option>
						<option value="Large">Large</option>
						<option value="Extra Large">Extra Large</option>
						<option value="Dewasa">Dewasa</option>
						<option value="Jumbo">Jumbo</option>
						<option value="Tanggung Badan">Tanggung Badan</option>
						<?php } else if($data['size'] == 'Large') { ?>
						<option value="Small">Small</option>
						<option value="Medium">Medium</option>
						<option value="Large" selected>Large</option>
						<option value="Extra Large">Extra Large</option>
						<option value="Dewasa">Dewasa</option>
						<option value="Jumbo">Jumbo</option>
						<option value="Tanggung Badan">Tanggung Badan</option>
						<?php } else if($data['size'] == 'Extra Large') { ?>
						<option value="Small">Small</option>
						<option value="Medium">Medium</option>
						<option value="Large">Large</option>
						<option value="Extra Large" selected>Extra Large</option>
						<option value="Dewasa">Dewasa</option>
						<option value="Jumbo">Jumbo</option>
						<option value="Tanggung Badan">Tanggung Badan</option>
						<?php } else if($data['size'] == 'Dewasa') { ?>
						<option value="Small">Small</option>
						<option value="Medium">Medium</option>
						<option value="Large">Large</option>
						<option value="Extra Large">Extra Large</option>
						<option value="Dewasa" selected>Dewasa</option>
						<option value="Jumbo">Jumbo</option>
						<option value="Tanggung Badan">Tanggung Badan</option>
						<?php } else if($data['size'] == 'Jumbo') { ?>
						<option value="Small">Small</option>
						<option value="Medium">Medium</option>
						<option value="Large">Large</option>
						<option value="Extra Large">Extra Large</option>
						<option value="Dewasa">Dewasa</option>
						<option value="Jumbo" selected>Jumbo</option>
						<option value="Tanggung Badan">Tanggung Badan</option>
						<?php } else if($data['size'] == 'Tanggung Badan') { ?>
						<option value="Small">Small</option>
						<option value="Medium">Medium</option>
						<option value="Large">Large</option>
						<option value="Extra Large">Extra Large</option>
						<option value="Dewasa">Dewasa</option>
						<option value="Jumbo">Jumbo</option>
						<option value="Tanggung Badan" selected>Tanggung Badan</option>
						<?php } ?>
						<option value="">Silahkan Pilih Size</option>
						<option value="Small">Small</option>
						<option value="Medium">Medium</option>
						<option value="Large">Large</option>
						<option value="Extra Large">Extra Large</option>
						<option value="Dewasa">Dewasa</option>
						<option value="Jumbo">Jumbo</option>
						<option value="Tanggung Badan">Tanggung Badan</option>
					</select>
				</div>
			</div>
				<div class="row">
					<div class="col-25">
						<label for="warna_bahan">Warna Bahan</label>
					</div>
					<div class="col-75">
						<input type="text" name="warna_bahan" value="<?php echo $data['warna_bahan']; ?>">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="harga_bahan">Harga Bahan</label>
					</div>
					<div class="col-75">
						<input type="text" name="harga_bahan" value="<?php echo $data['harga_bahan']; ?>">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="satuan">Satuan</label>
					</div>
					<div class="col-75">
						<select name="satuan">
							<?php
								if($data['satuan'] == 'Rol'){
							?>
							<option value="Rol" selected>Rol</option>
							<option value="Lusin">Lusin</option>
							<option value="Kilo">Kilo</option>
							<?php } else if($data['satuan'] == 'Lusin'){ ?>
							<option value="Lusin" selected>Lusin</option>
							<option value="Rol">Rol</option>
							<option value="Kilo">Kilo</option>
							<?php } else { ?>
							<option value="">Silahkan pilih satuan</option>
							<option value="Rol">Rol</option>
							<option value="Kilo">Kilo</option>
							<option value="Lusin">Lusin</option>
							<?php } ?>
						</select>
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