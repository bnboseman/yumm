jQuery(document).ready(function($){
	$( "span[class^='snippet-']" ).click(function() {
		var id = $(this).attr('data-post-id');
		var fulltext = $( ".fulltext-" + id );
		if ( $(this).html().length < fulltext.html().length ) {
			$(this).hide(250);
			$( ".fulltext-" + id ).fadeToggle(1000);
		}
	});
	
	$( "span[class^='fulltext-']" ).click(function() {
		var id = $(this).attr('data-post-id');
		$(this).hide(250);
		$( ".snippet-" + id ).fadeToggle(1000);
	});
});