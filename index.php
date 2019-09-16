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
		<script>
		function hide()
		{
			document.all.signUp.style.visibility = "hidden";
		}
		function show()
		{
			document.all.signUp.style.visibility = "visible";
		}
		</script>
	</head>
	<body>
	<div id="login">
		<div id="login-header">
			<img src="images/logo_telkomsel10.png" alt="logo">
		</div>
		<div id="login-dalam"> 
		<form action="" method="POST" submit="">
			<input type="text" class="text1" value="<?php if(isset($_POST['login'])){$username = $_POST['username'];echo "$username";}?>" name="username" placeholder="Username" required="">
			<input type="password" class="text1" value="<?php if(isset($_POST['login'])){$pass = $_POST['pass'];echo "$pass";}?>"name="pass" placeholder="Password" required="">			
			<select name="pengguna" id="pengguna" class="text1">
				<option onclick="show()" value="admin">Admin</option>
				<option onclick="hide()" value="users" >User</option>
			</select>
			<input type="submit" class="submit" name="login" value="Login"/>
			<div id="signUp" style="visibility:visible">
				<a href="signUp.php">Sign Up</a>
			</div>
		</form>
		</div>
	</div >
	</body>
</html>

<?php
session_start();
	if(isset($_POST['login']))
	{	$x=1;
		$username = $_POST['username'];
		$pass = $_POST['pass'];
		$pengguna =$_POST['pengguna'];
			$query= "SELECT id_login,password from $pengguna";
			$sql=$koneksi->query($query);
			while($hasil=$sql->fetch_array())
			{
				$id_login = $hasil['id_login'];
				$password = $hasil['password'];
				if($username == $id_login && $pass == $password)
				{
					$_SESSION['login']=$username;
					$_SESSION['pengguna']=$pengguna;
					header("Location:dashboard.php");	
				}
				else{
					$x++;
				}
				
			}
			if($x==1)
			{	
			}
			else{
				echo "<script>alert(\"Username atau Password salah\")</script>";
			}
			
	}
	
?>