<?php
/*
Plugin Name: Email Return-Path Header Fix
Description: This plugin sets the Return-Path header of outgoing emails to equal the from email address.
Author: Abdussamad Abdurrazzaq
Author URI: http://abdussamad.com
Plugin URI: http://abdussamad.com/archives/567-Fixing-the-WordPress-Email-Return-Path-Header.html
Version: 0.1
License: GPLv2
*/
class email_return_path {
  	function __construct() {
		add_action( 'phpmailer_init', array( $this, 'fix' ) );    
  	}

	function fix( $phpmailer ) {
	  	$phpmailer->Sender = $phpmailer->From;
	}
}

new email_return_path();