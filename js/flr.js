$( document ).ready(function() {
	$( ".preview" ).on( "click", function() {
		var photo_id = $(this).attr('id');
		var photo_src = $(this).attr('photo_src');
		var photo_label = $(this).attr('alt');
		
		$('#img_'+photo_id).attr('src', photo_src );
		$('#h2_'+photo_id).html(photo_label + ' Size');
	});
	
	$( ".img_image" ).on( "click", function() {
		var photo_id = $(this).attr('id').replace("img_", "");;
		$('#span_'+photo_id).toggle();
	});
			
});