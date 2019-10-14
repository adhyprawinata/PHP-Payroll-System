<?php

	if(isset($_GET['act'])){
		$act = $_GET['act'];
	}else{
		$act="";
	}
	
require_once("../config/koneksi.php");
	switch($act){
		default:?>
		<div>
	<span class="alert alert-success">Berhasil Memasukkan Data User</span>
</div>
<br/>
				<div class="table-responsive">
				<div>
						<form action="?modul=user&act=inputUser" method="POST">
							<input type="submit" value="Tambah User" class="btn btn-primary">
						</form>
					</div>
					<div style="float:right">
						<form action="?modul=user&search=" method="get">
							<input type="text" placeholder="Search Here">
							<input type="submit" value="search">
						</form>
					</div>
					<table class="table">
						<thead>
						<tr>
							<th>ID User</th>
							<th>Email</th>
							<th>Tgl Lahir</th>
							<th>Nama</th>
							<th>Status</th>
							<th>Jabatan</th>
                            <th>Cabang</th>
                            <th colspan="2">Aksi</th>
						</tr>
						</thead>
	
			<?php
							$_SESSION['token'] = md5(uniqid());
							
							if(isset($_GET['search'])){
								$search = mysql_real_escape_string($_GET['search']);
								$query = "SELECT * FROM user WHERE Id_User = $search order by Id_User";
							}else{
								$query = "SELECT * FROM user order by Id_User";
							}
							
							$hasil = mysqli_query($k, $query);
							while ($data_user = mysqli_fetch_assoc($hasil)){
							
							?>	
							<tbody>
								<tr>
									<td> 
										<?php echo $data_user['Id_User']; ?>
									</td>
									<td>
										<?php echo $data_user['Email'];?>
									</td>
									<td>
										<?php echo $data_user['Tgl_Lahir'];?>
									</td>
									<td>
										<?php echo $data_user['Nama'];?>
									</td>
									<td>
										<?php echo $data_user['status'];?>
									</td>
                                     <td>
										<?php echo $data_user['Jabatan'];?>
									</td>
                                    <td>
										<?php echo $data_user['cabang'];?>
									</td>
                                    <td><a href="?modul=user&act=updateUser&id=<?php echo $data_user['Id_User']; ?>">Update</a></td>
                                     <td><a href="../controller/doDeleteUser.php?token=<?php echo $_SESSION['token']; ?>&id=<?php echo $data_user['Id_User']; ?>">Delete</a></td>
								</tr>
						<?php
								
							}
						?>
							</tbody>
					</table>
				</div>
			 
			
	<?php
	break;
		case "inputUser" :
			include 'inputUser.php';
		break;
		case "updateUser" :
			include 'updateUser.php';
		break;
		case "deleteUser" :
			include 'deleteUser.php';
		break;
	

	}
?>

