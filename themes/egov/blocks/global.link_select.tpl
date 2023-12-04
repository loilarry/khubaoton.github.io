<!-- BEGIN: main -->
<SELECT onchange="if (this.value != '#') window.open(this.value, '_blank');" style="width: 100%;"> 
<OPTION selected> - Select website - </OPTION>
<!-- BEGIN: loop -->
<OPTION value="{AURL}">{ATITLE}</OPTION>
<!-- END: loop -->
</SELECT>
<!-- END: main -->