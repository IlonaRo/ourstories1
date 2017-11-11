<?php
/*
	file:	admin/addcompany.php
	desc:	Reads company data from POST and if it is ok, saves into db
	Must have fields: You have to put data in companyName, street, postnr and city. If not it is error.
*/
if(empty($_POST)) header('location:index.php');
include('../db.php');
$error=false;
if(!empty($_POST['companyName'])) $companyName=$_POST['companyName'];else $error=true;
if(!empty($_POST['street'])) $street=$_POST['street'];else $error=true;
if(!empty($_POST['postnr'])) $postnr=$_POST['postnr'];else $error=true;
if(!empty($_POST['city'])) $city=$_POST['city'];else $error=true;
if(!empty($_POST['description'])) $description=$_POST['description'];else $error=false;
if(!empty($_POST['website'])) $website=$_POST['website'];else $error=false;
if(!empty($_POST['facebook'])) $facebook=$_POST['facebook'];else $error=false;
if(!$error){
	//here i could check that same values do not exist
	$sql="SELECT * FROM company WHERE companyName='$companyName'";
	$result=$conn->query($sql);
	if($result->num_rows>0){
		//already in database, do not insert!
		header('location:index.php?page=company');
	}else{
	 //insert into database. Both into story
	 $sql="INSERT INTO company(companyName,street,postnr,city,description,website,facebook) 
	 VALUES('$companyName','$street','$postnr','$city','$description','$website','$facebook')";
	 $conn->query($sql);
	  //get the id of inserted record from auto-increment
	 $last_id=$conn->insert_id;
	 $conn->close();
	}
}
header('location:index.php?page=company');
?>