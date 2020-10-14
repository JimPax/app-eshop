'use strict';

app.factory('DeleteProduct',function($http, $httpParamSerializerJQLike){
    var code = {};
    return{
        getDetails:function(){
            var promise = $http({
                method: 'GET',
                url: 'webservices/allProductDetails.php'
            }).then(function (response) {
                var data = response.data;
                console.log(data);
                return data;
            });
            return promise;
        },
        setCode:function(pcode){
            code = pcode;
            console.log(code);
        },
        deletePr:function(){
            var promises = $http({
                method: 'POST',
                url: 'webservices/deleteProduct.php',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data: $httpParamSerializerJQLike(code)
            }).then(function(response) {
                var d = response.data;
                console.log(d);
                return d;
            });
            return promises;
        }
    };

});
