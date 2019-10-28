<script type="text/javascript">
    $(function () {
        $("#datepicker").datepicker({
            'dateFormat': 'yy-mm-dd'
        });
    });

    function goToDate() {
        // Get the value of the input date.
        var date = $("#datepicker").val();
        // Go to the link.
        location.href = "<?php echo base_url('events/daily/'); ?>" + date;
    }
</script>