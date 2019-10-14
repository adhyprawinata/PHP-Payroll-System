<?php
	session_start();
	require_once("../config/koneksi.php");
	
	$action = $_GET['action'];	
	
if(isset($_POST['submit'])){
		if($action=="masuk"){	//untuk login
			$user = mysql_real_escape_string($_POST['username']);
			$pass = addslashes(trim($_POST['password']));
			$sql = "SELECT * FROM user WHERE email = '$user' AND password = '$pass'";
			$hasil = mysqli_query($k, $sql);
			
			$data = mysqli_fetch_array($hasil);
			if(mysqli_num_rows($hasil) > 0){
				$_SESSION['login'] = true;
				$_SESSION['user'] = $data['Nama'];
				$_SESSION['id_karyawan'] = $data['Id_User'];
				$stat = "";
				$_SESSION['stat'] = "";
				$_SESSION['message'] = $stat;
				if($data['Level'] == 2){ //Kepala Cabang
					header("Location: ../manager/index.php");	
				}else if($data['Level'] == 1){ //Level Manager
					header("Location: ../manager/index.php");	
				}else if($data['Level'] == 3){ //Level Kepala Divisi				
					header("Location: ../kadiv/index.php");		
				}else if($data['Level'] == 4){ // Level Staff
					if($data['id_divisi'] == 2){ // Divisi HRD
						header("Location: ../hrd/index.php");
					}elseif($data['id_divisi'] == 3){ // Divisi Finance
						header("Location: ../payroll/index.php");
					}else{
						header("Location: ../employee/index.php"); // Divisi Lainnya
					}
	
				}
			}else{
				$stat = "Gagal memasukkan ke database!";
				$_SESSION['stat'] = "gagal";
				$_SESSION['message'] = $stat;
				header("Location: ../index.php");
			}
			
		}
			
		else {
				if($email != "" && $tanggalL != ""){ //cek field yang kosong
					if($_SESSION['captcha']==$_POST['captcha']){ //jika captcha sesuai
						$captcha = $_POST['captcha'];
						$ex = explode("-",$tanggalL);
						$password = $ex[2].$ex[1].substr($ex[0],2,2); //password login ddmmyy
						$encrypted_pass	= password_hash($password, PASSWORD_BCRYPT); //encrypt password
						$sql = "SELECT emailUser, tglLahirUser FROM user WHERE emailUser='$email' and tglLahirUser='$tanggalL'";
						$hasil = mysqli_query($k, $sql);
						if(mysqli_num_rows($hasil)){ //sukses , password update
							$sql= "UPDATE user SET passwordUser = '$encrypted_pass'";
							mysqli_query($k, $sql);
							echo "3";
						}else{
							echo "4";			
						}
					}else{		//ajax captcha salah		
						echo "2";			
					}
				}else{
					echo "1";
				}
	}
		
}

?>