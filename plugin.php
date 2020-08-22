<?php
/**
 * Plugin Name: NFL Teams
 * Plugin URI: https://github.com/CesarReyes/resulta-nfl-teams
 * Description: Include the NFL teams list is your site
 * Author: Cesar Reyes
 * Author URI: https://github.com/CesarReyes
 * Version: 1.0.0
 * License: GPL2+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.txt
 *
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Block Initializer.
 */
require_once plugin_dir_path( __FILE__ ) . 'src/init.php';
