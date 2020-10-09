app.controller('registerCtrl',['$scope', 'register', function($scope, register) {

    $scope.insert = function (userd) {
        var userD = {json: JSON.stringify(angular.copy(userd))};

        register.setUserData(userD);
        console.log(userD);

        register.insertUserData().then(function (d) {
            $scope.username = d.usern;
            $scope.success = d.success;
            $scope.error = d.error;
            console.log($scope.username);
        });
    };
}]);