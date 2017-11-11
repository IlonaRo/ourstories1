<?php
/*
	file:	admin/updatecompany.php
	desc:	Updates company data and only posting data is required else is marked false
*/
$error=false;
if(!empty($_POST['companyID'])) $companyID=$_POST['companyID'];else $error=true;
if(!empty($_POST['companyName'])) $companyName=$_POST['companyName'];else $error=true;
if(!empty($_POST['street'])) $street=$_POST['street'];else $error=true;
if(!empty($_POST['postnr'])) $postnr=$_POST['postnr'];else $error=true;
if(!empty($_POST['city'])) $city=$_POST['city'];else $error=true;
if(!empty($_POST['description'])) $description=$_POST['description'];else $error=false;
if(!empty($_POST['website'])) $website=$_POST['website'];else $error=false;
if(!empty($_POST['facebook'])) $facebook=$_POST['facebook'];else $error=false;
if(!empty($_POST['removecompany'])) $removecompany=$_POST['removecompany'];else $removecompany='';
if(!$error){
	include('../db.php');
	$sql="UPDATE company SET companyName='$companyName',street='$street',postnr='$postnr',city='$city',description='$description',website='$website',facebook='$facebook'
		WHERE companyID=$companyID";
	$conn->query($sql);
	if(!empty($removecompany)){
		$sql="DELETE FROM company WHERE companyID=$companyID";
		$conn->query($sql);
		if($conn->query($sql)===TRUE) header("location:index.php?page=company");
	}else   if($conn->query($sql)===TRUE) header("location:index.php?page=editcompany&companyID=$companyID&update=ok");
}else header('location:index.php');
?>