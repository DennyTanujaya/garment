<?php
	session_start();
	if(!isset($_SESSION['nama_user'])){
		header("location:index.php");
	} else {
		date_default_timezone_set('Asia/Jakarta');
		include ("../config/connection.php");
		include ("../assets/function.php");
		if(isset($_POST['submitButtonPenjualan'])){ //check if form was submitted
			$createDate = date('d-m-Y  h:i:s a');
			$createBy = $_SESSION['nama_user'];
			
			$no_invoice = $_POST['no_invoice'];
			$no_surat_jalan = $_POST['no_surat_jalan'];
			$id_customer = $_POST['customer'];
			$tanggal_penjualan = $_POST['tanggal_penjualan'];
			$seller = $_POST['seller'];
			$nama_rekening = $_POST['nama_rekening'];
			$cabang = $_POST['cabang'];
			$atas_nama = $_POST['atas_nama'];
			$nomor_rekening = $_POST['nomor_rekening'];
			$note = $_post['note'];
			
			$jumlah = count($no_surat_jalan);
			for($i = 0; $i < $jumlah; $i++){
				//Update Surat Jalan
				mysqli_query($connect, "UPDATE surat_jalan_penjualan SET no_invoice='$no_invoice' WHERE no_surat_jalan='$no_surat_jalan[$i]'");
				//Insert Invoice
				mysqli_query($connect, "INSERT INTO penjualan (no_invoice, seller, note, nama_rekening, cabang, atas_nama, nomor_rekening, tanggal_penjualan, id_customer, no_surat_jalan_penjualan, createBy, createDate) VALUES ('$no_invoice', '$seller', '$note', '$nama_rekening', '$cabang', '$atas_nama', '$nomor_rekening', '$tanggal_penjualan', '$id_customer', '$no_surat_jalan[$i]', '$createBy', '$createDate')");
				
			}
			header("location:penjualan.php?pesan=input");
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
			<h1>Penjualan Pages</h1>
		</div>
		<br/>
		<?php
		if(isset($_GET['pesan'])){
			if($_GET['pesan'] == 'input'){
				echo '<p>Berhasil input Penjualan!</p><br/>';
			} else if($_GET['pesan'] == 'inputgagal') {
				echo '<p>Gagal input Penjualan!</p><br/>';
			} else if($_GET['pesan'] == 'hapus') {
				echo '<p>Berhasil membatalkan Penjualan!</p></br/>';
			} else if($_GET['pesan'] == 'gagalhapus'){ 
				echo '<p>Gagal membatalkan Penjualan!</p></br/>';
			} else if($_GET['pesan'] == 'update'){ 
				echo '<p>Berhasil memperbaharui Penjualan!</p></br/>';
			} else if($_GET['pesan'] == 'updategagal'){ 
				echo '<p>Gagal memperbaharui Penjualan!</p></br/>';
			} else if($_GET['pesan'] == 'errorStock'){ 
				echo '<p>Gagal! Stock tidak mencukupi !</p></br/>';
			} else if($_GET['pesan'] == 'error'){ 
				echo '<p>Gagal! Data kosong !</p></br/>';
			}
		}
		?>
		<div class="container">
		<h3>Input data baru</h3>
		<form action="#" method="post">		
			<div class="row">
				<div class="col-25">
					<label for="no_invoice">No. Invoice</label>
				</div>
				<div class="col-75">
					<?php 
					date_default_timezone_set('Asia/Jakarta');
					include ("../config/connection.php");
					$datePO = date('Y/m/d');
					$query = "SELECT max(no_invoice) as maxKode FROM penjualan";
					$hasil = mysqli_query($connect,$query);
					$data = mysqli_fetch_array($hasil);
					$no_invoice = $data['maxKode'];
					$noUrut = (int) substr($no_invoice, 15, 3);
					$noUrut++;
					$no_invoice = "INV/". $datePO . "/" . sprintf("%03s", $noUrut);
					?>
					<input type="text" name="no_invoice" value="<?php echo $no_invoice; ?>" readonly>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="nama_seller">Nama Seller</label>
				</div>
				<div class="col-75">
					<input type="text" name="seller">
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="tanggal_penjualan">Tanggal Penjualan</label>
				</div>
				<div class="col-75">
					<input type="date" name="tanggal_penjualan">
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="customer">Customer</label>
				</div>
				<div class="col-75">
					<select id="customer" name="customer">
						<option value="" selected>Silahkan pilih Customer</option>
						<?php 
							include "../config/connection.php";
							$query_mysql = mysqli_query($connect,"select * from customer")or die(mysql_error());
							while($data = mysqli_fetch_array($query_mysql)){
						?>
							<option value="<?php echo $data['id_customer'];?>"><?php echo $data['nama_customer'];?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="note">Notes</label>
				</div>
				<div class="col-75">
					<input type="text" name="note">
				</div>
			</div>
			<h2>Data Rekening</h2>
			<div class="row">
				<div class="col-25">
					<label for="nama_rekening">Nama Bank</label>
				</div>
				<div class="col-75">
					<input type="text" name="nama_rekening">
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="cabang">Cabang</label>
				</div>
				<div class="col-75">
					<input type="text" name="cabang">
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="atas_nama">Nama Rekening</label>
				</div>
				<div class="col-75">
					<input type="text" name="atas_nama">
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="nomor_rekening">Nomor Rekening</label>
				</div>
				<div class="col-75">
					<input type="text" name="nomor_rekening">
				</div>
			</div>
			<br /><br />
			<h2>Data Barang</h2>
			<div class="form-group fieldGroup">
				<div class="row">
					<div class="col-25">
						<label for="no_seri">No. Surat Jalan</label>
					</div>
					<div class="col-75">
						<select id="no_surat_jalan" name="no_surat_jalan[]">
							<option value="" selected>Silahkan pilih No. Surat Jalan</option>
							<?php 
								include "../config/connection.php";
								$query_mysql_surat_jalan_penjualan = mysqli_query($connect,"select * from surat_jalan_penjualan WHERE cancellation='NO' AND no_invoice='empty' GROUP BY no_surat_jalan")or die(mysql_error());
								while($dataSuratJalanPenjualan = mysqli_fetch_array($query_mysql_surat_jalan_penjualan)){
							?>
								<option value="<?php echo $dataSuratJalanPenjualan['no_surat_jalan'];?>"><?php echo $dataSuratJalanPenjualan['no_surat_jalan'];?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="input-group-addon"> 
					<a href="javascript:void(0)" class="add_field_button addMore"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Add</a>
				</div>
				<br /><br />
			</div>
			<br /><br />
			<div class="row">
				<input type="submit" value="Simpan" name="submitButtonPenjualan">
			</div>
		</form>
		<!-- COPY FIELD -->
		<div class="form-group fieldGroupCopy" style="display: none;">
			<div class="row">
				<div class="col-25">
					<label for="no_surat_jalan">No. Surat Jalan</label>
				</div>
				<div class="col-75">
					<select id="no_surat_jalan" name="no_surat_jalan[]">
						<option value="" selected>Silahkan pilih No. Surat Jalan</option>
						<?php 
							include "../config/connection.php";
							$query_mysql_surat_jalan_penjualan = mysqli_query($connect,"select * from surat_jalan_penjualan WHERE cancellation='NO' AND no_invoice='empty' GROUP BY no_surat_jalan")or die(mysql_error());
							while($dataSuratJalanPenjualan = mysqli_fetch_array($query_mysql_surat_jalan_penjualan)){
						?>
							<option value="<?php echo $dataSuratJalanPenjualan['no_surat_jalan'];?>"><?php echo $dataSuratJalanPenjualan['no_surat_jalan'];?></option>
						<?php } ?>
					</select>
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
			<h2>Penjualan Details</h1>
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
				<th>No. Invoice</th>
				<th>Tanggal Penjualan</th>
				<th>Customer</th>
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
				$result = mysqli_query($connect,"select * from penjualan LEFT JOIN customer ON customer.id_customer=penjualan.id_customer WHERE cancellation != 'YES' AND (no_invoice LIKE '%$search%' or nama_customer LIKE '%$search%') GROUP BY no_invoice");
				$query_mysql = mysqli_query($connect,"select * from penjualan LEFT JOIN customer ON customer.id_customer=penjualan.id_customer WHERE penjualan.cancellation != 'YES' AND (no_invoice LIKE '%$search%' OR nama_customer LIKE '%$search%') GROUP BY no_invoice LIMIT $mulai, $halaman")or die(mysql_error());
			} else {
				$result = mysqli_query($connect,"select * from penjualan WHERE cancellation != 'YES'");
				$query_mysql = mysqli_query($connect,"select * from penjualan LEFT JOIN customer ON customer.id_customer=penjualan.id_customer WHERE penjualan.cancellation != 'YES' GROUP BY no_invoice LIMIT $mulai, $halaman")or die(mysql_error());
			}
			$total = mysqli_num_rows($result);
			$pages = ceil($total/$halaman);            
			$nomor = $mulai+1;
			
			while($data = mysqli_fetch_array($query_mysql)){
			?>
			<tr>
				<td><?php echo $nomor++; ?></td>
				<td><?php echo $data['no_invoice']; ?></td>
				<td><?php echo $data['tanggal_penjualan']; ?></td>
				<td><?php echo $data['nama_customer'];?></td>
				<td>
					<a href="details/detail_penjualan.php?no_invoice=<?php echo $data['no_invoice']; ?>" class="ahrefButton">Detail</a>
					<a href="print/penjualan_detail_print.php?no_invoice=<?php echo $data['no_invoice']; ?>" target="_BLANK" class="ahrefButton">Print</a>
					<a href="../controllers/proses_cancel_penjualan.php?no_invoice=<?php echo $data['no_invoice']; ?>" onclick="return confirm(‘Yakin Hapus?’)" class="ahrefButton">Batalkan</a>		
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