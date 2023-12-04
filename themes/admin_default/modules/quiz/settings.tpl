<!-- BEGIN: main -->
<form class="form-inline" action="{NV_BASE_ADMINURL}index.php" method="post">
	<input type="hidden" name ="{NV_NAME_VARIABLE}" value="{MODULE_NAME}" />
	<input type="hidden" name ="{NV_OP_VARIABLE}" value="{OP}" />
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover">
			<tfoot>
				<tr>
					<td style="padding-left: 200px" colspan="2">
					<input class="btn btn-primary" type="submit" value="{LANG.save}" name="Submit1" />
					<input type="hidden" value="1" name="savesetting" /></td>
				</tr>        
			</tfoot>
	
			<tbody>
				<tr>
					<td style="width:150px"><strong>Số câu hỏi dự thi:</strong></td>
					<td>
						<select class="form-control" name="per_page">
							<!-- BEGIN: per_page -->
							<option value="{PER_PAGE.key}"{PER_PAGE.selected}>{PER_PAGE.title}</option>
							<!-- END: per_page -->
						</select>
					</td>
				</tr>
				<tr>
					<td><strong>Thời gian bắt đầu dự thi:</strong></td>
					<td>
						<input class="form-control" name="time_test" id="time_test" value="{time_test}" style="width: 100px;" maxlength="10" readonly="readonly" type="text"/>
						<select class="form-control" name="phour">
							{phour}
						</select>
						:
						<select class="form-control" name="pmin">
							{pmin}
						</select>
					</td>
				</tr>
			</tbody>
			
			<tbody class="">
				<tr>
					<td><strong>Thời gian kết thúc dự thi:</strong></td>
					<td>
						<input class="form-control" name="time_out" id="time_out" value="{time_out}" style="width: 100px;" maxlength="10" readonly="readonly" type="text"/>
						<select class="form-control" name="phour1">
							{phour1}
						</select>
						:
						<select class="form-control" name="pmin1">
							{pmin1}
						</select>
					</td>
				</tr>
			</tbody>
			<tbody class="">
				<tr>
					<td><strong>Tiêu đề dự thi</strong></td>
					<td>
						<input class="form-control" name="title" id="title" value="{DATA.title}" style="width: 500px;" type="text"/>
						 
					</td>
				</tr>
			</tbody>
			<tbody class="">
				<tr>
					<td><strong>Câu hỏi tự luận</strong></td>
					<td>
						<textarea class="form-control" name="cauphu" id="cauphu" style="width: 500px;" >{DATA.cauphu}</textarea>
						 
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</form>
<script>
$(document).ready(function() {
		$("#time_test, #time_out").datepicker({
			showOn : "button",
			dateFormat : "dd/mm/yy",
			changeMonth : true,
			changeYear : true,
			showOtherMonths : true,
			buttonImage : nv_siteroot + "images/calendar.gif",
			buttonImageOnly : true
		});
})
</script>
<!-- END: main -->