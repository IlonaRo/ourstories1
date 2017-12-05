<?php
/*
	file: ourstories_example/admin/unLinkActivityFromCompany.php
	desc: removes the connection between activity and community
*/
$error=false;
if(!empty($_GET['activityID'])) $activityID=$_GET['activityID'];else $error=true;
if(!empty($_GET['companyID'])) $companyID=$_GET['companyID'];else $error=true;
if(!$error){
	include('../db.php');	
	$sql="DELETE FROM companyactivity 
			WHERE activityID=$activityID AND companyID=$companyID";
	$conn->query($sql);
}	
header("location:index.php?page=editactivity&activityID=$activityID");
?>