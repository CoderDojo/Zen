<?php
$dojo_name = array(
	'name'	=> 'dojo_name',
	'id'	=> 'dojo_name',
	'value'	=> $dojo_data[0]->name,
	'maxlength'	=> 100,
	'size'	=> 30,
);
$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'value'	=> $dojo_data[0]->email,
	'maxlength'	=> 100,
	'size'	=> 30,
);
$times = array(
	'name'	=> 'time',
	'id'	=> 'time',
	'value'	=> $dojo_data[0]->time,
	'maxlength'	=> 100,
	'size'	=> 30,
);

$country = array(
	'name'	=> 'country',
	'id'	=> 'country',
	'maxlength'	=> 100,
	'value' => $dojo_data[0]->country,
	'size'	=> 30,
);
$location = array(
	'name'	=> 'location',
	'id'	=> 'location',
	'value'	=> $dojo_data[0]->location,
	'maxlength'	=> 100,
	'size'	=> 30,
);

$coordinates = array(
	'name'	=> 'coordinates',
	'id'	=> 'coordinates',
	'value'	=> $dojo_data[0]->coordinates,
	'maxlength'	=> 100,
	'size'	=> 30,
);

$google_group = array(
	'name'	=> 'google_group',
	'id'	=> 'google_group',
	'value'	=> $dojo_data[0]->google_group,
	'maxlength'	=> 200,
	'size'	=> 30,
);
$website = array(
	'name'	=> 'website',
	'id'	=> 'wesbite',
	'value'	=> $dojo_data[0]->website?:'',
	'maxlength'	=> 100,
	'size'	=> 30,
);
$twitter = array(
	'name'	=> 'twitter',
	'id'	=> 'twitter',
	'value'	=> $dojo_data[0]->twitter,
	'maxlength'	=> 100,
	'size'	=> 30,
);
$default_note = "<ul><li>A pack lunch, there are no shops near the NSC.</li><li>If you have one, a laptop. If not we have machines that you can use.<em><br></em></li><li><strong>A parent! (Very important). If you are 12 or under, your parent must stay with you during the session.</strong></li></ul>";

$notes = array(
	'name'	=> 'notes',
	'id'	=> 'notes',
	'value'	=> $dojo_data[0]->notes,
	'maxlength'	=> 100,
	'size'	=> 30,
);

$eb_id = array(
	'name'	=> 'eb_id',
	'id'	=> 'eb_id',
	'value'	=> $dojo_data[0]->eb_id,
	'maxlength'	=> 100,
	'size'	=> 30,
);

$need_mentors = array(
    'name'        => 'need_mentors',
    'id'          => 'need_mentors',
    'value'       => 1,
    'checked'     => $dojo_data[0]->need_mentors,
    'style'       => 'margin:10px',
    );

$stage = array(
    'name'        => 'stage',
    'id'          => 'stage',
    'style' => 'margin-top: 4px;',
    );
    
$private = array(
    'name'        => 'private',
    'id'          => 'private',
    'value'       => 1,
    'checked'     => set_checkbox('private', 1, $dojo_data[0]->private?TRUE:FALSE),
    'style'       => 'margin:10px',
    );


