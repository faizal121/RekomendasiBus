<?php 
include_once 'dbconfig.php';

class Dao 
{
	var $link;
	public function __construct()
	{
		$this->link = new Dbconfig(); 
	}

	function rupiah($angka){	
		$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
		return $hasil_rupiah;
	}

	public function getColor($jenis)
	{
		if ($jenis == "reguler")
			return '<span class="badge badge-primary">Reguler</span>';
		return '<span class="badge badge-warning">Tronton</span>';
	}

	public function view($tabel)
	{
		$query = "SELECT * FROM $tabel";
		return mysqli_query($this->link->conn, $query);	
	}

	public function viewRekomendasiBus($id)
	{
		$query = "SELECT * FROM bus WHERE id_bus = '$id'";
		$result = mysqli_query($this->link->conn, $query);	
		return $result->fetch_array();	
	}

	public function detail($id)
	{
		$query = "SELECT * FROM bus WHERE id_bus = '$id'";
		$result =  mysqli_query($this->link->conn, $query);	
		return $result->fetch_array();	
	}

	public function cekLogin($username, $password)
	{
		$query = "SELECT * FROM admin WHERE username = '$username' AND `password` = PASSWORD('$password')";
		return mysqli_query($this->link->conn, $query);
		// return $result->fetch_assoc();
	}

	public function getDashboard()
	{
		$data = array();
		$query = "SELECT * FROM bus";
		$result = mysqli_query($this->link->conn, $query);
		$data['bus'] = $result->num_rows;

		$query = "SELECT * FROM kriteria";
		$result = mysqli_query($this->link->conn, $query);
		$data['kriteria'] = $result->num_rows;

		$query = "SELECT * FROM admin";
		$result = mysqli_query($this->link->conn, $query);
		$data['pengguna'] = $result->num_rows;
		return $data;
	}

	public function execute($query)
	{
		$result = mysqli_query($this->link->conn, $query);
		if ($result) {
			return $result;
		}else{
			return mysqli_error($this->link->conn);
		}
	}


}

?>