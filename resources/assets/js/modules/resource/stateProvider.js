/*@ngInject*/
export default function stateProvider($stateProvider){
    this.$get = $get;

    function $get(){
        return $stateProvider;
    }
}