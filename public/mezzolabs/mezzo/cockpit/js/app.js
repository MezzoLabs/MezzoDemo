(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
'use strict';

require('./setup/jquery');

require('./common');

require('./modules/resource');

require('./modules/fileManager');

require('./modules/contentBlocks');

require('./modules/googleMaps');

var _config = require('./setup/config');

var _config2 = _interopRequireDefault(_config);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var app = angular.module('Mezzo', ['ui.router', 'ui.sortable', 'ngMessages', 'angular-sortable-view', 'angular-loading-bar', 'ngFileUpload', 'MezzoCommon', 'MezzoResources', 'MezzoFileManager', 'MezzoContentBlocks', 'MezzoGoogleMaps']);

app.config(_config2.default);

}, {
    "./common": 15,
    "./modules/contentBlocks": 23,
    "./modules/fileManager": 34,
    "./modules/googleMaps": 35,
    "./modules/resource": 46,
    "./setup/config": 49,
    "./setup/jquery": 50
}], 2: [function (require, module, exports) {
"use strict";

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

Object.defineProperty(exports, "__esModule", {
    value: true
});

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var QuickviewService = function () {
    function QuickviewService() {
        _classCallCheck(this, QuickviewService);

        this.open = false;
    }

    _createClass(QuickviewService, [{
        key: "toggle",
        value: function toggle() {
            this.open = !open;
        }
    }]);

    return QuickviewService;
}();

exports.default = QuickviewService;

},{}],3:[function(require,module,exports){
"use strict";

Object.defineProperty(exports, "__esModule", {
    value: true
});

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var RelationInputController =

/*@ngInject*/
function RelationInputController(api) {
    var _this = this;

    _classCallCheck(this, RelationInputController);

    this.api = api;
    this.modelApi = this.api.model(this.related);
    this.model = null;
    this.models = [];
    var params = {
        scopes: this.scopes
    };

    this.modelApi.index(params).then(function (models) {
        _this.models = models;
    });
};

exports.default = RelationInputController;

},{}],4:[function(require,module,exports){
'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _ModelApi = require('./ModelApi');

var _ModelApi2 = _interopRequireDefault(_ModelApi);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var Api = function () {
    function Api($http) {
        _classCallCheck(this, Api);

        this.$http = $http;
    }

    _createClass(Api, [{
        key: 'get',
        value: function get(url) {
            var params = arguments.length <= 1 || arguments[1] === undefined ? {} : arguments[1];

            var config = {
                params: params
            };

            return this.apiPromise(this.$http.get(url, config));
        }
    }, {
        key: 'post',
        value: function post(url, data) {
            return this.apiPromise(this.$http.post(url, data));
        }
    }, {
        key: 'put',
        value: function put(url, data) {
            return this.apiPromise(this.$http.put(url, data));
        }
    }, {
        key: 'delete',
        value: function _delete(url) {
            return this.apiPromise(this.$http.delete(url));
        }
    }, {
        key: 'model',
        value: function model(modelName) {
            return new _ModelApi2.default(this, modelName);
        }
    }, {
        key: 'apiPromise',
        value: function apiPromise($httpPromise) {
            var _this = this;

            return $httpPromise.then(function (response) {
                return response.data.data;
            }).catch(function (err) {
                console.error(err);
                _this.showUnexpectedErrorMessage(JSON.stringify(err));
                throw err;
            });
        }
    }, {
        key: 'files',
        value: function files() {
            return this.get('/api/files');
        }
    }, {
        key: 'moveFile',
        value: function moveFile(file, folderPath) {
            var payload = {
                folder: folderPath
            };

            return this.put('/api/files/' + file.id, payload);
        }
    }, {
        key: 'deleteFile',
        value: function deleteFile(file) {
            return this.delete('/api/files/' + file.id);
        }
    }, {
        key: 'contentBlockTemplate',
        value: function contentBlockTemplate(hash) {
            return this.$http.get('/mezzo/content-block-types/' + hash + '.html').then(function (response) {
                return response.data;
            }).catch(function (err) {
                console.error(err);
                throw err;
            });
        }
    }, {
        key: 'showUnexpectedErrorMessage',
        value: function showUnexpectedErrorMessage(message) {
            sweetAlert('Oops, something spilled...', message, 'error');
        }
    }]);

    return Api;
}();

exports.default = Api;

},{"./ModelApi":5}],5:[function(require,module,exports){
'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

Object.defineProperty(exports, "__esModule", {
    value: true
});

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var ModelApi = function () {
    function ModelApi(api, modelName) {
        _classCallCheck(this, ModelApi);

        this.api = api;
        this.modelName = modelName;
        this.modelPlural = _.kebabCase(pluralize(this.modelName));
        this.apiUrl = '/api/' + this.modelPlural;
    }

    _createClass(ModelApi, [{
        key: 'index',
        value: function index() {
            var params = arguments.length <= 0 || arguments[0] === undefined ? {} : arguments[0];

            return this.api.get(this.apiUrl, params);
        }
    }, {
        key: 'create',
        value: function create(formData) {
            return this.api.post(this.apiUrl, formData);
        }
    }, {
        key: 'update',
        value: function update(modelId, formData) {
            return this.api.put(this.apiUrl + '/' + modelId, formData);
        }
    }, {
        key: 'delete',
        value: function _delete(modelId) {
            return this.api.delete(this.apiUrl + '/' + modelId);
        }
    }, {
        key: 'content',
        value: function content(modelId) {
            var params = arguments.length <= 1 || arguments[1] === undefined ? {} : arguments[1];

            return this.api.get(this.apiUrl + '/' + modelId, params);
        }
    }, {
        key: 'lock',
        value: function lock(modelId) {
            return this.api.get(this.apiUrl + '/' + modelId + '/lock');
        }
    }, {
        key: 'unlock',
        value: function unlock(modelId) {
            return this.api.get(this.apiUrl + '/' + modelId + '/unlock');
        }
    }]);

    return ModelApi;
}();

exports.default = ModelApi;

},{}],6:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = apiService;

var _Api = require('./Api');

var _Api2 = _interopRequireDefault(_Api);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

