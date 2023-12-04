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
        <td class="text-center">Khoa</td>
        <td class="text-center">Điện thoại</td>
        <td class="text-center">Địa chỉ</td>
        <td class="text-center">Dự đoán</td>
        <td class="text-center">Kết quả</td>
         <td class="text-center">Thời gian</td>
      </tr>
    </thead>
	<!-- BEGIN: loop -->
    <tbody>
      <tr>
        <td><input type="checkbox" class="ck" value="{infoid}"/></td>
        <td><a href="{DATA.link}">{DATA.hoten}</a></td>
        <td>{DATA.lop}</td>
        <td>{DATA.tendonvi}</td>
        <td>{DATA.dienthoai}</td>
        <td>{DATA.diachi}</td>
        <td class="text-center">{DATA.dudoan}</td>
        <td class="text-center">{DATA.ketqua}/{DATA.per_page}</td>
        <td class="text-center">{DATA.time}</td>
      </tr>
    <!-- END: loop -->
	<tbody>  
	<tfoot>
		<tr>
		  <!-- <td colspan="6"><a href="#" id="checkall">Chọn tất cả</a> | <a href="#" id="uncheckall">Bỏ chọn</a> |<a href="#" id="delall">Xóa chọn</a></td>
		   -->
		   <td colspan="10">
		  <!-- BEGIN: generate_page -->

					{GENERATE_PAGE}
			<!-- END: generate_page -->
			</td>
		  
		</tr>
		<tr>
			<td colspan="8">
			<strong>Tổng số thí sinh tham gia: {tongso}</strong>
			</td>
			<td align="right">
			<span class="add_icon"> <a class="xuat_xls" href="javascript:void(0);" onclick="open_win()"><strong>Xuất Danh Sách </strong></a> </span>
			</td>
		</tr>
		
	</tfoot>	
	</table>
	
</form>

<div style="margin-top:20px" class="text-center" id="msgshow">&nbsp;</div>
<script type='text/javascript'>
function open_win()
{
	window.open("{xuat_xls}&save=1")
}   
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
                        window.location = '{URL_DEL_BACK}';
                    }
                });
            }
        });
    });
</script>
<!-- END: main -->