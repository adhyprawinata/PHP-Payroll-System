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
						<form action="?modul=karyawanPinjaman&act=inputPinjaman" method="POST">
							<input type="submit" value="Tambah Pinjaman" class="btn btn-primary">
						</form>
					</div>
					<table class="table table-striped">
						<thead>
						<tr>
							<th>ID Pinjaman</th>
							<th>Tanggal</th>
							<th>Nominal</th>
							<th>Pembayaran</th>
							<th>Kepentingan</th>
							<th>Status</th>
							<th>Aksi</th>
						</tr>
						</thead>
						<tbody>
			<?php
							
							$query = "SELECT * FROM pinjaman where id_karyawan = '$id_karyawan'";
							$hasil = mysqli_query($k, $query);
							while ($b = mysqli_fetch_assoc($hasil)){
								$query2 = mysqli_query($k,"SELECT * FROM user where Id_User = '".$b['id_karyawan']."'");
								$data_karyawan =  mysqli_fetch_assoc($query2);
							?>	
							
								<tr>
									<td>
										<?php echo $b['id'];?>
									</td>
									<td>
										<?php echo $b['tanggal'];?>
									</td>
									<td>
										<?php echo $b['jml_pinjam'] ?>
									</td>
									<td>
										<?php echo $b['status'] ?>
									</td>
									<td>
										<?php echo $b['kepentingan'] ?>
									</td>
									<td>
										<?php echo $b['status_request'] ?>
									</td>
									<td><a href="?modul=karyawanPinjaman&act=detailPinjaman&id=<?php echo $b['id']; ?>">Detail</a> | <a href="?modul=karyawanCicilan&act=inputCicilan&id=<?php echo $b['id'];?>">Tambah Cicilan</a></td>
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
		case "inputPinjaman" :
			include 'inputPinjaman.php';
		break;
		
		case "detailPinjaman" :
			include 'detailPinjaman.php';
		break;
		
		
	}
?>

