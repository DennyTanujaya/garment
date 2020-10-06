<?php
	session_start();
	if(!isset($_SESSION['nama_user'])){
		header("location:index.php");
	} else {
		date_default_timezone_set('Asia/Jakarta');
		include ("../config/connection.php");
		include ("../assets/function.php");
		if(isset($_POST['submitButtonPurchaseOrder'])){ //check if form was submitted
			if(!empty($_POST['tgl_pembelian'])){
				$createDate = date('d-m-Y  h:i:s a');
				$createBy = $_SESSION['nama_user'];
				
				$supplier = $_POST['supplier'];
				date_default_timezone_set('Asia/Jakarta');
				include ("../config/connection.php");
				$datePO = date('Y/m/d');
				$query = "SELECT max(no_po) as maxKode FROM purchase_order";
				$hasil = mysqli_query($connect,$query);
				$data = mysqli_fetch_array($hasil);
				$no_po = $data['maxKode'];
				$noUrut = (int) substr($no_po, 15, 3);
				$noUrut++;
						
				$no_po = $supplier . "/" . $datePO . "/" . sprintf("%03s", $noUrut);
				$tgl_pembelian = $_POST['tgl_pembelian'];
				$tgl_masuk_barang = $_POST['tgl_masuk_barang'];
				$no_surat_jalan = $_POST['no_surat_jalan'];
				$no_po_supplier = $_POST['no_po_supplier'];
				$jumlah_bahan = $_POST['jumlah_bahan'];
				$perKilo = $_POST['perKilo'];
				$harga_per_kilo = $_POST['harga_per_kilo'];
				$note = $_POST['note'];
				
				mysqli_query($connect, "INSERT INTO purchase_order (no_po, tgl_pembelian, tgl_masuk_barang, no_surat_jalan, status_return, id_supplier, no_po_supplier, jumlah_bahan, perKilo, harga_per_kilo, createBy, createDate, status, status_pembayaran, notes) VALUES ('$no_po', '$tgl_pembelian', '$tgl_masuk_barang', '$no_surat_jalan', '0', '$supplier', '$no_po_supplier', '$jumlah_bahan', '$perKilo', '$harga_per_kilo', '$createBy', '$createDate', '0', '0', '$note')");
				header("location:purchase_order_list.php?pesan=input");
			} else {
				header("location:purchase_order_list.php?pesan=error");
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
					$(wrapper).append('<br /><br /><div><div class="row"><div class="col-25"><label for="nama_bahan">Nama Bahan</label></div><div class="col-75"><input type="text" name="nama_bahan[]"></div></div><div class="row"><div class="col-25"><label for="jenis_bahan">Jenis Bahan</label></div><div class="col-75"><input type="text" name="jenis_bahan[]"></div></div><div class="row"><div class="col-25"><label for="warna_bahan">Warna Bahan</label></div><div class="col-75"><input type="text" name="warna_bahan[]"></div></div><div class="row"><div class="col-25"><label for="bahan_per_roll">Bahan Per Roll</label></div><div class="col-75"><input type="text" name="jumlah_bahan[]"></div></div><div class="row"><div class="col-25"><label for="perKilo">Bahan Per Kilo</label></div><div class="col-75"><input type="text" name="perKilo[]"></div></div><div class="row"><div class="col-25"><label for="harga_per_kilo">Harga Per Kilo</label></div><div class="col-75"><input type="text" name="harga_per_kilo[]"></div></div><a href="#" class="remove_field">Remove</a></div>'); //add input box
				}
			});
			
			$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
				e.preventDefault(); $(this).parent('div').remove(); x--;
			})
		});
		
		$(document).ready(function() { 
          
            $(function() { 
                $( "#my_date_picker" ).datepicker(); 
            }); 
        }) 
		
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
			<h1>Purchase Order Pages</h1>
		</div>
		<br/>
		<?php
		if(isset($_GET['pesan'])){
			if($_GET['pesan'] == 'input'){
				echo '<p>Berhasil input Purchase Order!</p><br/>';
			} else if($_GET['pesan'] == 'inputgagal') {
				echo '<p>Gagal input Purchase Order!</p><br/>';
			} else if($_GET['pesan'] == 'hapus') {
				echo '<p>Berhasil menghapus Purchase Order!</p></br/>';
			} else if($_GET['pesan'] == 'hapusgagal') {
				echo '<p>Gagal menghapus Purchase Order!</p></br/>';
			} else if($_GET['pesan'] == 'update') {
				echo '<p>Berhasil memperbaharui data Purchase Order!</p></br/>';
			} else if($_GET['pesan'] == 'updategagal') {
				echo '<p>Gagal memperbaharui Purchase Order!</p></br/>';
			} else if($_GET['pesan'] == 'error') {
				echo '<p>Gagal! Data Kosong!</p></br/>';
			}
		}
		?>
		<div class="container">
		<h3>Input data baru</h3>
		<form action="#" method="post">	
			<div class="row">
				<div class="col-25">
					<label for="supplier">Supplier</label>
				</div>
				<div class="col-75">
					<select id="supplier" name="supplier">
						<option value="" selected>Silahkan pilih supplier</option>
						<?php 
							include "../config/connection.php";
							$query_mysql = mysqli_query($connect,"select * from supplier")or die(mysql_error());
							$nomor = 1;
							while($data = mysqli_fetch_array($query_mysql)){
						?>
							<option value="<?php echo $data['kode_supplier'];?>"><?php echo $data['nama_supplier'];?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="No. PO Supplier">No. PO Supplier</label>
				</div>
				<div class="col-75">
					<input type="text" name="no_po_supplier">
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="tgl_pembelian">Tanggal Pembelian</label>
				</div>
				<div class="col-75">
					<input type="date" name="tgl_pembelian">
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="tgl_masuk_barang">Tanggal Masuk Barang</label>
				</div>
				<div class="col-75">
					<input type="date" name="tgl_masuk_barang">
				</div>
			</div>	
			<div class="row">
				<div class="col-25">
					<label for="No. Surat Jalan">No. Surat Jalan</label>
				</div>
				<div class="col-75">
					<input type="text" name="no_surat_jalan">
				</div>
			</div>
			<br /><br />
			<div class="row">
				<div class="col-25">
					<label for="bahan_per_roll">Jumlah Roll</label>
				</div>
				<div class="col-75">
					<input type="text" name="jumlah_bahan">
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="perKilo">Jumlah Kilo</label>
				</div>
				<div class="col-75">
					<input type="text" name="perKilo">
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="harga_per_kilo">Total Harga</label>
				</div>
				<div class="col-75">
					<input type="text" name="harga_per_kilo">
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="notes">Notes</label>
				</div>
				<div class="col-75">
					<textarea name="note" style="height:200px"></textarea>
				</div>
			</div>
			<br /><br />
			<div class="row">
				<input type="submit" value="Simpan" name="submitButtonPurchaseOrder">
			</div>
		</form>
		</div>
	</div>
	<div id="halaman">
		<div class="judul">		
			<h2>Purchase Order Details</h1>
		</div>
		<br />
		<form action="#" method="post">	
			<div class="col-30">
				<input type="text" name="search" placeholder="Ketik kata pencarian disini">
				<input type="submit" name="searchButton" value="Cari" hidden>
			</div>
		</form>
		<table border="1" class="demo-table">
			<tr>
				<th>No.</th>
				<th>No PO</th>
				<th>Tanggal Pembelian</th>
				<th>Tanggal Masuk Barang</th>
				<th>No. Surat Jalan</th>
				<th>Supplier</th>
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
				$result = mysqli_query($connect,"select * from purchase_order LEFT JOIN supplier ON supplier.kode_supplier = purchase_order.id_supplier WHERE (no_po LIKE '%$search%' OR tgl_pembelian LIKE '%$search%' OR nama_supplier LIKE '%$search%' OR tgl_masuk_barang LIKE '%$search%') GROUP BY no_po");
				$query_mysql = mysqli_query($connect,"select * from purchase_order LEFT JOIN supplier ON supplier.kode_supplier = purchase_order.id_supplier WHERE (no_po LIKE '%$search%' OR tgl_pembelian LIKE '%$search%' OR nama_supplier LIKE '%$search%' OR tgl_masuk_barang LIKE '%$search%') GROUP BY no_po LIMIT $mulai, $halaman");
			} else {
				$result = mysqli_query($connect,"select * from purchase_order LEFT JOIN supplier ON supplier.kode_supplier = purchase_order.id_supplier GROUP BY no_po");
				$query_mysql = mysqli_query($connect,"select * from purchase_order LEFT JOIN supplier ON supplier.kode_supplier = purchase_order.id_supplier GROUP BY no_po LIMIT $mulai, $halaman");
			}
			$total = mysqli_num_rows($result);
			$pages = ceil($total/$halaman);            
			$nomor = $mulai+1;
			while($data = mysqli_fetch_array($query_mysql)){
			?>
			<tr>
				<td><?php echo $nomor++; ?></td>
				<td><a href="details/purchase_order_details.php?no_po=<?php echo $data['no_po']; ?>"><?php echo $data['no_po']; ?></a></td>
				<td><?php echo $data['tgl_pembelian']; ?></td>
				<td><?php echo $data['tgl_masuk_barang']; ?></td>
				<td><?php echo $data['no_surat_jalan']; ?></td>
				<td><?php echo $data['nama_supplier']; ?></td>
				<td>
					<a href="details/purchase_order_details.php?no_po=<?php echo $data['no_po']; ?>" class="ahrefButton">Detail</a>
					<!--<a href="print/purchase_order_detail_print.php?no_po=<?php echo $data['no_po']; ?>" target="_BLANK" class="ahrefButton">Print</a>-->
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