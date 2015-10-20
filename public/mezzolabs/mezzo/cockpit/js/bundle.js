(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
'use strict';

var app = angular.module('Mezzo', ['ngRoute', 'templates', 'angular-sortable-view']);

app.config(require('./config/config'));
require('./register')(app);

},{"./config/config":4,"./register":19}],2:[function(require,module,exports){
'use strict';

exports.name = 'mezzoCompile';
exports.directive = /*@ngInject*/function ($compile) {
    return {
        restrict: 'A',
        link: link
    };

    function link(scope, element, attrs) {
        scope.$watch(attrs.mezzoCompile, function (directive) {
            if (directive) {
                var html = '<' + directive + ' >';

                element.html(html);
                $compile(element.contents())(scope);
            }
        });
    }
};

},{}],3:[function(require,module,exports){
'use strict';

exports.name = 'uid';
exports.service = function inject() {
    return uid;
};
var id = 0;

function uid() {
    return id++;
}

},{}],4:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var _routes = require('./routes');

var _routes2 = _interopRequireDefault(_routes);

var _jquery = require('./jquery');

var _jquery2 = _interopRequireDefault(_jquery);

exports['default'] = config;

/*@ngInject*/function config($locationProvider, $routeProvider) {
    $locationProvider.html5Mode(true);

    _routes2['default'].forEach(function (route) {
        $routeProvider.when(route.when, route);
    });

    $routeProvider.otherwise({
        redirectTo: '/'
    });

    (0, _jquery2['default'])();
}
module.exports = exports['default'];

},{"./jquery":5,"./routes":6}],5:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});

exports['default'] = function () {
    $('.sidebar-pin').click(function () {
        var sidebarIsPinned = $('body').hasClass('sidebar-pinned');

        if (sidebarIsPinned) {
            $('body').addClass('sidebar-unpinned').removeClass('sidebar-pinned');
            $(this).addClass('fa-circle-o').removeClass('fa-dot-circle-o');
        } else {
            $('body').addClass('sidebar-pinned').removeClass('sidebar-unpinned');
            $(this).addClass('fa-dot-circle-o').removeClass('fa-circle-o');
        }
    });

    $('#sidebar').mouseenter(function () {
        $('body').addClass('sidebar-mousein').removeClass('sidebar-mouseout');
    });

    $('#sidebar').mouseleave(function () {
        $('body').addClass('sidebar-mouseout').removeClass('sidebar-mousein');

        if ($('body').hasClass('sidebar-unpinned')) $('.nav-main .opened').removeClass('opened');
    });

    $('.nav-main > li.has-pages > a .dropdown').click(function () {
        $(this).parents('li').toggleClass('opened');
        console.log(this);
    });

    $('.trigger-quickview').click(function () {
        quickviewVisible(!quickviewIsVisible());
        return false;
    });

    $('#quickview .btn-close').click(function () {
        quickviewVisible(false);
    });

    $('#content-main, #view-overlay').click(function () {
        quickviewVisible(false);
    });

    function quickviewIsVisible() {
        return $('#quickview').hasClass('opened');
    }

    function quickviewVisible(open) {
        if (open) {
            $('#quickview').addClass('opened');
            $('#view-overlay').addClass('opened');
        } else {
            $('#quickview').removeClass('opened');
            $('#view-overlay').removeClass('opened');
        }
    }

    /**
     * Form stuff
     */
    $.fn.editable.defaults.mode = 'inline';

    $.fn.editableform.buttons = '<button type="submit" class="btn btn-primary btn-sm editable-submit">' + '<i class=ion-checkmark></i>' + '</button>' + '<button type="button" class="btn btn-default btn-sm editable-cancel">' + '<i class="ion-close"></i>' + '</button>';

    $('.editable').editable();

    $('select').select2();

    $('.nav-tabs').tab();

    $('.jstree').jstree({
        'core': {
            'themes': {
                'name': 'proton',
                'responsive': true
            }
        }
    });
};

module.exports = exports['default'];

},{}],6:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});
exports['default'] = [{
    when: '/',
    templateUrl: 'model-builder/model-builder.view.html',
    controller: 'ModelBuilderController'
}];
module.exports = exports['default'];

},{}],7:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError('Cannot call a class as a function'); } }

