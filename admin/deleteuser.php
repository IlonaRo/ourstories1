<?php
/*
	file:	admin/deleteperson.php
	desc:	Reads userID from get-list and deletes that record
			from database table user. 
*/
if(!empty($_GET['userID'])) $personID=$_GET['userID'];
else header('location:index.php?page=');
include('../db.php');
$sql="DELETE FROM user WHERE userID=$userID";
$conn->query($sql);
header('location:index.php?page=users');
?>