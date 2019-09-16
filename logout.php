<!-- Logout sessin-->
<?php 
	session_start();
	if(isset($_SESSION['login']))
	{
		echo "<script>alert (\"Behasil Logout\");</script>";
		session_destroy();
		header("Location:index.php");
	}
	?>