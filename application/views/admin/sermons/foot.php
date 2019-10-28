<script src="/assets/plugins/tinymce/tinymce.min.js"></script>

<script type="text/javascript">
    $(function () {
        $("#datepicker").datepicker();
    });

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

    $(document).ready(function () {
        $('#sermons-list').DataTable({
            "order": [[2, "desc"]]
        });
    });

    <?php //echo json_encode(get_bible_books()); ?>

    var bible = jQuery.parseJSON('<?php echo json_encode(get_bible_books()); ?>');

    $('#book').change(function () {

        var book = $(this).val();

        $('#chapter-from').html('');
        $('#verse-from').html('');
        $('#chapter-to').html('');
        $('#verse-to').html('');

        $('#chapter-to').attr('disabled', 'disabled');
        $('#verse-to').attr('disabled', 'disabled');
        $('#verse-from').attr('disabled', 'disabled');
        $('#chapter-from').removeAttr('disabled');

        $('#chapter-from').append('<option disabled selected value> Ch.</option>');

        for (x = 1; x <= bible[book]['chapters']; x++) {
            $('#chapter-from').append('<option value="' + x + '">' + x + '</option>');
        }
    });

    $('#chapter-from').change(function () {

        var book = $('#book').val();
        var chapter_from = $(this).val();

        $('#verse-from').html('');
        $('#chapter-to').html('');
        $('#verse-to').html('');

        $('#chapter-to').attr('disabled', 'disabled');
        $('#verse-to').attr('disabled', 'disabled');
        $('#verse-from').removeAttr('disabled');

        $('#verse-from').append('<option disabled selected value> Verse</option>');

        for (x = 1; x <= bible[book]['verses'][chapter_from - 1]; x++) {
            $('#verse-from').append('<option value="' + x + '">' + x + '</option>');
        }
    });

    $('#verse-from').change(function () {

        var book = $('#book').val();
        var chapter_from = $('#chapter-from').val();
        var verse_from = $(this).val();

        $('#chapter-to').html('');
        $('#verse-to').html('');

        $('#chapter-to').removeAttr('disabled');
        $('#verse-to').removeAttr('disabled');
        $('#add-scripture').removeAttr('disabled');

        for (x = chapter_from; x <= bible[book]['chapters']; x++) {
            $('#chapter-to').append('<option value="' + x + '">' + x + '</option>');
        }

        for (x = verse_from; x <= bible[book]['verses'][chapter_from - 1]; x++) {
            $('#verse-to').append('<option value="' + x + '">' + x + '</option>');
        }
    });

    $('#chapter-to').change(function () {
        var book = $('#book').val();
        var chapter_from = $('#chapter-from').val();
        var verse_from = $('#verse-from').val();
        var chapter_to = $(this).val();
        var verse_to_start = 1;

        $('#verse-to').html('');

        if (chapter_to == chapter_from) {
            verse_to_start = verse_from;
        }

        for (x = verse_to_start; x <= bible[book]['verses'][chapter_to - 1]; x++) {
            $('#verse-to').append('<option value="' + x + '">' + x + '</option>');
        }

    });

    $('#add-scripture').click('mousedown', function () {

        if ($(this).attr('disabled') == 'disabled') {
            return false;
        }

        var book = $('#book').find('option:selected').val();
        var book_text = $('#book').find('option:selected').text();
        var chapter_from = $('#chapter-from').val();
        var verse_from = $('#verse-from').val();
        var chapter_to = $('#chapter-to').val();
        var verse_to = $('#verse-to').val();

        var input_value = book + '|' + chapter_from + '|' + verse_from + '|' + chapter_to + '|' + verse_to;
        var input = '<input type="hidden" name="scriptures[]" value="' + input_value + '" />';

        var text = book + " ";

        if (chapter_from == chapter_to) {
            if (verse_from == verse_to) {
                text += chapter_from + ":" + verse_from;
            } else {
                text += chapter_from + ":" + verse_from + "-" + verse_to;
            }
        } else {
            text += chapter_from + ":" + verse_from + " - " + chapter_to + ":" + verse_to;
        }

        var n = $("#scriptures-list tr").length;

        var html = '<tr id="item-' + n + '">';
        html += '<td>' + text + input + '</td>';
        html += '<td><button class="btn btn-danger" onclick="remove_scripture(' + n + ');"><i class="fa fa-trash"></i></a></td>';
        html += '</tr>';

        $('#scriptures-list').append(html);

        $('#chapter-from').html('');
        $('#verse-from').html('');
        $('#chapter-to').html('');
        $('#verse-to').html('');

        $('#chapter-to').attr('disabled', 'disabled');
        $('#verse-to').attr('disabled', 'disabled');
        $('#verse-from').attr('disabled', 'disabled');
        $('#chapter-from').attr('disabled', 'disabled');
        $(this).attr('disabled', 'disabled');

        $('#book option:eq(0)').prop('selected', true);

        //alert(book + " " + chapter + ":" + verse_from + "-" + verse_to);
    });

    function remove_scripture(id) {
        $('#item-' + id).remove();
    }

    $('#save-btn').on('click', function (e) {

        // e.preventDefault();
        if (!$('#add-scripture').attr('disabled'))
            $('#add-scripture').click();

        if ($('#youtube_id').val() != '') {
            // Verify Youtube URL.
            $('#youtube_verify_btn').click();
            // Check if youtube url is valid.
            if ($('#youtube_verify_btn').attr('is_valid') === 'false') {
                // Do not proceed to save.
                e.preventDefault();
            }
        }
    });

    // Add another file to upload.
    $('#upload_files .add_files').on('click', function () {

        // Get current increment attachment id.
        var curAttachmentID = $("#cur-att-id").attr('value');

        var attachmentLimits = <?php echo !empty($sermons_attachment_limit) ? $sermons_attachment_limit : 0; ?>;
        // Count number of attachments.
        var countFiles = $('#upload_files .file').length;
        // Limit only up to 10 attachments per sermon.
        if (countFiles < attachmentLimits)
            $('#upload_files').append('<div id="file-att-id-' + curAttachmentID + '" class="file col-lg-12">' +
                '<div class="col-lg-5">' +
                '<input class="form-control file_name" type="text" name="file_name[]" placeholder="Filename">' +
                '</div>' +
                '<div class="col-lg-4">' +
                '<select class="form-control file_tag" name="file_tag[]">' +
                '<option selected value disabled>Select Tag</option>' +
                '<option value="Bulletin ">Bulletin</option>' +
                '<option value="Sermon Note">Sermon Notes</option>' +
                '<option value="Powerpoint">PowerPoint</option>' +
                '<option value="Other Document">Other Document</option>' +
                '</select>' +
                '</div>' +
                '<div class="col-lg-3">' +
                '<span class="btn btn-default btn-file">' +
                '<i class="fa fa-upload"></i> <input class="chosen_file" type="file" name="fileUpload[]" onchange="' + fileOnChangeHTML + '">' +
                '</span>' +
                '<span class="btn btn-danger btn-delete-file" onclick="delete_attachment(' + curAttachmentID + ');">' +
                '<i class="fa fa-trash"></i>' +
                '</span>' +
                '</div>' +
                '</div>');
        // Disable attachment button when limit is reached.
        else
            $(this).attr('disabled', 'disabled');

        // Increment the attachment id.
        curAttachmentID++;
        // Set the increment attachment id.
        $("#cur-att-id").attr('value', curAttachmentID);
    });

    // Function to convert bytes.
    function formatBytes(bytes, decimals) {
        if (bytes == 0) return '0 Bytes';
        var k = 1024,
            dm = decimals <= 0 ? 0 : decimals || 2,
            sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'],
            i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
    }

    // Set allowed File Types from config.
    var fileTypesArr = <?php echo !empty($sermons_file_types) ? json_encode($sermons_file_types) : '[]'; ?>;
    // Set File Size Limit. 10485760 = 10MB default size limit.
    var fileSizeLimit = <?php echo !empty($sermons_max_file_size) ? $sermons_max_file_size : 10485760; ?>;
    // Include inside append. 
    var fileOnChangeHTML = "var fileSizeLimit = " + fileSizeLimit + ";var file = $(this)[0].files[0];if(file.size > fileSizeLimit) {alert(\'File exceeds size limit. Please choose filesize not greater than" + fileSizeLimit + " bytes / " + formatBytes(fileSizeLimit) + ". Thank you.\');this.value = '';$(this).parent().parent().parent().find(\'.file_name\').val(\'\');}else if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileTypesArr) == -1) {alert('Invalid file type.');this.value = '';$(this).parent().parent().parent().find('.file_name').val('');}else{$(this).parent().parent().parent().find(\'.file_name\').val(file.name);}";

    // Update the filename when file is chosen.
    $('.chosen_file').on('change', function () {
        // 10485760 = 10mb default

        var sample = $('.chosen_file').attr('name');

        var fileSizeLimit = <?php echo !empty($sermons_max_file_size) ? $sermons_max_file_size : 10485760; ?>;
        // Get File Data.
        var file = $(this)[0].files[0];

        // Check if file chosen exceeds the size limit in settings.
        if (file.size > fileSizeLimit) {
            // Show alert.
            alert('File exceeds size limit. Please choose filesize not greater than ' + fileSizeLimit + ' bytes / ' + formatBytes(fileSizeLimit) + '. Thank you.');
            // Remove chosen file.
            this.value = '';
            // Clear current file in name if already contain value.
            $(this).parent().parent().parent().find('.file_name').val('');
        }

        // Check if file chosen has valid file extension.
        else if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileTypesArr) == -1) {
            alert('Invalid file type.');
            // Remove chosen file.
            this.value = '';
            // Clear current file in name if already contain value.
            $(this).parent().parent().parent().find('.file_name').val('');
        } else {
            // Update Filename.
            $(this).parent().parent().parent().find('.file_name').val(file.name);
        }
    });

    // Function to check if youtube url is valid.
    $('#youtube_verify_btn').on('click', function (e) {
        e.preventDefault();
        var url = $('#youtube_id').val();
        if (url != undefined || url != '') {
            var url = "watch?v=" + url;
            var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*/;
            var match = url.match(regExp);

            if (match && match[2].length == 11) {
                // Update button class.
                $(this).addClass('btn-success');
                $(this).removeClass('btn-default btn-primary btn-danger');
                $(this).text('Valid');

                // Set valid attribute.
                $(this).removeAttr('invalid');
                $(this).attr('is_valid', true);

                console.log('Youtube URL is valid.');
            } else {
                // Update button class.
                $(this).addClass('btn-danger');
                $(this).removeClass('btn-default btn-primary btn-success');
                $(this).text('Invalid');

                // Set invalid attribute.
                $(this).removeAttr('valid');
                $(this).attr('is_valid', 'false');

                alert('Youtube URL is not valid');
            }
        }
    });

    $('#youtube_id').keyup(function () {
        if ($(this).val() == '') {
            // Update button class.
            $('#youtube_verify_btn').addClass('btn-default');
            $('#youtube_verify_btn').removeClass('btn-primary btn-success btn-danger');
            $('#youtube_verify_btn').text('Verify');

            $('#youtube_verify_btn').removeAttr('is_valid');

            $('#youtube_verify_btn').attr('disabled', 'disabled');
        } else
            $('#youtube_verify_btn').removeAttr('disabled');
    });

    // Function to delete attachment input.
    function delete_attachment(id) {
        // Remove attachment.
        $('#file-att-id-' + id).remove();

        var attachmentLimits = <?php echo !empty($sermons_attachment_limit) ? $sermons_attachment_limit : 0; ?>;
        // Count number of attachments.
        var countFiles = $('#upload_files .file').length;

        if (countFiles < attachmentLimits)
            $('#upload_files .add_files').removeAttr('disabled');
    }
</script>
