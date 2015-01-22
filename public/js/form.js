$(document).ready(function(){
	$('input.datepicker').datepicker({
		inline: true,
		dateFormat: "yy/mm/dd"
	});

})

saveForm = function(formObj) {
	var formObj = $(formObj).parent('.ui-dialog');
	$(formObj).find('.modal-status').html('');
	var form = $(formObj).find('form');
	url = $(form).attr('action');
	$(formObj).find('#btn-save').attr('disabled', true).addClass('ui-state-disabled');
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
						updateMsg = 'Record Updated.';
					} else {
						updateMsg = 'Record Added.';
					}
					$(formObj).find('.modal-status').html(updateMsg);
					$(formObj).find('input[name="reload_grid"]').val('true');
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
