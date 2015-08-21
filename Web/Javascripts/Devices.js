function Devices()
{
    $('.DeleteDeviceModal').on('show.bs.modal', function (event) {
        var $button = $(event.relatedTarget);
        $('.DeleteDeviceModal .MobileId').html($button.parents("form").find(".MobileId").val());
        $('.DeleteDeviceModal .DeleteDeviceId').val($button.parents("form").find(".DeviceId").val());
    });

    $(".ErrorMessage").fadeTo(2000, 500).slideUp(500, function () {
    });
}

$(function () {
    var devices = new Devices();
});