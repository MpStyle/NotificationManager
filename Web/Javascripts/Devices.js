function Devices()
{
    $('.DeleteDeviceModal').on('show.bs.modal', function (event) {
        var $button = $(event.relatedTarget);
        var deviceId=$button.parents("form").find(".DeviceId").val();
        
        $('.DeleteDeviceModal .modal-delete-device-id').html(deviceId);
        $('.DeleteDeviceModal .modal-delete-device-id').val(deviceId);
    }); 
    
    $('.set-nickname-modal').on('show.bs.modal', function (event) {
        var $button = $(event.relatedTarget);
        var deviceId=$button.parents("form").find(".DeviceId").val();
        var nickname=$button.parents("form").find(".Nickname").val();
        
        $('.set-nickname-modal .modal-device-id').val(deviceId);
        $('.set-nickname-modal .modal-nickname').val(nickname);
    });

    $(".ErrorMessage").fadeTo(2000, 500).slideUp(500, function () {
    });
}

$(function () {
    var devices = new Devices();
});