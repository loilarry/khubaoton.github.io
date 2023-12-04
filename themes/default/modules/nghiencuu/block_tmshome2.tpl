<!-- BEGIN: main -->
<style type="text/css">
#tmshome2{border: 1px solid #f2f2f2;border-radius: 4px;background: #fff;margin-bottom: 10px;width: 100%;padding: 10px 10px 0px 5px;position: relative;display: inline-block;}
.tmshome2_img{ position: relative;}
.tmshome2_img img{width: 100%;height: 300px;object-fit: cover; object-position: center;-o-object-fit: cover; text-align:center;object-fit: cover;}
.tmshome2_text {width: 100%;background: #f2f2f2; padding: 5px;font-size: 16px;}
.tmshome2_text a{padding: 5px 0px 5px 0px;width: 100%;text-align: left;font-weight: 600;display: block;color:#0772ba;font-size: 16px;}
.tmshome2_list_tin {display: inline-block;}
.tmshome2_list_tin ul{margin:0; padding:0;}
.tmshome2_list_tin ul li {display: inline;float: left;width: 100%;border-bottom: 1px dashed #CCC;padding-bottom: 5px;margin-bottom: 5px;}
.tmshome2_list_tin ul li:last-child {border-bottom:none;}
.tmshome2_list_tin ul li a {font-size: 14px;font-weight: 500;}
</style>

<div id="tmshome2">
<div class="col-lg-16 col-md-16 col-sm-16 col-xs-24">
<div class="swiper tmshome2">
<div class="swiper-wrapper">
<!-- BEGIN: left -->
<div class="swiper-slide">
<div  class="tmshome2_img">	
<a href="{ROW.link}" title="{ROW.title}" {ROW.target_blank} ><img src="{ROW.thumb}" alt="{ROW.title}"/></a>
</div>
<div  class="tmshome2_text">
<a href="{ROW.link}" title="{ROW.title}" {ROW.target_blank} >{ROW.title}</a>	
{ROW.hometext_clean}
</div>
</div>
<!-- END: left -->

</div>
<div class="swiper-button-next"></div>
<div class="swiper-button-prev"></div>
</div>
</div>

<link rel="StyleSheet" href="{NV_STATIC_URL}themes/{TEMPLATE}/css/news_swiper.css">	
  <script src="{NV_STATIC_URL}themes/{TEMPLATE}/js/news_swiper.js"></script>
     <script>
      var swiper = new Swiper(".tmshome2", {
        spaceBetween: 30,
        centeredSlides: true,
        autoplay: {
          delay: 2500,
          disableOnInteraction: false,
        },
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      });
    </script>




	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-24 tmsline_left">
		<div class="tmshome2_list_tin">
			<ul>
				<!-- BEGIN: right -->
					<li class="clearfix">
						<a href="{ROW.link}" title="{ROW.title}" {ROW.target_blank} ><img src="{ROW.thumb}" alt="{ROW.title}" width="{ROW.blockwidth}" class="img-thumbnail pull-left mr-1"/></a>
						<a  class="show" href="{ROW.link}" {ROW.target_blank} data-content="{ROW.hometext_clean}" data-img="{ROW.thumb}" data-rel="block_tooltip">{ROW.title_clean}</a>
					</li>
				<!-- END: right -->
			</ul>	
		</div>
	</div>

</div>
<!-- BEGIN: tooltip -->
<script type="text/javascript">
$(document).ready(function() {$("[data-rel='block_tooltip'][data-content!='']").tooltip({
    placement: "{TOOLTIP_POSITION}",
    html: true,
    title: function(){return ( $(this).data('img') == '' ? '' : '<img class="img-thumbnail pull-left margin_image" src="' + $(this).data('img') + '" width="90" />' ) + '<p class="text-justify">' + $(this).data('content') + '</p><div class="clearfix"></div>';}
});});
</script>
<!-- END: tooltip -->
<!-- END: main -->
