<!-- BEGIN: main -->


<!-- BEGIN: noneinfo -->
<tr>
  <td colspan="2">
  <h3>{content}</h3>
  </td>
</tr>
<!-- END: noneinfo -->


<!-- BEGIN: info -->
<tr>
	<td colspan="2" class="text-center">
	<div id="countdown">&nbsp;</div>
	<script type="text/javascript">
			$(function(){	
				$('#countdown').countup();	
			});
			var ftop = $('#countdown').offset().top - $(window).scrollTop();
			var fleft = $('#countdown').offset().left;
			$('#countdown').css({position: 'fixed', left: fleft + 'px', top: ftop + 'px'});
	</script>
	</td>
</tr>
<tr>
  <td colspan="2"><b style="text-align:center; ">{TITLE}</b><br/>
    <i>Bài dự thi chỉ hợp lệ khi các câu hỏi được trả lời đủ</i></td>
	<input type="hidden" name="info_id" id="infoid" value="{INFO_ID}"/>
	<input name="numq" id="numq" value="{NUMQ}" type="hidden" />
</tr>
<!-- BEGIN: loopq -->
<tr>
  <td colspan="2"><p>
      
      <input type="hidden" name="question_id_{STT}" value="{QUESTION.question_id}"/>
      <strong > {STT}. {QUESTION.question}</strong><br />
    </p>
    <p> 
      <!-- BEGIN: list -->
      <label class="quiz">
        <input type="radio" name="Cau{STT}" value="{Q.answer}" id="Cau{STT}_{Q.t}" />
        {Q.v}) {Q.title}</label>
      <br />
      <!-- END: list --> 
      
    </p></td>
</tr>
<!-- END: loopq -->
<tr>
  <td colspan="2" style="font-size: 16px"><b>Câu hỏi tự luận</b></td> 
</tr>
 <tr>
  <td colspan="2"><b>{CAUPHU} </b> 
  <br><textarea name="cauphu" id="cauphu" cols="45" rows="5" style="width:100%"></textarea></td>
</tr>
 
<tr>
  <td><button type="submit" class="positive" id="btsend"> <img src="{NV_BASE_SITEURL}themes/{TEMPLATE}/images/quiz/gui.png" alt=""/> Gửi bài </button>
    <br>
    <div id="hienloi"></div></td>
  <td>&nbsp;</td>
</tr>
<!-- END: info -->
<!-- END: main -->