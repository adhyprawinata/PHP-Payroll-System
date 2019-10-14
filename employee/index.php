<?php
session_start();
/*
	Dummy data
*/
	
/*
	Dummy data
*/

if(isset($_SESSION['login']) && $_SESSION['login'] == true){
	?>
	<?php
	date_default_timezone_set('Asia/Jakarta');
	require_once("../config/koneksi.php");
	$sql ="SELECT * FROM user WHERE Id_User=$_SESSION[id_karyawan]";
	$hasil2 = mysqli_query($k, $sql);
	$data_user = mysqli_fetch_assoc($hasil2);
	header("Set-Cookie:name=value;httpOnly");
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistem Penggajian</title>
<?php
		include '../readNotifikasi.php';
	?>
    <!-- Bootstrap Core CSS -->
    <link href="../libs/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../libs/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../libs/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../libs/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
	<style type="text/css">
		#accordion{
			
		}
		#accordion h2{
			cursor: pointer;
			font-size: 14px;
			background: -webkit-linear-gradient(bottom, #eee, #fff) !important;
			padding: 5px 10px;
			margin: 0;
			border-bottom: 1px solid #fff;
			font-weight:bold;
			color: #777;
		}
		
		#accordion h2.active{
			background: -webkit-linear-gradient(bottom, #eee, #fff);
		}
		
		.icon-navigasi img{
				width: 30px;
				height: 30px;
				padding-right:3px;
		}
		
	</style>
	<script type="text/javascript" src="../libs/js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#accordion .isi').hide();
			$('#accordion h2').addClass('active').next().slideDown(300);
			$('#accordion h2').click(function(){			
				if($(this).hasClass('active')){
					$(this).removeClass('active').next().slideUp(300);
				}else{
					$(this).addClass('active').next().slideDown(300);
				}
			});
		});
	</script>
	<script src="../myScript.js"></script>
	<script>

	function cek(){ 
	    $.ajax({ 
	        url: "../cekNotifikasi.php", 
	        cache: false, 
	        success: function(data){ 
	            $("#cekNotif").html(data); 
	        } 
	    }); 
	    
	}
	function notif(){
		$.ajax({ 
	        url: "../getNotifikasi.php", 
	        cache: false, 
	        success: function(msg){ 
	            $("#notifikasi").html(msg); 
	        } 
	    }); 
	}
	var waktu = setInterval("cek()",3000); 

</script>	
<?php

	$id_karyawan = $_SESSION['id_karyawan']; 
	$sql_notifikasi1 = mysqli_query($k,"SELECT * FROM notifikasi WHERE id_penerima = '$id_karyawan' AND isRead = 'n'");


?>
</head>
<body>
<!-- ================================== HEADER ============================================= -->
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><b>Sistem Penggajian - Staff</b></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
				<?php echo "Selamat siang, Pak/Bu ".$data_user['Nama'];?>
                
                <!-- /.dropdown -->
                 <li class="dropdown" onclick="notif()">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i> 
							<i id="cekNotif"><?php echo mysqli_num_rows($sql_notifikasi1); ?></i>
	
                    </a>
                    <ul id="notifikasi" class="dropdown-menu dropdown-user">
                       	
                    </ul>
                    <!-- /.dropdown-notifikasi -->
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="?modul=profile&id=<?php echo $id_karyawan;?>"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="../controller/doLogout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
			
<!-- ====================================== END OF HEADER ============================================ -->	
		
<!-- ====================================== SIDEBAR ============================================ -->
<div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
									<a href="?modul=karyawanAbsensi"><span class="icon-navigasi"><img src="../libs/images/icon-absensi.png" class=""/></span> Absensi</a>
								</li>
								<li>
									<a href="?modul=karyawanLibur"><span class="icon-navigasi"><img src="../libs/images/icon-libur.png" class=""/></span> Libur</a>
								</li>
								<li>
									<a href="?modul=karyawanCuti"><span class="icon-navigasi"><img src="../libs/images/icon-cuti.png" class=""/></span> Cuti</a>
								</li>
								<li>
									<a href="?modul=karyawanLembur"><span class="icon-navigasi"><img src="../libs/images/icon-lembur.png" class=""/></span> Lembur</a>
								</li>
								<li>
									<a href="?modul=karyawanSalary"><span class="icon-navigasi"><img src="../libs/images/icon-salary.png" class=""/></span> Salary</a>
								</li>
								<li>
								<a href="#"><span class="icon-navigasi"><img src="../libs/images/icon-loan.png" class=""/></span><span class="fa arrow" style="top:11px;position:relative;"></span>Pinjaman</a>
									<ul class="nav nav-second-level collapse" aria-expanded="false">
										<li><a href="?modul=karyawanPinjaman">Pinjaman</a></li>
										<li><a href="?modul=karyawanCicilan">Cicilan</a></li>
									</ul>
								</li>
								<li>
									<a href="?modul=karyawanKlaim"><span class="icon-navigasi"><img src="../libs/images/icon-klaim.png" class=""/></span> Klaim</a>
								</li>								
								<li>
									<a href="?modul=karyawanKenaikkan"><span class="icon-navigasi"><img src="../libs/images/icon-kenaikkan.png" class=""/></span>Kenaikkan </a>
								</li>			
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
<!-- ====================================== END OF SIDEBAR ============================================ -->
            <!-- /.navbar-static-side -->
        </nav>
	<?php
	
	
	
	
	if(isset($_GET['modul'])){
		$modul = $_GET['modul'];
	}else{
		$modul="";
	}
