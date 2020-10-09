'use strict';

app.factory('register',function($http, $httpParamSerializerJQLike){
    var userData = {};
    return {
        setUserData: function (userD) {
            userData = userD;
            console.log("insertSet:");
            console.log(userData);
        },
        insertUserData: function () {
            var promises = $http({
                method: 'POST',
                url: 'webservices/register.php',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data: $httpParamSerializerJQLike(userData)
            }).then(function (response) {
                var d = response.data;
                console.log(d);
                return d;
            });
            return promises;
        }
    };
});

