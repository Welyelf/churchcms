<script src="https://checkout.stripe.com/checkout.js"></script>
<script>

    function updateAmt(id) {
        $("#amt").val(parseFloat(0.00));

        <?php foreach($plans as $plan) { ?>
        <?php if ($plan->name == 'additional_minutes' || $plan->name == 'base_plan' || $plan->name == 'additional_viewer_hours') { ?>
        plan_total = parseFloat($("#plan-<?php echo $plan->name;?>").val() * <?php echo $plan->amount;?> );
        $("#amt").val(parseFloat(plan_total + parseFloat($("#amt").val())).toFixed(2));
        $("#plan-<?php echo $plan->name;?>-total").text(numberWithCommas(parseFloat(plan_total).toFixed(2)));
        <?php } ?>
        <?php } ?>

        $("#overall-total").text(numberWithCommas(parseFloat($("#amt").val()).toFixed(2)));
        $("#overall-total2").text(numberWithCommas(parseFloat($("#amt").val()).toFixed(2)));
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
        }

        function hideProcessing() {
            $('.donate-process').removeClass('show').attr('aria-expanded', 'false');
        }

        // set up Stripe config, ajax post to charge
        var handler = StripeCheckout.configure({
            key: '<?php echo $settings['stripe_test_mode'] == 1 ? $settings['test_stripe_pk'] : $settings['live_stripe_pk']; ?>',
            /*image: 'path/to/img',*/
            closed: function () {
                document.getElementById('donateNow').removeAttribute('disabled');
            },
            token: function (token) {
                $.ajax({
                    url: '/stripe/checkout/',
                    type: 'POST',
                    dataType: 'json',
                    beforeSend: showProcessing,
                    data: {stripeToken: token.id, stripeEmail: token.email, donationAmt: donationAmt, plan: plan},
                    success: function (data) {
                        hideProcessing();
                        $('#amt').val('');
                        if (data.error != '') {
                            if (data.error == 'Subscription Exists') {
                                window.location = "//<?php echo $_SERVER['SERVER_NAME'];?>/auth/login/subscription-error";
                            }
                            //$('.donate-alert').addClass('show').text(data.error).attr('aria-expanded', 'true');
                        } else {
                            alert("Thank you for your payment.");
                            //$('.donate-thanks').addClass('show').text(data.success).attr('aria-expanded', 'true');
                        }
                    },
                    error: function (data) {
                        alert(data.error);
                        //$('.donate-alert').show().text(data).attr('aria-expanded', 'true');
                    }
                });
            }
        });

        // donate now button, open Checkout
        $('#donateNow').click(function (e) {
            // strip non-numbers from amount and convert to cents
            donationAmt = document.getElementById('amt').value;
            var n = donationAmt.indexOf(".");
            if (n <= 0) {
                donationAmt = document.getElementById('amt').value + "00";
            } else {
                donationAmt = donationAmt.replace(".", "");
            }

            donationAmt = parseFloat(donationAmt);

            //plan = document.getElementById('plan').value;
            plan = "";
            <?php foreach($plans as $plan) { ?>
            <?php if ($plan->name == 'additional_minutes' || $plan->name == 'base_plan' || $plan->name == 'additional_viewer_hours') { ?>
            plan += "<?php echo $plan->name;?>;" + $("#plan-<?php echo $plan->name;?>").val() + "|";
            <?php } ?>
            <?php } ?>

            // make sure there is an amount
            if (donationAmt < 1) {
                $('#amt').val('').focus();
                e.preventDefault();
            } else {
                $('#donateNow').attr('disabled', 'disabled');
                // Open Checkout
                handler.open({
                    name: '<?php echo $settings->site_name; ?>',
                    description: 'Online Payment',
                    <?php if(isset($this->session->user->email)) { ?>
                    email: '<?php echo $this->session->user->email; ?>',
                    <?php } ?>
                    amount: donationAmt,
                    panelLabel: 'Pay {{amount}} Per Month'
                });
                e.preventDefault();
            }
        });

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