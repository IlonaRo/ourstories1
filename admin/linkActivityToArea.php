<?php
/*
	file:	ourstories_example/linkActivityToArea.php
	desc:	Links activity to selected community
*/
if(empty($_POST)) header('location:index.php?page=users');
$error=false;
if(!empty($_POST['activityID'])) $activityID=$_POST['activityID'];else $error=true;
if(!empty($_POST['area'])) $area=$_POST['area'];else $error=true;
if(!$error){
	include('../db.php');
	$sql="INSERT INTO area_activity(communityID,activityID) VALUES($area,$activityID)";
	$conn->query($sql);
}
header("location:index.php?page=editactivity&activityID=$activityID");
?>