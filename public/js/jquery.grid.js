(function($)
{
	jQuery.fn.grid = function(options)
	{
		return this.each(function()
		{
			var config = {
		         autoload: true,
		         emptyMessage: 'No Records Found'
		    };
			var obj = $(this);
			var headerGrid;
			var gridWidth;
			var columnWidths = new Array();
		    var gridLoading;
		    var gridEmpty;
		    var initRow;
		    var columnCount;
		    var currentPage;

		    if (options){$.extend(config, options);}

		    initGrid = function()
		    {
				$(obj).addClass('gen-grid');
				headerGrid = $(obj).find('tr.header');															// set headerGrid as tr.header
				$(headerGrid).find('td:last-child').width($(headerGrid).find('td:last-child').width()+17);	// adjust last column to compensate scrollbar width

				columnCount = $(headerGrid).find('td').length;  													// get column count of header

				$.each($(headerGrid).find('td'), function(i, td){
					columnWidths.push($(td).attr('width'));													// store columns widths of each tr.header td
				})

				gridEmpty = '<tr><td colspan="'+columnCount+'" class="grid-empty"><div class="empty-grid">'+config['emptyMessage']+'</div></td></tr>';	// create empty grid row
				gridLoading = '<tr><td colspan="'+columnCount+'" class="grid-loading"><div class="grid-loader"><div class="ball"></div><div class="ball1"></div></div></td></tr>';	// create loading grid row

				var initRow = $(obj).find('tr.init-row');															// hide initialization row
				$.each($(initRow).find('td'), function (x, td){											// set width of each td in initRow
					$(td).attr('width', columnWidths[x]);
					if (x == columnCount - 1) {
						var last_td_width = $(td).width()-17;
						$(td).attr('width', last_td_width);
					}
				});
				$(initRow).hide();

			}

			layoutGrid = function()
			{

				$(obj).find('table').addClass('grid');															// add class grid to table
				gridWidth = $(headerGrid).width(); 		  													// get width of entire table via header

				var gridControls = $(obj).find('.grid-controls');
				$(gridControls).css('width', gridWidth - 2);													// set width of grid controls

				// create container for inner grid for inner scroll
				var containerGrid = '<tr><td colspan='+columnCount+' style="padding:0px"><div class="inner-grid-wrap"><table width="100%" cellpadding="0" cellspacing="0" border="0" class="inner-grid"></table></div></td></tr>';

				$(containerGrid).appendTo($(obj).find('table.grid'));											// append container grid to main table
				var inner_grid_height = $(obj).find('.inner-grid-wrap').height();								// get height of inner grid wrapper
				$(gridEmpty).appendTo($(obj).find('table.inner-grid'));										// append empty message grid to inner grid
				$(gridLoading).appendTo($(obj).find('table.inner-grid'));										// append loading animation to inner grid
				$(obj).find('.grid-loading div.grid-loader').css('padding-top', inner_grid_height / 2 - 40);	// set height of grid loader animation
				$(obj).find('.grid-empty div.empty-grid').css('padding-top', inner_grid_height / 2 - 20);		// set height of empty grid message
				$(obj).find('.grid-row').remove();																// remove initial grid-row
				$(obj).find('.grid-empty').hide();																// hide empty message row
				$(obj).find('.grid-loading').hide();															// hide loading animation
			}

			populateGrid = function(obj, params)
			{
				obj = obj;
				$(obj).find('.grid-row').remove();																// remove all rows
				var url = $(obj).find('input[name="grid_url"]').attr('value');									// retrieve URL of JSON object
				$(obj).find('.grid-empty').hide();																// hide empty row message
				$(obj).find('.grid-loading').show();															// show loading animation

				var htmlparams=$(obj).find('input[name="parameters"]').val();									// retrieve parameters to pass to script from template
				var params = htmlparams + '&' + params;															// append additional parameters from script

				if ((url.length)>0) {
					var checkcolor = 0;																			// for alternating color
					$.ajax({
						type:"GET",
						url: url,
						data: params,
						success: function(data) {
							$(obj).find('.grid-loading').hide();												// hide loading animation

							if (data['status']=='error') {
								alert(data['message']); 														// if script cannot be loaded or found
							} else {
								var info = data['info'];  														// retrieve info array

								// loop through info elements
								$.each(info, function(key, value){
									$(obj).find('div.grid-controls').find('span.'+key).html(value);				// display information values
								})
								currentPage = info.currentPage;
								if (currentPage==1) {
									obj.find('.grid-controls .page-previous').hide();  							// hide previous page link
								} else {
									obj.find('.grid-controls .page-previous').show();  							// show previous page link
									obj.find('.grid-controls .page-previous').attr('rel', parseFloat(currentPage)-1);  // decrement current page
								}
								if (currentPage>=info.totalPages){
									obj.find('.grid-controls .page-next').hide();   							// hide next page link
								}else{
									obj.find('.grid-controls .page-next').show();    							// show next page link
									obj.find('.grid-controls .page-next').attr('rel', parseFloat(currentPage)+1);   // increment current page
								}
								if (info.recordCount > 0) {
									var rows = data['data'];													// retrive data array
									$.each (rows, function(key, row) {
										var newrow = $(obj).find('tr.init-row').clone();
										$(newrow).removeClass('init-row').addClass('grid-row');
										$.each (row, function (key, value){
											$.each ($(newrow).find('.'+key), function(e){
												if($(this).is('input')){
													if($(this).attr('type')=='checkbox'){						// if element is checkbox
														if(value=='checked'){
															$(this).attr('checked', value);
														}else{
															$(this).attr('value', value);
														}
													}else{
														$(this).attr('value', value);							// if element is other input element
													}
												}

												if($(this).is('select')){										// if element is select dropdown
													$(this).val(value);
												}
												if($(this).is('span')){											// if element is span
													$(this).html(value);
												}
												if($(this).is('a')){
													$(this).attr('rel', value);									// if element is link
													$(this).attr('href', $(this).attr('href')+value);
												}
												if($(this).is('img')){
													$(this).attr('src', $(this).attr('src')+value);				// if element is image
												}

												$(this).removeClass(key);
											});
										})
										if (checkcolor==1) {
											$(newrow).addClass('row-alt-color');								// set alternate row color
											checkcolor=0;
										} else {
											checkcolor=1;
										}
										$(newrow).appendTo($(obj).find('.inner-grid'));							// append row to grid
										$(newrow).show();														// show current row
									});
								} else {
									$(obj).find('.grid-empty').show();											// show empty row message
									$(obj).find('.grid-controls .paging').hide();								// hide paging links
									$(obj).find('.grid-controls .page-nav').hide();
								}
							};
						}
					});
				}
			}

			reloadGrid = function(obj)
			{
				params = 'page='+currentPage;
				populateGrid($(obj), params);
			}


			$(obj).find('.page-link').on('click', function(){
				var pageno = $(this).attr('rel');
				params='page='+pageno;
				populateGrid(obj,params);
				$(obj).find('.gotopage').val('');
				return false;
			});

			$(obj).find('.go-page').on('click', function(){
				var page = parseInt(obj.find('input[name="gotopage"]').val());
				if(page>0){
					if(!(page<=$(obj).find('.totalPages').html())){
						page=$(obj).find('.totalPages').html();
					}
				}else{
					page=1;
				}
				params='page='+page;
				$(obj).find('.totalPages').html(page);
				$(obj).find('input[name="gotopage"]').val(page)
				populateGrid(obj, params);
				return false;
			})


			initGrid();
			layoutGrid();

			if (config['autoload']) {
				populateGrid(obj);
			}


		});
	};
})(jQuery);
