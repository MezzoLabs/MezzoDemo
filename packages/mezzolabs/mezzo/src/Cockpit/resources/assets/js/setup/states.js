export default [
    {
        name: 'pages',
        route: {
            url: '/cockpit/pages',
            views: {
                aside: {
                    templateUrl: 'modules/pages/aside.html',
                    controller: 'PagesAsideController'
                },
                main: {
                    templateUrl: 'modules/pages/main.html',
                    controller: 'PagesMainController'
                }
            }
        }
    }, {
        name: 'models',
        route: {
            url: '/cockpit/models',
            views: {
                aside: {
                    templateUrl: 'modules/model-builder/aside.html',
                    controller: 'ModelBuilderController as vm'
                },
                main: {
                    templateUrl: 'modules/model-builder/main.html',
                    controller: 'ModelBuilderController as vm'
                }
            }
        }
    }, {
        name: 'panels',
        route: {
            url: '/cockpit/panels',
            views: {
                main: {
                    templateUrl: 'modules/panels/panels.html'
                }
            }
        }
    }, {
        name: 'files',
        route: {
            url: '/cockpit/files',
            views: {
                aside: {
                    templateUrl: 'modules/files/aside.html',
                    controller: 'FilesAsideController as vm'
                },
                main: {
                    templateUrl: 'modules/files/main.html',
                    controller: 'FilesMainController as vm'
                }
            }
        }
    }
];