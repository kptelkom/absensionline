<!--program ini untuk pendaftaran id admin-->
<!--login pendaftaran web cek kabel-->
<?php
	include "koneksi.php";
?>
<html>
	<head>
		<title>Menu Pendaftaran</title>
		<link href="images/icon1.png" rel="shortcut icon" type="image/png"/>
		<link href="css/login.css" rel="stylesheet"/>
		
		<meta charset="UTF-8">
	</head>
	<body>
	<div id="login">
		<div id="login-header">
			<img src="images/logo_telkomsel10.png" alt="logo">
		</div>
		<div id="login-dalam"> 
		<form action="" method="POST" submit="">
			<input type="text" class="text1" value="" name="username" placeholder="Username" required="">
			<input type="text" class="text1" value="" name="nik" placeholder="NIK" required="">			
			<input type="password" class="text1" value="" name="pass" placeholder="Password"required="" >	
			<center><input type="text" size="11" name="kode" value="" placeholder ="Kode Verifikasi" required=""></center>			
			<input type="submit" class="submit" name="simpan" value="Simpan"/>
			<div id="signUp">
				<a href="index.php">Batal</a>
			</div>
		</form>
		</div>
	</div >
	</body>
</html>

<!--name of submit is simpan-->
<?php
session_start();
	if(isset($_POST['simpan']))
	{	$username = $_POST['username'];
		$nik = $_POST['nik'];
		$pass = $_POST['pass'];
		$kode = $_POST['kode'];
			if($kode == "09021181621137")
			{
				$query= "insert into admin values ('$username','','$nik','$pass','','')";
				$sql=$koneksi->query($query);
				if($sql)
				{
					echo "<script>alert (\"Berita telah berhasil ditambahkan\");</script>"; 
					header ("Location:index.php");
				}
				else
				{
					echo "<script>alert (\"Username tidak berhasil ditambahkan\");</script>"; 
				}
			}else
			{
					echo "<script>alert (\"kode verifikasi salah\");</script>"; 
			}
	}
?>