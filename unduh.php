<!DOCTYPE html>
<?php
session_start();
include "koneksi.php";
//pemeriksaan login
if(isset($_SESSION['login']))
{$x=$_SESSION['login'];?>
<html>
	<head><style>
			html,body{
			font:12px Arial,Helvetica,sans-serif;
			}
			fieldset{
				border:1px solid #ff0000;
				width:400px;
			}
			legend{
				border:1px solid #ff0000;
			}
			table{
				border-collapse:collapse;
				width:500px;
			}
			td,th{
				border:1px solid #c0c0c0;
				padding:5px;
			}
			th{background:#ff0000;color:#ffffff;
			}
		</style>
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
		function checkSize(max_img_size)
		{
			var input = document.getElementById("fileupload");
			if(input.files && input.files.length == 1)
			{
				alert "Ukuran file harus dibawah "+(max_img_size/1024/1024)+"MB");
				return false;
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
						<li><img src="images/dashboard.png" onclick="tujuan(1)" alt="menu1"><a id="k1" href="dashboard.php">Dashboard</a></li>
					    <li><img src="images/profil2.png" onclick="tujuan(2)" alt="menu2"/><a id="k2" href="data_diri.php">Data Diri </a></li>
						<?php if($_SESSION['pengguna']=="admin"){?><li><img  onclick="tujuan(3)" src="images/profiluser.png" alt="menu3"/><a id="k3" href="buat_akun_user.php" >Akun User </a></li><?php } ?>
						<li><img src="images/absen2.png" onclick="tujuan(4)" alt="menu4"/><a id="k4" href="absen.php">Absen Harian</a></li>
						<li><img src="images/nilai2.png" onclick="tujuan(5)" alt="menu5"/><a id="k5" href="form_nilai.php">Form Penilaian</a></li>
						<li  style="background-color:white"><img src="images/unduh.png" onclick="tujuan(8)" alt="menu8"/><a id="k8" href="unduh.php">Unduhan</a></li>
						<li><img src="images/logout2.png" onclick="tujuan(6)" alt="menu6"/><a href="logout.php" id="k6">Logout</a></li>
					</ul>
				</div>
				<div id="content"><!--posisi contentnya-->
					<div id="isi"><!--isi dari content-->
					<h2>Unduh Contoh Form Nilai dan Form Absen</h2>
					<br/><hr><br/>
					<?php
						if($_SESSION['pengguna']=="users")
						{
							?>
							<table>
							<tr>
								<th>File Name</th>
								<th>Upload Date</th>
								<th>Type</th>
								<th>Size</th>
								<th>Delete</th>
							</tr>
							<?php
								if($handle = opendir('./files/'))	
								{
									while(true==($file = readdir($handle)))
									{
										if($file!=="." && $file!=="..")
										{
											echo "<tr><td><a href=\"download.php/id=".urlencode($file)."\">$file</a></td>";
											echo "<td>".date("m/d/Y H:i",filemtime("files/".$file)).'</td>';
											echo "<td>.".pathinfo("files/".$file,PATHINFO_EXTENSION).'</td>';
											echo "<td>".round(filesize("files/".$file)/1024).'KB</td>';
											echo "<td><a href=\"hapusk.php?id=$file\">Del</a></td></tr>";
										}
						
									}
					
									closedir($handle);
								}			
							?>
						</table>		
					<?php } ?><!--Penutup session users -->
						
					<!--session admin-->
					<?php
						if($_SESSION['pengguna']=="admin")
						{
							?>
							<form enctype="multipart/form-data" action="uploader.php" method="post" onsubmit="return checkSize(1048576);">
							<fieldset>
							<legend>Upload File Max 1 MB</legend>
									Choose a file to upload: <input name="uploadedfile" type="file" id="fileupload"/><br/>
									<input type="submit" value="Upload File"/>
							</fieldset>
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
	
	