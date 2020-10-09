'use strict';

app.service('homeService', function($http){
    return{
        getImgs: function(){
            var promise = $http({
                method: 'GET',
                url: '../app/webservices/allProductDetails.php'
            }).then(function (response) {
                var data = response.data;
                console.log(data);
                return data;
            });
            return promise;
        }
    };
});