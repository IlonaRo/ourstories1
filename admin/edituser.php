<?php
/*
	file:	admin/edituser.php
	desc:	Form for editing user
*/
if(!empty($_GET['userID'])) $userID=$_GET['userID'];else header('location:index.php?page=users');
if(!empty($_GET['update'])) $update=$_GET['update'];else $update='';
include('../db.php');
$sql="SELECT * FROM user WHERE userID=$userID";
$result=$conn->query($sql);  //runs the query in database
if($result->num_rows>0){
	$row=$result->fetch_assoc();
}

?>
		<title>Edit User</title>
		<!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
		<!--jQuery-->
	<script src="../js/jquery-3.2.1.min.js"></script>
   	<link href="../css/signin.css" rel="stylesheet">
	
<h3>Edit User</h3>
<?php
if(!empty($update)) echo '<p class="alert alert-success">Updated!</p>';
?>
<div class ="well">
<table style="">
<form action="updateuser.php" method="post">
		<tr>
		<td><input type="hidden" name="userID" value="<?php echo $userID?>" /></td>
		<td></td>
		</tr>
		<tr>
		<td>Email:</td>
		<td><input type="text" name="email" placeholder="email" value="<?php echo $row['email']?>" /><br /></td>
		</tr>
		<tr>
		<td>Firstname:</td>
		<td><input type="text" name="firstname" placeholder="firstname" value="<?php echo $row['firstname']?>" /><br /></td>
		</tr>
		<tr>
		<td>Lastname:</td>
		<td><input type="text" name="lastname" placeholder="lastname" value="<?php echo $row['lastname']?>" /><br /></td>
		</tr>
		<tr>
		<td>Phonenumber:</td>
		<td><input type="text" name="phone" placeholder="phone" value="<?php echo $row['phone']?>" /><br /></td>
		</tr>
		<tr>
		<td>Level:</td>
		<td><input type="text" name="level" placeholder="level" value="<?php echo $row['level']?>" /><br /></td>
		</tr>
		<tr>
		<td>Remove User</td>
		<td> <input type="checkbox" name="removeuser" /><br /></td>
		</tr>
		<tr>
		<td></td>
		<td><input type="submit" value="Update user" /></td>
		</tr>
</form>
</table>
</div>