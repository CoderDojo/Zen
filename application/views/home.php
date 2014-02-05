<div id="map-box" class="full-width-box">
</div>

<div id="find-yours-box" class="content-box">
	<h1>Find your Dojo</h1>
	<p>Just enter your exact (closest town, or exact address) location in the box below and we'll find your closest dojo</p>
	<div id="find-yours-form">
		<input type="text" id="location" placeholder="Where are you?">
	</div>
	<div id="closeness" class="hidden">
	    <h1 style="line-height:2em;" id="closest-title">Your dojo is</h1>
	    <h2 style="line-height:1.7em;" id="closest-location"><a href="#">{{placeholder}}</a> which is 20KM away</h2>
	</div>
</div>
<div id="found-yours-box" class="content-box hidden">
	<h2 style="line-height:2em;">The Dojo you selected is</h2>
	<h1 style="line-height:1.7em;"><a href="/dojo/{{dojo.id}}" id="founddojoname">{{dojo.name}}</a></h1>
</div>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="/static/js/geolib.js"></script>
<script type="text/javascript" src="/static/js/markercluster.js"></script>
<script type="text/javascript">
var map;
var markers = [];
var markerClusterer = null;
var geocoder;
var data;

function refreshMap() {
  if (markerClusterer) {
    markerClusterer.clearMarkers();
  }

  var markers = [];

  for (var i in data) {
    var latLng = new google.maps.LatLng(data[i].latitude,
        data[i].longitude)
    var marker =     new google.maps.Marker({
    			dojoId: data[i],
    	    position: new google.maps.LatLng(data[i].latitude,data[i].longitude),
    	    map: map,
    	    title: i,
    		clickable: true,
    		icon: {
    		    url: "http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|"+(data[i].private?'FF3333':'33FF33')
		    }
    	  });
    google.maps.event.addListener(marker, 'click', function() {
        console.log(this);
		var findYours = document.getElementById('find-yours-box');
		findYours.className = findYours.className + " hidden";
		var foundYours = document.getElementById('found-yours-box');
		foundYours.className = foundYours.className.replace("hidden", "");
		document.getElementById('founddojoname').innerHTML = this.title + (this.dojoId.private?" <b>(PRIVATE)</b>":"");
		document.getElementById('founddojoname').href = "/dojo/"+this.dojoId.id;
    });
    markers.push(marker);
  }
  
  markerClusterer = new MarkerClusterer(map, markers, {
    maxZoom: 10,
    gridSize: 50,
  });
}

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
  refreshMap()
}

function DojoList(dojos) {
	data = dojos;
}

function codeAddress(myLocation) {
  ga('send', 'event', 'Dojos', 'Search', myLocation);
  var address = myLocation;
  geocoder.geocode( { 'address': address}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
        if(results[0].geometry.bounds) {
            map.fitBounds(results[0].geometry.bounds);
            var dojos = new Array();
            var num = 0;
            for(var i in data) {
                if(results[0].geometry.bounds.contains(new google.maps.LatLng(data[i].latitude, data[i].longitude))) {
    	            dojos[i] = data[i];
    	            num++;
	            }
            }
            if(num == 0) {
                var closest = geolib.findNearest({
    		        latitude: results[0].geometry.location.lat(),
    		        longitude: results[0].geometry.location.lng()
    	        },data);
    	        map.setCenter(new google.maps.LatLng(closest.latitude,closest.longitude));
            	  map.setZoom(15);
    	        var close = "<h1 style='line-height:2em;'>Your closest dojo is:</h1>";
    	        close += "<h2 style='line-height:1.7em;'><a href='/dojo/"+data[closest.key].id+"'>"+closest.key+"</a> which is "+(closest.distance/1000).toFixed(1)+"KM away.</h2>";
                document.getElementById('closeness').innerHTML = close;
    	        document.getElementById('closeness').style.display = "inherit";
            } else if(num > 1) {
	            var close = "<h1>Your closest dojos are:</h1><br/><ul style='list-style:none'>";
                for(var dojo in dojos) {
                    close += "<li><a href='/dojo/"+dojos[dojo].id+"'>" + dojo + "</a> "+(dojos[dojo].private?"<b>(PRIVATE)</b>":"")+"</li>";
                }
                close += "</ul>";
            } else {
	            var close = "<h1 style='line-height:2em;'>Your closest dojo is:</h1>";
                for(var dojo in dojos) {
                    map.setCenter(new google.maps.LatLng(dojos[dojo].latitude,dojos[dojo].longitude));
                	  map.setZoom(15);
                    close += "<h2 style='line-height:1.7em;'><a href='/dojo/"+dojos[dojo].id+"'>" + dojo + "</a> "+(dojos[dojo].private?"<b>(PRIVATE)</b>":"")+"</h2>";
                }
            }
            document.getElementById('closeness').innerHTML = close;
            document.getElementById('closeness').style.display = "inherit";
	    } else {
	        var closest = geolib.findNearest({
		        latitude: results[0].geometry.location.lat(),
		        longitude: results[0].geometry.location.lng()
	        },data);
	        map.setCenter(new google.maps.LatLng(closest.latitude,closest.longitude));
        	  map.setZoom(15);
	        var close = "<h1 style='line-height:2em;'>Your closest dojo is:</h1>";
	        close += "<h2 style='line-height:1.7em;'><a href='/dojo/"+data[closest.key].id+"'>"+closest.key+"</a> "+(data[closest.key].private?"<b>(PRIVATE)</b>":"")+" which is "+(closest.distance/1000).toFixed(1)+"KM away.</h2>";
            document.getElementById('closeness').innerHTML = close;
	        document.getElementById('closeness').style.display = "inherit";
	    }
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
<script type="text/javascript" src="/dojo/json?callback=DojoList"></script>
<style type="text/css">
@import url(//fonts.googleapis.com/css?family=Open+Sans:400,600,700,300);

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