export default app => {
    app.provider('$stateProvider', /*@ngInject*/ function ($stateProvider) {
        this.$get = () => $stateProvider;
    });
};