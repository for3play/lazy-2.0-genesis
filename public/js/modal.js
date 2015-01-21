$(document).ready(function()
{
	var objDialog = $('.dialog').clone();

	$(document).on('click', '.display-modal', function(e){
		var newDialog = objDialog.clone();
		$(newDialog).attr('title', $(this).attr('title'));
		var url = $(this).attr('href');
		openDialog(newDialog, url);
		e.preventDefault();
	});
})

openDialog = function(obj, url, options)
{
	$(obj).dialog({
		autoOpen: false,
		width: 400,
		resizable: false,
		modal: true,
		buttons: [
			{
				text: 'close',
				click: function() {
					$(this).dialog( "close" );
				}
			}
		]
	});

	var url=url;
	$.ajax({
		url: url,
		success:function(data){
			$(obj).find('.modal-contents').html(data);
			$(obj).dialog('open');
		}
	});


}

