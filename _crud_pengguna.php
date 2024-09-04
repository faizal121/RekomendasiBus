<?php 
include_once '../config/dao.php';
$dao = new Dao();
//var_dump($_POST);die;
if ($_POST['aksi'] == 'simpan') {
	$nama = $_POST['nama'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$query = "INSERT INTO `admin`(`nama`, `username`, `password`) VALUES ('$nama','$username',PASSWORD('$password'))";
}
elseif ($_POST['aksi'] == 'edit') {
	$id = $_POST['id_user'];
	$nama = $_POST['nama'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$query = "UPDATE `admin` SET `nama`='$nama',`username`='$username',`password`=PASSWORD('$password') WHERE `id_user` = '$id'";
}
elseif ($_POST['aksi'] == 'hapus') {
	$id = $_POST['id_user'];
	$query = "DELETE FROM `admin` WHERE `id_user` = '$id'";
}
//var_dump($query);die;
$dao->execute($query);

header("location:pengguna");
?>
