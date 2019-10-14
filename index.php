<!DOCTYPE html>
<?php
	session_start();
	$_SESSION['first'] = null;
	$_SESSION['role'] = null;
	$_SESSION['user'] = null;
	$_SESSION['login'] = false;
	
	require_once("config/koneksi.php");
	if(isset($_GET['action'])){
		$action = $_GET['action'];
	}else{
		$action = "masuk";
	}
?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	
    <title>CV.Maiga - Account</title>
	<!--datepicker-->
	<link rel="stylesheet" type="text/css" media="all" href="../libs/js/datepick/jsDatePick_ltr.min.css" />

	<script type="text/javascript" src="../libs/js/datepick/jsDatePick.min.1.3.js"></script>

	<script type="text/javascript">
		window.onload = function(){
			new JsDatePick({
				useMode:2,
				target:"inputField",
				dateFormat:"%Y-%m-%d",
				limitToToday:true
			});
		};
	</script>
	
    <!-- Bootstrap Core CSS -->
    <link href="libs/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="libs/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="libs/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="libs/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
						<?php 
							echo "Silahkan Masuk";
						?>
						</h3>
                    </div>
                    <div class="panel-body">
						<span id="pesan"></span> 
									
                        <form id="" action="controller/doLogin.php?action=masuk" method="post" role="form">
                            <fieldset>							
								<div class="form-group">
									<label>E-mail</label>
                                    <input class="form-control" type="email" name="username" required title="Username required" placeholder="Email">									
                                </div>
                                <div class="form-group">
									<label>Password</label></br>
                                    <input class="form-control" type="password" name="password" required title="Password required" placeholder="Password">									
								</div> 
								<div style="align:right;padding-bottom:5px;"><a>Forgot your password?</a></div>
                                <input type="submit" class="" name="submit" value="Log In" />								
								
								</fieldset>
                        </form>
						
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="libs//bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="libs/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="libs/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="libs/dist/js/sb-admin-2.js"></script>
	
	<script src="libs/js/jquery.form.js"></script>
	<script src="libs/js/loginscript.js"></script>

</body>

</html>
