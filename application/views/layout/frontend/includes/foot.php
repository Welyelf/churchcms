<!-- Bootstrap Core JavaScript -->
<script src="/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="/assets/plugins/jquery-ui/jquery-ui.min.js"></script>

<!-- Global JS -->
<script src="/assets/js/global.min.js"></script>

<!-- Bootstrap JS -->
<script type="text/javascript" src="/assets/plugins/addins/js/bootstrap.js"></script>

<script type="text/javascript">

    $('#btn-subscribe').click(function (e) {
        var sudName = document.getElementById('name').value;
        var sudEmail = document.getElementById('email').value;

        if (sudName == "" || sudEmail == "") {
            error_message("Name and Email required!");
        } else {

            if (validateEmail(sudEmail)) {
                $.ajax({
                    url: '/subscribers/add/',
                    type: "POST",
                    cache: false,
                    dataType: 'json',
                    data: {name: sudName, email: sudEmail},
                    success: function (data) {
                        success_message();
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        //error_message("Subscribed Already!");
                        //alert(errorThrown);
                        if (errorThrown == "Internal Server Error") {
                            error_message("You are already registered!");
                        } else {
                            success_message();
                        }
                    }
                });
            } else {
                error_message("Email is not valid!");
            }


        }
    });

    function error_message(message) {
        document.getElementById("error_message").innerHTML = message;
        document.getElementById('error-alert').style.display = "block";
        setTimeout(function () {
            document.getElementById('error-alert').style.display = 'none'
        }, 7000);
    }

    function success_message() {
        document.getElementById('success-alert').style.display = "block";
        setTimeout(function () {
            document.getElementById('success-alert').style.display = 'none'
        }, 7000);
        setTimeout(function () {
            location.reload();
        }, 4000);
    }

    function validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }

</script>
