<?php
/*
	file:	admin/updateactivity.php
	desc:	Updates Activities
*/
$error=false;
if(!empty($_POST['activityID'])) $activityID=$_POST['activityID'];else $error=true;
if(!empty($_POST['activityName'])) $activityName=$_POST['activityName'];else $error=true;
if(!empty($_POST['activityDescription'])) $activityDescription=$_POST['activityDescription'];else $error=true;
if(!empty($_POST['activityKeyword'])) $activityKeyword=$_POST['activityKeyword'];else $error=false;
if(!empty($_POST['removeactivity'])) $removeactivity=$_POST['removeactivity'];else $removeactivity='';
if(!$error){
	include('../db.php');
	$sql="UPDATE activity SET activityName='$activityName',activityDescription='$activityDescription',activityKeyword='$activityKeyword' WHERE activityID='$activityID'";
	$conn->query($sql);
	if(!empty($removeactivity)){
		$sql="DELETE FROM activity WHERE activityID=$activityID";
		$conn->query($sql);
		if($conn->query($sql)===TRUE) header("location:index.php?page=activity");
	}else   if($conn->query($sql)===TRUE) header("location:index.php?page=editactivity&activityID=$activityID&update=ok");
}else header('location:index.php');
?>