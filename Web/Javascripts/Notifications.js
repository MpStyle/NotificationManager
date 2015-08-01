function Notifications()
{
    $('.DeleteNotificationModal').on('show.bs.modal', function (event) {
        var $button = $(event.relatedTarget);
        $('.DeleteNotificationModal .NotificationTitle').html($button.siblings(".NotificationTitle").val());
        $('.DeleteNotificationModal .NotificationId').val($button.siblings(".NotificationId").val());
    });

    $(".ErrorMessage").fadeTo(2000, 500).slideUp(500, function () {
    });
}

$(function () {
    var notifications = new Notifications();
});