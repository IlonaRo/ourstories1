<?php
/*
	file:	admin/company.php
	desc:	Displays the list of companys in company-table
			Link to a form for adding a new company
			Edit and Delete -links
*/
if(!empty($_GET['mode'])) $mode=$_GET['mode'];else $mode='';
//variables used in pager: $start and $nr_of_records defined here
if(!empty($_GET['start'])) $start=$_GET['start'];else $start=0;
$nr_of_records=5;  //display 5 records at list on every page
//checkin, if on the firs page, start is always zero - even in previous
if($start==0) $prev=$start;else $prev=$start-$nr_of_records;
include('../db.php'); //use the database connection from parent folder
//check the number of records from database table company
$sql="SELECT count(*) as NrOfRecords FROM company";
$result=$conn->query($sql);
$row=$result->fetch_assoc();
$TotalRecords=$row['NrOfRecords'];
?>
		<title>Company Database</title>
		<!-- Bootstrap core CSS -->
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		
		<!--jQuery-->
		<script src="../js/jquery-3.2.1.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script src="js/myscript.js"></script>
<h4>Company</h4>
<h5>* are required!</h5>
<h6>The Company can be removed trough the edit page.</h6>
        <a href="index.php?page=company&mode=add" class="btn btn-default btn-sm">
          <span class="glyphicon glyphicon-plus"></span> Add company 
        </a>
<div class="table-responsive">
<?php
echo '<table class="table table-bordered"><tr><th>ID#</th><th>companyName*</th><th>street*</th>';
echo '<th>postnr*</th><th>city*</th><th>desc</th><th>website</th><th>Facebook</th><th>Edit</th></tr>';
//if mode in url is add, display a form as first line in table
if($mode=='add'){
	echo '<form action="addcompany.php" method="post">
		  <tr>
			<td></td>
			<td><input type="text" name="companyName" /></td>
			<td><input type="text" name="street" /></td>
			<td><input type="text" name="postnr" /></td>
			<td><input type="text" name="city" /></td>
			<td><textarea name="description" rows="5" cols="40"></textarea></td>
			<td><input type="text" name="website" /></td>
			<td><input type="text" name="facebook" /></td>
			<td><input type="submit" value="Add" /></td>
		</tr>
		  </form>';
}

$sql = "SELECT *
		FROM company 
		ORDER BY companyName
		LIMIT $start,$nr_of_records";
		
$result=$conn->query($sql);  //runs the query in database
while($row=$result->fetch_assoc()){
	echo '<tr>';
	echo '<td>'.$row['companyID'].'</td>';
	echo '<td>'.$row['companyName'].'</td>';
	echo '<td>'.$row['street'].'</td>';
	echo '<td>'.$row['postnr'].'</td>';
	echo '<td>'.$row['city'].'</td>';
	echo '<td>'.substr($row['description'], 0, 20).'</td>';
	echo '<td>'.$row['website'].'</td>';
	echo '<td>'.$row['facebook'].'</td>';
	echo '<td><a href="index.php?page=editcompany&companyID='.$row['companyID'].'"><span class="glyphicon glyphicon-edit">';
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
  <li><a href="index.php?page=company&start=<?php echo $prev?>">Previous</a></li>
<?php
	}
	//check if already in the last page
	$lastrecordnow=$start+$nr_of_records;
	if($lastrecordnow<$TotalRecords){
?>
  <li><a href="index.php?page=company&start=<?php echo $start+$nr_of_records?>">Next</a></li>
<?php
	}else echo '<li>Next</li>';
?>
 </ul>
 </div>
		 </div>
	 </div>
 </div>