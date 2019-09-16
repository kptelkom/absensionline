<!DOCTYPE html>
<!--database data_diri.sql-->
<?php
session_start();
	include "koneksi.php";
	if(isset($_SESSION['login']) )
	{
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
					    <li style="background-color:white"><img src="images/profil2.png" onclick="tujuan(2)" alt="menu2"/><a id="k2" href="data_diri.php">Data Diri </a></li>
						<?php if($_SESSION['pengguna']=="admin"){?><li><img  onclick="tujuan(3)" src="images/profiluser.png" alt="menu3"/><a id="k3" href="buat_akun_user.php" >Akun User </a></li><?php } ?>
						<li><img src="images/absen2.png" onclick="tujuan(4)" alt="menu4"/><a id="k4" href="absen.php">Absen Harian</a></li>
						<li><img src="images/nilai2.png" onclick="tujuan(5)" alt="menu5"/><a id="k5" href="form_nilai.php">Form Penilaian</a></li>
						<li><img src="images/unduh.png" onclick="tujuan(8)" alt="menu8"/><a id="k8" href="unduh.php">Unduhan</a></li>
						<li><img src="images/logout2.png" onclick="logout()" alt="menu6"/><a href="#" onClick="logout()" id="k6">Logout</a></li>
					</ul>
				</div>
				<div id="content">
					<div id="isi">
					
					
					<!-- Data Diri Mahasiswa-->
					<!--========================================================================================================-->
					<?php if($_SESSION['pengguna']=="users")
					{	 
						echo "<h2>Data Diri Mahasiswa</h2><br/><hr><br/>";
						$x = $_SESSION['login'];/*tampung sementara kedalam x*/
						$query = "select nama,nim,program_studi,asal_sekolah,tempat_kp,waktu_mulai,waktu_selesai,
								dosen_pembimbing,pembimbing_lapangan from data_diri WHERE id_login='$x'";
						$sql=$koneksi->query($query);
						$hasil=$sql->fetch_array();
						$nama = $hasil['nama'];
						$nim = $hasil['nim'];
						$program_studi = $hasil['program_studi'];
						$asal_sekolah = $hasil['asal_sekolah'];
						$tempat_kp = $hasil['tempat_kp'];
						$waktu_mulai_kp = $hasil['waktu_mulai'];
						$waktu_selesai_kp = $hasil['waktu_selesai'];
						$dosen_pembimbing = $hasil['dosen_pembimbing'];
						$pembimbing_lapangan = $hasil['pembimbing_lapangan'];
						$query = "select a.nama from admin a,users b where a.id_login = b.id_admin && b.id_login = '$x'";
						$sql = $koneksi->query($query);$hasil=$sql->fetch_array();
						$as = $hasil['nama'];
						if(isset($_POST['simpan']))
						{	
							$nama = $_POST['nama'];
							$nim = $_POST['nim'];
							$program_studi = $_POST['program_studi'];
							$asal_sekolah = $_POST['asal_sekolah'];
							$tempat_kp = $_POST['tempat_kp'];
							$waktu_mulai_kp = $_POST['waktu_mulai_kp'];
							$waktu_selesai_kp = $_POST['waktu_selesai_kp'];
							$dosen_pembimbing = $_POST['dosen_pembimbing'];
							$query= "update data_diri set nama='$nama',nim ='$nim',program_studi='$program_studi',asal_sekolah='$asal_sekolah',tempat_kp='$tempat_kp',
							waktu_mulai='$waktu_mulai_kp',waktu_selesai='$waktu_selesai_kp',dosen_pembimbing='$dosen_pembimbing',
							pembimbing_lapangan='$as' WHERE id_login='$x'";
							$sql=$koneksi->query($query);
							if($sql)
							{
								echo "<div id=\"berhasil_popup\">Data Berhasil Disimpan <img src=\"images/silang.png\" alt=\"silang\" onclick=\"silang1()\"/></div>";
							}
							else
							{
								echo "<div id=\"gagal_popup\">Data Gagal Disimpan <img src=\"images/silang.png\" alt=\"silang\" onclick=\"silang()\"/></div>"; 
							}
						}?>
						<FORM ACTION="" METHOD="POST" > 
					<table id="data_diri">
						<tr>
							<th>Nama</th>
							<td width=10px>:</td>
							<td><input type="text" name="nama" value="<?php echo $nama?>" ></td>
						</tr>
						<tr>
							<th>Nim</th>
							<td>:</td>
							<td><input type="text" name="nim" value="<?php echo $nim?>"></td>
						</tr>
						<tr>
							<th>Program Studi</th>
							<td>:</td>
							<td><input type="text" name="program_studi" value="<?php echo $program_studi?>"></td>
						</tr>
						<tr>
							<th>Asal Sekolah</th>
							<td>:</td>
							<td><input type="text" name="asal_sekolah" value="<?php echo $asal_sekolah?>"></td>
						</tr>
						<tr>
							<th>Tempat KP</th>
							<td>:</td>
							<td><input type="text" name="tempat_kp" value="<?php echo $tempat_kp?>"></td>
						</tr>
						<tr>
							<th>Waktu Mulai KP</th>
							<td>:</td>
							<td><input type="text" name="waktu_mulai_kp" value=<?php echo $waktu_mulai_kp?>></td>
						</tr>
						<tr>
							<th>Waktu Selesai KP</th>
							<td>:</td>
							<td><input type="text" name="waktu_selesai_kp" value=<?php echo $waktu_selesai_kp?>></td>
						</tr>
						<tr>
							<th>Dosen Pembimbing</th>
							<td>:</td>
							<td><input type="text" name="dosen_pembimbing" value="<?php echo $dosen_pembimbing?>"></td>
						</tr>
						<tr>
							<th>Pembimbing Lapangan</th>
							<td>:</td>
							<td><?php echo "<a href='lihat_profil_pembimbing_kp.php?nama=$as'>" .$as."</a>";?></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td>
								<input type="submit" name="simpan" value="Simpan"></input>
								<input type="reset" value="reset"></input>
							</td>
						</tr>
					</table>
					</FORM>
					<?php } ?>
					
					
					
						<!-- Data Diri Pembimbing KP-->
						<!--========================================================================================================-->
					<?php if($_SESSION['pengguna']=="admin")
						  {	 
							echo "<h2>Data Diri Pembimbing KP</h2><br/><hr><br/>";
							$x = $_SESSION['login'];/*tampung sementara kedalam x*/
							$query = "select nama,nik,whatsapp,telegram from admin WHERE id_login='$x'";
							$sql=$koneksi->query($query);
							$hasil=$sql->fetch_array();
							$nama = $hasil['nama'];
							$nik = $hasil['nik'];
							$whatsapp = $hasil['whatsapp'];
							$telegram = $hasil['telegram'];
							if(isset($_POST['simpan']))
							{	
								$nama = $_POST['nama'];
								$nik = $_POST['nik'];
								$whatsapp = $_POST['whatsapp'];
								$telegram = $_POST['telegram'];
								$query= "update admin set nama='$nama',nik ='$nik',whatsapp='$whatsapp',telegram='$telegram' WHERE id_login='$x'";
								$sql=$koneksi->query($query);
								if($sql)
								{
									echo "<div id=\"berhasil_popup\">Data Berhasil Disimpan <img src=\"images/silang.png\" alt=\"silang\" onclick=\"silang1()\"/></div>";
								}
								else
								{
									echo "<div id=\"gagal_popup\">Data Gagal Disimpan <img src=\"images/silang.png\" alt=\"silang\" onclick=\"silang()\"/></div>"; 
								}
							}?>	
							
					
					<FORM ACTION="" METHOD="POST" > 
					<table id="data_diri">
						<tr>
							<th>Nama</th>
							<td width=10px>:</td>
							<td><input type="text" name="nama" value="<?php echo"$nama";?>" ></td>
						</tr>
						<tr>
							<th>Nik</th>
							<td>:</td>
							<td><input type="text" name="nik" value="<?php echo"$nik";?>"></td>
						</tr>
						<tr>
							<th colspan="3">Kontak yang bisa dihubungi!!</th>
						</tr>
						<tr>
							<th>Whatsapp</th>
							<td>:</td>
							<td><input type="text" name="whatsapp" value="<?php echo"$whatsapp";?>"></td>
						</tr>
						<tr>
							<th>Telegram</th>
							<td>:</td>
							<td><input type="text" name="telegram" value="<?php echo"$telegram";?>"></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td>
								<input type="submit" name="simpan" value="Simpan"></input>
								<input type="reset" value="reset"></input>
							</td>
						</tr>
					</table>
					</FORM>
						   <?PHP }?>	
						<!--========================================================================================================-->
						
					</div>
				</div>
				<div id="footer">
				</div>
			</div>
		</div>
	</body>
</html>
	<?php } ?>
	