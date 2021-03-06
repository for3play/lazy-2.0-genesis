$(document).ready(function()
{
	var dialogHTML = '<div class="dialog-dummy" title=" &nbsp; "><div class="scroll"><div class="modal-contents"></div></div><div class="clear"></div></div>';

	$(dialogHTML).appendTo('html body');

	$(document).on('click', '.display-modal', function(e){
		var newDialog = $('.dialog-dummy').clone();
		$(newDialog).removeClass('dialog-dummy');
		$(newDialog).addClass('dialog');
		$(newDialog).attr('title', $(this).attr('title'));
		var url = $(this).attr('href');
		var buttons = [{
				id: 'btn-save',
				text: 'save',
				click: function() { saveForm($(newDialog)); }
			},
			{
				text: 'close',
				click: function() {	closeDialog($(newDialog)) }
			}];
		var options = {buttons};
		openDialog(newDialog, url, options);
		e.preventDefault();
	});


	$(document).on('click', '.display-popup', function(e){
		var newDialog = objDialog.clone();
		$(newDialog).attr('title', $(this).attr('title'));
		var url = $(this).attr('href');
		var buttons = [{
				text: 'ok',
				click: function() {	$(this).dialog('close'); }
			}];
		var options = {buttons};
		openDialog(newDialog, url, options);
		e.preventDefault();
	});
})



getData = function(url){
	var url=url;
	return $.ajax({
		async: false,
		url: url
	});
}


openDialog = function(obj, url, options)
{
	var ajax = getData(url);
	var obj = obj;
	var config = {
		 async: false,
	     autoOpen: false,
	     width: 400,
	     resizable: false,
	     modal: false
	};
	if (options) {$.extend(config, options);}
	$(obj).dialog(config);
	$(obj).parent('.ui-dialog').find('.ui-dialog-buttonpane').append('<div class="modal-status"></div>');
	ajax.success(function(data){
		$(obj).find('.modal-contents').html(data);
	})
	$(obj).find('.modal-contents').find('form').append('<input type="hidden" value="'+url+'" style="display:none;" name="file-url">');
	$(obj).dialog('open');
	return $(obj).parent('.ui-dialog');

}

closeDialog = function(obj)
{
	if ($(obj).find('form').find('input[name="reload_grid"]').val()) {
		var grid = $(obj).find('form').find('input[name="parent_grid"]').val();
		reloadGrid(grid);
	}
	$(obj).remove();
}

