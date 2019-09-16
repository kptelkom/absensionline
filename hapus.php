<?php
	include 'koneksi.php';
	$id =$_GET['id'];
			$query= "delete from data_diri WHERE id_login='$id'";
			$sql=$koneksi->query($query);
			$query= "delete from form_penilaian WHERE id_login='$id'";
			$sql=$koneksi->query($query);
			$query= "delete from absen WHERE id_login='$id'";
			$sql=$koneksi->query($query);
			$query= "delete from users WHERE id_login='$id'";
			$sql=$koneksi->query($query);
			header("Location:buat_akun_user.php");
?>