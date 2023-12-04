<!-- BEGIN: main -->
<div id="content">
    <!-- BEGIN: error_warning -->
    <div class="alert alert-danger">
        <i class="fa fa-exclamation-circle"></i> {error_warning}
        <button type="button" class="close" DATA-dismiss="alert">&times;</button>
        <br>
    </div>
    <!-- END: error_warning -->
 
    <div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title" style="float:left"><i class="fa fa-pencil"></i> {CAPTION}</h3>
			<div class="pull-right">
				<button type="submit" DATA-toggle="tooltip" class="btn btn-primary" title="{LANG.save}"><i class="fa fa-save"></i></button> 
				<a href="{CANCEL}" DATA-toggle="tooltip" class="btn btn-default" title="{LANG.cancel}"><i class="fa fa-reply"></i></a>
			</div>
			<div style="clear:both"></div>
		</div>
		<div class="panel-body">
			<form action="" method="post"  enctype="multipart/form-DATA" id="form-question" class="form-horizontal">
		
				<input type="hidden" name="question_id" value="{DATA.question_id}">
				<input type="hidden" name="save" value="1">
		
			<div class="form-group required">
				<label class="col-sm-4 control-label" for="input-question">{LANG.question_name}</label>
				<div class="col-sm-20">
					<textarea type="text" name="question" placeholder="{LANG.question_name}" id="input-question" class="form-control">{DATA.question}</textarea>
					<!-- BEGIN: error_question --><div class="text-danger">{error_question}</div><!-- END: error_question -->
				</div>
			</div>
			
 			<div class="form-group required">
				<label class="col-sm-4 control-label" for="input-question">{LANG.question_answer}</label>
				<div class="col-sm-20">
					<div class="radio" style="display:inline-block">
						<label><input type="radio" name="answer" {answer_0} value="a" style="margin-top: 0;">a)</label>	
					</div>
					<input class="form-control" style="width: 400px;display: inline-block;" type="text" maxlength="255" value="{DATA.title_0}"  name="title_0" id="title_0">
					<input type="hidden" value="{DATA.list_id_0}" name="list_id_0">
					<input type="hidden" value="{DATA.active_0}" name="active_0"> 
					<div style="clear:both; height: 6px"></div>
					
					<div class="radio" style="display:inline-block">
						<label><input type="radio" name="answer" {answer_1} value="b" style="margin-top: 0;">b)</label>	
					</div>
					<input class="form-control" style="width: 400px;display: inline-block;" type="text" maxlength="255" value="{DATA.title_1}"  name="title_1" id="title_1">
					<input type="hidden" value="{DATA.list_id_1}" name="list_id_1">
					<input type="hidden" value="{DATA.active_1}" name="active_1"> 
					<div style="clear:both; height: 6px"></div>
					
					<div class="radio" style="display:inline-block">
						<label><input type="radio" name="answer" {answer_2} value="c" style="margin-top: 0;">c)</label>	
					</div>
					<input class="form-control" style="width: 400px;display: inline-block;" type="text" maxlength="255" value="{DATA.title_2}"  name="title_2" id="title_2">
					<input type="hidden" value="{DATA.list_id_2}" name="list_id_21">
					<input type="hidden" value="{DATA.active_2}" name="active_2"> 
					<div style="clear:both; height: 6px"></div>
					
					<div class="radio" style="display:inline-block">
						<label><input type="radio" name="answer" {answer_3} value="d" style="margin-top: 0;">d)</label>	
					</div>
					<input class="form-control" style="width: 400px;display: inline-block;" type="text" maxlength="255" value="{DATA.title_3}"  name="title_3" id="title_3">
					<input type="hidden" value="{DATA.list_id_3}" name="list_id_3">
					<input type="hidden" value="{DATA.active_3}" name="active_3"> 
					
				</div>
			</div>
 
 
 
			
			</form>
		</div>
	</div>
</div>
<script type="text/javascript" src="{NV_BASE_SITEURL}modules/{MODULE_FILE}/js/footer.js"></script>
 
<script type="text/javascript">
  
</script>
<!-- END: main -->