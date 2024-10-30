jQuery(document).ready(function(){
	jQuery('<style>').prop('type', 'text/css').html("\
		.customframes-img-div{\
			display: inline-block;\
	}").appendTo('head');
});
function customframes_create_border_class( color, width, style, imghw, circle, tl, tr, bl, br, caption ){
	jQuery(document).ready(function(){
		var w = jQuery('.customframes-img-shortcode').width();
		jQuery('<style>').prop('type', 'text/css').html("\
			.customframes-border{\
				border-style: " + style + ";\
				border-width: " + width + "px;\
				border-color: " + color + ";\
				height: " + ( ( imghw == 'defaults' ) ? 'auto' : imghw + 'px' ) + ";\
				width: " + ( ( imghw == 'defaults' ) ? w + 'px' : imghw + 'px' ) + ";\
		}").appendTo('head');
		customframes_add_border( circle, tl, tr, bl, br, caption );
	});
}
function customframes_add_border( circle, tl, tr, bl, br, caption ){
	jQuery(document).ready(function(){
		var w = jQuery('.customframes-img-shortcode').width();
		if( tl != 0 || tr != 0 || bl != 0 || br != 0 ){
			circle = 0;
			jQuery('.customframes-img-shortcode').css({
				'border-top-left-radius':tl + 'px',
				'border-top-right-radius':tr + 'px',
				'border-bottom-left-radius':bl + 'px',
				'border-bottom-right-radius':br + 'px'
			});
			jQuery('.customframes-img-div').css({
				'border-top-left-radius':tl + 'px',
				'border-top-right-radius':tr + 'px'
			});
		}
		if( circle == 50 ){
			caption = 'shortcode';
			jQuery('.customframes-img-shortcode').css('border-radius', circle + '%');
		}
		jQuery('.customframes-img-' + caption).addClass('customframes-border');
	});
}
function customframes_create_shadow_class( h, v, blr, spread, color, circle, caption ){
	jQuery(document).ready(function(){
		jQuery('<style>').prop('type', 'text/css').html("\
			.customframes-shadow{\
				box-shadow: " + h + "px " + v + "px " + blr + "px " + spread + "px " + color + ";\
		}").appendTo('head');
		customframes_add_shadow( circle, caption );
	});
}
function customframes_add_shadow( circle, caption ){
	jQuery(document).ready(function(){
		if( circle == 50 ){
			caption = 'shortcode';
		}
		jQuery('.customframes-img-' + caption).addClass('customframes-shadow');
	});
}
function customframes_create_caption_class( size, align, color ){
	jQuery(document).ready(function(){
		jQuery('<style>').prop('type', 'text/css').html("\
			.customframes-caption{\
				font-size: " + size + "px;\
				text-align: " + align + ";\
				color: " + color + ";\
		}").appendTo('head');
		customframes_caption_prop();
	});
}
function customframes_caption_prop(){
	jQuery(document).ready(function(){
		jQuery('.customframes-img-caption').addClass('customframes-caption');
	});
}