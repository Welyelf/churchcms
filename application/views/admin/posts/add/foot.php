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
        valid_elements: '*[*]',
        valid_children: '+body[style]',
        init_instance_callback: 'set_content',
        setup: 'on_keyup',

    });

    $(document).ready(function () {

        if (localStorage.title) {
            $('#title').val(localStorage.title);
        }

        if (localStorage.slug) {
            $('#slug').val(localStorage.slug);
        }

        if (localStorage.categories) {
            var categories = JSON.parse(localStorage.getItem('categories'));
            for (var i = 0; i < categories.length; i++) {
                $('#' + categories[i].id).prop('checked', categories[i].value);
            }
        }

        $('.input-field').on('keyup', function (event) {
            save();
        });

        $('.checkbox').on('click', function () {
            var cat, cats = [];
            $('.checkbox').each(function () { // run through each of the checkboxes
                cat = {id: $(this).attr('id'), value: $(this).prop('checked')};
                cats.push(cat);
            });
            localStorage.setItem("categories", JSON.stringify(cats));
        });
    });

    function on_keyup(inst) {
        inst.on('keyup', function (e) {
            localStorage.setItem('content', tinyMCE.get('content').getContent());
        });
    }

    function set_content(inst) {
        inst.setContent(localStorage.content);
    }

    function save() {
        localStorage.setItem("title", $('#title').val());
        localStorage.setItem("slug", $('#slug').val());
        localStorage.setItem("content", myEditor.getData());
    }

    $('#cancel').on('click', function () {
        localStorage.removeItem("title");
        localStorage.removeItem("slug");
        localStorage.removeItem('content');
        localStorage.removeItem("categories");
    });

    // Autogenerate slug when a title is typed.
    $("#title").keyup(function () {
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
