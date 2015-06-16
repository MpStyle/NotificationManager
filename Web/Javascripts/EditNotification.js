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

$(function () {
    var editNotification = new EditNotification();
});