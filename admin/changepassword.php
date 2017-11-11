<?php
/*
	file:	admin/changepassword.php
	desc:	Displays the form for logged in user to change password
*/
?>
<h4>Change your password</h4>

<form action="updatepassword.php" method="post">
 <table class="table">
	<tr><td>Old password</td><td><input type="password" name="old" /></td></tr>
	<tr><td>New password</td><td><input type="password" name="new" /></td></tr>
	<tr><td>Confirm new</td><td><input type="password" name="conf" /></td></tr>
	<tr><td></td><td><input type="submit" value="Change password" /></td></tr>
 </table>
</form>
<p>
<?php 
if(isset($_SESSION['msg'])) echo $_SESSION['msg'];
$_SESSION['msg']='';
?></p>
<?php
//get image name from db if it exists
$sql="SELECT image FROM user WHERE userID=".$_SESSION['userID'];
include('../db.php');
$result=$conn->query($sql);  //runs the query in database
if($result->num_rows>0){
	$row=$result->fetch_assoc();
	$imgname=$row['image'];
}else $imgname='';
?>
<div>
<h4>Add profile image</h4>
<form class="form" enctype="multipart/form-data">
	<input type="hidden" id="userID" value="<?php echo $_SESSION['userID']?>" />
	<h5>Select your profile image</h5>
	<label for="imgfile">Select file:</label>
	<input type="file" id="imgfile" name="imgfile" />
	<input type="button" class="btn" id="saveimgbtn" value="Upload image" />
	<input type="button" class="btn" id="removeimgbtn" value="Remove image" />
</form>
<div id="showimg">
	<?php
		if(!empty($imgname)){
			echo '<p><img src="./images/'.$imgname.'" class="media-object" style="width:200px" /></p>';
		}
	?>
	
</div>
<div id="imgdata">
	
</div>

</div>