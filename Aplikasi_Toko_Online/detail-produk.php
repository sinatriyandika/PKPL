<?php 
	error_reporting(0);
	include 'koneksi.php';
	$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_alamat FROM tb_admin 
		WHERE admin_id= 1");
	$a = mysqli_fetch_object($kontak);

	$produk = mysqli_query($conn, "SELECT * FROM tb_produk WHERE produk_id = '".$_GET['id']."' ");
	$p = mysqli_fetch_object($produk);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Halaman Index</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>
<body>
	<!-- Header -->
	<header>
		<div class="container">
		<h1><a href="index.php">Toko Online</a></h1>
		<ul>
			<li><a href="produk.php">Produk</a></li>
		</ul>
		</div>	
	</header>
	<!-- Akhir Header -->

	<!-- Search -->
	<div class="search">
		<div class="container">
			<form action="produk.php">
				<input type="text" name="search" value="<?php echo $_GET['search'] ?>">
				<input type="hidden" name="kat" value="<?php echo $_GET ['kat'] ?>">
				<input type="submit" name="Cari" value="cari produk" >
			</form>
		</div>
	</div>
	<!-- Akhir search -->

	<!-- Produk Detail -->

		<div class="section">
			<div class="container">
				<h2>Detail Produk</h2>
				<div class="box">
					<div class="col-2">
						<img src="produk/<?php echo $p->produk_gambar ?>" width="70%">
					</div>
					<div class="col-2">
						<h3><?php echo $p->produk_nama ?></h3>
						<h4>Rp. <?php echo number_format($p->produk_harga) ?></h4>
						<p>
							<?php echo $p->produk_deskripsi ?>
						</p>
						<p><a href="https://api.whatsapp.com/send?phone=<?php echo $a->admin_telp ?>" target="_blank">Hubungi Via WhatsApp 
						<img src="img/whatsapp.png" width="50px"></a>
						</p>
					</div>
				</div>
			</div>
		</div>

	<!--  Akhir produk detail -->

	<!-- Footer -->
	<div class="footer">
		<div class="container">
			<h4>Alamat</h4>
			<p><?php echo $a->admin_alamat ?></p>

			<h4>Email</h4>
			<p><?php echo $a->admin_email ?></p>

			<h4>No Telepon</h4>
			<p><?php echo $a->admin_telp ?></p>
			<small>Copyright &copy; 2022 - Toko Online.</small>
		</div>
	</div>
	<!-- Akhir footer -->
</body>
</html> 