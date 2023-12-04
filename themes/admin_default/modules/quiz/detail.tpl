<!-- BEGIN: main -->
<div id="content">
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title" style="float:left"><i class="fa fa-list"></i> Thông tin thí sinh</h3>
                <div class="pull-right">
					 
					<a href="{URL_BACK}" data-toggle="tooltip" class="btn btn-default" title="{LANG.cancel}"><i class="fa fa-reply"></i></a>
                </div>
                <div style="clear:both"></div>
            </div>
            <div class="panel-body">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab-order" data-toggle="tab">Thông tin thí sinh</a>
                    </li>
                    <li class=""><a href="#tab-payment" data-toggle="tab">Câu hỏi phụ</a>
                    </li>
 
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-order">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>{LANG.info_full_name}:</td>
                                    <td>{LOOP.full_name}</td>
                                </tr>
                                <tr>
                                    <td>{LANG.info_birthday}:</td>
                                    <td> {LOOP.birthday} </td>
                                </tr>
                                <tr>
                                    <td>{LANG.info_telephone}:</td>
                                    <td>{LOOP.telephone}</td>
                                </tr>
                                <tr>
                                    <td>{LANG.info_email}:</td>
                                    <td>{LOOP.email}</td>
                                </tr>
                                <tr>
                                    <td>{LANG.info_address}:</td>
                                    <td>{LOOP.address}</td>
                                </tr>
                                <tr>
                                    <td>{LANG.info_work_unit}:</td>
                                    <td>{LOOP.work_unit}</td>
                                </tr>
                                <tr>
                                    <td>{LANG.info_outcome}:</td>
                                    <td>{LOOP.outcome}</td>
                                </tr>
                                <tr>
                                    <td>{LANG.info_time}:</td>
                                    <td>{LOOP.time}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="tab-payment">
						<div style="padding-top: 20px;color:red;font-weight:bold;font-size:16px;padding-bottom:10px">Câu hỏi phụ</div>
						<b style="font-weight:bold">Câu 1:{QUESTION} </b>
						<div style="padding-top: 20px;text-align:justify;font;size:12px;line-height:1.4">
						{CAUPHU}
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 
<!-- END: main -->