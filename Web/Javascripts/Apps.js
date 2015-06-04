function Apps()
{
    $('.DeleteApplicationModal').on('show.bs.modal', function (event) {
        var $button = $(event.relatedTarget);
        $('.DeleteApplicationModal .ApplicationName').html($button.siblings(".ApplicationName").val());
        $('.DeleteApplicationModal .ApplicationId').val($button.siblings(".ApplicationId").val());
    });
    
    $(".ErrorMessage").fadeTo(2000, 500).slideUp(500, function () {
    });
}

$(function(){
    var apps=new Apps();
});