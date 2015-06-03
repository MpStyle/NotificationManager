function Apps()
{
    $('.DeleteApplicationModal').on('show.bs.modal', function (event) {
        var $button = $(event.relatedTarget);
        $('.DeleteApplicationModal .ApplicationName').html($button.siblings(".ApplicationName").val());
        $('.DeleteApplicationModal .ApplicationId').val($button.siblings(".ApplicationId").val());
    });
}

$(function(){
    var apps=new Apps();
});