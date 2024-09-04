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
							<h4 class="card-title"><strong>Data Pengguna</strong></h4>
						</div>
						<div class="card-body">
							<br><br>
							<button type="button" onclick="tambah()" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add</button><br><br>
							<div id="input-pengguna">
								<form style="border: 1px solid #CCC; margin: 10px 0px; padding: 30px; width: auto; height: auto; background-color: #F5FFFA; text-align: left;" action="_crud_pengguna.php" method="POST">
									<h4><center><strong>Form Pengguna</strong></center></h4>
									<div class="row">
										<div class="col-md-4">
											<label style="color:black">Nama Pengguna</label>
											<input type="hidden" id="aksi" name="aksi">
											<input type="hidden" id="id_user" name="id_user">
											<input type="text" name="nama" id="nama" class="form-control">
										</div>
										<div class="col-md-4">
											<label style="color:black">Username</label>
											<input type="text" name="username" id="username" class="form-control">
										</div>
										<div class="col-md-4">
											<label style="color:black">Password</label>
											<input type="password" name="password" id="password" class="form-control">
										</div>
										<div class="col-md-9"></div>
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
										<th width="10">Nama</th>
										<th width="150">UserName</th>
										<th width="150">Password</th>
										<th width="100">aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									include_once '../config/dao.php';
									$dao = new Dao();
									$data = $dao->view('admin');
									$no = 1;
									foreach ($data as $value) {
										 $edit = "'".$value['id_user']."','".$value['nama']."','".$value['username']."','".$value['password']."'";
										 $delete = "'".$value['id_user']."','".$value['nama']."'";
										?>
										<tr>
											<td><?php echo $no;$no++; ?></td>
											<td><?php echo $value['nama'] ?></td>
											<td><?php echo $value['username'] ?></td>
											<td><?php echo $value['password'] ?></td>
											<td>
												<button type="button" onclick="edit(<?php echo $edit; ?>)" class="btn btn-info	 btn-sm"><i class="fa fa-edit"></i> Edit</button>
												<button type="button" onclick="hapus(<?php echo $delete; ?>);" class="btn btn-warning btn-sm"><i class="fa fa-trash"></i> Hapus</button>
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
					<form action="_crud_pengguna.php" method="POST">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Data Pengguna</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<center>Yakin hapus data pengguna ini?</center>
							<input type="hidden" name="id_user" id="id_user_del">
							<input type="hidden" name="aksi" id="aksi_del">
							<center><h3 id="nama_user" style="color: red;"></h3></center>
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
		$("#id_user").val('');
		$("#nama").val('');
		$("#username").val('');
		$("#password").val('');
		$("#aksi").val('simpan');
		$("#tombol").text('Simpan');
		$("#input-pengguna").show();
	}
	function edit(id,nm,user,pass){
		$("#id_user").val(id);
		$("#nama").val(nm);
		$("#username").val(user);
		$("#password").val(pass);
		$("#aksi").val('edit');
		$("#tombol").text('Edit');
		$("#input-pengguna").show();
	}
	function hapus(id,nm){
			$("#id_user_del").val(id);
			$("#nama_user").text(nm);
			$("#aksi_del").val('hapus');
			$("#modalDelete").modal("show")
		}
	function tutup(){
		$("#input-pengguna").hide();
	}
</script>
</html>