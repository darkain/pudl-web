'use strict';


var afDropzone = function(form, url, target, maxSize, thumbSize) {
	$(form).each(function() {
		if (this.dropzone) return;

		var afdz = new Dropzone(this, {
			url:				url,
			thumbnailWidth:		thumbSize ? null : 200,
			thumbnailHeight:	thumbSize || 200,
			maxFilesize:		maxSize || 32,
			clickable:			target,
			dictDefaultMessage:	'',
			withCredentials:	true,
			acceptedFiles:		'image/*',

			init: function() {
				this.on('addedfile', function(file){
					$(file.previewElement).insertAfter(target);
				});
			},

			success: function(file, text) {
				$(text).insertAfter( $(file.previewElement) );
				$(file.previewElement).remove();
			},

			error: function(file, message) {
				if (file.retry === undefined) file.retry = 0;
				file.retry++;
				if (file.retry < 3) {
					afdz.uploadFile(file);
				} else {
					console.log(file, message);
					alert('File: ' + file.name + '\n\n' + message);
					$(file.previewElement).remove();
				}
			},
		});
	});
};
