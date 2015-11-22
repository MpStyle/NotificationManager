function EditNotification()
{
    // Gestione dei renge delle date
    $('#StartDate').datetimepicker({
        format: 'DD/MM/YYYY'
    });
    $('#EndDate').datetimepicker({
        format: 'DD/MM/YYYY'
    }); 

    $("#StartDate").on("dp.change", function (e) {
        $('#EndDate').data("DateTimePicker").minDate(e.date);
    });
    $("#EndDate").on("dp.change", function (e) {
        $('#StartDate').data("DateTimePicker").maxDate(e.date);
    });

    // Gestione dei link
    $("#LinkType").change(function () {
        if ($(this).val() === "INTERNAL")
        {
            $("#InternalLinkGroup").slideDown();
            $("#ExternalLinkGroup").slideUp();
        }
        else
        {
            $("#InternalLinkGroup").slideUp();
            $("#ExternalLinkGroup").slideDown();
        }
    });
}

EditNotification.prototype.loadInternalLinks = function (applicationId) {
    var foo = new $.JsonRpcClient({ajaxUrl: 'WebServices/GetApplicationLinks.php'});
    foo.call('get', {
        "applicationId": applicationId
    }, function (data) {
        if (data.Result === true)
        {
            var $InternalLinks = $("#InternalLinks");
            
            $InternalLinks.empty();
            
            for (var i = 0; i < data.ApplicationLinks.length; i++) 
            {
                $InternalLinks.append('<option value="' + data.ApplicationLinks[i].id + '">' + data.ApplicationLinks[i].name + '</option>');
            }
        }
    }, function (error) {
    });
};

$(function () {
    var editNotification = new EditNotification();

    $("#ApplicationId").change(function () {
        editNotification.loadInternalLinks($("#ApplicationId").val());
    });
});