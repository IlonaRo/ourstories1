<?php
/*
	file: ourstories_example/admin/unLinkActivityFromArea.php
	desc: removes the connection between activity and community
*/
$error=false;
if(!empty($_GET['activityID'])) $activityID=$_GET['activityID'];else $error=true;
if(!empty($_GET['communityID'])) $communityID=$_GET['communityID'];else $error=true;
if(!$error){
	include('../db.php');	
	$sql="DELETE FROM area_activity 
			WHERE activityID=$activityID AND communityID=$communityID";
	$conn->query($sql);
}	
header("location:index.php?page=editactivity&activityID=$activityID");
?>