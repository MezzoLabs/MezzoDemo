class TestMainController {

    /*@ngInject*/ constructor($http){
        $http.get('/api/tutorials', {
            headers: {
                Accept: 'application/vnd.MezzoLabs.v1+json'
            }
        }).success(data => {
            console.log(data);
        }).error(err => {
            console.error(err);
        });
    }

}

export default { name: 'TestMainController', controller: TestMainController };