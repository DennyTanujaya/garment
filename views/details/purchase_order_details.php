<?php
	session_start();
	if(!isset($_SESSION['nama_user'])){
		header("location:../index.php");
	} else {
		date_default_timezone_set('Asia/Jakarta');
		include ("../../config/connection.php");
		include ("../../assets/function.php");
		
		if(isset($_GET['id_purchase_order'])){
			$id = $_GET['id_purchase_order'];
			$query_mysql = mysqli_query($connect,"select * from purchase_order LEFT JOIN supplier ON supplier.kode_supplier = purchase_order.id_supplier WHERE purchase_order.id_purchase_order='$id'")or die(mysql_error());
			$data = mysqli_fetch_assoc($query_mysql);
			$dataPO = mysqli_fetch_all($query_mysql);
			$totalPO = mysqli_num_rows($query_mysql);
		} else if(isset($_GET['no_po'])) {
			$no_po = $_GET['no_po'];
			$query_mysql = mysqli_query($connect,"select * from purchase_order LEFT JOIN supplier ON supplier.kode_supplier = purchase_order.id_supplier WHERE purchase_order.no_po='$no_po'")or die(mysql_error());
			$data = mysqli_fetch_array($query_mysql);
			$query_mysql_po = mysqli_query($connect,"select * from purchase_order LEFT JOIN supplier ON supplier.kode_supplier = purchase_order.id_supplier WHERE purchase_order.no_po='$no_po'")or die(mysql_error());
			$dataPO = mysqli_fetch_all($query_mysql_po);
			$totalPO = mysqli_num_rows($query_mysql);
			// Cetak Stock
			$query_mysql_seri = mysqli_query($connect,"select * from stock WHERE no_po='$no_po'");
			$stock= mysqli_fetch_all($query_mysql_seri);
			// Cetak Surat Jalan Bordir
			$query_mysql_surat_bordir = mysqli_query($connect,"select * from salary_cmt WHERE no_po='$no_po'");
			$surat_bordir= mysqli_fetch_all($query_mysql_surat_bordir);
			
			$query_mysql_surat_cmt = mysqli_query($connect,"select * from surat_jalan_cmt WHERE no_po='$no_po'");
			$surat_cmt= mysqli_fetch_all($query_mysql_surat_cmt);
			
			$query_mysql_surat_sablon = mysqli_query($connect,"select * from surat_jalan_sablon WHERE no_po='$no_po'");
			$surat_sablon= mysqli_fetch_all($query_mysql_surat_sablon);
			
			$query_mysql_surat_penjualan = mysqli_query($connect,"select * from surat_jalan_penjualan LEFT JOIN stock ON stock.nomor_seri=surat_jalan_penjualan.no_seri WHERE stock.no_po='$no_po'");
			$surat_penjualan= mysqli_fetch_all($query_mysql_surat_penjualan);
			
			$query_mysql_invoice = mysqli_query($connect,"select * from penjualan LEFT JOIN surat_jalan_penjualan ON penjualan.no_surat_jalan_penjualan=surat_jalan_penjualan.no_surat_jalan LEFT JOIN stock ON stock.nomor_seri=surat_jalan_penjualan.no_seri WHERE stock.no_po='$no_po' GROUP BY penjualan.no_invoice");
			$surat_invoice = mysqli_fetch_all($query_mysql_invoice);
			$totalPenyusutan = 0;
			
		} else {
			header("location:../home.php");
		}
?>

<html>
<head>
	<title>Seranno</title>
	<link rel="stylesheet" type="text/css" href="../../assets/style.css">
	<script type="text/javascript" src="../../assets/jquery.js"></script>
	<link rel="stylesheet" href="../../assets/jquery/jquery-ui.css">
	<script src="../../assets/jquery/jquery-ui.min.js"></script>
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
	</script>
</head>
<body>
<div class="content">
	<?php include('navbar.php'); ?>
	<div id="halaman">
		<div class="judul">		
			<h1>Details Purchase Order</h1>
		</div>
		<br/>
		<div class="container">
			<div class="row">
				<div class="col-25">
					<label for="no_po">No. PO</label>
				</div>
				<div class="col-75">.
					<p><?php echo $data['no_po'];?></p>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="tgl_pembelian">Tanggal Pembelian</label>
				</div>
				<div class="col-75">
					<p><?php echo $data['tgl_pembelian'];?></p>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="tgl_masuk_barang">Tanggal Masuk Barang</label>
				</div>
				<div class="col-75">
					<p><?php echo $data['tgl_masuk_barang'];?></p>
				</div>
			</div>	
			<div class="row">
				<div class="col-25">
					<label for="No. Surat Jalan">No. Surat Jalan</label>
				</div>
				<div class="col-75">
					<p><?php echo $data['no_surat_jalan'];?></p>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="supplier">Supplier</label>
				</div>
				<div class="col-75">
					<p><?php echo $data['nama_supplier'];?></p>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="no_po_supplier">No PO Supplier</label>
				</div>
				<div class="col-75">
					<p><?php echo $data['no_po_supplier'];?></p>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="notes">Notes</label>
				</div>
				<div class="col-75">
					<p><?php 
						if (!empty($data['notes'])) {
							echo $data['notes'];
						} else {
							echo '-';
						}
					?></p>
				</div>
			</div>
			<br /><br />
			<table border="1" class="demo-table">
				<tr>
					<th>No.</th>
					<th>Jumlah Roll</th>
					<th>Jumlah Kilo</th>
					<th>Harga</th>
					<th>Action</th>
				</tr>
				<?php
				$nomor=1;
				$grandTotal = 0;
				foreach($dataPO as $row){
					$total = $row[11] * $row[12];
					$grandTotal += $total;
				?>
				<tr>
					<td><?php echo $nomor++; ?></td>
					<td><?php echo $row[10]; ?></td>
					<td><?php echo $row[11]; ?></td>
					<td><?php echo rupiah($row[12]); ?></td>
					<td>
						<?php
						if($row[18] == 0){
						?> 
							<!--<a href="../../controllers/proses_update_purchase_order.php?id=<?php echo $row[0]; ?>" class="ahrefButton">Edit</a>-->
							<a href="../return.php?id=<?php echo $row[0]; ?>" class="ahrefButton">Retur</a>
						<?php } ?>	
						<?php if( empty($surat_bordir) ) { ?>
						<a href="../../controllers/proses_hapus_purchase_order.php?id=<?php echo $row[0]; ?>" onclick="return confirm(‘Yakin Hapus?’)" class="ahrefButton">Hapus</a>						
						<?php } ?>
					</td>
				</tr>
				<?php } ?>
			</table>
			<br /><br /><br /><br /><br />
			<?php
				if ( !empty($stock) ) {
			?>
			<table border="1" class="demo-table">
				<tr><th colspan="7">STOCK</th></tr>
				<tr>
					<th>No.</th>
					<th>No Seri</th>
					<th>Nama Bahan</th>
					<th>Jenis Bahan</th>
					<th>Warna Bahan</th>
					<th>Size</th>
					<th>Harga Bahan</th>
				</tr>
				<?php
					$nomor=1;
					foreach($stock as $row){
				?>
				<tr>
					<td><?php echo $nomor++; ?></td>
					<td><?php echo $row[5]; ?></td>
					<td><?php echo $row[7]; ?></td>
					<td><?php echo $row[8]; ?></td>
					<td><?php echo $row[11]; ?></td>
					<td><?php echo $row[10]; ?></td>
					<td><?php echo rupiah($row[12]); ?></td>
				</tr>
				<?php } }?>
			</table>
			<br /><br /><br /><br /><br />
			<table border="1" class="demo-table">
				<tr><th colspan="8">Surat Jalan Bordir</th></tr>
				<tr>
					<th>No.</th>
					<th>No Surat Jalan</th>
					<th>Nomor Seri</th>
					<th>Tanggal Keluar</th>
					<th>Tanggal Masuk</th>
					<th>Quantity Awal</th>
					<th>Quantity Masuk</th>
					<th>Total Penyusutan</th>
				</tr>
				<?php
				if ( !empty($surat_bordir) ) {
					$nomor=1;
					foreach($surat_bordir as $row){
						$totalPenyusutanBordir = $row[8] - $row[9];
				?>
				<tr>
					<td><?php echo $nomor++; ?></td>
					<td><?php echo $row[2]; ?></td>
					<td><?php echo $row[4]; ?></td>
					<td><?php echo $row[10]; ?></td>
					<td><?php echo $row[11]; ?></td>
					<td><?php echo $row[8]; ?></td>
					<td><?php echo $row[9]; ?></td>
					<td><?php 
						if(!empty($row[9])) {
							echo $totalPenyusutanBordir; 
							$totalPenyusutan = $totalPenyusutan + $totalPenyusutanBordir;
							$subTotalBordir = $subTotalBordir + $totalPenyusutanBordir;
						} else {
							echo '0';
						}
					?></td>
				</tr>
				<?php 
				}
				?>
				<tr>
					<td colspan="7">Total Penyusutan di Bordir</td>
					<td><b><?php echo $subTotalBordir; ?></b></td>
				</tr>
				<?php } else {
					echo '<tr><td colspan="8">No Data</td></tr>';
				}?>
			</table>
			<br /><br /><br /><br /><br />
			<table border="1" class="demo-table">
				<tr><th colspan="8">Surat Jalan CMT</th></tr>
				<tr>
					<th>No.</th>
					<th>No Surat Jalan</th>
					<th>Nomor Seri</th>
					<th>Tanggal Keluar</th>
					<th>Tanggal Masuk</th>
					<th>Quantity Awal</th>
					<th>Quantity Masuk</th>
					<th>Total Penyusutan</th>
				</tr>
				<?php
				if ( !empty($surat_cmt) ) {
					$nomor=1;
					foreach($surat_cmt as $row){
						$totalPenyusutanCmt = $row[8] - $row[9];
				?>
				<tr>
					<td><?php echo $nomor++; ?></td>
					<td><?php echo $row[2]; ?></td>
					<td><?php echo $row[4]; ?></td>
					<td><?php echo $row[10]; ?></td>
					<td><?php echo $row[11]; ?></td>
					<td><?php echo $row[8]; ?></td>
					<td><?php echo $row[9]; ?></td>
					<td><?php 
						if(!empty($row[9])) {
							echo $totalPenyusutanCmt;
							$totalPenyusutan = $totalPenyusutan + $totalPenyusutanCmt;
							$subTotalCmt = $subTotalCmt + $totalPenyusutanCmt;
						} else {
							echo '0';
						}
					?></td>
				</tr>
				<?php 
				}
				?>
				<tr>
					<td colspan="7">Total Penyusutan di CMT</td>
					<td><b><?php echo $subTotalCmt; ?></b></td>
				</tr>
				<?php } else {
					echo '<tr><td colspan="8">No Data</td></tr>';
				}?>
			</table>
			<br /><br /><br /><br /><br />
			<table border="1" class="demo-table">
				<tr><th colspan="8">Surat Jalan Sablon</th></tr>
				<tr>
					<th>No.</th>
					<th>No Surat Jalan</th>
					<th>Nomor Seri</th>
					<th>Tanggal Keluar</th>
					<th>Tanggal Masuk</th>
					<th>Quantity Awal</th>
					<th>Quantity Masuk</th>
					<th>Total Penyusutan</th>
				</tr>
				<?php
				if ( !empty($surat_sablon) ) {
					$nomor=1;
					foreach($surat_sablon as $row){
						$totalPenyusutanSablon = $row[8] - $row[9];
				?>
				<tr>
					<td><?php echo $nomor++; ?></td>
					<td><?php echo $row[2]; ?></td>
					<td><?php echo $row[4]; ?></td>
					<td><?php echo $row[10]; ?></td>
					<td><?php echo $row[11]; ?></td>
					<td><?php echo $row[8]; ?></td>
					<td><?php echo $row[9]; ?></td>
					<td><?php 
						if(!empty($row[9])) {
							echo $totalPenyusutanSablon; 
							$totalPenyusutan = $totalPenyusutan + $totalPenyusutanSablon;
							$subTotalSablon = $subTotalSablon + $totalPenyusutanSablon;
						} else {
							echo '0';
						}
					?></td>
				</tr>
				<?php 
				}
				?>
				<tr>
					<td colspan="7">Total Penyusutan di Sablon</td>
					<td><b><?php echo $subTotalSablon; ?></b></td>
				</tr>
				<tr><td></td></tr>
				<tr>
					<th colspan="7">Total Akhir Penyusutan</th>
					<th><?php echo $totalPenyusutan; ?></th>
				</tr>
				<?php } else {
					echo '<tr><td colspan="8">No Data</td></tr>';
				}?>
			</table>
			<br /><br /><br /><br /><br />
			<table border="1" class="demo-table">
				<tr><th colspan="8">Surat Jalan Penjualan</th></tr>
				<tr>
					<th>No.</th>
					<th>No Surat Jalan</th>
					<th>Tanggal Surat Jalan</th>
					<th>Nomor Seri</th>
					<th>Quantity</th>
					<th>Deskripsi</th>
					<th>Harga</th>
					<th>Total</th>
				</tr>
				<?php
					if ( !empty($surat_penjualan) ) {
					$nomor=1;
					foreach($surat_penjualan as $row){
						$totalHargaLusin = $row['4'] * $row['6'];
				?>
				<tr>
					<td><?php echo $nomor++; ?></td>
					<td><?php echo $row[1]; ?></td>
					<td><?php echo $row[2]; ?></td>
					<td><?php echo $row[3]; ?></td>
					<td><?php echo $row[4]; ?></td>
					<td><?php echo $row[5]; ?></td>
					<td><?php echo rupiah($row[6]); ?></td>
					<td><?php 
						if(!empty($row[6])) {
							echo rupiah($totalHargaLusin); 
						} else {
							echo '0';
						}
					?></td>
				</tr>
				<?php }
				} else {
					echo '<tr><td colspan="3">No Data</td></tr>';
				}
				?>
			</table>
			<br /><br /><br /><br /><br />
			<table border="1" class="demo-table">
				<tr>
					<th>No.</th>
					<th>Tanggal Cetak</th>
					<th>No Invoice</th>
				</tr>
				<?php
				if ( !empty($surat_invoice) ) {
					$nomor=1;
					foreach($surat_invoice as $row){
				?>
				<tr>
					<td><?php echo $nomor++; ?></td>
					<td><?php echo $row[3]; ?></td>
					<td><?php echo $row[1]; ?></td>
				</tr>
				<?php }
				} else {
					echo '<tr><td colspan="3">No Data</td></tr>';
				}
				?>
			</table>
		</div>
	</div>
</div>
</body>
</html>
<?php } ?>