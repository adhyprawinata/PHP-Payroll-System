<script>
function myFunction(val) {
     window.location.replace("?modul=salary&bulan="+val);
}
</script>
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
				<?php
				$string_bulan = array(" ","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
					$bulan_sekarang = date("n");
					$tahun_sekarang = date("Y");
					$bulan_tahun = $string_bulan[$bulan_sekarang]."_".$tahun_sekarang;
					
					
					if(isset($_GET['bulan'])){
						$bulan = $_GET['bulan'];
						$pisah_bulan = explode("_",$bulan);
						
					}
					
				?>
				<!-- filter bulan -->
				<div>
				
					<div style="width:200px;">
					<select name="bulan" style="float:left;" onchange="myFunction(this.value)" class="form-control"> 
						<option value="<?php
							echo "$string_bulan[$bulan_sekarang]"."_$tahun_sekarang";?> "><?php echo "$string_bulan[$bulan_sekarang], "."$tahun_sekarang"; ?>
						</option>
						<?php
							$query_data_bulan = mysqli_query($k,"SELECT DISTINCT bulan_tahun from salary order by bulan_tahun DESC");
							while($data_bulan = mysqli_fetch_assoc($query_data_bulan)){
								
								if($data_bulan['bulan_tahun'] == $bulan_tahun){
									continue;
								}else {
									$pisah_bulan_tahun = explode("_",$data_bulan['bulan_tahun']);
									if(isset($_GET['bulan'])){
										if($bulan == $data_bulan['bulan_tahun']){
											echo "<option value='$data_bulan[bulan_tahun]' selected>$pisah_bulan_tahun[0], $pisah_bulan_tahun[1]</option>";
										}else{
											echo "<option value='$data_bulan[bulan_tahun]'>$pisah_bulan_tahun[0], $pisah_bulan_tahun[1]</option>";
										}
									}else{
										echo "<option value='$data_bulan[bulan_tahun]'>$pisah_bulan_tahun[0], $pisah_bulan_tahun[1]</option>";
									}
								}
							}
						?>		
					</select>
					</div>
					
				</div>
				<div style="clear:both;content:'';display:block;">
				</div>
					<table class="table table-striped">
						<thead>
						<tr>
							<th>ID Karyawan</th>
							<th>Nama</th>
							<th>Jabatan</th>
							<th>Salary</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
						</thead>
						
					
						<tbody>
			<?php
							$i=1;
							if(isset($_GET['bulan'])){
								$query = "SELECT * FROM salary WHERE level ='1' AND bulan_tahun = '$bulan'";
							}else{
								$query = "SELECT * FROM salary WHERE level ='1' AND bulan_tahun = '$bulan_tahun'";
							}
							$hasil = mysqli_query($k, $query);
							while ($b = mysqli_fetch_assoc($hasil)){
								$query2 = mysqli_query($k,"SELECT * FROM user where Id_User = '".$b['id_user']."'");
								$data_karyawan =  mysqli_fetch_assoc($query2);
							?>	
							
								<tr>
									<td> 
										<?php echo $b['id_user']; ?>
									</td>
									<td>
										<?php echo $data_karyawan['Nama'];?>
									</td>
									<td>
										<?php echo $data_karyawan['Jabatan'];?>
									</td>
									<td>
										<?php echo $b['nett_salary'] ?>
									</td>
									<td>
										<?php echo $b['status'] ?>
									</td>
									<td><a href="?modul=salary&act=detailSalary&id=<?php echo $b['id_salary']; ?>">Detail</a></td>
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
	break;
		case "detailSalary" :
			include 'detailSalary.php';
		break;
		
		case "detailInputSalary" :
			include 'detailInputSalary.php';
		break;
		
		case "inputSalary" :
			include 'inputSalary.php';
		break;
	}
?>

