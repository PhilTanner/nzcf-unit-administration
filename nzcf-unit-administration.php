<?php
	/*			
		Plugin Name: NZCF Unit Administration
		Plugin URI:  https://github.com/PhilTanner/nzcf-unit-administration.git
		Description: This describes my plugin in a short sentence
		Version:     0.01
		Author:      Phil Tanner
		Author URI:  https://github.com/PhilTanner
		License:     GPL3
		License URI: http://www.gnu.org/licenses/gpl.html
		Domain Path: /languages
		Text Domain: nzcf-unit-administration
        
        Copyright (C) 2016 Phil Tanner

    	This program is free software: you can redistribute it and/or modify
    	it under the terms of the GNU General Public License as published by
    	the Free Software Foundation, either version 3 of the License, or
    	(at your option) any later version.

    	This program is distributed in the hope that it will be useful,
    	but WITHOUT ANY WARRANTY; without even the implied warranty of
    	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    	GNU General Public License for more details.

    	You should have received a copy of the GNU General Public License
    	along with this program.  If not, see <http://www.gnu.org/licenses/>.
	*/	

	defined( 'ABSPATH' ) or die( 'No script kiddies please!' );	
	
	if ( is_admin() ) {
    	// We are in admin mode
     	require_once( dirname(__file__).'/admin/nzcfadmin_admin.php' );
	}	

	// Function to be called when this application is installed:
	register_activation_hook( __FILE__, 'nzcfadmin_install' );
	// Function to be called when this application is uninstalled:
	register_uninstall_hook( __FILE__, 'nzcfadmin_uninstall' );

	nzcfadmin_uninstall(){
      	// If uninstall is not called from WordPress (i.e. is called via URL or command line)
		if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
          exit();
		}	
 
		// Delete our saved options
		delete_option( 'pluginoptionname' );
 
		// For site options in Multisite
		delete_site_option( $option_name );  
 
		// Drop a custom db table
		global $wpdb;
		$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}mytable" );
    }