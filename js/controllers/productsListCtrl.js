'use strict';

app.controller('PLCtrl', function($scope, $http, ProductDetails) {
    ProductDetails.getDetails().then(function(d){
        $scope.prDet = d;
        console.log($scope.prDet);
    });
});
