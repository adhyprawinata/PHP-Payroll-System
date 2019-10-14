<?php
	include '../config/koneksi.php';
	
	$id_karyawan = $_GET['id'];
	
		$sql_data_karyawan = mysqli_query($k,"SELECT * FROM user where Id_User = '$id_karyawan'");
		$data_karyawan = mysqli_fetch_array($sql_data_karyawan);
?>
<div class="panel-body">
<div class="form-horizontal">
<div class="form-group"><label class="col-sm-3">
	ID Karyawan</label> <div class="col-sm-3">: <?php echo $data_karyawan['Id_User']; ?>
</div></div>
<div class="form-group"><label class="col-sm-3">
	Nama Karyawan</label> <div class="col-sm-3">: <?php echo $data_karyawan['Nama']; ?>
</div></div>
</div>
				<div class="table-responsive">
					<table class="table">
						<thead>
						<tr>
							<th>Tanggal</th>
							<th>Jam Masuk Tz1</th>
							<th>Jam Keluar Tz1</th>
							<th>Jam Masuk Tz2</th>
							<th>Jam Keluar Tz2</th>
							<th>Terlambat</th>
							<th>Pulang Awal</th>
							<th>Absen</th>
							<th>Lembur</th>
						</tr>
						</thead>
	
			<?php
							
							$query = "SELECT * FROM lap_absensi where id_karyawan ='$id_karyawan'";
							$hasil = mysqli_query($k, $query);
							while ($b = mysqli_fetch_assoc($hasil)){
							?>	
							<tbody>
								<tr>
									<td> 
										<?php echo $b['tanggal']; ?>
									</td>
									<td>
										<?php echo $b['datang_timezone_1'];?>
									</td>
									<td>
										<?php echo $b['pulang_timezone_1'];?>
									</td>
									<td>
										<?php echo $b['datang_timezone_2'] ?>
									</td>
									<td>
										<?php echo $b['pulang_timezone_2'] ?>
									</td>
									<td>
										<?php echo $b['terlambat'];?>
									</td>
									<td>
										<?php echo $b['pulang_awal'];?>
									</td>
									<td>
										<?php echo $b['absen'];?>
									</td>
									<td>
										<?php echo $b['lembur'];?>
									</td>								
								</tr>
						<?php
								
							}
						?>
							</tbody>
					</table>
				</div>
				<a class='btn btn-danger' onclick='javascript:history.back()'>Kembali</a>
			</div> 