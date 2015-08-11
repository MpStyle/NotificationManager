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

LoggedMasterPage.prototype.toggleMenu = function ()
{
//    if ($('#LeftColumn').is(':hidden'))
//    {
//        $("#LeftColumn").hide();
//        $("#LeftColumn").removeClass("hidden-xs");
//        $("#MenuDarkSide").show();
//    }
//
//    $("#LeftColumn").toggle(function () {
//        if ($('#LeftColumn').is(':hidden'))
//        {
//            $("#LeftColumn").addClass("hidden-xs");
//            $("#LeftColumn").show();
//            $("#MenuDarkSide").hide();
//        }
//    });

//    $("#LogoImageMenu").click(function () {
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
//    });
};

$(function () {
    var loggedMasterPage = new LoggedMasterPage();

    $("#toggle_menu, #MenuDarkSide").click(function () {
        loggedMasterPage.toggleMenu();
    });
});