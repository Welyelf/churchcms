<style>

    .package {
        box-sizing: border-box;
        width: 240px;
        height: 100%;
        border: 3px solid #e8e8e8;
        border-radius: 7px;
        display: inline-block;
        padding: 14px;
        text-align: center;
        float: left;
        transition: margin-top 0.5s linear;
        position: relative;
        margin-right: 11px;
        border-color: #52a452;
    }

    .planname {
        color: #565656;
        font-weight: 300;
        font-size: 1.2em;
        margin-top: -5px;
    }

    .plan_description {
        margin-top: 7px;
        font-weight: italic;
        font-size: 0.8em;
    }

    .price::after {
        content: " ";
        font-weight: normal;
    }

    hr {
        background-color: #dedede;
        border: none;
        height: 1px;
    }

    .trial {
        font-size: 0.9rem;
        font-weight: 600;
        padding: 2px 21px 2px 21px;
        color: #33c4b6;
        border: 1px solid #e4e4e4;
        display: inline-block;
        border-radius: 15px;
        background-color: white;
        position: relative;
        bottom: -20px;
    }

    ul {
        list-style: none;
        padding: 0;
        text-align: left;
        margin-top: 29px;
    }

    li {
        margin-bottom: 15px;
    }

    .checkIcon {
        font-family: "FontAwesome";
        content: "\f00c";
    }

    input[type=checkbox] + label {
        display: block;
        margin: 0.2em;
        cursor: pointer;
        padding: 0.2em;
    }

    input[type=checkbox] {
        display: none;
    }

    input[type=checkbox] + label:before {
        content: "\2714";
        border: 0.1em solid #000;
        border-radius: 0.2em;
        display: inline-block;
        width: 1em;
        height: 1em;
        padding-left: 0.2em;
        padding-bottom: 0.3em;
        margin-right: 0.2em;
        vertical-align: bottom;
        color: transparent;
        transition: .2s;
    }

    input[type=checkbox] + label:active:before {
        transform: scale(0);
    }

    input[type=checkbox]:checked + label:before {
        background-color: MediumSeaGreen;
        border-color: MediumSeaGreen;
        color: #fff;
    }

    input[type=checkbox]:disabled + label:before {
        transform: scale(1);
        border-color: #aaa;
    }

    input[type=checkbox]:checked:disabled + label:before {
        transform: scale(1);
        background-color: #bfb;
        border-color: #bfb;
    }


    .fields input {
        width: 90%;
        font-size: 17px;
        padding: 10px;
        border-radius: 4px;
        border-width: 0px;
        font-family: 'Montserrat', sans-serif;
        font-weight: 500;
        margin-bottom: 10px;

    }

    .credit-card-box .panel-title {
        display: inline;
        font-weight: bold;
    }

    /* The old "center div vertically" hack */
    .credit-card-box .display-table {
        display: table;
    }

    .credit-card-box .display-tr {
        display: table-row;
    }

    .credit-card-box .display-td {
        display: table-cell;
        vertical-align: middle;
        width: 80%;
    }

    /* Just looks nicer */
    .credit-card-box .panel-heading img {
        min-width: 180px;
    }

    .credit-card-box .panel-heading {
        background-color: #eee;
    }


    .input-group .form-control:first-child, .input-group-addon:first-child, .input-group-btn:first-child > .btn, .input-group-btn:first-child > .btn-group > .btn, .input-group-btn:first-child > .dropdown-toggle, .input-group-btn:last-child > .btn-group:not(:last-child) > .btn, .input-group-btn:last-child > .btn:not(:last-child):not(.dropdown-toggle) {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }

    .panel-info {
        border-color: #bce8f1;
    }

    .input-group-addon:first-child {
        border-right: 0;
    }

    .input-group {
        position: relative;
        display: table;
        border-collapse: separate;
        margin-bottom: 5px
    }

    .input-group-addon {
        padding: 4px 12px;
        font-size: 14px;
        font-weight: 400;
        line-height: 1;
        color: #555;
        text-align: center;
        background-color: #eee;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .input-group-addon, .input-group-btn {
        width: 1%;
        white-space: nowrap;
        vertical-align: middle;
    }

    .input-group .form-control, .input-group-addon, .input-group-btn {
        display: table-cell;
    }

    .box {
        background: #fff;
        transition: all 0.2s ease;
        border: 2px dashed #dadada;
        margin-top: 10px;
        box-sizing: border-box;
        border-radius: 5px;
        background-clip: padding-box;
        padding: 0 20px 20px 20px;
        min-height: 340px;
    }

    .box:hover {
        border: 2px solid #525C7A;
    }

    .box span.box-title {
        color: #fff;
        font-size: 24px;
        font-weight: 300;
        text-transform: uppercase;
    }

    .box .box-content {
        padding: 16px;
        border-radius: 0 0 2px 2px;
        background-clip: padding-box;
        box-sizing: border-box;
    }

    .box .box-content p {
        color: #515c66;
        text-transform: none;
    }

    .loader {
        width: 70px;
        height: 70px;
        margin: 10px auto;
        margin-bottom: 20px;

    }

    .loader p {
        font-size: 16px;
        color: #777;
    }

    .loader .loader-inner {
        display: inline-block;
        width: 15px;
        border-radius: 15px;
        background: #74d2ba;
    }

    .loader .loader-inner:nth-last-child(1) {
        -webkit-animation: loading 1.5s 1s infinite;
        animation: loading 1.5s 1s infinite;
    }

    .loader .loader-inner:nth-last-child(2) {
        -webkit-animation: loading 1.5s .5s infinite;
        animation: loading 1.5s .5s infinite;
    }

    .loader .loader-inner:nth-last-child(3) {
        -webkit-animation: loading 1.5s 0s infinite;
        animation: loading 1.5s 0s infinite;
    }

    @-webkit-keyframes loading {
        0% {
            height: 15px;
        }
        50% {
            height: 35px;
        }
        100% {
            height: 15px;
        }
    }

    @keyframes loading {
        0% {
            height: 15px;
        }
        50% {
            height: 35px;
        }
        100% {
            height: 15px;
        }
    }


</style>	
