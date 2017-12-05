<?php
/*
	file:	admin/editactivity.php
	desc:	Form for editing department
*/
if(!empty($_GET['activityID'])) $activityID=$_GET['activityID'];else header('location:index.php?page=activity');
if(!empty($_GET['update'])) $update=$_GET['update'];else $update='';
include('../db.php');
$sql="SELECT * FROM activity WHERE activityID=$activityID";
$result=$conn->query($sql);  //runs the query in database
if($result->num_rows>0){
	$row=$result->fetch_assoc();
}

?>
		<title>Edit Activity</title>
		<!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
		<!--jQuery-->
	<script src="../js/jquery-3.2.1.min.js"></script>
   	<link href="../css/signin.css" rel="stylesheet">
<h4>Edit Activities</h4>
<?php
if(!empty($update)) echo '<p class="alert alert-success">Updated!</p>';
?>
<div class ="well">
<table style="">
<form action="updateactivity.php" method="post">
		<tr>
		<td></td>
		<td><input type="hidden" name="activityID" value="<?php echo $activityID?>" /></td>
		</tr>
		<tr>
		<td>Name of activity:</td>
		<td><input type="text" name="activityName" placeholder="activityName" value="<?php echo $row['activityName']?>" /><br /></td>
		</tr>
		<tr>
		<td>Desc:</td>
		<td><textarea name="activityDescription" rows="5" cols="40" placeholder="description"><?php echo $row['activityDescription']?></textarea><br /></td>
		</tr>
		<tr>
		<td>Keyword:</td>
		<td><input type="text" name="activityKeyword" placeholder="activityKeyword" value="<?php echo $row['activityKeyword']?>" /><br /></td>
		</tr>
		<tr>
		<td>Remove activity</td>
		<td><input type="checkbox" name="removeactivity" /><br /></td>
		</tr>
		<tr>
		<td></td>
		<td><input type="submit" value="Update Activity" /></td>
		</tr>		
</form>
</table>

	
	
		<h5>Connect Activity to different companys </h5>
	<form action="linkCompanyToActivity.php" method="post">
	 <input type="hidden" name="activityID" value="<?php echo $activityID?>" />
	 <div class="form-group">
		<label for="company">Connect this activity to company:</label>
		<select class="form-control" id="company" name="company">
				<option value="">-Select company-</option>
				<?php
				 $sql="SELECT * FROM company 
						WHERE companyID NOT 
						IN(SELECT companyID FROM companyactivity WHERE activityID=$activityID)
						ORDER BY city,companyName";
				 $result=$conn->query($sql);
				 while($row=$result->fetch_assoc()){
					 echo '<option value="'.$row['companyID'].'">'.$row['companyName'].' '.$row['city'].' '.$row['street'].'</option>';
				 }
				?>
		</select>
	 </div>
	 <button type="submit" class="btn btn-default">Link to company</button>
	</form>
	<p></p>
	
	<h5>Commpanys linked to this activity</h5>
	<ul class="list-group"></ul>
	<?php
	$sql="SELECT * FROM company
			INNER JOIN companyactivity ON company.companyID=companyactivity.companyID
			INNER JOIN activity ON companyactivity.activityID=activity.activityID
			WHERE companyactivity.activityID=$activityID";
	$result=$conn->query($sql);
	while($row=$result->fetch_assoc()){
		echo '<li class="list-group-item">';
		echo '<a href="unLinkActivityFromCompany.php?companyID='.$row['companyID'].'&activityID='.$activityID.'"><span class="glyphicon glyphicon-remove"></span></a> ';
		echo $row['companyName'].', '.$row['city'];
		echo '</li>';
	}
		


	
	
	?>
	
		<h5>Connect Activity to different communities in the area</h5>
	<form action="linkActivityToArea.php" method="post">
	 <input type="hidden" name="activityID" value="<?php echo $activityID?>" />
	 <div class="form-group">
		<label for="area">Connect this activity to community:</label>
		<select class="form-control" id="area" name="area">
				<option value="">-Select community-</option>
				<?php
				 $sql="SELECT * FROM community 
						WHERE communityID NOT 
						IN(SELECT communityID FROM area_activity WHERE activityID=$activityID)
						ORDER BY country,communityName";
				 $result=$conn->query($sql);
				 while($row=$result->fetch_assoc()){
					 echo '<option value="'.$row['communityID'].'">'.$row['communityName'].' '.$row['country'].'</option>';
				 }
				?>
		</select>
	 </div>
	 <button type="submit2" class="btn btn-default">Link to area</button>
	</form>
	<p></p>
	<div class="well">
	<h5>Communities linked to this activity</h5>
	<ul class="list-group">
	<?php
	$sql="SELECT * FROM community
			INNER JOIN area_activity
			ON community.communityID=area_activity.communityID
			WHERE area_activity.activityID=$activityID";
	$result=$conn->query($sql);
	while($row=$result->fetch_assoc()){
		echo '<li class="list-group-item">';
		echo '<a href="unLinkActivityFromArea.php?communityID='.$row['communityID'].'&activityID='.$activityID.'"><span class="glyphicon glyphicon-remove"></span></a> ';
		echo $row['communityName'].', '.$row['country'];
		echo '</li>';
	}
	$conn->close();
	?>
	</ul>
	</div>
	</div>