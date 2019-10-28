<script src="https://checkout.stripe.com/checkout.js"></script>
<script>

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
    //I partially put it here because when I put this on donation/index/foot.php , the javascipt
    // isn't working
    $(document).ready(function () {

        $('input[type="checkbox"]').on('change', function () {
            $('input[type="checkbox"]').not(this).prop('checked', false);
            var checkedValue = document.querySelector('.messageCheckbox:checked').value;
            if (checkedValue === "Monthly") {
                //alert(checkedValue);
                document.getElementById('recurring').style.display = "block";
                document.getElementById('oneTime').style.display = "none";
            } else {
                document.getElementById('oneTime').style.display = "block";
                document.getElementById('recurring').style.display = "none";
            }
        });


        var date_input = $('input[name="date"]');
        date_input.datepicker({
            format: 'dd/mm/yyyy',
            todayHighlight: true,
            autoclose: true,
        });

        var date_input1 = $('input[name="date1"]');
        date_input1.datepicker({
            format: 'dd/mm/yyyy',
            todayHighlight: true,
            autoclose: true,
        });

        $('#recurring').change(function () {
            if (this.checked)
                $('#dateStart').fadeIn('slow');
            else
                $('#dateStart').fadeOut('slow');

        });

    });

    function printDiv() {
        var w = window.open();
        var html = $("#printableArea").html();
        $(w.document.body).html(html);
        setTimeout(function () {
            window.location.reload(1);
        }, 7000);
        w.print();

    }

    function updateAmtOntTime() {
        $("#amt").val($("#one_time_donation").val());
        $("#overall-total").text(numberWithCommas(parseInt($("#one_time_donation").val())));
    }

    function updateAmt(id) {
        $("#amt").val(parseInt(0));

        <?php foreach($plans as $plan) { ?>
        $("#plan-<?php echo $plan->name;?>").val(Math.round($("#plan-<?php echo $plan->name;?>").val()));
        plan_total = parseInt($("#plan-<?php echo $plan->name;?>").val() * <?php echo $plan->amount;?> );
        $("#amt").val(plan_total + parseInt($("#amt").val()));
        $("#plan-<?php echo $plan->name;?>-total").text(numberWithCommas(parseInt(plan_total)));
        <?php } ?>

        $("#overall-total").text(numberWithCommas(parseInt($("#amt").val())));
    }

    function numberWithCommas(x) {
        var parts = x.toString().split(".");
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        return parts.join(".");
    }

    $(document).ready(function () {

        // scroll to top for processing
        function scrollTo() {
            var hash = '#main';
            var destination = $(hash).offset().top;
            stopAnimatedScroll();
            $('html, body').stop().animate({
                scrollTop: destination
            }, 400, function () {
                window.location.hash = hash;
            });
            return false;
        }

        function stopAnimatedScroll() {
            if ($('*:animated').length > 0) {
                $('*:animated').stop();
            }
        }

        if (window.addEventListener) {
            document.addEventListener('DOMMouseScroll', stopAnimatedScroll, false);
        }
        document.onmousewheel = stopAnimatedScroll;

        // prevent decimal in donation input
        $('#amt').keypress(function (event) {
            preventDot(event);
        });

        function preventDot(event) {
            var key = event.charCode ? event.charCode : event.keyCode;
            if (key == 46) {
                event.preventDefault();
                return false;
            }
        }

        function showProcessing() {
            /*scrollTo();
            $('.donate-process').addClass('show').attr('aria-expanded', 'true');
            $('.donate-thanks, .donate-alert').removeClass('show').attr('aria-expanded', 'false');*/
            document.getElementById('donation_process').style.display = "block";
            $('#donateNow').attr('disabled', 'disabled');
        }

        function hideProcessing() {
            /*$('.donate-process').removeClass('show').attr('aria-expanded', 'false');*/
            document.getElementById('donation_process').style.display = "none";
        }

        // set up Stripe config, ajax post to charge
        var handler = StripeCheckout.configure
        ({
            key: '<?php echo $settings->stripe_test_mode == 1 ? $settings->test_stripe_pk : $settings->live_stripe_pk; ?>',
            /*image: 'path/to/img',*/
            image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
            locale: 'auto',
            /*closed: function(){document.getElementById('donateNow').removeAttribute('disabled');},*/
            token: function (token) {
                $.ajax({
                    url: '/stripe/checkout/',
                    type: 'POST',
                    dataType: 'json',
                    beforeSend: showProcessing,
                    data: {
                        stripeToken: token.id,
                        stripeEmail: token.email,
                        donationAmt: donationAmt,
                        plan: plan,
                        mobile: mobile,
                        landline: landline,
                        street: address1,
                        city: locality,
                        state: region,
                        zip: postal_code,
                        country: county,
                        donationType: donationtype
                    },
                    success: function (data) {
                        hideProcessing();
                        $('#amt').val('');
                        if (data.error != '') {
                            if (data.error == 'Subscription Exists') {
                                window.location = "//<?php echo $_SERVER['SERVER_NAME'];?>/auth/login/subscription-error";
                            } else {
                                success_message();
                            }

                        } else {
                            success_message();

                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        hideProcessing();
                        errormessage(errorThrown + '! Contact your administrator.');
                    }
                });
            }
        });
        // donate now button, open Checkout
        $('#donateNow').click(function (e) {
            name = document.getElementById('name').value;
            email = document.getElementById('email').value;
            mobile = document.getElementById('mobile').value;
            landline = document.getElementById('landline').value;

            donationtype = document.querySelector('.messageCheckbox:checked').value;

            $tokenID = 'req_BqwiFEpVRtt6FB';

            // strip non-numbers from amount and convert to cents
            donationAmt = document.getElementById('amt').value;
            var n = donationAmt.indexOf(".");
            if (n <= 0) {
                donationAmt = document.getElementById('amt').value + "00";

            } else {
                donationAmt = donationAmt.replace(".", "");
            }


            // for address validation
            // set access key and address parameters
            access_key = '0f60a77d5836fdcae191983c9f8632ff';
            address1 = document.getElementById('street').value;
            address2 = '';
            address3 = '';
            postal_code = document.getElementById('zip').value;
            locality = document.getElementById('city').value;
            county = document.getElementById('country').value;
            region = document.getElementById('state').value;
            country_code = '';

            var VALID_ADD;

            // verify email address via AJAX call
            $.ajax({
                url: 'http://apilayer.net/api/validate?access_key=' + access_key + '&address1=' + address1 + '&address2=' + address2 + '&address3=' + address3 + '&postal_code=' + postal_code + '&locality=' + locality + '&county=' + county + '®ion=' + region + '&country_code=' + country_code,
                dataType: 'jsonp',
                success: function (json) {

                    // Access and use your preferred validation result objects
                    VALID_ADD = json.validation_status;
                    //console.log(json.address_components);
                    //console.log(json.formatted_address);

                }
            });
            //plan = document.getElementById('plan').value;
            plan = "";
            <?php foreach($plans as $plan) { ?>
            plan += "<?php echo $plan->name;?>;" + $("#plan-<?php echo $plan->name;?>").val() + "|";
            <?php } ?>

            // make sure there is an amount
            if (donationAmt < 1) {
                $('#amt').val('').focus();
                var mes = 'No donation amount provided !';
                errormessage(mes);
                e.preventDefault();
            } else if (name == "" || email == "") {
                var mes = 'Name and Email are required !';
                errormessage(mes);
                e.preventDefault();

            } else if (VALID_ADD == 'invalid' || VALID_ADD == 'undefined') {
                var mes = "Invalid Address !";
                errormessage(mes);
                e.preventDefault();
            } else {
                document.getElementById('receipt-name').innerHTML = name;
                document.getElementById('address1').innerHTML = address1 + locality + county + postal_code;
                document.getElementById('receipt-email').innerHTML = email;
                document.getElementById('receipt-landline').innerHTML = landline;
                document.getElementById('receipt-mobile').innerHTML = mobile;
                var today = new Date().toISOString().slice(0, 10);
                document.getElementById('receipt-date').innerHTML = today;

                if (donationtype == "Monthly") {

                    <?php foreach($plans as $plan) { ?>
                    planName = "<?php echo $plan->nice_name;?>";
                    planAmt = "<?php echo $plan->amount;?>";
                    plan_total = parseInt($("#plan-<?php echo $plan->name;?>").val() * <?php echo $plan->amount;?> );
                    planQty = parseInt($("#plan-<?php echo $plan->name;?>").val());

                    document.getElementById('rcpt_plan_name').innerHTML = planName;
                    document.getElementById('rcpt_plan_amt').innerHTML = '$' + planAmt;
                    document.getElementById('rcpt_plan_total').innerHTML = '$' + plan_total;
                    document.getElementById('rcpt_plan_qty').innerHTML = planQty;

                    <?php } ?>
                } else {
                    document.getElementById('rcpt_plan_name').innerHTML = 'One Time Donation';
                    document.getElementById('rcpt_plan_amt').innerHTML = '0';
                    document.getElementById('rcpt_plan_total').innerHTML = '$' + $("#amt").val();
                    document.getElementById('rcpt_plan_qty').innerHTML = '0';
                }
                document.getElementById('rcpt_total').innerHTML = '$' + $("#amt").val();
                // Open Checkout
                handler.open({
                    name: '<?php echo $settings->site_name ?>',
                    description: 'Online Donation',
                    <?php if(isset($this->session->user->email)) { ?>
                    email: '<?php echo $this->session->user->email; ?>',
                    <?php } ?>
                    amount: donationAmt,
                    panelLabel: 'Give {{amount}} Per Month'
                });
                e.preventDefault();
            }
        });

        function errormessage(message) {
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
                show_receipt();
            }, 4000);
        }

        function show_receipt() {
            document.getElementById('receipt').style.display = "block";
            document.getElementById('information_area').style.display = "none";

        }

        // quick-add amount buttons
        $('.btn-amt').click(function () {
            var insert = $.parseJSON($(this).attr('data-amt'));
            $('#amt').val(insert);
        });

        // Close Checkout on page navigation
        $(window).on('popstate', function () {
            handler.close();
        });

    });
</script>