<?php
/*
	file:	admin/updateuser.php
	desc:	Updates user-table with given fields
*/
if(empty($_POST)) header('location:index.php');
include('../db.php');
$error=false;
if(!empty($_POST['userID'])) $userID=$_POST['userID'];else $error=true;
if(!empty($_POST['email'])) $email=$_POST['email'];else $error=true;
if(!empty($_POST['password'])) $password=$_POST['password'];else $error=false;
if(!empty($_POST['lastname'])) $lastname=$_POST['lastname'];else $error=true;
if(!empty($_POST['firstname'])) $firstname=$_POST['firstname'];else $error=true;
if(!empty($_POST['phone'])) $phone=$_POST['phone'];else $error=false;
if(!empty($_POST['level'])) $level=$_POST['level'];else $level=0;
if(!empty($_POST['removeuser'])) $removeuser=$_POST['removeuser'];else $removeuser='';
if(!$error){
	$sql="UPDATE user SET email='$email',password='$password',lastname='$lastname',firstname='$firstname',phone='$phone',level='$level'
			WHERE userID=$userID";
	$conn->query($sql);
		if(!empty($removeuser)){
		$sql="DELETE FROM user WHERE userID=$userID";
		$conn->query($sql);
		if($conn->query($sql)===TRUE) header("location:index.php?page=users");
	}else   if($conn->query($sql)===TRUE) header("location:index.php?page=edituser&userID=$userID&update=ok");
}else header("location:index.php?page=edituser&userID=$userID");
?>