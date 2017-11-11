<?php
/*
	file:	admin/updateuserpass.php
	desc:	Updates user password
*/
$error=false;
if(!empty($_POST['userID'])) $userID=$_POST['userID'];else $error=true;
if(!empty($_POST['newpassword'])) $newpassword=$_POST['newpassword'];else $error=true;
if(!empty($_POST['confp'])) $confp=$_POST['confp'];else $error=true;
if(!$error){
	include('../db.php');
					if($newpassword==$confp){
					//update password
					//crypt the password before saving
					$newpassword=password_hash($newpassword,PASSWORD_DEFAULT);
					$sql="UPDATE user SET password='$newpassword'
						  WHERE userID=$userID";
					$conn->query($sql);
					if($conn->query($sql)===TRUE)
						//if password is updatet or not it will say it in alertbox and redirect to users page
						echo "<script language='javascript'>alert('Password updated!');</script>";
						echo '<script>window.location.href = "index.php?page=users";</script>';
					}else  
						
					echo "<script language='javascript'>alert('ALERT!!! Password not updated! Try again!');</script>";
					echo '<script>window.location.href = "index.php?page=users";</script>';
}				
?>