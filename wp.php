<?php 

class Wp
{
	public $koneksi;
	public $kriteria;
	public $filter;

	function __construct()
	{
		$this->koneksi = mysqli_connect('localhost','root','','bus');
	}

	public function getData()
	{
		$query = "SELECT * FROM bus";
		if ($this->filter != null) {
			if (!empty($this->filter['harga_min']) && !empty($this->filter['harga_max'])) {
				$query .= " WHERE harga >= '".$this->filter['harga_min']."' AND harga <= '".$this->filter['harga_max']."'";
			} else {
				if (!empty($this->filter['harga_min'])) {
					$query .= " WHERE harga >= '".$this->filter['harga_min']."'";
				} elseif(!empty($this->filter['harga_max'])) {
					$query .= " WHERE harga <= '".$this->filter['harga_max']."'";
				}
			}

			if (!empty($this->filter['jenis'])) {
				$query .= strpos($query, "WHERE") ? " AND" : " WHERE";
				$query .= " jenis='".$this->filter['jenis']."'";
			}
		}
		return mysqli_query($this->koneksi ,$query);
	}

	public function getImage($id)
	{
		$query = "SELECT foto FROM bus WHERE id_bus = '$id' LIMIT 1";
		$result = mysqli_query($this->koneksi ,$query);
		$result = $result->fetch_assoc();
		return $result['foto'];
	}

	public function getMaks()
	{
		$query = "SELECT max(harga) as max_harga, max(`kapasitas_cc`) as max_cc, max(`daya_maks`) as max_daya, max(`torsi_maks`) as max_torsi, max(`tanki`) as max_tanki FROM `bus`";
		$mak = mysqli_query($this->koneksi ,$query);
		$mak = $mak->fetch_assoc();
		return $mak;
	}

	public function setKriteria($kriteria)
	{
		if ($kriteria == null) {
			$query = "SELECT * FROM `kriteria` ORDER BY id ASC";
			$result = mysqli_query($this->koneksi ,$query);
			$idx = 0;
			foreach ($result as $value) {
				$kriteria[$idx] = [
					'nama_kriteria'	=> $value['nama_kriteria'],
					'bobot'			=> $value['bobot'],
					'jenis'			=> $value['jenis']
				];
				$idx++;
			}
		}
		$this->kriteria = $kriteria;
	}

	public function getKeterangan($bobot)
	{
		$ket = 'Sangat Penting';
		if ($bobot == '1') {
			$ket = 'Sangat Tidak Penting';
		} elseif ($bobot == '2') {
			$ket = 'Tidak Penting';
		} elseif ($bobot == '3') {
			$ket = 'Cukup Penting';
		} elseif ($bobot == '4') {
			$ket = "Penting";
		}
		return $ket;
	}

	public function getKriteria()
	{
		return $this->kriteria;
	}

	public function setFilter($filter)
	{
		$this->filter = $filter;
	}

	public function normalisasiKriteria()
	{
		$total = 0;
		$kriteria = $this->kriteria;
		for ($i=0; $i < count($kriteria) ; $i++) { 
			$total = $total + $kriteria[$i]['bobot'];
		}
		for ($i=0; $i < count($kriteria) ; $i++) { 
			$kriteria[$i]['bobot'] = $kriteria[$i]['bobot']/$total;
		}
		return $kriteria;
	}

	public function cekBenefitCost()
	{
		$nilai = array();
		$kriteria = $this->normalisasiKriteria();
		$i = 0;
		foreach ($kriteria as $value) {
			if ($value['jenis'] == 'cost') {
				$nilai[$i] = $value['bobot'] * -1;
			}
			else{
				$nilai[$i] = $value['bobot'];
			}
			$i++;
		}
		return $nilai;
	}

	public function normalisasiData()
	{
		$bagi = $this->getMaks();
		$nilai = $this->cekBenefitCost();
		$hasil = array();
		$databus = array();
		$data = $this->getData();
		$idx = 0;
		foreach ($data as $value) {
			$databus[$idx][0] = $value['id_bus'];
			$databus[$idx][1] = $value['nama_bus'];
			$databus[$idx][2] = $value['harga']/$bagi['max_harga'];
			$databus[$idx][3] = $value['kapasitas_cc']/$bagi['max_cc'];
			$databus[$idx][4] = $value['daya_maks']/$bagi['max_daya'];
			$databus[$idx][5] = $value['torsi_maks']/$bagi['max_torsi'];
			$databus[$idx][6] = $value['tanki']/$bagi['max_tanki'];
			$idx++;
		}
		return $databus;
	}

	public function prepareData()
	{
		$bagi = $this->getMaks();
		$nilai = $this->cekBenefitCost();
		$hasil = array();
		$databus = array();
		$data = $this->getData();
		$idx = 0;
		foreach ($data as $value) {
			$databus[$idx][0] = $value['id_bus'];
			$databus[$idx][1] = $value['nama_bus'];
			$databus[$idx][2] = $value['harga'];
			$databus[$idx][3] = $value['kapasitas_cc'];
			$databus[$idx][4] = $value['daya_maks'];
			$databus[$idx][5] = $value['torsi_maks'];
			$databus[$idx][6] = $value['tanki'];
			$idx++;
		}
		return $databus;
	}

	public function vektorS()
	{
		$nilai = $this->cekBenefitCost();
		$hasil = array();
		$databus = $this->prepareData();
		$idx = count($databus);
		
		for ($i=0; $i < $idx; $i++) {
			for ($j=0; $j < 7 ; $j++) { 
				if ($j < 2) {
					$hasil[$i][0] = $databus[$i][0];
					$hasil[$i][1] = $databus[$i][1];
				}
				else{	
					$nil = $nilai[$j-2];
					$hasil[$i][$j] = pow($databus[$i][$j], $nil);
				}
			}
			$hasil[$i][7] = $hasil[$i][2] * $hasil[$i][3] * $hasil[$i][4] * $hasil[$i][5] * $hasil[$i][6];
		}
		return $hasil;
	}

	public function totalS()
	{
		$data = $this->vektorS();
		$total = 0;
		for ($i=0; $i < count($data); $i++) { 
			$total = $total + $data[$i][7];
		}
		return $total;
	}

	public function rangking()
	{
		$temp;
		$data = array();
		$result = $this->vektorS();
		$total = $this->totalS();
		for ($i=0; $i < count($result); $i++) { 
			$data[$i][0] = $result[$i][0];
			$data[$i][1] = $result[$i][1];
			$data[$i][2] = $result[$i][7]/$total;
		}
		for ($i=0; $i < count($data); $i++) { 
			for ($j=0; $j <= $i ; $j++) { 
				if ($data[$j][2] <= $data[$i][2]) {
					$temp = $data[$j][0];
					$data[$j][0] = $data[$i][0];
					$data[$i][0] = $temp;

					$temp = $data[$j][1];
					$data[$j][1] = $data[$i][1];
					$data[$i][1] = $temp;

					$temp = $data[$j][2];
					$data[$j][2] = $data[$i][2];
					$data[$i][2] = $temp;					
				}
			}
		}
		return $data;
	}
}

?>