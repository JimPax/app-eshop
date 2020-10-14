'use strict';

app.factory('ProductDetails',function($http, $httpParamSerializerJQLike){
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
        getDetInp:function(){
            var promise = $http({
                method: 'POST',
                url: 'webservices/myProducts.php',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data: $httpParamSerializerJQLike(code)
            }).then(function (response) {
                var data = response.data;
                console.log(data);
                console.log("asd");
                return data;
            });
            return promise;
        },
        getSlidesInp:function(){
            var promise = $http({
                method: 'POST',
                url: 'webservices/productImgs.php',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data: $httpParamSerializerJQLike(code)
            }).then(function (response) {
                var data = response.data;
                console.log("cyykasrvc");
                console.log(data);
                return data;
            });
            return promise;
        }
    };

});
