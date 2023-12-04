
function check_dapan()
{
	var title_0 = $("input[name='title_0']").val();
	var title_1 = $("input[name='title_1']").val();
	var title_2 = $("input[name='title_2']").val();
	var title_3 = $("input[name='title_3']").val();
	var dapan = $("input[name='dapan']:checked").val();
	if (!dapan) {
		alert('Bạn chưa chọn đáp án');
        return false;
    }else if(title_0 =='')
	{
		alert('Bạn chưa điền câu hỏi 1');
		return false;
	}
	else if(title_1 =='')
	{
		alert('Bạn chưa điền câu hỏi 2');
		return false;
	}
	else if(title_2 =='')
	{
		alert('Bạn chưa điền câu hỏi 3');
		return false;
	}
	//else if(title_3 =='')
	//{
	//	alert('Bạn chưa điền câu hỏi 4');
	//	return false;
	//}
	else
	{
		 return true;
	}

}

