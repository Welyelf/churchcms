<style type="text/css">

    /** Start css for customization table only **/

    .switch input {
        display: none;
    }

    .switch {
        display: inline-block;
        width: 60px;
        height: 30px;
        margin: 8px;
        transform: translateY(50%);
        position: relative;
    }

    .slider {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        border-radius: 30px;
        box-shadow: 0 0 0 2px #777, 0 0 4px #777;
        cursor: pointer;
        border: 4px solid transparent;
        overflow: hidden;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        width: 100%;
        height: 100%;
        background: #777;
        border-radius: 30px;
        transform: translateX(-30px);
        transition: .4s;
    }

    input:checked + .slider:before {
        transform: translateX(30px);
        background: #337ab7;
        content: "";

    }

    input:checked + .slider {
        box-shadow: 0 0 0 2px #337ab7, 0 0 2px #337ab7;
        content: "";
    }

    .slider:after {
        content: 'OFF';
        color: #777;
        display: block;
        position: absolute;
        transform: translate(-50%, -50%);
        top: 50%;
        left: 80%;
        font-size: 10px;
        font-family: Verdana, sans-serif;
    }

    input:checked + .slider:after {
        content: 'ON';
        color: #337ab7;
        top: 50%;
        left: 30%;
    }

    /** End css **/
</style>
    
