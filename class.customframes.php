<?php
class customframes{
	
	private static $initialized = null;
	
	function __construct(){
		add_shortcode( 'customframe', array( $this, 'customframes_shortcode' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'customframes_load_scripts' ) );
		add_action( 'wp_head', array( $this, 'customframes_send_js' ) );
		add_action( 'init', array( $this, 'customframes_textdomain' ) );
	}
	
	public static function customframes_init(){
		if( is_null( self::$initialized ) ){
			self::$initialized = new customframes();
		}
		return self::$initialized;
	}
	
	static function customframes_send_js(){
		$customframes_border = get_option( 'customframes-border-options' );
		$customframes_shadow = get_option( 'customframes-shadow-options' );
		$customframes_caption = get_option( 'customframes-caption-options' );
		?>
		<script>
			<?php
				if( $customframes_border['border'] === 'on' ){
					echo "customframes_create_border_class( '" . ( ( $customframes_border['bordercolor'] == '' ) ? '#000000' : $customframes_border['bordercolor'] ) . "',
															" . ( ( $customframes_border['borderwidth'] == '' ) ? '0' : $customframes_border['borderwidth'] ) . ",
															'" . ( ( $customframes_border['borderstyle'] == '' ) ? '0' : $customframes_border['borderstyle'] ) . "',
															'" . ( ( $customframes_border['border_imghw'] == '' ) ? 'defaults' : $customframes_border['border_imghw'] ) . "',
															" . ( ( $customframes_border['bordercircle'] == 'on' ) ? '50' : '0' ) . ",
															" . ( ( $customframes_border['border_tl'] == '' ) ? '0' : $customframes_border['border_tl'] ) . ",
															" . ( ( $customframes_border['border_tr'] == '' ) ? '0' : $customframes_border['border_tr'] ) . ",
															" . ( ( $customframes_border['border_bl'] == '' ) ? '0' : $customframes_border['border_bl'] ) . ",
															" . ( ( $customframes_border['border_br'] == '' ) ? '0' : $customframes_border['border_br'] ) . ",
															'" . ( ( $customframes_caption['caption_include'] == 'on' ) ? 'div' : 'shortcode' ) . "');";
				}
				if( $customframes_shadow['shadow'] === 'on' ){
					echo "customframes_create_shadow_class( " . ( ( $customframes_shadow['h_shadow'] == '' ) ? '0' : $customframes_shadow['h_shadow'] ) . ",
															" . ( ( $customframes_shadow['v_shadow'] == '' ) ? '0' : $customframes_shadow['v_shadow'] ) . ",
															" . ( ( $customframes_shadow['shadow_blur'] == '' ) ? '0' : $customframes_shadow['shadow_blur'] ) . ",
															" . ( ( $customframes_shadow['shadow_spread'] == '' ) ? '0' : $customframes_shadow['shadow_spread'] ) . ",
															'" . ( ( $customframes_shadow['shadowcolor'] == '' ) ? '#000000' : $customframes_shadow['shadowcolor'] ) ."',
															" . ( ( $customframes_border['bordercircle'] == 'on' ) ? '50' : '0' ) . ",
															'" . ( ( $customframes_caption['caption_include'] == 'on' ) ? 'div' : 'shortcode' ) . "');";
				}
				echo "customframes_create_caption_class( " . ( ( $customframes_caption['caption_size'] == '' ) ? '18' : $customframes_caption['caption_size'] ) . ",
														 '" . ( ( $customframes_caption['caption_align'] == '' ) ? '0' : $customframes_caption['caption_align'] ) . "',
														 '" . ( ( $customframes_caption['captioncolor'] == '' ) ? '#000000' : $customframes_caption['captioncolor'] ) . "');";
			?>
		</script>
		<?php
	}
	
	function customframes_shortcode( $atts ){
		$a = shortcode_atts( array(
			'src' => '',
			'height' => '300',
			'width' => '450',
			'caption' => '',
			'class' => ''
		), $atts );
		
		$image = "<div class='customframes-img-div " . $a['class'] . "'> 
					<img class='customframes-img-shortcode' src=" . $a['src'] . " height=" . $a['height'] . " width=" . $a['width'] . ">
					" . ( ( $a['caption'] == '' ) ? '' : "<p class='customframes-img-caption'>" . $a['caption'] . "</p>" ) . "
				  </div>";
		
		return $image;
	}
	
	function customframes_load_scripts(){
		$plugin_url = plugin_dir_url( __FILE__ );
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'customframes.js', $plugin_url . 'js/customframes.js' );
	}
	
	function customframes_textdomain(){
		load_plugin_textdomain( 'custom-frames', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}
	
	public static function customframes_activation(){
		if( !current_user_can( 'activate_plugins' ) ) return;
		if ( version_compare( $GLOBALS['wp_version'], CUSTOMFRAMES_MIN_WP_VERSION, '<' ) ) {
			$error_message = sprintf( __( 'Could not activate Custom Frames version %s because it requires wordpress version %s or greater.', 'custom-frames' ), CUSTOMFRAMES_VERSION, CUSTOMFRAMES_MIN_WP_VERSION );
			wp_die( $error_message );
		}
	}
	
	public static function customframes_deactivation(){
		if( !current_user_can( 'activate_plugins' ) ) return;
	}
	
}
customframes::customframes_init();