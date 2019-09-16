<!DOCTYPE html>
<?php
session_start();
include "koneksi.php";
//pemeriksaan login
if(isset($_SESSION['login']))
{$x=$_SESSION['login'];?>
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
		function tujuan(xas){
			if(xas=="1"){window.location="dashboard.php";}
			if(xas=="2"){window.location="data_diri.php";}
			if(xas=="3"){window.location="buat_akun_user.php";}
			if(xas=="4"){window.location="absen.php";}
			if(xas=="5"){window.location="form_nilai.php";}
			if(xas=="6"){window.location="logout.php";}
			if(xas=="8"){window.location="unduh.php";}
		}
		function headerku()
		{
			if(document.getElementById("k1").innerHTML != "")
			{
				document.all.sidebar.style.width = "3%";
				document.all.content.style.width = "97%";
				document.getElementById("k1").innerHTML = "";
				document.getElementById("k2").innerHTML = "";
				document.getElementById("k3").innerHTML = "";
				document.getElementById("k4").innerHTML = "";
				document.getElementById("k5").innerHTML = "";
				document.getElementById("k6").innerHTML = "";	
				document.getElementById("k8").innerHTML = "";	
			}
			else
			{
				document.all.sidebar.style.width = "20%";
				document.all.content.style.width = "80%";
				document.getElementById("k1").innerHTML = "Dashboard";
				document.getElementById("k2").innerHTML = "Data Diri";
				document.getElementById("k3").innerHTML = "Akun User";
				document.getElementById("k4").innerHTML = "Absen Harian";
				document.getElementById("k5").innerHTML = "Form Penilaian";
				document.getElementById("k6").innerHTML = "Logout";
				document.getElementById("k8").innerHTML = "Unduhan";
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
						<img src="images/menu.png" alt="menu" onclick="headerku()"/>
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
						<input class="clock" type="text" name="Clock">
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
						<li style="background-color:white"><img src="images/dashboard.png" onclick="tujuan(1)" alt="menu1"><a id="k1" href="dashboard.php">Dashboard</a></li>
					    <li><img src="images/profil2.png" onclick="tujuan(2)" alt="menu2"/><a id="k2" href="data_diri.php">Data Diri </a></li>
						<?php if($_SESSION['pengguna']=="admin"){?><li><img  onclick="tujuan(3)" src="images/profiluser.png" alt="menu3"/><a id="k3" href="buat_akun_user.php" >Akun User </a></li><?php } ?>
						<li><img src="images/absen2.png" onclick="tujuan(4)" alt="menu4"/><a id="k4" href="absen.php">Absen Harian</a></li>
						<li><img src="images/nilai2.png" onclick="tujuan(5)" alt="menu5"/><a id="k5" href="form_nilai.php">Form Penilaian</a></li>
						<li><img src="images/unduh.png" onclick="tujuan(8)" alt="menu8"/><a id="k8" href="unduh.php">Unduhan</a></li>
						<li><img src="images/logout2.png" onclick="logout()" alt="menu6"/><a href="#" onClick="logout()" id="k6">Logout</a></li>
					</ul>
				</div>
				<div id="content"><!--posisi contentnya-->
					<div id="isi"><!--isi dari content-->
					<h2>Sistem Absensi Online dan Form Penilaian</h2>
					<br/><hr><br/>
					<?php
						if($_SESSION['pengguna']=="users")
						{
							echo "<h3>Hello ". $_SESSION['login']. ",</h3>";	
					?> 
					<P> Selamat datang di sistem kami. Sistem ini adalah Sistem Absensi Online untuk mahasiswa magang di PT Telkom Indonesia
					yang digunakan untuk mengisi data kehadiran secara online dan dapat mengunduh form penilaian.</p>
					<div id="gambar1">
						<img src='images/data_diri.png' alt='gambar1'/>
						<img src='images/absen.png' alt='gambar2'/>
						<img src='images/nilai.png' alt='gambar3'/>
						<a href='data_diri.php'>Data Diri</a>
						<a href='absen.php'>Lihat Absen</a>
						<a href='form_nilai.php'>Lihat Nilai</a>
					</div>
						<?php } ?><!--Penutup session users -->
						
					<!--session admin-->
					<?php
						if($_SESSION['pengguna']=="admin")
						{
							$no=0;
							$query = "select a.id_login,a.keterangan,a.status,a.tanggal,a.hari,a.pukul from absen a , users b where  a.id_login = b.id_login && b.id_admin = '$x' && status='menunggu' ";
							$sql=$koneksi->query($query);
							if(empty($hasil = $sql->fetch_array()))
							{
								echo "<div id=\"gagal_popup\">Tidak Ada yang Absen <img src=\"images/silang.png\" alt=\"silang\" onclick=\"silang()\"/></div>"; 
							}
							else{
								
					?> 
					<FORM name="konfirmasi" method="POST">
					<table id="dashboard_css" border="1">
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>Keterangan</th>
							<th>Hari</th>
							<th>Tanggal</th>
							<th>Pukul</th>
							<th colspan="2">Aksi</th>
						</tr>
						<?php
							$query = "select a.id_login,a.keterangan,a.status,a.tanggal,a.hari,a.pukul from absen a , users b where  a.id_login = b.id_login && b.id_admin = '$x' && status='menunggu' ";
							$sql=$koneksi->query($query); 
							while($hasil = $sql->fetch_array())
								{	$no++;
									$nama = $hasil['id_login'];
									$keterangan = $hasil['keterangan'];
									$hari = $hasil['hari'];
									$pukul =$hasil['pukul'];
									$tanggal = $hasil['tanggal'];
									$status = $hasil['status'];?>
						<tr>
							<td><?php echo "$no";?></td>
							<td><?php echo "$nama";?></td>
							<td><?php echo "$keterangan";?></td>
							<td><?php echo "$hari";?></td>
							<td><?php echo "$tanggal";?></td>
							<td><?php echo "$pukul";?></td>
							<td>
								 <?php echo "<a href='konfirmasi.php?id=$tanggal && id2=$nama'><b>Konfirmasi</b></a>";?>&nbsp;&nbsp;
								 <?php echo "<a href='tolak.php?id=$tanggal && id2=$nama'><b>Tolak</b></a>";?>
							</td>
						</tr>
							<?php } }?>
					</table>
					</form>
						<?php } ?>
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
	
	