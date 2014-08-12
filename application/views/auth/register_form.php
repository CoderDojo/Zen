<?php
if ($use_username) {
	$username = array(
		'name'	=> 'username',
		'id'	=> 'username',
		'value' => set_value('username'),
		'maxlength'	=> $this->config->item('username_max_length', 'tank_auth'),
		'size'	=> 30,
	);
}
$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'value'	=> set_value('email'),
	'maxlength'	=> 80,
	'size'	=> 30,
);
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'value' => set_value('password'),
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
);
$confirm_password = array(
	'name'	=> 'confirm_password',
	'id'	=> 'confirm_password',
	'value' => set_value('confirm_password'),
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8,
);
?>
<div id="content">
    <div class="wrap">
        <div id="main">
            <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
            <legend>Register For Zen</legend>

            <?php if ($use_username) { ?>
            <div class="control-group">
                <label class="control-label" for="username">Username</label>
                <div class="controls">
                    <input type="text" class="input-xlarge" id="username" name="username" value="<?=$username['value'];?>">
                    <p class="help-block"><font color="red"> <?php echo form_error($username['name']); ?><?php echo isset($errors[$username['name']])?$errors[$username['name']]:''; ?></font></p>
                </div>
            </div>
            <?php } ?>

            <div class="control-group">
                <label class="control-label" for="email">Email Address</label>
                <div class="controls">
                    <input type="text" class="input-xlarge" id="email" name="email" value="<?=$email['value'];?>">
                    <p class="help-block"><font color="red"><?php echo form_error($email['name']); ?><?php echo isset($errors[$email['name']])?$errors[$email['name']]:''; ?></font></p>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="password">Password</label>
                <div class="controls">
                    <input type="password" class="input-xlarge" id="password" name="password" value="<?=$password['value'];?>">
                    <p class="help-block"><font color="red"><?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?></font></p>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="confirm_password">Confirm Password</label>
                <div class="controls">
                    <input type="password" class="input-xlarge" id="confirm_password" name="confirm_password" value="<?=$confirm_password['value'];?>">
                    <p class="help-block"><font color="red"><?php echo form_error($confirm_password['name']); ?><?php echo isset($errors[$confirm_password['name']])?$errors[$confirm_password['name']]:''; ?></font></p>
                </div>
            </div>

            <?php if($use_recaptcha): ?>
             <div class="control-group">
                <label class="control-label" for="recaptcha_response_field">Are you human?</label>
                <div class="controls">
                    <div id="recaptcha_image"></div>

                    <input type="text" style="margin-top: 12px;" class="input-xlarge" id="recaptcha_response_field" name="recaptcha_response_field">
                    <p class="help-block">
                        <div class="recaptcha_only_if_image">Enter the words above &bull; <a href="javascript:Recaptcha.reload()">Get another CAPTCHA</a></div>
                        <div class="recaptcha_only_if_audio">Enter the numbers you hear &bull; <a href="javascript:Recaptcha.reload()">Get another CAPTCHA</a></div>
                        <div class="recaptcha_only_if_image" style="margin-left: 145px;">&bull;<a href="javascript:Recaptcha.switch_type('audio')"> Get an audio CAPTCHA</a></div>
                        <div class="recaptcha_only_if_audio" style="margin-left: 145px;">&bull;<a href="javascript:Recaptcha.switch_type('image')"> Get an image CAPTCHA</a></div>

                        <font color="red"><?php echo form_error('recaptcha_response_field'); ?></font>
                    </p>
                    <?php echo $recaptcha_html; ?>
                </div>
            </div>
            <?php endif; ?>

            <div class="control-group">
                <div class="controls">
                    <input class="btn-primary" style="padding: 5px 108px;" type="submit" name="register" value="Register">
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
        <div id="sidebar">
            <div class="widget">
                <legend>Why?</legend>
                <p>Once registered and activated, you'll be able to create a new dojo listing.</p>
            </div>
        </div>
    </div><!--.wrap-->
</div><!--#content-->
