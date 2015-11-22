function EditApp()
{
    var outerThis=this;
    
    $("#RefreshSecretIdButton").click(function () {
        $("#SecretIdText").val(outerThis.generateUUID());
    });
} 

EditApp.prototype.generateUUID= function() {
    var d = new Date().getTime();
    var uuid = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
        var r = (d + Math.random()*16)%16 | 0;
        d = Math.floor(d/16);
        return (c==='x' ? r : (r&0x3|0x8)).toString(16);
    });
    
    return uuid;
};

$(function () {
    var editApp = new EditApp();
});