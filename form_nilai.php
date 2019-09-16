<!DOCTYPE html>
<?php
session_start();
	include "koneksi.php";
	if(isset($_SESSION['login']))
	{	$x=$_SESSION['login'];	
		if($_SESSION['pengguna']=="users")
		{
			$query= "select kehadiran,kerjasama,komunikasi,sikap,prestasi_kerja,kreatifitas from form_penilaian WHERE id_login='$x'";
			$sql=$koneksi->query($query);
			$hasil=$sql->fetch_array();
			$kehadiran = $hasil['kehadiran'];
			$kerjasama = $hasil['kerjasama'];
			$komunikasi = $hasil['komunikasi'];
			$sikap = $hasil['sikap'];
			$prestasi_kerja = $hasil['prestasi_kerja'];
			$kreatifitas = $hasil['kreatifitas'];
			$total = ($kehadiran*0.2)+($kerjasama*0.2)+($komunikasi*0.1)+($sikap*0.2)
											  +($prestasi_kerja*0.2)+($kreatifitas*0.1);
		}		
?>
<html>
	<head>
		<link rel="stylesheet" href="css/style.css">
		<script>
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
						<input type="text" class="clock" size="12" name="Clock">
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
						<li><img src="images/dashboard.png" onclick="tujuan(1)" alt="menu1"><a id="k1" href="dashboard.php">Dashboard</a></li>
					    <li><img src="images/profil2.png" onclick="tujuan(2)" alt="menu2"/><a id="k2" href="data_diri.php">Data Diri </a></li>
						<?php if($_SESSION['pengguna']=="admin"){?><li><img  onclick="tujuan(3)" src="images/profiluser.png" alt="menu3"/><a id="k3" href="buat_akun_user.php" >Akun User </a></li><?php } ?>
						<li><img src="images/absen2.png" onclick="tujuan(4)" alt="menu4"/><a id="k4" href="absen.php">Absen Harian</a></li>
						<li  style="background-color:white"><img src="images/nilai2.png" onclick="tujuan(5)" alt="menu5"/><a id="k5" href="form_nilai.php">Form Penilaian</a></li>
						<li><img src="images/unduh.png" onclick="tujuan(8)" alt="menu8"/><a id="k8" href="unduh.php">Unduhan</a></li>
						<li><img src="images/logout2.png" onclick="logout()" alt="menu6"/><a href="#" onClick="logout()" id="k6">Logout</a></li>
					</ul>
				</div>
				<div id="content"><!--posisi contentnya-->
					<div id="isi"><!--isi dari content-->
					
						<!-- ((((((((((content untuk admin)))))))))))-->
				<?php if($_SESSION['pengguna']=="admin")
					  {
							$query= "select a.id_login,a.kehadiran,a.kerjasama,a.komunikasi,a.sikap,a.prestasi_kerja,a.kreatifitas 
							from form_penilaian a,users b where a.id_login = b.id_login && b.id_admin = '$x'";
							$sql=$koneksi->query($query);
				?>
							<h2>Form Nilai Kerja Praktek</h2><br/>
							<hr><br/>
							<form method="post">
								<table  id="table_nilai" border="1" name="table_nilai">
								<tr>
									<th>Nama</th>
									<th>Kehadiran</th>
									<th>Kerjasama</th>
									<th>Komunikasi</th>
									<th>Sikap/Etika</th>
									<th>Prestasi Kerja</th>
									<th>Kreatifitas</th>
									<th>Total</th>
									<th>Aksi</th>
									
								</tr>
						<?php while($hasil=$sql->fetch_array())
							  {
									$id_login = $hasil['id_login'];
									$kehadiran = $hasil['kehadiran'];
									$kerjasama = $hasil['kerjasama'];
									$komunikasi = $hasil['komunikasi'];
									$sikap = $hasil['sikap'];
									$prestasi_kerja = $hasil['prestasi_kerja'];
									$kreatifitas = $hasil['kreatifitas'];
									$total = ($kehadiran*0.2)+($kerjasama*0.2)+($komunikasi*0.1)+($sikap*0.2)
											  +($prestasi_kerja*0.2)+($kreatifitas*0.1);
						?>
								<tr>
									<td><?php echo "$id_login";?></td>
									<td><?php echo "$kehadiran"; ?></td>
									<td><?php echo "$kerjasama"; ?></td>
									<td><?php echo "$komunikasi"; ?></td>
									<td><?php echo "$sikap"; ?></td>
									<td><?php echo "$prestasi_kerja"; ?></td>
									<td><?php echo "$kreatifitas"; ?></td>
									<td><?php echo "$total";?></td>
									<td><?php echo "<a href='ubah_nilai.php?id=$id_login'>";?>Ubah</a></td>
								</tr>
								<?php  } ?><!--(((((((((((((((((penutup while))))))))))))))))))))) -->
								</table><br><br>
							</form>
							<strong>Keterangan :</strong>
							<table style="margin:10px 0px 0px 40px;">
							<tr><td>Kehadiran</td><td>&nbsp;:</td><td>20%</td></tr>
							<tr><td>Kerjasama</td><td>&nbsp;:</td><td>20%</td></tr>
							<tr><td>Komunikasi</td><td>&nbsp;:</td><td>10%</td></tr>
							<tr><td>Sikap,Etika</td><td>&nbsp;:</td><td>20%</td></tr>
							<tr><td>Prestasi Kerja</td><td>&nbsp;:</td><td>20%</td></tr>
							<tr><td>Kreatifitas</td><td>&nbsp;:</td><td>10%</td></tr>
							</table>
								
				<?php } ?><!--(((((((((((((((((penutup session admin))))))))))))))))))))) -->
						
						
						<!-- content untuk user-->
						<?php if($_SESSION['pengguna']=="users"){?><!--(((((((((((((((((Session pengguna = user))))))))))))))))))))) -->
						<h2>Hasil Nilai Kerja Praktek</h2><br/>
						<hr><br/>
						<table  id="table_nilai" border="1" name="table_nilai">
							<tr>
								<th width=20px;>User</th>
								<th>Kehadiran</th>
								<th>Kerjasama</th>
								<th>Komunikasi</th>
								<th>Sikap/Etika</th>
								<th>Prestasi Kerja</th>
								<th>Kreatifitas</th>
								<th>Total</th>
							</tr>
							<tr>
								<td><?php echo "$x";?></td>
								<td><?php echo "$kehadiran";?></td>
								<td><?php echo "$kerjasama";?></td>
								<td><?php echo "$komunikasi";?></td>
								<td><?php echo "$sikap";?></td>
								<td><?php echo "$prestasi_kerja";?></td>
								<td><?php echo "$kreatifitas"?></td>
								<td><?php echo "$total";?></td>
							</tr>
						</table><br><br>			
						<?php } ?>
						<!-- ****************************-->
					</div>
				</div>
			</div>
				<div id="footer">
				</div>
		</div>
	</body>
</html>
		<?php } ?>