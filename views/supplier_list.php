<?php
	session_start();
	if(!isset($_SESSION['nama_user'])){
		header("location:index.php");
	} else {
		date_default_timezone_set('Asia/Jakarta');
		include ("../config/connection.php");
		if(isset($_POST['submitButtonSupplier'])){ //check if form was submitted
			
			$createDate = date('d-m-Y  h:i:s a');
			$createBy = $_SESSION['nama_user'];
			
			$kode_supplier = $_POST['kode_supplier'];
			$nama_supplier = $_POST['nama_supplier'];
			$alamat_supplier = $_POST['alamat_supplier'];
			$no_telepon_supplier = $_POST['no_telepon_supplier'];
			
			$sql = "INSERT INTO supplier (kode_supplier, nama_supplier, alamat_supplier, no_tlp_supplier) VALUES ('$kode_supplier', '$nama_supplier', '$alamat_supplier', '$no_telepon_supplier')";
			if(mysqli_query($connect, $sql)){
				header("location:supplier_list.php?pesan=input");
			} else {
				header("location:supplier_list.php?pesan=inputgagal");
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
			<h1>Supplier Pages</h1>
		</div>
		<br/>
		<?php
		if(isset($_GET['pesan'])){
			if($_GET['pesan'] == 'input'){
				echo '<p>Berhasil input Supplier!</p><br/>';
			} else if($_GET['pesan'] == 'inputgagal') {
				echo '<p>Gagal input supplier!</p><br/>';
			} else if($_GET['pesan'] == 'hapus') {
				echo '<p>Berhasil menghapus Supplier!</p></br/>';
			} else if($_GET['pesan'] == 'hapusgagal') {
				echo '<p>Gagal menghapus Supplier!</p></br/>';
			} else if($_GET['pesan'] == 'update') {
				echo '<p>Berhasil memperbaharui data Supplier!</p></br/>';
			} else if($_GET['pesan'] == 'updategagal') {
				echo '<p>Gagal memperbaharui data Supplier!</p></br/>';
			}
		}
		?>
		<div class="container">
		<h3>Input data baru</h3>
		<form action="#" method="post">	
			<div class="row">
				<div class="col-25">
					<label for="kode_supplier">Kode Supplier</label>
				</div>
				<div class="col-75">
					<input type="text" name="kode_supplier">
				</div>
			</div>		
			<div class="row">
				<div class="col-25">
					<label for="nama_supplier">Nama Supplier</label>
				</div>
				<div class="col-75">
					<input type="text" name="nama_supplier">
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="alamat_supplier">Alamat Supplier</label>
				</div>
				<div class="col-75">
					<textarea name="alamat_supplier" style="height:200px"></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="no_telepon_supplier">Nomor Telepon Supplier</label>
				</div>
				<div class="col-75">
					<input type="text" name="no_telepon_supplier">
				</div>
			</div>
			<div class="row">
				<input type="submit" value="Simpan" name="submitButtonSupplier">
			</div>
		</form>
		</div>
	</div>
	<div id="halaman">
		<div class="judul">		
			<h2>Supplier Details</h1>
		</div>
		<br/>
		<table border="1" class="demo-table">
			<tr>
				<th>No.</th>
				<th>Nama Supplier</th>
				<th>Alamat Supplier</th>
				<th>Nomor Telepon Supplier</th>
				<th>Action</th>
			</tr>
			<?php 
			include "../config/connection.php";
			$halaman = 10;
			$page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
			$mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
			$result = mysqli_query($connect,"select * from supplier");
			$total = mysqli_num_rows($result);
			$pages = ceil($total/$halaman);            
			$nomor = $mulai+1;
			$query_mysql = mysqli_query($connect,"select * from supplier LIMIT $mulai, $halaman")or die(mysql_error());
			while($data = mysqli_fetch_array($query_mysql)){
			if(!isset($data)){
					echo '<h1><center>Data tidak di temukan</center></h1>';
				} else {
			?>
			<tr>
				<td><?php echo $nomor++; ?></td>
				<td><?php echo $data['nama_supplier']; ?></td>
				<td><?php echo $data['alamat_supplier']; ?></td>
				<td><?php echo $data['no_tlp_supplier']; ?></td>
				<td>
					<a class="edit" href="../controllers/proses_update_supplier.php?id=<?php echo $data['id_supplier']; ?>">Edit</a> |
					<a href="../controllers/proses_hapus_supplier.php?id=<?php echo $data['id_supplier']; ?>" onclick="return confirm(‘Yakin Hapus?’)">Hapus</a>				
				</td>
			</tr>
			<?php }
			} 
			?>
		</table>
		<div class="page">
			<?php for ($i=1; $i<=$pages ; $i++){ ?>
				<a href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a>
			<?php } ?>
		</div>
	</div>
</div>
</body>
</html>
<?php } ?>