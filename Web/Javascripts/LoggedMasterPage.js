function LoggedMasterPage()
{    
    $('.top-avatar-container .user-avatar').popover({
        content: function () {
            return $(".user-bar").html();
        },
        html: true
    });
}

LoggedMasterPage.prototype.toggleMenu = function ()
{
    var $leftColumn=$("#left-column");
    
    if ($leftColumn.hasClass("hidden-xs") || $leftColumn.hasClass("hidden-sm"))
    {
        $leftColumn.removeClass("hidden-xs");
        $leftColumn.removeClass("hidden-sm");
        $("#MenuDarkSide").show();
    } else
    {
        $leftColumn.addClass("hidden-xs");
        $leftColumn.addClass("hidden-sm");
        $("#MenuDarkSide").hide();
    }
};

$(function () {
    var loggedMasterPage = new LoggedMasterPage();

    $("#toggle_menu, #MenuDarkSide").click(function () {
        loggedMasterPage.toggleMenu();
    });
});