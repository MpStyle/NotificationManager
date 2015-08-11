function LoggedMasterPage()
{
    $(".ShowFilter").click(function () {
        $(".FiltersForm").slideToggle();
    });

    $('[data-toggle="tooltip"]').tooltip();

    $(".EntityList").resizableColumns({
        store: window.store
    });
}

$(function () {
    var loggedMasterPage = new LoggedMasterPage();
});