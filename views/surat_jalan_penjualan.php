<?php
	session_start();
	if(!isset($_SESSION['nama_user'])){
		header("location:index.php");
	} else {
		date_default_timezone_set('Asia/Jakarta');
		include ("../config/connection.php");
		if(isset($_POST['submitButtonSuratJalan'])){ //check if form was submitted
			
			$createDate = date('d-m-Y  h:i:s a');
			$createBy = $_SESSION['nama_user'];
			
			$kode_customer = $_POST['kode_customer'];
			$dateSuratJalan = date('Y/m/d');
			$query = "SELECT max(no_surat_jalan) as maxKode FROM surat_jalan_penjualan";
			$hasil = mysqli_query($connect,$query);
			$data = mysqli_fetch_array($hasil);
			$no_surat_jalan = $data['maxKode'];
			$noUrut = (int) substr($no_surat_jalan, 18, 3);
			$noUrut++;
			$no_surat_jalan = "SK/" . $kode_customer . "/" . $dateSuratJalan . "/" . sprintf("%03s", $noUrut);
			
			$no_seri = $_POST['no_seri'];
			$tanggal_surat_jalan = $_POST['tanggal_surat_jalan'];
			$no_seri = $_POST['no_seri'];
			$harga_satuan = $_POST['harga_satuan'];
			$qty = $_POST['qty'];
			$quantityPerPcs = $_POST['quantityPerPcs'];
			$description = $_POST['description'];
			$merek = $_POST['merek'];
			
			if(!empty($no_seri)){
				$jumlah = count($no_seri);
				for($i = 0; $i < $jumlah; $i++){
					$query_mysql_stock = mysqli_query($connect,"select * from noseri WHERE no_seri='$no_seri[$i]'");
					$dataStock = mysqli_fetch_array($query_mysql_stock);
					
					if($qty[$i] > $dataStock['qty']){
						header("location:surat_jalan_penjualan.php?pesan=errorStock");
					} else {
						$qty_total = $dataStock['qty'] - $qty[$i];
						mysqli_query($connect, "UPDATE noseri SET qty='$qty_total' WHERE no_seri='$no_seri[$i]'");
						mysqli_query($connect, "UPDATE purchase_order SET status_bahan='Tercetak Surat Jalan' WHERE no_po='$no_po'");
						//Insert Invoice
						mysqli_query($connect, "INSERT INTO surat_jalan_penjualan (no_surat_jalan, tanggal_surat_jalan, no_seri, perLusin, description, harga_satuan, cancellation, no_invoice, createBy, createDate, merek, quantity) VALUES ('$no_surat_jalan', '$tanggal_surat_jalan', '$no_seri[$i]', '$qty[$i]', '$description[$i]', '$harga_satuan[$i]', 'NO', 'empty', '$createBy', '$createDate', '$merek[$i]', '$quantityPerPcs[$i]')");
						header("location:surat_jalan_penjualan.php?pesan=input");
					}
				}
				
			} else {
				header("location:surat_jalan_penjualan.php?pesan=error");
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
		
		$(document).ready(function() { 
          
            $(function() { 
                $( "#my_date_picker1" ).datepicker(); 
            }); 
        })
	</script>
</head>
<body>
<div class="content">
	<?php include('navbar.php'); ?>
	<div id="halaman">
		<div class="judul">		
			<h1>Surat Jalan Penjualan Pages</h1>
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
			} else if($_GET['pesan'] == 'hapusgagal') {
				echo '<p>Gagal menghapus Surat Jalan!</p></br/>';
			} else if($_GET['pesan'] == 'update') {
				echo '<p>Berhasil memperbaharui data Surat Jalan!</p></br/>';
			} else if($_GET['pesan'] == 'updategagal') {
				echo '<p>Gagal memperbaharui data Surat Jalan!</p></br/>';
			} else if($_GET['pesan'] == 'errorStock') {
				echo '<p>Gagal Stock kurang!</p></br/>';
			}
		}
		?>
		<div class="container">
		<h3>Input data baru</h3>
		<form action="#" method="post">		
			<div class="row">
				<div class="col-25">
					<label for="tanggal_surat_jalan">Tanggal Surat Jalan</label>
				</div>
				<div class="col-75">
					<input type="date" name="tanggal_surat_jalan">
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="customer">Customer</label>
				</div>
				<div class="col-75">
					<select id="customer" name="kode_customer">
						<option value="" selected>Silahkan pilih Customer</option>
						<?php 
							include "../config/connection.php";
							$query_mysql = mysqli_query($connect,"select * from customer")or die(mysql_error());
							while($data = mysqli_fetch_array($query_mysql)){
						?>
							<option value="<?php echo $data['kode_customer'];?>"><?php echo $data['nama_customer'];?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<br /><br />
			<div class="form-group fieldGroup">
				<div class="row">
					<div class="col-25">
						<label for="no_seri">No. Seri</label>
					</div>
					<div class="col-75">
						<select id="no_seri" name="no_seri[]">
							<option value="" selected>Silahkan pilih No. Seri</option>
							<?php 
								include "../config/connection.php";
								$query_mysql_no_seri = mysqli_query($connect,"select * from noseri LEFT JOIN stock ON noseri.no_seri=stock.nomor_seri")or die(mysql_error());
								while($dataNoSeri = mysqli_fetch_array($query_mysql_no_seri)){
							?>
								<option value="<?php echo $dataNoSeri['no_seri'];?>"><?php echo $dataNoSeri['no_seri'].' : '. $dataNoSeri['no_po'] .' ( Qty : '.$dataNoSeri['qty'].')';?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="merek_stock">Merek</label>
					</div>
					<div class="col-75">
						<select name="merek[]">
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
						<label for="qty">Quantity Per Lusin</label>
					</div>
					<div class="col-75">
						<input type="text" name="qty[]" placeholder="Quantity Per Lusin">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="qty">Quantity Per Pcs</label>
					</div>
					<div class="col-75">
						<input type="text" name="quantityPerPcs[]" placeholder="Quantity Per Pcs">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="description">Description</label>
					</div>
					<div class="col-75">
						<input type="text" name="description[]" placeholder="Deskripsi">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="harga_satuan">Harga</label>
					</div>
					<div class="col-75">
						<input type="text" name="harga_satuan[]" placeholder="Harga Per Lusin">
					</div>
				</div>
				<div class="input-group-addon"> 
					<a href="javascript:void(0)" class="add_field_button addMore"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Add</a>
				</div>
				<br /><br />
			</div>
			<br /><br />
			<br /><br />
			<div class="row">
				<input type="submit" value="Simpan" name="submitButtonSuratJalan">
			</div>
		</form>
		<!-- COPY FIELD -->
		<div class="form-group fieldGroupCopy" style="display: none;">
			<div class="row">
					<div class="col-25">
						<label for="no_seri">No. Seri</label>
					</div>
					<div class="col-75">
						<select id="no_seri" name="no_seri[]">
							<option value="" selected>Silahkan pilih No. Seri</option>
							<?php 
								include "../config/connection.php";
								$query_mysql_no_seri = mysqli_query($connect,"select * from noseri LEFT JOIN stock ON noseri.no_seri=stock.nomor_seri")or die(mysql_error());
								while($dataNoSeri = mysqli_fetch_array($query_mysql_no_seri)){
							?>
								<option value="<?php echo $dataNoSeri['no_seri'];?>"><?php echo $dataNoSeri['no_seri'].' : '. $dataNoSeri['no_po'] .' ( Qty : '.$dataNoSeri['qty'].')';?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="merek_stock">Merek</label>
					</div>
					<div class="col-75">
						<select name="merek[]">
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
						<label for="qty">Quantity Per Lusin</label>
					</div>
					<div class="col-75">
						<input type="text" name="qty[]" placeholder="Quantity Per Lusin">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="qty">Quantity Per Pcs</label>
					</div>
					<div class="col-75">
						<input type="text" name="quantityPerPcs[]" placeholder="Quantity Per Pcs">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="description">Description</label>
					</div>
					<div class="col-75">
						<input type="text" name="description[]" placeholder="Deskripsi">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="harga_satuan">Harga</label>
					</div>
					<div class="col-75">
						<input type="text" name="harga_satuan[]" placeholder="Harga Per Lusin">
					</div>
				</div>
			<div class="input-group-addon"> 
                <a href="javascript:void(0)" class="add_field_button remove"><span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span> Remove</a>
            </div>
			<br /><br />
		</div>
		<!-- END OF COPY FIELD -->
		</div>
	</div>
	<div id="halaman">
		<div class="judul">		
			<h2>Surat Jalan Details</h1>
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
				<th>No.Surat Jalan</th>
				<th>Tanggal Surat Jalan</th>
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
				$result = mysqli_query($connect,"select * from surat_jalan_penjualan WHERE cancellation='NO' AND (no_surat_jalan LIKE '%$search' OR tanggal_surat_jalan LIKE '%$search%') GROUP BY no_surat_jalan");
				$query_mysql = mysqli_query($connect,"select * from surat_jalan_penjualan WHERE cancellation='NO' AND (no_surat_jalan LIKE '%$search' OR tanggal_surat_jalan LIKE '%$search%') GROUP BY no_surat_jalan LIMIT $mulai, $halaman")or die(mysql_error());
			} else {
				$result = mysqli_query($connect,"select * from surat_jalan_penjualan WHERE cancellation='NO' GROUP BY no_surat_jalan");
				$query_mysql = mysqli_query($connect,"select * from surat_jalan_penjualan WHERE cancellation='NO' GROUP BY no_surat_jalan LIMIT $mulai, $halaman")or die(mysql_error());
			}
			$total = mysqli_num_rows($result);
			$pages = ceil($total/$halaman);            
			$nomor = $mulai+1;
			while($data = mysqli_fetch_array($query_mysql)){
			?>
			<tr>
				<td><?php echo $nomor++; ?></td>
				<td><?php echo $data['no_surat_jalan']; ?></td>
				<td><?php echo $data['tanggal_surat_jalan']; ?></td>
				<td>
					<a class="ahrefButton" href="print/print_surat_jalan_penjualan.php?id=<?php echo $data['no_surat_jalan']; ?>" target="_BLANK">Print</a>
					<a href="../controllers/proses_cancel_surat_jalan_penjualan.php?no_surat_jalan=<?php echo $data['no_surat_jalan']; ?>" onclick="return confirm(‘Yakin Hapus?’)" class="ahrefButton">Batalkan</a>		
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