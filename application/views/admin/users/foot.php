<script type="text/javascript">
    $(document).ready(function () {
        $('#users-list').DataTable();
    });

    // Function to check on ajax if email already exist before submitting form.
    $('#save_btn').on('click', function (e) {
        // Prevent the form to submit.
        e.preventDefault();
        // Set email field.
        var email = $('#email').val();

        $.ajax({
            url: '/admin/users/is_email_existing',
            type: 'POST',
            dataType: 'json',
            data: {email: email},
            success: function (data) {
                // console.log(data);
                if (data == 1) {
                    // Alert
                    alert('Email already exists.');
                } else {
                    // Submit the form.
                    $('#add-user').submit();
                }
            },
            error: function (data) {
                // If an error encounter, show an error.
                alert(data.error);
            }
        });
    });

    $('#generate_password').on('click', function (e) {
        var length = 16;
        var chars = '#aA!';
        var mask = '';

        // Characters that can be randomly generated.
        if (chars.indexOf('a') > -1) mask += 'abcdefghijklmnopqrstuvwxyz';
        if (chars.indexOf('A') > -1) mask += 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        if (chars.indexOf('#') > -1) mask += '0123456789';
        if (chars.indexOf('!') > -1) mask += '~`!@#$%^&*()_+-={}[]:";\'<>?,./|\\';

        var result = '';
        for (var i = length; i > 0; --i) result += mask[Math.round(Math.random() * (mask.length - 1))];

        // Set the generated passwords into the input.
        $('#password').val(result);
        $('#confirm_password').val(result);
    });

    // Toggle Show/Hide Password.
    $('.toggle-password').on('click', function (e) {

        var password = $(this).parent().parent().find('input');

        $(this).toggleClass('fa-eye-slash').toggleClass('fa-eye');

        if (password.attr('type') === "password") {
            // Change input type text to show password.
            password.attr('type', 'text');
        } else {
            // Change input type text to show password.
            password.attr('type', 'password');
        }
    });

    // Hide the password field by default in edit form.
    $('#password_field').hide(function () {
        if ($(this).is(":hidden")) {
            $(this).find('input').attr('hidden', true);
            $(this).find('input').removeAttr('required');
        }
    });

    $('#enable_password').on('click', function (e) {

        // Toggle the password field to hide/show.
        $("#password_field").toggle(500, function () {
            // Update the input fields when hiding/showing.
            if ($(this).is(":hidden")) {
                $(this).find('input').attr('hidden', true);
                $(this).find('input').removeAttr('required');
                $(this).find('input').val('');
            } else {
                $(this).find('input').attr('required', true);
                $(this).find('input').removeAttr('hidden');
            }
        });

    });
</script>