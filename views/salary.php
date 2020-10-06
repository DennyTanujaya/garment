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
		if(isset($_POST['submitButtonSalary'])){ //check if form was submitted
			$createDate = date('d-m-Y  h:i:s a');
			$createBy = $_SESSION['nama_user'];
			
			$id_karyawan = $_POST['id_karyawan'];
			$tanggal_gajian = $_POST['tanggal_gajian'];
			$jumlah_hari = $_POST['jumlah_hari_masuk'];
			$quantity = $_POST['quantity'];
			$merek = $_POST['merek'];
			$jenis = $_POST['jenis'];
			$no_seri = $_POST['no_seri'];
			$size = $_POST['size'];
			$gaji_bulanan = $_POST['gaji_bulanan'];
			$note = $_POST['note'];
			
			if(isset($_POST['kantong'])){
				$kantong = $_POST['kantong'];
			} else {
				$kantong = '0';
			}
			if(isset($_POST['klep'])){
				$klep = $_POST['klep'];
			} else {
				$klep = '0';
			}
			if(isset($_POST['pasang_tali'])){
				$pasang_tali = $_POST['pasang_tali'];
			} else {
				$pasang_tali = '0';
			}
			if(isset($_POST['rip_tangan'])){
				$rip_tangan = $_POST['rip_tangan'];
			} else {
				$rip_tangan = '0';
			}
			if(isset($_POST['tali'])){
				$tali = $_POST['tali'];
			} else {
				$tali = '0';
			}
			if(isset($_POST['stik_tangan'])){
				$stik_tangan = $_POST['stik_tangan'];
			} else {
				$stik_tangan = '0';
			}
			if(isset($_POST['stik_bawah'])){
				$stik_bawah = $_POST['stik_bawah'];
			} else {
				$stik_bawah = '0';
			}
			if(isset($_POST['tangan'])){
				$tangan = $_POST['tangan'];
			} else {
				$tangan = '0';
			}
			if(isset($_POST['pundak'])){
				$pundak = $_POST['pundak'];
			} else {
				$pundak = '0';
			}
			if(isset($_POST['ketek'])){
				$ketek = $_POST['ketek'];
			} else {
				$ketek = '0';
			}
			if(isset($_POST['klep_obras'])){
				$klep_obras = $_POST['klep_obras'];
			} else {
				$klep_obras = '0';
			}
			if(isset($_POST['samping'])){
				$samping = $_POST['samping'];
			} else {
				$samping = '0';
			}
			if(isset($_POST['Kaki_bawah'])){
				$kaki_bawah = $_POST['Kaki_bawah'];
			} else {
				$kaki_bawah = '0';
			}
			if(isset($_POST['kam_tangan'])){
				$kam_tangan = $_POST['kam_tangan'];
			} else {
				$kam_tangan = '0';
			}
			if(isset($_POST['kam_bawah'])){
				$kam_bawah = $_POST['kam_bawah'];
			} else {
				$kam_bawah = '0';
			}
			if(isset($_POST['buang_benang_kecil'])){
				$buang_benang_kecil = $_POST['buang_benang_kecil'];
			} else {
				$buang_benang_kecil = '0';
			}
			if(isset($_POST['buang_benang_besar'])){
				$buang_benang_besar = $_POST['buang_benang_besar'];
			} else {
				$buang_benang_besar = '0';
			}
			if(isset($_POST['lipat'])){
				$lipat = $_POST['lipat'];
			} else {
				$lipat = '0';
			}
			if(isset($_POST['supir'])){
				$supir = $_POST['supir'];
			} else {
				$supir = '0';
			}
			if(isset($_POST['potong'])){
				$potong = $_POST['potong'];
			} else {
				$potong = '0';
			}
			if(isset($_POST['full'])){
				$full = $_POST['full'];
			} else {
				$full = '0';
			}
			if(isset($_POST['full_obras'])){
				$full_obras = $_POST['full_obras'];
			} else {
				$full_obras = '0';
			}
			if(isset($_POST['full_obras_rip'])){
				$full_obras_rip = $_POST['full_obras_rip'];
			} else {
				$full_obras_rip = '0';
			}
			if(isset($_POST['full_jahit'])){
				$full_jahit = $_POST['full_jahit'];
			} else {
				$full_jahit = '0';
			}
			if(isset($_POST['full_jahit_rip'])){
				$full_jahit_rip = $_POST['full_jahit_rip'];
			} else {
				$full_jahit_rip = '0';
			}
			$query_mysql_stock = mysqli_query($connect,"select * from noseri WHERE no_seri='$no_seri'");
			$dataStock = mysqli_fetch_array($query_mysql_stock);
					
			if($dataStock['salary_terpotong'] > '0'){
				$qty_total = $quantity + $dataStock['salary_terpotong'];
				if($quantityTotal > $dataStock['qty']){
					header("location:salary.php?pesan=errorStock");
				} else {
					mysqli_query($connect, "UPDATE noseri SET salary_terpotong='$qty_total' WHERE no_seri='$no_seri'");
					mysqli_query($connect, "INSERT INTO salary (id_karyawan, note, tanggal_gajian, jumlah_hari, full, gaji_bulanan, quantity, merek, jenis, no_seri, size, kantong, klep, tali, stik_tangan, stik_bawah, tangan, pundak, ketek, klep_obras, samping, kaki_bawah, pasang_tali, rip_tangan, kam_tangan, kam_bawah, buang_benang_kecil, buang_benang_besar, lipat, supir, potong, createDate, createBy) VALUES ('$id_karyawan', '$note', '$tanggal_gajian', '$jumlah_hari', '$full', '$gaji_bulanan', '$quantity', '$merek', '$jenis', '$no_seri', '$size', '$kantong', '$klep', '$tali', '$stik_tangan', '$stik_bawah', '$tangan', '$pundak', '$ketek', '$klep_obras', '$samping', '$kaki_bawah', '$pasang_tali', '$rip_tangan', '$kam_tangan', '$kam_bawah', '$buang_benang_kecil', '$buang_benang_besar', '$lipat', '$supir', '$potong', '$full_jahit', '$full_jahit_rip', '$full_obras', '$full_obras_rip', '$createDate', '$createBy')")or die(mysqli_error($connect));
					header("location:salary.php?pesan=input");
				}
			} else {
				$qty_total = $dataStock['salary_terpotong'] + $quantity;
				mysqli_query($connect, "UPDATE noseri SET salary_terpotong='$qty_total' WHERE no_seri='$no_seri'");
				mysqli_query($connect, "INSERT INTO salary (id_karyawan, note, tanggal_gajian, jumlah_hari, full, gaji_bulanan, quantity, merek, jenis, no_seri, size, kantong, klep, tali, stik_tangan, stik_bawah, tangan, pundak, ketek, klep_obras, samping, kaki_bawah, pasang_tali, rip_tangan, kam_tangan, kam_bawah, buang_benang_kecil, buang_benang_besar, lipat, supir, potong, full_jahit, full_jahit_rip, full_obras, full_obras_rip, createDate, createBy) VALUES ('$id_karyawan', '$note', '$tanggal_gajian', '$jumlah_hari', '$full', '$gaji_bulanan', '$quantity', '$merek', '$jenis', '$no_seri', '$size', '$kantong', '$klep', '$tali', '$stik_tangan', '$stik_bawah', '$tangan', '$pundak', '$ketek', '$klep_obras', '$samping', '$kaki_bawah', '$pasang_tali', '$rip_tangan', '$kam_tangan', '$kam_bawah', '$buang_benang_kecil', '$buang_benang_besar', '$lipat', '$supir', '$potong', '$full_jahit', '$full_jahit_rip', '$full_obras', '$full_obras_rip', '$createDate', '$createBy')")or die(mysqli_error($connect));
				header("location:salary.php?pesan=input");
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
			<h1>Penggajian Pages</h1>
		</div>
		<br/>
		<?php
		if(isset($_GET['pesan'])){
			if($_GET['pesan'] == 'input'){
				echo '<p>Berhasil input Salary!</p><br/>';
			} else if($_GET['pesan'] == 'inputgagal') {
				echo '<p>Gagal input Salary!</p><br/>';
			} else if($_GET['pesan'] == 'hapus') {
				echo '<p>Berhasil menghapus Salary!</p></br/>';
			} else if($_GET['pesan'] == 'gagalhapus'){ 
				echo '<p>Gagal menghapus Salary!</p></br/>';
			} else if($_GET['pesan'] == 'update'){ 
				echo '<p>Berhasil memperbaharui Salary!</p></br/>';
			} else if($_GET['pesan'] == 'updategagal'){ 
				echo '<p>Gagal memperbaharui Salary!</p></br/>';
			} else if($_GET['pesan'] == 'errorStock'){ 
				echo '<p>Gagal bahan sudah terbayarkan!</p></br/>';
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
					<label for="tanggal_gajian">Tanggal Gajian</label>
				</div>
				<div class="col-75">
					<input type="date" name="tanggal_gajian">
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="jumlah_hari_masuk">Jumlah Jam Masuk</label>
				</div>
				<div class="col-75">
					<input type="text" name="jumlah_hari_masuk">
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="gaji_bulanan">Gaji Bulanan</label>
				</div>
				<div class="col-75">
					<input type="text" name="gaji_bulanan">
				</div>
			</div>
			<br /><br />
			<div class="row">
				<div class="col-25">
					<label for="merek_stock">Merek</label>
				</div>
				<div class="col-75">
					<select name="merek">
						<option value="">Silahkan Pilih Merek</option>
						<option value="Phank">Phank</option>
						<option value="Theda">Theda</option>
						<option value="Seranno">Seranno</option>
						<option value="Sielie">Sielie</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="jenis">Jenis</label>
				</div>
				<div class="col-75">
					<select id="jenis" name="jenis">
						<option value="" selected>Silahkan pilih Jenis</option>
							<option value="Kerah">Kerah</option>
							<option value="Normal">Normal</option>
							<option value="Renda">Renda</option>
							<option value="Topi">Topi</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="no_seri">No. Seri</label>
				</div>
				<div class="col-75">
					<select id="no_seri" name="no_seri">
						<option value="" selected>Silahkan pilih No. Seri</option>
						<?php 
							include "../config/connection.php";
							$query_mysql_no_seri = mysqli_query($connect,"select * from noseri")or die(mysql_error());
							while($dataNoSeri = mysqli_fetch_array($query_mysql_no_seri)){
						?>
						<option value="<?php echo $dataNoSeri['no_seri'];?>"><?php echo $dataNoSeri['no_seri'].' ( Qty Total: '.$dataNoSeri['qty'].') ( Qty Terpotong: '.$dataNoSeri['salary_terpotong'].')';?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="quantity">Quantity</label>
				</div>
				<div class="col-75">
					<input type="text" name="quantity">
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="size">Size</label>
				</div>
				<div class="col-75">
					<select id="size" name="size">
						<option value="" selected>Silahkan pilih Size</option>
							<option value="ub">UB</option>
							<option value="dewasa">Dewasa</option>
							<option value="tb">TB</option>
							<option value="12">12 th</option>
							<option value="8">8 th</option>
							<option value="tkm">TK M</option>
							<option value="tks">TK S</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="note">Note</label>
				</div>
				<div class="col-75">
					<input type="text" name="note">
				</div>
			</div>
			<!-- OPTION -->
			<div class="row">
				<div class="col-25">
					<label for="Potong">Potong</label>
				</div><br />
				<input type="checkbox" name="potong" value="1" />Potong
			</div>
			<div class="row">
				<div class="col-25">
					<label for="jahit">Jahit</label>
				</div><br />
				<input type="checkbox" name="kantong" value="1" />Kantong&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="checkbox" name="klep" value="1" />Klep&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="checkbox" name="tali" value="1" />Tali&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="checkbox" name="stik_tangan" value="1" />Stik Tangan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="checkbox" name="stik_bawah" value="1" />Stik Bawah&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="checkbox" name="pasang_tali" value="1" />Pasang Tali&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="checkbox" name="full_jahit" value="1" />Full Jahit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="checkbox" name="full_jahit_rip" value="1" />Full Jahit dengan RIP&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</div>
			<div class="row">
				<div class="col-25">
					<label for="obras">Obras</label>
				</div><br />
				<input type="checkbox" name="pundak" value="1" />Pundak&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="checkbox" name="ketek" value="1" />Ketek&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="checkbox" name="klep_obras" value="1" />Klep&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="checkbox" name="samping" value="1" />Samping&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="checkbox" name="tangan" value="1" />Tangan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="checkbox" name="Kaki_bawah" value="1" />Kaki / Bawah&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="checkbox" name="rip_tangan" value="1" />RIP Tangan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="checkbox" name="full_obras" value="1" />Full Obras&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="checkbox" name="full_obras_rip" value="1" />Full Obras dengan RIP&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</div>
			<div class="row">
				<div class="col-25">
					<label for="kam">Kam</label>
				</div><br />
				<input type="checkbox" name="kam_tangan" value="1" />Kam Tangan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="checkbox" name="kam_bawah" value="1" />Kam Bawah&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</div>
			<div class="row">
				<div class="col-25">
					<label for="packing">Packing</label>
				</div><br />
				<input type="checkbox" name="buang_benang_kecil" value="1" />Buang Benang Kecil&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="checkbox" name="buang_benang_besar" value="1" />Buang Benang Besar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="checkbox" name="lipat" value="1" />Lipat&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</div>
			<div class="row">
				<div class="col-25">
					<label for="supir">Supir</label>
				</div><br />
				<input type="checkbox" name="supir" value="1" />Supir&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</div>
			<!-- END OF OPTION -->
			<!--<div class="input_fields_wrap">
				<button class="add_field_button">Add more fields</button>
			</div>
			<br /><br />-->
			
			<br /><br />
			<div class="row">
				<input type="submit" value="Simpan" name="submitButtonSalary">
			</div>
			
		</form>
		</div>
	</div>
	<div id="halaman">
		<div class="judul">		
			<h2>Salary Details</h1>
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
				$result = mysqli_query($connect,"select * from salary LEFT JOIN karyawan ON karyawan.id_karyawan=salary.id_karyawan WHERE nama_karyawan LIKE '%$search%' GROUP BY salary.id_karyawan LIMIT $mulai, $halaman");
				$query_mysql = mysqli_query($connect,"select * from salary LEFT JOIN karyawan ON karyawan.id_karyawan=salary.id_karyawan WHERE nama_karyawan LIKE '%$search%' GROUP BY salary.id_karyawan LIMIT $mulai, $halaman")or die(mysql_error());
			} else {
				$result = mysqli_query($connect,"select * from salary GROUP BY id_karyawan");
				$query_mysql = mysqli_query($connect,"select * from salary LEFT JOIN karyawan ON karyawan.id_karyawan=salary.id_karyawan GROUP BY salary.id_karyawan LIMIT $mulai, $halaman")or die(mysql_error());
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
					<a href="details/detail_salary.php?id_karyawan=<?php echo $data['id_karyawan']; ?>" class="ahrefButton">Detail</a>
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