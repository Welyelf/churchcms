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
        valid_children: '+body[style]'
    });

    $(document).ready(function () {
        $('#emails-list').DataTable({
            "order": [[0, "desc"]]
        });
    });

    // Autogenerate slug when an email template name is typed.
    $("#email-template-name").keyup(function () {
        var title = $(this).val();
        // Replace spaces, underscores and multiple hyphens with one hyphen/dash and change the string to lowercase.
        var res = title.replace(/\s+/g, '-').replace(/_+/g, '-').replace(/-+/g, '-').toLowerCase();
        // Set the generated slug.
        $("#slug").val(res);
    });

    $("#slug").keydown(function (e) {
        // Prevent Spaces and Underscore.
        if (e.which === 32 || e.shiftKey === true)
            e.preventDefault();
    });

    $("#slug").keyup(function (e) {
        var slug = $(this).val();

        // replace(/_+/g, '-') = replaces _ with -
        // replace(/\s+/g, '-') = replaces space with -

        // Replaces multiple hyphens with one.
        var res = slug.replace(/-+/g, '-').toLowerCase();
        // Set the slug.
        $(this).val(res);
    });
</script>
