<link rel="stylesheet" type="text/css" media="all" href="../libs/js/datepick/jsDatePick_ltr.min.css" />

	<script type="text/javascript" src="../libs/js/datepick/jsDatePick.min.1.3.js"></script>

	<script type="text/javascript">
		window.onload = function(){
			new JsDatePick({
				useMode:2,
				target:"datepicker",
				dateFormat:"%Y-%m-%d",
				
			});
			new JsDatePick({
				useMode:2,
				target:"datepicker2",
				dateFormat:"%Y-%m-%d",
				
			});
		};
		
	</script>     