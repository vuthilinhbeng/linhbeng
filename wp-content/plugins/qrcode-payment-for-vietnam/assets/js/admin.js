jQuery(document).ready(function($) {
	if ($('#bc-qr-code-flag').length) {
		var id = $('#bc-qr-code-flag').data('id');
		var input = $('#'+id);
		
		if (input.length) {
			var par = input.closest('fieldset');
			
			if (par.find('.qr-wrap').length == 0) {
				par.append('<a href="javascript:;" class="qr-wrap" style="width: 150px;height: 150px;border: 1px dashed;display: inline-block;background-repeat: no-repeat;background-size: cover;"></a>');
				
				par.find('.qr-wrap').css({
					'background-image': 'url('+input.val()+')',
				});
			}
		}
	}
	
	var qrMedia;
	
	$('body').on('click', '.qr-wrap', function(e) {
		var container = $(this);
		e.preventDefault();
		 
		if (qrMedia) return qrMedia.open();
		
		qrMedia = wp.media.frames.file_frame = wp.media({
			title: 'Select media',
			button: {
			text: 'Select media'
		}, multiple: false });	 
		
		qrMedia.on('select', function() {
			var attachment = qrMedia.state().get('selection').first().toJSON();
			container.closest('fieldset').find('input[type=hidden]').val(attachment.url);
			return container.css({
				'background-image': 'url('+attachment.url+')',
			});
		});
		
		qrMedia.open();
	});
});