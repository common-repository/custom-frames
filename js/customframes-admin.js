jQuery(document).ready(function($){
	$('.customframes-options-wrapper tr').wrap("<div class='customframes-options'></div>");
	$('#customframes-border-options-wrapper .customframes-options:eq(4)').before("<h2>Circle Options</h2>");
	$('[name="customframes-shadow-options[shadowcolor]"]').wpColorPicker();
	$('[name="customframes-border-options[bordercolor]"]').wpColorPicker();
	$('[name="customframes-caption-options[captioncolor]"]').wpColorPicker();
});
function add_tooltip( name, message, dir ){
	jQuery(document).ready(function($){
		var input_field = $("[name='" + name + "']");
		var tr = input_field.parent().parent();
		$('<style>').prop('type', 'text/css').html("\
			.tooltip-message{\
				background: white;\
				width: 300px;\
				margin: 0;\
				border-radius: 7px;\
			}\
			.arrow-left:before,\
			.arrow-right:before{\
				position: relative;\
				bottom: 28px;\
				content: ' ';\
				border-top: 10px solid transparent;\
				border-right: 10px solid transparent;\
				border-bottom: 10px solid white;\
				border-left: 10px solid transparent;\
			}\
			.arrow-left:before{\
				left: 5px;\
			}\
			.arrow-right:before{\
				left: 270px;\
		}").appendTo('head');
		input_field.hover(function(){
			tr.after("<p class='tooltip-message arrow-" + dir + "'>" + message + "</p>");
		}, function(){
			tr.parent().find('.tooltip-message').remove();
		});
	});
}