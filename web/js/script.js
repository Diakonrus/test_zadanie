$(document).on('click', '.single_image', function(){
	var img = $(this).find('img').attr('src');

	var html = '<center><img src="/'+img+'" style="max-width:500px;" /></center>';
	$('#myModalLabel').empty().append('Изображение');
	$('#myModal').find('.modal-body').empty('.modal-body').append(html);
	$('#myModal').modal('show');

	return false;
});

$(document).on('click', '.show_modal_books_edit', function(){

	$.ajax({
		url:     '/books/ajax',
		type:     'POST',
		dataType: 'json',
		data: {id: $(this).data('id')},
		success: function(response) {

			var html = '<table class="table table-striped table-bordered detail-view">';
			html += '<tbody>';

			html += '<tr><th>Название</th><td>'+response['name']+'</td></tr>';
			html += '<tr><th>Превью</th><td>'+response['preview']+'</td></tr>';
			html += '<tr><th>Автор</th><td>'+response['author']+'</td></tr>';
			html += '<tr><th>Дата выхода книги</th><td>'+response['date']+'</td></tr>';
			html += '<tr><th>Дата добавления</th><td>'+response['date_create']+'</td></tr>';
			html += '<tr><th>Дата обновления</th><td>'+response['date_update']+'</td></tr>';

			html += '</tbody></table>';
			$('#myModal').find('.modal-body').empty('.modal-body').append(html);
			$('#myModal').modal('show');
		}
	});



	return false;
});