/*@ngInject*/
function apiService($http) {
    return new _Api2.default($http);
}

},{"./Api":4}],7:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
    exports.default = assignNgModelDirective;
    /*@ngInject*/
    function assignNgModelDirective($compile) {
        return {
            restrict: 'A',
            link: link
        };

        function link(scope, element, attributes) {
            $(element).find(':input').each(function (index, formInput) {
                var nameAttribute = $(formInput).attr('name');

                if (!nameAttribute) {
                    return;
                }

                var valueBeforeCompile = $(formInput).val();

                $(formInput).attr('ng-model', 'vm.form[\'' + nameAttribute + '\']');
                $compile(formInput)(scope);

                scope.vm.form[nameAttribute] = valueBeforeCompile;
            });
        }
    }

}, {}], 8: [function (require, module, exports) {
    'use strict';

    Object.defineProperty(exports, "__esModule", {
        value: true
    });
exports.default = compileDirective;
/*@ngInject*/
function compileDirective() {
    return {
        restrict: 'A',
        link: link
    };

    function link(scope, element, attributes) {
        scope.$watch(attributes.mezzoCompile, function (directive) {
            if (directive) {
                var html = '<' + directive + ' >';

                element.html(html);
                $compile(element.contents())(scope);
            }
        });
    }
};

}, {}], 9: [function (require, module, exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = compileHtmlDirective;
/*@ngInject*/
function compileHtmlDirective($parse, $compile) {
    return {
        restrict: 'A',
        link: link
    };

    function link(scope, element, attributes) {
        var expression = attributes.mezzoCompileHtml;
        var getter = $parse(expression);

        scope.$watch(getter, function (html) {
            if (!html) {
                return;
            }

            element.html(html);
            $compile(element.contents())(scope);
        });
    }
}

}, {}], 10: [function (require, module, exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = dateTimePickerDirective;
/*@ngInject*/
function dateTimePickerDirective() {
    return {
        restrict: 'A',
        link: link
    };

    function link(scope, element, attributes) {
        var options = {
            format: 'DD.MM.YYYY HH:mm',
            showTodayButton: true,
            showClose: true,
            calendarWeeks: true,
            locale: 'de',
            icons: {
                time: 'fa fa-clock-o',
                date: 'fa fa-calendar-o',
                up: 'fa fa-chevron-up',
                down: 'fa fa-chevron-down',
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-next',
                today: 'fa fa-crosshairs',
                clear: 'fa fa-trash-o',
                close: 'fa fa-times-circle-o'
            }
        };

        $(element).datetimepicker(options);
    }
}

}, {}], 11: [function (require, module, exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = enterDirective;
/*@ngInject*/
function enterDirective() {
    return {
        restrict: 'A',
        link: link
    };

    function link(scope, element, attributes) {
        element.bind('keypress', function (event) {
            if (event.which === 13) {
                scope.$eval(attributes.mezzoEnter);
                scope.$apply();
            }
        });
    }
}

}, {}], 12: [function (require, module, exports) {
"use strict";

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = hasControllerService;
/*@ngInject*/
function hasControllerService($controller) {
    return hasController;

    function hasController(controllerName) {
        try {
            $controller(controllerName);

            return true;
        } catch (err) {
            return !(err instanceof TypeError);
        }
    }
}

}, {}], 13: [function (require, module, exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = hrefPreventDirective;
/*@ngInject*/
function hrefPreventDirective() {
    return {
        restrict: 'A',
        link: link
    };

    function link(scope, element, attributes) {
        $(element).click(function ($event) {
            $event.preventDefault();
        });
    }
}

}, {}], 14: [function (require, module, exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = hrefReloadDirective;
/*@ngInject*/
function hrefReloadDirective() {
    return {
        restrict: 'A',
        link: link
    };

    function link(scope, element, attributes) {
        var shouldReload = attributes.mezzoHrefReload === '1';

        if (!shouldReload) {
            return;
        }

        var $element = $(element);

        $element.click(function ($event) {
            $event.preventDefault();
            onHrefClick($element);
        });
    }

    function onHrefClick($element) {
        var href = $element.attr('href');

        if (!href) {
            return;
        }

        window.location.href = href;
    }
}

}, {}], 15: [function (require, module, exports) {
'use strict';

var _compileDirective = require('./compileDirective');

var _compileDirective2 = _interopRequireDefault(_compileDirective);

var _compileHtmlDirective = require('./compileHtmlDirective');

var _compileHtmlDirective2 = _interopRequireDefault(_compileHtmlDirective);

var _enterDirective = require('./enterDirective.js');

var _enterDirective2 = _interopRequireDefault(_enterDirective);

var _relationInputDirective = require('./relationInputDirective');

var _relationInputDirective2 = _interopRequireDefault(_relationInputDirective);

var _hrefReloadDirective = require('./hrefReloadDirective');

var _hrefReloadDirective2 = _interopRequireDefault(_hrefReloadDirective);

var _hrefPreventDirective = require('./hrefPreventDirective');

var _hrefPreventDirective2 = _interopRequireDefault(_hrefPreventDirective);

var _tinymceDirective = require('./tinymceDirective');

var _tinymceDirective2 = _interopRequireDefault(_tinymceDirective);

var _select2Directive = require('./select2Directive');

var _select2Directive2 = _interopRequireDefault(_select2Directive);

var _dateTimePickerDirective = require('./dateTimePickerDirective');

var _dateTimePickerDirective2 = _interopRequireDefault(_dateTimePickerDirective);

var _quickviewDirective = require('./quickviewDirective');

var _quickviewDirective2 = _interopRequireDefault(_quickviewDirective);

var _quickviewCloseDirective = require('./quickviewCloseDirective');

var _quickviewCloseDirective2 = _interopRequireDefault(_quickviewCloseDirective);

    var _assignNgModelDirective = require('./assignNgModelDirective');

    var _assignNgModelDirective2 = _interopRequireDefault(_assignNgModelDirective);

var _uidService = require('./uidService.js');

var _uidService2 = _interopRequireDefault(_uidService);

var _apiService = require('./api/apiService');

var _apiService2 = _interopRequireDefault(_apiService);

var _hasControllerService = require('./hasControllerService');

var _hasControllerService2 = _interopRequireDefault(_hasControllerService);

var _QuickviewService = require('./QuickviewService');

var _QuickviewService2 = _interopRequireDefault(_QuickviewService);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var _module = angular.module('MezzoCommon', []);

_module.directive('mezzoCompile', _compileDirective2.default);
_module.directive('mezzoCompileHtml', _compileHtmlDirective2.default);
_module.directive('mezzoEnter', _enterDirective2.default);
_module.directive('mezzoRelationInput', _relationInputDirective2.default);
_module.directive('mezzoHrefReload', _hrefReloadDirective2.default);
_module.directive('mezzoHrefPrevent', _hrefPreventDirective2.default);
_module.directive('mezzoSelect2', _select2Directive2.default);
_module.directive('mezzoRichtext', _tinymceDirective2.default);
_module.directive('mezzoDatetimepicker', _dateTimePickerDirective2.default);
_module.directive('mezzoQuickview', _quickviewDirective2.default);
_module.directive('mezzoQuickviewClose', _quickviewCloseDirective2.default);
    _module.directive('mezzoAssignNgModel', _assignNgModelDirective2.default);
_module.factory('uid', _uidService2.default);
_module.factory('api', _apiService2.default);
_module.factory('hasController', _hasControllerService2.default);
_module.service('quickviewService', _QuickviewService2.default);

}, {
    "./QuickviewService": 2,
    "./api/apiService": 6,
    "./assignNgModelDirective": 7,
    "./compileDirective": 8,
    "./compileHtmlDirective": 9,
    "./dateTimePickerDirective": 10,
    "./enterDirective.js": 11,
    "./hasControllerService": 12,
    "./hrefPreventDirective": 13,
    "./hrefReloadDirective": 14,
    "./quickviewCloseDirective": 16,
    "./quickviewDirective": 17,
    "./relationInputDirective": 18,
    "./select2Directive": 19,
    "./tinymceDirective": 20,
    "./uidService.js": 21
}], 16: [function (require, module, exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = quickviewCloseDirective;
/*@ngInject*/
function quickviewCloseDirective(quickviewService) {
    return {
        restrict: 'A',
        link: link
    };

    function link(scope, element, attributes) {
        $(element).click(function () {
            quickviewService.open = false;

            scope.$apply();
        });
    }
}

}, {}], 17: [function (require, module, exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = quickviewDirective;
/*@ngInject*/
function quickviewDirective(quickviewService) {
    return {
        restrict: 'A',
        link: link
    };

    function link(scope, element, attributes) {
        scope.$watch(function () {
            return quickviewService.open;
        }, function (isOpen, wasOpen) {
            if (isOpen === wasOpen) {
                return;
            }

            if (isOpen) {
                return $(element).addClass('opened');
            }

            return $(element).removeClass('opened');
        });
    }
}

}, {}], 18: [function (require, module, exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = relationInputDirective;

var _RelationInputController = require('./RelationInputController');

var _RelationInputController2 = _interopRequireDefault(_RelationInputController);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

/*@ngInject*/
function relationInputDirective() {
    return {
        restrict: 'E',
        templateUrl: '/mezzolabs/mezzo/cockpit/templates/relationInputDirective.html',
        replace: true,
        scope: {
            related: '@',
            scopes: '@'
        },
        controller: _RelationInputController2.default,
        controllerAs: 'vm',
        bindToController: true
    };
}

}, {"./RelationInputController": 3}], 19: [function (require, module, exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = select2Directive;
/*@ngInject*/
function select2Directive() {
    return {
        restrict: 'A',
        link: link
    };

    function link(scope, element, attributes) {
        $(element).select2();
    }
}

}, {}], 20: [function (require, module, exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = tinymceDirective;
/*@ngInject*/
function tinymceDirective() {
    return {
        restrict: 'A',
        link: link
    };

    function link(scope, element, attributes) {
        var elementId = 'tinymce_textarea-' + parseInt(Math.random() * 999);
        $(element).addClass('tinymce_textarea ' + elementId);
        $(element).attr('id', elementId);

        tinyMCE.init({
            plugins: ["link"],
            selector: '.' + elementId,
            toolbar: "undo redo | bold italic underline | link",
            menubar: "",
            elementpath: false
        });
    }
}

}, {}], 21: [function (require, module, exports) {
"use strict";

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = uidService;
var id = 0;

/*@ngInject*/
function uidService() {
    return nextUid;
}

function nextUid() {
    return id++;
}

}, {}], 22: [function (require, module, exports) {
'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = registerContentBlockFactory;

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

/*@ngInject*/
function registerContentBlockFactory(api) {
    return function contentBlockFactory() {
        return new ContentBlockService(api);
    };
}

var ContentBlockService = function () {
    function ContentBlockService(api) {
        _classCallCheck(this, ContentBlockService);

        this.api = api;
        this.contentBlocks = [];
        this.templates = {};
        this.sortableOptions = {
            handle: 'a .ion-arrow-move',
            start: function start(e, ui) {
                $(ui.item).parent().find('.tinymce_textarea').each(function () {
                    $(this).css('opacity', 0.05);
                    tinymce.execCommand('mceRemoveEditor', false, $(this).attr('id'));
                });
            },
            stop: function stop(e, ui) {
                $(ui.item).parent().find('.tinymce_textarea').each(function () {
                    $(this).css('opacity', 1.0);
                    tinymce.execCommand('mceAddEditor', true, $(this).attr('id'));
                });
            }
        };
        this.currentId = 0;
    }

    _createClass(ContentBlockService, [{
        key: 'addContentBlock',
        value: function addContentBlock(key, hash, title) {
            var id = arguments.length <= 3 || arguments[3] === undefined ? '' : arguments[3];

            var contentBlock = {
                id: id,
                key: key,
                cssClass: 'block__' + key.replace(/\\/g, '_'),
                hash: hash,
                title: title,
                nameInForm: 'num' + this.currentId++,
                template: null
            };

            this.fillTemplate(contentBlock);
            this.contentBlocks.push(contentBlock);
        }
    }, {
        key: 'removeContentBlock',
        value: function removeContentBlock(index) {
            this.contentBlocks.splice(index, 1);
        }
    }, {
        key: 'fillTemplate',
        value: function fillTemplate(contentBlock) {
            var _this = this;

            var cachedTemplate = this.templates[contentBlock.hash];

            if (cachedTemplate) {
                return contentBlock.template = cachedTemplate;
            }

            this.api.contentBlockTemplate(contentBlock.hash).then(function (template) {
                contentBlock.template = template;
                _this.templates[contentBlock.hash] = template;
            });
        }
    }]);

    return ContentBlockService;
}();

}, {}], 23: [function (require, module, exports) {
'use strict';

var _contentBlockFactory = require('./contentBlockFactory');

var _contentBlockFactory2 = _interopRequireDefault(_contentBlockFactory);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var _module = angular.module('MezzoContentBlocks', []);

_module.factory('contentBlockFactory', _contentBlockFactory2.default);

}, {"./contentBlockFactory": 22}], 24: [function (require, module, exports) {
"use strict";

Object.defineProperty(exports, "__esModule", {
    value: true
});

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var Category = function Category(label, icon) {
    var filter = arguments.length <= 2 || arguments[2] === undefined ? null : arguments[2];
    var everything = arguments.length <= 3 || arguments[3] === undefined ? false : arguments[3];

    _classCallCheck(this, Category);

    this.label = label;
    this.icon = icon;
    this.filter = filter;
    this.everything = everything;
};

exports.default = Category;

}, {}], 25: [function (require, module, exports) {
'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

Object.defineProperty(exports, "__esModule", {
    value: true
});

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var File = function () {
    function File(apiFile) {
        _classCallCheck(this, File);

        this.id = apiFile.id;
        this.title = apiFile.filename;
        this.name = apiFile.filename;
        this.extension = apiFile.extension;
        this.url = apiFile.url;
        this.type = apiFile.type;
        this.isFolder = false;
    }

    _createClass(File, [{
        key: 'icon',
        value: function icon() {
            if (this.isImage()) {
                return 'ion-image';
            }

            if (this.isVideo()) {
                return 'ion-ios-videocam';
            }

            if (this.isAudio()) {
                return 'ion-music-note';
            }

            if (this.extension === 'pdf') {
                return 'ion-printer';
            }

            return 'ion-document';
        }
    }, {
        key: 'isImage',
        value: function isImage() {
            return this.hasExtension('png', 'jpg', 'gif', 'jpeg');
        }
    }, {
        key: 'isVideo',
        value: function isVideo() {
            return this.hasExtension('mp4', 'avi');
        }
    }, {
        key: 'isAudio',
        value: function isAudio() {
            return this.hasExtension('mp3');
        }
    }, {
        key: 'isDocument',
        value: function isDocument() {
            return this.hasExtension('txt', 'md', 'pdf');
        }
    }, {
        key: 'thumbnail',
        value: function thumbnail() {
            if (this.isImage()) {
                return this.url + '?size=small';
            }

            return false;
        }

        /* public */
        /* private */

    }, {
        key: 'hasExtension',
        value: function hasExtension() {
            for (var i = 0; i < arguments.length; i++) {
                if (this.extension === arguments[i]) {
                    return true;
                }
            }

            return false;
        }
    }]);

    return File;
}();

exports.default = File;

}, {}], 26: [function (require, module, exports) {
'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _File = require('./File');

var _File2 = _interopRequireDefault(_File);

var _Folder = require('./Folder');

var _Folder2 = _interopRequireDefault(_Folder);

var _categories = require('./categories');

var _categories2 = _interopRequireDefault(_categories);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var FileManagerController = function () {

    /*@ngInject*/

    function FileManagerController($scope, api, Upload, quickviewService) {
        _classCallCheck(this, FileManagerController);

        this.$scope = $scope;
        this.api = api;
        this.Upload = Upload;
        this.quickviewService = quickviewService;

        this.categories = _categories2.default;
        this.category = this.categories[0];
        this.orderOptions = ['Title', 'Last modified'];
        this.orderBy = this.orderOptions[0];
        this.selected = null;
        this.loading = false;

        this.initFiles();
    }

    _createClass(FileManagerController, [{
        key: 'initFiles',
        value: function initFiles() {
            var _this = this;

            this.library = new _Folder2.default('Library');
            this.folder = this.library;
            this.files = this.library.files;
            this.loading = true;

            this.api.files().then(function (apiFiles) {
                _this.loading = false;

                apiFiles.forEach(function (apiFile) {
                    var file = new _File2.default(apiFile);

                    _this.library.files.push(file);
                });
            });
        }
    }, {
        key: 'isActive',
        value: function isActive(category) {
            if (category === this.category) {
                return 'active';
            }
        }
    }, {
        key: 'selectCategory',
        value: function selectCategory(category) {
            this.category = category;
        }
    }, {
        key: 'selectFile',
        value: function selectFile(file) {
            if (file === this.selected) {
                this.selected = null;
                this.quickviewService.open = false;

                return;
            }

            this.selected = file;
            this.quickviewService.open = true;
        }
    }, {
        key: 'enterFolder',
        value: function enterFolder(file) {
            if (file.isFolder) {
                this.folder = file;
                this.files = file.files;
            }
        }
    }, {
        key: 'folderHierarchy',
        value: function folderHierarchy() {
            var folders = [];
            var folder = this.folder;

            while (folder) {
                folders.push(folder);

                folder = folder.parent;
            }

            return folders.reverse();
        }
    }, {
        key: 'showFolderHierarchy',
        value: function showFolderHierarchy() {
            return this.category.everything && !this.search;
        }
    }, {
        key: 'showCategoryAsFolderHierarchy',
        value: function showCategoryAsFolderHierarchy() {
            return !this.category.everything && !this.search;
        }
    }, {
        key: 'addFolder',
        value: function addFolder(name) {
            if (!name) {
                return false;
            }

            this.folderName = '';
            var newFolder = new _Folder2.default(name, this.folder);

            this.folder.files.push(newFolder);
            $('#add-folder-modal').modal('hide');
        }
    }, {
        key: 'getFiles',
        value: function getFiles() {
            if (this.search) {
                return this.searchFiles();
            }

            var category = this.category;

            if (category.everything) {
                return this.files;
            }

            var filteredFiles = [];

            this.allFiles().forEach(function (file) {
                if (category.filter(file)) {
                    filteredFiles.push(file);
                }
            });

            return filteredFiles;
        }
    }, {
        key: 'searchFiles',
        value: function searchFiles() {
            var files = this.allFiles();
            var found = [];
            var lowerSearch = this.search.toLowerCase();

            files.forEach(function (file) {
                if (file.title.toLowerCase().indexOf(lowerSearch) !== -1) {
                    found.push(file);
                }
            });

            return found;
        }
    }, {
        key: 'sortedFiles',
        value: function sortedFiles() {
            var files = this.getFiles();
            var folders = [];
            var notFolders = [];

            files.forEach(function (file) {
                if (file.isFolder) {
                    folders.push(file);
                } else {
                    notFolders.push(file);
                }
            });

            return folders.concat(notFolders);
        }
    }, {
        key: 'allFiles',
        value: function allFiles() {
            var _this2 = this;

            var folder = arguments.length <= 0 || arguments[0] === undefined ? this.library : arguments[0];

            var files = [];

            folder.files.forEach(function (file) {
                files.push(file);

                if (file.isFolder) {
                    files = files.concat(_this2.allFiles(file));
                }
            });

            return files;
        }
    }, {
        key: 'items',
        value: function items(file) {
            var count = 0;

            if (file.isFolder) {
                count = file.files.length;
            }

            return count + ' ' + (count === 1 ? 'item' : 'items');
        }
    }, {
        key: 'deleteFiles',
        value: function deleteFiles() {
            var _this3 = this;

            var file = this.selected;

            if (file) {
                swal({
                    title: 'Sind Sie sicher?',
                    text: 'Die folgenden Dateien werden unwiderruflich gelöscht: ' + file.title,
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ja, Dateien löschen!',
                    confirmButtonColor: '#fb503b',
                    cancelButtonText: 'Abbrechen'
                }, function (confirmed) {
                    if (!confirmed) {
                        return;
                    }

                    _this3.selected = null;

                    _this3.deleteFile(file);
                    _this3.$scope.$apply();
                });
            }
        }
    }, {
        key: 'deleteFile',
        value: function deleteFile(file) {
            _.remove(this.files, file);
            this.api.deleteFile(file);
        }
    }, {
        key: 'moveTo',
        value: function moveTo(folder) {
            this.api.moveFile(this.selected, folder.path());
            this.moveFile(this.selected, folder);
            $('#move-modal').modal('hide');
            this.enterFolder(folder);
        }
    }, {
        key: 'moveFile',
        value: function moveFile(file, folder) {
            this.deleteFile(file);

            if (file.isFolder) {
                file.parent = folder;
            }

            folder.files.push(file);
        }
    }, {
        key: 'upload',
        value: function upload(file) {
            var _this4 = this;

            this.Upload.upload({
                url: '/api/files/upload',
                data: {
                    file: file
                },
                headers: {
                    Accept: 'application/vnd.MezzoLabs.v1+json'
                }
            }).then(function (response) {
                _this4.initFiles();
            }).catch(function (err) {
                console.error(err);
            });
        }
    }, {
        key: 'onDrop',
        value: function onDrop(droppable, draggable) {
            var files = this.sortedFiles();
            var folderIndex = $(droppable).data('index');
            var draggedIndex = $(draggable).data('index');
            var folder = files[folderIndex];
            var dragged = files[draggedIndex];

            this.moveFile(dragged, folder);
            this.$scope.$apply();
        }
    }, {
        key: 'refresh',
        value: function refresh() {
            this.initFiles();
        }
    }]);

    return FileManagerController;
}();

exports.default = FileManagerController;

}, {"./File": 25, "./Folder": 28, "./categories": 29}], 27: [function (require, module, exports) {
'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _File = require('./File');

var _File2 = _interopRequireDefault(_File);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var FilePickerController = function () {

    /*@ngInject*/

    function FilePickerController(api) {
        _classCallCheck(this, FilePickerController);

        this.api = api;
        this.files = [];
        this.preview = null;
        this.searchText = '';

        this.loadFiles();
    }

    _createClass(FilePickerController, [{
        key: 'selectLabel',
        value: function selectLabel() {
            var label = 'Select file';

            if (this.isMultiple()) {
                label += 's';
            }

            label += " ( " + this.selectedFiles().length + " )";

            return label;
        }
    }, {
        key: 'showModal',
        value: function showModal($event) {
            var target = $event.target;

            $(target).prev().modal();
        }
    }, {
        key: 'loadFiles',
        value: function loadFiles() {
            var _this = this;

            this.api.files().then(function (apiFiles) {
                apiFiles.forEach(function (apiFile) {
                    var file = new _File2.default(apiFile);

                    if (_this.fileType && file.type !== _this.fileType) {
                        return;
                    }

                    _this.files.push(file);
                });
            });
        }
    }, {
        key: 'filteredFiles',
        value: function filteredFiles() {
            var _this2 = this;

            if (this.searchText.length > 0) {
                return this.files.filter(function (file) {
                    return file.name.indexOf(_this2.searchText) !== -1;
                });
            }

            return this.files;
        }
    }, {
        key: 'setPreview',
        value: function setPreview(file) {
            if (file.isImage()) {
                this.preview = file;
            }
        }
    }, {
        key: 'previewSource',
        value: function previewSource() {
            if (this.preview) {
                return this.preview.url;
            }

            return '';
        }
    }, {
        key: 'hidePreview',
        value: function hidePreview() {
            this.preview = null;
        }
    }, {
        key: 'leftColumnClass',
        value: function leftColumnClass() {
            if (this.previewSource()) {
                return 'col-xs-6';
            }

            return 'col-xs-12';
        }
    }, {
        key: 'isMultiple',
        value: function isMultiple() {
            return this.multiple !== undefined;
        }
    }, {
        key: 'onSelect',
        value: function onSelect(selectedFile) {
            if (this.isMultiple() || !selectedFile.selected) {
                return;
            }

            this.files.forEach(function (file) {
                return file.selected = false;
            });

            selectedFile.selected = true;
        }
    }, {
        key: 'selectedFiles',
        value: function selectedFiles() {
            return this.files.filter(function (file) {
                return file.selected;
            });
        }
    }, {
        key: 'disableSelectButton',
        value: function disableSelectButton() {
            return this.selectedFiles().length === 0;
        }
    }, {
        key: 'selectButtonLabel',
        value: function selectButtonLabel() {
            var selected = this.selectedFiles().length;

            if (selected === 0) {
                return 'Please choose a file first';
            }

            return 'Select ' + selected + ' file' + (selected !== 1 ? 's' : '');
        }
    }, {
        key: 'confirmSelected',
        value: function confirmSelected() {
            var selected = this.selectedFiles();
            var $field = this.inputField();

            if (selected.length === 1) {
                $field.val(selected[0].id);

                return;
            }

            var fileIds = [];

            selected.forEach(function (file) {
                return fileIds.push(file.id);
            });
            $field.val(fileIds);
        }
    }, {
        key: 'countSelected',
        value: function countSelected() {
            return this.selectedFiles().length;
        }
    }, {
        key: 'acquireInputValue',
        value: function acquireInputValue(value) {
            var values = [value];

            if (value.indexOf(',') !== -1) {
                values = value.split(',');
            }

            for (var i = 0; i < values.length; i++) {
                values[i] = parseInt(values[i], 10);
            }

            this.files.forEach(function (file) {
                if (_.contains(values, file.id)) {
                    file.selected = true;
                }
            });
        }
    }, {
        key: 'inputField',
        value: function inputField() {
            return $('input[name="' + this.name + '"]');
        }
    }]);

    return FilePickerController;
}();

exports.default = FilePickerController;

}, {"./File": 25}], 28: [function (require, module, exports) {
'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _File2 = require('./File');

var _File3 = _interopRequireDefault(_File2);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var Folder = function (_File) {
    _inherits(Folder, _File);

    function Folder(name) {
        var parent = arguments.length <= 1 || arguments[1] === undefined ? null : arguments[1];

        _classCallCheck(this, Folder);

        var _this = _possibleConstructorReturn(this, Object.getPrototypeOf(Folder).call(this, {
            id: '',
            filename: name,
            extension: '',
            url: ''
        }));

        _this.parent = parent;
        _this.type = 'folder';
        _this.isFolder = true;
        _this.files = [];
        return _this;
    }

    _createClass(Folder, [{
        key: 'path',
        value: function path() {
            var folders = [this.name];
            var folder = this;

            while (folder.parent) {
                folders.push(folder.parent.name);

                folder = folder.parent;
            }

            folders.reverse();

            return '/' + folders.join('/');
        }
    }]);

    return Folder;
}(_File3.default);

exports.default = Folder;

}, {"./File": 25}], 29: [function (require, module, exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _Category = require('./Category');

var _Category2 = _interopRequireDefault(_Category);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

exports.default = [new _Category2.default('Everything', 'ion-ios-home', null, true), new _Category2.default('Images', 'ion-ios-photos', imageFilter), new _Category2.default('Videos', 'ion-ios-videocam', videoFilter), new _Category2.default('Audio', 'ion-ios-mic', audioFilter), new _Category2.default('Documents', 'ion-ios-paper', documentFilter)];

function imageFilter(file) {
    return file.isImage();
}

function videoFilter(file) {
    return file.isVideo();
}

function audioFilter(file) {
    return file.isAudio();
}

function documentFilter(file) {
    return file.isDocument();
}

}, {"./Category": 24}], 30: [function (require, module, exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = draggableDirective;
function draggableDirective() {
    return {
        restrict: 'A',
        link: link
    };

    function link(scope, element, attributes) {
        $(element).draggable({
            axis: 'y',
            containment: 'table',
            helper: 'clone',
            revert: true
        });
    }
}

}, {}], 31: [function (require, module, exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = droppableDirective;
function droppableDirective() {
    return {
        restrict: 'A',
        link: link
    };

    function link(scope, element, attributes) {
        var $element = $(element);
        var droppable = attributes.mezzoDroppable;
        var controller = scope.vm;

        if (droppable === 'true') {
            $element.droppable({
                hoverClass: 'success',
                drop: function drop(event, ui) {
                    var draggable = ui.draggable;

                    ui.helper.remove();
                    controller.onDrop(element, draggable);
                }
            });
        }
    }
}

}, {}], 32: [function (require, module, exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = filePickerDirective;

var _FilePickerController = require('./FilePickerController');

var _FilePickerController2 = _interopRequireDefault(_FilePickerController);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

/*@ngInject*/
function filePickerDirective() {
    return {
        restrict: 'E',
        templateUrl: '/mezzolabs/mezzo/cockpit/templates/filePickerDirective.html',
        scope: {
            fileType: '@',
            fieldName: '@',
            multiple: '@',
            name: '@'
        },
        controller: _FilePickerController2.default,
        controllerAs: 'vm',
        bindToController: true
    };
}

}, {"./FilePickerController": 27}], 33: [function (require, module, exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = filePickerValueDirective;
/*@ngInject*/
function filePickerValueDirective() {
    return {
        require: '^mezzoFilePicker',
        restrict: 'A',
        link: link
    };

    function link(scope, element, attributes, controller) {
        scope.$watch(function () {
            return $(element).val();
        }, function (newValue, oldValue) {
            if (newValue === oldValue || newValue === undefined) {
                return;
            }

            controller.acquireInputValue(newValue);
        });
    }
}

}, {}], 34: [function (require, module, exports) {
'use strict';

var _draggableDirective = require('./draggableDirective.js');

var _draggableDirective2 = _interopRequireDefault(_draggableDirective);

var _droppableDirective = require('./droppableDirective.js');

var _droppableDirective2 = _interopRequireDefault(_droppableDirective);

var _filePickerDirective = require('./filePickerDirective');

var _filePickerDirective2 = _interopRequireDefault(_filePickerDirective);

var _filePickerValueDirective = require('./filePickerValueDirective');

var _filePickerValueDirective2 = _interopRequireDefault(_filePickerValueDirective);

var _FileManagerController = require('./FileManagerController');

var _FileManagerController2 = _interopRequireDefault(_FileManagerController);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var _module = angular.module('MezzoFileManager', []);

_module.directive('mezzoDraggable', _draggableDirective2.default);
_module.directive('mezzoDroppable', _droppableDirective2.default);
_module.directive('mezzoFilePicker', _filePickerDirective2.default);
_module.directive('mezzoFilePickerValue', _filePickerValueDirective2.default);
_module.controller('CreateFileController', _FileManagerController2.default);

}, {
    "./FileManagerController": 26,
    "./draggableDirective.js": 30,
    "./droppableDirective.js": 31,
    "./filePickerDirective": 32,
    "./filePickerValueDirective": 33
}], 35: [function (require, module, exports) {
'use strict';

var _mapService = require('./mapService');

var _mapService2 = _interopRequireDefault(_mapService);

var _mapDirective = require('./mapDirective');

var _mapDirective2 = _interopRequireDefault(_mapDirective);

var _searchDirective = require('./searchDirective');

var _searchDirective2 = _interopRequireDefault(_searchDirective);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var _module = angular.module('MezzoGoogleMaps', []);

_module.factory('mapService', _mapService2.default);
_module.directive('mezzoGoogleMap', _mapDirective2.default);
_module.directive('mezzoGoogleMapsSearch', _searchDirective2.default);

}, {"./mapDirective": 36, "./mapService": 37, "./searchDirective": 38}], 36: [function (require, module, exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = mapDirective;
/*@ngInject*/
function mapDirective(mapService) {
    return {
        restrict: 'A',
        link: link
    };

    function link(scope, element, attributes) {
        var actualElement = element[0];
        var map = new google.maps.Map(actualElement, {
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            zoom: 8,
            center: { lat: -33.8688, lng: 151.2195 }
        });

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var currentLatLng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

                map.setCenter(currentLatLng);
            });
        }

        $('a[data-toggle="tab"]').on('shown.bs.tab', function () {
            google.maps.event.trigger(map, 'resize');
        });

        mapService.receivePlace = receivePlace;

        function receivePlace(place) {
            var marker = new google.maps.Marker({
                map: map,
                anchorPoint: new google.maps.Point(0, -29)
            });

            marker.setVisible(false);

            if (!place.geometry) {
                return;
            }

            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17); // Why 17? Because it looks good.
            }
            marker.setIcon({
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(35, 35)
            });
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);
        }
    }
}

}, {}], 37: [function (require, module, exports) {
"use strict";

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = mapService;
/*@ngInject*/
function mapService() {
    return {
        map: null
    };
}

}, {}], 38: [function (require, module, exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = searchDirective;
/*@ngInject*/
function searchDirective(mapService) {
    return {
        restrict: 'A',
        scope: {
            streetNumber: '@',
            street: '@',
            city: '@',
            state: '@',
            country: '@',
            postalCode: '@',
            latitude: '@',
            longitude: '@'
        },
        link: link
    };

    function link(scope, element, attributes) {
        var input = element[0];
        var autoCompleteOptions = {
            types: ['geocode']
        };
        var autoComplete = new google.maps.places.Autocomplete(input, autoCompleteOptions);

        autoComplete.addListener('place_changed', function () {
            var place = autoComplete.getPlace();
            var latitude = place.geometry.location.lat();
            var longitude = place.geometry.location.lng();
            var addressComponents = place.address_components;
            var componentForm = {
                street_number: {
                    key: 'short_name',
                    selector: scope.streetNumber
                },
                route: {
                    key: 'long_name',
                    selector: scope.street
                },
                locality: {
                    key: 'long_name',
                    selector: scope.city
                },
                administrative_area_level_1: {
                    key: 'long_name',
                    selector: scope.state
                },
                country: {
                    key: 'long_name',
                    selector: scope.country
                },
                postal_code: {
                    key: 'short_name',
                    selector: scope.postalCode
                }
            };

            setInputValue(scope.latitude, latitude);
            setInputValue(scope.longitude, longitude);

            addressComponents.forEach(function (component) {
                var componentType = component.types[0];
                var componentOptions = componentForm[componentType];

                if (componentOptions) {
                    var componentKey = componentOptions.key;
                    var componentSelector = componentOptions.selector;
                    var componentValue = component[componentKey];

                    setInputValue(componentSelector, componentValue);
                }
            });

            if (mapService.receivePlace) {
                mapService.receivePlace(place);
            }
        });

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                var circle = new google.maps.Circle({
                    center: geolocation,
                    radius: position.coords.accuracy
                });
                var bounds = circle.getBounds();

                autoComplete.setBounds(bounds);
            });
        }
    }

    function setInputValue(name, value) {
        $('[name="' + name + '"]').val(value).trigger('input');
    }
}

}, {}], 39: [function (require, module, exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = {
    INDEX: 'index',
    CREATE: 'create',
    EDIT: 'edit',
    SHOW: 'show'
};

}, {}], 40: [function (require, module, exports) {
'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

Object.defineProperty(exports, "__esModule", {
    value: true
});

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var CreateResourceController = function () {

    /*@ngInject*/

    function CreateResourceController(api, formDataService, contentBlockFactory, modelStateService) {
        _classCallCheck(this, CreateResourceController);

        this.api = api;
        this.formDataService = formDataService;
        this.contentBlockService = contentBlockFactory();
        this.modelStateService = modelStateService;
    }

    _createClass(CreateResourceController, [{
        key: 'init',
        value: function init(modelName) {
            this.modelName = modelName;
            this.modelApi = this.api.model(this.modelName);
        }
    }, {
        key: 'submit',
        value: function submit() {
            var _this = this;

            if (this.form.$invalid) {
                return false;
            }
            tinyMCE.triggerSave();

            var formData = this.formDataService.get();

            this.modelApi.create(formData).then(function (model) {
                _this.edit(model.id);
            });
        }
    }, {
        key: 'hasError',
        value: function hasError(formControl) {
            if (Object.keys(formControl.$error).length && formControl.$dirty) {
                return 'has-error';
            }
        }
    }, {
        key: 'edit',
        value: function edit(modelId) {
            this.modelStateService.name(this.modelName).id(modelId).edit();
        }
    }]);

    return CreateResourceController;
}();

exports.default = CreateResourceController;

}, {}], 41: [function (require, module, exports) {
'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

Object.defineProperty(exports, "__esModule", {
    value: true
});

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var EditResourceController = function () {

    /*@ngInject*/

    function EditResourceController($scope, $stateParams, api, formDataService, contentBlockFactory, modelStateService) {
        var _this = this;

        _classCallCheck(this, EditResourceController);

        this.$scope = $scope;
        this.$stateParams = $stateParams;
        this.api = api;
        this.formDataService = formDataService;
        this.contentBlockService = contentBlockFactory();
        this.modelStateService = modelStateService;
        this.modelId = this.$stateParams.modelId;
        this.includes = ['content'];

        this.$scope.$on('$destroy', function () {
            return _this.onDestroy();
        });
    }

    _createClass(EditResourceController, [{
        key: 'init',
        value: function init(modelName) {
            var includes = arguments.length <= 1 || arguments[1] === undefined ? [] : arguments[1];

            this.modelName = modelName;
            this.modelApi = this.api.model(modelName);
            this.includes = includes;

            if (!_.includes(this.includes, 'content')) {
                this.includes.push('content');
            }

            this.loadContent();
        }
    }, {
        key: 'submit',
        value: function submit() {
            if (this.form.$invalid) {
                return false;
            }

            tinyMCE.triggerSave();

            var formData = this.formDataService.get();

            this.modelApi.update(this.modelId, formData);
        }
    }, {
        key: 'getFormData',
        value: function getFormData() {
            var $form = $('form[name="vm.form"]');

            return $form.toObject();
        }
    }, {
        key: 'loadContent',
        value: function loadContent() {
            var _this2 = this;

            var params = {
                include: this.includes.join(',')
            };

            this.modelApi.content(this.modelId, params).then(function (model) {
                _this2.initContentBlocks(model);
                _this2.initLockable(model);
                _this2.stripDataEnvelopes(model.content);
                _this2.formDataService.set(model);
            });
        }
    }, {
        key: 'initContentBlocks',
        value: function initContentBlocks(model) {
            var _this3 = this;

            if (!model.content || !model.content.data.blocks) {
                return;
            }

            var blocks = model.content.data.blocks.data;

            blocks.forEach(function (block) {
                var hash = md5(block.class);

                _this3.contentBlockService.addContentBlock(block.class, hash, block._label, block.id);
            });
        }
    }, {
        key: 'startResourceLocking',
        value: function startResourceLocking() {
            var _this4 = this;

            var thirtySeconds = 30 * 1000;
            this.lockTask = setInterval(function () {
                return _this4.lock();
            }, thirtySeconds);

            this.lock();
        }
    }, {
        key: 'stopResourceLocking',
        value: function stopResourceLocking() {
            if (this.lockTask) {
                clearInterval(this.lockTask);
                this.unlock();
            }
        }
    }, {
        key: 'lock',
        value: function lock() {
            this.modelApi.lock(this.modelId);
        }
    }, {
        key: 'unlock',
        value: function unlock() {
            this.modelApi.unlock(this.modelId);
        }
    }, {
        key: 'onDestroy',
        value: function onDestroy() {
            this.stopResourceLocking();
        }
    }, {
        key: 'initLockable',
        value: function initLockable(model) {
            this.isLockable = _.has(model, '_locked_by');

            if (!this.isLockable) {
                return;
            }

            if (model._locked_for_user) {
                return this.redirectToIndex(model._locked_by);
            }

            this.startResourceLocking();
        }
    }, {
        key: 'redirectToIndex',
        value: function redirectToIndex(lockedBy) {
            var title = 'Oops...';
            var message = 'You are not allowed to edit this resource while it is locked by ' + lockedBy + '!';

            this.modelStateService.name(this.modelName).index();
            sweetAlert(title, message, 'error');
        }
    }, {
        key: 'stripDataEnvelopes',
        value: function stripDataEnvelopes(object) {
            var _this5 = this;

            if (!_.isObject(object)) {
                return;
            }

            var keys = _.keys(object);

            keys.forEach(function (key) {
                var value = object[key];

                _this5.stripDataEnvelopes(value);

                if (key === 'data') {
                    delete object[key];

                    if (_.isArray(value)) {
                        for (var i = 0; i < value.length; i++) {
                            object['num' + i] = value[i];

                            _this5.stripDataEnvelopes(value[i]);
                        }

                        return;
                    }

                    if (_.isObject(value)) {
                        return _.assign(object, value);
                    }
                }
            });
        }
    }]);

    return EditResourceController;
}();

exports.default = EditResourceController;

}, {}], 42: [function (require, module, exports) {
'use strict';

var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol ? "symbol" : typeof obj; };

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

Object.defineProperty(exports, "__esModule", {
    value: true
});

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var IndexResourceController = function () {

    /*@ngInject*/

    function IndexResourceController($scope, api, modelStateService) {
        _classCallCheck(this, IndexResourceController);

        this.$scope = $scope;
        this.api = api;
        this.modelStateService = modelStateService;
        this.includes = [];
        this.models = [];
        this.searchText = '';
        this.selectAll = false;
        this.loading = false;
        this.removing = 0;
        this.attributes = [];
    }

    _createClass(IndexResourceController, [{
        key: 'init',
        value: function init(modelName, defaultIncludes) {
            this.modelName = modelName;
            this.modelApi = this.api.model(modelName);
            this.includes = defaultIncludes;

            this.loadModels();
        }
    }, {
        key: 'addAttribute',
        value: function addAttribute(name, type) {
            this.attributes.push({ name: name, type: type });
        }
    }, {
        key: 'loadModels',
        value: function loadModels() {
            var _this = this;

            this.loading = true;
            var params = {
                include: this.includes.join(',')
            };

            return this.modelApi.index(params).then(function (data) {
                _this.loading = false;
                _this.models = data;

                _this.models.forEach(function (model) {
                    return model._meta = {};
                });
            });
        }
    }, {
        key: 'getModels',
        value: function getModels() {
            if (this.searchText.length > 0) {
                return this.search();
            }

            return this.models;
        }
    }, {
        key: 'getModelKeys',
        value: function getModelKeys(model) {
            if (this.models.length > 0 && !model) {
                model = this.models[0];
            }

            if (!model) {
                return [];
            }

            var keys = Object.keys(model);

            return keys.filter(function (key) {
                return key !== '_meta' && model.hasOwnProperty(key);
            });
        }
    }, {
        key: 'getModelValues',
        value: function getModelValues(model) {
            var values = [];

            for (var i in this.attributes) {
                var attribute = this.attributes[i];
                values.push(this.transformModelValue(attribute, model[attribute.name]));
            }

            return values;
        }
    }, {
        key: 'transformModelValue',
        value: function transformModelValue(attribute, value) {

            if (value && (typeof value === 'undefined' ? 'undefined' : _typeof(value)) === "object") {
                if (Object.prototype.toString.call(value.data) === "[object Array]") {
                    return this.transformArrayValueToString(name, value.data);
                }

                if (Object.prototype.toString.call(value.data) === "[object Object]") {
                    return this.transformObjectValueToString(name, value.data);
                }
            }

            if (value && attribute.type == "datetime") {
                return moment(value).format('DD.MM.YYYY hh:mm');
            }

            if (attribute.type == "boolean") {
                return value == "1" ? "y" : "n";
            }

            return value;
        }
    }, {
        key: 'transformArrayValueToString',
        value: function transformArrayValueToString(name, array) {
            var labels = [];

            for (var i in array) {
                labels.push(this.transformObjectValueToString(name, array[i]));
            }

            return labels.join(', ');
        }
    }, {
        key: 'transformObjectValueToString',
        value: function transformObjectValueToString(name, object) {
            return object._label;
        }
    }, {
        key: 'canEdit',
        value: function canEdit() {
            return this.selected().length === 1;
        }
    }, {
        key: 'canRemove',
        value: function canRemove() {
            return this.selected().length > 0;
        }
    }, {
        key: 'search',
        value: function search() {
            var _this2 = this;

            return this.models.filter(function (model) {
                for (var key in model) {
                    if (model.hasOwnProperty(key)) {
                        var value = model[key];

                        if (String(value).indexOf(_this2.searchText) !== -1) {
                            return true;
                        }
                    }
                }
            });
        }
    }, {
        key: 'updateSelectAll',
        value: function updateSelectAll() {
            var _this3 = this;

            var models = this.getModels();

            models.forEach(function (model) {
                return model._meta.selected = _this3.selectAll;
            });
        }
    }, {
        key: 'selected',
        value: function selected() {
            return this.models.filter(function (model) {
                return model._meta.selected;
            });
        }
    }, {
        key: 'create',
        value: function create() {}
    }, {
        key: 'editId',
        value: function editId(id) {
            this.modelStateService.name(this.modelName).id(id).edit();
        }
    }, {
        key: 'remove',
        value: function remove() {
            var _this4 = this;

            var selected = this.selected();

            swal({
                title: 'Are you sure?',
                text: selected.length + ' models will be deleted!',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete them!',
                confirmButtonColor: '#fb503b'
            }, function (confirmed) {
                if (!confirmed) {
                    return;
                }

                selected.forEach(function (model) {
                    return _this4.removeModel(model);
                });
            });
        }
    }, {
        key: 'removeModel',
        value: function removeModel(model) {
            var _this5 = this;

            this.removing++;
            this.selectAll = false;
            model._meta.selected = false;
            model._meta.removed = true;

            this.removeRemoteModel(model).then(function () {
                return _this5.removeLocalModel(model);
            }).catch(function () {
                return _this5.removing--;
            });
        }
    }, {
        key: 'removeLocalModel',
        value: function removeLocalModel(model) {
            for (var i = 0; i < this.models.length; i++) {
                if (this.models[i] === model) {
                    return this.models.splice(i, 1);
                }
            }
        }
    }, {
        key: 'removeRemoteModel',
        value: function removeRemoteModel(model) {
            return this.modelApi.delete(model.id);
        }
    }, {
        key: 'countSelected',
        value: function countSelected() {
            return this.selected().length;
        }
    }, {
        key: 'isLocked',
        value: function isLocked(model) {
            return model._locked_for_user;
        }
    }, {
        key: 'lockedBy',
        value: function lockedBy(model) {
            return model._locked_by;
        }
    }, {
        key: 'displayAsLink',
        value: function displayAsLink($first, model) {
            return $first && !this.isLocked(model);
        }
    }]);

    return IndexResourceController;
}();

exports.default = IndexResourceController;

}, {}], 43: [function (require, module, exports) {
    'use strict';

    var _createClass = function () {
        function defineProperties(target, props) {
            for (var i = 0; i < props.length; i++) {
                var descriptor = props[i];
                descriptor.enumerable = descriptor.enumerable || false;
                descriptor.configurable = true;
                if ("value" in descriptor) descriptor.writable = true;
                Object.defineProperty(target, descriptor.key, descriptor);
            }
        }

        return function (Constructor, protoProps, staticProps) {
            if (protoProps) defineProperties(Constructor.prototype, protoProps);
            if (staticProps) defineProperties(Constructor, staticProps);
            return Constructor;
        };
    }();

    Object.defineProperty(exports, "__esModule", {
        value: true
    });

    function _classCallCheck(instance, Constructor) {
        if (!(instance instanceof Constructor)) {
            throw new TypeError("Cannot call a class as a function");
        }
    }

    var ModelStateService = function () {

        /*@ngInject*/

        function ModelStateService($state) {
            _classCallCheck(this, ModelStateService);

            this.$state = $state;
        }

        _createClass(ModelStateService, [{
            key: 'name',
            value: function name(modelName) {
                this.modelName = modelName;

                return this;
            }
        }, {
            key: 'id',
            value: function id(modelId) {
                this.modelId = modelId;

                return this;
            }
        }, {
            key: 'index',
            value: function index() {
                this.go('index', this.modelStateName());
            }
        }, {
            key: 'create',
            value: function create() {
                this.go('create' + this.modelStateName());
            }
        }, {
            key: 'edit',
            value: function edit() {
                var stateName = 'edit' + this.modelStateName();
                var stateParams = {
                    modelId: this.modelId
                };

                this.go(stateName, stateParams);
            }

            /* public */
            /* private */

        }, {
            key: 'go',
            value: function go(stateName) {
                var stateParams = arguments.length <= 1 || arguments[1] === undefined ? {} : arguments[1];

                this.$state.go(stateName, stateParams);
            }
        }, {
            key: 'modelStateName',
            value: function modelStateName() {
                return this.modelName.replace('-', '').toLowerCase();
            }
        }]);

        return ModelStateService;
    }();

    exports.default = ModelStateService;

}, {}], 44: [function (require, module, exports) {
"use strict";

Object.defineProperty(exports, "__esModule", {
    value: true
});

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var ShowResourceController =

/*@ngInject*/
function ShowResourceController() {
    _classCallCheck(this, ShowResourceController);
};

exports.default = ShowResourceController;

}, {}], 45: [function (require, module, exports) {
'use strict';

var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol ? "symbol" : typeof obj; };

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

Object.defineProperty(exports, "__esModule", {
    value: true
});

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var FormDataService = function () {
    function FormDataService() {
        _classCallCheck(this, FormDataService);
    }

    _createClass(FormDataService, [{
        key: 'form',
        value: function form() {
            return $('form[name="vm.form"]');
        }
    }, {
        key: 'get',
        value: function get() {
            return this.form().toObject();
        }
    }, {
        key: 'set',
        value: function set(formData) {
            console.log('received data: ', formData);

            var stripped = this.stripData(formData);

            stripped = this.unpackSelectInputs(this.form()[0], stripped);
            stripped = this.formatTimestamps(stripped);

            console.log('fill form: ', stripped);

            js2form(this.form()[0], stripped);
            this.form().find(':input').trigger('input'); // trigger input event to notify Angular that ng-model should update
        }
    }, {
        key: 'stripData',
        value: function stripData(formData) {
            var cleaned = {};

            if (!formData || (typeof formData === 'undefined' ? 'undefined' : _typeof(formData)) !== 'object') return formData;

            if (formData.data) return this.stripData(formData.data);

            for (var i in formData) {
                cleaned[i] = this.stripData(formData[i]);
            }

            return cleaned;
        }
    }, {
        key: 'unpackSelectInputs',
        value: function unpackSelectInputs(form, data) {
            var clean = _.clone(data);
            $(form).find('select').each(function (id, elem) {
                var name = $(this).attr('name');

                //html input element is not in response or already an id
                if (!clean[name] || _typeof(clean[name]) !== 'object') return true;

                // not an array
                if (!clean[name][0]) {
                    clean[name] = clean[name].id;
                    return true;
                }

                //unpack the array of relation elements
                var ids = [];
                for (var i in clean[name]) {
                    ids.push(clean[name][i].id);
                }

                clean[name] = ids;
            });

            return clean;
        }
    }, {
        key: 'formatTimestamps',
        value: function formatTimestamps(formData) {
            var cleaned = {};

            //Unpack everything
            if (formData && (typeof formData === 'undefined' ? 'undefined' : _typeof(formData)) === 'object') {
                for (var i in formData) {
                    cleaned[i] = this.formatTimestamps(formData[i]);
                }
                return cleaned;
            }

            //Only the atomic values will land here (science bitch!)

            if (typeof formData == "string" && formData.match(/\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}/)) {
                return moment(formData).format('DD.MM.YYYY HH:mm');
            }

            return formData;
        }
    }]);

    return FormDataService;
}();

