(function() {
    var po = document.createElement('script');
    po.type = 'text/javascript';
    po.async = true;
    po.src = 'https://plus.google.com/js/client:plusone.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(po, s);
})();

var helper = (function() {
    var authResult = undefined;
 
    return {
        onSignInCallback: function(authResult)
        {
            if (authResult['access_token'])
            {
                this.authResult = authResult;
                $('#gConnect').hide();
                this.backOfficeLogin();
            }
            else if (authResult['error'])
            {
                $('#gConnect').show();
            }
        },
        backOfficeLogin: function()
        {
            // Controlla il token server side, se è valido effettua il login, 
            // altrimenti no.
            var foo = new $.JsonRpcClient({ajaxUrl: 'WebServices/Login.php'});
            foo.call(
                'aaa'
                , {
                    token_id: this.authResult['id_token']
                    , access_token: this.authResult['access_token']
                    , token_type: this.authResult['token_type']
                    , created: this.authResult['issued_at']
                    , expires_in: this.authResult['expires_in']
                }
                , function(data) {
                    if (data.Result === true)
                    {
                        var queryString = new MQueryString();
                        var currentPage = queryString.getValue('currentPage');

                        window.location = 'Home.php?currentPage=' + (currentPage === null ? "" : currentPage);
                    }
                    else
                    {
                        $('#gConnect').show();
                    }
                },
                function(error) {
//                    console.log('There was an error', error);
                }
            );
        }
    };
})();

$(document).ready(function() {
    $('#disconnect').click(helper.disconnectServer);
});

function onSignInCallback(authResult) {
    helper.onSignInCallback(authResult);
}