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
              <?php 
              include_once '../config/dao.php';
              $dao = new Dao();
              $result = $dao->detail($_GET['id']);
              ?>
              <!-- Page Content -->
              <div class="container">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12 mt-3 mb-3">
                      <img style="width: 1200px;height: 450px;" src="http://localhost/bus_new/assets/img/bus/<?php echo $result['foto'] ?>" class="d-block img-fluid">
                    </div>
                  </div><br><br>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="card">
                        <div class="card-header"><h5><strong>Deskripsi Produk <span style="color: red"><?php echo $result['nama_bus'] ?></span></strong></h5></div>
                        <div class="card-body">
                          <div class="card-body" style="background-color: #DEB887; color: black;"><h3><strong><?php echo $dao->rupiah($result['harga']); ?></strong></h3></div><br>
                          <p style="text-align: justify;"><?php echo $result['deskripsi']; ?></p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <br>
                      <div class="card">
                        <div class="card-header"><h5><strong>Spesifikasi <span style="color: red"><?php echo $result['nama_bus'] ?></span></strong></h5></div>
                        <div class="card-body">
                          <div class="col-md-12">

                            <table class="table table-striped table-bordered">
                              <tr>
                                <td style="background-color: #DEB887" colspan="2"><strong>MESIN</strong></td>
                              </tr>
                              <tr>
                                <td>Kapasitas (CC)</td>
                                <td width="500px"><?php echo $result['kapasitas_cc'] ?> cc</td>
                              </tr>
                              <tr>
                                <td>Daya Maksimum</td>
                                <td><?php echo $result['daya_maks'] ?> rpm</td>
                              </tr>
                              <tr>
                                <td>Torsi Maksimum</td>
                                <td><?php echo $result['torsi_maks'] ?> rpm</td>
                              </tr>
                              <tr>
                                <td>Tanki</td>
                                <td><?php echo $result['tanki'] ?> lt</td>
                              </tr>
                              <tr>
                                <td>Sistem Bahan Bakar</td>
                                <td><?php echo $result['injeksi'] ?></td>
                              </tr>
                              <tr>
                                <td>Berat</td>
                                <td><?php echo $result['berat'] ?></td>
                              </tr>
                              <tr>
                                <td style="background-color: #DEB887" colspan="2"><strong>SUSPENSI</strong></td>
                              </tr>
                              <tr>
                                <td>Suspensi Belakang</td>
                                <td><?php echo $result['suspensi_blk'] ?></td>
                              </tr>
                              <tr>
                                <td>Suspensi Depan</td>
                                <td><?php echo $result['suspensi_dpn'] ?></td>
                              </tr>
                              <tr>
                                <td style="background-color: #DEB887" colspan="2"><strong>TRANSMISI</strong></td>
                              </tr>
                              <tr>
                                <td>Transmisi</td>
                                <td><?php echo $result['transmisi'] ?></td>
                              </tr>
                              <tr>
                                <td style="background-color: #DEB887" colspan="2"><strong>REM</strong></td>
                              </tr>
                              <tr>
                                <td>Rem</td>
                                <td><?php echo $result['rem'] ?></td>
                              </tr>
                              <tr>
                                <td style="background-color: #DEB887" colspan="2"><strong>KOPLNG</strong></td>
                              </tr>
                              <tr>
                                <td>Tipe Kopilng</td>
                                <td><?php echo $result['kopling'] ?></td>
                              </tr>
                              <tr>
                                <td>Kopling Diameter</td>
                                <td><?php echo $result['kopling_di'] ?></td>
                              </tr>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div>
      <a style="margin-right: 30px" href="bus.php" class="btn btn-danger" ><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Kembali</a>
    </div>
  </div>

  <?php include_once 'layout/footer.php'; ?>
</body>
</html>
