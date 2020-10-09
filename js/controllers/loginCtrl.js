app.controller('loginCtrl',['$scope', '$location', '$window', 'login', 'sessionService', function($scope, $location, $window, login, sessionService) {
    $scope.ulgnoff = true;
    $scope.algn = true;

    $scope.login = function (logind) {
        $scope.success = "";
        $scope.error = "";

        var loginD = {json: JSON.stringify(angular.copy(logind))};

        login.setLoginData(loginD);
        console.log(loginD);

        login.insertLoginData().then(function (d) {
            if (d.session){
                sessionService.set('login',d.session);
                if (d.session == "admin"){
                    $window.location.href = '#!/admin-panel';
                    window.location.reload();
                }
                else {
                    $window.location.href = '#!/home';
                    window.location.reload();
                }
            }
            else {
                $scope.error = d.error;
                console.log(d.error);
            }
        });
    };
    if (sessionService.get('login')){
        if(sessionService.get('login') != "admin"){
            $scope.ulgnon = true;
            $scope.ulgnoff = false;
        }
        else{
            $scope.algn = false;
        }
    }
    $scope.logout=function(){
        sessionService.destroy('login');
        $window.location.href = '#!/login';
        window.location.reload();
    }

}]);