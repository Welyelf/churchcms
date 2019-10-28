<script type="text/javascript">
    $(function () {
        $("#datepicker").datepicker({
            'dateFormat': 'yy-mm-dd'
        });
        $("#datepicker2").datepicker({
            'dateFormat': 'yy-mm-dd'
        });
    });

    $(document).ready(function () {
        $('#events-list').DataTable({
            "order": [[2, "desc"]]
        });

        $('#recurrence').on('change', function () {
            var $recurrence = $('#recurrence').val();
            if ($recurrence == "none") {
                $('.weekly-set').hide();
                $('.monthly-set').hide();
                $('.yearly-set').hide();
                $('.recurring-only').hide();
                $('.others-set').hide();
            } else if ($recurrence == "daily") {
                $('.weekly-set').hide();
                $('.monthly-set').hide();
                $('.yearly-set').hide();
                $('.recurring-only').show();
                $('.others-set').hide();
            } else if ($recurrence == "weekly") {
                $('.weekly-set').show();
                $('.monthly-set').hide();
                $('.yearly-set').hide();
                $('.recurring-only').show();
                $('.others-set').hide();
            } else if ($recurrence == "monthly") {
                $('.weekly-set').hide();
                $('.monthly-set').show();
                $('.yearly-set').hide();
                $('.recurring-only').show();
                $('.others-set').hide();
            } else if ($recurrence == "yearly") {
                $('.weekly-set').hide();
                $('.monthly-set').hide();
                $('.yearly-set').show();
                $('.recurring-only').show();
                $('.others-set').hide();
            } else if ($recurrence == "others") {
                $('.weekly-set').hide();
                $('.monthly-set').hide();
                $('.yearly-set').hide();
                $('.recurring-only').show();
                $('.others-set').show();
            }

        });


        var $recurrence = $('#recurrence').val();
        if ($recurrence == "none") {
            $('.weekly-set').hide();
            $('.monthly-set').hide();
            $('.yearly-set').hide();
            $('.recurring-only').hide();
            $('.others-set').hide();
        } else if ($recurrence == "daily") {
            $('.weekly-set').hide();
            $('.monthly-set').hide();
            $('.yearly-set').hide();
            $('.recurring-only').show();
            $('.others-set').hide();
        } else if ($recurrence == "weekly") {
            $('.weekly-set').show();
            $('.monthly-set').hide();
            $('.yearly-set').hide();
            $('.recurring-only').show();
            $('.others-set').hide();
        } else if ($recurrence == "monthly") {
            $('.weekly-set').hide();
            $('.monthly-set').show();
            $('.yearly-set').hide();
            $('.recurring-only').show();
            $('.others-set').hide();
        } else if ($recurrence == "yearly") {
            $('.weekly-set').hide();
            $('.monthly-set').hide();
            $('.yearly-set').show();
            $('.recurring-only').show();
            $('.others-set').hide();
        } else if ($recurrence == "others") {
            $('.weekly-set').hide();
            $('.monthly-set').hide();
            $('.yearly-set').hide();
            $('.recurring-only').show();
            $('.others-set').show();
        }


    });
</script>