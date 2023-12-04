<!-- BEGIN: main -->
<style type="text/css">
.home5_item {position: relative;margin-bottom: 15px;background: #f2f2f2;border: 1px solid #ececec;}
.home5_item_img {overflow: hidden;background-color: #fff; width: 100%;height: {CONFIG.height}px;display: inline-block;-webkit-transition: box-shadow 0.2s;-moz-transition: box-shadow 0.2s; transition: box-shadow 0.2s;transition: all 1s;-webkit-transform: scale(1);transform: scale(1);}
.home5_item_img img {height: 100%;width: 100%;object-position: center; object-fit: cover;transition: all 1s;}
.home5_item_img img:hover {opacity: 1;transform: scale(1.15, 1.15);-webkit-transform: scale(1.15, 1.15); -moz-transform: scale(1.15, 1.15);-ms-transform: scale(1.15, 1.15);-o-transform: scale(1.15, 1.15);}
.home5_item_text { padding:0px 2px 5px 2px;width: 100%;}
.home5_item_text a {color: #101bb1;
    font-weight: 700;
    transition: all 0.5s;
    font-size: 14px;
    height: 60px;
    text-align: center;
    overflow: hidden;
    font-size: 16px;
    display: inline-block;}
.date {margin-bottom: 0;display: flex;font-size: 12px;justify-content: space-between;align-items: center;position: relative;margin-top: 5px;}
.date a {color: #002063;color: #303030;font-weight: 600;font-size: 12px;height: 14px;}
#tmshome5 .swiper-pagination{margin-bottom: -10px;}
</style>
<div class="swiper" id="tmshome5">
<div class="swiper-wrapper">
<!-- BEGIN: loop -->
<div class="swiper-slide">
<div class="home5_item">
        <div class="home5_item_img">
         <a href="{ROW.link}" title="{ROW.title}" {ROW.target_blank} ><img src="{ROW.thumb}" alt="{ROW.title}"/></a>
        </div>
        <div class="col-sm-8 col-md-24" style="text-align:center;">
          <a href="{ROW.link}" style="color: #101bb1;
    font-weight: 700;
    transition: all 0.5s;
    font-size: 18px;
    height: 40px;
    text-align: center;
    overflow: hidden;
    display: inline-block;" title="{ROW.title}" {ROW.target_blank} >{ROW.title}</a></br>
         <div class="col-sm-8 col-md-24" style="text-align:center;"> {ROW.hometext_clean}</div>
       <!--   <div class="date">
            <span>{ROW.time}</span>
            <a href="{ROW.link}" title="{ROW.title}">Xem thêm →</a>
          </div>-->
        </div>
      </div>

</div>
<!-- END: loop -->
</div>
<div class="swiper-pagination"></div>
</div>


<link rel="StyleSheet" href="{NV_STATIC_URL}themes/{TEMPLATE}/css/news_swiper.css"> 
  <script src="{NV_STATIC_URL}themes/{TEMPLATE}/js/news_swiper.js"></script>
     <script>
      var swiper = new Swiper('#tmshome5', {
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





<!-- END: main -->
