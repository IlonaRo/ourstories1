<?php
/*
	file:	ourstories_example/linkStoryToArea.php
	desc:	Links story to selected community
*/
if(empty($_POST)) header('location:index.php?page=users');
$error=false;
if(!empty($_POST['storyID'])) $storyID=$_POST['storyID'];else $error=true;
if(!empty($_POST['area'])) $area=$_POST['area'];else $error=true;
if(!$error){
	include('../db.php');
	$sql="INSERT INTO storyarea(storyID,communityID) VALUES($storyID,$area)";
	$conn->query($sql);
}
header("location:index.php?page=editstory&storyID=$storyID");
?>