var Component = function Component(name, templateUrl, modifyOptions) {
    _classCallCheck(this, Component);

    this.name = name;
    this.directive = directive(templateUrl, modifyOptions);
};

exports['default'] = Component;

function directive(templateUrl, modifyOptions) {
    return (/*@ngInject*/function inject(componentService) {
            return {
                restrict: 'E',
                templateUrl: 'model-builder/components/' + templateUrl,
                link: link
            };

            function link(scope) {
                var options = componentService.options;
                scope.options = options;

                modifyOptions(options);
            }
        }
    );
}
module.exports = exports['default'];

},{}],8:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError('Cannot call a class as a function'); } }

var ComponentOptions = function ComponentOptions(name, templateUrl, controller) {
    _classCallCheck(this, ComponentOptions);

    this.name = name;
    this.directive = directive(templateUrl, controller);
};

exports['default'] = ComponentOptions;

function directive(templateUrl, controller) {
    return (/*@ngInject*/function inject(componentService) {
            return {
                restrict: 'E',
                templateUrl: 'model-builder/components/' + templateUrl,
                link: link
            };

            function link(scope) {
                componentService.onOptionsChange(function (options) {
                    scope.options = options;
                });

                if (controller) {
                    controller(scope);
                }
            }
        }
    );
}
module.exports = exports['default'];

},{}],9:[function(require,module,exports){
'use strict';

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var _ComponentOptions = require('../ComponentOptions');

var _ComponentOptions2 = _interopRequireDefault(_ComponentOptions);

module.exports = new _ComponentOptions2['default']('mezzoCheckboxOptions', 'checkbox/checkbox-options.html');

},{"../ComponentOptions":8}],10:[function(require,module,exports){
'use strict';

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var _Component = require('../Component');

var _Component2 = _interopRequireDefault(_Component);

module.exports = new _Component2['default']('mezzoCheckbox', 'checkbox/checkbox.html', modifyOptions);

function modifyOptions(options) {
    options.label = 'Label';
}

},{"../Component":7}],11:[function(require,module,exports){
'use strict';

var _createClass = (function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ('value' in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; })();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError('Cannot call a class as a function'); } }

exports.name = 'componentService';
exports.service = function inject() {
    return new ComponentService();
};

