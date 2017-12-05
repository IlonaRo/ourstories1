<?php
/*
	file:	ourstories_example/linkCompanyToActivity.php
	desc:	Links activity to selected company
*/
if(empty($_POST)) header('location:index.php?page=users');
$error=false;
if(!empty($_POST['activityID'])) $activityID=$_POST['activityID'];else $error=true;
if(!empty($_POST['company'])) $company=$_POST['company'];else $error=true;
if(!$error){
	include('../db.php');
	$sql="INSERT INTO companyactivity(companyID,activityID) VALUES($company,$activityID)";
	$conn->query($sql);
}
header("location:index.php?page=editactivity&activityID=$activityID");
?>