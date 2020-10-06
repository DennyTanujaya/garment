<?php
	session_start();
	if(!isset($_SESSION['nama_user'])){
		header("location:../index.php");
	} else {
		date_default_timezone_set('Asia/Jakarta');
		include ("../../config/connection.php");
		include ("../../assets/function.php");
		
		if(isset($_GET['id_karyawan'])){
			$id = $_GET['id_karyawan'];
			$tanggal_gajian = $_GET['tanggal_penggajian'];
			$query_mysql = mysqli_query($connect,"select * from salary LEFT JOIN karyawan ON karyawan.id_karyawan = salary.id_karyawan WHERE salary.id_karyawan='$id' AND salary.tanggal_gajian='$tanggal_gajian'");
			$data = mysqli_fetch_array($query_mysql);
			$query_mysql_salary = mysqli_query($connect,"select * from salary WHERE salary.id_karyawan='$id' AND salary.tanggal_gajian='$tanggal_gajian'");
			$dataSalary = mysqli_fetch_all($query_mysql_salary);
			$lokasi = $data['lokasi'];
		} else {
			header("location:../home.php");
		}
?>

<html>
<head>
	<title>Serrano</title>
	<link rel="stylesheet" type="text/css" href="../../assets/style.css">
	<script type="text/javascript" src="../../assets/jquery.js"></script>
	<link rel="stylesheet" href="../../assets/jquery/jquery-ui.css">
	<script src="../../assets/jquery/jquery-ui.min.js"></script>
</head>
<body>
<div class="content">
	<div id="halaman">
		<div class="judul">
			<h2>Slip Gaji</h2>
		</div>
		<br/>
		<div class="container">
			<div class="row">
				<div class="col-25">
					Nama Karyawan&nbsp;: <?php echo $data['nama_karyawan'];?>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					Tanggal Gajian&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $data['tanggal_gajian'];?>
				</div>
			</div>
			<br /><br />
			<table border="0" style="font-size:12px;">
				<tr>
					<th style="width:5px;height:5px;">No.</th>
					<th style="width:2px;height:5px;">Merek</th>
					<th style="width:5px;height:5px;">No. Seri</th>
					<th style="width:5px;height:5px;">Size</th>
					<th style="width:5px;height:5px;">Jenis</th>
					<th style="width:5px;height:5px;">Keterangan</th>
					<th style="width:5px;height:5px;">Total</th>
				</tr>
				<?php
				$nomor=1;
				foreach($dataSalary as $row){
				?>
				<tr>
					<?php if(empty($row[4])){ ?>
					<td colspan="5"></td>
					<?php
					} else {
					?>
					<td style="width:5px;height:5px;"><?php echo $nomor++; ?></td>
					<td style="width:5px;height:5px;"><?php echo $row[2]; ?></a></td>
					<td style="width:5px;height:5px;"><?php echo $row[6]; ?></td>
					<td style="width:5px;height:5px;"><?php echo $row[5]; ?></td>
					<td style="width:5px;height:5px;"><?php echo $row[3]; ?></td>
					<?php } ?>
					<td style="text-align:left">
						<?php
							$ongkos = 0;
							$size = $row[5];
							$divisi = $data['divisi'];
							if($row[10] == 1){
								$query_mysql_saldo = mysqli_query($connect,"select * from salary_saldo WHERE (jenis_kegiatan ='Kantong' AND size='$size')")or die(mysqli_error($connect));
								$dataSaldo = mysqli_fetch_array($query_mysql_saldo);
								echo 'Kantong: '.rupiah($dataSaldo['harga']).'<br />';
								$ongkos = $ongkos + $dataSaldo['harga'];
							}
							if($row[11] == 1){
								$query_mysql_saldo = mysqli_query($connect,"select * from salary_saldo WHERE jenis_kegiatan ='Klep' AND size='$size'")or die(mysqli_error($connect));
								$dataSaldo = mysqli_fetch_array($query_mysql_saldo);
								echo 'Klep: '.rupiah($dataSaldo['harga']).'<br />';
								$ongkos = $ongkos + $dataSaldo['harga'];
							}
							if($row[12] == 1){
								$query_mysql_saldo = mysqli_query($connect,"select * from salary_saldo WHERE jenis_kegiatan ='Tali' AND size='$size'")or die(mysqli_error($connect));
								$dataSaldo = mysqli_fetch_array($query_mysql_saldo);
								echo 'Tali: '.rupiah($dataSaldo['harga']).'<br />';
								$ongkos = $ongkos + $dataSaldo['harga'];
							}
							if($row[13] == 1){
								$query_mysql_saldo = mysqli_query($connect,"select * from salary_saldo WHERE jenis_kegiatan ='Stik Tangan' AND size='$size'")or die(mysqli_error($connect));
								$dataSaldo = mysqli_fetch_array($query_mysql_saldo);
								echo 'Stik Tangan: '.rupiah($dataSaldo['harga']).'<br />';
								$ongkos = $ongkos + $dataSaldo['harga'];
							}
							if($row[14] == 1){
								$query_mysql_saldo = mysqli_query($connect,"select * from salary_saldo WHERE jenis_kegiatan ='Stik Bawah' AND size='$size'")or die(mysqli_error($connect));
								$dataSaldo = mysqli_fetch_array($query_mysql_saldo);
								echo 'Stik Bawah: '.rupiah($dataSaldo['harga']).'<br />';
								$ongkos = $ongkos + $dataSaldo['harga'];
							}
							if($row[21] == 1){
								$query_mysql_saldo = mysqli_query($connect,"select * from salary_saldo WHERE jenis_kegiatan ='Pasang Tali' AND lokasi='$lokasi' AND size='$size'")or die(mysqli_error($connect));
								$dataSaldo = mysqli_fetch_array($query_mysql_saldo);
								echo 'Pasang Tali: '.rupiah($dataSaldo['harga']).'<br />';
								$ongkos = $ongkos + $dataSaldo['harga'];
							}
							if($row[15] == 1){
								$query_mysql_saldo = mysqli_query($connect,"select * from salary_saldo WHERE jenis_kegiatan ='Tangan' AND size='$size'")or die(mysqli_error($connect));
								$dataSaldo = mysqli_fetch_array($query_mysql_saldo);
								echo 'Tangan: '.rupiah($dataSaldo['harga']).'<br />';
								$ongkos = $ongkos + $dataSaldo['harga'];
							}
							if($row[16] == 1){
								$query_mysql_saldo = mysqli_query($connect,"select * from salary_saldo WHERE jenis_kegiatan ='Pundak' AND size='$size'")or die(mysqli_error($connect));
								$dataSaldo = mysqli_fetch_array($query_mysql_saldo);
								echo 'Pundak: '.rupiah($dataSaldo['harga']).'<br />';
								$ongkos = $ongkos + $dataSaldo['harga'];
							}
							if($row[17] == 1){
								$query_mysql_saldo = mysqli_query($connect,"select * from salary_saldo WHERE jenis_kegiatan ='Ketek' AND size='$size'")or die(mysqli_error($connect));
								$dataSaldo = mysqli_fetch_array($query_mysql_saldo);
								echo 'Ketek: '.rupiah($dataSaldo['harga']).'<br />';
								$ongkos = $ongkos + $dataSaldo['harga'];
							}
							if($row[18] == 1){
								$query_mysql_saldo = mysqli_query($connect,"select * from salary_saldo WHERE jenis_kegiatan ='Klep Obras' AND size='$size'")or die(mysqli_error($connect));
								$dataSaldo = mysqli_fetch_array($query_mysql_saldo);
								echo 'Klep: '.rupiah($dataSaldo['harga']).'<br />';
								$ongkos = $ongkos + $dataSaldo['harga'];
							}
							if($row[19] == 1){
								$query_mysql_saldo = mysqli_query($connect,"select * from salary_saldo WHERE jenis_kegiatan ='Samping' AND size='$size'")or die(mysqli_error($connect));
								$dataSaldo = mysqli_fetch_array($query_mysql_saldo);
								echo 'Samping: '.rupiah($dataSaldo['harga']).'<br />';
								$ongkos = $ongkos + $dataSaldo['harga'];
							}
							if($row[20] == 1){
								$query_mysql_saldo = mysqli_query($connect,"select * from salary_saldo WHERE jenis_kegiatan ='Kaki/Bawah' AND size='$size'")or die(mysqli_error($connect));
								$dataSaldo = mysqli_fetch_array($query_mysql_saldo);
								echo 'Kaki/Bawah: '.rupiah($dataSaldo['harga']).'<br />';
								$ongkos = $ongkos + $dataSaldo['harga'];
							}
							if($row[22] == 1){
								$query_mysql_saldo = mysqli_query($connect,"select * from salary_saldo WHERE jenis_kegiatan ='RIP Tangan' AND size='$size'")or die(mysqli_error($connect));
								$dataSaldo = mysqli_fetch_array($query_mysql_saldo);
								echo 'RIP Tangan: '.rupiah($dataSaldo['harga']).'<br />';
								$ongkos = $ongkos + $dataSaldo['harga'];
							}
							if($row[23] == 1){
								$query_mysql_saldo = mysqli_query($connect,"select * from salary_saldo WHERE jenis_kegiatan ='Kam Tangan' AND size='$size'")or die(mysqli_error($connect));
								$dataSaldo = mysqli_fetch_array($query_mysql_saldo);
								echo 'Kam Tangan: '.rupiah($dataSaldo['harga']).'<br />';
								$ongkos = $ongkos + $dataSaldo['harga'];
							}
							if($row[24] == 1){
								$query_mysql_saldo = mysqli_query($connect,"select * from salary_saldo WHERE jenis_kegiatan ='Kam Bawah' AND size='$size'")or die(mysqli_error($connect));
								$dataSaldo = mysqli_fetch_array($query_mysql_saldo);
								echo 'Kam Bawah: '.rupiah($dataSaldo['harga']).'<br />';
								$ongkos = $ongkos + $dataSaldo['harga'];
							}
							if($row[25] == 1){
								$query_mysql_saldo = mysqli_query($connect,"select * from salary_saldo WHERE jenis_kegiatan ='Buang Benang Kecil'")or die(mysqli_error($connect));
								$dataSaldo = mysqli_fetch_array($query_mysql_saldo);
								echo 'Buang Benang Kecil: '.rupiah($dataSaldo['harga']).'<br />';
								$ongkos = $ongkos + $dataSaldo['harga'];
							}
							if($row[26] == 1){
								$query_mysql_saldo = mysqli_query($connect,"select * from salary_saldo WHERE jenis_kegiatan ='Buang Benang Besar'")or die(mysqli_error($connect));
								$dataSaldo = mysqli_fetch_array($query_mysql_saldo);
								echo 'Buang Benang Besar: '.rupiah($dataSaldo['harga']).'<br />';
								$ongkos = $ongkos + $dataSaldo['harga'];
							}
							if($row[27] == 1){
								$query_mysql_saldo = mysqli_query($connect,"select * from salary_saldo WHERE jenis_kegiatan ='Lipat' AND size='$size'")or die(mysqli_error($connect));
								$dataSaldo = mysqli_fetch_array($query_mysql_saldo);
								echo 'Lipat: '.rupiah($dataSaldo['harga']).'<br />';
								$ongkos = $ongkos + $dataSaldo['harga'];
							}
							if($row[28] == 1){
								$query_mysql_saldo = mysqli_query($connect,"select * from salary_saldo WHERE jenis_kegiatan ='Supir'")or die(mysqli_error($connect));
								$dataSaldo = mysqli_fetch_array($query_mysql_saldo);
								echo 'Supir: '.rupiah($dataSaldo['harga']).'<br />';
								$ongkos = $ongkos + $dataSaldo['harga'];
								//$total = $ongkos;
							}
							if($row[30] == 1){
								$query_mysql_saldo = mysqli_query($connect,"select * from salary_saldo WHERE jenis_kegiatan ='Potong' AND size='$size'")or die(mysqli_error($connect));
								$dataSaldo = mysqli_fetch_array($query_mysql_saldo);
								echo 'Potong: '.rupiah($dataSaldo['harga']).'<br />';
								$ongkos = $ongkos + $dataSaldo['harga'];
							}
							if($row[33] == 1){
								$query_mysql_saldo = mysqli_query($connect,"select * from salary_saldo WHERE jenis_kegiatan ='Full Jahit' AND size='$size'")or die(mysqli_error($connect));
								$dataSaldo = mysqli_fetch_array($query_mysql_saldo);
								echo 'Full Jahit: '.rupiah($dataSaldo['harga']).'<br />';
								$ongkos = $ongkos + $dataSaldo['harga'];
							}
							if($row[34] == 1){
								$query_mysql_saldo = mysqli_query($connect,"select * from salary_saldo WHERE jenis_kegiatan ='Full Jahit RIP' AND size='$size'")or die(mysqli_error($connect));
								$dataSaldo = mysqli_fetch_array($query_mysql_saldo);
								echo 'Full Jahit RIP: '.rupiah($dataSaldo['harga']).'<br />';
								$ongkos = $ongkos + $dataSaldo['harga'];
							}
							if($row[35] == 1){
								$query_mysql_saldo = mysqli_query($connect,"select * from salary_saldo WHERE jenis_kegiatan ='Full Obras' AND size='$size'")or die(mysqli_error($connect));
								$dataSaldo = mysqli_fetch_array($query_mysql_saldo);
								echo 'Full Obras: '.rupiah($dataSaldo['harga']).'<br />';
								$ongkos = $ongkos + $dataSaldo['harga'];
							}
							if($row[36] == 1){
								$query_mysql_saldo = mysqli_query($connect,"select * from salary_saldo WHERE jenis_kegiatan ='Full Obras RIP' AND size='$size'")or die(mysqli_error($connect));
								$dataSaldo = mysqli_fetch_array($query_mysql_saldo);
								echo 'Full Obras RIP: '.rupiah($dataSaldo['harga']).'<br />';
								$ongkos = $ongkos + $dataSaldo['harga'];
							}
							
							if(!empty($row[4])){
								if(is_float($row[4] + 0)){
									$whole = (int) $row[4];  // 100
									$frac = $row[4] - $whole; // .09
									$fracInt = ltrim($frac, '0.');
									$desimal = round($fracInt/12, 2);
									$qty = $whole + $desimal;
									$total = $qty * $ongkos;
								}else if(is_numeric($row[4])){
									$desimal = $row[4];
									$total = $desimal * $ongkos;
								}	
								$totalGaji[] = $total;
								echo '<br />Total<br />';
								if($row[28] == 1){
									echo rupiah($ongkos);
								}
								echo $row[4].' x '.rupiah($ongkos);
							}
						?>
					</td>
					<?php
					if(!empty($row[4])){
					?>
					<td style="width:5px;height:5px;">
						<?php
							echo rupiah($total);
						?>
					</td>
					<?php } ?>
				</tr>
				<?php 
				if(!empty($row[29])){
				?>
				<tr>
					<td colspan="5"></td>
					<td style="text-align:left">
						<?php
							/**
							$divisi = $data['divisi'];
							$sub_divisi = $data['sub_divisi'];
							$full = $data['full'];
							if($full == 1){
								//$query_mysql_saldo_harian = mysqli_query($connect,"select * from salary_saldo WHERE jenis_kegiatan ='Harian Full' AND lokasi='$lokasi' AND divisi='$divisi'")or die(mysqli_error($connect));
								$query_mysql_saldo_harian = mysqli_query($connect,"select * from salary_saldo WHERE jenis_kegiatan ='Harian Full' AND lokasi='$lokasi'")or die(mysqli_error($connect));
								$dataSaldoHarian = mysqli_fetch_array($query_mysql_saldo_harian);
								echo 'Harian Full: '.rupiah($dataSaldoHarian['harga']).'<br />';
							} else if(!empty($sub_divisi)){
								$query_mysql_saldo_harian = mysqli_query($connect,"select * from salary_saldo WHERE jenis_kegiatan ='Harian' AND lokasi='$lokasi' AND divisi='$divisi' AND sub_divisi='$sub_divisi'")or die(mysqli_error($connect));
								$dataSaldoHarian = mysqli_fetch_array($query_mysql_saldo_harian);
								echo 'Harian: '.rupiah($dataSaldoHarian['harga']).'<br />';
							} else {
								$query_mysql_saldo_harian = mysqli_query($connect,"select * from salary_saldo WHERE jenis_kegiatan ='Harian' AND lokasi='$lokasi' AND divisi='$divisi'")or die(mysqli_error($connect));
								$dataSaldoHarian = mysqli_fetch_array($query_mysql_saldo_harian);
								echo 'Harian: '.rupiah($dataSaldoHarian['harga']).'<br />';
							}
						
							$totalHarian = $row[29] * $dataSaldoHarian['harga'];
							echo $row[29].' x '.rupiah($dataSaldoHarian['harga']);
							**/
							$ongkos = $data['gaji_perjam'];
							$totalHarian = $row[29] * $ongkos;
							echo $row[29].' x '.rupiah($ongkos);
						?>
					</td>
					<td><?php echo rupiah($totalHarian); ?></td>
				</tr>
				<?php 
					}
					if(!empty($row[32])){
					?>
					<tr>
						<td colspan="5"></td>
						<td style="text-align:left">
							<?php
								echo 'Gaji Bulanan: '.rupiah($row[32]);
								$gaji_bulanan = $row[32];
							?>
						</td>
						<td><?php echo rupiah($row[32]); ?></td>
					</tr>
					<?php 
					}
				}
				?>
				
				<?php
				$totalKasbonBahan = 0;
				$query_mysql_kasbon = mysqli_query($connect,"select * from kasbon_bahan WHERE tanggal_kasbon='$tanggal_gajian'")or die(mysql_error());
				$dataKasbonBahanCheck = mysqli_num_rows($query_mysql_kasbon);
				if($dataKasbonBahanCheck > 0){
				?>
				<tr>
					<td colspan="7">Bahan tidak selesai terpotong pada minggu lalu</td>
				</tr>
				<?php
				while($dataKasbon = mysqli_fetch_array($query_mysql_kasbon)){
					$totalKasbonBahan += $dataKasbon['jumlah'];
				?>
				<tr>
					<td colspan="2"></td>
					<td><?php echo $dataKasbon['no_seri']; ?></td>
					<td colspan="2"></td>
					<td><?php echo 'Quantity : '.$dataKasbon['quantity']; ?></td>
					<td><?php echo $dataKasbon['jumlah']; ?></td>
				</tr>
				<?php } 
				}
				$totalKasbonUang = 0;
				$query_mysql_kasbon_uang = mysqli_query($connect,"select * from kasbon_uang WHERE tanggal_gajian='$tanggal_gajian'")or die(mysql_error());
				$dataKasbonUangCheck = mysqli_num_rows($query_mysql_kasbon_uang);
				if($dataKasbonUangCheck > 0){
				?>
				<tr>
					<td colspan="7">Kasbon</td>
				</tr>
				<?php
				while($dataKasbonUang = mysqli_fetch_array($query_mysql_kasbon_uang)){
					$totalKasbonUang += $dataKasbonUang['jumlah'];
				?>
				<tr>
					<td colspan="5"></td>
					<td><?php echo 'Tanggal Kasbon : '.$dataKasbonUang['tanggal_kasbon']; ?></td>
					<td><?php echo $dataKasbonUang['jumlah']; ?></td>
				</tr>
				<?php }
				}
				?>
				<tr>
					<td colspan="6">Total Gaji</td>
					<td>
					<?php
						$totalgaji = 0;
						if(empty($totalHarian)){
							$totalHarian = 0;
						}
						if(empty($gaji_bulanan)){
							$gaji_bulanan = 0;
						}
						if(!empty($totalGaji)){
							foreach($totalGaji as $item){
								$totalgaji +=$item;
							}
						}
						$totalSemua = ($totalgaji+$totalHarian+$gaji_bulanan)-$totalKasbonBahan-$totalKasbonUang;
						echo rupiah($totalSemua);
					?></td>
				</tr>
				<?php if(!empty($data['note'])){ ?>
				<tr>
					<td>Note</td>
					<td colspan="6">
					<?php
						echo $data['note'];
					?></td>
				</tr>
				<?php } ?>
			</table>
	</div>
</div>
<script>
	window.print();
</script>
</body>
</html>
<?php } ?>