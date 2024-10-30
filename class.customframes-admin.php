<?php
class customframes_admin{
	
	private static $initialized = null;
	
	function __construct(){
		add_action( 'admin_menu', array( $this, 'customframes_settings_page' ) );
		add_action( 'admin_init', array( $this, 'customframes_settings_init' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'customframes_admin_load_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'customframes_admin_load_stylesheet' ) );
		add_action( 'customframes_tooltip', array( $this, 'customframes_add_tooltip' ), 10, 3 );
	}
	
	public static function customframes_init(){
		if( is_null( self::$initialized ) ){
			self::$initialized = new customframes_admin();
		}
		return self::$initialized;
	}
	
	function customframes_settings_page(){
		add_theme_page(
			__( 'Custom Frames-setings', 'custom-frames' ), 
			__( 'Custom Frames', 'custom-frames' ), 
			'manage_options', 
			'customframes-settings', 
			array( $this, 'customframes_settings_page_html' )
		);
	}
	
	function customframes_settings_init(){
		//start border section
		add_settings_section(
			'customframes-border-section', 
			__( 'Border Options', 'custom-frames' ), 
			array( $this, 'customframes_border_section' ), 
			'customframes-border-options' 
		);
		add_settings_field(
			'customframes-setting-border', 
			__( 'Add a border to images?', 'custom-frames' ), 
			array( $this, 'customframes_border' ), 
			'customframes-border-options', 
			'customframes-border-section' 
		);
		add_settings_field(
			'customframes-setting-border-width',
			__( 'Change the width of the border', 'custom-frames' ),
			array( $this, 'customframes_border_width' ),
			'customframes-border-options',
			'customframes-border-section'
		);
		add_settings_field(
			'customframes-setting-border-style',
			__( 'Change the style of the border', 'custom-frames' ),
			array( $this, 'customframes_border_style' ),
			'customframes-border-options',
			'customframes-border-section'
		);
		add_settings_field(
			'customframes-setting-border-color', 
			__( 'Change the color of the border', 'custom-frames' ), 
			array( $this, 'customframes_border_color' ), 
			'customframes-border-options', 
			'customframes-border-section' 
		);
		add_settings_field(
			'customframes-setting-border-curve',
			__( 'Make the border a circle', 'custom-frames' ),
			array( $this, 'customframes_border_circle' ),
			'customframes-border-options',
			'customframes-border-section'
		);
		add_settings_field(
			'customframes-setting-border-imghw',
			__( 'Set the height and width of the image', 'custom-frames' ),
			array( $this, 'customframes_border_imghw' ),
			'customframes-border-options',
			'customframes-border-section'
		);
		add_settings_field(
			'customframes-setting-border-circle-tl',
			__( 'Set the radius for the top left corner border', 'custom-frames' ),
			array( $this, 'customframes_border_circle_tl' ),
			'customframes-border-options',
			'customframes-border-section'
		);
		add_settings_field(
			'customframes-setting-border-circle-tr',
			__( 'Set the radius for the top right corner border', 'custom-frames' ),
			array( $this, 'customframes_border_circle_tr' ),
			'customframes-border-options',
			'customframes-border-section'
		);
		add_settings_field(
			'customframes-setting-border-circle-bl',
			__( 'Set the radius for the bottom left corner border', 'custom-frames' ),
			array( $this, 'customframes_border_circle_bl' ),
			'customframes-border-options',
			'customframes-border-section'
		);
		add_settings_field(
			'customframes-setting-border-circle-br',
			__( 'Set the radius for the bottom right corner border', 'custom-frames' ),
			array( $this, 'customframes_border_circle_br' ),
			'customframes-border-options',
			'customframes-border-section'
		);
		//end border section
		//start shadow section
		add_settings_section(
			'customframes-shadow-section',
			__( 'Shadow Options', 'custom-frames' ),
			array( $this, 'customframes_shadow_section' ),
			'customframes-shadow-options'
		);
		add_settings_field(
			'customframes-setting-shadow',
			__( 'Add a shadow to images?', 'custom-frames' ),
			array( $this, 'customframes_shadow' ),
			'customframes-shadow-options',
			'customframes-shadow-section'
		);
		add_settings_field(
			'customframes-setting-shadow-h',
			__( 'Horizontal Shadow', 'custom-frames' ),
			array( $this, 'customframes_shadow_h' ),
			'customframes-shadow-options',
			'customframes-shadow-section'
		);
		add_settings_field(
			'customframes-setting-shadow-blur',
			__( 'Shadows Blur', 'custom-frames' ),
			array( $this, 'customframes_shadow_blur' ),
			'customframes-shadow-options',
			'customframes-shadow-section'
		);
		add_settings_field(
			'customframes-setting-shadow-v',
			__( 'Vertical Shadow', 'custom-frames' ),
			array( $this, 'customframes_shadow_v' ),
			'customframes-shadow-options',
			'customframes-shadow-section'
		);
		add_settings_field(
			'customframes-setting-shadow-spread',
			__( 'Shadow Size', 'custom-frames' ),
			array( $this, 'customframes_shadow_spread' ),
			'customframes-shadow-options',
			'customframes-shadow-section'
		);
		add_settings_field(
			'customframes-setting-shadow-color',
			__( 'Shadow Color', 'custom-frames' ),
			array( $this, 'customframes_shadow_color' ),
			'customframes-shadow-options',
			'customframes-shadow-section'
		);
		//end shadow section
		//start caption section
		add_settings_section(
			'customframes-caption-section',
			__( 'Caption Options', 'custom-frames' ),
			array( $this, 'customframes_caption_section' ),
			'customframes-caption-options'
		);
		add_settings_field(
			'customframes-setting-caption-include',
			__( 'Apply border and shadow', 'custom-frames' ),
			array( $this, 'customframes_caption_include' ),
			'customframes-caption-options',
			'customframes-caption-section'
		);
		add_settings_field(
			'customframes-setting-caption-size',
			__( 'Font Size', 'custom-frames' ),
			array( $this, 'customframes_caption_size' ),
			'customframes-caption-options',
			'customframes-caption-section'
		);
		add_settings_field(
			'customframes-setting-caption-align',
			__( 'Font Align', 'custom-frames' ),
			array( $this, 'customframes_caption_align' ),
			'customframes-caption-options',
			'customframes-caption-section'
		);
		add_settings_field(
			'customframes-setting-caption-color',
			__( 'Text Color', 'custom-frames' ),
			array( $this, 'customframes_caption_color' ),
			'customframes-caption-options',
			'customframes-caption-section'
		);
		//end caption section
		if( get_option( 'customframes-border-options' ) == false ){
			$options = array(
				'border' => '',
				'bordercolor' => '',
				'borderwidth' => '',
				'borderstyle' => '',
				'bordercircle' => '',
				'border_imghw' => '',
				'border_tl' => '',
				'border_tr' => '',
				'border_bl' => '',
				'border_br' => ''
			);
			update_option( 'customframes-border-options', $options );
		}
		if( get_option( 'customframes-shadow-options' ) == false ){
			$options = array(
				'shadow' => '',
				'h_shadow' => '',
				'shadow_blur' => '',
				'v_shadow' => '',
				'shadowcolor' => '',
				'shadow_spread' => ''
			);
			update_option( 'customframes-shadow-options', $options );
		}
		if( get_option( 'customframes-caption-options' ) == false ){
			$options = array(
				'caption_include' => '',
				'caption_size' => '18',
				'caption_align' => '',
				'captioncolor' => ''
			);
			update_option( 'customframes-caption-options', $options );
		}
		register_setting( 'customframes-border-options', 'customframes-border-options', array( $this, 'customframes_sanitize_settings' ) );
		register_setting( 'customframes-shadow-options', 'customframes-shadow-options', array( $this, 'customframes_sanitize_shadow_settings' ) );
		register_setting( 'customframes-caption-options', 'customframes-caption-options', array( $this, 'customframes_sanitize_caption_settings' ) );
	}
	
	function customframes_settings_page_html( $active_tab = '' ){
		?>
		<div class='wrap'>
			<?php
			if( isset( $_GET[ 'tab' ] ) ){
				$active_tab = $_GET[ 'tab' ];
			}else if( $active_tab == 'border_options' ){
				$active_tab = 'border_options';
			}else if( $active_tab == 'shadow_options' ){
				$active_tab = 'shadow_options';
			}else if( $active_tab == 'caption_options' ){
				$active_tab = 'caption_options';
			}else{
				$active_tab = 'general_options';
			}
			?>
			<h2 class='nav-tab-wrapper'>
				<a href='?page=customframes-settings&tab=general_options' class='nav-tab <?php echo $active_tab == 'general_options' ? 'nav-tab-active' : ''; ?>'><?php esc_html_e( 'General', 'custom-frames' ); ?></a>
				<a href='?page=customframes-settings&tab=border_options' class='nav-tab <?php echo $active_tab == 'border_options' ? 'nav-tab-active' : ''; ?>'><?php esc_html_e( 'Border Options', 'custom-frames' ); ?></a>
				<a href='?page=customframes-settings&tab=shadow_options' class='nav-tab <?php echo $active_tab == 'shadow_options' ? 'nav-tab-active' : ''; ?>'><?php esc_html_e( 'Shadow Options', 'custom-frames' ); ?></a>
				<a href='?page=customframes-settings&tab=caption_options' class='nav-tab <?php echo $active_tab == 'caption_options' ? 'nav-tab-active' : ''; ?>'><?php esc_html_e( 'Caption Options', 'custom-frames' ); ?></a>
			</h2>
			<form method='post' action='options.php'>
			<?php
				if( $active_tab == 'general_options' ){
					customframes::customframes_send_js();
					?>
					<h2 class='preview-header'><?php esc_html_e( 'Custom Frames Preview', 'custom-frames' ); ?></h2>
					<div class='customframes-img-div'>
						<img class='customframes-img-shortcode' src="<?php echo plugin_dir_url( __FILE__ ) . "images/header.png"; ?>" height='300' width='800'>
						<p class='customframes-img-caption'><?php esc_html_e( 'Caption', 'custom-frames' ); ?></p>
					</div>
					<h2 class='preview-header'><?php esc_html_e( 'Shortcode Example', 'custom-frames' ); ?></h2>
					<p>[customframe src='picture source' height='300' width='450' caption='caption for picture' class='']</p>
					<ul>
						<li><?php esc_html_e( 'src - picture source', 'custom-frames' ); ?></li>
						<li><?php esc_html_e( 'height - height for the picture. (optional defaults to 300)', 'custom-frames' ); ?></li>
						<li><?php esc_html_e( 'width - width for the picture. (optional defaults to 450)', 'custom-frames' ); ?></li>
						<li><?php esc_html_e( 'caption - includes a caption with the picture. (optional)', 'custom-frames' ); ?></li>
						<li><?php esc_html_e( 'class - specify a css class for the frame. (optional)', 'custom-frames' ); ?></li>
					</ul>
					<?php
				}else if( $active_tab == 'border_options' ){
					echo "<div class='customframes-options-wrapper' id='customframes-border-options-wrapper'>";
					settings_fields( 'customframes-border-options' );
					do_settings_sections( 'customframes-border-options' );
					echo "</div>";
				}else if( $active_tab == 'shadow_options' ){
					echo "<div class='customframes-options-wrapper'>";
					settings_fields( 'customframes-shadow-options' );
					do_settings_sections( 'customframes-shadow-options' );
					echo "</div>";
				}else if( $active_tab == 'caption_options' ){
					echo "<div class='customframes-options-wrapper'>";
					settings_fields( 'customframes-caption-options' );
					do_settings_sections( 'customframes-caption-options' );
					echo "</div>";
				}
				if( $active_tab != 'general_options' ){
					submit_button();
				}
			?>
			</form>
		</div>
		<?php
	}
	function customframes_border_section(){
		//_e( 'Border', 'picture-frame' );
	}
	
	function customframes_shadow_section(){
		//_e( 'Shadow', 'custom-frames' );
	}
	
	function customframes_caption_section(){
		//_e( 'Caption', 'custom-frames' );
	}
	
	function customframes_sanitize_settings( $input ){
		$input['border'] = ( $input['border'] == 'on' ) ? 'on' : '';
		$input['bordercolor'] = sanitize_text_field( $input['bordercolor'] );
		$input['borderwidth'] = sanitize_text_field( $input['borderwidth'] );
		if( $input['borderstyle'] == 'solid' ){
			$input['borderstyle'] = 'solid';
		}else if( $input['borderstyle'] == 'dotted' ){
			$input['borderstyle'] = 'dotted';
		}else if( $input['borderstyle'] == 'dashed' ){
			$input['borderstyle'] = 'dashed';
		}else if( $input['borderstyle'] == 'double' ){
			$input['borderstyle'] = 'double';
		}else if( $input['borderstyle'] == 'groove' ){
			$input['borderstyle'] = 'groove';
		}else if( $input['borderstyle'] == 'ridge' ){
			$input['borderstyle'] = 'ridge';
		}else if( $input['borderstyle'] == 'inset' ){
			$input['borderstyle'] = 'inset';
		}else if( $input['borderstyle'] == 'outset' ){
			$input['borderstyle'] = 'outset';
		}
		$input['bordercircle'] = ( $input['bordercircle'] == 'on' ) ? 'on' : '';
		$input['border_imghw'] = sanitize_text_field( $input['border_imghw'] );
		$input['border_tl'] = sanitize_text_field( $input['border_tl'] );
		$input['border_tr'] = sanitize_text_field( $input['border_tr'] );
		$input['border_bl'] = sanitize_text_field( $input['border_bl'] );
		$input['border_br'] = sanitize_text_field( $input['border_br'] );
		return $input;
	}
	
	function customframes_sanitize_shadow_settings( $input ){
		$input['shadow'] = ( $input['shadow'] == 'on' ) ? 'on' : '';
		$input['h_shadow'] = sanitize_text_field( $input['h_shadow'] );
		$input['shadow_blur'] = sanitize_text_field( $input['shadow_blur'] );
		$input['v_shadow'] = sanitize_text_field( $input['v_shadow'] );
		$input['shadow_spread'] = sanitize_text_field( $input['shadow_spread'] );
		$input['shadowcolor'] = sanitize_text_field( $input['shadowcolor'] );
		return $input;
	}
	
	function customframes_sanitize_caption_settings( $input ){
		$input['caption_include'] = ( $input['caption_include'] == 'on' ) ? 'on' : '';
		$input['caption_size'] = sanitize_text_field( $input['caption_size'] );
		if( $input['caption_align'] == 'left' ){
			$input['caption_align'] = 'left';
		}else if( $input['caption_align'] == 'center' ){
			$input['caption_align'] = 'center';
		}else if( $input['caption_align'] == 'right' ){
			$input['caption_align'] = 'right';
		}
		$input['captioncolor'] = sanitize_text_field( $input['captioncolor'] );
		return $input;
	}

	function customframes_border(){
		$customframes_option = get_option( 'customframes-border-options' );
		echo '<input '.checked( $customframes_option['border'], 'on', false ).' name="customframes-border-options[border]" type="checkbox" /> ' . __( 'Enabled', 'custom-frames' );
		do_action( 'customframes_tooltip', 'customframes-border-options[border]', __( 'places a border around any images using the [customframe] shortcode', 'custom-frames' ) );
	}
	
	function customframes_border_color(){
		$customframes_option = get_option( 'customframes-border-options' );
		echo "<input type='text' name='customframes-border-options[bordercolor]' value='" . esc_attr( $customframes_option['bordercolor'] ) . "'>";
	}
	
	function customframes_border_width(){
		$customframes_option = get_option( 'customframes-border-options' );
		echo "<input type='text' name='customframes-border-options[borderwidth]' maxlength='2' size='2' value='" . esc_attr( $customframes_option['borderwidth'] ) . "'>";
	}
	
	function customframes_border_style(){
		$customframes_option = get_option( 'customframes-border-options' );
		?>
			<select name='customframes-border-options[borderstyle]'>
				<option value='solid'<?php if( $customframes_option['borderstyle'] === 'solid' ) echo "selected='selected'"; ?>><?php esc_html_e( 'solid', 'custom-frames' ) ?></option>
				<option value='dotted'<?php if( $customframes_option['borderstyle'] === 'dotted' ) echo "selected='selected'"; ?>><?php esc_html_e( 'dotted', 'custom-frames' ) ?></option>
				<option value='dashed'<?php if( $customframes_option['borderstyle'] === 'dashed' ) echo "selected='selected'"; ?>><?php esc_html_e( 'dashed', 'custom-frames' ) ?></option>
				<option value='double'<?php if( $customframes_option['borderstyle'] === 'double' ) echo "selected='selected'"; ?>><?php esc_html_e( 'double', 'custom-frames' ) ?></option>
				<option value='groove'<?php if( $customframes_option['borderstyle'] === 'groove' ) echo "selected='selected'"; ?>><?php esc_html_e( 'groove', 'custom-frames' ) ?></option>
				<option value='ridge'<?php if( $customframes_option['borderstyle'] === 'ridge' ) echo "selected='selected'"; ?>><?php esc_html_e( 'ridge', 'custom-frames' ) ?></option>
				<option value='inset'<?php if( $customframes_option['borderstyle'] === 'inset' ) echo "selected='selected'"; ?>><?php esc_html_e( 'inset', 'custom-frames' ) ?></option>
				<option value='outset'<?php if( $customframes_option['borderstyle'] === 'outset' ) echo "selected='selected'"; ?>><?php esc_html_e( 'outset', 'custom-frames' ) ?></option>
			</select>
		<?php
	}
	
	function customframes_border_circle(){
		$customframes_option = get_option( 'customframes-border-options' );
		echo '<input '.checked( $customframes_option['bordercircle'], 'on', false ).' name="customframes-border-options[bordercircle]" type="checkbox" /> ' . __( 'Enabled', 'custom-frames' );
		do_action( 'customframes_tooltip', 'customframes-border-options[bordercircle]', __( 'Makes the border a circle or oval depending on the height and width', 'custom-frames' ) );
	}
	
	function customframes_border_imghw(){
		$customframes_option = get_option( 'customframes-border-options' );
		echo "<input type='text' name='customframes-border-options[border_imghw]' maxlength='4' size='3' value='" . esc_attr( $customframes_option['border_imghw'] ) . "'>";
		do_action( 'customframes_tooltip', 'customframes-border-options[border_imghw]', __( 'The height and width need to be the same to create a circle. Leave blank for an oval', 'custom-frames' ) );
	}
	
	function customframes_border_circle_tl(){
		$customframes_option = get_option( 'customframes-border-options' );
		echo "<input type='text' name='customframes-border-options[border_tl]' maxlength='3' size='3' value='" . esc_attr( $customframes_option['border_tl'] ) . "'>";
	}
	
	function customframes_border_circle_tr(){
		$customframes_option = get_option( 'customframes-border-options' );
		echo "<input type='text' name='customframes-border-options[border_tr]' maxlength='3' size='3' value='" . esc_attr( $customframes_option['border_tr'] ) . "'>";
	}
	
	function customframes_border_circle_bl(){
		$customframes_option = get_option( 'customframes-border-options' );
		echo "<input type='text' name='customframes-border-options[border_bl]' maxlength='3' size='3' value='" . esc_attr( $customframes_option['border_bl'] ) . "'>";
	}
	
	function customframes_border_circle_br(){
		$customframes_option = get_option( 'customframes-border-options' );
		echo "<input type='text' name='customframes-border-options[border_br]' maxlength='3' size='3' value='" . esc_attr( $customframes_option['border_br'] ) . "'>";
	}
	
	function customframes_shadow(){
		$customframes_option = get_option( 'customframes-shadow-options' );
		echo '<input '.checked( $customframes_option['shadow'], 'on', false ).' name="customframes-shadow-options[shadow]" type="checkbox" /> ' . __( 'Enabled', 'custom-frames' );
		do_action( 'customframes_tooltip', 'customframes-shadow-options[shadow]', __( 'Adds a shadow to images placed by [customframe] shortcode', 'custom-frames' ) );
	}
	
	function customframes_shadow_h(){
		$customframes_option = get_option( 'customframes-shadow-options' );
		echo "<input type='text' name='customframes-shadow-options[h_shadow]' maxlength='3' size='3' value='" . esc_attr( $customframes_option['h_shadow'] ) . "'>";
	}
	
	function customframes_shadow_blur(){
		$customframes_option = get_option( 'customframes-shadow-options' );
		echo "<input type='text' name='customframes-shadow-options[shadow_blur]' maxlength='3' size='3' value='" . esc_attr( $customframes_option['shadow_blur'] ) . "'>";
	}
	
	function customframes_shadow_v(){
		$customframes_option = get_option( 'customframes-shadow-options' );
		echo "<input type='text' name='customframes-shadow-options[v_shadow]' maxlength='3' size='3' value='" . esc_attr( $customframes_option['v_shadow'] ) . "'>";
	}
	
	function customframes_shadow_spread(){
		$customframes_option = get_option( 'customframes-shadow-options' );
		echo "<input type='text' name='customframes-shadow-options[shadow_spread]' maxlength='3' size='3' value='" . esc_attr( $customframes_option['shadow_spread'] ) . "'>";
	}
	
	function customframes_shadow_color(){
		$customframes_option = get_option( 'customframes-shadow-options' );
		echo "<input type='text' name='customframes-shadow-options[shadowcolor]' value='" . esc_attr( $customframes_option['shadowcolor'] ) . "'>";
	}
	
	function customframes_caption_include(){
		$customframes_option = get_option( 'customframes-caption-options' );
		echo '<input '.checked( $customframes_option['caption_include'], 'on', false ).' name="customframes-caption-options[caption_include]" type="checkbox" /> ' . __( 'Enabled', 'custom-frames' );
		do_action( 'customframes_tooltip', 'customframes-caption-options[caption_include]', __( 'Extends the border and shadow options to the caption', 'custom-frames' ) );
	}
	
	function customframes_caption_size(){
		$customframes_option = get_option( 'customframes-caption-options' );
		echo "<input type='text' name='customframes-caption-options[caption_size]' maxlength='3' size='3' value='" . esc_attr( $customframes_option['caption_size'] ) . "'>";
	}
	
	function customframes_caption_align(){
		$customframes_option = get_option( 'customframes-caption-options' );
		?>
		<select name='customframes-caption-options[caption_align]'>
				<option value='left'<?php if( $customframes_option['caption_align'] === 'left' ) echo "selected='selected'"; ?>><?php esc_html_e( 'left', 'custom-frames' ) ?></option>
				<option value='center'<?php if( $customframes_option['caption_align'] === 'center' ) echo "selected='selected'"; ?>><?php esc_html_e( 'center', 'custom-frames' ) ?></option>
				<option value='right'<?php if( $customframes_option['caption_align'] === 'right' ) echo "selected='selected'"; ?>><?php esc_html_e( 'right', 'custom-frames' ) ?></option>
		</select>
		<?php
	}
	
	function customframes_caption_color(){
		$customframes_option = get_option( 'customframes-caption-options' );
		echo "<input type='text' name='customframes-caption-options[captioncolor]' value='" . esc_attr( $customframes_option['captioncolor'] ) . "'>";
	}
	
	function customframes_add_tooltip( $name, $message, $dir = 'left' ){
		echo "<script>add_tooltip('{$name}','{$message}','{$dir}')</script>";
	}
	
	function customframes_admin_load_scripts(){
		$screen = get_current_screen();
		if( $screen->id != 'appearance_page_customframes-settings' ){
			return;
		}
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'customframes.js', plugin_dir_url( __FILE__ ) . 'js/customframes.js' );
		wp_enqueue_script( 'customframes-admin.js', plugin_dir_url( __FILE__ ) . 'js/customframes-admin.js' );
	}
	
	function customframes_admin_load_stylesheet(){
		$screen = get_current_screen();
		if( $screen->id != 'appearance_page_customframes-settings' ){
			return;
		}
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_style( 'customframes-admin.css', plugin_dir_url( __FILE__ ) . 'css/customframes-admin.css' );
	}
	
}
customframes_admin::customframes_init();