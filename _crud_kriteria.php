<?php 
include_once '../config/dao.php';
$dao = new Dao();
// var_dump($_POST);die;
if ($_POST['aksi'] == 'simpan') {
	$nama = $_POST['nama'];
	$jenis = $_POST['jenis'];
	$bobot = $_POST['bobot'];
	$query = "INSERT INTO `kriteria`(`nama_kriteria`, `jenis`, `bobot`) VALUES ('$nama','$jenis','$bobot')";
}
elseif ($_POST['aksi'] == 'edit') {
	$id = $_POST['id_kriteria'];
	$nama = $_POST['nama'];
	$jenis = $_POST['jenis'];
	$bobot = $_POST['bobot'];
	$query = "UPDATE `kriteria` SET `nama_kriteria`='$nama',`jenis`='$jenis',`bobot`='$bobot' WHERE `id` = '$id'";
}
elseif ($_POST['aksi'] == 'hapus') {
	$id = $_POST['id'];
	$query = "DELETE FROM `kriteria` WHERE `id` = '$id'";
}
// var_dump($query);die;
$dao->execute($query);

header("location:kriteria");
?>
