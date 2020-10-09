'use strict';

app.controller('deletePCtrl', function($scope, DeleteProduct) {
    DeleteProduct.getDetails().then(function(d){
        $scope.prDet = d;
        console.log($scope.prDet);
    });


    $scope.delete = function(spr){
        console.log(spr.code);
        var pc = {code: spr.code};
        var prCode = {json: JSON.stringify(angular.copy(pc))};
        DeleteProduct.setCode(prCode);

        DeleteProduct.deletePr().then(function (d){
            $scope.dltmsg = d;
            console.log($scope.dltmsg);
        });

        DeleteProduct.getDetails().then(function(d) {
            $scope.prDet = d;
            console.log($scope.prDet);
        });
    };
});
