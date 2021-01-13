'use strict';
$(document).ready(function () {

    // Date picker
    $('#dp1').datepicker({
        format: 'yyyy-mm-dd',
        todayHighlight: true,
        autoclose: true,
        orientation:"bottom"
    });
    $('#dp2').datepicker({
        format: 'yyyy-mm-dd',
        todayHighlight: true,
        autoclose: true,
        orientation:"bottom"
    });    
});
