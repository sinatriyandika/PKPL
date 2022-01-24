<?php
	session_start();
	include 'koneksi.php';
	if($_SESSION['status_login'] != true){
		echo '<script>window.location="login.php"</script>';
	}

	$kategori = mysqli_query($conn, "SELECT * FROM tb_kategori WHERE kategori_id = '".$_GET['id']."' ");
	if(mysqli_num_rows($kategori) == 0){
		echo '<script>window.location="data-kategori.php"</script>';
	}
	$k = mysqli_fetch_object($kategori); 

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Halaman edit kategori</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>
<body>
	<!-- Header -->
	<header>
		<div class="container">
		<h1><a href="dashboard.php">Toko Online</a></h1>
		<ul>
			<li><a href="dashboard.php">Dashboard</a></li>
			<li><a href="profil.php">Profil</a></li>
			<li><a href="data-kategori.php">Data kategori</a></li>
			<li><a href="data-produk.php">Data produk</a></li>
			<li><a href="keluar.php">Keluar</a></li>
		</ul>
		</div>	
	</header>
	<!-- Akhir Header -->

	<!-- Konten -->
	<div class="section">
		<div class="container">
			<h3>Edit Data Kategori</h3>
			<div class="box">
				<form action="" method="POST">
					<input type="text" name="nama" placeholder="Nama kategori" class="input-control" value="<?php echo $k->kategori_nama ?>" required>
					<input type="submit" name="submit" value="submit" class="btn">
				</form>
				<?php 
					if (isset ($_POST['submit'])) {
						
						$nama = ucwords($_POST['nama']);

						$update = mysqli_query($conn, "UPDATE tb_kategori SET 
												kategori_nama = '".$nama."'
												WHERE kategori_id = '".$k->kategori_id."' ");
						
						if ($update) {
							echo '<script>window.location="data-kategori.php"</script>';
						}else{
							echo 'gagal' .mysqli_error($conn);
						}
					}

				?>
			</div>
		</div>
	</div>



	<!-- Footer -->
	<footer>
		<div class="container">
			<small>Copyright &copy</small>
		</div>
	</footer>
</body>
</html> 