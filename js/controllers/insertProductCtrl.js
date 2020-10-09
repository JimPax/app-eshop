'use strict';

app.controller('insertPCtrl',['$scope', '$location',  'InsertProduct', 'sessionService', function($scope, $location, InsertProduct, sessionService) {

    $scope.files = [];
    $scope.hideVar=true;

    $scope.insert = function(product) {
        $scope.successmsg = "";
        var prDet = {json: JSON.stringify(angular.copy(product))};
        InsertProduct.setPrDet(prDet);
        console.log(prDet);

        InsertProduct.insertPr().then(function (dt) {
            $scope.pcode = dt.code;
            $scope.error = dt.error;
            $scope.status = dt.status;
            console.log($scope.status);
            if ($scope.status == "200") {
                $scope.successmsg = "Insert success with Product code " + dt.code;
                $scope.hideVar = false;
            }
            //intial scopes after insert
            $scope.succAddImgmsg = ""; //initial upload img msg aftre insert(uploadFiles())
            $scope.files = [];  //initial upload files after insert(uploadFiles())
        });
    };
    //upload files
    $scope.uploadFiles = function (files) {
        $scope.succAddImgmsg = "";
        $scope.files = files;

        InsertProduct.uploadImgs(files).then(function(fd){
            $scope.succAddImgmsg = fd.success;
            $scope.hideVar = true;      //hide after upload
            $scope.successmsg = "";     // initial insert product success msg after upload(inserPr())
            //intial scopes after upload img
            $scope.product.name = "";
            $scope.product.description = "";
            $scope.product.price = "";
            $scope.product.items = "";
        });
    };

    $scope.logout=function(){
        sessionService.destroy('login');
        $location.path('/login');
        window.location.reload();
    }

}]);
