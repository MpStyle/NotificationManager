function Devices()
{
    $('.DeleteDeviceModal').on('show.bs.modal', function (event) {
        var $button = $(event.relatedTarget);
        $('.DeleteDeviceModal .MobileId').html($button.siblings(".MobileId").val());
        $('.DeleteDeviceModal .DeleteDeviceId').val($button.siblings(".DeviceId").val());
    });
}

$(function(){
    var devices=new Devices();
});