?>
 <!-- PAGE CONTENT -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                     <div class="col-lg-12">
                        <h1 class="page-header"><?php 
							if($modul != ""){
								if($modul == "kenaikkan"){
									$judul = "Kenaikkan Gaji";
								}elseif($modul == "pinjaman"){
									$judul = "Pinjaman";
								}elseif($modul == "absensi"){
									$judul = "Absensi";
								}elseif($modul == "libur"){
									$judul = "Libur";
								}elseif($modul == "cuti"){
									$judul = "Cuti";
								}elseif($modul == "lembur"){
									$judul = "Lembur";
								}elseif($modul == "salary"){
									$judul = "Salary";
								}elseif($modul == "klaim"){
									$judul = "Klaim";
								}elseif($modul == "user"){
									$judul = "User";
								}elseif($modul == "penilaian"){
									$judul = "Penilaian";
								}elseif($modul == "karyawanPinjaman"){
									$judul = "Pinjaman - Karyawan";
								}elseif($modul == "karyawanKenaikkan"){
									$judul = "Kenaikkan Gaji - Karyawan";
								}elseif($modul == "karyawanKlaim"){
									$judul = "Klaim - Karyawan";
								}elseif($modul == "karyawanCuti"){
									$judul = "Cuti - Karyawan";
								}elseif($modul == "karyawanSalary"){
									$judul = "Salary - Karyawan";
								}elseif($modul == "karyawanLembur"){
									$judul = "Lembur - Karyawan";
								}elseif($modul == "karyawanLibur"){
									$judul = "Libur - Karyawan";
								}elseif($modul == "karyawanAbsensi"){
									$judul = "Absensi - Karyawan";
								}elseif($modul == "notifikasi"){
									$judul = "Notifikasi";
								}elseif($modul == "profile"){
									$judul = "User Profile";
								}elseif($modul == "karyawanCicilan"){
									$judul = "Cicilan Pinjaman";
								}
								
							}else{
								$judul = "Dashboard";
								$modul = "dashboard";
							}
							echo $judul;
						?></h1>
                    </div>
				</div>
                    <!-- /.col-lg-12 -->
					<div class="row">
					                     
                       
						
						<!-- panel body -->		
						<div class="panel-body">
						<div>
							<?php
								if(isset($_SESSION['message'])){
									if($_SESSION['message'] != ""){
										if($_SESSION['stat'] == "sukses"){
											echo "<div class='alert alert-success'>$_SESSION[message]</div>";
											$_SESSION['message'] = "";
											$_SESSION['stat'] = "";
										}else{
											echo "<div class='alert alert-danger'>$_SESSION[message]</div>";
											$_SESSION['message'] = "";
											$_SESSION['stat'] = "";
										}
									}
								}
							?>
						</div>
<?php

switch($modul){
	default:
	include "../dashboard.php";
	?>
		
                <!-- dasboard -->       			
<?php	
	break;
	case "profile" :
		include "mod_profile/profile.php";
	break;
	case "karyawanAbsensi" :
		include "mod_absensi/absensi.php";
	break;
	case "karyawanKlaim" :
		include "mod_klaim/klaim.php";
	break;
	case "karyawanPinjaman" :
		include "mod_pinjaman/pinjaman.php";
	break;
	case "karyawanSalary" :
		include "mod_salary/salary.php";
	break;
	case "karyawanKenaikkan" :
		include "mod_kenaikkan/kenaikkan.php";
	break;
	case "karyawanCuti" :
		include "mod_cuti/Cuti.php";
	break;
	case "karyawanLembur" :
		include "mod_lembur/Lembur.php";
	break;
	case "karyawanLibur" :
		include "mod_libur/libur.php";
	break;
	case "notifikasi" :
		include "../notifikasi.php";
	break;
	case "karyawanCicilan" :
		include "mod_cicilan/cicilan.php";
	break;
	
}

?>
                        </div>
                        <!-- /.panel-body -->
						
                    </div>
                    <!-- /.panel -->
                
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

			</div>
 

    <!-- Bootstrap Core JavaScript -->
    <script src="../libs/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../libs/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../libs/dist/js/sb-admin-2.js"></script>
	<script src="../libs/js/jquery.form.js"></script>
	<script src="../libs/js/script.js"></script>
		<div class="navbar-header" style="width:100%">
            <h1 style="font-size: 16px; text-align: center;"><i>&copy; Sistem Penggajian - 2016</i> </h1>
        </div>
</body>

</html>
<?php
}
else{
	header("Location:../index.php");
}
?>