'use strict';

app.service('Cart',function($http, $httpParamSerializerJQLike){
    var cqset = {};
    return {
        setToCart: function (pset) {
            cqset = pset;
            console.log(cqset);
        },
        addToCart: function(){
            console.log(cqset);
            var promise = $http({
                method: 'POST',
                url: 'webservices/addToCart.php',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data: $httpParamSerializerJQLike(cqset)
            }).then(function (response) {
                var data = response.data;
                console.log(data);
                console.log("asf");
                return data;
            });
            return promise;
        },
        displayCart: function(){
            var promise = $http({
                method: 'GET',
                url: 'webservices/displayCart.php'
            }).then(function (response){
                var data = response.data;
                console.log(data);
                return data;
            });
            return promise;
        },
        changeQuantity: function(code){
            var promise = $http({
                method: 'POST',
                url: 'webservices/changeCartQuant.php',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data: $httpParamSerializerJQLike(code)
            }).then(function (response) {
                var data = response.data;
                console.log(data);
                return data;
            });
            return promise;
        },
        deleteItem: function(code){
            var promise = $http({
                method: 'POST',
                url: 'webservices/deleteCartItem.php',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data: $httpParamSerializerJQLike(code)
            }).then(function (response) {
                var data = response.data;
                console.log(data);
                return data;
            });
            return promise;
        }
    };
});
