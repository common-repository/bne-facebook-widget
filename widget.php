<?php
/*
 *	Facebook Widget Class
 *
 * 	@author		Kerry Kline
 * 	@link		http://www.bnecreative.com
 *
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;



/*
 *	WP_Widget Class
 *	Extends the WP_Widget class with ours, BNE_Facebook_Widget,
 *	to create a new available widget.
 *
 *  @since		v1.0
 *	@updated	v1.1
 *
*/
class BNE_Facebook_Widget extends WP_Widget {
 
	public function __construct() {
	
		parent::__construct(
			'bne_facebook_widget',
			__( 'BNE Facebook Page Like Box', 'bne-facebook-widget' ),
			array(
				'description' => __( 'Displays a Facebook Page Like Box.', 'bne-facebook-widget' )
			)
		);
	}
	
	
	
	/*  
	 * 	Front-end display of widget.
	 *
	 * 	@see WP_Widget::widget()
	 *
	 * 	@param array $args     Widget arguments.
	 * 	@param array $instance Saved values from database.
	*/
	public function widget( $args, $instance ) {    
	
		extract( $args );
	
		$title = apply_filters( 'widget_title', $instance['title'] );
		$app_id = esc_attr( $instance['app_id'] );
		$url = esc_url( $instance['url'] );
		$width = ( !empty( $instance['width'] ) ) ? esc_attr( $instance['width'] ) : '340';
		$height = ( !empty( $instance['height'] ) ) ? esc_attr( $instance['height'] ) : '500';
		$tabs = ( isset( $instance['tabs'] ) ) ? implode( ',', $instance['tabs'] ) : '';
	    $hide_cover = ( $instance['hide_cover'] == 1 ) ? 'true' : 'false';
	    $show_facepile = ( $instance['show_facepile'] == 1 ) ? 'true' : 'false';
	    $hide_cta = ( $instance['hide_cta'] == 1 ) ? 'true' : 'false';
	    $small_header = ( $instance['small_header'] == 1 ) ? 'true' : 'false';
	    $adapt_width = ( $instance['adapt_width'] == 1 ) ? 'true' : 'false';
		
		// Scripts
	    wp_localize_script(
	        'bne_fbw',
	        'bne_fbw_var',
	        array(
	            'language'  => get_locale(),
	            'appid'     => $app_id
	        )
	    );
	    wp_enqueue_script( 'bne_fbw' );

		// Begin Widget
		echo $before_widget;
		
			echo '<div class="bne-facebook-widget">';
		
				if( $title ) {
					echo $before_title . apply_filters( 'widget_title', $instance['title'] ) . $after_title;
				}
				
				?>
				<div id="fb-root"></div>
				<div class="fb-page" 
					data-href="<?php echo $url; ?>"
					data-tabs="<?php echo $tabs; ?>"
					data-width="<?php echo $width; ?>"
					data-height="<?php echo $height; ?>"
					data-small-header="<?php echo $small_header; ?>"
					data-adapt-container-width="<?php echo $adapt_width; ?>"
					data-hide-cta="<?php echo $hide_cta; ?>"
					data-hide-cover="<?php echo $hide_cover; ?>"
					data-show-facepile="<?php echo $show_facepile; ?>">
				</div>
				<?php
			
			echo '</div>';
		         
		echo $after_widget;
	
	}
 
  
	/*
	 *  Sanitize widget form values as they are saved.
	 *
	 *  @see WP_Widget::update()
	 *
	 *  @param array $new_instance Values just sent to be saved.
	 *  @param array $old_instance Previously saved values from database.
	 *
	 *  @return array Updated safe values to be saved.
	*/
	public function update( $new_instance, $old_instance ) {        
	
		$instance = $old_instance;
	
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['app_id'] = !empty( $new_instance['app_id'] ) ? $new_instance['app_id'] : '';
		$instance['url'] = !empty( $new_instance['url'] ) ? esc_url( $new_instance['url'] ) : 'https://www.facebook.com/facebook/';
		$instance['width'] = !empty( $new_instance['width'] ) ? (int) $new_instance['width'] : '340';
		$instance['height'] = !empty( $new_instance['height'] ) ? (int) $new_instance['height'] : '500';
		$instance['tabs'] = $new_instance['tabs'];
		$instance['hide_cover'] = (bool) $new_instance['hide_cover'];
		$instance['show_facepile'] = (bool) $new_instance['show_facepile'];
		$instance['hide_cta'] = (bool) $new_instance['hide_cta'];
		$instance['small_header'] = (bool) $new_instance['small_header'];
		$instance['adapt_width'] = (bool) $new_instance['adapt_width'];
		
		return $instance;
	
	}


