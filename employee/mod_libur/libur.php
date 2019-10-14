<?php

	if(isset($_GET['act'])){
		$act = $_GET['act'];
	}else{
		$act="";
	}
require_once("../config/koneksi.php");
	switch($act){
		default:?>
			<div class="panel-body">
				<div class="table-responsive">
			
					<table class="table table-striped">
						<thead>
						<tr>
							<th>Hari Libur</th>
						
							<th>Ulangi</th>
							<th>Tanggal Mulai Libur</th>
							<th>Durasi</th>
							<th>Tanggal Selesai Libur</th>
							
						</tr>
						</thead>
						<tbody>
			<?php
							
							$query = "SELECT * FROM libur";
							$hasil = mysqli_query($k, $query);
							while ($b = mysqli_fetch_assoc($hasil)){
								$pisah_tanggal = explode("-",$b['tanggal_mulai']);
								$tanggal_selesai = $pisah_tanggal[0]."-".$pisah_tanggal[1]."-".($pisah_tanggal[2]+$b['durasi']);
							?>	
							
								<tr>
									<td> 
										<?php echo $b['nama']; ?>
									</td>
									
									<td> 
										<?php echo $b['ulangi']; ?>
									</td>
									<td>
										<?php echo $b['tanggal_mulai'];?>
									</td>
									<td>
										<?php echo $b['durasi'];?>
									</td>
									<td>
										<?php echo $tanggal_selesai ?>
									</td>
									
								</tr>
						<?php
								
							}
						?>
							</tbody>
					</table>
				</div>
			</div> 
			<?php break; ?>
	<?php
		case "inputLibur" :
			include 'inputLibur.php';
		break;
		
		case "editLibur.php" :
			include 'detailLibur.php';
		break;
		
	}
?>

