<!DOCTYPE html>
<?php
session_start();
include "koneksi.php";
//pemeriksaan login
if(isset($_SESSION['login']))
{$x=$_SESSION['login'];
	if($_SESSION['pengguna']=="users")
						{
							$nama =$_GET['nama'];
							$query="select nama,nik,whatsapp,telegram from admin where nama='$nama'";
							$sql=$koneksi->query($query);
							$hasil = $sql->fetch_array();
							$nama = $hasil['nama'];
							$nik = $hasil['nik'];
							$whatsapp = $hasil['whatsapp'];
							$telegram = $hasil['telegram'];?>
<html>
	<head>
		<link rel="stylesheet" href="css/style.css">
		<script>
		//fungsi logout
		function logout()
		{
			var x = window.confirm("Apakah anda yakin ingin logout?");
			if(x)
			{
				window.location="logout.php";
			}
			
		}
		function show()
		{
			if(document.all.ganti_password.style.visibility == "visible")
			{
				document.all.ganti_password.style.visibility = "hidden";
			}
			else
			{
				document.all.ganti_password.style.visibility = "visible";
			}
		}
		//fungsi set waktu
		</script>
	</head>
	<body>
		<div id="wrapper">
			<div id="header">
				<div id="header_menu">
					<div id="header_left">
						<img src="images/menu.png" alt="menu"/>
						<h1> Telkom Indonesia</h1>
					</div>
						
					<div id="header_right" onclick="show()">
						<img src="images/profil1.png" alt="menu"/>
						<?php echo "<h4>".$_SESSION['login']." <i>(".$_SESSION['pengguna'].")</i></h4>";?>
						<img src="images/segitiga_terbalik.png" alt="menu"/>
					</div>
					<div id="ganti_password">
						<img src="images/profil1.png">&nbsp;<a href="ubah_password.php">Ubah Password</a></img><br>
						<img src="images/keluar.png">&nbsp;<a href="logout.php">Logout</a></img>
					</div>					
				</div>
			</div>
			<div id="tengah">
				<div id="sidebar">
					<form name="Tick" class="waktu">
						<input type="text" size="12" name="Clock">
					</form>
					<script type="text/javascript">
						function waktu()
						{
							var x =new Date();
							var y=x.getHours();
							var z=x.getMinutes();
							if (z<10)
								z="0"+z;
							if (y<10)
								y="0"+y
							document.Tick.Clock.value = y+":"+z+" WIB";
							setTimeout("waktu()",1000) ;
						}
						waktu()
					</script>
					<ul>
						<li><a href="dashboard.php">Dashboard</a></li>
					    <li><a href="data_diri.php">Data Diri </a></li>
						<?php if($_SESSION['pengguna']=="admin"){?><li><a href="buat_akun_user.php" > Akun User </a></li><?php } ?>
						<li><a href="absen.php">Daftar Kehadiran</a></li>
						<li><a href="form_nilai.php">Form Penilaian</a></li>
						<li><a href="#" onClick="logout()">Logout</a></li>
					</ul>
				</div>
				<div id="content"><!--posisi contentnya-->
					<div id="isi"><!--isi dari content-->
					<h2>Profil Pembimbing KP</h2>
					<br/><hr><br/>
					<FORM name="konfirmasi" method="POST">
					<table id="data_diri">
						<tr>
							<th>Nama</th>
							<th>:</th>
							<th><?php echo "$nama";?></th>
						</tr>
						<tr>
							<th>Nik</th>
							<th>:</th>
							<th><?php echo "$nik";?></th>
						</tr>
						<tr>
							<th>Whatsapp</th>
							<th>:</th>
							<th><?php echo "$whatsapp";?></th>
						</tr>
						<tr>
							<th>Telegram</th>
							<th>:</th>
							<th><?php echo "$telegram";?></th>
						</tr>
					</table>
					</form>
					</div>	
				</div>
			</div>
				<div id="footer">
				</div>
		</div>
	</body>
</html>
<?php
	}}
	else {  
	//session belum ada artinya belum login 	
	die ("Anda belum login! Anda tidak berhak masuk ke halaman ini.Silahkan login <a href='index.php'>di sini</a>"); 
	} ?>
	
	