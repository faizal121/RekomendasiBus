<!DOCTYPE html>
<html>
<?php include_once 'layout/head.php'; ?>
<body>
	<?php include_once 'layout/sidebar.php'; ?>
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header card-header-primary">
							<h4 class="card-title"><strong>Data Bus</strong></h4>
						</div>
						<div class="card-body">
							<br><br>
							<button type="button" onclick="tambah()" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add</button><br><br>
							<div id="input-bus">
								<form style="border: 1px solid #CCC; margin: 10px 0px; padding: 30px; width: auto; height: auto; background-color: #F5FFFA; text-align: left;" action="_crud_bus.php" method="POST" enctype="multipart/form-data">
									<h4><center><strong>Form Bus</strong></center></h4>
									<div class="row">
										<div class="col-md-3">
											<label style="color:black">Nama Bus</label>
											<input type="hidden" id="aksi" name="aksi">
											<input type="hidden" id="id_bus" name="id_bus">
											<input type="text" name="nama" id="nama" class="form-control">
										</div>
										<div class="col-md-3">
											<label style="color:black">Kapasitas (cc)</label>
											<input type="number" name="kapasitas" id="kapasitas" class="form-control">
										</div>
										<div class="col-md-3">
											<label style="color:black">Daya Maksimum (Kw)</label>
											<input type="number" name="daya" id="daya" class="form-control">
										</div>
										<div class="col-md-3">
											<label style="color:black">Torsi Maksimum (Nm)</label>
											<input type="number" name="torsi" id="torsi" class="form-control">
										</div>
										<div class="col-md-3">
											<label style="color:black">Sistem Injeksi</label>
											<textarea name="injeksi" id="injeksi" class="form-control" rows="3" style="resize: none"></textarea>
										</div>
										<div class="col-md-3">
											<label style="color:black">Tipe Kopling</label>
											<textarea name="kopling" id="kopling" class="form-control" rows="3" style="resize: none"></textarea>
										</div>
										<div class="col-md-3">
											<label style="color:black">Suspensi Depan</label>
											<textarea name="sus_d" id="sus_d" class="form-control" rows="3" style="resize: none"></textarea>
										</div>
										<div class="col-md-3">
											<label style="color:black">Suspensi Belakang</label>
											<textarea name="sus_b" id="sus_b" class="form-control" rows="3" style="resize: none"></textarea>
										</div>
										<div class="col-md-3">
											<label style="color:black">Diameter Kopling</label>
											<input type="text" name="Dkopling" id="Dkopling" class="form-control">
										</div>
										<div class="col-md-3">
											<label style="color:black">Transmisi</label>
											<input type="text" name="transmisi" id="transmisi" class="form-control">
										</div>
										<div class="col-md-3">
											<label style="color:black">Berat</label>
											<input type="number" name="berat" id="berat" class="form-control">
										</div>
										<div class="col-md-3">
											<label style="color:black">Tanki</label>
											<input type="number" name="tanki" id="tanki" class="form-control">
										</div>
										<div class="col-md-9">
											<label style="color:black">Deskripsi</label>
											<textarea name="deskripsi" id="deskripsi" class="form-control" rows="6" style="resize: none"></textarea>
										</div>
										<div class="col-md-3">
											<label style="color:black">Foto</label>
											<input type="file" name="foto" id="foto" class="form-control">
											<img id="foto_bus" src="../assets/img/bus/default.png" width="175" height="100">
										</div>
										<div class="col-md-3">
											<label style="color:black">Rem</label>
											<textarea name="rem" id="rem" class="form-control" rows="2" style="resize: none"></textarea>
										</div>
										<div class="col-md-3">
											<label style="color:black">Harga</label>
											<input type="number" name="harga" id="harga" class="form-control">
										</div>
										<div class="col-md-3">
											<label style="color:black">Jenis</label>
											<select name="jenis" id="jenis" class="form-control">
												<option value="reguler">Reguler</option>
												<option value="tronton">Tronton</option>
											</select>
										</div>
										<div class="col-md-3"></div>
										<div class="col-md-3">
											<br>
											<button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> <span id="tombol"></span></button>
											<button type="reset" class="btn btn-danger btn-sm"><i class="fa fa-refresh"></i> Reset</button>
											<a href="javascript:tutup();"><i class="fa fa-arrow-up"></i></a>
										</div>
									</div>
								</form>
								<br><br>
							</div>
							<table class="table table-striped text-center">
								<thead style="background-color: purple; color:white">
									<tr>
										<th width="10">No</th>
										<th width="150">Nama Bus</th>
										<th width="150">Jenis</th>
										<th width="150">Kapasitas (cc)</th>
										<th width="100">Daya Maksimum</th>
										<th width="100">Torsi Maksimum</th>
										<!-- <th width="100">Tipe Suspensi</th> -->
										<th width="100">Tanki (ltr)</th>
										<th width="100">aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									include_once '../config/dao.php';
									$dao = new Dao();
									$data = $dao->view('bus');
									$no = 1;
									foreach ($data as $value) {
										$foto = "../assets/img/bus/".$value['foto'];
										$edit = "'".$value['id_bus']."','".$value['nama_bus']."','".$value['kapasitas_cc']."','".$value['daya_maks']."','".$value['torsi_maks']."','".$value['injeksi']."','".$value['kopling']."','".$value['kopling_di']."','".$value['suspensi_dpn']."','".$value['suspensi_blk']."','".$value['transmisi']."','".$value['berat']."','".$value['rem']."','".$value['tanki']."','".$value['deskripsi']."','".$value['harga']."','".$foto."','".$value['jenis']."'";
										$delete = "'".$value['id_bus']."','".$value['nama_bus']."'";
										?>
										<tr>
											<td><?php echo $no;$no++; ?></td>
											<td><?php echo $value['nama_bus'] ?></td>
											<td><?php echo $value['jenis'] ?></td>
											<td><?php echo $value['kapasitas_cc'] ?></td>
											<td><?php echo $value['daya_maks'] ?></td>
											<td><?php echo $value['torsi_maks'] ?></td>
											<!-- <td><?php echo $value['suspensi_blk'] ?></td> -->
											<td><?php echo $value['tanki'] ?></td>
											<td nowrap="">
												<a href="../admin/detailbus?id=<?php echo $value['id_bus'] ?>"><button type="button" class="btn btn-danger btn-sm" title="Show Detail"><i class="fa fa-pencil"></i></button></a>
												<button type="button" onclick="edit(<?php echo $edit; ?>)" class="btn btn-info	 btn-sm" title="Edit"><i class="fa fa-edit"></i></button>
												<button type="button" onclick="hapus(<?php echo $delete; ?>);" class="btn btn-warning btn-sm" title="Hapus"><i class="fa fa-trash"></i></button>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal delete bus -->
	<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<form action="_crud_bus.php" method="POST">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Data Bus</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<center>Yakin hapus data bus ini?</center>
						<input type="hidden" name="id_bus" id="id_bus_del">
						<input type="hidden" name="aksi" id="aksi_del">
						<center><h3 id="nama_bus" style="color: red;"></h3></center>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-danger">Ya, Hapus</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- end modal delete bus -->

	<?php include_once 'layout/footer.php'; ?>
</body>
<?php include_once 'layout/js.php'; ?>
<script type="text/javascript">
	function tambah(){
		$("#id_bus").val('');
		$("#nama").val('');
		$("#kapasitas").val('');
		$("#daya").val('');
		$("#torsi").val('');
		$("#injeksi").val('');
		$("#kopling").val('');
		$("#Dkopling").val('');
		$("#sus_d").val('');
		$("#sus_b").val('');
		$("#transmisi").val('');
		$("#berat").val('');
		$("#rem").val('');
		$("#tanki").val('');
		$("#deskripsi").val('');
		$("#harga").val('');
		$("#jenis").val('');
		$("#aksi").val('simpan');
		$("#tombol").text('Simpan');
		$("#input-bus").show();
	}
	function edit(id,nm,kpts,daya,torsi,injeksi,kopling,Dkopling,sus_d,sus_b,transmisi,berat,rem,tanki,deskripsi,harga,foto,jenis){
		$("#id_bus").val(id);
		$("#nama").val(nm);
		$("#kapasitas").val(kpts);
		$("#daya").val(daya);
		$("#torsi").val(torsi);
		$("#injeksi").val(injeksi);
		$("#kopling").val(kopling);
		$("#Dkopling").val(Dkopling);
		$("#sus_d").val(sus_d);
		$("#sus_b").val(sus_b);
		$("#transmisi").val(transmisi);
		$("#berat").val(berat);
		$("#rem").val(rem);
		$("#tanki").val(tanki);
		$("#deskripsi").val(deskripsi);
		$("#harga").val(harga);
		$("#jenis").val(jenis);
		$("#foto_bus").attr("src", foto);

		$("#aksi").val('edit');
		$("#tombol").text('Edit');
		$("#input-bus").show();
	}
	function hapus(id,nm){
		$("#id_bus_del").val(id);
		$("#nama_bus").text(nm);
		$("#aksi_del").val('hapus');
		$("#modalDelete").modal("show")
	}
	function tutup(){
		$("#input-bus").hide();
	}

	foto.onchange = evt => {
		const [file] = foto.files
		if (file) {
			foto_bus.src = URL.createObjectURL(file)
		}
	}
</script>
</html>