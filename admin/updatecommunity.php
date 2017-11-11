<?php
/*
	file:	admin/updatecommunity.php
	desc:	Updates communitys
*/
$error=false;
if(!empty($_POST['communityID'])) $communityID=$_POST['communityID'];else $error=true;
if(!empty($_POST['communityName'])) $communityName=$_POST['communityName'];else $error=true;
if(!empty($_POST['country'])) $country=$_POST['country'];else $error=true;
if(!empty($_POST['description'])) $description=$_POST['description'];else $error=false;
if(!empty($_POST['removecommunity'])) $removecommunity=$_POST['removecommunity'];else $removecommunity='';
if(!$error){
	include('../db.php');
	$sql="UPDATE community SET communityName='$communityName',country='$country',description='$description' WHERE communityID='$communityID'";
	$conn->query($sql);
	if(!empty($removecommunity)){
		$sql="DELETE FROM community WHERE communityID=$communityID";
		$conn->query($sql);
		if($conn->query($sql)===TRUE) header("location:index.php?page=community");
	}else   if($conn->query($sql)===TRUE) header("location:index.php?page=editcommunity&communityID=$communityID&update=ok");
}else header('location:index.php');
?>