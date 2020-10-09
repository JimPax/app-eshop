'use strict';

app.factory('InsertProduct',function($http, $httpParamSerializerJQLike,Upload){
    var product = {};
    return {
        setPrDet:function(pdet){
            product = pdet;
            console.log("insertSet:");
            console.log(product);
        },
        insertPr:function(){
            var promises = $http({
                method: 'POST',
                url: 'webservices/insertProduct.php',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data: $httpParamSerializerJQLike(product)
            }).then(function(response) {
                var d = response.data;
                console.log(d);
                return d;
            });
            return promises;
        },
        uploadImgs:function(files){
            if (files && files.length) {
                var promises = Upload.upload({
                    url: 'webservices/uploadimgs.php',
                    data: {
                        files: files
                    }
                }).then(function (response) {
                    var d = response.data;
                    console.log(d);
                    return d;
                });
                return promises;
            }

        }

    };

});
