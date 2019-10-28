<link href="./assets/plugins/bootstrap-treeview/bootstrap-treeview.min.css" rel="stylesheet" type="text/css">
<style>
    .tree li {
        list-style-type: none;
        margin: 0;
        padding: 10px 5px 0 5px;
        position: relative
    }

    .tree li::before,
    .tree li::after {
        content: '';
        left: -20px;
        position: absolute;
        right: auto
    }

    .tree li::before {
        border-left: 2px solid #d1d4d6;
        bottom: 50px;
        height: 100%;
        top: 0;
        width: 1px
    }

    .tree li::after {
        border-top: 2px solid #d1d4d6;
        height: 20px;
        top: 25px;
        width: 25px
    }

    .tree li span {
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        border: 2px solid #000;
        border-radius: 3px;
        display: inline-block;
        padding: 3px 8px;
        text-decoration: none;
        cursor: pointer;
    }

    .tree > ul > li::before,
    .tree > ul > li::after {
        border: 0
    }

    .tree li:last-child::before {
        height: 27px
    }

    .tree li span:hover {
        background: #54a954;
        border: 2px solid #d1d4d6;
    }

    .nested {
        display: none;
    }

    .active {
        display: block;
    }

</style>   