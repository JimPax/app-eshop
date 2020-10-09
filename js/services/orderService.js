'use strict';

app.service('order',function($http, $httpParamSerializerJQLike){
    var oflag = false;
    return {
        orderReview: function(){
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
        shippingInfo: function(){
            var promise = $http({
                method: 'GET',
                url: 'webservices/userData.php'
            }).then(function (response){
                var data = response.data;
                console.log(data);
                return data;
            });
            return promise;
        },
        checkout: function(orderD){
            var promises = $http({
                method: 'POST',
                url: 'webservices/setOrder.php',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data: $httpParamSerializerJQLike(orderD)
            }).then(function (response) {
                var d = response.data;
                console.log(d);
                return d;
            });
            return promises;
        },
        orderData: function(){
            var promise = $http({
                method: 'GET',
                url: 'webservices/orderData.php'
            }).then(function (response){
                var data = response.data;
                console.log(data);
                return data;
            });
            return promise;
        },
        setFlag: function(value){
            oflag = value;
        },
        getFlag: function(){
            return oflag;
        }
    };
});
