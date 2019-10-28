<script type="text/javascript" src="./assets/plugins/bootstrap-treeview/bootstrap-treeview.min.js"></script>
<script type="text/javascript">
    $(function () {
        var defaultData = [
            {
                text: 'Home',
                href: '<?php echo base_url();?>',
            },
            {
                text: 'Contact',
                href: '<?php echo base_url('contact');?>',
            },
            {
                text: 'Pages',
                href: '#',
                state: {expanded: false},
                nodes: [
                    <?php foreach ($pages as $page) { ?>
                    {
                        text: '<?php echo $page->title; ?>',
                        href: '<?php echo base_url($page->slug); ?>',
                    },
                    <?php } ?>
                ]
            },
        ];

        $('#treeview7').treeview({
            color: "#2C3E50",
            onhoverColor: "#18BC9C",
            selectedBackColor: "#2C3E50",
            selectable: false,
            showBorder: true,
            enableLinks: true,
            onNodeSelected: function (event, data) {
                if (data.href == "#") {
                    $('#treeview7').treeview('toggleNodeExpanded', [data.nodeId, {silent: true}]);
                    $('#treeview7').treeview('unselectNode', [data.nodeId, {silent: true}]);
                } else {
                    window.location = data.href;
                }
            },
            data: defaultData
        });
    });

    var toggler = document.getElementsByClassName("dropdown");
    var i;

    for (i = 0; i < toggler.length; i++) {
        toggler[i].addEventListener("click", function () {
            // Display the list.
            this.parentElement.querySelector(".nested").classList.toggle("active");
            // Toggle carets.
            this.firstElementChild.classList.toggle("fa-caret-down");
            this.firstElementChild.classList.toggle("fa-caret-right");
        });
    }

</script>
