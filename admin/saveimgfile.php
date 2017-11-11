<?php
/*
	file:	saveimgfile.php
	desc:	Saves the image filename into db and file into folder /images.
			This script is called via AJAX from JavaScript.
	date:	3.10.2017
	auth:	Yrjö K
*/
if(empty($_FILES['imgfile']['name'])) echo "error";
else{
 $userID=$_POST['userID'];
 $imagefile=clean($_FILES['imgfile']['name']); //name of the file into variable and clean special characters
 $file_ext=strtolower(end(explode('.',$_FILES['imgfile']['name'])));
 $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
 $detectedType = exif_imagetype($_FILES['imgfile']['tmp_name']);
 $error = !in_array($detectedType, $allowedTypes);
 if(!$error){	 
		//path to the folder images
		$path=addslashes(dirname($_SERVER['DOCUMENT_ROOT']));
		$path.="/httpdocs/bit16/teamfour/admin/images/";
		$savedimg=clean($imagefile).time().'.'.$file_ext;
		if(move_uploaded_file($_FILES['imgfile']['tmp_name'],$path.$savedimg)){
			include("../db.php");
			$sql="UPDATE user SET image='$savedimg' WHERE userID=$userID";
			//check if updating db was successful
			if($conn->query($sql)===TRUE) echo "$savedimg";
			else echo "error";
		}
  }else echo "error"; 
}

function clean($string) {
   $string = str_replace(' ', '-', $string); // replace space with -.
   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // remove special characters.
}
?>