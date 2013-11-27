<div id="content">
    <div class="wrap">
        <div id="main">
            <legend><b><?=$dojo_data[0]->name; ?></b></legend>
			<?php if($dojo_data[0]->stage == 4){ ?>
            <div class="alert alert-error"><b>Dojo inactive</b>: This means we have contacted the Dojo and they have told us they are no longer running, or they did not respond.</div>
            <?php } ?>
            <table class="table" style="margin-left: 30px;">
                <?php if($dojo_data[0]->time){ ?>
                <tr>
                    <td style="width: 25px;"><b>Time</b></td>
                    <td><?=$dojo_data[0]->time; ?></td>
                </tr>
                <?php } if($dojo_data[0]->location) { ?>
                <tr>
                    <td style="width: 25px;"><b>Location</b></td>
                    <td><?=$dojo_data[0]->location; ?></td>
                </tr>
                <?php } ?>
                <tr>
                    <td style="width: 25px;"><b>Country</b></td>
                    <td><?=get_country_name($dojo_data[0]->country);?></td>
                </tr>
                <?php if($dojo_data[0]->notes) { ?>
                <tr>
                    <td style="width: 25px;"><b>Notes</b></td>
                    <td><?=$dojo_data[0]->notes; ?></td>
                </tr>
                <?php } ?>
            </table>

            <?php if($dojo_data[0]->coordinates) {?>
            <legend>Map</legend>
            <iframe width="550" height="250" style="margin-left: 37px; frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=<?=$dojo_data[0]->coordinates; ?>&amp;aq=&amp;sll=<?=$dojo_data[0]->coordinates; ?>&amp;sspn=0.002453,0.00618&amp;ie=UTF8&amp;t=h&amp;z=17&amp;ll=<?=$dojo_data[0]->coordinates; ?>&amp;output=embed"></iframe><br /><small><a style="margin-left: 483px;" href="http://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=<?=$dojo_data[0]->coordinates; ?>&amp;aq=&amp;sll=<?=$dojo_data[0]->coordinates; ?>&amp;sspn=0.002453,0.00618&amp;ie=UTF8&amp;t=h&amp;z=17&amp;ll=<?=$dojo_data[0]->coordinates; ?>" style="color:#0000FF;text-align:left" >View Larger Map</a></small>
            <?php } if($dojo_data[0]->eb_id) { ?>
            <legend>Booking</legend>
            <div style="width:550px; text-align:left; margin-left: 37px;">
                <iframe  src="http://www.eventbrite.com/tickets-external?eid=<?=$dojo_data[0]->eb_id; ?>&ref=etckt" frameborder="0" height="224" width="100%" vspace="0" hspace="0" marginheight="5" marginwidth="5" scrolling="auto" allowtransparency="true"></iframe>
            </div>
            <?php } if($dojo_data[0]->supporter_image) { ?>
            <legend>Dojo Supported By</legend>
            <div>
                <img src="<?=$dojo_data[0]->supporter_image;?>"  alt="" style="max-height: 200px; max-width: 570px;"/>
            </div>
            <?php } ?>
        </div><!--#main-->

        <div id="sidebar">

            <div class="widget" id="widget-status">
                <legend>Status</legend>
                 <?php if($dojo_data[0]->verified != 1){?>
                <div class="alert"><b>Not verified</b> <a href="http://kata.coderdojo.com/index.php?title=Unverified_Dojo_Listing" target="_blank">Learn more...</a> </div>
                 <?php } if($dojo_data[0]->stage == 0){?>
                <div class="alert alert-info"><b>In planning</b></div>
                <?php } if($dojo_data[0]->stage == 1){?>
                <div class="alert alert-success"><b>Active</b> Just show up</div>
                <?php } if($dojo_data[0]->stage == 2){?>
                <div class="alert alert-info"><b>Register ahead</b></div>
                <?php } if($dojo_data[0]->stage == 3){?>
                <div class="alert alert-error"><b>Dojo full sorry</b></div>
                <?php } if($dojo_data[0]->stage != 4 && $dojo_data[0]->need_mentors == 1){?>
                <div class="alert alert-warning"><b>Mentors needed!</b></div>
                <?php }?>
            </div><!--widget-status-->

            <?php
            if($is_admin) {
            echo '<div class="widget" id="widget-admin">
                <legend>Admin tasks</legend>
                <table class="table">
                    <tr>
                        <td><b>Verified at</b></td>
                        <td>'.($dojo_data[0]->verified_at?:'Unknown').'</td>
                    </tr>
                    <tr>
                        <td><b>Verified by</b></td>
                        <td>'.($verified_by?:'Unknown').'</td>
                    </tr>
                    <tr>
                        <td><b>Edit dojo</b></td>
                        <td><a href="/admin/edit/'.$dojo_data[0]->id.'">Edit</a></td>
                    </tr>
                </table>
            </div><!--widget-admin-->';
            }
            ?>

            <div class="widget" id="widget-contact">
                <legend>Contact</legend>
                <table class="table">
                    <tr>
                        <td><b>Email</b></td>
                        <td><a href="mailto:<?=$dojo_data[0]->email; ?>"><?=$dojo_data[0]->email; ?></a></td>
                    </tr>
                    <?php if($dojo_data[0]->twitter){?>
                    <tr>
                        <td><b>Twitter</b></td>
                        <td><a href="http://twitter.com/<?=$dojo_data[0]->twitter; ?>">@<?=$dojo_data[0]->twitter; ?></a></td>
                    </tr>
                    <?php } if($dojo_data[0]->website){?>
                    <tr>
                        <td><b>Website</b></td>
                        <td><a href="<?=$dojo_data[0]->website; ?>"><?=$dojo_data[0]->website; ?></a></td>
                    </tr>
                    <?php } if($dojo_data[0]->google_group){?>
                    <tr>
                        <td><b>Google Group</b></td>
                        <td><a href="<?=$dojo_data[0]->google_group; ?>">http://group.go.....</a></td>
                    </tr>
                    <?php } ?>
                </table>
            </div><!--widget-contact-->
        </div>
    </div><!--.wrap-->
</div><!--#content-->