'use strict';

app.factory('UpdateProduct',function($http, $httpParamSerializerJQLike,Upload){
    var product = {};
    return {
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
        setPrDet:function(pdet){
            product = pdet;
            console.log("insertSet:");
            console.log(product);
        },
        updatePr:function(){
            var promises = $http({
                method: 'POST',
                url: 'webservices/updateProduct.php',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data: $httpParamSerializerJQLike(product)
            }).then(function(response) {
                var d = response.data;
                console.log(d);
                return d;
            });
            return promises;
        }

    };

});

