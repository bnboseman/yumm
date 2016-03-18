jQuery(document).ready(function($){
	$( "div[class^='snippet-']" ).click(function() {
		var id = $(this).attr('data-post-id');
		var fulltext = $( ".fulltext-" + id );
		if ( $(this).html().length < fulltext.html().length ) {
			$(this).hide();
			$( ".fulltext-" + id ).slideToggle("fast");
		}
	});
	
	$( "div[class^='fulltext-']" ).click(function() {
		var id = $(this).attr('data-post-id');
		$(this).hide();
		$( ".snippet-" + id ).slideToggle("fast");
	});
});