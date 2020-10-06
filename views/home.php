<?php
	session_start();
	if(!isset($_SESSION['nama_user'])){
		header("location:index.php");
	} else {
		
		date_default_timezone_set('Asia/Jakarta');
		include ("../config/connection.php");
		if(isset($_POST['submitButtonUbahPassword'])){ //check if form was submitted
			
			$nama_user = $_POST['nama_user'];
			$id_user = $_POST['id_user'];
			$password_baru = $_POST['password_baru'];
			
			$sql = "UPDATE users SET pass_user='$password_baru', status='1' WHERE id_user='$id_user'";
			if(mysqli_query($connect, $sql)){
				header("location:home.php?pesan=berhasil");
			} else {
				header("location:home.php?pesan=gagal");
			}
		}
?>

<html>
<head>
	<title>Seranno</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../assets/style.css">
	<script type="text/javascript" src="../assets/jquery.js"></script>
	<link rel="stylesheet" href="../assets/jquery/jquery-ui.css">
	<script type="text/javascript" src="../assets/Chart.js"></script>
	<script src="../assets/jquery/jquery-ui.min.js"></script>
</head>
<body>
<div class="content">
	<?php 
		include('navbar.php');
		if(isset($_GET['pesan'])){
			if($_GET['pesan'] == 'berhasil'){
				echo '<p>Berhasil Ubah Password!</p><br/>';
			} else if($_GET['pesan'] == 'gagal') {
				echo '<p>Gagal Ubah Password!</p><br/>';
			}
		}
		$nick = $_SESSION['nama_user'];
		$query_mysql = mysqli_query($connect,"select * from users WHERE nama_user ='$nick'");
		$data = mysqli_fetch_array($query_mysql);
		if($data['status'] == '0'){
			
	?>
	<div id="halaman">
		<div class="judul">		
			<h1>Ubah Password</h1>
		</div>
		<br/>
		<div class="container">
			<h3>Ubah Password</h3>
			<form action="#" method="post">		
				<div class="row">
					<div class="col-25">
						<label for="Nama">Nama</label>
					</div>
					<div class="col-75">
						<input type="text" name="nama_user" value="<?php echo $data['nama_user']; ?>" readonly>
						<input type="text" name="id_user" value="<?php echo $data['id_user']; ?>" hidden>
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="password_baru">Password Baru</label>
					</div>
					<div class="col-75">
						<input type="text" name="password_baru">
					</div>
				</div>
				<div class="row">
					<input type="submit" value="Simpan" name="submitButtonUbahPassword">
				</div>
			</form>
		</div>
	</div>
	<?php } ?>
</div>
</body>
</html>
<?php } ?>