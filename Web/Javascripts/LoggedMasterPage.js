function LoggedMasterPage()
{
    $(".ShowFilter").click(function () {
        $(".FiltersForm").slideToggle();
    });

    $('[data-toggle="tooltip"]').tooltip();
}

LoggedMasterPage.prototype.toggleMenu = function ()
{
    if ($("#LeftColumn").hasClass("hidden-xs"))
    {
        $("#LeftColumn").removeClass("hidden-xs");
        $("#MenuDarkSide").show();
    }
    else
    {
        $("#LeftColumn").addClass("hidden-xs");
        $("#MenuDarkSide").hide();
    }
};

$(function () {
    var loggedMasterPage = new LoggedMasterPage();

    $("#toggle_menu, #MenuDarkSide").click(function () {
        loggedMasterPage.toggleMenu();
    });
});