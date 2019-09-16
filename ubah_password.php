<!DOCTYPE html>
<?php
session_start();
include "koneksi.php";
//pemeriksaan login
if(isset($_SESSION['login']))
{
	$x=$_SESSION['login'];
	$y=$_SESSION['pengguna'];
		?>
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
		function silang()
		{
				
				document.all.gagal_popup.style.visibility = "hidden";
				
				
				document.all.gagal_popup.style.position = "absolute";
				
		}
		function silang1()
		{
			document.all.berhasil_popup.style.visibility = "hidden";	
			document.all.berhasil_popup.style.position = "absolute";
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
					<!-- JAVASCRIPT visible logout & ubah password-->	
						<div id="header_right" onclick="show()">
						<img src="images/profil1.png" alt="menu"/>
						<?php echo "<h4>".$_SESSION['login']."</h4>";?>
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
						<h2>Ganti Password</h2><br/><hr><br/>
						<!--========================================================================================================-->
						<?php if(isset($_POST['simpan'])){
								  $password_lama=$_POST['password_lama'];
							      $password_baru=$_POST['password_baru'];
								  $password_baru_ulang=$_POST['password_baru_ulang'];
								  $query="select password from $y where id_login='$x'";
								  $sql=$koneksi->query($query);$hasil=$sql->fetch_array();
								  $pdb=$hasil['password'];
								  if($password_lama !== $pdb || $password_baru !== $password_baru_ulang){
										echo "<div id=\"gagal_popup\">Password Salah <img src=\"images/silang.png\" alt=\"silang\" onclick=\"silang()\"/></div>";
								  }
								  else{
									$query="update $y set password='$password_baru' WHERE id_login='$x'";
									$sql=$koneksi->query($query);
									if($sql){echo "<div id=\"berhasil_popup\">Data Berhasil Disimpan <img src=\"images/silang.png\" alt=\"silang\" onclick=\"silang1()\"/></div>";}
										else{echo "<div id=\"gagal_popup\">Data Gagal Disimpan <img src=\"images/silang.png\" alt=\"silang\" onclick=\"silang()\"/></div>";}
									}			
								}?>
						<!--========================================================================================================-->
						<form action="" method="POST" submit="">
						<table id="data_diri">
							<tr><th>Password Lama:</th></tr>
							<tr><td><input type="text" value="" name="password_lama" placeholder="Old Password" required=""></td></tr>
							<tr><th>Password Baru:</th></tr>
							<tr><td><input type="text" value="" name="password_baru" placeholder="New Password" required=""></td></tr>	
							<tr><th>Ulangi Password Baru:</th></tr>
							<tr><td><input type="text" value="" name="password_baru_ulang" placeholder="Re-New Password" required=""></td></tr>	
							<tr>			
								<td><input type="submit" name="simpan" value="Simpan"/></td>
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
	}
	else {  
	//session belum ada artinya belum login 	
	die ("Anda belum login! Anda tidak berhak masuk ke halaman ini.Silahkan login <a href='index.php'>di sini</a>"); 
	} ?>
	
	