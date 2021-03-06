<?php error_reporting(0); ?>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>

.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.active {
  background-color: #4CAF50;
  color: white;
}

.topnav .icon {
  display: none;
}

.dropdown {
  float: left;
  overflow: hidden;
}

.dropdown .dropbtn {
  font-size: 17px;    
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.topnav a:hover, .dropdown:hover .dropbtn {
  background-color: #555;
  color: white;
}

.dropdown-content a:hover {
  background-color: #ddd;
  color: black;
}

.dropdown:hover .dropdown-content {
  display: block;
}

@media screen and (max-width: 600px) {
  .topnav a:not(:first-child), .dropdown .dropbtn {
    display: none;
  }
  .topnav a.icon {
    float: right;
    display: block;
  }
}

@media screen and (max-width: 600px) {
  .topnav.responsive {position: relative;}
  .topnav.responsive .icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  .topnav.responsive a {
    float: none;
    display: block;
    text-align: left;
  }
  .topnav.responsive .dropdown {float: none;}
  .topnav.responsive .dropdown-content {position: relative;}
  .topnav.responsive .dropdown .dropbtn {
    display: block;
    width: 100%;
    text-align: left;
  }
}
</style>
</head>

<header>
	<h1 class="judul">Seranno</h1>
</header>
<div class="topnav" id="myTopnav">
	<a href="home.php" class="active">Home</a>
	<div class="dropdown">
		<button class="dropbtn">Database 
			<i class="fa fa-caret-down"></i>
		</button>
		<div class="dropdown-content">
			<a href="customer.php" id="customer">Customer</a>
			<a href="supplier_list.php" id="supplier">Supplier</a>
			<a href="karyawan_list.php" id="karyawan">Karyawan</a>
		</div>
	</div>
	<a href="purchase_order_list.php" id="purchase_order">Purchase Order</a>
	<a href="stock_list.php" id="stock">Stock</a>
	<div class="dropdown">
		<button class="dropbtn">Salary 
			<i class="fa fa-caret-down"></i>
		</button>
		<div class="dropdown-content">
			<a href="salary.php">Salary</a>
			<a href="salary_saldo.php">Salary Saldo</a>
		</div>
	</div>
	<div class="dropdown">
		<button class="dropbtn">Exp 
			<i class="fa fa-caret-down"></i>
		</button>
		<div class="dropdown-content">
			<a href="daftar_inventaris.php">Daftar Exp</a>
			<a href="inventaris.php">Exp List</a>
		</div>
	</div>
	<div class="dropdown">
		<button class="dropbtn">Surat Jalan 
			<i class="fa fa-caret-down"></i>
		</button>
		<div class="dropdown-content">
			<a href="surat_jalan.php">Surat Jalan</a>
			<a href="surat_jalan_penjualan.php">Surat Jalan Penjualan</a>
			<a href="salary_cmt_exp.php">Surat Jalan Bordir</a>
			<a href="surat_jalan_cmt.php">Surat Jalan CMT</a>
			<a href="surat_jalan_sablon.php">Surat Jalan Sablon</a>
		</div>
	</div>
	<a href="penjualan.php" id="penjualan">Penjualan</a>
	<a href="return.php" id="return">Retur</a>
	<div class="dropdown">
		<button class="dropbtn">Kasbon 
			<i class="fa fa-caret-down"></i>
		</button>
		<div class="dropdown-content">
			<a href="kasbon_uang.php">Kasbon Uang</a>
			<a href="kasbon_bahan.php">Kasbon Bahan</a>
		</div>
	</div>
	<a href="../controllers/proses_logout.php" id="logout">logout</a>
	<a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
</div>

<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>
<!--
<div class="menu">
<ul>
	<li><a href="home.php" id="home">Home</a></li>
	<li><a href="customer.php" id="customer">Customer</a></li>
	<li><a href="supplier_list.php" id="supplier">Supplier</a></li>
	<li><a href="purchase_order_list.php" id="purchase_order">Purchase Order</a></li>
	<li><a href="stock_list.php" id="stock">Stock</a></li>
	<li><a href="surat_jalan.php" id="surat_jalan">Surat Jalan</a></li>
	<li><a href="penjualan.php" id="penjualan">Penjualan</a></li>
	<li><a href="return.php" id="return">Retur</a></li>
	<li><a href="karyawan_list.php" id="karyawan">Karyawan</a></li>
	<li><a href="salary.php" id="salary">Salary</a></li>
	<li><a href="salary_saldo.php" id="salary_saldo">Salary Saldo</a></li>
	<li><a href="salary_cmt_exp.php" id="salary_exp">Salary Exp</a></li>
	<li></li>
</ul>
</div>-->