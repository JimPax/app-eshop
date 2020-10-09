'use strict';

app.controller('updatePCtrl',['$scope', 'UpdateProduct', function($scope, UpdateProduct) {

    $scope.uhideVar=true;

    UpdateProduct.getDetails().then(function(d){
        $scope.prdctDet = d;
        console.log($scope.prdctDet);
    });

    $scope.select = function(spr){
        $scope.uhideVar = false;

        console.log(spr.items);
        $scope.uproduct = spr;
    };

    $scope.update = function(uproduct) {
        $scope.usuccessmsg = "";
        var prDet = {json: JSON.stringify(angular.copy(uproduct))};
        UpdateProduct.setPrDet(prDet);
        console.log(prDet);

        UpdateProduct.updatePr().then(function (dt) {
            $scope.upcode = dt.code;
            $scope.uerror = dt.error;
            console.log(dt.status);
            if (dt.status == "200") {
                $scope.usuccessmsg = "Update success with Product code " + dt.code;
            }
        });
    };

}]);
