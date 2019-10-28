<script type="text/javascript">

    $(function () {
        $('#is-fixed').change(function () {
            if ($(this).prop('checked') == true) {
                $("#amt").val("");
                $("#amt-container").show();
            } else {
                $("#amt").val(1);
                $("#amt-container").hide();
            }
        });
    });

    /*$("#is-variable").click(function (){
        alert('working');
        if($("#is-variable").is(':checked')){
            alert('checked');
              // checked
        } else {
            alert('unchecked');
              // unchecked
        }

    });*/

    $(document).ready(function () {
        $('#plans-list').DataTable();
    });
</script>