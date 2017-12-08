<?php
/*
	file:	ourstories_example/linkCompanyToStory.php
	desc:	Links activity to selected company
*/
if(empty($_POST)) header('location:index.php?page=users');
$error=false;
if(!empty($_POST['storyID'])) $storyID=$_POST['storyID'];else $error=true;
if(!empty($_POST['company'])) $company=$_POST['company'];else $error=true;
if(!$error){
	include('../db.php');
	$sql="INSERT INTO companystory(companyID,storyID) VALUES($company,$storyID)";
	$conn->query($sql);
}
header("location:index.php?page=editstory&storyID=$storyID");
?>