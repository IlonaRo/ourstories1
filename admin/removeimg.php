<?php
/*
	file:	removeimg.php
	desc:	Gets the name of file and removes it from db and folder /images/.
*/
$userID=$_POST['userID'];
if(!empty($userID)){
	include('../db.php');
	$sql="SELECT image FROM user WHERE userID=$userID";
	$result=$conn->query($sql);
	if($row=$result->fetch_assoc()){
		$path=addslashes(dirname($_SERVER['DOCUMENT_ROOT']));
		$path.="/httpdocs/bit16/teamfour/admin/images/";
		$imgfile=$row['image'];
		unlink($path.$imgfile);  //removes the file from server
		$sql="UPDATE user SET image='' WHERE userID=$userID";
		$conn->query($sql);
		$conn->close();
		echo 'OK';
	}else echo 'error';
}else echo 'error';
?>