<?php
/*
Plugin Name: Custom Frames
Plugin URI: https://wordpress.org/plugins/custom-frames/
Description: Create custom picture frames with ease.
Version: 1.0.1
Author: Blake
Text Domain: custom-frames
Author URI: http://www.digital-scripts.com/
License: GPLv2 or later
*/

/*
Copyright 2016 Blake (email: staff@digital-scripts.com)

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

define( 'CUSTOMFRAMES_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'CUSTOMFRAMES_VERSION', '1.0.1' );
define( 'CUSTOMFRAMES_MIN_WP_VERSION', '4.5.4' );

register_activation_hook( __FILE__, array( 'customframes', 'customframes_activation' ) );
register_deactivation_hook( __FILE__, array( 'customframes', 'customframes_deactivation' ) );

add_action( 'init', array( 'customframes', 'customframes_init' ) );

include_once( CUSTOMFRAMES_PLUGIN_DIR . 'class.customframes.php' );

if( is_admin() ){
	include_once( CUSTOMFRAMES_PLUGIN_DIR . 'class.customframes-admin.php' );
}