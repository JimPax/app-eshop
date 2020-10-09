'use strict';

app.factory('login',function($http, $httpParamSerializerJQLike){
    var loginData = {};
    return {
        setLoginData: function (userD) {
            loginData = userD;
            console.log("insertSet:");
            console.log(loginData);
        },
        insertLoginData: function () {
            var promises = $http({
                method: 'POST',
                url: 'webservices/login.php',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data: $httpParamSerializerJQLike(loginData)
            }).then(function (response) {
                var d = response.data;
                console.log(d.session);
                return d;
            });
            return promises;
        },
        islogged: function() {
            var $checkSessionServer = $http.post('webservices/checkSession.php');
            return $checkSessionServer;
        }
    };
});
