<?php
	session_start();
	if($_SESSION['status_login'] != true){
		echo '<script>window.location="login.php"</script>';
	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Halaman Dashboard</title>
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
			<h3>Dasboard</h3>
			<div class="box">
				<h4>Selamat Datang <?php echo $_SESSION['a_global']->admin_nama ?> Di Toko Online </h4>
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