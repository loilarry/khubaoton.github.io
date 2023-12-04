function keypress(e) {

    var keypressed = null;

    if (window.event) {
        keypressed = window.event.keyCode; //IE
    } else {
        keypressed = e.which; //NON-IE, Standard
    }

    if (keypressed < 48 || keypressed > 57) {

        if (keypressed == 8 || keypressed == 127) {
            return;
        }

        return false;
    }

}
function load_de() {
	
	var fullname = document.getElementById( 'fullname' );
	var birthday = document.getElementById( 'birthday' );
	var email = document.getElementById( 'email' );
	var telephone = document.getElementById( 'telephone' );
	var address = document.getElementById( 'address' );
	var token = document.getElementById( 'token' );
	
	var bt = document.getElementById( 'chonde' );
	bt.disabled = true;
	
	var reg = /^(((0[1-9]|[12]\d|3[01])\/(0[13578]|1[02])\/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)\/(0[13456789]|1[012])\/((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])\/02\/((19|[2-9]\d)\d{2}))|(29\/02\/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$/g;
	
	if( fullname.value.length < 3 )
	{
		alert( "Bạn chưa nhập họ tên hoặc quá ngắn" );
		bt.disabled = false;
		fullname.focus();
		return false;
	}
	else if( ! reg.test( birthday.value ) )
	{
		alert( "Lỗi: Bạn chưa nhập ngày sinh hoặc không đúng chuẩn" );
		bt.disabled = false;
		birthday.focus();
		return false;
	}
	else if(! nv_email_check ( email )  )
	{
		alert( "Lỗi: Địa chỉ email không đúng" );
		bt.disabled = false;
		email.focus();
		return false;
	}
	else if( telephone.value.length < 7 )
	{
		alert( "Lỗi: Bạn chưa điền số điện thoại hoặc quá ngắn" );
		bt.disabled = false;
		telephone.focus();
		return false;
	}else if( address.value.length < 2 )
	{
		alert( "Lỗi: Bạn chưa điền địa chỉ hoặc quá ngắn" );
		bt.disabled = false;
		address.focus();
		return false;
	}
	else if( workunit.value.length < 2 )
	{
		alert( "Lỗi: Bạn chưa điền đơn vị công tác hoặc quá ngắn" );
		bt.disabled = false;
		workunit.focus();
		return false;
	}
	else
	{
		fullname = encodeURIComponent(fullname.value);
		birthday = encodeURIComponent(birthday.value);
		email = encodeURIComponent(email.value);
		telephone = encodeURIComponent(telephone.value);
		address = encodeURIComponent(address.value);
		workunit = encodeURIComponent(workunit.value);
		$('#xoade').remove();
 
        $.ajax({
            url: nv_siteroot + 'index.php?' + nv_lang_variable + '=' + nv_sitelang + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=process&load&nocache=' + new Date().getTime(),
            type: 'post',
            data: $('#formquiz :input'),
            dataType: 'json',
            beforeSend: function() {
                //$('#button-login').button('loading');
            },
            complete: function() {
               // $('#button-login').button('reset');
            },
            success: function(json) {
               
                if (json['content']) 
				{
                    $('#load_de').html( json['content'] );
					
                } else if (json['error']) {
                    alert( json['error'] ); 
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
 
	}
	
	return false;
}

function CheckValuesIsNull(numq) {

	var bt = document.getElementById( 'btsend' );
	bt.disabled = true;
    var check = Array();
	var c=1;
	for(t=0;t < numq; t++)
	{
		var cau = $("input[name='Cau"+c+"']");
		for (i = 0; i < cau.length; i++)
		if (cau[i].checked == true) check[t] = "yes";
		++c;
    }
    var loi = '';
    var serrors = document.getElementById('hienloi');
    var fullname = document.getElementById('fullname');
	var birthday = document.getElementById('birthday');
	var telephone = document.getElementById('telephone');
    var email = document.getElementById('email');
	var address = document.getElementById('address');
    var workunit = document.getElementById('workunit');
 
    if (fullname.value == '') {
        loi += '<span style="color:red;">*</span>Chưa nhập họ tên <br />';
    }

    if (birthday.value == '') {
        loi += '<span style="color:red;">*</span>Chưa nhập ngày sinh<br />';
    }

    if (telephone.value == '') {
        loi += '<span style="color:red;">*</span>Chưa nhập số điện thoại<br />';
    }
	if (email.value == '') {
        loi += '<span style="color:red;">*</span>Chưa nhập Email<br />';
    }
    if (address.value == '') {
        loi += '<span style="color:red;">*</span>Chưa nhập địa chỉ<br />';
    }
	if (workunit.value == 0) {
        loi += '<span style="color:red;">*</span>Chưa nhập đơn vị công tác<br />';
    }
	
    

    for (i = 0; i < numq; i++) if (check[i] != 'yes') loi += '<span style="color:red;">*</span>Chưa chọn câu số ' + (i + 1) + '<br />';

    if (loi != '') {
		bt.disabled = false;
        serrors.innerHTML = '<b style="font-size:11px;"><b style="font-size:14px;color:red">Có lỗi</b><br />' + loi + '</b>';
        return false;
    }
	else
	{
		 var requset = $("#formquiz").serialize();
		 $.ajax({
			 type: "POST",
			 url: nv_siteroot + 'index.php?' + nv_lang_variable + '=' + nv_sitelang + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=process' + '&do=1&numq='+numq+'&nocache=' + new Date().getTime(),
			 data: requset,
			 success: function (data) {
				 bt.disabled = false;
			 var r_split = data.split("[NV4]");
				if (r_split[0] == 'OK') {
					//$('#countdown').remove();
					alert('Bài dự thi của bạn đã được gửi thành công');
					location.reload();
					 // Shadowbox.open({
						 // content: nv_siteroot + 'index.php?' + nv_lang_variable + '=' + nv_sitelang + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=process' + '&show=1&info_id='+r_split[1]+'&nocache=' + new Date().getTime(), 
						 // player: "iframe",
						 // title: "Danh sách câu hỏi và đáp án của bạn",
						 // width: 800,
						 // height: 600,
						 // options: {                   
							  // initialHeight: 1,
							  // initialWidth: 1,
							  // modal: true,
						 // }
					// });
					
				}else
				{
					alert(r_split[1]);
				}
			}
		});
	}

    return false;

}


(function(d) {
  function m(e, b) {
    var c = e.find(".digit");
    if(c.is(":animated") || e.data("digit") == b) {
      return!1
    }
    e.data("digit", b);
    var a = d("<span>", {"class":"digit", css:{top:"-2.1em", opacity:0}, html:b});
    c.before(a).removeClass("static").animate({top:"2.5em", opacity:0}, "fast", function() {
      c.remove()
    });
    a.delay(100).animate({top:0, opacity:1}, "fast", function() {
      a.addClass("static")
    })
  }
  d.fn.countup = function(e) {
    function b(a, b, c) {
      m(j.eq(a), Math.floor(c / 10) % 10);
      m(j.eq(b), c % 10)
    }
    var c = d.extend({callback:function() {
    }, start:new Date}, e), a = 0, f, g, h, k, j, l = this;
    l.addClass("countdownHolder");
    d.each(["Days", "Hours", "Minutes", "Seconds"], function(a) {
	  var s=''; if(this=="Days")s = 'style="display: none"';
      d('<span '+s+' class="count' + this + '">').html('<span class="position"><span class="digit static">0</span></span><span class="position"><span class="digit static">0</span></span>').appendTo(l);
      "Seconds" != this && l.append('<span '+s+' class="countDiv countDiv' + a + '"></span>')
    });
    j = this.find(".position");
    (function n() {
      a = Math.floor((new Date - c.start) / 1E3);
      f = Math.floor(a / 86400);
      b(0, 1, f);
      a -= 86400 * f;
      g = Math.floor(a / 3600);
      b(2, 3, g);
      a -= 3600 * g;
      h = Math.floor(a / 60);
      b(4, 5, h);
      k = a -= 60 * h;
      b(6, 7, k);
      c.callback(f, g, h, k);
      setTimeout(n, 1E3)
    })();
    return this
  }
})(jQuery);
