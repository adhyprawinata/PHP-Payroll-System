<?php

	if(isset($_GET['act'])){
		$act = $_GET['act'];
	}else{
		$act="";
	}
	$id_karyawan = $_SESSION['id_karyawan'];
require_once("../config/koneksi.php");
	switch($act){
		default:?>
			<div class="panel-body">
				<div class="table-responsive">
					<div>
						<form action="?modul=karyawanCuti&act=inputCuti" method="POST">
							<input type="submit" value="Tambah Cuti" class="btn btn-primary">
						</form>
					</div>
					<table class="table table-striped">
						<thead>
						<tr>
							<th>Tipe Cuti</th>
							<th>Tanggal Pengajuan</th>
							<th>Tanggal Diterima</th>
							<th>Kuota Terpakai</th>
							<th>Status</th>
							<th>Aksi</th>
						</tr>
						</thead>
						<tbody>
			<?php
							
							$query = "SELECT * FROM cuti where id_karyawan = '$id_karyawan'";
							$hasil = mysqli_query($k, $query);
							while ($b = mysqli_fetch_assoc($hasil)){
								$query2 = mysqli_query($k,"SELECT * FROM user where Id_User = '".$b['id_karyawan']."'");
								$data_karyawan =  mysqli_fetch_assoc($query2);
							?>	
							
								<tr>
									<td>
										<?php echo $b['tipe'];?>
									</td>
									<td>
										<?php 
											
										
										echo date('d M', strtotime($b['tanggal_mulai'])). " - ".date('d M, Y', strtotime($b['tanggal_selesai']))?>
									</td>
									<td>
										<?php 
										if($b['tanggal_mulai_diterima'] != "0000-00-00" && $b['tanggal_akhir_diterima'] != "0000-00-00"){
										echo date('d M', strtotime($b['tanggal_mulai_diterima'])). " - ".date('d M, Y', strtotime($b['tanggal_akhir_diterima'])); }else{
											echo "-";
										}
										?>
									</td>
									<td>
										<?php 
										if($b['kuota_terpakai']  !=0){
											echo $b['kuota_terpakai']; 
										}else {
											echo "-";
										}?>
									</td>
									
									<td>
										<?php echo $b['status'] ?>
									</td>
									<td><a href="?modul=karyawanCuti&act=detailCuti&id=<?php echo $b['id']; ?>">Detail</a></td>
								</tr>
						<?php
								
							}
						?>
							</tbody>
					</table>
				</div>
			</div> 
			
	<?php
	break;
		case "inputCuti" :
			include 'inputCuti.php';
		break;
		
		case "detailCuti" :
			include 'detailCuti.php';
		break;
		
	}
?>

