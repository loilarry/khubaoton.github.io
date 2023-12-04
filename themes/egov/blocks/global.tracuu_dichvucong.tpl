<!-- BEGIN: js  -->
<div class="row">
  <div class="col-lg-24" style="text-align: center;">
    <div class="input-group" style="width: 100%;">
      <input type="text" class="form-control" id="sobiennhan" placeholder="Nhập số biên nhận">
    </div>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="margin-top: 5%;">Tra Cứu</button>

  </div>
</div><!-- /.row -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="modal-title" id="exampleModalLabel">Thông tin chi tiết hồ sơ</h4>
      </div>

      <div class="modal-body">

		<table class="table table-striped">
			<tbody>
			  <tr>
				<td>Xin chào Ông/Bà:</td>
				<td  id="hovaten"></td>
			  </tr>
			  <tr>
				<td>Mã hồ sơ:</td>
				<td id="mahoso"></td>
			  </tr>
			  <tr>
				<td>Lĩnh vực:</td>
				<td id="linhvuc"></td>
			  </tr>
			  <tr>
				<td>Tên thủ tục:</td>
				<td id="thutuc"></td>
			  </tr>
			  <tr>
				<td>Cơ quan tiếp nhận:</td>
				<td id="coquantiepnhan"></td>
			  </tr>
			  <tr>
				<td>Ngày nhận:</td>
				<td id="ngaynhan"></td>
			  </tr>
			  <tr>
				<td>Ngày hẹn trả:</td>
				<td id="ngaytra"></td>
			  </tr>
			  <tr>
				<td>Trạng thái hồ sơ:</td>
				<td id="trangthai"></td>
			  </tr>
			</tbody>
		  </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
$('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
//   var recipient = button.data('whatever') // Extract info from data-* attributes
  var sbn = $("#sobiennhan").val();
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  //modal.find('.modal-title').text('qqqqNew message to ' + recipient)
  var settings = {
  "url": "https://motcua-service.tayninh.gov.vn/WebServiceZalo.asmx/tracuuhs",
  "method": "POST",
  "timeout": 0,
  "headers": {
    "Content-Type": "application/x-www-form-urlencoded"
  },
  "data": {
    "mahs": sbn
  }
};

$.ajax(settings).done(function (response) {
//   console.log(response);
$("#hovaten").text(response[0].TenKhachHang);
$("#mahoso").text(sbn);
$("#linhvuc").text(response[0].TenLinhVuc);
$("#coquantiepnhan").text(response[0].TenDonVi);
$("#thutuc").text(response[0].TenLoaiHoSo);
$("#ngaynhan").text(response[0].NgayNhan);
$("#ngaytra").text(response[0].NgayHenTra);
$("#trangthai").text(response[0].TenTinhTrang);

});
//   modal.find('.modal-body input').val(sbn)
})


</script>

<!-- END: js -->
<!-- BEGIN: main  -->
<!-- END: main  -->