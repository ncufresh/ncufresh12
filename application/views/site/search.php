<div id="result">載入搜尋結果中……</div>
<script type="text/javascript">
$(document).ready(function()
{
    var options = new google.search.DrawOptions();
    var control = new google.search.CustomSearchControl('011017124764723419863:mdibrr3n-py');
    options.enableSearchResultsOnly();
    control.setResultSetSize(google.search.Search.FILTERED_CSE_RESULTSET);
    control.draw('result', options);
    control.execute('<?php echo $query; ?>');
});
</script>