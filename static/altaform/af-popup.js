var popsettings = {
	width:		900,
	height:		600,
	minWidth:	600,
	minHeight:	350,
}

popup = function(url, title) {
	if (typeof(title)==='object') {
		title = $('#' + $(title).attr('aria-describedby')).children().html()
	}

	$('#popup-window')
	.html('<div class="loading"></div>')
	.dialog('option', 'title', title)
	.dialog('open')
	.dialog('option', 'buttons', {'Close':popdown})
	.load(url, function(text, status, xhr){
		if (status == 'error') poperror(xhr);
	});

	$('#popup-window .af-default-focus').first().focus();
};

popdown = function() {
	$('#popup-window').dialog('close');
};

popupdate = function(data) {
	if (data == 'AF-OK') return popdown();
	$('#popup-window').html(data);
};

popserial = function() {
	return $('#popup-window').afSerialize();
}

poppost = function(url, callback) {
	$.post(url, popserial(), callback?callback:popupdate).fail(poperror);
}

popbuttons = function(buttons, append) {
	if (append  ||  arguments.length < 2) {
		buttons = $.extend(
			{}, buttons,
			$('#popup-window').dialog('option', 'buttons')
		);
	}
	$('#popup-window').dialog('option', 'buttons', buttons);
};

poptitle = function(title, append) {
	if (append) title = $('#popup-window').dialog('option', 'title') + ' - ' + title;
	$('#popup-window').dialog('option', 'title', title);
};

poperror = function(xhr, selector){
	console.log(xhr);
	$(selector || '#popup-window').html(xhr.responseText);
};

$(function(){
	$('#popup-window').dialog($.extend(popsettings, {
		autoOpen:false,
		buttons:{'Close':popdown},
		modal:true,
		title:'',
		show:	{ effect:'fade', duration:350 },
		hide:	{ effect:'fade', duration:350 },
		open:	function(event,ui) { $('html,body').css('overflow','hidden'); },
		close:	function(event,ui) { $('html,body').css('overflow','initial'); $(this).html(''); }
	}));
});


(function($) {
	$.fn.afpopup = function(url, options) {
		var that = this;
		$('.afpopup-background').remove();
		$('body').append(
			bg = $('<div class="afpopup-background"></div>').click(function(){
				$(that).dialog('close')
			})
		);

		$(that).attr('tabindex', 9999).load(url).dialog($.extend({}, {
			create: function() {
				$(that).parent().css('position', 'fixed');
				$('html,body').css('overflow', 'hidden');
			},

			open: function() {
				$(that).focus();
			},

			close: function() {
				$('html,body').css('overflow', 'visible');
				bg.remove();
				$(that).html('').dialog('destroy');
			}
		}, options));
	}
})(jQuery);


(function($) {
	$.afnotice = function(text, title) {
		$('#af-notice')
		.text(text)
		.addClass('larger')
		.dialog({
			width:	600,
			height:	150,
			title:	title,
			modal:	true,

			buttons: [{
				text: 'Close',
				click: function(){
					$(this).dialog('close');
				}
			}]
		});
	}
})(jQuery);
