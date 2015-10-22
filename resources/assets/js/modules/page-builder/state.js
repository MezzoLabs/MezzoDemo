import State from '../../common/State';

export default new State('pages', 'pages', {
    aside: {
        templateUrl: 'modules/page-builder/aside.html',
        controller: 'PagesAsideController'
    },
    main: {
        templateUrl: 'modules/page-builder/main.html',
        controller: 'PagesMainController'
    }
});