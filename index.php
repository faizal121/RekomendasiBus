<!DOCTYPE html>
<html>
<?php include_once 'layout/head.php'; ?>
<body>
  <?php include_once 'layout/sidebar.php'; 
  include_once '../config/dao.php';
  $dao = new Dao();
  $total = $dao->getDashboard();
  ?>

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-primary card-header-icon">
              <div class="card-icon">
                <i class="fa fa-bus"></i>
              </div>
              <p class="card-category">Data Bus</p>
              <span class="badge badge-primary" style="color: white; font-style: bold; font-size: 24px"><?= $total['bus'] ?> Unit</span>
              <h3 class="card-title">
              </h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <a href="bus">Tampil Data Bus</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="fa fa-list-ul"></i>
              </div>
              <p class="card-category">Kriteria</p>
              <span class="badge badge-success" style="color: white; font-style: bold; font-size: 24px"><?= $total['kriteria'] ?> Kriteria</
              <h3 class="card-title"></h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <a href="kriteria">Tampil Data Kriteria</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="fa fa-users"></i>
              </div>
              <p class="card-category">Pengguna</p>
              <span class="badge badge-danger" style="color: white; font-style: bold; font-size: 24px"><?= $total['pengguna'] ?> Orang</
              <h3 class="card-title"></h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <a href="pengguna">Tampil Data Pengguna</a>
              </div>
            </div>
          </div>
        </div>
        <!-- <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="fa fa-twitter"></i>
              </div>
              <p class="card-category">Followers</p>
              <h3 class="card-title">+245</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">update</i> Just Updated
              </div>
            </div>
          </div>
        </div> -->
      </div>
    </div>
    <?php include_once 'layout/footer.php'; ?>
  </body>
  <?php include_once 'layout/js.php'; ?>
  </html>
  