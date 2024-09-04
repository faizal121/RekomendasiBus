<?php 
include_once '../config/dao.php';
$dao = new Dao();
// echo '<pre>';
// var_dump($_POST);
// echo '</pre>';die;
$file_name='';
if (!empty($_FILES['foto'])) {
	$file_name = $_FILES['foto']['name'];
	$ekstensi = explode('.', $file_name);
	$file_name = strtoupper($file_name).'.'.$ekstensi[1];
	$location = "../assets/img/bus/".$file_name;
	$imageFileType = pathinfo($location, PATHINFO_EXTENSION);
	$imageFileType = strtolower($imageFileType);
	if (move_uploaded_file($_FILES['foto']['tmp_name'], $location)) {
			// 
	}
}
// var_dump($file_name);die;
if ($_POST['aksi'] == 'simpan') {
	$nama = $_POST['nama'];
	$kapasitas = $_POST['kapasitas'];
	$daya = $_POST['daya'];
	$torsi = $_POST['torsi'];
	$injeksi = $_POST["injeksi"];
	$kopling = $_POST["kopling"];
	$Dkopling = $_POST["Dkopling"];
	$sus_d = $_POST["sus_d"];
	$sus_b = $_POST["sus_b"];
	$transmisi = $_POST["transmisi"];
	$berat = $_POST["berat"];
	$rem = $_POST["rem"];
	$tanki = $_POST["tanki"];
	$deskripsi = $_POST["deskripsi"];
	$harga = $_POST["harga"];
	$jenis = $_POST["jenis"];
	$foto = $file_name;
	$query = "INSERT INTO `bus`(`nama_bus`, `harga`, `kapasitas_cc`, `daya_maks`, `torsi_maks`, `injeksi`, `kopling`, `kopling_di`, `suspensi_blk`, `suspensi_dpn`, `transmisi`, `berat`, `rem`, `tanki`, `deskripsi`, `foto`, `jenis`) VALUES ('$nama','$harga','$kapasitas','$daya','$torsi','$injeksi','$kopling','$Dkopling','$sus_b','$sus_d','$transmisi','$berat','$rem','$tanki','$deskripsi', '$foto', '$jenis')";
}
elseif ($_POST['aksi'] == 'edit') {
	$id = $_POST['id_bus'];
	$nama = $_POST['nama'];
	$kapasitas = $_POST['kapasitas'];
	$daya = $_POST['daya'];
	$torsi = $_POST['torsi'];
	$injeksi = $_POST["injeksi"];
	$kopling = $_POST["kopling"];
	$Dkopling = $_POST["Dkopling"];
	$sus_d = $_POST["sus_d"];
	$sus_b = $_POST["sus_b"];
	$transmisi = $_POST["transmisi"];
	$berat = $_POST["berat"];
	$rem = $_POST["rem"];
	$tanki = $_POST["tanki"];
	$deskripsi = $_POST["deskripsi"];
	$harga = $_POST["harga"];
	$jenis = $_POST["jenis"];
	$foto = $file_name;
	$query = "UPDATE `bus` SET `nama_bus`='$nama',`harga`='$harga',`kapasitas_cc`='$kapasitas',`daya_maks`='$daya',`torsi_maks`='$torsi',`injeksi`='$injeksi',`kopling`='$kopling',`kopling_di`='$Dkopling',`suspensi_blk`='$sus_b',`suspensi_dpn`='$sus_d',`transmisi`='$transmisi',`berat`='$berat',`rem`='$rem',`tanki`='$tanki',`deskripsi`='$deskripsi', `jenis`='$jenis'";
	if (!empty($_FILES['foto'])) {
		$query .= ",`foto` = '$foto'";
	}
	$query .= " WHERE `id_bus` = '$id'";
}
elseif ($_POST['aksi'] == 'hapus') {
	$id = $_POST['id_bus'];
	$query = "DELETE FROM `bus` WHERE `id_bus` = '$id'";
}
// var_dump($query);die;
$dao->execute($query);

header("location:bus");
s?>
