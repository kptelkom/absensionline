<!DOCTYPE html>
<!--database data_diri.sql-->
<?php
session_start();
	include "koneksi.php";
	if(isset($_SESSION['login']))
	{
		$x = $_SESSION['login'];/*tampung sementara kedalam x*/
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
		function hapus()
		{
			var x = window.confirm("Apakah anda yakin data ini dihapus ?");
			if(x)
			{
				window.location="hapus.php";
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
						<?php if($_SESSION['pengguna']=="admin"){?><li style="background-color:white"><img  onclick="tujuan(3)" src="images/profiluser.png" alt="menu3"/><a id="k3" href="buat_akun_user.php" >Akun User </a></li><?php } ?>
						<li><img src="images/absen2.png" onclick="tujuan(4)" alt="menu4"/><a id="k4" href="absen.php">Absen Harian</a></li>
						<li><img src="images/nilai2.png" onclick="tujuan(5)" alt="menu5"/><a id="k5" href="form_nilai.php">Form Penilaian</a></li>
						<li><img src="images/unduh.png" onclick="tujuan(8)" alt="menu8"/><a id="k8" href="unduh.php">Unduhan</a></li>
						<li><img src="images/logout2.png" onclick="logout()" alt="menu6"/><a href="#" onClick="logout()" id="k6">Logout</a></li>
					</ul>
				</div>
				<div id="content">
					<div id="isi">
					<h2>Buat Akun Users</h2>
					<br/><hr><br/>
					<?php if(isset($_POST['simpan']))
					{	
						$id = $_POST['id'];
						$pass = $_POST['pass'];
						if($id !== "" && $pass !== "")
						{
							$query= "insert into users values('$id','$pass','$x')";
							$sql=$koneksi->query($query);
							if($sql)
							{
								$query= "insert into data_diri set id_login='$id'";			
								$sql=$koneksi->query($query);
								$query= "insert into form_penilaian set id_login='$id'";			
								$sql=$koneksi->query($query);
								echo "<div id=\"berhasil_popup\">Data Berhasil Disimpan <img src=\"images/silang.png\" alt=\"silang\" onclick=\"silang1()\"/></div>";
							}
						}
						else
						{
							echo "<div id=\"gagal_popup\">Data Gagal Disimpan <img src=\"images/silang.png\" alt=\"silang\" onclick=\"silang()\"/></div>"; 
						}
					}?>
					<!-- simpan & lihat user-->
					<FORM ACTION="" METHOD="POST" > 
					<table id="data_diri">
						<tr>
							<th>Id_login</th>
							<th>Password</th>
							<th>Action</th>
						</tr>
						<tr>
							<td><input type="text" name="id" value="" ></td>
							<td><input type="text" name="pass" value=""></td>
							<td><input type="submit" name="simpan" value="Simpan">
								<input type="submit" name="lihat" value="Lihat"></td>
						</tr>
					</table>
					</FORM>
					<!-- delete user-->
					<FORM method="POST" name="del">
						<?php
						if(isset($_POST['lihat']))
						{	echo "<table id='data_diri'>";
							echo "<tr><th>Id_login</th> <th>Password</th> <th>Action</th> </tr>";
							$query= "select id_login,password from users where id_admin='$x'";
							$sql=$koneksi->query($query);		
							while($hasil=$sql->fetch_array())
							{
								$id = $hasil['id_login'];
								$pass = $hasil['password'];
								echo "<tr><td>&nbsp;$id</td> <td>&nbsp;$pass</td> <td><a onclick='hapus()'href='hapus.php?id=$id'>Delete</a></td></tr>";
							}
						}
						?>
						</table>
					</FORM>
					
					</div>
				</div>
			</div>
				<div id="footer">
				</div>
		</div>
	</body>
</html>
<?php } ?>
	