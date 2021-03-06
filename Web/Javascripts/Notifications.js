function Notifications()
{
    $('.delete-notification-modal').on('show.bs.modal', function (event) {
        var $button = $(event.relatedTarget);
        $('.DeleteNotificationModal .NotificationTitle').html($button.siblings(".NotificationTitle").val());
        $('.DeleteNotificationModal .NotificationId').val($button.siblings(".NotificationId").val());
        
        $('.delete-notification-modal .modal-notification-title').html($button.parents("form").find(".notification-title").val());
        $('.delete-notification-modal .modal-notification-id').val($button.parents("form").find(".notification-id").val());
    });

    $(".ErrorMessage").fadeTo(2000, 500).slideUp(500, function () {
    });
}
 
$(function () {
    var notifications = new Notifications();
});