var ComponentService = (function () {
    function ComponentService() {
        _classCallCheck(this, ComponentService);

        this.options = null;
        this.eventListeners = [];
    }

    _createClass(ComponentService, [{
        key: 'setOptions',
        value: function setOptions(options) {
            this.options = options;

            this.eventListeners.forEach(function (eventListener) {
                eventListener(options);
            });
        }
    }, {
        key: 'onOptionsChange',
        value: function onOptionsChange(eventListener) {
            eventListener(this.options);
            this.eventListeners.push(eventListener);
        }
    }]);

    return ComponentService;
})();

},{}],12:[function(require,module,exports){
'use strict';

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var _ComponentOptions = require('../ComponentOptions');

var _ComponentOptions2 = _interopRequireDefault(_ComponentOptions);

module.exports = new _ComponentOptions2['default']('mezzoDropdownOptions', 'dropdown/dropdown-options.html', controller);

function controller(scope) {
    scope.addItem = function (label, value) {
        var item = { label: label, value: value };

        scope.options.items.push(item);
    };

    scope.removeItem = function (index) {
        scope.options.items.splice(index, 1);
    };
}

},{"../ComponentOptions":8}],13:[function(require,module,exports){
'use strict';

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var _Component = require('../Component');

var _Component2 = _interopRequireDefault(_Component);

module.exports = new _Component2['default']('mezzoDropdown', 'dropdown/dropdown.html', modifyOptions);

function modifyOptions(options) {
    options.label = 'Label';
    options.items = [];
    options.multiple = false;
}

},{"../Component":7}],14:[function(require,module,exports){
'use strict';

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var _ComponentOptions = require('../ComponentOptions');

var _ComponentOptions2 = _interopRequireDefault(_ComponentOptions);

module.exports = new _ComponentOptions2['default']('mezzoTextMultiOptions', 'text-multi/text-multi-options.html');

},{"../ComponentOptions":8}],15:[function(require,module,exports){
'use strict';

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var _Component = require('../Component');

var _Component2 = _interopRequireDefault(_Component);

module.exports = new _Component2['default']('mezzoTextMulti', 'text-multi/text-multi.html', modifyOptions);

function modifyOptions(options) {
    options.label = 'Label';
    options.placeholder = 'Placeholder';
}

},{"../Component":7}],16:[function(require,module,exports){
'use strict';

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var _ComponentOptions = require('../ComponentOptions');

var _ComponentOptions2 = _interopRequireDefault(_ComponentOptions);

module.exports = new _ComponentOptions2['default']('mezzoTextSingleOptions', 'text-single/text-single-options.html');

},{"../ComponentOptions":8}],17:[function(require,module,exports){
'use strict';

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var _Component = require('../Component');

var _Component2 = _interopRequireDefault(_Component);

module.exports = new _Component2['default']('mezzoTextSingle', 'text-single/text-single.html', modifyOptions);

function modifyOptions(options) {
    options.label = 'Label';
    options.placeholder = 'Placeholder';
}

},{"../Component":7}],18:[function(require,module,exports){
'use strict';

exports.name = 'ModelBuilderController';
exports.controller = /*@ngInject*/function ModelBuilderController($scope, componentService, uid) {

    $scope.tab = 'add';
    $scope.fields = [];
    $scope.selectedField = null;

    $scope.showTab = showTab;
    $scope.addField = addField;
    $scope.selectField = selectField;
    $scope.deleteField = deleteField;

    function showTab(tab, $event) {
        if ($event) {
            $event.preventDefault();
        }

        if (tab === 'edit' && !$scope.selectedField) return;

        $scope.tab = tab;

        $('tab-heading-' + tab).tab('show');

        if (tab === 'add') {
            $scope.selectedField = null;
        }
    }

    function addField(name) {
        var field = {
            id: uid(),
            name: name,
            options: {},
            mainDirective: 'mezzo-' + name,
            optionsDirective: 'mezzo-' + name + '-options'
        };

        componentService.setOptions(field.options);
        $scope.fields.push(field);
    }

    function selectField(field) {
        $scope.selectedField = field;

        componentService.setOptions(field.options);
        showTab('edit');
    }

    function unselect() {
        $scope.selectedField = null;

        showTab('add');
    }

    function deleteField(field) {
        unselect();
        _.remove($scope.fields, field);
    }
};

},{}],19:[function(require,module,exports){
'use strict';

module.exports = function (app) {
				register(require('./common/compile.directive.js'));
				register(require('./common/uid.service.js'));
				register(require('./model-builder/model-builder.controller.js'));
				register(require('./model-builder/components/component.service.js'));
				register(require('./model-builder/components/checkbox/checkbox-options.directive.js'));
				register(require('./model-builder/components/checkbox/checkbox.directive.js'));
				register(require('./model-builder/components/text-multi/text-multi-options.directive.js'));
				register(require('./model-builder/components/text-multi/text-multi.directive.js'));
				register(require('./model-builder/components/text-single/text-single-options.directive.js'));
				register(require('./model-builder/components/text-single/text-single.directive.js'));
				register(require('./model-builder/components/dropdown/dropdown-options.directive.js'));
				register(require('./model-builder/components/dropdown/dropdown.directive.js'));

				function register(module) {
								if (module.controller) {
												return app.controller(module.name, module.controller);
								}

								if (module.directive) {
												return app.directive(module.name, module.directive);
								}

								if (module.service) {
												return app.factory(module.name, module.service);
								}
				}
};

},{"./common/compile.directive.js":2,"./common/uid.service.js":3,"./model-builder/components/checkbox/checkbox-options.directive.js":9,"./model-builder/components/checkbox/checkbox.directive.js":10,"./model-builder/components/component.service.js":11,"./model-builder/components/dropdown/dropdown-options.directive.js":12,"./model-builder/components/dropdown/dropdown.directive.js":13,"./model-builder/components/text-multi/text-multi-options.directive.js":14,"./model-builder/components/text-multi/text-multi.directive.js":15,"./model-builder/components/text-single/text-single-options.directive.js":16,"./model-builder/components/text-single/text-single.directive.js":17,"./model-builder/model-builder.controller.js":18}]},{},[1]);
