<?php
/*
	file:	admin/addcommunity.php
	desc:	Reads community from POST and if it is ok, saves into db
*/
if(empty($_POST)) header('location:index.php');
include('../db.php');
$error=false;
if(!empty($_POST['communityName'])) $communityName=$_POST['communityName'];else header('location:index.php?page=community');
if(!empty($_POST['country'])) $country=$_POST['country'];else $error=true;
if(!empty($_POST['description'])) $description=$_POST['description'];else $error=false;
if(!$error){
	//here i could check that same values do not exist
	$sql="SELECT * FROM community WHERE communityName='communityName'";
	$result=$conn->query($sql);
	if($result->num_rows>0){
		//already in database, do not insert!
		header('location:index.php?page=community');
	}else{
	 //insert into database. Into community  tables
	 $sql="INSERT INTO community (communityName,country,description)
		 VALUES('$communityName','$country','$description')";
	 $conn->query($sql);
	 //get the id of inserted record from auto-increment
	 $last_id=$conn->insert_id;
	 $conn->close();
	}
}
header('location:index.php?page=community');
?>