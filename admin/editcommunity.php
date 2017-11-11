<?php
/*
	file:	admin/editcommunity.php
	desc:	Form for editing community
*/
if(!empty($_GET['communityID'])) $communityID=$_GET['communityID'];else header('location:index.php?page=community');
if(!empty($_GET['update'])) $update=$_GET['update'];else $update='';
include('../db.php');
$sql="SELECT * FROM community WHERE communityID=$communityID";
$result=$conn->query($sql);  //runs the query in database
if($result->num_rows>0){
	$row=$result->fetch_assoc();
}

?>
		<title>Edit Community</title>
		<!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
		<!--jQuery-->
	<script src="../js/jquery-3.2.1.min.js"></script>
   	<link href="../css/signin.css" rel="stylesheet">
	<h4>Edit Community</h4>
	<h5>Country can be only Finland, Sweden or Norway.</h5>
<?php
if(!empty($update)) echo '<p class="alert alert-success">Updated!</p>';
?>
<div class="well">
<table style="">
<form action="updatecommunity.php" method="post">
		<tr>
		<td></td>
		<td><input type="hidden" name="communityID" value="<?php echo $communityID?>" /></td>
		</tr>
		<tr>
		<td>Name of Community:</td>
		<td><input type="text" name="communityName" placeholder="communityName" value="<?php echo $row['communityName']?>" /><br /></td>
		</tr>
		<tr>
		<td>Country:</td>
		<td><input type="text" name="country" placeholder="country" value="<?php echo $row['country']?>" /><br /></td>
		</tr>
		<tr>
		<td>Desc:</td>
		<td><textarea name="description" rows="5" cols="40" placeholder="description"><?php echo $row['description']?></textarea><br /></td>
		</tr>
		<tr>
		<td>Remove community</td>
		<td><input type="checkbox" name="removecommunity" /><br /></td>
		</tr>
		<tr>
		<td></td>
		<td><input type="submit" value="Update Community" /></td>
		</tr>		
</form>
</table>
</div>