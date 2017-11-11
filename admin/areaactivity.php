<?php
/*
	file:	admin/areaactivity.php
	desc:	Displays the areaactivity-table
			Link to a form for adding a areaactivity
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
		<title>Area Activity Database</title>
		<!-- Bootstrap core CSS -->
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<!--jQuery-->
		<script src="../js/jquery-3.2.1.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script src="js/myscript.js"></script>
	<div class ="container">
	
<h4>areaActivity</h4>
<h5>* are required!</h5>
<a href="index.php?page=activity&mode=add">Add new areaactivity</a>

<?php
echo '<table class="table table-striped"><tr><th>ID#</th><th>activityName*</th><th>activityDescription</th>';
echo '<th>activityKeyword</th><th></th>';
//if mode in url is add, display a form as first line in table
if($mode=='add'){
	echo '<form action="addactivity.php" method="post">
		  <tr>
			<td></td>
			<td><input type="text" name="activityName" /></td>
			<td><input type="text" name="activityDescription" /></td>
			<td><input type="text" name="activityKeyword" /></td>
			<td><input type="submit" value="Add" /></td>
		  </tr>
		  </form>';
}

$sql = "SELECT *
		FROM activity 
		ORDER BY activityName
		LIMIT $start,$nr_of_records";
		
$result=$conn->query($sql);  //runs the query in database
while($row=$result->fetch_assoc()){
	echo '<tr>';
	echo '<td>'.$row['activityID'].'</td>';
	echo '<td>'.$row['activityName'].'</td>';
	echo '<td>'.$row['activityDescription'].'</td>';
	echo '<td>'.$row['activityKeyword'].'</td>';
	echo '<td><a href="index.php?page=editactivity&activityID='.$row['activityID'].'">Edit</a></td>';
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
  <li><a href="index.php?page=activity&start=<?php echo $prev?>">Previous</a></li>
<?php
	}
	//check if already in the last page
	$lastrecordnow=$start+$nr_of_records;
	if($lastrecordnow<$TotalRecords){
?>
  <li><a href="index.php?page=activity&start=<?php echo $start+$nr_of_records?>">Next</a></li>
<?php
	}else echo '<li>Next</li>';
?>
 </ul>
 </div>