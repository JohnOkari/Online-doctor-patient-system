(function () {

    if ($('#role').val() == "doctor") {
        $('.form-doctor').show();
    }
    $('#role').on('change', function () {
        var active = $('#role').val();
        if (active == "doctor") {
            $('.form-doctor').show();
        } else {
            $('.form-doctor').hide();
        }
    })


    $('#follow').on('change',function(){
        var val = $('#follow').val();
        console.log(val)
        if (val == 'true') {
            $('.next_meet').show()
        }else{
            $('.next_meet').hide()
        }
    })

    $('#dataTable').DataTable();


    $('body').on('click','#reschedule', function(){
        var id = $(this).data('id');
        $('#appointment_id').val(id);
    })

    $('body').on('click','#cancelAppointmentButton', function(){
        console.log('there')
        var id = $(this).data('cid');
        $('#appointment_idc').val(id);
    })
})();
