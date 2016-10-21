<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.0.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
<?php $tags= json_encode($where);?>
<script>
    $(function() {
        var availableTags = <?php echo $tags;?>;
        $( "#tags" ).autocomplete({
            source: availableTags
        });
    });
</script>
<input type="text" name="txt_search_data" id="tags" placeholder="Student name etc..">