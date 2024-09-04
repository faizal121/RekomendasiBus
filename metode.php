<!DOCTYPE html>
<html>
<?php include_once 'layout/head.php'; ?>
<?php 
include_once '../metode/wp.php'; 
$wp = new Wp();
?>
<body>
	<?php include_once 'layout/sidebar.php'; ?>
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header card-header-primary">
							<h4 class="card-title"><strong>Data Metode</strong></h4>
						</div>
						<div class="card-body">
							<!-- Data Bus -->
							<h3>Data Bus</h3>
							<table class="table table-striped table-bordered">
								<thead style="background-color: purple; color:white">
									<th>No</th>
									<th>Nama Bus</th>
									<th>Harga</th>
									<th>Kapasitas (cc)</th>
									<th>Power Maks</th>
									<th>Torsi Maks</th>
									<th>Tanki</th>
								</thead>
								<tbody>
									<?php
									$result = $wp->getData();
									$i = 1; 
									foreach ($result as $value) {
										?>
										<tr>
											<td><?php echo $i; $i++; ?></td>
											<td><?php echo $value['nama_bus'] ?></td>
											<td><?php echo $value['harga'] ?></td>
											<td><?php echo $value['kapasitas_cc'] ?></td>
											<td><?php echo $value['daya_maks'] ?></td>
											<td><?php echo $value['torsi_maks'] ?></td>
											<td><?php echo $value['tanki'] ?></td>
										</tr>
										<?php
									}
									?>
								</tbody>
							</table>
							<!-- Data Kriteria -->
							<br><br>
							<h3>Data Kriteria</h3>
							<table class="table table-striped table-bordered">
								<thead style="background-color: purple; color:white">
									<th>No</th>
									<th>Nama Kriteria</th>
									<th>Jenis</th>
									<th>Bobot</th>
									<th>Keterangan</th>
								</thead>
								<tbody>
									<?php
									$wp->setKriteria(null);
									$result = $wp->getKriteria();
									$i = 1; 
									foreach ($result as $value) {
										?>
										<tr>
											<td><?php echo $i; $i++; ?></td>
											<td><?php echo $value['nama_kriteria'] ?></td>
											<td><?php echo $value['jenis'] ?></td>
											<td><?php echo $value['bobot'] ?></td>
											<td><?php echo $wp->getKeterangan($value['bobot']) ?></td>
										</tr>
										<?php
									}
									?>
								</tbody>
							</table>
							<!-- Normalisasi Data Kriteria -->
							<br><br>
							<h3>Normalisasi Data Kriteria</h3>
							<table class="table table-striped table-bordered">
								<thead style="background-color: purple; color:white">
									<th>No</th>
									<th>Nama Kriteria</th>
									<th>Jenis</th>
									<th>Bobot</th>
								</thead>
								<tbody>
									<?php
									$result = $wp->normalisasiKriteria();
									$i = 1; 
									foreach ($result as $value) {
										?>
										<tr>
											<td><?php echo $i; $i++; ?></td>
											<td><?php echo $value['nama_kriteria'] ?></td>
											<td><?php echo $value['jenis'] ?></td>
											<td><?php echo round($value['bobot'],2) ?></td>
										</tr>
										<?php
									}
									?>
								</tbody>
							</table>
							<!-- Vektor S -->
							<br><br>
							<h3>Vektor S</h3>
							<table class="table table-striped table-bordered">
								<thead style="background-color: purple; color:white">
									<th>No</th>
									<th>Nama Bus</th>
									<th>Harga (S1)</th>
									<th>Kapasitas (S2)</th>
									<th>Power Maks (S3)</th>
									<th>Torsi Maks (S4)</th>
									<th>Tanki (S5)</th>
									<th>&Sigma;S (S1*...S5)</th>
								</thead>
								<tbody>
									<?php
									$result = $wp->vektorS();
									for ($i=0; $i < count($result) ; $i++) {
											echo '<tr><td>'.($i+1).'</td>';
											for ($j=1; $j < 8 ; $j++) {
												if ($j == 1) {
													echo '<td>'.$result[$i][$j].'</td>';
												} else {
													echo '<td>'.round($result[$i][$j],8).'</td>';
												}
											}
										echo '</tr>';
									}
									?>
								</tbody>
							</table>
							<!-- Velktor V -->
							<br><br>
							<h3>Vektor V (Ranking)</h3>
							<table class="table table-striped table-bordered">
								<thead style="background-color: purple; color:white">
									<th>Rangking</th>
									<th>Nama Bus</th>
									<th>Vektor V ()</th>
								</thead>
								<tbody>
									<?php
									$result = $wp->rangking();
									for ($i=0; $i < count($result) ; $i++) {
											echo '<tr><td>'.($i+1).'</td>';
											for ($j=1; $j < 3 ; $j++) {
												if ($j == 1) {
													echo '<td>'.$result[$i][$j].'</td>';
												} else {
													echo '<td>'.round($result[$i][$j],8).'</td>';
												}
											}
										echo '</tr>';
									}
									?>
								</tbody>
							</table>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include_once 'layout/footer.php'; ?>
</body>
<?php include_once 'layout/js.php'; ?>
</html>