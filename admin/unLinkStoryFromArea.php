<?php
/*
	file: ourstories_example/admin/unLinkCompanyFromArea.php
	desc: removes the connection between company and community
*/
$error=false;
if(!empty($_GET['storyID'])) $storyID=$_GET['storyID'];else $error=true;
if(!empty($_GET['communityID'])) $communityID=$_GET['communityID'];else $error=true;
if(!$error){
	include('../db.php');	
	$sql="DELETE FROM storyarea 
			WHERE storyID=$storyID AND communityID=$communityID";
	$conn->query($sql);
}	
header("location:index.php?page=editstory&storyID=$storyID");
?>