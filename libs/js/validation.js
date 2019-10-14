$(document).ready(function() {	
	$("#namaKelas").focusout(function(){
		if($("#namaKelas input").val() == ""){
			$('#tambahButton').prop('disabled', true);
			$("[data-toggle=popover]").popover('show');
			$("#namaKelas").addClass("has-error");
		}
	});
	
	$("#namaKelas").focusout(function(){
		if($("#namaKelas input").val() != ""){
			$("[data-toggle=popover]").popover('hide');
			$("#namaKelas").removeClass("has-error");
			$('#tambahButton').prop('disabled', false);
		}
	});
});
