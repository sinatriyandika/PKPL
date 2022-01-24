<?php
	session_start();
	include 'koneksi.php';
	if($_SESSION['status_login'] != true){
		echo '<script>window.location="login.php"</script>';
	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Halaman Data Produk</title>
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
			<h3>Data Produk</h3>
			<div class="box">
				<p><a href="tambah-produk.php">Tambah data</a></p>
				<table border="1" cellspacing="0" class="table">
					<thead>
						<tr>
							<th width="60px">No</th>
							<th>Kategori</th>
							<th>Nama Produk</th>
							<th>Harga</th>
							<th>Deskripsi</th>
							<th>gambar</th>
							<th>Status</th>
							<th width="150px">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$no = 1; 
							$produk = mysqli_query($conn, "SELECT * FROM tb_produk LEFT JOIN tb_kategori USING (kategori_id) ORDER BY produk_id DESC");
							if(mysqli_num_rows($produk) > 0){
							while ($row = mysqli_fetch_array($produk)) {
								
						 ?>
						<tr>
							<td><?php echo $no++ ?></td>
							<td><?php echo $row['kategori_nama'] ?></td>
							<td><?php echo $row['produk_nama'] ?></td>
							<td>Rp. <?php echo number_format($row['produk_harga'])?></td>
							<td><?php echo $row['produk_deskripsi'] ?></td>
							<td><a href="produk/<?php echo $row['produk_gambar'] ?>"><img src="produk/<?php echo $row['produk_gambar'] ?>"width="200px"></a></td>
							<td><?php echo ($row['produk_status'] == 0 )? 'Tidak Aktif': 'Aktif' ?></td>
							<td>
								<a href="edit-produk.php?id=<?php echo $row['produk_id'] ?>">Edit</a> || <a href="proses-hapus.php?idp=<?php echo $row['produk_id'] ?>" onclick="return confirm('GAS?')">Hapus</a>
							</td>
						</tr>
						<?php }}else{ ?>
							<tr>
								<td colspan="8">Tidak ada data</td>
							</tr>

						<?php } ?>
					</tbody>
				</table>
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