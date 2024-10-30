<?php
echo '<br/>';
echo '<h2>Like This Post Options</h2>';
$show_ajax_notify = get_option('ltp_show_ajax_notify');
$loginplease = get_option('ltp_login_message');
$thanksforlike = get_option('ltp_thanks_message');
$alreadylikes = get_option('ltp_already_liked_message');
$show_only_count = get_option('ltp_show_only_count');
$ltp_like_color = get_option('ltp_like_color');
$unlikeprevious = get_option('ltp_unlike_previous');
$unlikemessage = get_option('ltp_unlike_message');

?>
<div>
	<div class="left-side-box">
		<form method="post" action="options.php">
			<?php settings_fields('ltp_options'); ?>
			<div class="ltp-each-section">
				<label class="main-descpn">Show Ajax Notifications on Like</label>
				<input type="radio" name="ltp_show_ajax_notify" id="ltp_show_ajax_notify_y" value="1" <?php if($show_ajax_notify == 1) { echo 'checked';} ?> />
				<label for="ltp_show_ajax_notify_y">Yes</label>
				<input type="radio" name="ltp_show_ajax_notify" id="ltp_show_ajax_notify_n" value="0" <?php if($show_ajax_notify == 0) { echo 'checked';} ?> />
				<label for="ltp_show_ajax_notify_n">No</label>
			</div>
			<div class="ltp-each-section">
				<label class="main-descpn">Un Like On Second Click</label>
				<input type="radio" name="ltp_unlike_previous" id="ltp_unlike_previous_y" value="1" <?php if($unlikeprevious == 1) { echo 'checked';} ?> />
				<label for="ltp_unlike_previous_y">Yes</label>
				<input type="radio" name="ltp_unlike_previous" id="ltp_unlike_previous_n" value="0" <?php if($unlikeprevious == 0) { echo 'checked';} ?> />
				<label for="ltp_unlike_previous_n">No</label>
			</div>
			<div class="ltp-each-section">
				<label class="main-descpn" for="ltp_unlike_message">Un Like Notification</label>
				<input type="text" size="25" name="ltp_unlike_message" id="ltp_unlike_message" value="<?php echo $unlikemessage; ?>" />
				<span class="description">Message Shown to login for like when clicking on like button</span><br/>
			</div>
			<div class="ltp-each-section">
				<label class="main-descpn" for="ltp_login_message">Login Required Notification</label>
				<input type="text" size="25" name="ltp_login_message" id="ltp_login_message" value="<?php echo $loginplease; ?>" />
				<span class="description">Message Shown to login for like when clicking on like button</span><br/>
			</div>
			<div class="ltp-each-section">
				<label class="main-descpn" for="ltp_thanks_message">Thanks Notification</label>
				<input type="text" size="25" name="ltp_thanks_message" id="ltp_thanks_message" value="<?php echo $thanksforlike; ?>" />
				<span class="description">Message Shown to thanks for their likes</span>
			</div>
			<div class="ltp-each-section">
				<label class="main-descpn" for="ltp_already_liked_message">Already Liked Notification</label>
				<input type="text" size="25" name="ltp_already_liked_message" id="ltp_already_liked_message" value="<?php echo $alreadylikes; ?>" />
				<span class="description">Message Shown that already the current user liked the post</span>
			</div>
			<div class="ltp-each-section">
				<label class="main-descpn">Show Only Counts</label>
				<input type="radio" name="ltp_show_only_count" id="ltp_show_only_count_y" value="1" <?php if($show_only_count == 1) { echo 'checked';} ?> />
				<label for="ltp_show_only_count_y">Yes</label>
				<input type="radio" name="ltp_show_only_count" id="ltp_show_only_count_n" value="0" <?php if($show_only_count == 0) { echo 'checked';} ?> />
				<label for="ltp_show_only_count_n">No</label>
				<span class="description" style="margin-left: 129px">Hide the Names of People who like the Posts</span>
			</div>
			<div class="ltp-each-section">
				<label class="main-descpn" for="ltp_like_color">Customize your color for like button</label>
				<input type="text" value="<?php echo $ltp_like_color; ?>" class="my-color-field" data-default-color="#effeff" name="ltp_like_color" id="ltp_like_color" />
			</div>
			<div class="ltp-each-section">
				<input class="button-primary" type="submit" name="Save" value="<?php _e('Save Options', 'ltp-like-post'); ?>" /><br/>
			</div>
		</form>
	</div>
	<div class="right-side-box">
		<!-- Paypal Donation Box -->
	</div>
</div>