/**
	file:	myscript.js
	desc:	Handles the login communication between loginform and login.php
			Displays the results from database in companies page
**/
$(document).ready(function(){
	
	loadCompaniesDefault(); //loads the default list of companies
	loadStoriesDefault();
	loadActivityDefault(); //load activity default list 
	$("#cmpTable").click(function(){
		loadCompaniesTable();
	});
	$("#search").keyup(function(){
		searchCompanies();
	});
	// activity part Start
	$("#cmpTable3").click(function(){
		loadActivityTable();
	});
	$("#searchActivity").keyup(function(){
		searchActivity();
	});
	// activity part Stop
	
	//searching stories in stories page - when searcword is written
	$("#searchstory").keyup(function(){
		searchStories();
	});
	
	//searching stories in stories page - when storytype is changed
	$("select").change(function(){
		searchStories();
	});


	//when user clicks on the button "Read more" in storylist. Button is created with jQuery, so class "readmore" is used to get its value
	$('#stories').on('click','.readmore', function(){
		//the storyid from button is taken and passed to the query of stories to get selected story
		$.getJSON( "selectedStory.php?storyID="+$(this).attr('data-storyID'), function( data ) {
		var resultlist='';
		$.each( data, function( key, story ) {
			//data is shown in modal form (defined in index.php)
			$("#storyTitle").html(story.storyTitle);
			$("#storyDescription").html(story.storyDescription);
			$("#storyLink").html('<iframe width="550" height="400" src="'+story.storyLink+'"></iframe>');
		});		
		
	});
	});
	
	

});
//activity part start
function loadActivityDefault(){
 $.getJSON( "activityDefault.php", function( data, company ) {
	var resultlist='';
	$.each( data, function ( key, company ) {
		resultlist=resultlist+company.companyID+' '+company.companyName+' '+company.street+' '+company.city+' ';
		resultlist=resultlist+' '+company.activityName+' ';
		resultlist=resultlist+' '+company.activityDescription+'<br />';
	});
	$("#results3").html(resultlist);
 });
}

function loadActivityTable(){
 var resulttable='<table class="table table-condensed"><thead><tr><th>#</th><th>Company</th><th>Activity</th><th>Address</th><th>City</th></tr></thead><tbody>';
 $.getJSON( "activityDefault.php", function( data ) {
	var resultlist='';
	$.each( data, function( key, company ) {
		resultlist=resultlist+'<tr><td>'+company.companyID+'</td><td>'+company.companyName+'</td>';
		resultlist=resultlist+'<td>'+company.activityName+'</td><td>'+company.street+'</td><td>'+company.city+'</td></tr>';
	});
	resulttable=resulttable+resultlist+'</tbody></table>';
	$("#results3").html(resulttable);
 });
}
function searchActivity(){
	var searchword=$("#searchActivity").val();
	$.getJSON("activitySearch.php?search="+searchword,function(data){
		var resultlist='';
		$.each( data, function( key, company ) {
			resultlist=resultlist+'<tr><td>'+company.companyID+'</td><td>'+company.companyName+'</td><td>'+company.activityName+'</td><td>'+company.street+'</td><td>'+company.city+'</td></tr>';
			
			});
	$("#results3").html(resultlist);
	});
}
//activity part stop
function loadCompaniesDefault(){
 $.getJSON( "companiesDefault.php", function( data ) {
	var resultlist='';
	$.each( data, function( key, company ) {
		resultlist=resultlist+company.companyID+' '+company.companyName+' '+company.city+' '+company.street+' <br />';
	});
	$("#results").html(resultlist);
 });
}

function loadCompaniesTable(){
 var resulttable='<table class="table table-condensed"><thead><tr><th>#</th><th>Company</th><th>Address</th><th>About</th><th>Website</th><th>Facebook</th></tr></thead><tbody>';
 $.getJSON( "companiesDefault.php", function( data ) {
	var resultlist='';
	$.each( data, function( key, company ) {
		resultlist=resultlist+'<tr><td>'+company.companyID+'</td><td>'+company.companyName+'</td>';
		resultlist=resultlist+'<td>'+company.street+', '+company.postnr+' '+company.city+'</td>';
		resultlist=resultlist+'<td>'+company.description+'</td><td>'+company.website+'</td><td>'+company.facebook+'</td></tr>';
	});
	resulttable=resulttable+resultlist+'</tbody></table>';
	$("#results").html(resulttable);
 });
}
function searchCompanies(){
	var searchword=$("#search").val();
	$.getJSON("companySearch.php?search="+searchword,function(data){
		var resultlist='';
		$.each( data, function( key, company ) {
			resultlist=resultlist+company.companyID+' '+company.companyName+' '+company.city+'<br />';
		});
	$("#results").html(resultlist);
	});
}
function loadStoriesDefault(){
	$.getJSON( "storiesDefault.php", function( data ) {
	var resultlist='';
	$.each( data, function( key, story ) {
		resultlist=resultlist+'<tr><td>'+story.storyTitle+'</td><td>'+story.storyType+'</td>';
		resultlist=resultlist+'<td><a href="'+story.storyLink+'" target="_new">To the story</a></td>';
		resultlist=resultlist+'<td><button type="button" class="readmore btn" data-toggle="modal" data-target="#showStory" ';
		resultlist=resultlist+'data-storyID="'+story.storyID+'">Read more</button></td>';
		resultlist=resultlist+'</tr>';	
	});
	$("#stories").html(resultlist);
 });
}

function searchStories(){
	var type=$("#type").val();
	var search=$("#searchstory").val();
	$.getJSON( "storiesDefault.php?search="+search+"&type="+type, function( data ) {
	var resultlist='';
	$.each( data, function( key, story ) {
		resultlist=resultlist+'<tr><td>'+story.storyTitle+'</td><td>'+story.storyType+'</td>';
		resultlist=resultlist+'<td><a href="'+story.storyLink+'" target="_new">To the story</a></td>';
		resultlist=resultlist+'<td><button type="button" class="readmore btn" data-toggle="modal" data-target="#showStory" ';
		resultlist=resultlist+'data-storyID="'+story.storyID+'">Read more</button></td>';
		resultlist=resultlist+'</tr>';	
	});
	$("#stories").html(resultlist);
 });
	
}