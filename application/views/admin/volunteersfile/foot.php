<script text="javascript">

    $(document).ready(function () {
        $('#volunteer-list').DataTable({
            "order": [[0, "desc"]] // Order by date desc.
        });

        $("#datepicker").datepicker({
            'dateFormat': 'yy-mm-dd'
        });
    });

    // Allow only 1 and 0 for is_active input.
    $("input[name='is_active']").on("input", function () {

        var value = $(this).val();

        if ((value !== '') && (value.indexOf('.') === -1)) {

            $(this).val(Math.max(Math.min(value, 1), 0));
        }
    });

    // Check file chosen.
    $('input[name="file"]').on('change', function () {
        // Validate if file is pdf.
        if ($(this).val().split('.').pop().toLowerCase() != 'pdf') {
            alert('Invalid file type.');
            // Remove chosen file.
            this.value = '';
        }
    });

</script>