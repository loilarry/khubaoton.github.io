<!-- BEGIN: main -->
<script type="text/javascript">
	$(function() {
		$('marquee').marquee('pointer').mouseover(function() {
			$(this).trigger('stop');
		}).mouseout(function() {
			$(this).trigger('start');
		}).mousemove(function(event) {
			if ($(this).data('drag') == true) {
				this.scrollLeft = $(this).data('scrollX') + ($(this).data('x') - event.clientX);
			}
		}).mousedown(function(event) {
			$(this).data('drag', true).data('x', event.clientX).data('scrollX', this.scrollLeft);
		}).mouseup(function() {
			$(this).data('drag', false);
		});
	});
</script>
<div id="blockid_{DATA.bid}" style="color: red; margin-top: 10px;">
	<marquee behavior="scroll" scrollamount="{DATA.scroll}" direction="{DATA.direction}">{DATA.content}</marquee>
</div>
<!-- END: main -->