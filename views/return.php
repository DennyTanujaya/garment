<?php
	session_start();
	if(!isset($_SESSION['nama_user'])){
		header("location:index.php");
	} else {
		date_default_timezone_set('Asia/Jakarta');
		include ("../config/connection.php");
		if(isset($_POST['submitButtonReturn'])){ //check if form was submitted
			
			$id = $_GET['id'];
			$createDate = date('d-m-Y  h:i:s a');
			$createBy = $_SESSION['nama_user'];
			
			$id_purchase_order = $_POST['id'];
			$supplier = $_POST['id_supplier'];
			$tanggal_retur = $_POST['tanggal_retur'];
			$quantity = $_POST['quantity'];
			$satuan = $_POST['satuan'];
			$query_mysql_purchase_order = mysqli_query($connect,"select * from purchase_order WHERE id_purchase_order='$id'");
			$dataPurchaseOrder = mysqli_fetch_array($query_mysql_purchase_order);
			if($quantity > $dataPurchaseOrder['perKilo']){
				header("location:return.php?pesan=error");
			} else {
				$sql = "INSERT INTO retur (id_purchase_order, tgl_retur, id_supplier, quantity, satuan, createBy, createDate) VALUES ('$id', '$tanggal_retur', '$supplier', '$quantity', '$satuan', '$createBy', '$createDate' )";
				if(mysqli_query($connect, $sql)){
					$query_mysql_retur = mysqli_query($connect,"select * from retur WHERE id_purchase_order='$id'");
					$dataretur = mysqli_fetch_array($query_mysql_retur);
					$id_retur = $dataretur['id_retur'];
					mysqli_query($connect, "UPDATE purchase_order SET status_return='$id_retur' WHERE id_purchase_order='$id'");
					header("location:return.php?pesan=input");
				} else {
					header("location:return.php?pesan=inputgagal");
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
		$(document).ready(function() { 
          
            $(function() { 
                $( "#my_date_picker1" ).datepicker(); 
            }); 
        })
	</script>
</head>
<body>
<div class="content">
	<?php 
		include('navbar.php');
		if(isset($_GET['id'])){
	?>
	<div id="halaman">
		<div class="judul">		
			<h1>Retur Pages</h1>
		</div>
		<br/>
		
		<div class="container">
		<h3>Input data baru</h3>
		<form action="#" method="post">		
			<div class="row">
				<div class="col-25">
					<label for="no_po">Nomor PO</label>
				</div>
				<div class="col-75">
					<?php 
						include "../config/connection.php";
						$id = $_GET['id'];
						$query_mysql = mysqli_query($connect,"select * from purchase_order LEFT JOIN supplier ON supplier.id_supplier = purchase_order.id_supplier where id_purchase_order = '$id'")or die(mysql_error());
						$dataPO = mysqli_fetch_array($query_mysql);
					?>
					<input type="text" name="no_po" value="<?php echo $dataPO['no_po'];?>" readonly>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="supplier">Supplier</label>
				</div>
				<div class="col-75">
					<input type="text" name="nama_supplier" value="<?php echo $dataPO['nama_supplier'];?>" readonly>
					<input type="text" name="id_supplier" value="<?php echo $dataPO['id_supplier'];?>" hidden>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="tanggal_retur">Tanggal Retur</label>
				</div>
				<div class="col-75">
					<input type="date" name="tanggal_retur">
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="nama_bahan">Nama Bahan</label>
				</div>
				<div class="col-75">
					<input type="text" name="nama_bahan" value="<?php echo $dataPO['nama_bahan'];?>" readonly>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="jenis_bahan">Jenis Bahan</label>
				</div>
				<div class="col-75">
					<input type="text" name="jenis_bahan" value="<?php echo $dataPO['jenis_bahan'];?>" readonly>
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
					<label for="warna_bahan">Warna Bahan</label>
				</div>
				<div class="col-75">
					<input type="text" name="warna_bahan" value="<?php echo $dataPO['warna_bahan'];?>" readonly>
				</div>
			</div>
			<div class="row">
				<input type="submit" value="Simpan" name="submitButtonReturn">
			</div>
		</form>
		</div>
	</div>
	<?php } ?>
	<div id="halaman">
	<?php
		if(isset($_GET['pesan'])){
			if($_GET['pesan'] == 'input'){
				echo '<p>Berhasil input bahan Retur!</p><br/>';
			} else if($_GET['pesan'] == 'inputgagal') {
				echo '<p>Gagal input bahan Retur!</p><br/>';
			} else if($_GET['pesan'] == 'hapus') {
				echo '<p>Berhasil menghapus bahan Retur!</p></br/>';
			} else if($_GET['pesan'] == 'hapusgagal') {
				echo '<p>Gagal menghapus bahan Retur!</p></br/>';
			} else if($_GET['pesan'] == 'update') {
				echo '<p>Berhasil memperbaharui data bahan Retur!</p></br/>';
			} else if($_GET['pesan'] == 'updategagal') {
				echo '<p>Gagal memperbaharui data bahan Retur!</p></br/>';
			} else if($_GET['pesan'] == 'error') {
				echo '<p>Gagal melebihi jumlah bahan dalam PO!</p></br/>';
			}
		}
		?>
		<div class="judul">		
			<h2>Retur Details</h1>
		</div>
		<br/>
		<table border="1" class="demo-table">
			<tr>
				<th>No.</th>
				<th>no_po</th>
				<th>nama_supplier</th>
				<th>Tanggal Retur</th>
				<th>Quantity</th>
				<th>Action</th>
			</tr>
			<?php 
			include "../config/connection.php";
			$halaman = 10;
			$page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
			$mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
			$result = mysqli_query($connect,"select * from retur");
			$total = mysqli_num_rows($result);
			$pages = ceil($total/$halaman);            
			$nomor = $mulai+1;
			$query_mysql = mysqli_query($connect,"select * from retur LEFT JOIN supplier ON supplier.id_supplier = retur.id_supplier LEFT JOIN purchase_order ON purchase_order.id_purchase_order = retur.id_purchase_order LIMIT $mulai, $halaman")or die(mysql_error());
			while($data = mysqli_fetch_array($query_mysql)){
			?>
			<tr>
				<td><?php echo $nomor++; ?></td>
				<td><?php echo $data['no_po']; ?></td>
				<td><?php echo $data['nama_supplier']; ?></td>
				<td><?php echo $data['tgl_retur']; ?></td>
				<td><?php echo $data['quantity']; ?></td>
				<td>
					<a href="../controllers/proses_hapus_return.php?id=<?php echo $data['id_retur']; ?>" onclick="return confirm(‘Yakin Hapus?’)">Hapus</a>	
				</td>
			</tr>
			<?php
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