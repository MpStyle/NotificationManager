function Apps()
{
    $('.DeleteApplicationModal').on('show.bs.modal', function (event) {
        var $button = $(event.relatedTarget);
                
        $('.DeleteApplicationModal .modal-application-name').html($button.parents("form").find(".application-name").val());
        $('.DeleteApplicationModal .modal-application-id').val($button.parents("form").find(".application-id").val());
    });
     
    $(".ErrorMessage").fadeTo(2000, 500).slideUp(500, function () {
    });
}

$(function(){
    var apps=new Apps();
});