/**
	file:	login.js
	desc:	Handles the login communication between loginform and
			login.php
**/
$(document).ready(function(){
	$("#formsignin").submit(function(){
		var msg;
		$("#logininfo").html('<p class="alert alert-info"> Checking login...</p>');
		$.post("login.php",{
			email: $("#email").val(),
			password:$("#password").val()
		},function(data){
			//parse the JSON-data to variable
			var status=JSON.parse(data,function(key,value){
				return value;
			});
			$("#logininfo").html('');
			if(status.Status=='OK'){
				//Tell that login ok and redirect to adminsite
				msg='<p class="alert alert-success">Login ok</p>';
				$("#logininfo").html(msg);
				var url="./admin/index.php";
				setTimeout(function(){
					$(location).attr("href",url);
				},2000); //2000ms = 2 seconds
			}else{
				$("#logininfo").html('<p class="alert alert-danger">'+status.Status+'</p>');
				$("#email").val('');
				$("#password").val('');
				setTimeout(function(){
					$("#logininfo").html('');
				},2000); //2000ms = 2 seconds
			}
		});
		return false; //no reload on the page
	});
});