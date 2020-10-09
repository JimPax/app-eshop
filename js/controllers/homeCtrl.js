'use strict';

app.controller('homeCtrl',function(order, $scope, homeService){

    homeService.getImgs().then(function (d) {

        $scope.prDet = d;
        console.log(d);
    });
});