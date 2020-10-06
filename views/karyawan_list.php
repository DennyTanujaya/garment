<?php
	session_start();
	if(!isset($_SESSION['nama_user'])){
		header("location:index.php");
	} else {
		date_default_timezone_set('Asia/Jakarta');
		include ("../config/connection.php");
		include ("../assets/function.php");
		if(isset($_POST['submitButtonKaryawan'])){ //check if form was submitted
			
			$createDate = date('d-m-Y  h:i:s a');
			$createBy = $_SESSION['nama_user'];
			
			$no_ktp = $_POST['no_ktp'];
			$nama_karyawan = $_POST['nama_karyawan'];
			$alamat_karyawan = $_POST['alamat_karyawan'];
			$no_telepon_karyawan = $_POST['no_telepon_karyawan'];
			$divisi = $_POST['divisi'];
			$sub_divisi = $_POST['sub_divisi'];
			$lokasi = $_POST['lokasi'];
			$gaji_perjam = $_POST['gaji_perjam'];
			
			$sql = "INSERT INTO karyawan (no_ktp, nama_karyawan, alamat_karyawan, no_telepon_karyawan, lokasi, divisi, sub_divisi, createBy, createDate, gaji_perjam) VALUES ('$no_ktp', '$nama_karyawan', '$alamat_karyawan', '$no_telepon_karyawan', '$lokasi', '$sub_divisi', '$divisi', '$createBy', '$createDate', '$gaji_perjam')";
			if(mysqli_query($connect, $sql)){
				header("location:karyawan_list.php?pesan=input");
			} else {
				header("location:karyawan_list.php?pesan=inputgagal");
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
		
		$(document).ready(function() {
			var max_fields      = 10; //maximum input boxes allowed
			var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
			var add_button      = $(".add_field_button"); //Add button ID
			
			var x = 1; //initlal text box count
			$(add_button).click(function(e){ //on add input button click
				e.preventDefault();
				if(x < max_fields){ //max input box allowed
					x++; //text box increment
					$(wrapper).append('<div><div class="row"><div class="col-25"><label for="nama_bahan">Nama Bahan</label></div><div class="col-75"><input type="text" name="nama_bahan[]"></div></div><div class="row"><div class="col-25"><label for="jenis_bahan">Jenis Bahan</label></div><div class="col-75"><input type="text" name="jenis_bahan[]"></div></div><div class="row"><div class="col-25"><label for="bahan_per_roll">Bahan Per Roll</label></div><div class="col-75"><input type="text" name="jumlah_bahan[]"></div></div><div class="row"><div class="col-25"><label for="perKilo">Bahan Per Kilo</label></div><div class="col-75"><input type="text" name="perKilo[]"></div></div><div class="row"><div class="col-25"><label for="harga_per_kilo">Harga Per Kilo</label></div><div class="col-75"><input type="text" id="input2" name="harga_per_kilo[]"></div></div><div class="row"><div class="col-25"><label for="harga_total">Harga Total</label></div><div class="col-75"><input type="text" id="output" name="total[]" readonly></div></div><a href="#" class="remove_field">Remove</a></div>'); //add input box
				}
			});
			
			$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
				e.preventDefault(); $(this).parent('div').remove(); x--;
			})
		});
	</script>
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
		if(isset($_GET['pesan'])){
			if($_GET['pesan'] == 'input'){
				echo '<p>Berhasil input Karyawan!</p><br/>';
			} else if($_GET['pesan'] == 'inputgagal') {
				echo '<p>Gagal input Karyawan!</p><br/>';
			} else if($_GET['pesan'] == 'hapus') {
				echo '<p>Berhasil menghapus Karyawan!</p></br/>';
			} else if($_GET['pesan'] == 'hapusgagal') {
				echo '<p>Gagal menghapus Karyawan!</p></br/>';
			} else if($_GET['pesan'] == 'update') {
				echo '<p>Berhasil memperbaharui data Karyawan!</p></br/>';
			} else if($_GET['pesan'] == 'updategagal') {
				echo '<p>Gagal memperbaharui data Karyawan!</p></br/>';
			}
		}
		?>
		<div class="container">
		<h3>Input data baru</h3>
		<form action="#" method="post">
			<div class="row">
				<div class="col-25">
					<label for="no_ktp">No. KTP</label>
				</div>
				<div class="col-75">
					<input type="text" name="no_ktp">
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="nama_karyawan">Nama Karyawan</label>
				</div>
				<div class="col-75">
					<input type="text" name="nama_karyawan">
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="alamat_supplier">Alamat Karyawan</label>
				</div>
				<div class="col-75">
					<textarea name="alamat_karyawan" style="height:200px"></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="no_telepon_supplier">Nomor Telepon Karyawan</label>
				</div>
				<div class="col-75">
					<input type="text" name="no_telepon_karyawan">
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="divisi">Divisi</label>
				</div>
				<div class="col-75">
					<select name="divisi">
						<option value="">Silahkan pilih divisi</option>
						<option value="Potong">Potong</option>
						<option value="Jahit">Jahit</option>
						<option value="Obras">Obras</option>
						<option value="Sablon">Sablon</option>
						<option value="Packing">Packing</option>
						<option value="Supir">Supir</option>
						<option value="Other">Other</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="sub_divisi">Sub Divisi</label>
				</div>
				<div class="col-75">
					<select name="sub_divisi">
						<option value="">Silahkan pilih sub divisi</option>
						<option value="sub_div_1">Sub Divisi 1</option>
						<option value="sub_div_2">Sub Divisi 2</option>
						<option value="sub_div_3">Sub Divisi 3</option>
						<option value="sub_div_4">Sub Divisi 4</option>
						<option value="sub_div_5">Sub Divisi 5</option>
						<option value="sub_div_5">Sub Divisi 6</option>
						<option value="sub_div_5">Sub Divisi 7</option>
						<option value="sub_div_5">Sub Divisi 8</option>
						<option value="sub_div_5">Sub Divisi 9</option>
						<option value="sub_div_5">Sub Divisi 10</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="Lokasi">Lokasi</label>
				</div>
				<div class="col-75">
					<select name="lokasi">
						<option value="">Silahkan pilih Lokasi</option>
						<option value="Cengkareng">Cengkareng</option>
						<option value="Dadap">Dadap</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="gaji_perjam">Gaji Per Jam</label>
				</div>
				<div class="col-75">
					<input type="text" name="gaji_perjam">
				</div>
			</div>
			<div class="row">
				<input type="submit" value="Simpan" name="submitButtonKaryawan">
			</div>
		</form>
		</div>
	</div>
	<div id="halaman">
		<div class="judul">		
			<h2>Karyawan Details</h1>
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
				<th>No. KTP</th>
				<th>Nama Karyawan</th>
				<th>Alamat Karyawan</th>
				<th>Nomor Telepon Karyawan</th>
				<th>Divisi</th>
				<th>Lokasi</th>
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
				$result = mysqli_query($connect,"select * from karyawan WHERE nama_karyawan LIKE '%$search%' OR lokasi LIKE '%$search%' OR divisi LIKE '%$search%'");
				$query_mysql = mysqli_query($connect,"select * from karyawan WHERE nama_karyawan LIKE '%$search%' OR lokasi LIKE '%$search%' OR divisi LIKE '%$search%' LIMIT $mulai, $halaman")or die(mysql_error());
			} else {
				$result = mysqli_query($connect,"select * from karyawan");
				$query_mysql = mysqli_query($connect,"select * from karyawan LIMIT $mulai, $halaman")or die(mysql_error());
			}
			$total = mysqli_num_rows($result);
			$pages = ceil($total/$halaman);            
			$nomor = $mulai+1;
			while($data = mysqli_fetch_array($query_mysql)){
			?>
			<tr>
				<td><?php echo $nomor++; ?></td>
				<td><?php echo $data['no_ktp']; ?></td>
				<td><?php echo $data['nama_karyawan']; ?></td>
				<td><?php echo $data['alamat_karyawan']; ?></td>
				<td><?php echo $data['no_telepon_karyawan']; ?></td>
				<td><?php echo $data['divisi']; ?></td>
				<td><?php echo $data['lokasi']; ?></td>
				<td>
					<a class="edit" href="../controllers/proses_update_karyawan.php?id=<?php echo $data['id_karyawan']; ?>">Edit</a> |
					<a href="../controllers/proses_hapus_karyawan.php?id=<?php echo $data['id_karyawan']; ?>" onclick="return confirm(‘Yakin Hapus?’)">Hapus</a>				
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