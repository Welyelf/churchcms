<script>
    // Autogenerate slug when a category name is typed.
    $("#category-name").keyup(function () {
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