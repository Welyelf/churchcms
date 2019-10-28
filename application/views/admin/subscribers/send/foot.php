<script src="/assets/plugins/tinymce/tinymce.min.js"></script>

<script type="text/javascript">
    tinymce.init({
        selector: 'textarea',
        height: 300,
        menubar: false,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code'
        ],
        toolbar: 'code | undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        content_css: '//www.tinymce.com/css/codepen.min.css',
        formats: {italic: {inline: 'i'}},
        valid_elements: '*[*]',
        valid_children: '+body[style]',
    });

    $('#email_template').change(function (e) {
        var selectedTemplateID = $(this).children("option:selected").val();

        $.ajax({
            type: "POST",
            url: "/admin/subscribers/get_template",
            beforeSend: disableDropdown,
            data: {id: selectedTemplateID},
            success: function (data) {
                // Check result contains data.
                if (data) {

                    // Decode json result from data.
                    var res = jQuery.parseJSON(data);

                    // Set the text in the editor.
                    $('#ckeditor').val(res.template);
                    tinyMCE.get('ckeditor').setContent(res.template);

                    if (res.slug == 'weekly_sermon') {
                        $("#sermon_fields").show('1000');

                        if (!$('#sermon_dropdown').val())
                            $('#submit-btn').attr("disabled", "disabled");
                    } else
                        $("#sermon_fields").hide('1000');
                }
                // Enable the dropdown after.
                enableDropdown();

            }
        });
    });

    // Only enable the submit button after a sermon has been chosen.
    $('#sermon_dropdown').on('change', function () {

        if (!$('#sermon_dropdown').val())
            $('#submit-btn').attr("disabled", "disabled");
        else
            $('#submit-btn').removeAttr("disabled");
    });

    $('#submit-btn').on('click', function () {
        // Update the icons and class.
        $(this).find('span').removeClass('fa-paper-plane');
        $(this).find('span').addClass('fa-spinner fa-spin');
        $(this).attr('disabled', 'disabled');
        // Submit the form.
        $('form').submit();
    });

    function disableDropdown() {

        elementID = document.getElementById('email_template');
        elementID.disabled = true;
    }

    function enableDropdown() {

        elementID = document.getElementById('email_template');
        elementID.disabled = false;
    }

</script>
