<!-- BEGIN: main -->
<div id="content">
    <!-- BEGIN: success -->
		<div class="alert alert-success">
			<i class="fa fa-check-circle"></i> {SUCCESS}
		</div>
	<!-- END: success -->
    <div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title" style="float:left"><i class="fa fa-pencil"></i> {LANG.question_list}</h3>
			 <div class="pull-right">
				<a href="{ADD_NEW}" data-toggle="tooltip" data-placement="top" title="{LANG.add}" class="btn btn-success"><i class="fa fa-plus"></i></a> 
				<button type="button" data-toggle="tooltip" data-placement="top" title="{LANG.delete}" class="btn btn-danger" id="button-delete">
					<i class="fa fa-trash-o"></i>
				</button>
			</div>
			<div style="clear:both"></div>
		</div>
		<div class="panel-body">
			<!-- <div class="well">
				<div class="row">	
					<form action="{NV_BASE_ADMINURL}index.php" method="get">
					<input type="hidden" name ="{NV_NAME_VARIABLE}"value="{MODULE_NAME}" />
					<input type="hidden" name ="{NV_OP_VARIABLE}"value="{OP}" />
					<div class="col-sm-12">
						<div class="form-group">
							<label class="control-label" for="input-album-name">{LANG.rows_title}</label>
							<input type="text" name="filter_title" value="{DATA.filter_title}" placeholder="{LANG.rows_title}" id="input-album-name" class="form-control">
						</div>
						<div class="form-group">
							<label class="control-label" for="input-category">{LANG.rows_category}</label>
							<select name="filter_category" id="input-category" class="form-control">
								<option value="">   --------  </option>
								 
							</select>
						</div>
						<div class="form-group">
							<label class="control-label" for="input-lev">{LANG.rows_lev}</label>
							<select name="filter_lev" class="form-control" >
								<option value="" >   --------  </option>
								 
							 </select>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="form-group">
							<label class="control-label" for="input-status">{LANG.rows_status}</label>
							<select name="filter_status" id="input-status" class="form-control">
								<option value="">   --------  </option>
								 
							</select>
						</div>
						<div class="form-group">
							<label class="control-label" for="input-date-added">{LANG.rows_date_added}</label>
							<input type="text" name="filter_date_added" value="{DATA.filter_date_added}" placeholder="{LANG.column_date_added}" id="input-date-added" class="form-control">
						</div>
						<input type="hidden" name ="checkss" value="{TOKEN}" />
						<button type="submit" style="float: none !important ;margin-top: 24px;" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> {LANG.search}</button>
					</div>
					</form>
				</div>
			</div> -->
			<form action="" method="post" enctype="multipart/form-data" id="form-rows" class="form-horizontal">
				
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr >
							<td class="text-center" width="10">
								<input name="check_all[]" type="checkbox" value="yes" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" >
							</td>     
 							<td align="center"><a href="{URL_QUESTION}">{LANG.question_name}</a></td>
							<td align="center">{LANG.question_answer}</td>
							<td class="text-center"width="150">{LANG.action}</td>
						</tr>
					</thead>
					
					<tbody>
					<!-- BEGIN: loop -->
						<tr class="text-center" id="group_{LOOP.question_id}">
							<td class="text-center">
								<input type="checkbox" name="selected[]" value="{LOOP.question_id}" >
							</td>
		 
							<td align="left">{LOOP.question}</td>
							<td align="left">{LOOP.answer}) {LOOP.title}</td>
							<td class="text-center">
 								<a href="{LOOP.edit}" data-toggle="tooltip" title="{LANG.edit}" class="btn btn-primary"><i class="fa fa-pencil"></i></a> 
								<a href="javascript:void(0);" onclick="delete_question('{LOOP.question_id}', '{LOOP.token}')" data-toggle="tooltip" title="{LANG.delete}" class="btn btn-danger"><i class="fa fa-trash-o"></i>
							</td>
						</tr>
					<!-- END: loop -->
					<tbody>
				</table>
			</form>
			<!-- BEGIN: generate_page -->
			<div class="row">
				<div class="col-sm-24 text-left">
				<div style="clear:both"></div>
				{GENERATE_PAGE}	
				</div>
				 
			</div>
			<!-- END: generate_page -->
		</div>
	</div>
</div>
 
<script type="text/javascript" src="{NV_BASE_SITEURL}modules/{MODULE_FILE}/js/footer.js"></script>
<script type="text/javascript">
function delete_question(question_id, token) {
	if( confirm( '{LANG.question_confirm}' )) 
	{
		$.ajax({
			url: script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=listquiz&action=delete&nocache=' + new Date().getTime(),
			type: 'post',
			dataType: 'json',
			data: 'question_id=' + question_id + '&token=' + token,
			success: function(json) {
				
				$('.alert').remove(); 
				
				if (json['error']) {
					$('#content').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
				}
				
				if (json['success']) {
					$('#content').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');
					 $.each(json['id'], function(i, id) {
						$('#group_' + id ).remove();
					});
				}		
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	}
}
$('#button-delete').on('click', function() {
	if(confirm('{LANG.question_confirm}')) 
	{
		var listid = [];
		$("input[name=\"selected[]\"]:checked").each(function() {
			listid.push($(this).val());
		});
		if (listid.length < 1) {
			alert("{LANG.select_one}");
			return false;
		}
	 
		$.ajax({
			url: script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=listquiz&action=delete&nocache=' + new Date().getTime(),
			type: 'post',
			dataType: 'json',
			data: 'listid=' + listid + '&token={TOKEN}',
			success: function(json) {
				 
				$('.alert').remove(); 
				 
				if (json['error']) {
					$('#content').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
				}
 
				if (json['success']) {
					$('#content').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');
					 $.each(json['id'], function(i, id) {
						$('#group_' + id ).remove();
					});
				}		
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	}	
});
</script>
<!-- END: main -->