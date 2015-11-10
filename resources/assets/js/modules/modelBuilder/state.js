import State from '../../common/State';

export default new State('models', 'models', {
    aside: {
        templateUrl: 'modules/model-builder/aside.html',
        controller: 'ModelBuilderController as vm'
    },
    main: {
        templateUrl: 'modules/model-builder/main.html',
        controller: 'ModelBuilderController as vm'
    }
});