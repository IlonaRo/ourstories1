<?php
/*
	file: ourstories_example/admin/linkCompanyToArea.php
	desc: Saves companyID and communityID to companyarea table
*/
if(empty($_POST)) header('location:index.php?page=company');
$error=false;
if(!empty($_POST['companyID'])) $companyID=$_POST['companyID'];else $error=true;
if(!empty($_POST['area'])) $area=$_POST['area'];else $error=true;
if(!$error){
	include('../db.php');
	$sql="INSERT INTO companyarea(companyID,communityID) VALUES($companyID,$area)";
	$conn->query($sql);
}
header("location:index.php?page=editcompany&companyID=$companyID");
?>