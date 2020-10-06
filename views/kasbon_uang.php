<?php
	session_start();
	ini_set('display_errors', 1);
	error_reporting(E_ALL && ~E_NOTICE);
	if(!isset($_SESSION['nama_user'])){
		header("location:index.php");
	} else {
		date_default_timezone_set('Asia/Jakarta');
		include ("../config/connection.php");
		include ("../assets/function.php");
		if(isset($_POST['submitButtonKasbon'])){ //check if form was submitted
			$createDate = date('d-m-Y  h:i:s a');
			$createBy = $_SESSION['nama_user'];
			
			$id_karyawan = $_POST['id_karyawan'];
			$tanggal_kasbon = $_POST['tanggal_kasbon'];
			$jumlah = $_POST['jumlah'];
			$tenor = $_POST['tenor'];
			$note = $_POST['note'];
			
			if($tenor > 0 ){
				$jumlah_utang = round($jumlah / $tenor);
				for($i = 0; $i < $tenor; $i++){
					mysqli_query($connect, "INSERT INTO kasbon_uang (id_karyawan, tanggal_kasbon, jumlah, tenor, note, status, createDate, createBy) VALUES ('$id_karyawan', '$tanggal_kasbon', '$jumlah_utang', '$tenor', '$note', 'belum terbayar', '$createDate', '$createBy')")or die(mysqli_error($connect));
					header("location:kasbon_uang.php?pesan=input");
				}
			} else {
				mysqli_query($connect, "INSERT INTO kasbon_uang (id_karyawan, tanggal_kasbon, jumlah, tenor, note, status, createDate, createBy) VALUES ('$id_karyawan', '$tanggal_kasbon', '$jumlah', '$tenor', '$note', 'belum terbayar', '$createDate', '$createBy')")or die(mysqli_error($connect));
				if(mysqli_query){
					header("location:kasbon_uang.php?pesan=input");
				} else {
					header("location:kasbon_uang.php?pesan=inputgagal");
				}
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
	<script type="text/javascript">
		$('.amount').keyup(function() {
			var result = 0;
			$('#total').attr('value', function() {
				$('.amount').each(function() {
					if ($(this).val() !== '') {
						result += parseInt($(this).val());
					}
				});
				return result;
			});
		});
		
		$("#input2,#input1").keyup(function () {
			$('#output').val($('#input1').val() * $('#input2').val());
		});
		
		$(document).ready(function(){
			//group add limit
			var maxGroup = 10;
			
			//add more fields group
			$(".addMore").click(function(){
				if($('body').find('.fieldGroup').length < maxGroup){
					var fieldHTML = '<div class="form-group fieldGroup">'+$(".fieldGroupCopy").html()+'</div>';
					$('body').find('.fieldGroup:last').after(fieldHTML);
				}else{
					alert('Maximum '+maxGroup+' groups are allowed.');
				}
			});
			
			//remove fields group
			$("body").on("click",".remove",function(){ 
				$(this).parents(".fieldGroup").remove();
			});
		});
	</script>
</head>
<body>
<div class="content">
	<?php include('navbar.php'); ?>
	<div id="halaman">
		<div class="judul">		
			<h1>Kasbon Pages</h1>
		</div>
		<br/>
		<?php
		if(isset($_GET['pesan'])){
			if($_GET['pesan'] == 'input'){
				echo '<p>Berhasil input Kasbon!</p><br/>';
			} else if($_GET['pesan'] == 'inputgagal') {
				echo '<p>Gagal input Kasbon!</p><br/>';
			} else if($_GET['pesan'] == 'hapus') {
				echo '<p>Berhasil menghapus Kasbon!</p></br/>';
			} else if($_GET['pesan'] == 'gagalhapus'){ 
				echo '<p>Gagal menghapus Kasbon!</p></br/>';
			} else if($_GET['pesan'] == 'update'){ 
				echo '<p>Berhasil memperbaharui Kasbon!</p></br/>';
			} else if($_GET['pesan'] == 'updategagal'){ 
				echo '<p>Gagal memperbaharui Kasbon!</p></br/>';
			}
		}
		?>
		<div class="container">
		<form action="#" method="post">		
			<div class="row">
				<div class="col-25">
					<label for="no_invoice">Nama Karyawan</label>
				</div>
				<div class="col-75">
					<select id="karyawan" name="id_karyawan">
						<option value="" selected>Silahkan pilih Karyawan</option>
						<?php 
							include "../config/connection.php";
							$query_mysql = mysqli_query($connect,"select * from karyawan");
							while($data = mysqli_fetch_array($query_mysql)){
						?>
							<option value="<?php echo $data['id_karyawan'];?>"><?php echo $data['nama_karyawan'];?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="tanggal_kasbon">Tanggal Kasbon</label>
				</div>
				<div class="col-75">
					<input type="date" name="tanggal_kasbon">
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="jumlah">Jumlah</label>
				</div>
				<div class="col-75">
					<input type="text" name="jumlah">
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="tenor">Tenor</label>
				</div>
				<div class="col-75">
					<input type="text" name="tenor">
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="note">Note</label>
				</div>
				<div class="col-75">
					<textarea name="note" style="height:200px"></textarea>
				</div>
			</div>
			<br /><br />
			<div class="row">
				<input type="submit" value="Simpan" name="submitButtonKasbon">
			</div>
			
		</form>
		</div>
	</div>
	<div id="halaman">
		<div class="judul">		
			<h2>Kasbon Details</h1>
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
				<th>Nama Karyawan</th>
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
				$result = mysqli_query($connect,"select * from kasbon_uang LEFT JOIN karyawan ON karyawan.id_karyawan=kasbon_uang.id_karyawan WHERE nama_karyawan LIKE '%$search%' GROUP BY kasbon_uang.id_karyawan LIMIT $mulai, $halaman");
				$query_mysql = mysqli_query($connect,"select * from kasbon_uang LEFT JOIN karyawan ON karyawan.id_karyawan=kasbon_uang.id_karyawan WHERE nama_karyawan LIKE '%$search%' GROUP BY kasbon_uang.id_karyawan LIMIT $mulai, $halaman")or die(mysql_error());
			} else {
				$result = mysqli_query($connect,"select * from kasbon_uang GROUP BY id_karyawan");
				$query_mysql = mysqli_query($connect,"select * from kasbon_uang LEFT JOIN karyawan ON karyawan.id_karyawan=kasbon_uang.id_karyawan GROUP BY kasbon_uang.id_karyawan LIMIT $mulai, $halaman")or die(mysql_error());
			}
			$total = mysqli_num_rows($result);
			$pages = ceil($total/$halaman);            
			$nomor = $mulai+1;
			while($data = mysqli_fetch_array($query_mysql)){
			?>
			<tr>
				<td><?php echo $nomor++; ?></td>
				<td><?php echo $data['nama_karyawan']; ?></td>
				<td>
					<a href="details/detail_kasbon_uang.php?id_karyawan=<?php echo $data['id_karyawan']; ?>" class="ahrefButton">Detail</a>
					<!--<a href="print/penjualan_detail_print.php?no_invoice=<?php echo $data['id_karyawan']; ?>" target="_BLANK" class="ahrefButton">Print</a>
					<!--<a href="../controllers/proses_update_penjualan.php?id=<?php echo $data['id_karyawan']; ?>" class="ahrefButton">Edit</a> |
					<a href="../controllers/proses_hapus_penjualan.php?id=<?php echo $data['id_karyawan']; ?>" onclick="return confirm(‘Yakin Hapus?’)" class="ahrefButton">Hapus</a>-->			
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