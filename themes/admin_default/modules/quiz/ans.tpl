<!-- BEGIN: main -->
<form class="form-inline" name="myform" id="myform" method="post" action="{del_link}">
  <table class="table table-striped table-bordered table-hover">
    <caption>
    DANH SÁCH ĐĂNG KÝ THAM GIA
    </caption>
    <thead>
      <tr>
        <td>&nbsp;</td>
        <td >Họ và tên</td>
        <td class="text-center">Lớp</td>
        <td class="text-center" >Trường</td>
        <td class="text-center">Khoa</td>
        <td class="text-center">Điện thoại</td>
        <td class="text-center">Dự đoán</td>
        <td class="text-center">Kết quả</td>
        <td width="100" class="text-center">Chức năng</td>
      </tr>
    </thead>
	<!-- BEGIN: loop -->
    <tbody>
      <tr>
        <td><input type="checkbox" class="ck" value="{infoid}"/></td>
        <td>{DATA.hoten}</td>
        <td>{DATA.lop}</td>
        <td>{DATA.truong}</td>
        <td>{DATA.tendonvi}</td>
        <td>{DATA.diachi}</td>
        <td class="text-center">{DATA.dudoan}</td>
        <td class="text-center">{DATA.ketqua}</td>
        <td class="text-center"><a class="delete" href="{link_del}">Xóa</a></td>
      </tr>
    <!-- END: loop -->
	<tbody>  
	<tfoot>
		<tr>
		  <!-- <td colspan="6"><a href="#" id="checkall">Chọn tất cả</a> | <a href="#" id="uncheckall">Bỏ chọn</a> |<a href="#" id="delall">Xóa chọn</a></td>
		   --><td colspan="9">
		  <!-- BEGIN: generate_page -->
			<tr class="footer">
				<td>
					{GENERATE_PAGE}
				</td>
			</tr>
			<!-- END: generate_page -->
			</td>
		</tr>
	</tfoot>	
	</table>
	
</form>
<div class="table-responsive">
	<table class="table table-striped table-bordered table-hover">
		<tbody>
		<tr>
			<td width="120"><strong>Xuất danh sách</strong></td>
			<td width="50"><strong>Từ ngày</strong></td>
			<td width="280">
			<input class="form-control" style="width:80px" type="text" name="date1" id="date1"  />
			<strong> Đến </strong>
			<input class="form-control" style="width:80px" type="text" name="date2" id="date2" /></td>
			<td><a class="xuat_xls" href="{URL_XLS}">XUẤT EXCEL</a></td>
			<td colspan="2"></td>
		</tr>
	    </tbody>
	</table>
</div>
<div style="margin-top:20px" class="text-center" id="msgshow">&nbsp;</div>
<script type='text/javascript'>
	$(document).ready(function() {
		$("#date1,#date2").datepicker({
			showOn : "button",
			dateFormat : "dd/mm/yy",
			changeMonth : true,
			changeYear : true,
			showOtherMonths : true,
			buttonImage : nv_siteroot + "images/calendar.gif",
			buttonImageOnly : true
		});
	});
    $(function(){
		$('a.xuat_xls').click(function(event){
            event.preventDefault();
			var date1 = $("input#date1").val();
            var date2 = $("input#date2").val();
            var href = $(this).attr('href');
			$.ajax({
				type: 'POST',
                url: href,
                data: '&date1='+ date1 +'&date2='+ date2,
                success: function(data){
                    $('#msgshow').html(data);
                }
            });
        });
        $('#checkall').click(function(){
            $('input:checkbox').each(function(){
                $(this).attr('checked', 'checked');
            });
        });
        $('#uncheckall').click(function(){
            $('input:checkbox').each(function(){
                $(this).removeAttr('checked');
            });
        });
        $('#delall').click(function(){
            if (confirm("Bạn có chắc chắn muốn xóa ?")) {
                var listall = [];
                $('input.ck:checked').each(function(){
                    listall.push($(this).val());
                });
                if (listall.length < 1) {
                    alert("Bạn cần chọn ít nhất một functiond dể xóa");
                    return false;
                }
                $.ajax({
                    type: 'POST',
                    url: '{URL_DEL}',
                    data: 'listall=' + listall,
                    success: function(data){
                       window.location = '{URL_DEL_BACK}';
                    }
                });
            }
        });
		
        $('a.delete').click(function(event){
            event.preventDefault();
            if (confirm("Bạn có chắc chắn muốn xóa ?")) {
                var href = $(this).attr('href');
                $.ajax({
                    type: 'POST',
                    url: href,
                    data: '',
                    success: function(data){
						alert(data);
                        //window.location = '{URL_DEL_BACK}';
                    }
                });
            }
        });
    });
</script>
<!-- END: main -->