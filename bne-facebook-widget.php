<?php
/*
 * Plugin Name: BNE Facebook Widget
 * Version: 1.1
 * Description: Adds a Facebook Pages like box to any widget area of your website.
 * Author: Kerry Kline
 * Author URI: http://www.bnecreative.com
 * Requires at least: 4.6
 * Text Domain: bne-facebook-widget
 * License: GPL2

    Copyright 2017 BNE Creative

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License version 2,
    as published by the Free Software Foundation.

    You may NOT assume that you can use any other version of the GPL.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    The license for this software can likely be found here:
    http://www.gnu.org/licenses/gpl-2.0.html

*/


// Exit if accessed directly
if ( !defined('ABSPATH')) exit;


// INIT Class
class BNE_Facebok_Widget_Init {

	
    /*
     * 	Constructor
     *
     *	@since v1.0
     *
    */
	function __construct() {
		
		// Set Constants
		define( 'BNE_FACEBOOK_WIDGET_VERSION', '1.1' );
		define( 'BNE_FACEBOOK_WIDGET_DIR', dirname( __FILE__ ) );
		define( 'BNE_FACEBOOK_WIDGET_URI', plugins_url( '', __FILE__ ) );
		define( 'BNE_FACEBOOK_WIDGET_BASENAME', plugin_basename( __FILE__ ) );
		
		// Widgets
		include_once( BNE_FACEBOOK_WIDGET_DIR . '/widget.php' );
		add_action( 'widgets_init', array( $this, 'register_widgets' ) );
		
		// Shortcode
		add_shortcode( 'bne_facebook_widget', array( $this, 'shortcode' ) );
		
		// Scripts 
		add_action( 'wp_enqueue_scripts', array( $this, 'frontend_scripts' ) );

	}


	/*
	 *	Register Widgets
	 *	
	 * 	@since 	v1.0
	 *
	*/
	function register_widgets() {
		register_widget( 'BNE_Facebook_Widget' );
	}


	/*
	 *	Register frontend CSS and JS
	 *
	 *	@since 	v1.0
	 *	@updated	v1.1
	 *
	*/
	function frontend_scripts() {
		
		// Facebook JS
		wp_register_script( 'bne_fbw', BNE_FACEBOOK_WIDGET_URI . '/assets/js/bne-facebook-widget.js', null, BNE_FACEBOOK_WIDGET_VERSION, true );
	
	}



	/*
	 *	Shortcode Option
	 *
	 *	@since 		v1.0
	 *	@updated	v1.1
	 *
	*/
	function shortcode( $atts ) {
		$atts = shortcode_atts( array(
			'app_id' 		=>	'',
			'url'			=>	'https://www.facebook.com/facebook/',
			'tabs'			=>	'',
			'width'			=>	'340',
			'height'		=>	'500',
			'hide_cover'	=>	'false',
			'show_facepile'	=>	'true',
			'hide_cta'		=>	'false',
			'small_header'	=>	'false',
			'adapt_width'	=>	'true'
		), $atts, 'bne_facebook_widget' );
		

		// Clean up tabs
		$atts['tabs'] = trim( $atts['tabs'] );
		$atts['tabs'] = str_replace(' ', '', $atts['tabs'] );
		
		// Scripts
	    wp_localize_script(
	        'bne_fbw',
	        'bne_fbw_var',
	        array(
	            'language'  => get_locale(),
	            'appid'     => $atts['app_id']
	        )
	    );
	    wp_enqueue_script( 'bne_fbw' );

		ob_start();
		?>
		<div class="bne-facebook-widget">
			<div id="fb-root"></div>
			<div class="fb-page" 
				data-href="<?php echo $atts['url']; ?>"
				data-tabs="<?php echo $atts['tabs']; ?>"
				data-width="<?php echo $atts['width']; ?>"
				data-height="<?php echo $atts['height']; ?>"
				data-small-header="<?php echo $atts['small_header']; ?>"
				data-adapt-container-width="<?php echo $atts['adapt_width']; ?>"
				data-hide-cta="<?php echo $atts['hide_cta']; ?>"
				data-hide-cover="<?php echo $atts['hide_cover']; ?>"
				data-show-facepile="<?php echo $atts['show_facepile']; ?>">
			</div>
		</div>
		<?php
		return ob_get_clean();

	}

} // END Class

	
// Initiate the Class
$BNE_Facebok_Widget_Init = new BNE_Facebok_Widget_Init();