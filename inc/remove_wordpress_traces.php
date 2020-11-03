<?php
// Admin footer modification
function remove_footer_admin ()
{
echo '<span id="footer-thankyou">توسعه توسط  <a href="http://www.codart.com" target="_blank">حمزه پورشبانان</a></span>';
}
add_filter('admin_footer_text', 'remove_footer_admin');

// Hide the "Please update now" notification
function hide_update_notice() {
get_currentuserinfo();
if (get_current_user_id() != 1) {
remove_action( 'admin_notices', 'update_nag', 3 );
}
}
add_action( 'admin_notices', 'hide_update_notice', 1 );

// Remove wordpress logo from admin bar
function example_admin_bar_remove_logo() {
if (get_current_user_id() != 1) {
global $wp_admin_bar;
$wp_admin_bar->remove_menu( 'wp-logo' );
    $wp_admin_bar->remove_menu( 'updates' );
}

}
add_action( 'wp_before_admin_bar_render', 'example_admin_bar_remove_logo', 0 );


function remove_dashboard_meta() {
if (get_current_user_id() != 1) {
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal'); //Removes the 'incoming links' widget
    remove_meta_box('dashboard_plugins', 'dashboard', 'normal'); //Removes the 'plugins' widget
    remove_meta_box('dashboard_primary', 'dashboard', 'normal'); //Removes the 'WordPress News' widget
    remove_meta_box('dashboard_secondary', 'dashboard', 'normal'); //Removes the secondary widget
    remove_meta_box('dashboard_right_now', 'dashboard', 'normal'); //Removes the 'At a Glance' widget
}

}
add_action('admin_init', 'remove_dashboard_meta');

function remove_wordpress_version() {
    return '';
}
add_filter('the_generator', 'remove_wordpress_version');

?>