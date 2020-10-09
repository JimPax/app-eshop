'use strict';

var app = angular.module('myApp' , ['ngRoute','ui.bootstrap', 'ngFileUpload']);

app.config(function($routeProvider) {
    $routeProvider.
        when('/',{
        templateUrl: 'views/home.html',
        controller: 'homeCtrl'
    }).
    when('/product-list',{
        templateUrl: 'views/products-list.html',
        controller: 'PLCtrl'
    }).
    when('/product-details/:productDet',{
            templateUrl: 'views/product-details.html',
            controller: 'PDCtrl'
    }).
    when('/admin-panel',{
            templateUrl: 'views/admin-panel.html',
            controller: 'insertPCtrl'
    }).
    when('/register',{
            templateUrl: 'views/register.html',
            controller: 'registerCtrl'
    }).
    when('/login',{
        templateUrl: 'views/login.html',
        controller: 'loginCtrl'
    }).
    when('/cart',{
        templateUrl: 'views/cart.html',
        controller: 'cartCtrl'
    }).
    when('/order', {
        templateUrl: 'views/order.html',
        controller: 'orderCtrl'
    }).
    otherwise({
        redirectTo:'/'
    });
});

//remove acces to admin panel without authentication
app.run(function($rootScope, $location, login){
    var routespermission=['/admin-panel']; //route that require login
    $rootScope.$on('$routeChangeStart',function(){
        if( routespermission.indexOf($location.path()) !=-1)
        {
            var connected=login.islogged();
            connected.then(function(msg){
                console.log(msg.data);
                if(msg.data != "admin"){
                    console.log(msg.data);
                    $location.path('/login');
                }
            });
        }
    });
});