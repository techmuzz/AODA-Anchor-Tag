(function( $ ) {
	'use strict';

	$(function(){
		$('#outputText').html(applyRegex());

		$('#refreshExampleButton').on('click', function(e){
			e.preventDefault();
			$('#outputText').html(applyRegex());
		});
		
		$('#aoda-atag-element').keyup(function() {			
			$('#outputText').html(applyRegex());
		});
	});

	function applyRegex() {
		var siteUrl = $('#siteUrl').val();

		var domains = $('#aoda-atag-domains').val().split(/\n/);
		domains.map(domain => domain.trim());
		domains = domains.filter(domain => domain.length > 0);
		domains.push(siteUrl);
		domains = domains.join("|");

		var regex = new RegExp(`<a(.+?(?=href))href="((http|https):\\/\\/(?!(${domains}))[\\w\\.\\/\\-=?#]+)"(.*?)>(.*?)<\\/a>`, 'gi');
		var appendElement = $('#aoda-atag-element').val();
		var replaceAnchor = `<a$1href='$2'$5>$6 ${appendElement}</a>`;

		return $('#exampleText').html().replace(regex, replaceAnchor);
	}

})( jQuery );
