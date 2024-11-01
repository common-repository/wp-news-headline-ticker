<?php function wpnhtp_dynamic_css()
{ ?>
<style type="text/css">
.wpnhtp_body {
 background: <?php $wpnhtp_bg_color = get_option('wpnhtp_bg_color');
if(!empty($wpnhtp_bg_color)) {
echo $wpnhtp_bg_color;
}
else {
echo "#2d81c8";
}
?>;
 border-radius:<?php $wpnhtp_border_radius = get_option('wpnhtp_border_radius');
if(!empty($wpnhtp_border_radius)) {
echo $wpnhtp_border_radius;
}
else {
echo "15";
}
?>px;
}
.wpnhtp_body ul {
	margin: 0;
	padding: 0;
}
.fade, .slide {
 background: <?php $wpnhtp_bg_color = get_option('wpnhtp_bg_color');
if(!empty($wpnhtp_bg_color)) {
echo $wpnhtp_bg_color;
}
else {
echo "#2d81c8";
}
?>;
}
.typing {
	padding-left: 18px;
}
.fade > li, .slide > li, .typing > li {
	list-style: none inside none;
}
.label {
color:<?php $wpnhtp_label_color = get_option('wpnhtp_label_color');
if(!empty($wpnhtp_label_color)) {
echo $wpnhtp_label_color;
}
else {
echo "#FFF";
}
?>;
font-weight:bold;
font-size:15px;
}
.wpnhtp_body ul li a {
color:<?php $wpnhtp_hover_color = get_option('wpnhtp_hover_color');
if(!empty($wpnhtp_hover_color)) {
echo $wpnhtp_hover_color;
}
else {
echo "#FFF";
}
?>;
border:0 none !important;
}
</style>
<?php 
}
add_action('wp_footer','wpnhtp_dynamic_css', 100);
?>