<?php
/*
	file:	admin/updatestory.php
	desc:	Updates story name
*/
$error=false;
if(!empty($_POST['storyID'])) $storyID=$_POST['storyID'];else $error=true;
if(!empty($_POST['storyTitle'])) $storyTitle=$_POST['storyTitle'];else $error=true;
if(!empty($_POST['storyType'])) $storyType=$_POST['storyType'];else $error=true;
if(!empty($_POST['storyLink'])) $storyLink=$_POST['storyLink'];else $error=true;
if(!empty($_POST['storyKeywords'])) $storyKeywords=$_POST['storyKeywords'];else $error=false;
if(!empty($_POST['storyDescription'])) $storyDescription=$_POST['storyDescription'];else $error=false;
if(!empty($_POST['removestory'])) $removestory=$_POST['removestory'];else $removestory='';
if(!$error){
	include('../db.php');
	$sql="UPDATE story SET storyTitle='$storyTitle',storyType='$storyType',storyLink='$storyLink',storyKeywords='$storyKeywords',storyDescription='$storyDescription' WHERE storyID=$storyID";
	$conn->query($sql);
	if(!empty($removestory)){
		$sql="DELETE FROM story WHERE storyID=$storyID";
		$conn->query($sql);
		if($conn->query($sql)===TRUE) header("location:index.php?page=story");
	}else   if($conn->query($sql)===TRUE) header("location:index.php?page=editstory&storyID=$storyID&update=ok");
}else header('location:index.php');
?>