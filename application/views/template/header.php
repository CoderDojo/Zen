<html>
    <head>
        <title><?php
        
        if(isset($dojo_name)) { echo $dojo_name. ' - '; }
        
        ?>CoderDojo Zen</title>
        <meta charset="UTF-8">
        <?php 
            if(isset($dojo_name) && isset($dojo_data) && !empty($dojo_data[0]) && ($dojo_data[0]->private == 1 || $dojo_data[0]->verified != 1)) {
                echo '<meta name="robots" content="noindex, nofollow">'."\n";
            }   
        ?>
        <link rel="stylesheet" href="/static/css/styles.css">
        <link rel="stylesheet" href="/static/css/bootstrap.css">
        <script src="/static/js/jquery.min.js"></script>
        <script src="/static/js/libs/bootstrap-dropdown.js"></script>
        <script type="text/javascript">
            $('.dropdown-toggle').dropdown('toggle');
        </script>
    </head>
    <body>
    <div id="top-bar">
		<div class="wrap">
		    <ul id="menu-top-menu">
                <li><a href="/"><img src="/static/img/cd_logo.png" height="30" style="margin-top: -3px;"></a></li>
                <li><a href="/dojo">Dojo List</a></li>
                <li><a href="/charter">Charter</a></li>
		<?php if (isset($username)) { ?>
                <li><a href="/dojo/my">My Dojos</a></li>
                <li><a href="/dojo/create">Create a Dojo</a></li>
                <?php if($user_data->role == 0): ?>
                <li><a href="#">&bull; Admin:</a></li>
                <li><a href="/admin/dojos">Dojos</a></li>
                <li><a href="/admin">Verify</a></li>
                <li><a href="/admin/stats">Stats</a></li>
                <?php endif; } ?>
            </ul>
            <ul class="fr">
                <?php if (isset($username)) {?>
			    <li><a href="/auth/logout">Logout (<?=$username; ?>)</a></li>
                <?php } else { ?>
                <li><a href="/auth/register">Register</a></li>
                <li><a href="/auth/login">Login</a></li>
                <?php }?>
			</ul>
			<div class="clear"></div>
		</div><!--wrap-->
	</div>