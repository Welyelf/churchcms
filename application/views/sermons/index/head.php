<script type="text/javascript" src="/assets/plugins/addins/js/jquery.touchSwipe.min.js"></script>

<script>
    $(document).ready(function () {
        $('#slider3 .carousel.main ul').carouFredSel({
            auto: false,
            responsive: true,
            prev: '.prev3',
            next: '.next3',
            width: '80%',
            scroll: {
                items: 1,
                easing: "easeOutExpo"
            },
            items: {
                width: '200',
                height: 'variable',	//	optionally resize item-height
                visible: {
                    min: 1,
                    max: 1
                }
            },
            mousewheel: false,
            swipe: {
                onMouse: true,
                onTouch: false
            }
        });

        function updateSizes_vat() {
            $('#slider3 .carousel.main ul').trigger("updateSizes");
        }

        updateSizes_vat();
    }); //
    $(window).load(function () {
        //

    }); //
</script>
