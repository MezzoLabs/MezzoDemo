export default app =>
{
    app.provider('addState', /*@ngInject*/ function ($stateProvider) {
        this.$get = () =
        >
        addState;

        function addState(state) {
            $stateProvider.state(state.name, state.route);
        }
    });
}
;