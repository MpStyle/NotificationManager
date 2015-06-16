function LoggedMasterPage()
{
    $(".ShowFilter").click(function(){
        $(".FiltersForm").slideToggle();
    });
    
    $('[data-toggle="tooltip"]').tooltip();
}

$(function(){
    var loggedMasterPage=new LoggedMasterPage();
});