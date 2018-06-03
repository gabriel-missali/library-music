$(document).ready(function(){
	// For A Delete Record Popup
	$('.remove-record-song').click(function() {
		var id = $(this).attr('data-id');
		var url = $(this).attr('data-url');
		var idAlbum = $(this).attr('data-album');
		$(".remove-record-model").attr("action",url);
		$('body').find('.remove-record-model').append('<input name="_method" type="hidden" value="DELETE">');
		$('body').find('.remove-record-model').append('<input name="id" type="hidden" value="'+ id +'">');
		$('body').find('.remove-record-model').append('<input name="album" type="hidden" value="'+ idAlbum +'">');
	});

  $('.remove-record').click(function() {
		var id = $(this).attr('data-id');
		var url = $(this).attr('data-url');
		$(".remove-record-model").attr("action",url);
		$('body').find('.remove-record-model').append('<input name="_method" type="hidden" value="DELETE">');
		$('body').find('.remove-record-model').append('<input name="id" type="hidden" value="'+ id +'">');
	});

	$('.remove-data-from-delete-form').click(function() {
		$('body').find('.remove-record-model').find( "input" ).remove();
	});
	$('.modal').click(function() {
	});

});
