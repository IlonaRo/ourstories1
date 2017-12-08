<?php
/*
	file: ourstories_example/admin/unLinkStoryFromCompany.php
	desc: removes the connection between activity and community
*/
$error=false;
if(!empty($_GET['storyID'])) $storyID=$_GET['storyID'];else $error=true;
if(!empty($_GET['companyID'])) $companyID=$_GET['companyID'];else $error=true;
if(!$error){
	include('../db.php');	
	$sql="DELETE FROM companystory 
			WHERE storyID=$storyID AND companyID=$companyID";
	$conn->query($sql);
}	
header("location:index.php?page=editstory&storyID=$storyID");