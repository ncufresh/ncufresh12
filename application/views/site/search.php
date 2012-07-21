<script type="text/javascript">
google.setOnLoadCallback(function()
{
    var options = new google.search.DrawOptions();
    var control = new google.search.CustomSearchControl($.configures.googleSearchAppId);
    options.enableSearchResultsOnly();
    control.setResultSetSize(google.search.Search.FILTERED_CSE_RESULTSET);
    control.draw('result', options);
    control.execute('<?php echo $query; ?>');
});
</script>
<div id="result">載入搜尋結果中……</div>