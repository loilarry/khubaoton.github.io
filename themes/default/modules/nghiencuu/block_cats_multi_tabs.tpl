<!-- BEGIN: main -->
<style type="text/css">
.tab-content {position: relative; margin-bottom: 10px;width: 100%;display: inline-block;}
.tms-tabs {/*overflow-x: auto;*/white-space: nowrap;width: 100%; margin: 0 auto 10px; padding: 10px 0 10px; text-align: center}
.tms-tabs li {margin-right: 5px;margin-left: 5px;float: none;margin-bottom: -1px;display: inline-block}
.tms-tabs > li a {border: none;font-weight: normal;background: #fff !important;color: #0058C0; border-radius: 4px;padding: 8px 12px;margin-bottom: 5px;font-size: 16px;border: 1px solid #0058C0 !important}
.tms-tabs > li a span {white-space: nowrap}
.tms-tabs > li.active a {background: #0058C0 !important;color: #fff}
.tmshome3_list_tin {display: inline-block;padding: 10px;margin: 0;position: relative;    border: 1px dashed #CCC;}
.tmshome3_list_tin img {height: {CONFIG.height}px; object-position: center; object-fit: cover;transition: all 1s;float: left; margin-right: 10px;}

.tmshome3_list_tin ul{margin:0; padding:0;}
.tmshome3_list_tin ul li {display: inline;float: left;width: 100%;border-bottom: 1px dashed #CCC;padding-bottom: 6px;margin-bottom: 6px;}
.tmshome3_list_tin ul li:last-child {border-bottom:none;}
.tmshome3_list_tin ul li a {font-size: 16px;font-weight: 600;}

</style>
<ul class="tms-tabs">
<!-- BEGIN: cat_info -->
  <li class="{CAT_INFO.active}"><a data-toggle="tab" href="#block-news-category-{CAT_INFO.catid}">{CAT_INFO.title}</a></li>
<!-- END: cat_info -->
</ul>
<div class="tab-content">
<!-- BEGIN: cat_content -->
	<div id="block-news-category-{CAT_INFO.catid}" class="tab-pane fade {CAT_INFO.active} in">
		<div class="tmshome3_list_tin">
	<ul>
		<!-- BEGIN: loop -->
		<li>
			<!-- BEGIN: img -->
			<a href="{ROW.link}" title="{ROW.title}"><img src="{ROW.thumb}" alt="{ROW.title}" width="{ROW.blockwidth}"/></a>
			<!-- END: img -->
			<div class="tmshome3_list_tin_text">
			<a href="{ROW.link}" title="{ROW.title}">{ROW.title}</a> <br/>
			{ROW.hometext_clean}
			</div>
		</li>
		<!-- END: loop -->
	</ul>
	</div>
		</div>
<!-- END: cat_content -->
</div>
<!-- END: main -->

<!-- BEGIN: grid -->
<style type="text/css">
.tab-content {position: relative; margin-bottom: 10px;width: 100%;display: inline-block;}
.tms-tabs {/*overflow-x: auto; */white-space: nowrap;width: 100%; margin: 0 auto 10px; padding: 10px 0 10px; text-align: center}
.tms-tabs li {margin-right: 5px;margin-left: 5px;float: none;margin-bottom: -1px;display: inline-block}
.tms-tabs > li a {border: none;font-weight: normal;background: #fff !important;color: #0058C0; border-radius: 4px;padding: 8px 12px;margin-bottom: 5px;font-size: 16px;border: 1px solid #0058C0 !important}
.tms-tabs > li a span {white-space: nowrap}
.tms-tabs > li.active a {background: #0058C0 !important;color: #fff}
.tms_news_block_item {position: relative;margin-bottom: 15px;background: #f2f2f2;border: 1px solid #ececec;}
.tms_news_block_item_img {overflow: hidden;background-color: #fff; width: 100%;height: {CONFIG.height}px;display: inline-block;-webkit-transition: box-shadow 0.2s;-moz-transition: box-shadow 0.2s; transition: box-shadow 0.2s;transition: all 1s;-webkit-transform: scale(1);transform: scale(1);}
.tms_news_block_item_img img {height: 100%;width: 100%;object-position: center; object-fit: cover;transition: all 1s;}
.tms_news_block_item_img img:hover {opacity: 1;transform: scale(1.15, 1.15);-webkit-transform: scale(1.15, 1.15); -moz-transform: scale(1.15, 1.15);-ms-transform: scale(1.15, 1.15);-o-transform: scale(1.15, 1.15);}
.tms_news_block_item_text { padding:0px 2px 5px 2px;width: 100%; }
.tms_news_block_item_text h3 {font-size: 14px;height: 40px;overflow: hidden;display: inline-block;}
.tms_news_block_item_text h3 a {color: #303030;font-weight: 500;}
.date {margin-bottom: 0;display: flex;font-size: 12px;justify-content: space-between; align-items: center;position: relative;margin-top: 5px;}
.date a{font-size: 12px;color: #303030;}
</style>

	<ul class="tms-tabs">
	<!-- BEGIN: cat_info -->
	  <li class="{CAT_INFO.active}"><a data-toggle="tab" href="#block-news-category-{CAT_INFO.catid}">{CAT_INFO.title}</a></li>
	<!-- END: cat_info -->
	</ul>
	<div class="tab-content">
	<!-- BEGIN: cat_content -->
		<div id="block-news-category-{CAT_INFO.catid}" class="tab-pane fade {CAT_INFO.active} in col-lg-24 col-md-24 margin-top-lg">
				<div class="swiper" id="tms_news_block_tab">
        <div class="swiper-wrapper">
			<!-- BEGIN: loop -->
			<div class="swiper-slide">
			<div class="tms_news_block_item">
        <div class="tms_news_block_item_img">
         <a href="{ROW.link}" title="{ROW.title}"><img src="{ROW.thumb}" alt="{ROW.title}"></a>
        </div>
        <div class="tms_news_block_item_text">
          <h3><a href="{ROW.link}" title="{ROW.title}">{ROW.title}</a></h3>
          <div class="date">
            <span>{ROW.time}</span>
            <a href="{ROW.link}" title="{ROW.title}">Xem thêm →</a>
          </div>
        </div>
      </div>
 </div>
			<!-- END: loop -->
		</div> </div> </div>
	<!-- END: cat_content -->
	</div>
<link href="https://cdn.jsdelivr.net/gh/sieugroup/tms/assets/tms/css/swiper.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="https://cdn.jsdelivr.net/gh/sieugroup/tms/assets/tms/js/swiper.js"></script>
 <script>
      var swiper = new Swiper('#tms_news_block_tab', {
        slidesPerView: {CONFIG.d480},
        spaceBetween:10,
        loop:true,
         autoplay: {
          delay: 2500,
          disableOnInteraction: false,
        },
        // init: false,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
          dynamicBullets: true,
        },
         
        breakpoints: {
        640: {
        slidesPerView: {CONFIG.d640},
        spaceBetween: 10,
        },
        768: {
        slidesPerView: {CONFIG.d768},
        spaceBetween: 10,
        },
        1024: {
        slidesPerView: {CONFIG.d1024},
        spaceBetween: 10,
        },
        1124: {
        slidesPerView: {CONFIG.d1124},
        spaceBetween: 10,
        },
        }
        });
    </script>
<!-- END: grid -->