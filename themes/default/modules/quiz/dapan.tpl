<!-- BEGIN: main -->
<div style="background: #fff;min-height: 800px;width: 100%">
<style>
span.throught{font-weight:bold;color:red;strike-weight:bold;text-decoration: line-through}
#Quiz p{padding: 0px; line-height: 1.4;  margin: 0;}
</style>
 <table id="Quiz" width="100%" border="0" style="background: #fff; padding: 10px;">
    <tr>
      <td colspan="2"><P></P>
        <b style="text-align:center;color:red;">{TITLE} </b><br/>
        <i style="font-weight: bold;">Bạn đã trả lời đúng {DAPANDUNG}/{COUNT} câu hỏi với thời gian là: {TIME}</i></td>
    </tr>
	 <!-- BEGIN: loopq -->
    <tr>
		<td colspan="2">
			<p><input type="hidden" name="question_id_{STT}" value="{QUESTION.question_id}"/>
				<strong> {STT}. {QUESTION.question}</strong><br />
			</p>
			<p>
			 <!-- BEGIN: list -->
			  <label style="line-height: 1.4"> <img style="height: 20px;padding-right: 8px;vertical-align: middle;" src="{NV_BASE_SITEURL}themes/{TEMPLATE}/images/{MODULE}/{Q.icon}"/><span  {Q.color} {Q.throught}>{Q.ans}) {Q.title}</span></label> <br />
			 <!-- END: list -->
			</p>
			<div style="width: 100%; height: 10px;">
		</td>
    </tr>
	 <!-- END: loopq -->
  </table>
</div>
<!-- END: main -->