	/*
	 *  Back-end widget form.
	 *
	 *  @see WP_Widget::form()
	 *
	 *  @param array $instance Previously saved values from database.
	*/
	public function form( $instance ) {

		// Defaults
		$instance = wp_parse_args( $instance, array(
			'title'			=>	'',
			'app_id'		=>	'',
			'url'			=>	'https://www.facebook.com/facebook/',
			'width'			=>	'340',
			'height'		=>	'500',
			'tabs'			=>	array(),
			'hide_cover'	=>	false,
			'show_facepile'	=>	true,
			'hide_cta'		=>	false,
			'small_header'	=>	false,
			'adapt_width'	=>	true
		));
		
		?>
		
		<!-- Title -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'bne-facebook-widget' ); ?>:</label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>
	
		
		<!-- App ID -->
		<p>
			<label for="<?php echo $this->get_field_id( 'app_id' ); ?>"><?php _e( 'App ID', 'bne-facebook-widget' ); ?>:</label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'app_id' ); ?>" name="<?php echo $this->get_field_name( 'app_id' ); ?>" type="text" value="<?php echo esc_html( $instance['app_id'] ); ?>" placeholder="Optional"/>
			<span class="description" style="font-style: italic; font-size: 12px; padding-left: 0;">
				<?php echo sprintf(
						__( 'Set an optional Facebook App ID. <a href="https://developers.facebook.com/apps/" target="_blank">%s</a> ', 'bne-facebook-widget' ),
						__( 'Get an ID', 'bne-facebook-widget' )
					);
				?>
			</span>
		</p>

		
		<!-- URL -->
		<p>
			<label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e( 'Facebook Page URL (required)', 'bne-facebook-widget' ); ?>:</label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" type="text" value="<?php echo esc_url( $instance['url'] ); ?>" />
			<span class="description" style="font-style: italic; font-size: 12px; padding-left: 0;"><?php _e( 'The full URL to the Facebook Page.', 'bne-facebook-widget' ); ?></span>
		</p>

		
		<!-- Width -->
		<p>
			<label for="<?php echo $this->get_field_id( 'width' ); ?>"><?php _e( 'Width', 'bne-facebook-widget' ); ?>:</label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'width' ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>" type="number" value="<?php echo esc_html( $instance['width'] ); ?>" />
			<span class="description" style="font-style: italic; font-size: 12px; padding-left: 0;"><?php _e( 'The pixel width of the widget. Minimum is 180 and Maximum is 500. (Default 340)', 'bne-facebook-widget' ); ?></span>
		</p>
		

		<!-- Height -->
		<p>
			<label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e( 'Height', 'bne-facebook-widget' ); ?>:</label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" type="number" value="<?php echo esc_html( $instance['height'] ); ?>" />
			<span class="description" style="font-style: italic; font-size: 12px; padding-left: 0;"><?php _e( 'The pixel height of the widget. Minimum is 70. (Default 500)', 'bne-facebook-widget' ); ?></span>
		</p>


		<!-- Tabs -->
		<p style="border-top: 1px solid #eee; padding-top: 10px; padding-bottom:10px;">
			<label for="<?php echo $this->get_field_id( 'tabs' ); ?>"><?php _e( 'Tabs', 'bne-facebook-widget' ); ?>:</label><br>
			<span class="description" style="font-style: italic; font-size: 12px; padding-left: 0; padding-bottom:10px; display: inline-block;"><?php _e( 'Select the available Facebook tabs to render within the widget.', 'bne-facebook-widget' ); ?></span><br>
			<?php 
				$tab_options = array(
					'timeline'	=>	__( 'Timeline', 'bne-facebook-widget' ),
					'events'	=>	__( 'Events', 'bne-facebook-widget' ),
					'messages'	=>	__( 'Messages', 'bne-facebook-widget' ),
				);
				$tabs = wp_parse_args( $instance['tabs'], array(
					'timeline'	=>	'',
					'events'	=>	'',
					'messages'	=>	'',
				));
				
				foreach( $tab_options as $value => $label ) {
					echo '<input type="checkbox" class="checkbox" id="'.$this->get_field_id( 'tabs' ).'_'.$value.'" name="'.$this->get_field_name( 'tabs' ).'[]" value="'.$value.'" '.( ( in_array( $value, $tabs ) ) ? 'checked="checked"' : '' ).'/>';
					echo '<label>'.$label.'</label><br>';
				} 
			
			?>
		</p>

		<!-- Display Options -->
		<p style="border-top: 1px solid #eee; padding-top: 10px; padding-bottom:10px;">
			<label><?php _e( 'Display Options', 'bne-facebook-widget' ); ?>:</label><br>			
			<span class="description" style="font-style: italic; font-size: 13px; padding-left: 0; display: inline-block;"><?php _e( 'Configure certain display options for the Facebook widget.', 'bne-facebook-widget' ); ?></span><br>
			
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'hide_cover' ); ?>" name="<?php echo $this->get_field_name( 'hide_cover' ); ?>"<?php checked( $instance['hide_cover'] ); ?> />
			<label for="<?php echo $this->get_field_id( 'hide_cover' ); ?>"><?php _e( 'Hide Cover Photo.', 'bne-facebook-widget' ); ?></label>
			<br>
			
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'show_facepile' ); ?>" name="<?php echo $this->get_field_name( 'show_facepile' ); ?>"<?php checked( $instance['show_facepile'] ); ?> />
			<label for="<?php echo $this->get_field_id( 'show_facepile' ); ?>"><?php _e( 'Show Friend\'s Faces.', 'bne-facebook-widget' ); ?></label>
			<br>

			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'hide_cta' ); ?>" name="<?php echo $this->get_field_name( 'hide_cta' ); ?>"<?php checked( $instance['hide_cta'] ); ?> />
			<label for="<?php echo $this->get_field_id( 'hide_cta' ); ?>"><?php _e( 'Hide the custom call to action button (if available).', 'bne-facebook-widget' ); ?></label>
			<br>

			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'small_header' ); ?>" name="<?php echo $this->get_field_name( 'small_header' ); ?>"<?php checked( $instance['small_header'] ); ?> />
			<label for="<?php echo $this->get_field_id( 'small_header' ); ?>"><?php _e( 'Use Small Header.', 'bne-facebook-widget' ); ?></label>
			<br>
			
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'adapt_width' ); ?>" name="<?php echo $this->get_field_name( 'adapt_width' ); ?>"<?php checked( $instance['adapt_width'] ); ?> />
			<label for="<?php echo $this->get_field_id( 'adapt_width' ); ?>"><?php _e( 'Adapt to widget container width.', 'bne-facebook-widget' ); ?></label>
		</p>

    <?php 
    }
     
}