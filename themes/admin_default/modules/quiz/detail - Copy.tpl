<!-- BEGIN: main -->
  <table class="table table-striped table-bordered table-hover">
    <caption>
    Thông tin thí sinh
    </caption>
    <thead>
      <tr>
         <td align="center">{LANG.info_full_name}</td>
		<td align="center">{LANG.info_birthday}</td>
		<td align="center">{LANG.info_telephone}</td>
		<td align="center">{LANG.info_email}</td>
		<td align="center">{LANG.info_outcome}</td>
		<td align="center">{LANG.info_time}</td>
      </tr>
    </thead>
	<!-- BEGIN: loop -->
    <tbody>
      <tr>
         <td align="left">{LOOP.full_name}</td>
		<td align="center">{LOOP.birthday}</td>
		<td align="right">{LOOP.telephone}</td>
		<td align="right">{LOOP.email}</td>
		<td align="center">{LOOP.outcome}</td>
		<td align="center">{LOOP.time}</td>
      </tr>
    <!-- END: loop -->
	<tbody>  
</table>
<table>
	<tr>
		<td colspan="2">
		<div style="color:red;font-weight:bold;font-size:16px;padding-bottom:10px">Câu hỏi phụ</div>
		<b style="font-weight:bold">Câu 1:{QUESTION} </b>
		<div style="padding-top: 20px;text-align:justify;font;size:12px;line-height:1.4">
		{CAUPHU}
		</div>
		</td>
	</tr>
	 
</table>

<!-- END: main -->