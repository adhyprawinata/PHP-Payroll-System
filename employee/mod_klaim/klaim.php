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
			<div><strong>Batas Klaim: 5.000.000</strong></div>
			<br/>
				<div class="table-responsive">
				<div>
						<form action="?modul=karyawanKlaim&act=inputKlaim" method="POST">
							<input type="submit" value="Tambah Klaim" class="btn btn-primary">
						</form>
					</div>
					<table class="table table-striped">
						<thead>
						<tr>
							<th>Tanggal</th>
							<th>Tipe Klaim</th>
							<th>Nominal Klaim</th>
							<th>Status</th>
							<th>Aksi</th>
						</tr>
						</thead>
						<tbody>
			<?php	
							
							$query = "SELECT * FROM klaim where id_karyawan = '$id_karyawan'";
							$hasil = mysqli_query($k, $query);
							while ($b = mysqli_fetch_assoc($hasil)){
								$query2 = mysqli_query($k,"SELECT * FROM user where Id_User = '".$b['id_karyawan']."'");
								$data_karyawan =  mysqli_fetch_assoc($query2);
							?>	
							
								<tr>
									<td>
										<?php echo $b['tanggal'];?>
									</td>
									<td>
										<?php echo $b['tipe'] ?>
									</td>
									<td>
										2.500.000
									</td>
									<td>
										<?php echo $b['status'] ?>
									</td>
									<td><a href="?modul=karyawanKlaim&act=detailKlaim&id=<?php echo $b['id']; ?>">Detail</a></td>
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
		case "inputKlaim" :
			include 'inputKlaim.php';
		break;
		
		case "detailKlaim" :
			include 'detailKlaim.php';
		break;
		
	}
?>

