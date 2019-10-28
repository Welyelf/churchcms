<script text="javascript">

    $(document).ready(function () {
        $('#volunteer-list').DataTable({
            "order": [[0, "desc"]] // Order by date desc.
        });

        $("#datepicker").datepicker({
            'dateFormat': 'yy-mm-dd'
        });
    });

</script>