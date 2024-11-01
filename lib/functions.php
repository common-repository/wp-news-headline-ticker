<?php
function register_wpnhtp_page() {
	add_submenu_page( 
	'options-general.php', 
	'Ticker Settings', 
	'Ticker Settings', 
	'manage_options', 
	'wp-news-headline-ticker', 
	'wpnhtp_admin_settings' ); 
}
add_action('admin_menu', 'register_wpnhtp_page');

function wpnhtp_admin_settings() {
	
	echo '<div class="wpnhtp_warp">';
		echo '<h1>News Ticker Settings</h1>';
?>

<div id="wpnhtp_left">
  <form method="post" action="options.php">
    <?php wp_nonce_field('update-options'); ?>
    <div class="inside">
      <h3><?php echo esc_attr(__('Insert your text & background color')); ?></h3>
      <table class="form-table">
        <tr>
          <th><label for="wpnhtp_post_category"><?php echo esc_attr(__('Display Post Category')); ?></label></th>
          <td><select name="wpnhtp_post_category">
              <option value=""><?php echo esc_attr(__('Select Category')); ?></option>
              <?php 
			$categories = get_categories(); 
			foreach ($categories as $category) { ?>
              <option value="<?php echo $category->slug; ?>" <?php if( get_option('wpnhtp_post_category') == $category->slug ){ echo 'selected="selected"'; } ?>><?php echo $category->cat_name; ?> </option>
              <?php } ?>
            </select></td>
        </tr>
        <tr>
          <th><label for="wpnhtp_effect"><?php echo esc_attr(__('Effect Type')); ?></label></th>
          <td><select name="wpnhtp_effect" id="wpnhtp_effect">
              <option value="typing" <?php if( get_option('wpnhtp_effect') == 'typing'){ echo 'selected="selected"'; } ?>>Typing</option>
              <option value="fade" <?php if( get_option('wpnhtp_effect') == 'fade'){ echo 'selected="selected"'; } ?>>Fade</option>
              <option value="slide" <?php if( get_option('wpnhtp_effect') == 'slide'){ echo 'selected="selected"'; } ?>>Slide</option>
            </select></td>
        </tr>
        <tr>
          <th><label for="wpnhtp_number_post"><?php echo esc_attr(__('Number of Post')); ?></label></th>
          <td><input type="text" name="wpnhtp_number_post" value="<?php $wpnhtp_number_post = get_option('wpnhtp_number_post'); if(!empty($wpnhtp_number_post)) {echo $wpnhtp_number_post;} else {echo "10";}?>"></td>
        </tr>
        <tr>
        <tr>
          <th><label for="wpnhtp_order"><?php echo esc_attr(__('Display Order')); ?></label></th>
          <td><select name="wpnhtp_order" id="wpnhtp_order">
              <option value="DESC" <?php if( get_option('wpnhtp_order') == 'DESC'){ echo 'selected="selected"'; } ?>>Descending</option>
              <option value="ASC" <?php if( get_option('wpnhtp_order') == 'ASC'){ echo 'selected="selected"'; } ?>>Ascending</option>
            </select></td>
        </tr>
        
          <th><label for="wpnhtp_border_radius"><?php echo esc_attr(__('Border Radius')); ?></label></th>
          <td><input type="text" name="wpnhtp_border_radius" value="<?php $wpnhtp_border_radius = get_option('wpnhtp_border_radius'); if(!empty($wpnhtp_border_radius)) {echo $wpnhtp_border_radius;} else {echo "15";}?>">
            px;</td>
        </tr>
        <tr>
          <th><label for="wpnhtp_label"><?php echo esc_attr(__('Label Text')); ?></label></th>
          <td><input type="text" name="wpnhtp_label" value="<?php $wpnhtp_label = get_option('wpnhtp_label'); if(!empty($wpnhtp_label)) {echo $wpnhtp_label;} else {echo "Breaking News:";}?>"></td>
        </tr>
        <tr>
          <th><label for="wpnhtp_label_color"><?php echo esc_attr(__('Label Text Color')); ?></label></th>
          <td><input type="text" name="wpnhtp_label_color" id="scrollbar_color" value="<?php $wpnhtp_label_color = get_option('wpnhtp_label_color'); if(!empty($wpnhtp_label_color)) {echo $wpnhtp_label_color;} else {echo "#FFF";}?>" class="color-picker wpnhtp_label_color" /></td>
        </tr>
        <tr>
          <th><label for="wpnhtp_bg_color"><?php echo esc_attr(__('Background Color')); ?><span>*</span></label></th>
          <td><input type="text" name="wpnhtp_bg_color" id="scrollbar_color" value="<?php $wpnhtp_bg_color = get_option('wpnhtp_bg_color'); if(!empty($wpnhtp_bg_color)) {echo $wpnhtp_bg_color;} else {echo "#2d81c8";}?>" class="color-picker wpnhtp_bg_color" /></td>
        </tr>
        <tr>
          <th><label for="wpnhtp_text_color"><?php echo esc_attr(__('Text Color')); ?><span>*</span></label></th>
          <td><input type="text" name="wpnhtp_text_color" id="scrollbar_color" value="<?php $wpnhtp_text_color = get_option('wpnhtp_text_color'); if(!empty($wpnhtp_text_color)) {echo $wpnhtp_text_color;} else {echo "#FFF";}?>" class="color-picker wpnhtp_text_color" /></td>
        </tr>
        <tr>
          <th><label for="wpnhtp_hover_color"><?php echo esc_attr(__('Text Hover Color')); ?></label></th>
          <td><input type="text" name="wpnhtp_hover_color" id="scrollbar_color" value="<?php $wpnhtp_hover_color = get_option('wpnhtp_hover_color'); if(!empty($wpnhtp_hover_color)) {echo $wpnhtp_hover_color;} else {echo "#FFF";}?>" class="color-picker wpnhtp_hover_color" /></td>
        </tr>
      </table>
      <input type="hidden" name="action" value="update" />
      <input type="hidden" name="page_options" value="wpnhtp_post_category, wpnhtp_effect, wpnhtp_number_post, wpnhtp_order, wpnhtp_border_radius, wpnhtp_label,  wpnhtp_label_color, wpnhtp_bg_color, wpnhtp_text_color, wpnhtp_hover_color" />
      <p class="submit">
        <input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" class="button button-primary" />
      </p>
    </div>
  </form>
</div>
<div id="nhtRight">
  <div class="nhtWidget">
    <h3>
      <?php _e('Donate and support the development.','nht') ?>
    </h3>
    <p>
      <?php _e('With your help I can make Simple Fields even better! $5, $10, $100 – any amount is fine! :)','nht') ?>
    </p>
    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
      <input type="hidden" name="cmd" value="_s-xclick">
      <input type="hidden" name="hosted_button_id" value="82C6LTLMFLUFW">
      <input type="image" src="https://www.paypalobjects.com/en_US/GB/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online.">
      <img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
    </form>
  </div>
  <div class="nhtWidget">
    <h3><?php echo esc_attr(__('About the Plugin')); ?></h3>
    <p>You can make my day by submitting a positive review on <a href="https://wordpress.org/support/view/plugin-reviews/wp-news-headline-ticker" target="_blank"><strong>WordPress.org!</strong> <img src="<?php bloginfo('url' ); echo"/wp-content/plugins/wp-news-headline-ticker/img/review.png"; ?>" alt="review" class="review"/></a></p>
    <div class="clrFix"></div>
  </div>
  <div class="nhtWidget">
    <div class="clrFix"></div>
    <h3>About the Author</h3>
    <p>I am a Web Developer, Expert WordPress Developer. I am available for interesting freelance projects. If you ever need my help, do not hesitate to get in touch <a href="https://www.upwork.com/freelancers/~01bf79370d989b2033" target="_blank">me</a>.<br />
      <strong>Skype:</strong> cse.hasib<br />
      <strong>Email:</strong> cse.hasib@gmail.com<br />
      <strong>Web:</strong> <a href="https://www.e2softsolution.com/" target="_blank">E2Soft Solution</a><br />
      <strong>Hire Me on:</strong> <a href="https://www.upwork.com/freelancers/~01bf79370d989b2033" target="_blank">UpWork</a><br />
    <div class="clrFix"></div>
  </div>
</div>
<div class="clrFix"></div>
<?php		
	echo '</div>';
}
