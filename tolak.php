<?php
include "koneksi.php";
session_start();
		$tanggal=$_GET['id'];
		$id2=$_GET['id2'];
		$query = "update absen set status='ditolak' where id_login='$id2' && tanggal='$tanggal'";
		$sql=$koneksi->query($query);
		if($sql)
		{
			header("Location:dashboard.php");
		}
?>