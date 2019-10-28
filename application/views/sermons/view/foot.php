<script src="https://checkout.stripe.com/checkout.js"></script>
<script>
    function printDiv() {
        var w = window.open();
        var html = $("#view_sermon").html();
        $(w.document.body).html(html);
        setTimeout(function () {
            window.location.reload(1);
        }, 7000);
        w.print();
    }

    window.onbeforeprint = function () {
        document.getElementById('printSermon').style.display = "block";
    };
    window.onafterprint = function () {
        document.getElementById('printSermon').style.display = "none";
    }
</script>