<?php
/*
Plugin Name: Coduri Postale Romania
Plugin URI: http://www.bluebay.ro/wp-plugin-coduri-postale
Description: Zip codes for any location from Romania.
Author: Bluebay Design
Author URI: http://www.bluebay.ro
Version: 1.0.1
Text Domain: coduri-postale

*/

//Define plugin directory
define('CODURIPOSTALE_PLUGIN_URL', plugin_dir_path( __FILE__ ));

//Include needed files for plugin
include CODURIPOSTALE_PLUGIN_URL . 'widget.php';
wp_register_style('coduri-postale-style', plugins_url('style.css',__FILE__ ));
wp_enqueue_style('coduri-postale-style');
?>
