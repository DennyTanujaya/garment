<?php
	session_start();
	if(!isset($_SESSION['nama_user'])){
		header("location:index.php");
	} else {
		date_default_timezone_set('Asia/Jakarta');
		include ("../config/connection.php");
		if(isset($_POST['submit'])){ //check if form was submitted
			$id = $_GET['id'];
			$modifyDate = date('d-m-Y  h:i:s a');
			$modifyBy = $_SESSION['nama_user'];
			
			$no_po = $_POST['no_po'];
			$tgl_pembelian = $_POST['tgl_pembelian'];
			$tgl_masuk_barang = $_POST['tgl_masuk_barang'];
			$no_surat_jalan = $_POST['no_surat_jalan'];
			$supplier = $_POST['supplier'];
			$nama_bahan = $_POST['nama_bahan'];
			$jenis_bahan = $_POST['jenis_bahan'];
			$warna_bahan = $_POST['warna_bahan'];
			$jumlah_bahan = $_POST['jumlah_bahan'];
			$perKilo = $_POST['perKilo'];
			$harga_per_kilo = $_POST['harga_per_kilo'];
			$total = $_POST['total'];
			
			if(mysqli_query($connect, "UPDATE purchase_order SET tgl_pembelian='$tgl_pembelian', tgl_masuk_barang='$tgl_masuk_barang', no_surat_jalan='$no_surat_jalan', id_supplier='$supplier', nama_bahan='$nama_bahan', jenis_bahan='$jenis_bahan', warna_bahan='$warna_bahan', jumlah_bahan='$jumlah_bahan', perKilo='$perKilo', harga_per_kilo='$harga_per_kilo', total='$total', modifyBy='$modifyBy', modifyDate='$modifyDate' WHERE id_purchase_order = '$id'")) {
				header("location:../views/purchase_order_list.php?pesan=update");
			} else {
				header("location:../views/purchase_order_list.php?pesan=updategagal");
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
					$(wrapper).append('<div><div class="row"><div class="col-25"><label for="nama_bahan">Nama Bahan</label></div><div class="col-75"><input type="text" name="nama_bahan[]"></div></div><div class="row"><div class="col-25"><label for="jenis_bahan">Jenis Bahan</label></div><div class="col-75"><input type="text" name="jenis_bahan[]"></div></div><div class="row"><div class="col-25"><label for="warna_bahan">Warna Bahan</label></div><div class="col-75"><input type="text" name="warna_bahan[]"></div></div><div class="row"><div class="col-25"><label for="bahan_per_roll">Bahan Per Roll</label></div><div class="col-75"><input type="text" name="jumlah_bahan[]"></div></div><div class="row"><div class="col-25"><label for="perKilo">Bahan Per Kilo</label></div><div class="col-75"><input type="text" name="perKilo[]"></div></div><div class="row"><div class="col-25"><label for="harga_per_kilo">Harga Per Kilo</label></div><div class="col-75"><input type="text" name="harga_per_kilo[]"></div></div><div class="row"><div class="col-25"><label for="harga_total">Harga Total</label></div><div class="col-75"><input type="text" name="total[]"></div></div><a href="#" class="remove_field">Remove</a></div>'); //add input box
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
			include "../config/connection.php";
			$id = $_GET['id'];
			$query_mysql = mysqli_query($connect,"select * from purchase_order where id_purchase_order = '$id'")or die(mysql_error());
			while($data = mysqli_fetch_array($query_mysql)){
		?>
		<div class="container">
			<h3>Update data baru</h3>
			<form action="#" method="post">		
				<div class="row">
					<div class="col-25">
						<label for="no_po">No. PO</label>
					</div>
					<div class="col-75">.
						<input type="text" name="no_po" value="<?php echo $data['no_po'];?>" readonly>
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="tgl_pembelian">Tanggal Pembelian</label>
					</div>
					<div class="col-75">
						<input type="text" name="tgl_pembelian" id="my_date_picker" value="<?php echo $data['tgl_pembelian'];?>">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="tgl_masuk_barang">Tanggal Masuk Barang</label>
					</div>
					<div class="col-75">
						<input type="text" name="tgl_masuk_barang" id="my_date_picker1" value="<?php echo $data['tgl_masuk_barang'];?>">
					</div>
				</div>	
				<div class="row">
					<div class="col-25">
						<label for="No. Surat Jalan">No. Surat Jalan</label>
					</div>
					<div class="col-75">
						<input type="text" name="no_surat_jalan" value="<?php echo $data['no_surat_jalan'];?>">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="supplier">Supplier</label>
					</div>
					<div class="col-75">
						<select id="supplier" name="supplier">
							<?php 
								include "../../config/connection.php";
								$id_supplier = $data['id_supplier'];
								$query_mysql = mysqli_query($connect,"select * from supplier")or die(mysql_error());
								while($dataSupplier = mysqli_fetch_array($query_mysql)){
									if($id_supplier == $dataSupplier['id_supplier']){
							?>
								<option value="<?php echo $dataSupplier['id_supplier'];?>" selected><?php echo $dataSupplier['nama_supplier'];?></option>
							<?php } else {?>
							<option value="<?php echo $dataSupplier['id_supplier'];?>"><?php echo $dataSupplier['nama_supplier'];?></option>
							<?php 
								}
							}
							?>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="nama_bahan">Nama Bahan</label>
					</div>
					<div class="col-75">
						<input type="text" name="nama_bahan" value="<?php echo $data['nama_bahan'];?>">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="jenis_bahan">Jenis Bahan</label>
					</div>
					<div class="col-75">
						<input type="text" name="jenis_bahan" value="<?php echo $data['jenis_bahan'];?>">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="warna_bahan">Warna Bahan</label>
					</div>
					<div class="col-75">
						<input type="text" name="warna_bahan" value="<?php echo $data['warna_bahan'];?>">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="bahan_per_roll">Bahan Per Roll</label>
					</div>
					<div class="col-75">
						<input type="text" name="jumlah_bahan" value="<?php echo $data['jumlah_bahan'];?>">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="perKilo">Bahan Per Kilo</label>
					</div>
					<div class="col-75">
						<input type="text" name="perKilo" value="<?php echo $data['perKilo'];?>">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="harga_per_kilo">Harga Per Kilo</label>
					</div>
					<div class="col-75">
						<input type="text" name="harga_per_kilo" value="<?php echo $data['harga_per_kilo'];?>">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="harga_total">Harga Total</label>
					</div>
					<div class="col-75">
						<input type="text" name="total" value="<?php echo $data['total'];?>">
					</div>
				</div>
				<?php
					}
				?>
				<div class="row">
					<!--<input type="text" name="id_purchase_order" value="<?php echo $id;?>" hidden>-->
					<input type="submit" value="Simpan" name="submit">
				</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>
<?php } ?>