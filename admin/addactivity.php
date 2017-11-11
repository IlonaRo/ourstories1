<?php
/*
	file:	admin/addstory.php
	desc:	Reads department from POST and if it is ok, saves into db
*/
if(empty($_POST)) header('location:index.php');
include('../db.php');
$error=false;
if(!empty($_POST['activityName'])) $activityName=$_POST['activityName'];else header('location:index.php?page=activity');
if(!empty($_POST['activityDescription'])) $activityDescription=$_POST['activityDescription'];else $error=false;
if(!empty($_POST['activityKeyword'])) $activityKeyword=$_POST['activityKeyword'];else $error=false;
if(!$error){
	//here i could check that same values do not exist
	$sql="SELECT * FROM activity WHERE activityName='activityName'";
	$result=$conn->query($sql);
	if($result->num_rows>0){
		//already in database, do not insert!
		header('location:index.php?page=activity');
	}else{
	 //insert into database. Into activity  tables
	 $sql="INSERT INTO activity (activityName,activityDescription,activityKeyword)
		 VALUES('$activityName','$activityDescription','$activityKeyword')";
	 $conn->query($sql);
	 //get the id of inserted record from auto-increment
	 $last_id=$conn->insert_id;
	 $conn->close();
	}
}
header('location:index.php?page=activity');
?>
