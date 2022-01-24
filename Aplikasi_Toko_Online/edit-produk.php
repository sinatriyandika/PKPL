<?php
	session_start();
	include 'koneksi.php';
	if($_SESSION['status_login'] != true){
		echo '<script>window.location="login.php"</script>';
	}

	$produk = mysqli_query($conn, "SELECT * FROM tb_produk WHERE produk_id = '".$_GET['id']."' ");
	if(mysqli_num_rows($produk) == 0){
		echo '<script>window.location="data-produk.php"</script>';
	} 
	$p = mysqli_fetch_object($produk);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Halaman edit produk</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
	<script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
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
			<h3>Edit Data Produk</h3>
			<div class="box">
				<form action="" method="POST" enctype="multipart/form-data">
					<select class="input-control" name="kategori" required>
						<option value="">--Pilih--</option>
						<?php 
							$kategori = mysqli_query($conn, "SELECT * FROM tb_kategori ORDER BY kategori_id DESC ");
							while($r = mysqli_fetch_array($kategori)){
						 ?>
						 <option value="<?php echo $r['kategori_id'] ?>"<?php echo ( $r['kategori_id'] == $p->kategori_id)? 'selected' : ''; ?>><?php echo $r['kategori_nama'] ?></option>
						<?php } ?>
					</select>
					<input type="text" name="nama" class="input-control" placeholder="Nama Produk" value="<?php echo $p->produk_nama ?>" required="">
					<input type="text" name="harga" class="input-control" placeholder="Harga Produk"  value="<?php echo $p->produk_harga ?>" required="">
					
					<img src="produk/<?php echo $p->produk_gambar ?>" width="200px">
					<input type="hidden" name="foto" value="<?php echo $p->produk_gambar ?>">
					<input type="file" name="gambar" class="input-control">
					<textarea class="input-control" name="deskripsi" placeholder="Deskripsi"><?php echo $p->produk_deskripsi ?></textarea><br>
					<select class="input-control" name="status">
						<option value="">==Pilih==</option>
						<option value="1" <?php echo ($p->produk_status == 1)? 'selected': ''; ?>>Aktif</option>
						<option value="0" <?php echo ($p->produk_status == 0)? 'selected': ''; ?>>Tidak Aktif</option>
					</select>
					<input type="submit" name="submit" value="submit" class="btn">
				</form>
				<?php 
					if (isset ($_POST['submit'])) {
						
						$kategori 	= $_POST['kategori'];
						$nama 		= $_POST['nama']; 
						$harga 		= $_POST['harga']; 
						$deskripsi 	= $_POST['deskripsi']; 
						$status 	= $_POST['status']; 
						$foto 		= $_POST['foto'];


						$filename = $_FILES['gambar']['name']; 
						$tmp_name = $_FILES['gambar']['tmp_name'];

						
						if($filename != ''){
						$typel = explode('.', $filename);
						$type2 = $typel[1];

						$newname = 'produk'.time().'.'.$type2;

						$tipe_diizinkan = array('jpg','jpeg','png','gif');

						if(!in_array($type2, $tipe_diizinkan)){

							echo '<script>alert("Format file tidak diizinkan")</script>';
						
						} else{
							unlink('./produk/'.$foto);
							move_uploaded_file($tmp_name, './produk/'.$newname);
							$namagambar = $newname;

							}

						}else{

							$namagambar = $foto;
						}

						$update = mysqli_query($conn, "UPDATE tb_produk SET
								kategori_id = '".$kategori."',
								produk_nama = '".$nama."',
								produk_harga = '".$harga."',
								produk_deskripsi = '".$deskripsi."',
								produk_gambar = '".$namagambar."',
								produk_status = '".$status."'
								WHERE produk_id = '".$p->produk_id."' ");

						if($update){
								echo '<script>Ubah data berhasil</script>';
								echo '<script>window.location="data-produk.php"</script>';	
							}else{
								echo 'ubah data galal'.mysqli_error($conn);
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
	<script>
            CKEDITOR.replace( 'deskripsi' );
    </script>
</body>
</html> 