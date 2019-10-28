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

    /*$(document).ready(function (){

        if (localStorage.pagetitle) {
            $('#title').val(localStorage.pagetitle);
        }

        if (localStorage.pageslug) {
            $('#slug').val(localStorage.pageslug);
        }

        if (localStorage.pagesubtitle) {
            $('#subtitle').val(localStorage.pagesubtitle);
        }

        $('.input-field').on('keyup', function(event) {
            save();
        });

    });*/

    function on_keyup(inst) {
        // inst.on('keyup',function(e) {
        //     localStorage.setItem('pagecontent', tinyMCE.get('content').getContent());
        // });
    }

    function set_content(inst) {
        //inst.setContent(localStorage.pagecontent);
    }

    function save() {
        localStorage.setItem("pagetitle", $('#title').val());
        localStorage.setItem("pageslug", $('#slug').val());
        localStorage.setItem("pagesubtitle", $('#subtitle').val());
        localStorage.setItem('pagecontent', tinyMCE.get('content').getContent());
    }

    $('#cancel').on('click', function () {
        localStorage.removeItem("pagetitle");
        localStorage.removeItem("pageslug");
        localStorage.removeItem('pagecontent');
        localStorage.removeItem("pagesubtitle");
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