export default class HttpRequestTrackerService{
    constructor($rootScope){
        this.busy = false;

        $rootScope.$on('http:loading:progress', () => {
            this.setBusy(true);
        });

        $rootScope.$on('http:loading:finish', () => {
            this.setBusy(false);
        });
    }

    setBusy(isBusy){
        this.busy = isBusy;
    }

    isBusy(){
        return this.busy;
    }
}