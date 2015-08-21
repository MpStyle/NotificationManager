function LoggedMasterPage()
{
    var outherThis=this;
    
    $(".ShowFilter").click(function () {
        $(".FiltersForm").slideToggle();
    });

    $('[data-toggle="tooltip"]').tooltip();

    $("#PinToggle").click(function () {
        if ($("#Container").hasClass("Unpin"))
        {
            outherThis.pinLeftBar();
        }
        else
        {
            outherThis.unpinLeftBar();
        }
    });
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

LoggedMasterPage.prototype.pinLeftBar = function () {
    $("#Container").removeClass("Unpin");
    var foo = new $.JsonRpcClient({ajaxUrl: 'WebServices/UISettings.php'});
    foo.call(
            'set'
            , {
                key: "PinLeftBar"
                , value: true
            }
    , function (data) {
    }, function (error) {
            }
    );
};

LoggedMasterPage.prototype.unpinLeftBar = function () {
    $("#Container").addClass("Unpin");
    var foo = new $.JsonRpcClient({ajaxUrl: 'WebServices/UISettings.php'});
    foo.call(
            'set'
            , {
                key: "PinLeftBar"
                , value: false
            }
    , function (data) {
    }, function (error) {
            }
    );
};

$(function () {
    var loggedMasterPage = new LoggedMasterPage();

    $("#toggle_menu, #MenuDarkSide").click(function () {
        loggedMasterPage.toggleMenu();
    });
});