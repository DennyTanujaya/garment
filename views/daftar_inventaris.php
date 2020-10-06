<?php
	session_start();
	if(!isset($_SESSION['nama_user'])){
		header("location:index.php");
	} else {
		date_default_timezone_set('Asia/Jakarta');
		include ("../config/connection.php");
		if(isset($_POST['submitButtonDaftar'])){ //check if form was submitted
			
			$createDate = date('d-m-Y  h:i:s a');
			$createBy = $_SESSION['nama_user'];
			
			$kode_barang = $_POST['kode_barang'];
			$nama_barang = $_POST['nama_barang'];
			
			$sql = "INSERT INTO daftar_inventaris (kode_barang, nama_barang) VALUES ('$kode_barang', '$nama_barang')";
			if(mysqli_query($connect, $sql)){
				header("location:daftar_inventaris.php?pesan=input");
			} else {
				header("location:daftar_inventaris.php?pesan=inputgagal");
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
			<h1>Daftar Inventaris Pages</h1>
		</div>
		<br/>
		<?php
		if(isset($_GET['pesan'])){
			if($_GET['pesan'] == 'input'){
				echo '<p>Berhasil input inventaris!</p><br/>';
			} else if($_GET['pesan'] == 'inputgagal') {
				echo '<p>Gagal input inventaris!</p><br/>';
			} else if($_GET['pesan'] == 'hapus') {
				echo '<p>Berhasil menghapus inventaris!</p></br/>';
			} else if($_GET['pesan'] == 'hapusgagal') {
				echo '<p>Gagal menghapus inventaris!</p></br/>';
			} else if($_GET['pesan'] == 'update') {
				echo '<p>Berhasil memperbaharui data inventaris!</p></br/>';
			} else if($_GET['pesan'] == 'updategagal') {
				echo '<p>Gagal memperbaharui data inventaris!</p></br/>';
			}
		}
		?>
		<div class="container">
		<h3>Input data baru</h3>
		<form action="#" method="post">		
			<div class="row">
				<div class="col-25">
					<label for="kode_barang">kode Barang</label>
				</div>
				<div class="col-75">
					<input type="text" name="kode_barang">
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="nama_barang">Nama Barang</label>
				</div>
				<div class="col-75">
					<input type="text" name="nama_barang">
				</div>
			</div>
			<div class="row">
				<input type="submit" value="Simpan" name="submitButtonDaftar">
			</div>
		</form>
		</div>
	</div>
	<div id="halaman">
		<div class="judul">		
			<h2>Daftar Inventaris</h1>
		</div>
		<br/>
		<form action="#" method="post">	
			<div class="col-30">
				<input type="text" name="search" placeholder="Ketik kata pencarian disini">
				<input type="submit" name="searchButton" value="Cari" hidden>
			</div>
			<br />
			<br />
		</form>
		<table border="1" class="demo-table">
			<tr>
				<th>No.</th>
				<th>Kode Barang</th>
				<th>Nama Barang</th>
				<th>Action</th>
			</tr>
			<?php 
			include "../config/connection.php";
			$halaman = 10;
			$page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
			$mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
			if(isset($_POST['searchButton']) OR isset($_GET['search'])){
				if(isset($_POST['search'])){
					$search = $_POST['search'];
				} else if (isset($_GET['search'])){
					$search = $_GET['search'];
				}
				$search = $_POST['search'];
				$result = mysqli_query($connect,"select * from daftar_inventaris WHERE nama_barang LIKE '%$search%' OR kode_barang LIKE '%$search%'");
				$query_mysql = mysqli_query($connect,"select * from daftar_inventaris WHERE nama_barang LIKE '%$search%' OR kode_barang LIKE '%$search%' LIMIT $mulai, $halaman")or die(mysql_error());
			} else {
				$result = mysqli_query($connect,"select * from daftar_inventaris");
				$query_mysql = mysqli_query($connect,"select * from daftar_inventaris LIMIT $mulai, $halaman")or die(mysql_error());
			}
			$total = mysqli_num_rows($result);
			$pages = ceil($total/$halaman);            
			$nomor = $mulai+1;
			while($data = mysqli_fetch_array($query_mysql)){
			?>
			<tr>
				<td><?php echo $nomor++; ?></td>
				<td><?php echo $data['kode_barang']; ?></td>
				<td><?php echo $data['nama_barang']; ?></td>
				<td>
					<a href="../controllers/proses_hapus_daftar_inventory.php?id=<?php echo $data['id_barang']; ?>" onclick="return confirm(‘Yakin Hapus?’)">Hapus</a>				
				</td>
			</tr>
			<?php
			} 
			?>
		</table>
		<div class="page">
			<?php 
				for ($i=1; $i<=$pages ; $i++){ 
					if(isset($_POST['search'])){
			?>
				<a href="?halaman=<?php echo $i; ?>&search=<?php echo $search;?>"><?php echo $i; ?></a>
					<?php } else { ?>
					<a href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a>
			<?php
				}
			}
			?>
		</div>
	</div>
</div>
</body>
</html>
<?php } ?>