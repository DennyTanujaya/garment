<?php
	session_start();
	if(!isset($_SESSION['nama_user'])){
		header("location:index.php");
	} else {
		date_default_timezone_set('Asia/Jakarta');
		include ("../config/connection.php");
		if(isset($_POST['submitUpdateKaryawan'])){ //check if form was submitted
			$id = $_GET['id'];
			$modifyDate = date('d-m-Y  h:i:s a');
			$modifyBy = $_SESSION['nama_user'];
			
			$no_ktp = $_POST['no_ktp'];
			$nama_karyawan = $_POST['nama_karyawan'];
			$alamat_karyawan = $_POST['alamat_karyawan'];
			$no_telepon_karyawan = $_POST['no_telepon_karyawan'];
			$divisi = $_POST['divisi'];
			$lokasi = $_POST['lokasi'];
			$gaji = $_POST['gaji'];
			
			if(mysqli_query($connect, "UPDATE karyawan SET no_ktp='$no_ktp', nama_karyawan='$nama_karyawan', alamat_karyawan='$alamat_karyawan', no_telepon_karyawan='$no_telepon_karyawan', divisi='$divisi', lokasi='$lokasi', modifyBy='$modifyBy', modifyDate='$modifyDate', gaji_perjam='$gaji' WHERE id_karyawan = '$id'")or die(mysqli_error($connect))){
				header("location:../views/karyawan_list.php?pesan='update'");
			} else {
				header("location:../views/karyawan_list.php?pesan='updategagal'");
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
			<h1>Karyawan Pages</h1>
		</div>
		<br/>
		<?php
			include "../config/connection.php";
			$id = $_GET['id'];
			$query_mysql = mysqli_query($connect,"select * from karyawan where id_karyawan = '$id'")or die(mysql_error());
			$data = mysqli_fetch_array($query_mysql);
		?>
		<div class="container">
			<h3>Update data</h3>
			<form action="#" method="post">		
				<div class="row">
					<div class="col-25">
						<label for="no_ktp">No. KTP</label>
					</div>
					<div class="col-75">
						<input type="text" name="no_ktp" value="<?php echo $data['no_ktp'];?>">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="nama_karyawan">Nama Karyawan</label>
					</div>
					<div class="col-75">
						<input type="text" name="nama_karyawan" value="<?php echo $data['nama_karyawan'];?>">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="alamat_karyawan">Alamat Karyawan</label>
					</div>
					<div class="col-75">
						<textarea name="alamat_karyawan" style="height:200px"><?php echo $data['alamat_karyawan'];?></textarea>
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="no_telepon_karyawan">Nomor Telepon Karyawan</label>
					</div>
					<div class="col-75">
						<input type="text" name="no_telepon_karyawan" value="<?php echo $data['no_telepon_karyawan'];?>">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="divisi">Divisi</label>
					</div>
					<div class="col-75">
						<select name="divisi">
							<?php
								if($data['divisi'] == "Jahit") {
							?>
							<option value="Jahit" selected>Jahit</option>
							<option value="Obras">Obras</option>
							<option value="Packing">Packing</option>
							<option value="Supir">Supir</option>
							<?php } else if($data['divisi'] == "Obras") {
							?>
							<option value="Jahit">Jahit</option>
							<option value="Obras" selected>Obras</option>
							<option value="Packing">Packing</option>
							<option value="Supir">Supir</option>
							<?php } else if($data['divisi'] == "Packing") {
							?>
							<option value="Jahit">Jahit</option>
							<option value="Obras">Obras</option>
							<option value="Packing" selected>Packing</option>
							<option value="Supir">Supir</option>
							<?php } else if($data['divisi'] == "Supir") {
							?>
							<option value="Jahit">Jahit</option>
							<option value="Obras">Obras</option>
							<option value="Packing">Packing</option>
							<option value="Supir" selected>Supir</option>
							<?php } else { ?>
							<option value="">Silahkan pilih divisi</option>
							<option value="Jahit">Jahit</option>
							<option value="Obras">Obras</option>
							<option value="Packing">Packing</option>
							<option value="Supir">Supir</option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="lokasi">Lokasi</label>
					</div>
					<div class="col-75">
						<select name="lokasi">
							<?php
								if($data['lokasi'] == "Cengkareng"){
							?>
							<option value="Cengkareng" selected>Cengkareng</option>
							<option value="Dadap">Dadap</option>
							<?php } else if($data['lokasi'] == "Dadap"){
							?>
							<option value="Cengkareng" >Cengkareng</option>
							<option value="Dadap" selected>Dadap</option>
							<?php } else {?>
							<option value="">Silahkan pilih Lokasi</option>
							<option value="Cengkareng">Cengkareng</option>
							<option value="Dadap">Dadap</option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="gaji">Gaji per Jam</label>
					</div>
					<div class="col-75">
						<input type="text" name="gaji" value="<?php echo $data['gaji_perjam'];?>">
					</div>
				</div>
				<div class="row">
					<input type="submit" value="Simpan" name="submitUpdateKaryawan">
				</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>
<?php } ?>