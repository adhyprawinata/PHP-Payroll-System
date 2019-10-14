<?php

	if(isset($_GET['action'])){
		$act = $_GET['action'];
	}else{
		$act="";
	}
require_once("../config/koneksi.php");
	switch($act){
	default:?>
		<div class="panel panel-default">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>No</th>
									<th>Appliances</th>
									<th>Jabatan</th>
									<th>Status</th>	
								</tr>
							</thead>
							
							<?php
							$i=1;
							$query = "SELECT * FROM appliance WHERE isSubmit = 'true' ORDER BY Id_Appliance";
							$hasil = mysqli_query($k, $query);
							while ($b = mysqli_fetch_assoc($hasil)){
								$idUser = $b['Id_User'];
								$query2 = "SELECT * FROM user WHERE Id_User = $idUser";
								$data_karyawan2 = mysqli_query($k, $query2);
								$data_karyawan = mysqli_fetch_assoc($data_karyawan2);
							?>	
							<tbody>
								<tr>
									
									<td> 
										<?php echo $i; ?>
									</td>
									<td>
										<?php echo $data_karyawan['Nama']." - ".$b['Tipe'];?>
									</td>
									<td>
										<?php echo $data_karyawan['Jabatan'];?>
									</td>
									<td>
										<?php echo $b['Status']; ?>
									</td>
									<td>Edit | Confirm</td>
									
								</tr>
						<?php
								$i++;
							}
						?>
							</tbody>
						</table>
					</div>
		</div>
<?php
	case "keteranganAppliance" :
		//include keteranganAppliance.php
	break;
	
	
	}
?>

