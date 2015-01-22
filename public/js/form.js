$(document).ready(function()
{
	$('input.datepicker').datepicker({
		inline: true,
		dateFormat: "yy/mm/dd"
	});
})

saveForm = function(formObj)
{
	$(formObj).find('#btn-save').attr('disabled', true).addClass('ui-state-disabled');
	var formObj = $(formObj).parent('.ui-dialog');
	$(formObj).find('.modal-status').html('');
	var form = $(formObj).find('form');
	url = $(form).attr('action');
	var data = $(formObj).find('form').serialize();
	$(formObj).find('form').find('.error').removeClass('error');

	$.ajax({
		url: url,
		data: data,
		method: 'POST',
		success: function(data){
			if (typeof(data) == 'object') {
				if (data.status == 'success') {
					var updateMsg;
					if (data.action == 'update') {
						$(formObj).find('.modal-status').html('Record Updated.');
						$(formObj).find('input[name="reload_grid"]').val('true');
					} else {
						var lastid = data.lastid;
						urledit = $(formObj).find('form input[name="file-url"]').val();
						$(formObj).remove();
						if (urledit != undefined) {
							urledit = urledit+'../edit/?id='+lastid;
							openEditFromSave(urledit);
						}
					}
				} else {
					var errors = data.errors;
					$(formObj).find('.modal-status').html('There are errors in your form.');
					$.each($(errors), function(x, error) {
						var fld = $(formObj).find('form').find('[name="'+error.label+'"]');
						$(fld).addClass('error');
					});
				}
			} else {
				$(formObj).find('.modal-status').html('Processing Error.');
			}
			$(formObj).find('#btn-save').attr('disabled', false).removeClass('ui-state-disabled');
		}
	});

}

openEditFromSave = function(url)
{
	var url = url;
	var newDialog = $('.dialog-dummy').clone();
	$(newDialog).removeClass('dialog-dummy');
	$(newDialog).addClass('dialog');
	$(newDialog).attr('title', 'Record Added.');
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
	var editDialog = openDialog(newDialog, url, options);
	$(editDialog).find('.modal-status').html('Record Added.');
	$(editDialog).find('input[name="reload_grid"]').val('true');
}
