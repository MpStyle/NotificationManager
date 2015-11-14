function LoggedMasterPage()
{
    $(".ShowFilter").click(function () {
        $(".FiltersForm").slideToggle();
    });
}

LoggedMasterPage.prototype.toggleMenu = function ()
{
    if ($("#left-column").hasClass("hidden-xs"))
    {
        $("#left-column").removeClass("hidden-xs");
        $("#MenuDarkSide").show();
    }
    else
    {
        $("#left-column").addClass("hidden-xs");
        $("#MenuDarkSide").hide();
    }
};

$(function () {
    var loggedMasterPage = new LoggedMasterPage();

    $("#toggle_menu, #MenuDarkSide").click(function () {
        loggedMasterPage.toggleMenu();
    });
});