<?php
	include '../config/connection.php';
	 
	$username = $_POST['username'];
	$password = $_POST['password'];
	 
	$user = mysqli_query($connect,"select * from users where nick_user='$username' and pass_user='$password'");
	$chek = mysqli_num_rows($user);
	if($chek>0) {
		// Starting session
		session_start();
		while($d = mysqli_fetch_array($user)){
		// Storing session data
		$_SESSION["nama_user"] = $d['nama_user'];
		$_SESSION["rules_user"] = $d['rules_user'];
		}
		header("location:../views/home.php");
	} else {
		header("location:../views/index.php");
	}
?>