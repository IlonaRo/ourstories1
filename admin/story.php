<?php
/*
	file:	admin/story.php
	desc:	Displays the list of storys in company-table
			Link to a form for adding a new story
			Edit and Delete -links
*/
ob_start();
if(!empty($_GET['mode'])) $mode=$_GET['mode'];else $mode='';
//variables used in pager: $start and $nr_of_records defined here
if(!empty($_GET['start'])) $start=$_GET['start'];else $start=0;
$nr_of_records=5;  //display 5 records at list on every page
//checkin, if on the firs page, start is always zero - even in previous
if($start==0) $prev=$start;else $prev=$start-$nr_of_records;
include('../db.php'); //use the database connection from parent folder
//check the number of records from database table person
$sql="SELECT count(*) as NrOfRecords FROM story";
$result=$conn->query($sql);
$row=$result->fetch_assoc();
$TotalRecords=$row['NrOfRecords'];

?>
		<title>Story Database</title>
		<!-- Bootstrap core CSS -->
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<!--jQuery-->
		<script src="../js/jquery-3.2.1.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script src="js/myscript.js"></script>

		<div class="row" >
			<div class="col-xs">
				<div class="box">
<h4>Story</h4>
<h5>* are required!</h5>
<h6>The story can be removed trough the edit page.</h6>
        <a href="index.php?page=story&mode=add" class="btn btn-default btn-sm">
          <span class="glyphicon glyphicon-plus"></span> Add story 
        </a>
<div class="table-responsive">
<?php
echo '<table class="table table-bordered"><tr><th>ID#</th><th>storyTitle*</th><th>storyType*</th>';
echo '<th>storyLink*</th><th>Keywords</th><th>Description</th><th>Edit</th></tr>';
//if mode in url is add, display a form as first line in table
if($mode=='add'){
	echo '<form action="addstory.php" method="post">
		  <tr>
			<td></td>
			<td><input type="text" name="storyTitle" /></td>
			<td><select name="storyType">

 <option value="">-Select storyType-</option>

 <option value="Written">Written</option>

 <option value="Audio">Audio</option>

 <option value="Video">Video</option>

</select></td>
			<td><input type="text" name="storyLink" /></td>
			<td><input type="text" name="storyKeywords" /></td>
			<td><textarea name="storyDescription" rows="5" cols="40"></textarea></td>
			<td><input type="submit" value="Add" /></td>
			
		  </tr>
		  </form>';
}

$sql = "SELECT *
		FROM story 
		ORDER BY storyTitle
		LIMIT $start,$nr_of_records";
		
$result=$conn->query($sql);  //runs the query in database
while($row=$result->fetch_assoc()){
	echo '<tr>';
	echo '<td>'.$row['storyID'].'</td>';
	echo '<td>'.$row['storyTitle'].'</td>';
	echo '<td>'.$row['storyType'].'</td>';
	echo '<td>'.$row['storyLink'].'</td>';
	echo '<td>'.$row['storyKeywords'].'</td>';
	echo '<td>'.substr($row['storyDescription'], 0, 20).'</td>';
	echo '<td><a href="index.php?page=editstory&storyID='.$row['storyID'].'"><span class="glyphicon glyphicon-edit">';
	echo '</tr>';
}
echo '</table>';
$conn->close(); //close the connection - removed from server memory

?>
<ul class="pager">
<?php
	//check if in the first page
	if($start==0){
		echo '<li>Previous</li>';
	}else{
?>
  <li><a href="index.php?page=story&start=<?php echo $prev?>">Previous</a></li>
<?php
	}
	//check if already in the last page
	$lastrecordnow=$start+$nr_of_records;
	if($lastrecordnow<$TotalRecords){
?>
  <li><a href="index.php?page=story&start=<?php echo $start+$nr_of_records?>">Next</a></li>
<?php
	}else echo '<li>Next</li>';
?>
 </ul>
		</div>
		</div>
	</div>
 </div>