$supporter_image = array(
	'name'	=> 'supporter_image',
	'id'	=> 'supporter_image',
	'value'	=> $dojo_data[0]->supporter_image,
	'maxlength'	=> 200,
	'size'	=> 30,
);
?>
<div id="content">
    <div class="wrap">      
        <form method="post" action="/<?=((isset($is_admin) && $is_admin)?'admin':'dojo')?>/edit/<?=$id?>" class="form-horizontal">
            <div id="main">
                <fieldset>
                    <legend>Dojo Information</legend>
                    <div class="control-group">
                        <label class="control-label" for="dojo_name">Dojo Name</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge" id="dojo_name" name="dojo_name" value="<?=$dojo_name['value'];?>">
                            <div class="error-text"> <?php echo form_error($dojo_name['name']); ?><?php echo isset($errors[$dojo_name['name']])?$errors[$dojo_name['name']]:''; ?></div><p class="help-block"> Normally after an area, like <i>"Cork"</i> or multiple Dojos are in your area <i>"San Fran @ GitHub"</i>. Try refrain from prefixing the name with <i>"CoderDojo"</i>.</p>

                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="email">Email</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge" id="email" name="email" value="<?=$email['value'];?>">
                            <div class="error-text"> <?php echo form_error($email['name']); ?><?php echo isset($errors[$email['name']])?$errors[$email['name']]:''; ?></div>
                            <p class="help-block">This should be different to the personal email you signed up for an account here with. For your own CoderDojo email address (Eg. <i>limerick.ie@coderdojo.com</i>), please <a href="mailto:enquiries@coderdojo.com">contact us</a>.</p>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="time">Times</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge" id="time" name="time" value="<?=$times['value'];?>">
                            <div class="error-text"> <?php echo form_error($times['name']); ?><?php echo isset($errors[$times['name']])?$errors[$times['name']]:''; ?></div><p class="help-block"> State whether its every week or on a certain day (Eg. <i>"Every Friday, 5.30pm - 8pm"</i> or <i>"Saturday 25th, 12pm - 3pm"</i>)</p>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="location">Location</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge" id="location" name="location" value="<?=$location['value'];?>">
                           <div class="error-text"><?php echo form_error($location['name']); ?><?php echo isset($errors[$location['name']])?$errors[$location['name']]:''; ?></div> <p class="help-block">Address of the Dojo (Eg. <i>LIT Downtown Centre, George's Quay, Limerick</i>)</p>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="country">Country</label>
                        <div class="controls">
                          <?=form_dropdown('country', array_merge(array(''=>'Select country...'), get_countries()), $dojo_data[0]->country, 'style="width:270px;" id="country"');?>
                              <p class="help-block"><div class="error-text"> <?php echo form_error($country['name']); ?><?php echo isset($errors[$country['name']])?$errors[$country['name']]:''; ?></div></p>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="coordinates">Coordinates</label>
                        <div class="controls">
                            <input type="button" class="btn btn-primary btn-large" id="guessAddress" value="Get location from address" style="margin-bottom:10px;">
                          <div id="mapCanvas" style="height:350px;width:425px;margin-bottom:10px;"></div>
                           <input type="text" class="input-xlarge" id="coordinates" name="coordinates" value="<?=$coordinates['value'];?>">
                           <input type="button" class="btn btn-primary" id="getCoords" value="Get from Map">
                           <div class="error-text"><?php echo form_error($coordinates['name']); ?><?php echo isset($errors[$coordinates['name']])?$errors[$coordinates['name']]:''; ?></div><p class="help-block">Coordinates of Dojo Location for Google Map (Eg. <i>51.888054,-8.403111</i>), <a href="http://kata.coderdojo.com/index.php?title=Dojo_Coordinates" target="_blank">Guide to getting co-ordinates here</a>; Leave blank for no map </p>
                        </div>
                    </div>
                    

                        <div class="control-group">
                            <label class="control-label" for="notes">Notes</label>
                            <div class="controls">
                                <textarea class="input-xlarge" id="notes" name="notes" rows="3" cols="3" style="height:100px; resize: vertical;" ><?=$notes['value'];?></textarea>
                                <div class="error-text"><?php echo form_error($notes['name']); ?><?php echo isset($errors[$notes['name']])?$errors[$notes['name']]:''; ?></div><p class="help-block">Dojo rules, where you are at in the setup, location notes, etc. (HTML supporte)d</p>
                            </div>
                        </div>

                    <legend>Other Information</legend>

                        <div class="control-group">
                            <label class="control-label" for="google_group">Google Group URL</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" id="google_group" name="google_group" value="<?=$google_group['value'];?>">
                                <div class="error-text"> <?php echo form_error($google_group['name']); ?><?php echo isset($errors[$google_group['name']])?$errors[$google_group['name']]:''; ?></div>
                                <p class="help-block">We recommend setting up a Discussion group so people can sign up for latest happenings and news and contribute.</p>
                            </div>
                      </div>
                      <div class="control-group">
                            <label class="control-label" for="website">Website</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" id="website" name="website" value="<?=$website['value'];?>">
                              <div class="error-text"> <?php echo form_error($website['name']); ?><?php echo isset($errors[$website['name']])?$errors[$website['name']]:''; ?></div>
                            </div>
                      </div>
                      <div class="control-group">
                            <label class="control-label" for="twitter">Twitter</label>
                            <div class="controls">
                              <div class="input-prepend">
                                <span class="add-on">@</span>
                                <input class="span2" id="twitter" name="twitter" style="width:243px" size="16" type="text" value="<?=$twitter['value'];?>">
                              </div>
                              <div class="error-text"> <?php echo form_error($twitter['name']); ?><?php echo isset($errors[$twitter['name']])?$errors[$twitter['name']]:''; ?></div>
                              <p class="help-block">Again, a useful way for sharing information and being found. We can also help share messages to followers.</p>

                            </div>
                      </div>
                    <div class="control-group">
                        <label class="control-label" for="eb_id">EventBrite Event ID</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge" id="eb_id" name="eb_id" value="<?=$eb_id['value'];?>">
                            <div class="error-text"><?php echo form_error($eb_id['name']); ?><?php echo isset($errors[$eb_id['name']])?$errors[$eb_id['name']]:''; ?></div><p class="help-block">If EventBrite, enter your event id (Eg. <i>3014403161</i>) to embed, <a href="http://kata.coderdojo.com/index.php?title=Eventbrite_event_id">how to find event id</a>, otherwise leave blank for no booking widget</p>
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="controls">
                            <input type="submit" class="btn-primary" value="Update Dojo Listing" style="padding: 5px 75px;">
                        </div>
                    </div>
                </fieldset>
            </div>
            <div id="sidebar">
                <div class="widget" id="widget-status">
                    <legend>Status Messages</legend>
                        <div class="control-group" style="margin-left: -40px;">
                            <label class="control-label" for="need_mentors">Need Mentors</label>
                            <div class="controls">
                                <label class="checkbox inline" style="margin-top: -5px; margin-left: -28px;">
                                    <?=form_checkbox($need_mentors);?>
                                </label>
                            </div>
                        </div>


                    <div class="control-group" style="margin-left: -40px;">
                        <label class="control-label">Current Stage</label>
                         <div class="controls">
                          <label class="radio">
                            <?=form_radio($stage, 0, set_radio('stage', '0', ($dojo_data[0]->stage==0)?TRUE:''));?>
                            In planning
                          </label>
                          <label class="radio">
                            <?=form_radio($stage, 1, set_radio('stage', '1', ($dojo_data[0]->stage==1)?TRUE:''));?>
                            Open, come along
                          </label>
                          <label class="radio">
                            <?=form_radio($stage, 2, set_radio('stage', '2', ($dojo_data[0]->stage==2)?TRUE:''));?>
                            Register ahead
                          </label>
                          <label class="radio">
                            <?=form_radio($stage, 3, set_radio('stage', '3', ($dojo_data[0]->stage==3)?TRUE:''));?>
                            Full up
                          </label>
								  <?php if(isset($is_admin) && $is_admin == true): ?>
                          <label class="radio">
                            <?=form_radio($stage, 4, set_radio('stage', '4', ($dojo_data[0]->stage==4)?TRUE:''));?>
                            Inactive
                          </label>
							  	  <?php endif; ?>
                        </div>
                    </div>
                    <div class="control-group" style="margin-left: -40px;">
                        <label class="control-label" for="private">Private</label>
                        <div class="controls">
                            <label class="checkbox inline" style="margin-top: -5px; margin-left: -28px;">
                                <?=form_checkbox($private);?>
                            </label>
                            <p class="help-block">Please only select if your Dojo will be accessible exclusively to attendees from within your organisation. eg. schools/universities/children of organisation's employees etc.</p>
                        </div>
                    </div>
                </div>
                <div class="widget" id="widget-supporters">
                    <legend>Supporters Image URL</legend>
                        <input type="text" class="input-xlarge" id="supporter" name="supporter_image" value="<?=$supporter_image['value'];?>">
                        <p class="help-block">If you have a Dojo supporter(s), if they are providing space/wifi/pizza and would like to show it, enter URL to a supporter image here, please make sure its 570x200 pixels, otherwise leave blank</p>

                  </div>
                </div>
            </div>
        </form>
    </div><!--.wrap-->
</div><!--#content-->
<script type="text/javascript" src="/static/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace( 'notes' );
</script>
<script type="text/javascript" src="//maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
var map, marker;
var geocoder = new google.maps.Geocoder();
var coords = new google.maps.LatLng(<?=$coordinates['value']?:'42.5,-36.2';?>);

function init() {
  // Setup Map and Marker
  map = new google.maps.Map(document.getElementById('mapCanvas'), {
    zoom: <?=$coordinates['value']?18:2;?>,
    center: coords,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });
  marker = new google.maps.Marker({
    position: coords,
    title: 'My Dojo',
    map: map,
    draggable: true
  });
  
  // Setup events
  google.maps.event.addListener(marker, 'drag', function() {
    updateCoordinateInput(marker.getPosition());
  });
  document.getElementById('guessAddress').onclick = function(){
    var c = document.getElementById('country');
    var country = c.options[c.selectedIndex].innerHTML;
    codeAddress(document.getElementById('location').value+", "+country);
  };
  document.getElementById('getCoords').onclick = function() {
    updateCoordinateInput(marker.getPosition());
  };
}

function updateMap(ll) {
  map.setCenter(ll);
  marker.setPosition(ll);
  map.setZoom(17);
}

function updateCoordinateInput(ll) {
  document.getElementById('coordinates').value = [
    ll.lat(),
    ll.lng()
  ].join(',');
}

function codeAddress(address) {
  geocoder.geocode( { 'address': address}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      var ll = results[0].geometry.location;
      updateMap(ll);
      updateCoordinateInput(ll)
	  } else {
      alert("Geocode was not successful for the following reason: " + status);
      return false;
    }
  });
}

google.maps.event.addDomListener(window, 'load', init);
</script>
