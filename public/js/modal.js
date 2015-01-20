$(document).ready(function()
{
	var objDialog = $('.dialog').clone();
	$(document).on('click', '.display-modal', function(e){
		var newDialog = objDialog.clone();
		$(newDialog).attr('title', $(this).attr('title'));
		openDialog(newDialog);
		e.preventDefault();
	});

})

openDialog = function(obj, options)
{
	$(obj).dialog({
		autoOpen: false,
		width: 400,
		resizable: false,
		buttons: [
			{
				text: 'Ok',
				click: function() {
					$(this).dialog( "close" );
				}
			},
			{
				text: 'Cancel',
				click: function() {
					$(this).dialog( "close" );
				}
			}
		]
	});
	$(obj).dialog('open');
}

