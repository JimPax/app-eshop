'use strict';

app.controller('PDCtrl',['ProductDetails', 'Cart', '$scope', '$location', '$routeParams', function(ProductDetails, Cart, $scope, $location, $routeParams) {


    var prName = {json: '{"code":'+JSON.stringify(angular.copy($routeParams.productDet))+'}'};
    console.log(prName);
    ProductDetails.setCode(prName);

    ProductDetails.getDetInp().then(function(d){
        $scope.myData = d;
        console.log($scope.myData);
        console.log(d[0].items);
        if (d[0].items > 0){
            $scope.availability = true;
        }
        else{
            $scope.availability = false;
        }
    });

    ProductDetails.getSlidesInp().then(function(d){
        console.log("cyyka");
        $scope.slides = d;
        console.log($scope.slides);
    });

    $scope.addcart = function () {
        ProductDetails.getDetInp().then(function(d) {
            var pset = {json: '{"code":'+JSON.stringify(angular.copy(d[0].code))+', "quant":'+JSON.stringify(angular.copy("1"))+'}'};
            Cart.setToCart(pset);
        });
        setTimeout(function() {
            Cart.addToCart().then(function(d){
                console.log("asdasdasdasd");
                console.log(d);
                $scope.plft = d.plft;
                if (!$scope.plft){
                    $location.path('/cart');
                }
            });
        },200);
    };


    $scope.myInterval = 3000;
    $scope.activeSlide = 0;
    $scope.noWrapSlides = false;
}]);

