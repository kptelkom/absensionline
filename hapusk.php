<!--variable hapus-->
<?php
	$hapus = $_GET['id'];
	unlink("files/".$hapus);
	header("unduh.php");
?>