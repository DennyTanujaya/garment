<?php

	session_start();
	if(!isset($_SESSION['nama_user'])){
		header("location:index.php");
	} else {
		date_default_timezone_set('Asia/Jakarta');
		include ("../config/connection.php");
		include ("../assets/function.php");
		if(isset($_POST['submitButtonStock'])){ //check if form was submitted
			$createDate = date('d-m-Y  h:i:s a');
			$createBy = $_SESSION['nama_user'];
			
			$no_po = $_POST['no_po'];
			$tanggal_masuk = $_POST['tanggal_masuk'];
			
			$nama_bahan = $_POST['nama_bahan'];
			$jenis_bahan = $_POST['jenis_bahan'];
			$quantity = $_POST['quantity'];
			$size = $_POST['size'];
			$warna_bahan = $_POST['warna_bahan'];
			$harga_bahan = $_POST['harga_bahan'];
			
			$jumlah = count($nama_bahan);
			for($i = 0; $i < $jumlah; $i++){
				$kode = substr($no_po, 0, 3);
			$query = "SELECT max(no_seri) as maxKode FROM noseri";
			$hasil = mysqli_query($connect,$query);
			$data = mysqli_fetch_array($hasil);
			$noSeri = $data['maxKode'];
			$noUrut = (int) substr($noSeri, 4, 6);
			$noUrut++;
			$nomor_seri = $kode . "/" . sprintf("%06s", $noUrut);
				mysqli_query($connect, "INSERT INTO stock (no_po, tanggal_masuk, nomor_seri, nama_bahan, jenis_bahan, quantity, size, warna_bahan, harga_bahan, createBy, createDate) VALUES ('$no_po', '$tanggal_masuk', '$nomor_seri', '$nama_bahan[$i]', '$jenis_bahan[$i]', '$quantity[$i]', '$size[$i]', '$warna_bahan[$i]', '$harga_bahan[$i]', '$createBy', '$createDate')");
				mysqli_query($connect, "UPDATE purchase_order SET status='1' WHERE no_po = '$no_po'");
				$query_mysql_no_seri = mysqli_query($connect,"select * from noseri WHERE no_seri = '$nomor_seri'");
				$dataNoSeri = mysqli_fetch_array($query_mysql_no_seri);
				if($nomor_seri[$i] == $dataNoSeri['no_seri']) {
					$quantityNoSeri = $quantity[$i] + $dataNoSeri['qty'];
					mysqli_query($connect, "UPDATE noseri SET qty='$quantityNoSeri' WHERE no_seri = '$nomor_seri'");
				} else {
					mysqli_query($connect, "INSERT INTO noseri (no_seri, qty) VALUES ('$nomor_seri', '$quantity[$i]')");
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
		
		$(document).ready(function() {
			var max_fields      = 10; //maximum input boxes allowed
			var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
			var add_button      = $(".add_field_button"); //Add button ID
			
			var x = 1; //initlal text box count
			$(add_button).click(function(e){ //on add input button click
				e.preventDefault();
				if(x < max_fields){ //max input box allowed
					x++; //text box increment
					$(wrapper).append('<br /><br /><div><div class="row"><div class="col-25"><label for="nomor_seri">Nomor Seri</label></div><div class="col-75"><input type="text" name="nomor_seri[]"></div></div><div class="row"><div class="col-25"><label for="merek_stock">Merek</label></div><div class="col-75"><select name="merek[]"><option value="">Silahkan Pilih Merek</option><option value="Phank">Phank</option><option value="Theda">Theda</option><option value="Seranno">Seranno</option><option value="Sielie">Sielie</option></select></div></div><div class="row"><div class="col-25"><label for="nama_bahan">Nama Bahan</label></div><div class="col-75"><input type="text" name="nama_bahan[]"></div></div><div class="row"><div class="col-25"><label for="jenis_bahan">Jenis Bahan</label></div><div class="col-75"><input type="text" name="jenis_bahan[]"></div></div><div class="row"><div class="col-25"><label for="quantity">Quantity</label></div><div class="col-75"><input type="text" name="quantity[]"></div></div><div class="row"><div class="col-25"><label for="Size">Size</label></div><div class="col-75"><select name="size[]"><option value="">Silahkan Pilih Size</option><option value="Small">Small</option><option value="Medium">Medium</option><option value="Large">Large</option><option value="Extra Large">Extra Large</option><option value="Dewasa">Dewasa</option><option value="Jumbo">Jumbo</option><option value="Tanggung Badan">Tanggung Badan</option></select></div></div><div class="row"><div class="col-25"><label for="warna_bahan">Warna Bahan</label></div><div class="col-75"><input type="text" name="warna_bahan[]"></div></div><div class="row"><div class="col-25"><label for="harga_bahan">Harga Bahan</label></div><div class="col-75"><input type="text" name="harga_bahan[]"></div></div><div class="row"><div class="col-25"><label for="satuan">Satuan</label></div><div class="col-75"><select name="satuan[]"><option value="" selected>Silahkan pilih satuan</option><option value="Roll">Rol</option><option value="Kilo">Kilo</option><option value="Lusin">Lusin</option></select></div></div><a href="#" class="remove_field">Remove</a></div>'); //add input box
				}
			});
			
			$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
				e.preventDefault(); $(this).parent('div').remove(); x--;
			})
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
			<h1>Stock Pages</h1>
		</div>
		<br/>
		<?php
		if(isset($_GET['pesan'])){
			if($_GET['pesan'] == 'input'){
				echo '<p>Berhasil input Stock!</p><br/>';
			} else if($_GET['pesan'] == 'inputgagal') {
				echo '<p>Gagal input Stock!</p><br/>';
			} else if($_GET['pesan'] == 'hapus') {
				echo '<p>Berhasil menghapus Stock!</p></br/>';
			} else if($_GET['pesan'] == 'gagalhapus'){ 
				echo '<p>Gagal menghapus Stock!</p></br/>';
			} else if($_GET['pesan'] == 'update'){ 
				echo '<p>Berhasil memperbaharui Stock!</p></br/>';
			} else if($_GET['pesan'] == 'updategagal'){ 
				echo '<p>Gagal memperbaharui Stock!</p></br/>';
			} else if($_GET['pesan'] == 'errorSisa'){ 
				echo '<p>Gagal! Bahan yang terpotong melebihi sisa bahan!</p></br/>';
			}
		}
		?>
		<div class="container">
		<h3>Input data baru</h3>
		<form action="#" method="post">		
			<div class="row">
				<div class="col-25">
					<label for="no_po">Nomor PO</label>
				</div>
				<div class="col-75">
					<select id="no_po" name="no_po">
						<?php 
							include "../config/connection.php";
							$query_mysql = mysqli_query($connect,"select * from purchase_order where status = '0' AND status_return='0' GROUP BY no_po")or die(mysql_error());
							$nomor = 1;
							while($data = mysqli_fetch_array($query_mysql)){
						?>
							<option value="<?php echo $data['no_po'];?>"><?php echo $data['no_po'];?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="tanggal_masuk">Tanggal Masuk</label>
				</div>
				<div class="col-75">
					<input type="date" name="tanggal_masuk">
				</div>
			</div>
			<br /><br />
			<div class="form-group fieldGroup">
				<div class="row">
					<div class="col-25">
						<label for="nama_bahan">Nama Bahan</label>
					</div>
					<div class="col-75">
						<input type="text" name="nama_bahan[]">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="jenis_bahan">Jenis Bahan</label>
					</div>
					<div class="col-75">
						<input type="text" name="jenis_bahan[]">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="quantity">Quantity</label>
					</div>
					<div class="col-75">
						<input type="text" name="quantity[]">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="Size">Size</label>
					</div>
					<div class="col-75">
						<select name="size[]">
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
						<input type="text" name="warna_bahan[]">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="harga_bahan">Harga Bahan</label>
					</div>
					<div class="col-75">
						<input type="text" name="harga_bahan[]">
					</div>
				</div>
				<div class="input-group-addon"> 
					<a href="javascript:void(0)" class="add_field_button addMore"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Add</a>
				</div>
				<!--
				<div class="input_fields_wrap_others">
					<h3 style="text-align:center;">Others</h3>
					<button class="add_other_button">Add Others</button>
				</div>
				-->
				<br /><br />
			</div>
			<br /><br />
			<div class="row">
				<input type="submit" value="Simpan" name="submitButtonStock">
			</div>
		</form>
		<!-- COPY OF FIELD -->
		<div class="form-group fieldGroupCopy" style="display: none;">
			<div class="row">
				<div class="col-25">
					<label for="nama_bahan">Nama Bahan</label>
				</div>
				<div class="col-75">
					<input type="text" name="nama_bahan[]">
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="jenis_bahan">Jenis Bahan</label>
				</div>
				<div class="col-75">
					<input type="text" name="jenis_bahan[]">
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="quantity">Quantity</label>
				</div>
				<div class="col-75">
					<input type="text" name="quantity[]">
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="Size">Size</label>
				</div>
				<div class="col-75">
					<select name="size[]">
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
					<input type="text" name="warna_bahan[]">
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="harga_bahan">Harga Bahan</label>
				</div>
				<div class="col-75">
					<input type="text" name="harga_bahan[]">
				</div>
			</div>
			<div class="input-group-addon"> 
                <a href="javascript:void(0)" class="add_field_button remove"><span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span> Remove</a>
            </div>
			<br /><br />
		</div>
		<!-- END OF COPY -->
		</div>
	</div>
	<div id="halaman">
		<div class="judul">		
			<h2>Stock Details</h1>
		</div>
		<br/>
		<form action="#" method="post">	
			<div class="col-30">
				<input type="text" name="search" placeholder="Ketik kata pencarian disini">
				<input type="submit" name="searchButton" value="Cari" hidden>
			</div>
		</form>
		<table border="1" class="demo-table">
			<tr>
				<th>No.</th>
				<th>No. Seri</th>
				<th>Quantity</th>
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
				$result = mysqli_query($connect,"select * from noseri WHERE no_seri LIKE '%search%'");
				$query_mysql_view = mysqli_query($connect,"select * from noseri WHERE no_seri LIKE '%search%' LIMIT $mulai, $halaman");
			} else {
				$result = mysqli_query($connect,"select * from noseri");
				$query_mysql_view = mysqli_query($connect,"select * from noseri LIMIT $mulai, $halaman");
			}
			$total = mysqli_num_rows($result);
			$pages = ceil($total/$halaman);            
			$nomor = $mulai+1;
			
			while($data = mysqli_fetch_array($query_mysql_view)){
			?>
			<tr>
				<td><?php echo $nomor++; ?></td>
				<td><?php echo $data['no_seri']; ?></td>
				<td><?php echo $data['qty']; ?></td>
				<td>
					<a href="details/stock_details.php?no_seri=<?php echo $data['no_seri']; ?>" class="ahrefButton">Detail</a>
					<a href="print/stock_detail_print.php?no_seri=<?php echo $data['no_seri']; ?>" target="_BLANK" class="ahrefButton">Print</a>					
				</td>
			</tr>
			<?php 
			} 
			?>
		</table>
		<br /><br />
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
		<br /><br />
	</div>
	<!--
	<div id="halaman">
		<div class="judul">		
			<h2>Stock Others Details</h1>
		</div>
		<br/>
		<table border="1" class="demo-table">
			<tr>
				<th>No.</th>
				<th>Jenis Barang</th>
				<th>Quantity</th>
				<th>Size</th>
				<th>Action</th>
			</tr>
			<?php 
			include "../config/connection.php";
			$halaman_other = 10;
			$page_other = isset($_GET["halaman_other"]) ? (int)$_GET["halaman_other"] : 1;
			$mulai_other = ($page>1) ? ($page * $halaman) - $halaman : 0;
			$result_other = mysqli_query($connect,"select * from stock_other");
			$total_other = mysqli_num_rows($result_other);
			$pages_other = ceil($total_other/$halaman_other);            
			$nomor_other = $mulai_other+1;
			$query_mysql_other = mysqli_query($connect,"select * from stock_other LIMIT $mulai_other, $halaman_other");
			while($dataOther = mysqli_fetch_array($query_mysql_other)){
			?>
			<tr>
				<td><?php echo $nomor_other++; ?></td>
				<td><?php echo $dataOther['jenis']; ?></td>
				<td><?php echo $dataOther['quantity']; ?></td>
				<td><?php echo $dataOther['size']; ?></td>
				<td>
					<a href="details/stock_details.php?no_seri=<?php echo $data['no_seri']; ?>" class="ahrefButton">Detail</a>							
				</td>
			</tr>
			<?php
			} 
			?>
		</table>
		<br /><br />
		<div class="page">
			<?php
					for ($i=1; $i<=$pages_other ; $i++){
			?>
					<a href="?halaman_other=<?php echo $i; ?>"><?php echo $i; ?></a>
			<?php 
			}
			?>
		</div>
	</div>-->
</div>
</body>
</html>
<?php } ?>