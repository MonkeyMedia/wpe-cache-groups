<?php

/*
Plugin Name: Monkey Cache Groups
Plugin URI: 
Description: Adds is_cache_group() function.
Version: 0.0.1
Author: MonkeyMediaInc
Author URI: 
License: 
*/
   
class monkey_cache_groups {

	private $optid = 'mcg';

	function __construct() {
		add_action( 'plugins_loaded', array (&$this, 'mcg_is_cache_group') );
	}
	
	function mcg_is_cache_group() {
		if(!function_exists('is_cache_group')) {
			function is_cache_group($group = '') {
				$headers = apache_response_headers();
				if(array_key_exists('X-Cache-Group', $headers) && (empty($group) || $headers['X-Cache-Group'] == $group))
					return true;
				else
					return false;
			}
		}
		
		if(!function_exists('get_cache_group')) {
			function get_cache_group() {
				$headers = apache_response_headers();
				if(array_key_exists('X-Cache-Group', $headers))
					return $headers['X-Cache-Group'];
				else
					return;
			}
		}
	}
}
new monkey_cache_groups;
?>
