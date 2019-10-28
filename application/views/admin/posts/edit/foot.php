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
        init_instance_callback: 'set_content',
        setup: 'on_keyup',

    });

    $(document).ready(function () {

        if (localStorage.title<?php echo $post->id; ?>) {
            $('#title').val(localStorage.title<?php echo $post->id; ?>);
        }

        if (localStorage.slug<?php echo $post->id; ?>) {
            $('#slug').val(localStorage.slug<?php echo $post->id; ?>);
        }

        if (localStorage.categories<?php echo $post->id; ?>) {
            var categories = JSON.parse(localStorage.getItem('categories<?php echo $post->id; ?>'));
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
            localStorage.setItem("categories<?php echo $post->id; ?>", JSON.stringify(cats));
        });
    });

    function on_keyup(inst) {
        inst.on('keyup', function (e) {
            localStorage.setItem('content<?php echo $post->id; ?>', tinyMCE.get('content').getContent());
        });
    }

    function set_content(inst) {
        inst.setContent(localStorage.content<?php echo $post->id; ?>);
    }

    function save() {
        localStorage.setItem("title<?php echo $post->id; ?>", $('#title').val());
        localStorage.setItem("slug<?php echo $post->id; ?>", $('#slug').val());
    }


    $('#cancel').on('click', function () {
        localStorage.removeItem("title<?php echo $post->id; ?>");
        localStorage.removeItem("slug<?php echo $post->id; ?>");
        localStorage.removeItem('content<?php echo $post->id; ?>');
        localStorage.removeItem("categories<?php echo $post->id; ?>");
    });
</script>
