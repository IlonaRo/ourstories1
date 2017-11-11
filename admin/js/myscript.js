/***
	file: admin/js/myscript.js/myscript
	desc: jQuery handling the upload of imagefile

***/
$(document).ready(function(){
	//when html document is loaded and ready in browser
	$("#saveimgbtn").click(function(){
		var textmsg='';
		$("#showimg").html('Loading imagefile...');
		$("#imgdata").html('');
		var file_data=$("#imgfile").prop("files")[0];
		var form_data=new FormData();
		form_data.append("imgfile",file_data);
		form_data.append("userID",$("#userID").val());
		$.ajax({
			url: "saveimgfile.php",
			dataType: 'html',
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			type: 'post'
		})
		.done(function(data){
			if(data!='error'){
				textmsg='<p>Image uploaded successfully!</p>';
				$("#showimg").html(textmsg);
				$("#imgdata").html('<p><img src="./images/'+data+'" class="media-object" style="width:200px" /></p>');
			}
		});
		
	});
	//remove image button clicked
	$("#removeimgbtn").click(function(){
		$("#imgdata").html('');
		$("#showimg").html('');
		$.post("removeimg.php",{
			userID: $("#userID").val()
		},function(data){
			if(data=='OK'){
				$("#imgdata").html('<p>Imagefile removed</p>');
			}
		});
	});
});















