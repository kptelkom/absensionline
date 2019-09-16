<?php
	session_start();
	if($_SESSION['pengguna']=="admin")
	{
		include "koneksi.php";
		$id = $_GET['id'];
		$query= "select kehadiran,kerjasama,komunikasi,sikap,prestasi_kerja,kreatifitas from form_penilaian WHERE id_login='$id'";
		$sql=$koneksi->query($query);
		$hasil=$sql->fetch_array();
		$kehadiran = $hasil['kehadiran'];
		$kerjasama = $hasil['kerjasama'];
		$komunikasi = $hasil['komunikasi'];
		$sikap = $hasil['sikap'];
		$prestasi_kerja = $hasil['prestasi_kerja'];
		$kreatifitas = $hasil['kreatifitas'];
		if(isset($_POST['simpan']))
		{
			$kehadiran = $_POST['kehadiran'];
			$kerjasama = $_POST['kerjasama'];
			$komunikasi = $_POST['komunikasi'];
			$sikap = $_POST['sikap'];
			$prestasi_kerja = $_POST['prestasi_kerja'];
			$kreatifitas = $_POST['kreatifitas'];
			$query= "update form_penilaian set kehadiran='$kehadiran',kerjasama='$kerjasama',komunikasi='$komunikasi',sikap='$sikap',prestasi_kerja='$prestasi_kerja',
					kreatifitas='$kreatifitas' WHERE id_login='$id'";
			$sql=$koneksi->query($query);
			if($sql)
			{
				echo "<script>alert (\"Data telah berhasil disimpan\");</script>"; 
				header("Location:form_nilai.php");
			}
		}
?>		
	<head>
		<link rel="stylesheet" href="css/style.css">
	</head>
			<form method="post">
			<table  id="table_nilai" border="1" name="table_nilai">
				<tr>
					<th>Nama</th>
					<td>:</td>
					<td><?php echo "$id";?></td>
				</tr>
				<tr>
					<th>Kehadiran</th>
					<td>:</td>
					<td><input type="text" name="kehadiran" value="<?php echo "$kehadiran";?>"></td>
				</tr>
				<tr>
					<th>Kerjasama</th>
					<td>:</td>
					<td><input type="text" name="kerjasama" value="<?php echo "$kerjasama";?>"</td>
				</tr>
				<tr>
					<th>Komunikasi</th>
					<td>:</td>
					<td><input type="text" name="komunikasi" value="<?php echo "$komunikasi";?>"</td>
				</tr>
				<tr>
					<th>Sikap/Etika</th>
					<td>:</td>
					<td><input type="text" name="sikap" value="<?php echo "$sikap";?>"</td>
				</tr>
				<tr>
					<th>Prestasi Kerja</th>
					<td>:</td>
					<td><input type="text" name="prestasi_kerja" value="<?php echo "$prestasi_kerja";?>"</td>
				</tr>	
					<th>Kreatifitas</th>
					<td>:</td>
					<td><input type="text" name="kreatifitas" value="<?php echo "$kreatifitas";?>"</td>
				<tr>	
					<th></th>
					<td></td>
					<td><input type="submit" name="simpan" value="Simpan"/></td>
				</tr>
			</table>
			</form>
	<?php } ?>