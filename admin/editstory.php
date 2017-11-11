<?php
/*
	file:	admin/editstory.php
	desc:	Form for editing department
*/
if(!empty($_GET['storyID'])) $storyID=$_GET['storyID'];else header('location:index.php?page=story');
if(!empty($_GET['update'])) $update=$_GET['update'];else $update='';
include('../db.php');
$sql="SELECT * FROM story WHERE storyID=$storyID";
$result=$conn->query($sql);  //runs the query in database
if($result->num_rows>0){
	$row=$result->fetch_assoc();
}

?>
		<title>Edit Story</title>
		<!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
		<!--jQuery-->
	<script src="../js/jquery-3.2.1.min.js"></script>
   	<link href="../css/signin.css" rel="stylesheet">
	
<h3>Edit Story.</h3>
<h4>Storytype can be written, audio or video.</h4>
<?php
if(!empty($update)) echo '<p class="alert alert-success">Updated!</p>';
?>
<div class="well">
<table style="">
<form action="updatestory.php" method="post">

		<tr>
		<td></td>
		<td><input type="hidden" name="storyID" value="<?php echo $storyID?>"/><br /></td>
		</tr>
		<tr>
		<td>Title:</td>
		<td><input type="text" name="storyTitle" placeholder="Story Title" value="<?php echo $row['storyTitle']?>" /><br /></td>
		</tr>
		<tr>
		<td>Type of story: </td>
		<td><input type="text" name="storyType" placeholder="Story Type" value="<?php echo $row['storyType']?>" /><br /></td>
		</tr>
		<tr>
		<td>Link: </td>
		<td><input type="text" name="storyLink" placeholder="Story Link" value="<?php echo $row['storyLink']?>" /><br /></td>
		</tr>
		<tr>
		<td>Keyword:</td>
		<td><input type="text" name="storyKeywords" placeholder="storyKeywords" value="<?php echo $row['storyKeywords']?>" /><br /></td>
		</tr>
		<tr>
		<td>Desc:</td>
		<td><textarea name="storyDescription" rows="5" cols="40" placeholder="storyDescription"><?php echo $row['storyDescription']?> </textarea><br /></td>
		</tr>
		<tr>
		<td>Remove Story</td>
		<td><input type="checkbox" name="removestory" /><br /></td>
		</tr>
		 <tr>
		<td></td>
		<td><input type="submit" value="Update Story" /></td>
		</tr>
		
</form>
</table>

	<h5>Connect Story to different communities in the area</h5>
	<form action="linkStoryToArea.php" method="post">
	 <input type="hidden" name="storyID" value="<?php echo $storyID?>" />
	 <div class="form-group">
		<label for="area">Connect this story to community:</label>
		<select class="form-control" id="area" name="area">
				<option value="">-Select community-</option>
				<?php
				 $sql="SELECT * FROM community 
						WHERE communityID NOT 
						IN(SELECT communityID FROM storyarea WHERE storyID=$storyID)
						ORDER BY country,communityName";
				 $result=$conn->query($sql);
				 while($row=$result->fetch_assoc()){
					 echo '<option value="'.$row['communityID'].'">'.$row['communityName'].' '.$row['country'].'</option>';
				 }
				?>
		</select>
	 </div>
	 <button type="submit" class="btn btn-default">Link to area</button>
	</form>
	<p></p>
	<div class="well">
	<h5>Communities linked to this company</h5>
	<ul class="list-group">
	<?php
	$sql="SELECT * FROM community
			INNER JOIN storyarea
			ON community.communityID=storyarea.communityID
			WHERE storyarea.storyID=$storyID";
	$result=$conn->query($sql);
	while($row=$result->fetch_assoc()){
		echo '<li class="list-group-item">';
		echo '<a href="unLinkStoryFromArea.php?communityID='.$row['communityID'].'&storyID='.$storyID.'"><span class="glyphicon glyphicon-remove"></span></a> ';
		echo $row['communityName'].', '.$row['country'];
		echo '</li>';
	}
	$conn->close();
	?>
	</ul>
	</div>
	</div>