exports.default = FormDataService;

}, {}], 46: [function (require, module, exports) {
'use strict';

var _stateProvider = require('./stateProvider');

var _stateProvider2 = _interopRequireDefault(_stateProvider);

var _formDataService = require('./formDataService');

var _formDataService2 = _interopRequireDefault(_formDataService);

    var _ModelStateService = require('./ModelStateService');

    var _ModelStateService2 = _interopRequireDefault(_ModelStateService);

var _registerStateDirective = require('./registerStateDirective');

var _registerStateDirective2 = _interopRequireDefault(_registerStateDirective);

var _IndexResourceController = require('./IndexResourceController');

var _IndexResourceController2 = _interopRequireDefault(_IndexResourceController);

var _CreateResourceController = require('./CreateResourceController');

var _CreateResourceController2 = _interopRequireDefault(_CreateResourceController);

var _EditResourceController = require('./EditResourceController');

var _EditResourceController2 = _interopRequireDefault(_EditResourceController);

var _ShowResourceController = require('./ShowResourceController');

var _ShowResourceController2 = _interopRequireDefault(_ShowResourceController);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var _module = angular.module('MezzoResources', []);

_module.provider('$stateProvider', _stateProvider2.default);
_module.service('formDataService', _formDataService2.default);
    _module.service('modelStateService', _ModelStateService2.default);
_module.directive('mezzoRegisterState', _registerStateDirective2.default);
_module.controller('IndexResourceController', _IndexResourceController2.default);
_module.controller('CreateResourceController', _CreateResourceController2.default);
_module.controller('EditResourceController', _EditResourceController2.default);
_module.controller('ShowResourceController', _ShowResourceController2.default);

}, {
    "./CreateResourceController": 40,
    "./EditResourceController": 41,
    "./IndexResourceController": 42,
    "./ModelStateService": 43,
    "./ShowResourceController": 44,
    "./formDataService": 45,
    "./registerStateDirective": 47,
    "./stateProvider": 48
}], 47: [function (require, module, exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = registerStateDirective;

var _Action = require('./Action');

var _Action2 = _interopRequireDefault(_Action);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

/*@ngInject*/
function registerStateDirective($location, $stateProvider, hasController) {
    return {
        restrict: 'A',
        link: link
    };

    function link(scope, element, attributes) {
        var uri = attributes.uri;
        var page = attributes.page;
        var action = attributes.action;

        registerState(uri, page, action);

        if (action === _Action2.default.CREATE) {
            registerState(uri.replace('create', 'edit'), page.replace('Create', 'Edit'), _Action2.default.EDIT);
        }

        initSidebarBehaviour(element);
    }

    function registerState(uri, page, action) {
        var stateName = page.toLowerCase();
        var url = urlForAction(uri, action);
        var controller = controllerForPage(page);

        if (!controller) {
            controller = controllerForAction(action);
        }

        $stateProvider.state(stateName, {
            url: url,
            templateUrl: '/mezzo/' + uri + '.html',
            controller: controller,
            controllerAs: 'vm'
        });
    }

    function controllerForPage(page) {
        var controllerName = page + 'Controller';

        if (hasController(controllerName)) {
            console.info('Found custom ' + controllerName);

            return controllerName;
        }

        return null;
    }

    function controllerForAction(action) {
        if (action === _Action2.default.INDEX) {
            return 'IndexResourceController';
        }

        if (action === _Action2.default.CREATE) {
            return 'CreateResourceController';
        }

        if (action === _Action2.default.EDIT) {
            return 'EditResourceController';
        }

        if (action === _Action2.default.SHOW) {
            return 'ShowResourceController';
        }

        throw new Error('No suitable Controller found for action "' + action + '"!');
    }

    function urlForAction(uri, action) {
        var url = '/mezzo/' + uri;

        if (action === _Action2.default.EDIT) {
            return url + '/:modelId';
        }

        return url;
    }

    function initSidebarBehaviour(element) {
        var $element = $(element);
        var url = $location.url();
        var href = '/' + $element.attr('href');

        if (url === href) {
            $element.addClass('active').parents('li.has-pages').addClass('opened');
        }

        $element.click(function () {
            $('a[data-mezzo-register-state]').removeClass('active');
            $element.addClass('active');
        });
    }
}

}, {"./Action": 39}], 48: [function (require, module, exports) {
"use strict";

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = stateProvider;
/*@ngInject*/
function stateProvider($stateProvider) {
    this.$get = $get;

    function $get() {
        return $stateProvider;
    }
}

}, {}], 49: [function (require, module, exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = config;
/*@ngInject*/
function config($locationProvider, $httpProvider) {
    $httpProvider.defaults.headers.common.Accept = 'application/vnd.MezzoLabs.v1+json';

    $locationProvider.html5Mode(true);
}

}, {}], 50: [function (require, module, exports) {
'use strict';

$(function () {
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
    });

    $('.trigger-quickview').click(function () {
        quickviewVisible(!quickviewIsVisible());
        return false;
    });

    $('.mezzo__filemanager_container .btn-refresh').click(function () {
        quickviewVisible(true);
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
});

function quickviewVisible(open) {
    if (open) {
        $('#quickview').addClass('opened');
        $('#view-overlay').addClass('opened');
    } else {
        $('#quickview').removeClass('opened');
        $('#view-overlay').removeClass('opened');
    }
}

},{}]},{},[1]);

//# sourceMappingURL=app.js.map
