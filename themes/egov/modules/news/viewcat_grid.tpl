<!-- BEGIN: main -->
<!-- BEGIN: viewdescription -->
<div class="news_column">
	<div class="alert alert-info clearfix">
		<h3>{CONTENT.title}</h3>
		<!-- BEGIN: image -->
		<img alt="{CONTENT.title}" src="{HOMEIMG1}" width="{IMGWIDTH1}" class="img-thumbnail pull-left imghome" />
		<!-- END: image -->
		<p class="text-justify">{CONTENT.description}</p>
	</div>
</div>
<!-- END: viewdescription -->
<script>
$(document).ready(function() {
  $('.col-sm-16.col-md-18.fix-more-padding').removeClass('col-sm-16 col-md-18 fix-more-padding').addClass('col-md-24');
});
</script>
<!-- BEGIN: featuredloop -->
<div class="col-sm-12 col-md-8 thumbnail">
<div class="panel1 panel-default">
		<div class="panel-body1 featured text-center">
			<!-- BEGIN: image -->
		<a href="{CONTENT.link}" title="{CONTENT.title}" {CONTENT.target_blank}><img style="height:210px;width: 100%;
    object-fit: cover;
    object-position: center;
    -o-object-fit: cover;
    object-fit: cover;" alt="{HOMEIMGALT1}" src="{HOMEIMG1}" class="img-thumbnail pull-left imghome" /></a>
			<!-- END: image -->
		<h4>
				<a style="color: #101bb1;font-size: 18px;
    font-weight: 700;" href="{CONTENT.link}" title="{CONTENT.title}" {CONTENT.target_blank}>{CONTENT.title}</a>
			</h4>
			<div class="text-justify">
				{CONTENT.hometext}
			</div>
			<!-- BEGIN: adminlink -->
				{ADMINLINK}
			<!-- END: adminlink -->
	</div>
	</div>
</div>
<!-- END: featuredloop -->

<!-- BEGIN: viewcatloop -->
<div class="col-sm-12 col-md-8">
	<div class="thumbnail">
		<a title="{CONTENT.title}" href="{CONTENT.link}" {CONTENT.target_blank}><img style="height:210px;width: 100%;
    object-fit: cover;
    object-position: center;
    -o-object-fit: cover;
    object-fit: cover;" alt="{HOMEIMGALT1}" src="{HOMEIMG1}" class="img-thumbnail"/></a>
	
		<div class="caption text-center">
			<h4><a class="show" style="color: #101bb1;font-size: 18px;
    font-weight: 700;" href="{CONTENT.link}" {CONTENT.target_blank} <!-- BEGIN: tooltip -->data-content="{CONTENT.hometext_clean}" data-img="" data-rel="tooltip" data-placement="{TOOLTIP_POSITION}"<!-- END: tooltip --> title="{CONTENT.title}">{CONTENT.title}</a></h4>
			<span>{ADMINLINK}</span>
		</div>
		<div class="text-justify">
				{CONTENT.hometext}
			</div>
	</div>
	
</div>
<!-- END: viewcatloop -->
<div class="clear">&nbsp;</div>

<!-- BEGIN: generate_page -->
<div class="text-center">
	{GENERATE_PAGE}
</div>
<!-- END: generate_page -->
<script type="text/javascript">
$(window).on('load', function() {
    var maxThumbnailHeight = 0;

    $('.thumbnail').each(function() {
        var currentHeight = $(this).height();
        if (currentHeight > maxThumbnailHeight) {
            maxThumbnailHeight = currentHeight;
        }
    });

    $('.thumbnail').height(maxThumbnailHeight);
});
</script>

<!-- END: main -->