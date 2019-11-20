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
		var regex = new RegExp(`<a(.+?(?=href))href="((http|https):\\/\\/(?!${siteUrl})[\\w\\.\\/\\-=?#]+)"(.*?)>(.*?)<\\/a>`, 'gi');

		var appendElement = $('#aoda-atag-element').val();
		var replaceAnchor = `<a$1href='$2'$4>$5 ${appendElement}</a>`;

		return $('#exampleText').html().replace(regex, replaceAnchor);
	}

})( jQuery );
