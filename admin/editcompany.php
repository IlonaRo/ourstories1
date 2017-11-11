<?php
/*
	file:	admin/editcompany.php
	desc:	Form for editing department
*/
if(!empty($_GET['companyID'])) $companyID=$_GET['companyID'];else header('location:index.php?page=company');
if(!empty($_GET['update'])) $update=$_GET['update'];else $update='';
include('../db.php');
$sql="SELECT * FROM company WHERE companyID=$companyID";
$result=$conn->query($sql);  //runs the query in database
if($result->num_rows>0){
	$row=$result->fetch_assoc();
}

?>
		<title>Edit Company</title>
		<!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
		<!--jQuery-->
	<script src="../js/jquery-3.2.1.min.js"></script>
   	<link href="../css/signin.css" rel="stylesheet">
<h4>Edit companies</h4>
<?php
if(!empty($update)) echo '<p class="alert alert-success">Updated!</p>';
?>
<div class ="well">
<table style="">
<form action="updatecompany.php" method="post">
		<tr>
		<td></td>
		<td><input type="hidden" name="companyID" value="<?php echo $companyID?>" /></td>
		</tr>
		<tr>
		<td>companyname:</td>
		<td><input type="text" name="companyName" placeholder="companyName" value="<?php echo $row['companyName']?>" /><br /></td>
		</tr>
		<tr>
		<td>street:</td>
		<td><input type="text" name="street" placeholder="street name" value="<?php echo $row['street']?>" /><br /></td>
		</tr>
		<tr>
		<td>postnr:</td>
		<td><input type="text" name="postnr" placeholder="postnr" value="<?php echo $row['postnr']?>" /><br /></td>
		</tr>
		<tr>
		<td>City:</td>
		<td><input type="text" name="city" placeholder="city" value="<?php echo $row['city']?>" /><br /></td>
		</tr>
		<tr>
		<td>Desc:</td>
		<td><textarea name="description" rows="5" cols="40" placeholder="description"><?php echo $row['description']?></textarea><br /></td>
		</tr>
		<tr>
		<td>Website:</td>
		<td><input type="text" name="website" placeholder="website" value="<?php echo $row['website']?>" /><br /></td>
		</tr>
		<tr>
		<td>Facebook:</td>
		<td><input type="text" name="facebook" placeholder="facebook" value="<?php echo $row['facebook']?>" /><br /></td>
		</tr>
		<tr>
		<td>Remove Company</td>
		<td><input type="checkbox" name="removecompany" /><br /></td>
		</tr>
		<tr>
		<td></td>
		<td><input type="submit" value="Update Company" /></td>
		</tr>	
		
		
</form>

</table>

 
	<h5>Connect company to different communities in the area</h5>
	<form action="linkCompanyToArea.php" method="post">
	 <input type="hidden" name="companyID" value="<?php echo $companyID?>" />
	 <div class="form-group">
		<label for="area">Connect this company to community:</label>
		<select class="form-control" id="area" name="area">
				<option value="">-Select community-</option>
				<?php
				 $sql="SELECT * FROM community 
						WHERE communityID NOT 
						IN(SELECT communityID FROM companyarea WHERE companyID=$companyID)
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
			INNER JOIN companyarea
			ON community.communityID=companyarea.communityID
			WHERE companyarea.companyID=$companyID";
	$result=$conn->query($sql);
	while($row=$result->fetch_assoc()){
		echo '<li class="list-group-item">';
		echo '<a href="unLinkCompanyFromArea.php?communityID='.$row['communityID'].'&companyID='.$companyID.'"><span class="glyphicon glyphicon-remove"></span></a> ';
		echo $row['communityName'].', '.$row['country'];
		echo '</li>';
	}
	$conn->close();
	?>
	</ul>
	</div>

</div>