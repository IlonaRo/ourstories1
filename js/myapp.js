/*
	file: 	js/myapp.js
	desc:	Code for app.
*/

$(document).ready(function(){
	initializeMap();
	getLocation(); //gets users location and initializes the map. Shows the location on the map.
    addMarkers();
	$("#search").submit(function(event){
		addSearch();
		return false;  //no page refresh after submit
	});
	
});
function initializeMap(){
	
	$("#map").googleMap({
      zoom: 10, // Initial zoom level (optional)
      coords: [65.848523, 24.151954], // Map center (optional)
      type: "ROADMAP" // Map type (optional)
    });
	
}
function addYourLocation(lat,lng){
	var image ='images/here.ico';
	$("#map").addMarker({
		coords: [lat, lng], 
		title: 'Your location', 
		center: {lat: lat, lng: lng},
		text:  '<p>You are here!</p>',
		icon:image
	});
	
}
function addSearch(){
	//clear the map from previous state by initializing it
	$("#map").googleMap({
      zoom: 10, // Initial zoom level (optional)
      coords: [65.848523, 24.151954], // Map center (optional)
      type: "ROADMAP" // Map type (optional)
    });
	//take city name from select choise (area)
	var area=$("#area").val();
	var url="getCompanyAddress.php?area="+area;
	Markers(url);
	getLocation();	
}
function addMarkers(){
	var url="getCompanyAddress.php";
	Markers(url);
}

function Markers(url){
	//draws the markers on the map
	$.getJSON(url,function(result){
		$.each(result.companies,function(key,company){
			address=company.Street + ', '+company.City;
			$("#map").addMarker({
				address: address, 
				title: company.Companyname,
				url: company.Web,
				text: '<p>'+address+'</p><p>'+company.Web+'</p>'
			});
		});
	});
}

function getLocation(){
  var msg; 

  /** 
  first, test for feature support
  **/
  if('geolocation' in navigator){
    // geolocation is supported :)
    requestLocation();
  }else{
    // no geolocation :(
    msg = "Sorry, looks like your browser doesn't support geolocation";
    outputResult(msg); // output error message
  }

  /*** 
  requestLocation() returns a message, either the users coordinates, or an error message
  **/
  function requestLocation(){
    /**
    getCurrentPosition() below accepts 3 arguments:
    a success callback (required), an error callback  (optional), and a set of options (optional)
    **/
  
    var options = {
      // enableHighAccuracy = should the device take extra time or power to return a really accurate result, or should it give you the quick (but less accurate) answer?
      enableHighAccuracy: false,
      // timeout = how long does the device have, in milliseconds to return a result?
      timeout: 5000,
      // maximumAge = maximum age for a possible previously-cached position. 0 = must return the current position, not a prior cached position
      maximumAge: 0
    };
  
    // call getCurrentPosition()
    navigator.geolocation.getCurrentPosition(success, error, options); 
  
    // upon success, do this
    function success(pos){
      // get longitude and latitude from the position object passed in
      var lng = pos.coords.longitude;
      var lat = pos.coords.latitude;
      // and presto, we have the device's location!
      msg = 'You appear to be at location: ' + lat + ',' + lng  //+ '<img src="https://maps.googleapis.com/maps/api/staticmap?zoom=15&size=300x300&maptype=roadmap&markers=color:red%7Clabel:A%7C' + lat + ',' + lng+ '&sensor=false">';
      outputResult(msg); // output message
      addYourLocation(lat,lng);
    }
  
    // upon error, do this
    function error(err){
      // return the error message
      msg = 'Error: ' + err + ' :(';
      outputResult(msg); // output button
    }  
  } // end requestLocation();

  /*** 
  outputResult() inserts msg into the DOM  
  **/
  function outputResult(msg){
    $('.result').addClass('result').html(msg);
  }
} // end getLocation()










