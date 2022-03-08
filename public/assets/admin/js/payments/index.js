
initialize();
function initialize(){
    $('.autocomplete_off').attr('autocomplete','off');
}
$('.show_payment').click(function(){
    $('#client_address').empty();
    $('#vendor_address').empty();
    $('#office_address').empty();
    let payment_id = $('#payment_id').val();
    let vendor_id = $('#vendor_id').val();
    let client_id = $('#client_id').val();
    var temp = $(this);
    if ($(this).siblings('.purchase_id').val() == null) {
        $.get('/admin/client/' + client_id, function (data) {
            $('#client_address').append('Customer: <br><h4>' + data['company'] +
                '</h4>' +
                data['billing_address'] + '<br> Phone: ' + data[
                    'phone'
                ] +
                '<br>Email: ' + data['email']);
        });
    } else {
        $.get('/admin/vendor/' + vendor_id, function (data) {
            $('#vendor_address').append('To: <br><h4>' + data['company'] + '</h4>' +
                data['billing_address'] + '<br> Phone: ' + data[
                    'phone'
                ] +
                '<br>Email: ' + data['email']);
        });

    }
    $.get('/admin/payments/' + payment_id, function (data) {
        $('#payment_date').text(data['date']);
        if (temp.siblings('.purchase_id').val() == null) {
            $('#sales_ref').text(data['id']);
        } else {
            $('#purchase_ref').text(data['id']);
        }
        $('#payment_ref').text(data['reference_no']);
        $('#office_address').append(
            'From: <br><h4>Buzzer Office</h4>67, Ayer Rajah Crescent, #07-21/26<br>Phone: { phonenumber }<br>Email:rujyi@hotmail.com'
        );
        $('#payment_received').text(data['received_amt']);
        $('#payment_type').text(data['payment_method']);
    });
});

$('.edit_payment').click(function(){
    $('.purchaseId').val($('.purchase_id').val());
    let payment_id = $('#payment_id').val();
    $('#editPayment').attr('action', '/admin/payments/' + payment_id);
    $.get('/admin/payments/' + payment_id + '/edit', function (data) {
        $('#editPayment').find('#datepicker-3').val(data['date']);
        $('#editPayment').find('#reference_no').val(data['reference_no']);
        $('#editPayment').find('#amount').val(data['received_amt']);
        $('#editPayment').find('#attachment').val(data['attachment']);
        $('#editPayment').find('#method').val(data['payment_method']);
    });
});

$('.delete_payment').click(function(){
    let payment = $('#payment_id').val();
    $('#form-d-payment').attr('action', '/admin/payments/' + payment);
});
