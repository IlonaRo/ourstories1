<?php
/*
	file: ourstories_example/admin/unLinkCompanyFromArea.php
	desc: removes the connection between company and community
*/
$error=false;
if(!empty($_GET['companyID'])) $companyID=$_GET['companyID'];else $error=true;
if(!empty($_GET['communityID'])) $communityID=$_GET['communityID'];else $error=true;
if(!$error){
	include('../db.php');	
	$sql="DELETE FROM companyarea 
			WHERE companyID=$companyID AND communityID=$communityID";
	$conn->query($sql);
}	
header("location:index.php?page=editcompany&companyID=$companyID");
?>