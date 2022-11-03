jQuery(document).ready(function($) {
	if ($('#qrc-result').length) {
		let container = $('#qrc-result');
		let text = '';
		
		switch (container.data('type')) {
			case 'momo':
				text = container.data('id');
				break;
				
			case 'viettelpay':
				text = JSON.stringify(container.data('id'));
				break;
				
			default:
				text = '';
		}
		
		if (text === '') {
			container.html('<img src="'+container.data('id')+'" />');
		} else {		
			let qrcode = new QRCode(document.getElementById('qrc-result'), {
				text: text,
				width: 128,
				height: 128,
				colorDark : "#000000",
				colorLight : "#FFFFFF",
				correctLevel : QRCode.CorrectLevel.H
			});
		}
		
		setTimeout(function() {
			let r = $('#qrc-result');
			r.closest('.bc-qr-body').find('.bc-qr-button.download').attr({
				href: r.find('img').attr('src'),
			});
		}, 100);
	}
	
	$('body').on('click', '.remind', function() {
		let container = $(this);
		return swal({
			title: container.data('title'),
			text: '',
			icon: 'success',
			button: container.data('close'),
			className: 'bc-qr-swal',
		});
	});
});