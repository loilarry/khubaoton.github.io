<!-- BEGIN: main -->
<style type="text/css">
.two_top {overflow: hidden;background-color: #fff; width: 100%;height: {CONFIG.height}px;display: inline-block;-webkit-transition: box-shadow 0.2s;-moz-transition: box-shadow 0.2s; transition: box-shadow 0.2s;transition: all 1s;-webkit-transform: scale(1);transform: scale(1);}
.two_top img {height: 100%;width: 100%;object-position: center; object-fit: cover;transition: all 1s;}
.two_top img:hover {opacity: 1;transform: scale(1.15, 1.15);-webkit-transform: scale(1.15, 1.15); -moz-transform: scale(1.15, 1.15);-ms-transform: scale(1.15, 1.15);-o-transform: scale(1.15, 1.15);}
.two_top_text { padding:2px;width: 100%; width: 100%;color: #000; font-size: 14px;}
.two_top_text a {color: #03147e;font-size: 16px;  font-weight: 600;width: 100%;display: inline-block;}
.two_line {margin-bottom: 5px;}
.two_list_tin {display: inline-block;}
.two_list_tin ul{margin:0; padding:0;}
.two_list_tin ul li {display: inline;float: left;width: 100%;border-bottom: 1px dashed #CCC;padding-bottom: 5px;margin-bottom: 5px;}
.two_list_tin ul li:last-child {border-bottom:ntwo;}
.two_list_tin ul li a {font-size: 14px;font-weight: 500;}
.two_top_home{background: #fff; width: 100%;display: inline-block; padding: 5px;}
.tmspanel {display: inline-block;position: relative; width: 100%; margin-bottom: 18px;}
.tmsbody {padding: 10px 10px 0px 10px;width: 100%; position: relative;display: inline-block;}
.tmsheading {color: #fff !important;padding: 0;position: relative;display: inline-block;width: 100%;}
.tmsheading h2{;display: inline-block;position: relative;padding: 6px 12px 6px 6px;color: #fff !important;text-transform: uppercase;font-weight: bold;line-height: 1.3;margin: 0;}
.tmsheading h2:after {content: "";  position: absolute;inset: 0 auto 0 calc(100% - 10px);width: 30px;clip-path: polygon(0% 0%, 46% 0, 100% 50%, 46% 100%, 0% 100%);}
.tmsheading h2 a{color: #03147e !important;}
</style>
<div class="row" style="margin-top: 20px;">
<div class="two_top_home">
<!-- BEGIN: cat_info -->
<div class="col-xs-{CONFIG.d640} col-sm-{CONFIG.d768}  col-md-{CONFIG.d1024} col-lg-{CONFIG.d1124}">
  <div class="tmspanel">
<div class="tmsheading">
<h2><a href="{CAT_INFO.link}" title="{CAT_INFO.title}">{CAT_INFO.title}</a></h2>
</div>
<div class="tmsbody">
 <!-- BEGIN: top -->
<div class="two_top">
<a href="{ROW.link}" title="{ROW.title}" {ROW.target_blank} ><img src="{ROW.thumb}" alt="{ROW.title}"/></a>
</div>
<div class="two_top_text">
<a  href="{ROW.link}"title="{ROW.title}" >{ROW.title_clean}</a>
{ROW.description_clean}
</div>
<div class="two_line"></div>
<!-- END: top -->
<div class="two_list_tin">
      <ul>
        <!-- BEGIN: loop -->
          <li class="clearfix">
            <a  href="{ROW.link}"title="{ROW.title}"><i class="fa fa-caret-right" aria-hidden="true"></i> {ROW.title_clean}</a>
          </li>
        <!-- END: loop -->
      </ul> 
</div>
</div>
</div>
</div>
<!-- END: cat_info -->
</div>
</div>
<!-- END: main -->
