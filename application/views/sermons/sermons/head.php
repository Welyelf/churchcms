<style>
    .image {
        position: relative;
        width: 100%; /* for IE 6 */
    }

    .image_passage {
        position: absolute;
        text-align: center;
        top: 150px;
        left: 0;
        width: 100%;
        font-size: 1.3em;
        font-style: italic;
    }
</style>
<style>
    tbody tr {
        display: inline-block !important;
        margin: 10px;
        width: 260px;
        max-width: 100%;
    }

    td {
        width: 100%;

    }

    .table-striped tbody > tr:nth-child(odd) > td, .table-striped tbody > tr:nth-child(odd) > th {
        background-color: #ffffff !important;
    }

    table.dataTable thead th, table.dataTable thead td {
        padding: 10px 18px;
        border-bottom: 1px solid #fff !important;
    }

    .table th, .table td {
        text-align: left;
        vertical-align: top;
        border-top: 1px solid #ffffff !important;
    }

    table.dataTable thead .sorting,
    table.dataTable thead .sorting_asc,
    table.dataTable thead .sorting_desc {
        background: none;
    }

    table.dataTable.no-footer {
        border-bottom: 1px solid #ddd !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        color: #ffffff !important;
        cursor: pointer;
        text-align: center;
        vertical-align: middle;
        background-color: #51a351;
        background-image: -moz-linear-gradient(top, #62c462, #51a351);
        background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#62c462), to(#51a351));
        background-image: -webkit-linear-gradient(top, #62c462, #51a351);
        background-image: -o-linear-gradient(top, #62c462, #51a351);
        background-image: linear-gradient(to bottom, #62c462, #51a351);
        background-repeat: repeat-x;
        border: 1px solid #62c462;
        border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
        border-bottom-color: #b3b3b3;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;
        zoom: 1;
        -webkit-appearance: button;

    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        box-sizing: border-box;
        display: inline-block;
        min-width: 1.5em;
        padding: 0.5em 1em;
        margin-left: 2px;
        text-align: center;
        text-decoration: none !important;
        cursor: pointer;
        color: #333 !important;
        border: 1px solid transparent;
        border-radius: 2px;
    }
</style>

<script type="text/javascript">
    $(document).ready(function () {
        $('#sermons-list').DataTable({
            "order": [],
            "lengthChange": false,
            "dom": '<"pull-left"f><"pull-right"l>tip',
            "pageLength": <?php echo $paginate; ?>,
            "paging": <?php if (isset($paginate)) {
                echo "true";
            } else {
                echo "false";
            } ?>,
            "info":     <?php if (isset($paginate)) {
                echo "true";
            } else {
                echo "false";
            } ?>,
            "searching": <?php if (isset($paginate)) {
                echo "true";
            } else {
                echo "false";
            } ?>,
        });
        $('#sermons-list').show();
    });
</script>