<!-- BEGIN: main -->
<script type="text/javascript" charset="utf-8">
			$(function () {
				var tabContainers = $('div.tabs > div');
				tabContainers.hide().filter(':first').show();              
				 $('div.tabs ul.tabNavigation a').click(function () {
					tabContainers.hide();
					tabContainers.filter(this.hash).show();
					$('div.tabs ul.tabNavigation a').removeClass('selected');
					$(this).addClass('selected');
					return false;
				 }).filter(':first').click();
			});
</script>
<style type="text/css" media="screen">
	<!--
	H1 {
		margin-bottom: 2px;
		font-family: Garamond, "Times New Roman", Times, Serif;
	}
	DIV.container {
		margin: auto;
		width: 90%;
		margin-bottom: 10px;
	}
	UL.tabNavigation {
		list-style: none;
		margin: 0;
		border-bottom-width: thin;
		border-bottom-style: dotted;
		border-bottom-color: #999;
		padding-top: 0;
		padding-right: 0;
		padding-bottom: 7px;
		padding-left: 0;
	}
	UL.tabNavigation LI {
		display: inline;
	}
	UL.tabNavigation LI A {
		padding: 7px 7px;
		background-color: #333;
		color: #fff;
		text-decoration: none;
		-moz-border-radius-topleft: 5px;
		-webkit-border-top-left-radius: 5px;
		-moz-border-radius-topright: 5px;
		-webkit-border-top-right-radius: 5px;
		font-weight: bolder;
	}
	UL.tabNavigation LI A.selected,  UL.tabNavigation LI A:hover {
		padding-top:10px;
		background-color: #F00;
		color: #FFF;
	}
	UL.tabNavigation LI A:focus {
		outline: 0;
	}
	div.tabs > div {
		padding: 5px;
		margin-top: 3px;
	}
	div.tabs > div h2 {
		margin-top: 0;
	}
	#first {
	}
	#second {
	}
	#third {
		background-color: #00f;
	}
	.waste {
		min-height: 1000px;
	}
	-->
	</style>

<div id="RightContent">
  <div class="tabs">
    <ul class="tabNavigation">
      <li><a href="#second">Tham gia cuộc thi</a></li>
      <li><a href="#first">Thể lệ cuộc thi</a></li>
    </ul>
    <div id="first"> {info} </div>
    <div id="second">
      <form class="form-inline" onSubmit="return CheckValuesIsNull({NUMQ});" action="{link}" method="post" id="formquiz" >
        <table width="100%" border="0">
        <tbody>  
		  <tr>
            <td colspan="2"><b style="text-align:center;color:#444;">THÔNG TIN CÁ NHÂN</b><br />
              <i>Nhập thông tin cá nhân trước khi trả lời các câu hỏi.</i>
              <input name="token" id="token" value="{TOKEN}" type="hidden" />
            </td>
          </tr>
          <tr>
            <td width="50%"><label for="fullname"> Tên thí sinh<span style="color:red"> (*)</span></label></td>
            <td>:
              <input class="form-control" style="width: 90%;" name="full_name" id="fullname" placeholder="Tên thí sinh" type="text" maxlength="255" /></td>
          </tr>
          <tr>
            <td><label for="birthday">Ngày sinh<span style="color:red">(*)</span></label></td>
            <td>:
              <input class="form-control" style="width: 90%;" name="birthday" id="birthday" placeholder="Ngày sinh có dạng 20/10/1980" type="text" maxlength="10"/></td>
          </tr>
          <tr>
            <td><label for="email">Email<span style="color:red">(*)</span></label></td>
            <td>:
              <input class="form-control" style="width: 90%;"name="email" id="email" type="text" placeholder="Địa chỉ Email" maxlength="64"/></td>
          </tr>
          <tr>
            <td><label for="telephone">Số điện thoại<span style="color:red">(*)</span></label></td>
            <td>:
              <input class="form-control" onKeyPress="return keypress(event);" style="width: 90%;" placeholder="Số điện thoại" name="telephone" id="telephone" type="text" maxlength="20" /></td>
          </tr>
          <tr>
            <td><label for="address">Địa chỉ<span style="color:red">(*)</span></label></td>
            <td>:
              <input class="form-control" style="width: 90%;"name="address" id="address" type="text" placeholder="Địa chỉ" maxlength="255"/></td>
          </tr>
          <tr>
            <td><label for="workunit">Đơn vị công tác<span style="color:red">(*)</span></label></td>
            <td>:
              <input class="form-control" style="width: 90%;"name="work_unit" id="workunit" placeholder="Đơn vị công tác" type="text" maxlength="255"/></td>
          </tr>
		</tbody>  
        <tbody id="xoade"> 
			<tr>
				<td colspan="2"><input value="Mở đề" name="chonde" id="chonde" type="button" onclick="return load_de();"/>
			</tr>
        </tbody>  
        <tbody id="load_de">  
        </tbody>  
        </table>
      </form>
    </div>
  </div>
</div>

<!-- END: main -->