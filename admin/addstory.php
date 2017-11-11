<?php
/*
	file:	admin/addstory.php
	desc:	Reads story from POST and if it is ok, saves into db
*/
if(empty($_POST)) header('location:index.php');
include('../db.php');
$error=false;
if(!empty($_POST['storyTitle'])) $storyTitle=$_POST['storyTitle'];else header('location:index.php?page=story');
if(!empty($_POST['storyType'])) $storyType=$_POST['storyType'];else $error=true;
if(!empty($_POST['storyLink'])) $storyLink=$_POST['storyLink'];else $error=true;
if(!empty($_POST['storyKeywords'])) $storyKeywords=$_POST['storyKeywords'];else $error=false;
if(!empty($_POST['storyDescription'])) $storyDescription=$_POST['storyDescription'];else $error=false;
if(!$error){
	//here i could check that same values do not exist
	$sql="SELECT * FROM story WHERE storyTitle='$storyTitle'";
	$result=$conn->query($sql);
	if($result->num_rows>0){
		//already in database, do not insert!
		header('location:index.php?page=story');
	}else{
	 //insert into database. Both into story
	 $sql="INSERT INTO story (storyTitle,storyType,storyLink,storyKeywords,storyDescription) 
	 VALUES ('$storyTitle','$storyType','$storyLink','$storyKeywords','$storyDescription')";
	 $conn->query($sql);
	  //get the id of inserted record from auto-increment
	 $last_id=$conn->insert_id;
	 $conn->close();
	}
}
header('location:index.php?page=story');
?>