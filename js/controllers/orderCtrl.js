'use strict';

app.controller('orderCtrl',function(order, $scope, $window){

    order.orderReview().then(function(d){
        $scope.prDet = d;
        $scope.fprice = d.tprice;
    });

    order.shippingInfo().then(function(d){
        $scope.orderd = d;
        console.log(d);
    });

    $scope.checkout = function (orderd) {
        var orderD = {json: JSON.stringify(angular.copy(orderd))};

        order.checkout(orderD).then(function(d){
            console.log(d);
            $scope.complete=true;
            console.log("teesss");
        });
    };

    $scope.oflag = order.getFlag();

});
