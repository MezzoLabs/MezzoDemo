import State from '../../common/State';

export default new State('pages', 'pages', {
    aside: {
        templateUrl: 'modules/pages/aside.html',
        controller: 'PagesAsideController'
    },
    main: {
        templateUrl: 'modules/pages/main.html',
        controller: 'PagesMainController'
    }
});