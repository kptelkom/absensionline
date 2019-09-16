<!-- ini Absen Harian -->
<?php
session_start();
	include "koneksi.php";
	if(isset($_SESSION['login']))
	{	$x=$_SESSION['login'];
		
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
			if(xas=="8"){window.location="unduh.php";}
			if(xas=="9"){window.location="daftar_absen.php";}
			
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
					document.getElementById("k9").innerHTML = "";
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
				document.getElementById("k9").innerHTML = "Daftar Absen";
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
						<li style="background-color:white"><img src="images/absen2.png" onclick="tujuan(4)" alt="menu4"/><a id="k4" href="absen.php">Absen Harian</a></li>
						<?php if($_SESSION['pengguna']=="users"){?><li><img src="images/absen2.png" onclick="tujuan(9)" alt="menu9"/><a id="k9" href="daftar_absen.php">Daftar Absen</a></li><?php } ?>
						<li><img src="images/nilai2.png" onclick="tujuan(5)" alt="menu5"/><a id="k5" href="form_nilai.php">Form Penilaian</a></li>
						<li><img src="images/unduh.png" onclick="tujuan(8)" alt="menu8"/><a id="k8" href="unduh.php">Unduhan</a></li>
						<li><img src="images/logout2.png" onclick="logout()" alt="menu6"/><a id="k6" href="#" onClick="logout()">Logout</a></li>
					</ul>
				</div><!--penutup sidebar-->
				<div id="content"><!--posisi contentnya-->
					<div id="isi"><!--isi dari content-->
					
						<!--[[[[[[[[[[[[[[penutup $_SESSION['user']]]]]]]]]]]]]]]-->
						<?php if($_SESSION['pengguna']=="users"){
								$query = "select keterangan,status,tanggal from absen where id_login='$x' && (DATE(now())-DATE(tanggal)=0)";
								$sql=$koneksi->query($query);
								$hasil = $sql->fetch_array();
								$keterangan = $hasil['keterangan'];
								$status = $hasil['status'];
								$tanggal= $hasil['tanggal'];
								if(empty($tanggal) && $tanggal == "")
								{
									$query = "insert into absen (`id_login`,`tanggal`,`keterangan`)values ('$x',now(),'')"; 
									$sql=$koneksi->query($query);
								}
								if(isset($_POST['absen']))
								{	
									$hari=$_POST['hari_skg'];
									$pukul=$_POST['pukul_skg'];
									$keterangan=$_POST['keterangan'];
									if($status=='belum_absen')
									{
										$status='menunggu';
										$absen="update absen set tanggal=now(),hari='$hari',pukul='$pukul',keterangan='$keterangan',status='$status',id_login='$x' where id_login='$x' && status='belum_absen'";
										$sql=$koneksi->query($absen);
										if($sql)
										{
											echo "<script>alert (\"Data telah berhasil disimpan\");</script>"; 
										}
										else
										{
											echo "<script>alert (\"Data tidak berhasil disimpan\");</script>"; 
										}
									}
								}
								
								
						?>
						<h2>Absen Kegiatan Harian</h2><br/>
						<hr><br/>
						<form method="POST" name="hari_now">
						<table id="absen_css" border="1">
							<tr>
								<th width=50;>Hari</th>
								<th width=80;>Tanggal</th>
								<th width=80;>Pukul</th>
								<th width=400;>Judul/Keterangan</th>
								<th width=80;>Absen</th>
								<th width=200;>Status</th>
							</tr>
							<tr>
								<td><input type="text" class="hari_skg" name="hari_skg"></td>
								<td><input type="text" class="hari_skg" name="tanggal_skg"></td>
								<td><input type="text" class="hari_skg" name="pukul_skg"></td>
								<td><textarea name="keterangan" ><?php echo "$keterangan";?> </textarea></td>
								<td><input type="submit" name="absen" value="Kirim"/></td>
								<td><?php echo "$status";?></td>
							</tr>
						</table>
						</form>
						<script type="text/javascript">
						function waktu_now()
						{
							var x =new Date();
							var month=x.getMonth()+1;
							var year=x.getYear()+1900;
							var date=x.getDate();
							var day=x.getDay();
							var hour=x.getHours();
							var minute=x.getMinutes();
							var second=x.getSeconds();
							if (hour<10)
								hour="0"+hour;
							if (minute<10)
								minute="0"+minute;
							if (second<10)
								second="0"+second;
						/*---------------------------*/
							if (month<10)
								month="0"+month;
							if (date<10)
								date="0"+date;
							switch(day)
							{
								case 1:
									day="Senin";
									break;
								case 2:
									day="Selasa";
									break;
								case 3:
									day="Rabu";
									break;
								case 4:
									day="Kamis";
									break;
								case 5:
									day="Jum'at";
									break;
								case 6:
									day="Sabtu";
									break;
								case 0:
									day="Minggu";
									break;
							}
							document.hari_now.hari_skg.value = day;
							document.hari_now.tanggal_skg.value = date+"/"+month+"/"+year;
							document.hari_now.pukul_skg.value = hour+":"+minute+":"+second;
							setTimeout("waktu_now()",1000) ;
						}
						waktu_now()
						</script>
						<?php } ?>
						<!--[[[[[[[[[[[[[[penutup $_SESSION['user']]]]]]]]]]]]]]]-->
						
						
						<!--[[[[[[[[[[[[[[[[[[[[ $_SESSION['admin'] ]]]]]]]]]]]]]]]]]]]]-->
						<?php if($_SESSION['pengguna']=="admin"){
							 $query = "select id_login,asal_sekolah from data_diri ORDER BY asal_sekolah";
							 $sql= $koneksi->query($query);
							 $no=0;
							?>
						<h2>Absen Kegiatan Harian</h2><br/>
						<hr><br/>
						<form method="POST" name="hari_now">
						<table id="absen_css" border="1">
							<tr>
								<th>No</th>
								<th>Nama Siswa</th>
								<th>Asal Sekolah</th>
								<th>Aksi</th>
							</tr>
							<?php  while($hasil=$sql->fetch_array())
							 {	$id=$hasil['id_login'];
								$asal_sekolah=$hasil['asal_sekolah'];
								 $no++;?>
							<tr>
								<td><?php echo "$no";?></td>
								<td><?php echo "$id";?></td>
								<td><?php echo "$asal_sekolah";?></td>
								<td><?php echo "<a href='daftar_absen.php?id=$id'>lihat_absensi</a>";?></td>
							</tr>
							 <?php } ?>
						</table>
						</form>
						<?php } ?><!--penutup $_SESSION['admin']-->
					</div>
				</div>
			</div>
				<div id="footer">
				</div>
		</div>
	</body>
</html>
	<?php } ?>
