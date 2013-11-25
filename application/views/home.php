<div id="map-box" class="full-width-box">
</div>

<div id="find-yours-box" class="content-box">
	<h1>Find your Dojo</h1>
	<p>Just enter your exact (closest town, or exact address) location in the box below and we'll find your closest dojo</p>
	<div id="find-yours-form">
		<input type="text" id="location" placeholder="Where are you?">
	</div>
	<div id="closeness" class="hidden">
	    <h1 id="closest-title">Your dojo is</h1>
	    <h2 id="closest-location"><a href="#">{{placeholder}}</a> which is 20KM away</h2>
	</div>
</div>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="/static/js/geolib.js"></script>
<script type="text/javascript">
var map;
var markers = [];
var geocoder;
var data;

function initialize() {
  geocoder = new google.maps.Geocoder();
  var mapOptions = {
    center: new google.maps.LatLng(25,0),
    zoom: 2,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
	streetViewControl: false,
	scrollwheel: false
  };
  map = new google.maps.Map(document.getElementById("map-box"), mapOptions);
  for(var i in data) {
	  markers[i] = new google.maps.Marker({
			dojoId: data[i],
	    position: new google.maps.LatLng(data[i].latitude,data[i].longitude),
	    map: map,
	    title: i,
		  clickable: true,
		  icon: {
			  path: google.maps.SymbolPath.CIRCLE,
			  fillColor: 'ff3333',
			  fillOpacity: 1,
			  scale: 3,
			  strokeOpacity: 1,
			  strokeWeight: 1
		  }
	  });
	  google.maps.event.addListener(markers[i], 'click', function() {
			window.location = "http://zen.coderdojo.com/dojo/"+this.dojoId.id;
	  });
  }
}

function DojoList(dojos) {
	data = dojos;
}

function codeAddress(myLocation) {
  var address = myLocation;
  geocoder.geocode( { 'address': address}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
	  var closest = geolib.findNearest({
		  latitude: results[0].geometry.location.lat(),
		  longitude: results[0].geometry.location.lng()
	  },data);
	  document.getElementById('closest-location').innerHTML = "<a href='http://zen.coderdojo.com/dojo/"+data[closest.key].id+"'>"+closest.key+"</a> which is "+(closest.distance/1000).toFixed(1)+"KM away.";
	  document.getElementById('closeness').style.display = "inherit";
    map.setCenter(new google.maps.LatLng(closest.latitude,closest.longitude));
	  map.setZoom(15);
	} else {
      alert("Geocode was not successful for the following reason: " + status);
    }
  });
}
google.maps.event.addDomListener(window, 'load', initialize);
google.maps.event.addDomListener(window, 'load',function() {
	el = document.getElementById("location");
	if(el.addEventListener) {
		el.addEventListener('change',function(){
			myLocation = this.value;
			codeAddress(myLocation);
		});
	} else if (el.attachEvent) {
		el.attachEvent('onchange',function(){
			myLocation = this.value;
			codeAddress(myLocation);
		});
	}
});
</script>
<script type="text/javascript" src="http://zen.coderdojo.com/dojo/json?callback=DojoList"></script>
<style type="text/css">
@import url(http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300);

*{margin:0; padding:0; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; }

html,body {
	height:100%;
	font-family: "Open Sans", sans-serif;
}
h1 {
    margin-bottom:20px;
}
h2 {
    font-weight:bold;
    font-size:1.75em;
}
.full-width-box {
	width: 100%;
	height: 350px;
}
.content-box {
	width: 60%;
	margin: 30px auto;
	padding: 5%;
	background-color: #FFF;
}
.content-box h1 {
	font-weight:300;
	font-size: 3em;
}
.content-box p {
	line-height: 1.75em;
}
#closeness {
    margin-top:25px;
}
#find-yours-box #find-yours-form input[type=text] {
	margin: 20px auto;
	padding: 10px;
	width: 100%;
	height:2em;
	font-size: 2em;
	text-align: center;
}
.hidden {
	display:none;
}
</style>