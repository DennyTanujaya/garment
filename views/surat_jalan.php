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
			
			$no_surat_jalan = $_POST['no_surat_jalan'];
			$no_po = $_POST['no_po'];
			$no_seri = $_POST['no_seri'];
			$tanggal_surat_jalan = $_POST['tanggal_surat_jalan'];
			$nama_vendor = $_POST['nama_vendor'];
			$qty = $_POST['qty'];
			$description = $_POST['description'];
			if(!empty($no_po)){
				$jumlah = count($no_seri);
				for($i = 0; $i < $jumlah; $i++){
					mysqli_query($connect, "INSERT INTO surat_jalan (no_po, no_seri, no_surat_jalan, tanggal_surat_jalan, nama_vendor, qty, description, createBy, createDate) VALUES ('$no_po', '$no_seri[$i]', '$no_surat_jalan', '$tanggal_surat_jalan', '$nama_vendor[$i]', '$qty[$i]', '$description[$i]', '$createBy', '$createDate')");
					if($no_po != "Vendor"){
						mysqli_query($connect, "UPDATE stock SET no_surat_jalan='$no_surat_jalan' WHERE no_po='$no_po' and no_seri='$no_seri[$i]'");
					}
				}
				header("location:surat_jalan.php?pesan=input");
			} else {
				header("location:surat_jalan.php?pesan=error");
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
					$(wrapper).append('<br /><br /><div><div class="row"><div class="col-25"><label for="no_seri">No. Seri</label></div><div class="col-75"><input type="text" name="no_seri[]"></div></div><div class="row"><div class="col-25"><label for="nama_vendor">Nama Vendor</label></div><div class="col-75"><input type="text" name="nama_vendor[]"></div></div><div class="row"><div class="col-25"><label for="qty">Quantity</label></div><div class="col-75"><input type="text" name="qty[]"></div></div><div class="row"><div class="col-25"><label for="description">Description</label></div><div class="col-75"><input type="text" name="description[]"></div></div><a href="#" class="remove_field">Remove</a></div>'); //add input box
				}
			});
			
			$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
				e.preventDefault(); $(this).parent('div').remove(); x--;
			})
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
			<h1>Surat Jalan Pages</h1>
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
			}
		}
		?>
		<div class="container">
		<h3>Input data baru</h3>
		<form action="#" method="post">		
			<div class="row">
				<div class="col-25">
					<label for="no_surat_jalan">No. Surat Jalan</label>
				</div>
				<div class="col-75">
					<input type="text" name="no_surat_jalan">
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="no_po">No. PO</label>
				</div>
				<div class="col-75">
					<select name="no_po">
						<option value="">Silahkan pilih No. PO</option>
						<option value="Vendor">Vendor</option>
						<?php 
							include "../config/connection.php";
							$query_mysql = mysqli_query($connect,"select * from purchase_order GROUP BY no_po")or die(mysql_error());
							while($data = mysqli_fetch_array($query_mysql)){
						?>
							<option value="<?php echo $data['no_po'];?>"><?php echo $data['no_po'];?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="tanggal_surat_jalan">Tanggal Surat Jalan</label>
				</div>
				<div class="col-75">
					<input type="text" name="tanggal_surat_jalan" id='my_date_picker1'>
				</div>
			</div>
			<br /><br />
			<div class="row">
				<div class="col-25">
					<label for="no_seri">No. Seri</label>
				</div>
				<div class="col-75">
					<input type="text" name="no_seri[]">
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="nama_vendor">Nama Vendor</label>
				</div>
				<div class="col-75">
					<input type="text" name="nama_vendor[]">
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="qty">Quantity</label>
				</div>
				<div class="col-75">
					<input type="text" name="qty[]">
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="description">Description</label>
				</div>
				<div class="col-75">
					<input type="text" name="description[]">
				</div>
			</div>
			
			<div class="input_fields_wrap">
				<button class="add_field_button">Add more fields</button>
			</div>
			<br /><br />
			<br /><br />
			<div class="row">
				<input type="submit" value="Simpan" name="submitButtonSuratJalan">
			</div>
		</form>
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
				<th>No. PO</th>
				<th>Tanggal Surat Jalan</th>
				<th>Nama Vendor</th>
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
				$result = mysqli_query($connect,"select * from surat_jalan WHERE no_surat_jalan LIKE '%$search' OR no_po LIKE '%$search%' OR nama_vendor LIKE '%$search%' OR tanggal_surat_jalan LIKE '%$search'");
				$query_mysql = mysqli_query($connect,"select * from surat_jalan WHERE no_surat_jalan LIKE '%$search' OR no_po LIKE '%$search%' OR nama_vendor LIKE '%$search%' OR tanggal_surat_jalan LIKE '%$search' LIMIT $mulai, $halaman")or die(mysql_error());
			} else {
				$result = mysqli_query($connect,"select * from surat_jalan");
				$query_mysql = mysqli_query($connect,"select * from surat_jalan LIMIT $mulai, $halaman")or die(mysql_error());
			}
			$total = mysqli_num_rows($result);
			$pages = ceil($total/$halaman);            
			$nomor = $mulai+1;
			while($data = mysqli_fetch_array($query_mysql)){
			?>
			<tr>
				<td><?php echo $nomor++; ?></td>
				<td><?php echo $data['no_surat_jalan']; ?></td>
				<td><?php echo $data['no_po']; ?></td>
				<td><?php echo $data['tanggal_surat_jalan']; ?></td>
				<td><?php echo $data['nama_vendor']; ?></td>
				<td>
					<a class="ahrefButton" href="print/print_surat_jalan.php?id=<?php echo $data['no_surat_jalan']; ?>" target="_BLANK">Print</a>
					<a href="../controllers/proses_hapus_surat_jalan.php?id=<?php echo $data['id_surat_jalan']; ?>" onclick="return confirm(‘Yakin Hapus?’)" class="ahrefButton">Hapus</a>				
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