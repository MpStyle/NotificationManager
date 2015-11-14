function Devices()
{
    $('.DeleteDeviceModal').on('show.bs.modal', function (event) {
        var $button = $(event.relatedTarget);
        var deviceId=$button.parents("form").find(".DeviceId").val();
        
        $('.DeleteDeviceModal .modal-delete-device-id').html(deviceId);
        $('.DeleteDeviceModal .modal-delete-device-id').val(deviceId);
    });

    $(".ErrorMessage").fadeTo(2000, 500).slideUp(500, function () {
    });
}

$(function () {
    var devices = new Devices();
});