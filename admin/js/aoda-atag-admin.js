(function( $ ) {
	'use strict';

	$(function() {
		$("#form-total").steps({
			headerTag: "h2",
			bodyTag: "section",
			transitionEffect: "fade",
			enableAllSteps: true,
			stepsOrientation: "vertical",
			autoFocus: true,
			transitionEffectSpeed: 500,
			titleTemplate : '<div class="title">#title#</div>',
			onStepChanged: function (event, current, next) {
				if (current == $('section').length - 1) {
					applyRegex();
				}
			},
			onFinished: function (event, currentIndex) {
				event.preventDefault();
				$('#aoda-atag-options').submit();
			},
			labels: {
				next : 'Preview',
				finish: 'Save Changes',
				previous: "Back"
			},
		});

		$('#aoda-atag-options').submit(function(e) {
			jQuery('#ajax-saving').removeAttr('class').fadeIn('fast');
			
			$(this).ajaxSubmit({
			   success: function(){
				jQuery('#ajax-saving').addClass('success-animation');
				//jQuery('#ajax-saving').fadeOut('slow');
				setTimeout(function(){
					jQuery('#ajax-saving').fadeOut();
				},500);
			   }, 
			   timeout: 5000
			});
			return false; 
		});
	});

	function applyRegex() {
		//reset the output text element
		$('#outputText').html($('#exampleText').html());

		var siteUrl = $('#siteUrl').val();
		var domains = $('#aoda-atag-domains').val().split(/\n/);
		domains.map(domain => getHost);
		domains = domains.filter(domain => domain.length > 0);
		domains.push(siteUrl);
		$('#outputText').find('a').each(function (index, anchorTag) {
			var host = getHost(anchorTag.hostname);
			if(domains.indexOf(host) == -1) {
				if($('#aoda-atag-target').val() != -1) {
					anchorTag.target = $('#aoda-atag-target').val();
				}
				anchorTag.innerHTML = anchorTag.innerHTML + $('#aoda-atag-element').val();
			}
		});
	}

	function getHost(address) {
		var a = document.createElement('a');
		a.href = address;
		var hostname = a.hostname;
		if(address != "localhost" && hostname == "localhost") {
			return address;
		}
		return hostname;
	}

})( jQuery );
