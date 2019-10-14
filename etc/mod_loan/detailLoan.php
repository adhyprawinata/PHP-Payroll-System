<?php 
$query = "SELECT * FROM loan";
$hasil = mysqli_query($k, $query);
$b = mysqli_fetch_assoc($hasil)
?>
Nama :
Jabatan :
Cabang :
Jumlah Pinjaman : <?php echo $b['jml_pinjam']; ?>
<div class="panel panel-default">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>							
									<th>Bulan</th>
									<th>Pembayaran</th>
								</tr>
							</thead>
							
							<?php
							$total_cicilan =0;
							$query = "SELECT * FROM detail_loan";
							$hasil = mysqli_query($k, $query);
							while ($b = mysqli_fetch_assoc($hasil)){								
							?>	
							<tbody>
								<tr>
									<td> 
										<?php echo $b['bulan']; ?>
									</td>
									<td>
										<?php 
											echo $b['nominal'];
											$total cicilan += $b['nominal'];
										?>
									</td>
									
								</tr>
						<?php
								
							}
						?>
						<tr>
							<td>Total</td>
							<td></td>
						</tr>
							</tbody>
						</table>
					</div>
		</div>
Sisa Pinjaman : <?php echo $b['sisa_pinjaman']; ?>