'use strict';

app.controller('cartCtrl',['Cart', 'sessionService', 'order', '$scope', '$window', function(Cart, sessionService, order, $scope, $window) {

    Cart.displayCart().then(function(d){
        $scope.prDet = d;
        $scope.fprice = d.tprice;
    });

    $scope.rmvQuant = function(code){
        var rmv = {json: '{"code":'+JSON.stringify(angular.copy(code))+', "flag":'+JSON.stringify(angular.copy("rmv"))+'}'};
        Cart.changeQuantity(rmv).then(function(){
            location.reload();
        });
    };

    $scope.addQuant = function(code){
        var add = {json: '{"code":'+JSON.stringify(angular.copy(code))+', "flag":'+JSON.stringify(angular.copy("add"))+'}'};
        Cart.changeQuantity(add).then(function(d){
            if(d.msg) {
                $scope.msg = d.msg;
            }
            else {
                location.reload();
            }
        });
    };

    $scope.removeItem = function(code){
        var pcode = {json: '{"code":'+JSON.stringify(angular.copy(code))+'}'};
        console.log("test");
        console.log(code);
        Cart.deleteItem(pcode).then(function(){
            location.reload();
        });
    };

    if(sessionService.get('login')){
        $scope.cflag = true;
        $scope.sflag = false;
    }else{
        $scope.cflag = false;
        $scope.sflag = true;
    }

    var oflag = false;
    $scope.toCheckout = function(){
        oflag = true;
        order.setFlag(oflag);
        $window.location.href = '#!/order';
    };
}]);