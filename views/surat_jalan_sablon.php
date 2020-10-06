<?php
	session_start();
	error_reporting(E_ALL && ~E_NOTICE);
	if(!isset($_SESSION['nama_user'])){
		header("location:index.php");
	} else {
		date_default_timezone_set('Asia/Jakarta');
		include ("../config/connection.php");
		include ("../assets/function.php");
		if(isset($_POST['submitButtonPO'])){ //check if form was submitted
			$no_po = $_POST['no_po'];
		}
		if(isset($_POST['submitButtonSalary'])){ //check if form was submitted
			$createDate = date('d-m-Y  h:i:s a');
			$createBy = $_SESSION['nama_user'];
			
			$id_karyawan = $_POST['id_karyawan'];
			$no_surat_jalan = $_POST['no_surat_jalan'];
			$tanggal_gajian = $_POST['tanggal_gajian'];
			$no_seri = $_POST['no_seri'];
			$description = $_POST['deskripsi'];
			$warna = $_POST['warna'];
			$rincian_warna = $_POST['rincian_warna'];
			$quantity = $_POST['quantityPerPcs'];
			$tanggal_keluar = $_POST['tanggal_keluar'];
			$harga = $_POST['harga'];
			$perLusin = $_POST['quantityPerLusin'];
			$no_po = $_POST['no_po'];
			
			$jumlah = count($no_seri);
			for($i = 0; $i < $jumlah; $i++){
				$query_mysql_stock = mysqli_query($connect,"select * from noseri WHERE no_seri='$no_seri[$i]'");
				$dataStock = mysqli_fetch_array($query_mysql_stock);
					
				if($quantity[$i] > $dataStock['qty']){
					header("location:surat_jalan_sablon.php?pesan=errorStock");
				} else {
					$qty_total = $dataStock['qty'] - $quantity[$i];
					mysqli_query($connect, "UPDATE noseri SET qty='$qty_total' WHERE no_seri='$no_seri[$i]'");
					
					mysqli_query($connect, "UPDATE purchase_order SET status_bahan='In Process Sablon' WHERE no_po='$no_po'");
					//Insert Invoice
					mysqli_query($connect, "INSERT INTO surat_jalan_sablon (id_karyawan, no_surat_jalan, tanggal_gajian, no_seri, description, warna, rincian_warna, quantity, tanggal_keluar, total, status, createDate, createBy, perLusin, no_po) VALUES ('$id_karyawan', '$no_surat_jalan', '$tanggal_gajian', '$no_seri[$i]', '$description[$i]', '$warna[$i]', '$rincian_warna[$i]', '$quantity[$i]', '$tanggal_keluar[$i]', '$harga[$i]', 'Keluar', '$createDate', '$createBy', '$perLusin[$i]', '$no_po')")or die(mysqli_error($connect));
					header("location:surat_jalan_sablon.php?pesan=input");
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
		$(function() {
			$(".datepicker").datepicker();  // It is $("(dot)datepicker")(dot)datepicker();
		});
		
		$(document).ready(function(){
			//group add limit
			var maxGroup = 20;
			
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
			<h1>Surat Jalan Sablon Pages</h1>
		</div>
		<br/>
		<?php
		if(isset($_GET['pesan'])){
			if($_GET['pesan'] == 'input'){
				echo '<p>Berhasil input Surat Jalan!</p><br/>';
			} else if($_GET['pesan'] == 'inputgagal') {
				echo '<p>Gagal input Surat Jalan!</p><br/>';
			} else if($_GET['pesan'] == 'hapus') {
				echo '<p>Berhasil menghapus Surat Jalan!</p></br/>';
			} else if($_GET['pesan'] == 'gagalhapus'){ 
				echo '<p>Gagal menghapus Surat Jalan!</p></br/>';
			} else if($_GET['pesan'] == 'update'){ 
				echo '<p>Berhasil memperbaharui Surat Jalan!</p></br/>';
			} else if($_GET['pesan'] == 'updategagal'){ 
				echo '<p>Gagal memperbaharui Surat Jalan!</p></br/>';
			}
		}
		?>
		<div class="container">
		<form action="#" method="post">
			<div class="row">
				<div class="col-25">
					<label for="no_po">No. Purchase Order</label>
				</div>
				<div class="col-25">
					<select id="no_po" name="no_po">
						<option value="" selected>Silahkan pilih No. Purchase Order</option>
						<?php 
							include "../config/connection.php";
							$query_mysql_no_po = mysqli_query($connect,"select * from purchase_order where status=1")or die(mysql_error());
							while($dataNoPo = mysqli_fetch_array($query_mysql_no_po)){
						?>
							<option value="<?php echo $dataNoPo['no_po'];?>"><?php echo $dataNoPo['no_po'];?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<br /><br />
			<div class="row">
				<input type="submit" value="Submit" name="submitButtonPO">
			</div>
		</form>
		<br /><br /><br /><br /><br /><br /><br />
		<?php
			if (!empty($no_po)) {
		?>
		<form action="#" method="post">		
		<input type="text" name="no_po" value="<?php echo $no_po;?>" hidden>
			<div class="row">
				<div class="col-25">
					<label for="no_invoice">Nama</label>
				</div>
				<div class="col-25">
					<input type="text" name="id_karyawan" placeholder="Nama">
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="no_surat_jalan">No. Surat Jalan</label>
				</div>
				<div class="col-25">
					<?php 
						date_default_timezone_set('Asia/Jakarta');
						include ("../config/connection.php");
						$dateSuratJalan = date('Y/m/d');
						$query = "SELECT max(no_surat_jalan) as maxKode FROM surat_jalan_sablon";
						$hasil = mysqli_query($connect,$query);
						$data = mysqli_fetch_array($hasil);
						$no_surat_jalan = $data['maxKode'];
						$noUrut = (int) substr($no_surat_jalan, 19, 3);
						$noUrut++;
						
						$no_surat_jalan_dynamic = "SK/SBL/" . $dateSuratJalan . "/" . sprintf("%03s", $noUrut);
					?>
					<input type="text" name="no_surat_jalan" value="<?php echo $no_surat_jalan_dynamic;?>" readonly>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="tanggal_cetak">Tanggal Cetak</label>
				</div>
				<div class="col-75">
					<input type="date" name="tanggal_gajian">
				</div>
			</div>
			<br /><br />
			<div class="form-group fieldGroup">
				<div class="row">
					<div class="col-25">
						<label for="no_seri">No. Seri</label>
					</div>
					<div class="col-25">
						<select id="no_seri" name="no_seri[]">
							<option value="" selected>Silahkan pilih No. Seri</option>
							<?php 
								$query_mysql_seri = mysqli_query($connect,"select noseri.no_seri AS nomor_seri, noseri.qty AS quantity from stock JOIN noseri ON stock.nomor_seri = noseri.no_seri WHERE no_po='$no_po' AND noseri.qty > 0");
								while($stock= mysqli_fetch_array($query_mysql_seri)){
							?>
								<option value="<?php echo $stock['nomor_seri'];?>"><?php echo $stock['nomor_seri'].' ( Qty : '.$stock['quantity'].')';?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="deskripsi">Deskripsi</label>
					</div>
					<div class="col-25">
						<input type="text" name="deskripsi[]" placeholder="Deskripsi">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="warna">Warna</label>
					</div>
					<div class="col-25">
						<input type="text" name="warna[]" placeholder="Warna">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="rincian_warna">Rincian Warna</label>
					</div>
					<div class="col-25">
						<input type="text" name="rincian_warna[]" placeholder="Rincian Warna">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="quantity">Quantity Per Pcs</label>
					</div>
					<div class="col-25">
						<input type="text" name="quantityPerPcs[]" placeholder="Quantity Per Pcs">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="quantity">Quantity Per Lusin</label>
					</div>
					<div class="col-25">
						<input type="text" name="quantityPerLusin[]" placeholder="Quantity Per Lusin">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="tanggal_keluar">Tanggal Keluar</label>
					</div>
					<div class="col-75">
						<input type="date" name="tanggal_keluar[]">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="harga">Harga per Lusin</label>
					</div>
					<div class="col-25">
						<input type="text" name="harga[]" placeholder="Harga Per Pcs">
					</div>
				</div>
				<div class="input-group-addon"> 
					<a href="javascript:void(0)" class="add_field_button addMore"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Add</a>
				</div>
				<br /><br />
			</div>
			<br /><br />
			<div class="row">
				<input type="submit" value="Simpan" name="submitButtonSalary">
			</div>
		</form>
		<!-- COPY FIELD -->
		<div class="form-group fieldGroupCopy" style="display: none;">
			<div class="row">
				<div class="col-25">
					<label for="no_seri">No. Seri</label>
				</div>
				<div class="col-25">
					<select id="no_seri" name="no_seri[]">
						<option value="" selected>Silahkan pilih No. Seri</option>
						<?php 
							include "../config/connection.php";
							$query_mysql_seri = mysqli_query($connect,"select noseri.no_seri AS nomor_seri, noseri.qty AS quantity from stock JOIN noseri ON stock.nomor_seri = noseri.no_seri WHERE no_po='$no_po' AND noseri.qty > 0");
							while($dataNoSeri = mysqli_fetch_array($query_mysql_seri)){
						?>
							<option value="<?php echo $dataNoSeri['nomor_seri'];?>"><?php echo $dataNoSeri['nomor_seri'].' ( Qty : '.$dataNoSeri['quantity'].')';?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="deskripsi">Deskripsi</label>
				</div>
				<div class="col-25">
					<input type="text" name="deskripsi[]" placeholder="Deskripsi">
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="warna">Warna</label>
				</div>
				<div class="col-25">
					<input type="text" name="warna[]" placeholder="Warna">
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="rincian_warna">Rincian Warna</label>
				</div>
				<div class="col-25">
					<input type="text" name="rincian_warna[]" placeholder="Rincian Warna">
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="quantity">Quantity Per Pcs</label>
				</div>
				<div class="col-25">
					<input type="text" name="quantityPerPcs[]" placeholder="Quantity Per Pcs">
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="quantity">Quantity Per Lusin</label>
				</div>
				<div class="col-25">
					<input type="text" name="quantityPerLusin[]" placeholder="Quantity Per Lusin">
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="tanggal_keluar">Tanggal Keluar</label>
				</div>
				<div class="col-75">
					<input type="date" name="tanggal_keluar[]">
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="harga">Harga per Lusin</label>
				</div>
				<div class="col-25">
					<input type="text" name="harga[]" placeholder="Harga Per Pcs">
				</div>
			</div>
			<div class="input_fields_wrap">
				<button class="add_field_button">Add more fields</button>
			</div>
			<br /><br />
		</div>
		<!-- END OF COPY -->
		<?php } ?>
		</div>
	</div>
	<div id="halaman">
		<div class="judul">		
			<h2>Surat Jalan Details</h1>
		</div>
		<br/>
		<table border="1" class="demo-table">
			<tr>
				<th>No.</th>
				<th>Nama</th>
				<th>No. Surat Jalan</th>
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
				$result = mysqli_query($connect,"select * from surat_jalan_sablon WHERE id_karyawan LIKE '%$search%' OR no_surat_jalan LIKE '%$search%' ");
				$query_mysql = mysqli_query($connect,"select * from surat_jalan_sablon WHERE id_karyawan LIKE '%$search%' OR no_surat_jalan LIKE '%$search%'  LIMIT $mulai, $halaman")or die(mysql_error());
			} else {
				$result = mysqli_query($connect,"select * from surat_jalan_sablon ");
				$query_mysql = mysqli_query($connect,"select * from surat_jalan_sablon LIMIT $mulai, $halaman")or die(mysql_error());
			}
			$total = mysqli_num_rows($result);
			$pages = ceil($total/$halaman);            
			$nomor = $mulai+1;
			
			while($data = mysqli_fetch_array($query_mysql)){
			?>
			<tr>
				<td><?php echo $nomor++; ?></td>
				<td><?php echo $data['id_karyawan']; ?></td>
				<td><?php echo $data['no_surat_jalan']; ?></td>
				<td>
					<a href="details/detail_surat_jalan_sablon.php?id_karyawan=<?php echo $data['id_karyawan']; ?>" class="ahrefButton">Detail</a>	
					<?php if($data['status'] == 'Keluar'){ ?>
					<a href="../controllers/proses_update_surat_jalan_sablon.php?id=<?php echo $data['no_surat_jalan']; ?>" class="ahrefButton">Edit</a>
					<?php } ?>
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
<script type="text/javascript">
		$(function() {
			$(".datepicker").datepicker();  // It is $("(dot)datepicker")(dot)datepicker();
		});
		</script>
</html>
<?php } ?>