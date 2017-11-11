<?php
/*
	file:	login.php
	desc:	Checks the email and password from db table user.
			If they are ok, saves session-information and redirects
			to go to admin-folder
*/
if(empty($_POST)) header('location:index.html');
$error=false;
if(!empty($_POST['email'])) $email=$_POST['email'];else $error=true;
if(!empty($_POST['password'])) $password=$_POST['password'];else $error=true;
if(!$error){
	//email and password received, check from database
	include('db.php'); //use the database connection
	$email=$conn->real_escape_string($email);
	$password=$conn->real_escape_string($password);
	$sql = "SELECT email,password,userID,firstname,lastname FROM user
			WHERE email='$email'";
	$result=$conn->query($sql);  //runs the query in database
	if($result->num_rows>0){
		//username was found
		$row=$result->fetch_assoc();
		if(password_verify($password,$row['password'])){
			//password correct
			session_start();
			$_SESSION['userID']=$row['userID'];
			$_SESSION['name']=$row['firstname'].' '.$row['lastname'];
			echo '{"Status":"OK"}'; //login is correct
		}else echo '{"Status":"Password did not match"}';
	}else echo '{"Status":"Email not found"}';
}else echo '{"Status":"Something went wrong"}';
?>











