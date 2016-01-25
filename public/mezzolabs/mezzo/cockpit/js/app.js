(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
'use strict';

require('./setup/jquery');

require('./common');

require('./modules/resource');

require('./modules/fileManager');

require('./modules/events');

require('./modules/users');

require('./modules/contentBlocks');

require('./modules/googleMaps');

var _config = require('./setup/config');

var _config2 = _interopRequireDefault(_config);

var _run = require('./setup/run');

var _run2 = _interopRequireDefault(_run);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

    var app = angular.module('Mezzo', ['ui.router', 'ui.sortable', 'ui.bootstrap', 'pascalprecht.translate', 'ngMessages', 'angular-sortable-view', 'angular-loading-bar', 'ngFileUpload', 'MezzoCommon', 'MezzoResources', 'MezzoFileManager', 'MezzoEvents', 'MezzoUsers', 'MezzoContentBlocks', 'MezzoGoogleMaps']);

app.config(_config2.default);
app.run(_run2.default);

}, {
    "./common": 17,
    "./modules/contentBlocks": 27,
    "./modules/events": 31,
    "./modules/fileManager": 42,
    "./modules/googleMaps": 43,
    "./modules/resource": 56,
    "./modules/users": 60,
    "./setup/config": 62,
    "./setup/jquery": 64,
    "./setup/run": 66
}], 2: [function (require, module, exports) {
'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

Object.defineProperty(exports, "__esModule", {
    value: true
});

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var ErrorHandlerService = function () {
    function ErrorHandlerService() {
        _classCallCheck(this, ErrorHandlerService);
    }

    _createClass(ErrorHandlerService, [{
        key: 'showUnexpected',
        value: function showUnexpected(err) {
            var message = JSON.stringify(err);

            if (err.data && err.data.message) {
                message = error.statusText + '. ' + error.data.message;
            }

            console.error(err);
            sweetAlert('Oops, something spilled...', message, 'error');
            throw err;
        }
    }]);

    return ErrorHandlerService;
}();

exports.default = ErrorHandlerService;

},{}],3:[function(require,module,exports){
'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

Object.defineProperty(exports, "__esModule", {
    value: true
});

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var FormValidationService = function () {
    function FormValidationService() {
        _classCallCheck(this, FormValidationService);
    }

    _createClass(FormValidationService, [{
        key: 'assign',
        value: function assign(formInput) {
            var $formInput = $(formInput);
            var nameAttribute = $formInput.attr('name');

            if (!nameAttribute) {
                return;
            }

            var $formGroup = $formInput.parents('.form-group');
            var validationMessagesTemplate = '<mezzo-validation-messages data-form-input="vm.form[\'' + nameAttribute + '\']"></mezzo-validation-messages>';

            $formInput.attr('ng-model', 'vm.inputs[\'' + nameAttribute + '\']').not('[readonly],[disabled]').attr('ng-disabled', 'vm.loading');

            $formGroup.attr('ng-class', 'vm.hasError(\'' + nameAttribute + '\')').append(validationMessagesTemplate);
        }
    }]);

    return FormValidationService;
}();

exports.default = FormValidationService;

},{}],4:[function(require,module,exports){
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

    var LanguageService = function () {
        function LanguageService($translate) {
            _classCallCheck(this, LanguageService);

            this.$translate = $translate;

            this.cache = {};

            //TODO MOVE THIS TO CONFIG
            this.lang = {
                de: {
                    attributes: {
                        gender: {
                            m: 'Herr',
                            f: 'Frau'
                        },
                        backend: {
                            1: 'Backend',
                            0: 'Frontend'
                        },
                        confirmed: {
                            1: 'Bestätigt',
                            0: 'Unbestätigt'
                        },
                        state: {
                            published: 'Veröffentlicht',
                            draft: 'Zur Vorlage',
                            deleted: 'Papierkorb'
                    }
                }
                }
            };
        }

        _createClass(LanguageService, [{
            key: 'get',
            value: function get(key) {
                var language = arguments.length <= 1 || arguments[1] === undefined ? 'de' : arguments[1];

                var cacheKey = this.uniqueCacheKey(key, language);

                if (!this.cache[cacheKey]) {
                    this.cache[cacheKey] = this.findInTree(key, language);
            }

                return this.cache[cacheKey];
            }
        }, {
            key: 'findInTree',
            value: function findInTree(key, language) {
                var keyParts = key.split('.');

                var lang = _.clone(this.lang[language]);

                for (var i = 0; i != keyParts.length; i++) {
                    var keyPart = keyParts[i];

                    if (lang[keyPart]) {
                        lang = lang[keyPart];
                    } else {
                        break;
                }
                }

                if (typeof lang != "string") {
                    return key;
            }

                return lang;
            }
        }, {
            key: 'uniqueCacheKey',
            value: function uniqueCacheKey(key, language) {
                return key + '[' + language + ']';
            }
        }, {
            key: 'has',
            value: function has(key) {
                var language = arguments.length <= 1 || arguments[1] === undefined ? 'de' : arguments[1];

                var translation = this.get(key, language);

                return translation != key;
            }
        }, {
            key: 'bla',
            value: function bla() {
                this.$translate('ATTRIBUTES.GENDER').then(function (trans) {
                    console.log(trans);
                });
            }
        }]);

        return LanguageService;
    }();

    exports.default = LanguageService;

}, {}], 5: [function (require, module, exports) {
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

}, {}], 6: [function (require, module, exports) {
'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

Object.defineProperty(exports, "__esModule", {
    value: true
});

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var RelationInputController = function () {

    /*@ngInject*/

    function RelationInputController(api, $scope, $element, $timeout) {
        var _this = this;

        _classCallCheck(this, RelationInputController);

        this.api = api;
        this.modelApi = this.api.model(this.related);
        this.model = null;
        this.$element = $element;
        this.models = [];
        this.selected = null;

        var params = {
            scopes: this.scopes
        };

        var base = this;

        this.modelApi.index(params).then(function (models) {
            _this.models = models;

            $timeout(function () {
                if (!base.selected) return;

                var value = base.selected;

                if (base.selected[0]) {
                    value = _.map(base.selected, 'id');
                }

                $(base.$element).val(value).trigger('change', { 'filledFromApi': true }).blur();
            });
        });

        var base = this;

        $scope.$on('mezzo.formdata.set', function (event, mass) {
            base.fill(mass.data, mass.form);
        });
    }

    _createClass(RelationInputController, [{
        key: 'fill',
        value: function fill(data, form) {

            if (form != $(this.$element).parents('form')[0]) return false;

            this.selected = data[this.$element.attr('name')];
        }
    }]);

    return RelationInputController;
}();

exports.default = RelationInputController;

}, {}], 7: [function (require, module, exports) {
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

    /** @ngInject */

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
            return $httpPromise.then(function (response) {
                return response.data.data;
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
            });
        }
    }]);

    return Api;
}();

exports.default = Api;

}, {"./ModelApi": 8}], 8: [function (require, module, exports) {
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

            this.throwEvent('update', { data: formData, id: modelId });
            var request = this.api.put(this.apiUrl + '/' + modelId, formData);
            this.throwEvent('updated', { data: formData, id: modelId });

            return request;
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
    }, {
        key: 'throwEvent',
        value: function throwEvent(name, data) {
            var payload = _.merge({
                'modelName': this.modelName
            }, data);

            //$rootScope.$broadcast('mezzo.model.' + name, payload);
        }
    }]);

    return ModelApi;
}();

exports.default = ModelApi;

}, {}], 9: [function (require, module, exports) {
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

}, {"./Api": 7}], 10: [function (require, module, exports) {
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
}

}, {}], 11: [function (require, module, exports) {
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

        $(element).on('dp.hide', function () {
            changed(this);
            $(this).trigger('change');
        });

        $(element).datetimepicker(options);

        changed(element);

        function changed(element) {
            var before = $(element).attr('data-before');
            var after = $(element).attr('data-after');

            var $before = before ? $(before) : null;
            var $after = after ? $(after) : null;

            if ($(element).val() == "") return true;

            var date = moment($(element).val(), options.format);

            if ($after) {
                $after.data("DateTimePicker").maxDate(date);
            }

            if ($before) {
                $before.data("DateTimePicker").minDate(date);
            }
        }
    }
}

}, {}], 12: [function (require, module, exports) {
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

}, {}], 13: [function (require, module, exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = formValidationDirective;
/*@ngInject*/
function formValidationDirective(formValidationService) {
    return {
        restrict: 'A',
        compile: compile
    };

    function compile(element) {
        $(element).find(':input').each(function (index, formInput) {
            formValidationService.assign(formInput);
        });
    }
}

}, {}], 14: [function (require, module, exports) {
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

}, {}], 15: [function (require, module, exports) {
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
            $event.stopPropagation();
        });
    }
}

}, {}], 16: [function (require, module, exports) {
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

}, {}], 17: [function (require, module, exports) {
'use strict';

var _compileDirective = require('./compileDirective');

var _compileDirective2 = _interopRequireDefault(_compileDirective);

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

var _formValidationDirective = require('./formValidationDirective');

var _formValidationDirective2 = _interopRequireDefault(_formValidationDirective);

var _validationMessagesDirective = require('./validationMessagesDirective');

var _validationMessagesDirective2 = _interopRequireDefault(_validationMessagesDirective);

var _uidService = require('./uidService.js');

var _uidService2 = _interopRequireDefault(_uidService);

var _apiService = require('./api/apiService');

var _apiService2 = _interopRequireDefault(_apiService);

var _hasControllerService = require('./hasControllerService');

var _hasControllerService2 = _interopRequireDefault(_hasControllerService);

var _QuickviewService = require('./QuickviewService');

var _QuickviewService2 = _interopRequireDefault(_QuickviewService);

var _FormValidationService = require('./FormValidationService');

var _FormValidationService2 = _interopRequireDefault(_FormValidationService);

    var _LanguageService = require('./LanguageService');

    var _LanguageService2 = _interopRequireDefault(_LanguageService);

var _ErrorHandlerService = require('./ErrorHandlerService');

var _ErrorHandlerService2 = _interopRequireDefault(_ErrorHandlerService);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var _module = angular.module('MezzoCommon', []);

_module.directive('mezzoCompile', _compileDirective2.default);
_module.directive('mezzoEnter', _enterDirective2.default);
_module.directive('mezzoRelationInput', _relationInputDirective2.default);
_module.directive('mezzoHrefReload', _hrefReloadDirective2.default);
_module.directive('mezzoHrefPrevent', _hrefPreventDirective2.default);
_module.directive('mezzoSelect2', _select2Directive2.default);
_module.directive('mezzoRichtext', _tinymceDirective2.default);
_module.directive('mezzoDatetimepicker', _dateTimePickerDirective2.default);
_module.directive('mezzoQuickview', _quickviewDirective2.default);
_module.directive('mezzoQuickviewClose', _quickviewCloseDirective2.default);
_module.directive('mezzoFormValidation', _formValidationDirective2.default);
_module.directive('mezzoValidationMessages', _validationMessagesDirective2.default);
_module.factory('uid', _uidService2.default);
_module.factory('api', _apiService2.default);
_module.factory('hasController', _hasControllerService2.default);
_module.service('quickviewService', _QuickviewService2.default);
_module.service('formValidationService', _FormValidationService2.default);
_module.service('errorHandlerService', _ErrorHandlerService2.default);
    _module.service('languageService', _LanguageService2.default);

}, {
    "./ErrorHandlerService": 2,
    "./FormValidationService": 3,
    "./LanguageService": 4,
    "./QuickviewService": 5,
    "./api/apiService": 9,
    "./compileDirective": 10,
    "./dateTimePickerDirective": 11,
    "./enterDirective.js": 12,
    "./formValidationDirective": 13,
    "./hasControllerService": 14,
    "./hrefPreventDirective": 15,
    "./hrefReloadDirective": 16,
    "./quickviewCloseDirective": 18,
    "./quickviewDirective": 19,
    "./relationInputDirective": 20,
    "./select2Directive": 21,
    "./tinymceDirective": 22,
    "./uidService.js": 23,
    "./validationMessagesDirective": 24
}], 18: [function (require, module, exports) {
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

}, {}], 19: [function (require, module, exports) {
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

}, {}], 20: [function (require, module, exports) {
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

}, {"./RelationInputController": 6}], 21: [function (require, module, exports) {
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

}, {}], 22: [function (require, module, exports) {
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

}, {}], 23: [function (require, module, exports) {
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

}, {}], 24: [function (require, module, exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = validationMessagesDirective;
/*@ngInject*/
function validationMessagesDirective() {
    return {
        restrict: 'E',
        templateUrl: '/mezzolabs/mezzo/cockpit/templates/validationMessagesDirective.html',
        scope: {
            formInput: '='
        }
    };
}

}, {}], 25: [function (require, module, exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = compileContentBlockDirective;
/*@ngInject*/
function compileContentBlockDirective($parse, $compile, formValidationService) {
    return {
        restrict: 'A',
        link: link
    };

    function link(scope, element, attributes) {
        var expression = attributes.mezzoCompileContentBlock;
        var getter = $parse(expression);

        scope.$watch(getter, function (html) {
            if (!html) {
                return;
            }

            element.html(html);
            deferFormValidation(element);
            $compile(element.contents())(scope);
        });

        function deferFormValidation(element) {
            setTimeout(function () {
                assignFormValidation(element);
            }, 1);
        }

        function assignFormValidation(element) {
            element.children('div.form-group').find(':input').each(function (index, formInput) {
                formValidationService.assign(formInput);
            });
            $compile(element.contents())(scope);
        }
    }
}

}, {}], 26: [function (require, module, exports) {
'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = registerContentBlockFactory;

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

/*@ngInject*/
function registerContentBlockFactory($compile, api) {
    return function contentBlockFactory() {
        return new ContentBlockService($compile, api);
    };
}

var ContentBlockService = function () {
    function ContentBlockService($compile, api) {
        _classCallCheck(this, ContentBlockService);

        this.$compile = $compile;
        this.api = api;
        this.modelApi = api.model('ContentBlock');
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

                base.rebaseSortingOnHtml();
            }
        };
        this.currentId = 0;
    }

    _createClass(ContentBlockService, [{
        key: 'addContentBlock',
        value: function addContentBlock(key, hash, title) {
            var id = arguments.length <= 3 || arguments[3] === undefined ? '' : arguments[3];
            var options = arguments.length <= 4 || arguments[4] === undefined ? {} : arguments[4];
            var sort = arguments.length <= 5 || arguments[5] === undefined ? false : arguments[5];

            var contentBlock = {
                id: id,
                key: key,
                sort: sort !== false ? sort : this.contentBlocks.length,
                cssClass: 'block__' + key.replace(/\\/g, '_'),
                hash: hash,
                title: title,
                options: options,
                nameInForm: this.currentId++,
                template: null
            };

            this.fillTemplate(contentBlock);
            this.contentBlocks.push(contentBlock);

            this.refreshSortings();
        }
    }, {
        key: 'removeContentBlock',
        value: function removeContentBlock(index) {
            var block = this.contentBlocks[index];

            if (block.id) {
                this.modelApi.delete(block.id);
            }

            this.contentBlocks.splice(index, 1);

            this.refreshSortings();
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
    }, {
        key: 'refreshSortings',
        value: function refreshSortings() {
            this.contentBlocks = _.sortBy(this.contentBlocks, 'sort');

            for (var i in this.contentBlocks) {
                this.contentBlocks[i].sort = parseInt(i);
            }
        }
    }, {
        key: 'rebaseSortingOnHtml',
        value: function rebaseSortingOnHtml() {
            var base = this;

            $('.content-block').each(function (index, element) {
                var $sort = $(this).find('[name$=".sort"]');
                var nameInForm = $sort.attr('name').replace('.sort', '').split('.');
                nameInForm = nameInForm[nameInForm.length - 1];

                var block = _.find(base.contentBlocks, function (test) {
                    return test.nameInForm == nameInForm;
                });
                block.sort = index;

                $sort.attr('value', index).trigger('change');
            });

            this.refreshSortings();
        }
    }]);

    return ContentBlockService;
}();

}, {}], 27: [function (require, module, exports) {
'use strict';

var _contentBlockFactory = require('./contentBlockFactory');

var _contentBlockFactory2 = _interopRequireDefault(_contentBlockFactory);

var _compileContentBlockDirective = require('./compileContentBlockDirective');

var _compileContentBlockDirective2 = _interopRequireDefault(_compileContentBlockDirective);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var _module = angular.module('MezzoContentBlocks', []);

_module.factory('contentBlockFactory', _contentBlockFactory2.default);
_module.directive('mezzoCompileContentBlock', _compileContentBlockDirective2.default);

}, {"./compileContentBlockDirective": 25, "./contentBlockFactory": 26}], 28: [function (require, module, exports) {
'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

Object.defineProperty(exports, "__esModule", {
    value: true
});

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var FilePickerController = function () {

    /*@ngInject*/

    function FilePickerController(api, $scope, $element) {
        _classCallCheck(this, FilePickerController);

        this.days = [];

        this.format = 'DD.MM.YYYY HH:mm';

        this.api = api;
        this.modelApi = api.model('EventDay');

        this.$element = $element;
        this.$form = $element.parents('form')[0];

        var base = this;

        $scope.$on('mezzo.formdata.set', function (event, mass) {
            base.fill(mass.data, mass.form);
        });

        this.addDay();
    }

    _createClass(FilePickerController, [{
        key: 'addDay',
        value: function addDay() {
            var start = arguments.length <= 0 || arguments[0] === undefined ? "" : arguments[0];
            var end = arguments.length <= 1 || arguments[1] === undefined ? "" : arguments[1];
            var id = arguments.length <= 2 || arguments[2] === undefined ? null : arguments[2];

            this.days.push({
                start: start, end: end, id: id
            });

            $(this.$form).find('[data-mezzo-datetimepicker]').trigger('dp.refresh');
        }
    }, {
        key: 'removeDay',
        value: function removeDay(index) {
            if (this.days.length <= 1) return false;

            var day = this.days[index];

            if (day.id) {
                this.removeDayFromServer(day);
            }

            this.days.splice(index, 1);
            console.log(this.days, 'removed ' + index);
        }
    }, {
        key: 'removeDayFromServer',
        value: function removeDayFromServer(day) {
            this.modelApi.delete(day.id).then(function (response) {
                console.log(response);
            }).catch(function (error) {
                console.log('error', error);
            });
        }
    }, {
        key: 'fill',
        value: function fill(data, form) {
            console.log(data);
            if (form != this.$form) {
                return;
            }

            if (_.size(data.days) == 0) {
                return;
            }

            this.days = [];

            for (var i in data.days) {
                var day = data.days[i];
                this.addDay(day.start, day.end, day.id);
            }

            this.sort();
        }
    }, {
        key: 'submit',
        value: function submit() {
            console.log('submit');
        }
    }, {
        key: 'sort',
        value: function sort() {
            this.days = this.sortedDays();
        }
    }, {
        key: 'sortedDays',
        value: function sortedDays() {
            return _.sortBy(this.days, 'start');
        }
    }, {
        key: 'startChanged',
        value: function startChanged() {
            this.sort();
        }
    }, {
        key: 'getStart',
        value: function getStart() {
            return this.getDate(this.sortedDays()[0], 'start');
        }
    }, {
        key: 'getEnd',
        value: function getEnd() {
            return this.getDate(this.sortedDays()[this.days.length - 1], 'end');
        }
    }, {
        key: 'getDate',
        value: function getDate(day, type) {

            if (!day) return null;

            if (!day[type] || day[type] == "") return null;

            return moment(day[type], this.format);
        }
    }, {
        key: 'startString',
        value: function startString() {
            var start = this.getStart();

            if (!start) return "...";

            return start.format('dd, DD.MM.YYYY HH:mm');
        }
    }, {
        key: 'endString',
        value: function endString() {
            var end = this.getEnd();
            if (!end) return "...";

            return end.format('dd, DD.MM.YYYY HH:mm');
        }
    }]);

    return FilePickerController;
}();

exports.default = FilePickerController;

}, {}], 29: [function (require, module, exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = eventDaysDirective;

var _EventDaysController = require('./EventDaysController');

var _EventDaysController2 = _interopRequireDefault(_EventDaysController);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

/*@ngInject*/
function eventDaysDirective() {
    return {
        restrict: 'E',
        templateUrl: '/mezzolabs/mezzo/cockpit/templates/eventDaysDirective.html',
        scope: {
            naming: '@'
        },
        controller: _EventDaysController2.default,
        controllerAs: 'vm',
        bindToController: true
    };
}

}, {"./EventDaysController": 28}], 30: [function (require, module, exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = eventVenueDirective;
/*@ngInject*/
function eventVenueDirective(api) {
    return {
        restrict: 'A',
        link: link
    };

    function link(scope, element, attributes) {
        var modelApi = api.model('EventVenue');
        var $form = $(element).parents('form');

        $(element).on('change', function (e, parameters) {
            var filledFromApi = parameters && parameters.filledFromApi;

            if (!$(this).val() || $(this).val() == "" || filledFromApi) return true;

            modelApi.content($(this).val(), { include: 'address' }).then(function (result) {
                fillAddress(result.address.data);
            });
        });

        function fillAddress(data) {
            for (var attributeName in data) {
                var selector = '[name="address.' + attributeName + '"]';
                var $input = $form.find(selector);

                if ($input.length == 0) {
                    continue;
                }

                $input.val(data[attributeName]);
                $input.trigger('input');
            }
        }
    }
}

}, {}], 31: [function (require, module, exports) {
'use strict';

var _eventDaysDirective = require('./eventDaysDirective');

var _eventDaysDirective2 = _interopRequireDefault(_eventDaysDirective);

var _eventVenueDirective = require('./eventVenueDirective');

var _eventVenueDirective2 = _interopRequireDefault(_eventVenueDirective);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var _module = angular.module('MezzoEvents', []);

_module.directive('mezzoEventDays', _eventDaysDirective2.default);
_module.directive('mezzoEventVenue', _eventVenueDirective2.default);

}, {"./eventDaysDirective": 29, "./eventVenueDirective": 30}], 32: [function (require, module, exports) {
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

}, {}], 33: [function (require, module, exports) {
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
        this.addon = apiFile.addon;
        this.url = apiFile.url;
        this.type = apiFile.type;
        this.filePath = apiFile.path;
        this.isFolder = false;
    }

    _createClass(File, [{
        key: 'displayFolderPath',
        value: function displayFolderPath() {
            if (this.filePath.indexOf('/') === -1) {
                return 'Library';
            }

            var filePathSplitted = this.filePath.split('/');

            return filePathSplitted.slice(0, filePathSplitted.length - 1).join('/');
        }
    }, {
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
            var size = arguments.length <= 0 || arguments[0] === undefined ? 'thumb' : arguments[0];

            if (this.isImage()) {
                if (size) {
                    return this.url + '?size=' + size;
                }

                return this.url;
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

}, {}], 34: [function (require, module, exports) {
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

            this.library = new _Folder2.default('Library', null, true);
            this.folder = this.library;
            this.files = this.library.files;
            this.loading = true;
            var folders = {};

            this.api.files().then(function (apiFiles) {
                _this.loading = false;

                apiFiles.forEach(function (apiFile) {
                    var file = new _File2.default(apiFile);
                    var filePath = apiFile.path;

                    if (filePath.indexOf('/') === -1) {
                        _this.library.files.push(file);
                        return;
                    }

                    var filePathArray = filePath.split('/');
                    var folderPathArray = filePathArray.slice(0, filePathArray.length - 1);
                    console.log('folders before:', folders);
                    var folderForFile = _this.getFolderByPath(folders, folderPathArray);
                    console.log('folders after:', folders, folderForFile);
                    folderForFile.files.push(file);
                });
            });
        }
    }, {
        key: 'getFolderByPath',
        value: function getFolderByPath(folders, folderPathArray) {
            if (folderPathArray.length === 0) {
                return this.library;
            }

            var previousFolder = this.getFolderByPath(folders, folderPathArray.slice(0, folderPathArray.length - 1));
            var folderPath = folderPathArray.join('.');
            var folder = _.get(folders, folderPath);

            if (!folder) {
                var folderName = folderPathArray[folderPathArray.length - 1];
                folder = new _Folder2.default(folderName, previousFolder);

                previousFolder.files.push(folder);
                _.set(folders, folderPath, folder);
            }

            return folder;
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
            if (!name || !name.length) {
                return false;
            }

            var newFolder = new _Folder2.default(name, this.folder);

            this.folder.files.push(newFolder);
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
            var deleteRemote = arguments.length <= 1 || arguments[1] === undefined ? true : arguments[1];

            _.remove(this.files, file);

            if (!deleteRemote) {
                return;
            }

            this.api.deleteFile(file);
        }
    }, {
        key: 'moveTo',
        value: function moveTo(folder) {
            this.moveFile(this.selected, folder);
            $('#move-modal').modal('hide');
            this.enterFolder(folder);
        }
    }, {
        key: 'moveFile',
        value: function moveFile(file, folder) {
            this.api.moveFile(file, folder.path());
            this.deleteFile(file, false); // false because we do not want to delete the remote file

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
    }, {
        key: 'canMoveOrDelete',
        value: function canMoveOrDelete() {
            if (this.selected && !this.selected.isFolder) {
                return true;
            }

            return false;
        }
    }, {
        key: 'addFolderPrompt',
        value: function addFolderPrompt() {
            var _this5 = this;

            swal({
                title: 'Enter new folder name',
                html: '<input id="new-folder-name" type="text" class="form-control">',
                confirmButtonText: 'Create folder'
            }, function () {
                var newFolderName = $('#new-folder-name').val();

                _this5.addFolder(newFolderName);
                _this5.$scope.$apply();
            });
        }
    }, {
        key: 'submitAddon',
        value: function submitAddon() {
            var addon = this.selected.addon;

            var addonModelApi = this.addonModelApi(this.selected);

            if (!addonModelApi) {
                return false;
            }

            addonModelApi.update(addon.id, _.omit(addon, ['_model', 'id']));
        }
    }, {
        key: 'addonModelApi',
        value: function addonModelApi(file) {
            var addon = file.addon;

            if (!addon || addon.length == 0) {
                return false;
            }

            return this.api.model(addon._model);
        }
    }]);

    return FileManagerController;
}();

exports.default = FileManagerController;

}, {"./File": 33, "./Folder": 36, "./categories": 37}], 35: [function (require, module, exports) {
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

            $(target).parent().find('.modal').modal();
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

                _this.filesLoaded();
            });
        }
    }, {
        key: 'selectAddonIds',
        value: function selectAddonIds() {
            return this.fileType == 'image' || this.fileType == 'video';
        }
    }, {
        key: 'filesLoaded',
        value: function filesLoaded() {
            this.selectOldValue();
        }
    }, {
        key: 'selectOldValue',
        value: function selectOldValue() {
            if (!this.value) {
                return false;
            }

            if (this.value.indexOf(',') == -1) {
                this.selectId(this.value);
                this.confirmSelected();
                return true;
            }

            var ids = this.value.split(',');
            for (var i in ids) {
                this.selectId(ids[i]);
            }

            this.confirmSelected();

            return true;
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
        key: 'selectId',
        value: function selectId(id) {
            var file = _.find(this.files, { id: parseInt(id) });

            file.selected = true;
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
            console.log(this.inputField(), this.selectedIdsString());
            this.inputField().val(this.selectedIdsString());
        }
    }, {
        key: 'selectedIdsString',
        value: function selectedIdsString() {
            var _this3 = this;

            var selected = this.selectedFiles();

            if (selected.length === 1) {
                return this.id(selected[0]);
            }

            var fileIds = [];

            selected.forEach(function (file) {
                return fileIds.push(_this3.id(file));
            });

            return fileIds.join(',');
        }
    }, {
        key: 'countSelected',
        value: function countSelected() {
            return this.selectedFiles().length;
        }
    }, {
        key: 'acquireInputValue',
        value: function acquireInputValue(value) {
            var _this4 = this;

            var values = [value];

            if (value.indexOf(',') !== -1) {
                values = value.split(',');
            }

            for (var i = 0; i < values.length; i++) {
                values[i] = parseInt(values[i], 10);
            }

            this.files.forEach(function (file) {
                if (_.contains(values, _this4.id(file))) {
                    file.selected = true;
                }
            });
        }
    }, {
        key: 'id',
        value: function id(file) {
            return this.selectAddonIds() ? file.addon.id : file.id;
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

}, {"./File": 33}], 36: [function (require, module, exports) {
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
        var skipInPath = arguments.length <= 2 || arguments[2] === undefined ? false : arguments[2];

        _classCallCheck(this, Folder);

        var _this = _possibleConstructorReturn(this, Object.getPrototypeOf(Folder).call(this, {
            id: '',
            filename: name,
            extension: '',
            url: ''
        }));

        _this.parent = parent;
        _this.skipInPath = skipInPath;
        _this.type = 'folder';
        _this.isFolder = true;
        _this.files = [];
        return _this;
    }

    _createClass(Folder, [{
        key: 'displayFolderPath',
        value: function displayFolderPath() {
            return this.path();
        }
    }, {
        key: 'path',
        value: function path() {
            if (this.skipInPath) {
                return '';
            }

            var folders = [this.name];
            var folder = this;

            while (folder.parent) {
                if (folder.parent.skipInPath) {
                    break;
                }

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

}, {"./File": 33}], 37: [function (require, module, exports) {
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

}, {"./Category": 32}], 38: [function (require, module, exports) {
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
        var droppable = attributes.mezzoDraggable;

        if (droppable === 'false') {
            return;
        }

        $(element).draggable({
            axis: 'y',
            containment: 'table',
            helper: 'clone',
            revert: true
        });
    }
}

}, {}], 39: [function (require, module, exports) {
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

}, {}], 40: [function (require, module, exports) {
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
            name: '@',
            value: '@'
        },
        controller: _FilePickerController2.default,
        controllerAs: 'vm',
        bindToController: true
    };
}

}, {"./FilePickerController": 35}], 41: [function (require, module, exports) {
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

}, {}], 42: [function (require, module, exports) {
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
    "./FileManagerController": 34,
    "./draggableDirective.js": 38,
    "./droppableDirective.js": 39,
    "./filePickerDirective": 40,
    "./filePickerValueDirective": 41
}], 43: [function (require, module, exports) {
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

}, {"./mapDirective": 44, "./mapService": 45, "./searchDirective": 46}], 44: [function (require, module, exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = mapDirective;
/*@ngInject*/
function mapDirective(mapService) {
    return {
        restrict: 'A',
        scope: {
            latitude: '@',
            longitude: '@'
        },
        link: link
    };

    function link(scope, element, attributes) {
        var actualElement = element[0];
        var map = new google.maps.Map(actualElement, {
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            zoom: 8,
            center: { lat: -33.8688, lng: 151.2195 }
        });

        setupLatitudeLongitudeWatches();

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

        function setupLatitudeLongitudeWatches() {
            var coordinates = {
                latitude: undefined,
                longitude: undefined
            };
            var latitudeName = scope.latitude;
            var longitudeName = scope.longitude;
            var $latitude = getElementByName(latitudeName);
            var $longitude = getElementByName(longitudeName);

            $latitude.on('input', onLatitudeChange);
            $longitude.on('input', onLongitudeChange);

            function onLatitudeChange(event, extraParams) {
                if (extraParams !== 'triggeredByFormDataService') {
                    return;
                }

                coordinates.latitude = $latitude.val();

                tryUpdatingMap();
            }

            function onLongitudeChange(event, extraParams) {
                if (extraParams !== 'triggeredByFormDataService') {
                    return;
                }

                coordinates.longitude = $longitude.val();

                tryUpdatingMap();
            }

            function tryUpdatingMap() {
                if (!coordinates.latitude || !coordinates.longitude) {
                    return; // Cannot update map without both coordinates
                }

                var geocoder = new google.maps.Geocoder();
                var location = {
                    location: {
                        lat: parseFloat(coordinates.latitude),
                        lng: parseFloat(coordinates.longitude)
                    }
                };

                geocoder.geocode(location, function (results, status) {
                    if (status !== google.maps.GeocoderStatus.OK || results.length === 0) {
                        return;
                    }

                    receivePlace(results[0]);
                });
            }
        }

        function getElementByName(name) {
            return $('[name="' + name + '"]');
        }
    }
}

}, {}], 45: [function (require, module, exports) {
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

}, {}], 46: [function (require, module, exports) {
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
        console.log(name, value);
        $('[name="' + name + '"]').val(value).trigger('input');
    }
}

}, {}], 47: [function (require, module, exports) {
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

}, {}], 48: [function (require, module, exports) {
'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _ResourceController2 = require('./ResourceController');

var _ResourceController3 = _interopRequireDefault(_ResourceController2);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var CreateResourceController = function (_ResourceController) {
    _inherits(CreateResourceController, _ResourceController);

    /*@ngInject*/

    function CreateResourceController($injector) {
        _classCallCheck(this, CreateResourceController);

        return _possibleConstructorReturn(this, Object.getPrototypeOf(CreateResourceController).call(this, $injector));
    }

    _createClass(CreateResourceController, [{
        key: 'init',
        value: function init(modelName) {
            this.modelName = modelName;
            this.modelApi = this.api.model(this.modelName);
        }
    }, {
        key: 'doSubmit',
        value: function doSubmit(formData) {
            var _this2 = this;

            return this.modelApi.create(formData).then(function (model) {
                _this2.edit(model.id);
                toastr.success('Success! ' + model._label + ' created');
            });
        }
    }, {
        key: 'edit',
        value: function edit(modelId) {
            this.modelStateService.name(this.modelName).id(modelId).edit();
        }
    }]);

    return CreateResourceController;
}(_ResourceController3.default);

exports.default = CreateResourceController;

}, {"./ResourceController": 53}], 49: [function (require, module, exports) {
'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _ResourceController2 = require('./ResourceController');

var _ResourceController3 = _interopRequireDefault(_ResourceController2);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var EditResourceController = function (_ResourceController) {
    _inherits(EditResourceController, _ResourceController);

    /*@ngInject*/

    function EditResourceController($injector, $scope) {
        _classCallCheck(this, EditResourceController);

        var _this = _possibleConstructorReturn(this, Object.getPrototypeOf(EditResourceController).call(this, $injector));

        _this.$scope = $scope;
        _this.$stateParams = $injector.get('$stateParams');
        _this.$rootScope = $injector.get('$rootScope');
        _this.modelId = _this.$stateParams.modelId;
        _this.content = {};

        _this.includes = ['content'];

        _this.$scope.$on('$destroy', function () {
            return _this.onDestroy();
        });
        return _this;
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
        key: 'doSubmit',
        value: function doSubmit(formData) {
            return this.modelApi.update(this.modelId, formData).then(function (model) {
                toastr.success('Success! ' + model._label + ' updated');
            });
        }
    }, {
        key: 'loadContent',
        value: function loadContent() {
            var _this2 = this;

            var params = {
                include: this.includes.join(',')
            };
            this.loading = true;

            this.modelApi.content(this.modelId, params).then(function (model) {
                _this2.contentLoaded(model);
            });
        }
    }, {
        key: 'contentLoaded',
        value: function contentLoaded(model) {
            this.initContentBlocks(model);
            this.initLockable(model);

            var cleaned = this.formDataService.transform(model);

            console.log('cleaned', cleaned);

            this.$rootScope.$broadcast('mezzo.formdata.set', {
                data: cleaned.stripped,
                flattened: cleaned.flattened,
                form: this.htmlForm()[0]
            });

            this.inputs = cleaned.flattened;
            this.loading = false;
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

                _this3.contentBlockService.addContentBlock(block.class, hash, block._label, block.id, block.options, block.sort);
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
    }]);

    return EditResourceController;
}(_ResourceController3.default);

exports.default = EditResourceController;

}, {"./ResourceController": 53}], 50: [function (require, module, exports) {
'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _get = function get(object, property, receiver) { if (object === null) object = Function.prototype; var desc = Object.getOwnPropertyDescriptor(object, property); if (desc === undefined) { var parent = Object.getPrototypeOf(object); if (parent === null) { return undefined; } else { return get(parent, property, receiver); } } else if ("value" in desc) { return desc.value; } else { var getter = desc.get; if (getter === undefined) { return undefined; } return getter.call(receiver); } };

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _EditResourceController = require('./EditResourceController');

var _EditResourceController2 = _interopRequireDefault(_EditResourceController);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var EditSubscriptionsController = function (_EditResourceControll) {
    _inherits(EditSubscriptionsController, _EditResourceControll);

    /*@ngInject*/

    function EditSubscriptionsController($injector, $scope) {
        _classCallCheck(this, EditSubscriptionsController);

        var _this = _possibleConstructorReturn(this, Object.getPrototypeOf(EditSubscriptionsController).call(this, $injector, $scope));

        _this.subscriptionsApi = _this.api.model('Subscription');
        return _this;
    }

    _createClass(EditSubscriptionsController, [{
        key: 'contentLoaded',
        value: function contentLoaded(model) {
            _get(Object.getPrototypeOf(EditSubscriptionsController.prototype), 'contentLoaded', this).call(this, model);

            this.sortSubscriptions();
        }

        /**
         * Strip the data tags and update the subscriptions on the screen.
         * @param response
         */

    }, {
        key: 'onUpdated',
        value: function onUpdated(response, request) {
            var _this2 = this;

            _get(Object.getPrototypeOf(EditSubscriptionsController.prototype), 'onUpdated', this).call(this, response, request);

            this.subscriptionsApi.index({'user': this.modelId}).then(function (response) {
                _this2.content.subscriptions = _.values(_this2.formDataService.transform(response));
                _this2.sortSubscriptions();
            });
        }
    }, {
        key: 'timeLeft',
        value: function timeLeft(subscription) {
            return this.subscribedUntilDate(subscription).fromNow();
        }
    }, {
        key: 'subscribedUntilDate',
        value: function subscribedUntilDate(subscription) {
            return moment(subscription.subscribed_until, 'DD.MM.YYYY HH:mm');
        }
    }, {
        key: 'sortSubscriptions',
        value: function sortSubscriptions() {
            var _this3 = this;

            this.content.subscriptions = _.sortBy(this.content.subscriptions, function (s) {
                return _this3.subscribedUntilDate(s).format('X');
            }).reverse();
        }
    }, {
        key: 'changeCancel',
        value: function changeCancel(subscription) {
            var cancelled = arguments.length <= 1 || arguments[1] === undefined ? 1 : arguments[1];

            this.subscriptionsApi.update(subscription.id, {
                'cancelled': cancelled
            }).then(function () {
                subscription.cancelled = cancelled;
            });
        }
    }, {
        key: 'deleteSubscription',
        value: function deleteSubscription(subscription) {
            var _this4 = this;

            this.subscriptionsApi.delete(subscription.id).then(function () {
                var index = _this4.content.subscriptions.indexOf(subscription);
                _this4.content.subscriptions.splice(index, 1);
            });
        }
    }]);

    return EditSubscriptionsController;
}(_EditResourceController2.default);

exports.default = EditSubscriptionsController;

}, {"./EditResourceController": 49}], 51: [function (require, module, exports) {
'use strict';

var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol ? "symbol" : typeof obj; };

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

Object.defineProperty(exports, "__esModule", {
    value: true
});

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var IndexResourceController = function () {

    /*@ngInject*/

    function IndexResourceController($scope, api, modelStateService, languageService) {
        _classCallCheck(this, IndexResourceController);

        this.$scope = $scope;
        this.api = api;
        this.lang = languageService;
        this.modelStateService = modelStateService;
        this.includes = [];
        this.language = languageService;
        this.models = [];
        this.modelValues = {};
        this.searchText = '';
        this.searchText = '';
        this.selectAll = false;
        this.loading = false;
        this.attributes = {};
        this.perPage = 10;
        this.currentPage = 1;
        this.pagination = {
            size: 10
        };
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

            this.attributes[name] = {name: name, type: type, order: '', filter: ''};
        }
    }, {
        key: 'attribute',
        value: function attribute(name) {
            return _.find(this.attributes, ['name', name]);
        }
    }, {
        key: 'loadModels',
        value: function loadModels() {
            var _this = this;

            var params = arguments.length <= 0 || arguments[0] === undefined ? {} : arguments[0];

            this.loading = true;
            params.include = this.includes.join(',');

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
            if (this.searchText.length > 0 || this.hasFilters()) {
                return this.search();
            }

            return this.models;
        }
    }, {
        key: 'hasFilters',
        value: function hasFilters() {
            for (var i in this.attributes) {
                if (this.attributes[i].filter != "") return true;
            }

            return false;
        }
    }, {
        key: 'getPagedModels',
        value: function getPagedModels() {
            var models = this.getModels();

            var start = (this.currentPage - 1) * this.perPage;
            var end = this.currentPage * this.perPage - 1;

            return models.slice(start, end);
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
            var values = {};

            for (var i in this.attributes) {
                var attribute = this.attributes[i];
                values[attribute.name] = this.transformModelValue(attribute, model[attribute.name]);
            }

            this.modelValues[model.id] = values;

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

            if (this.lang.has('attributes.' + attribute.name + '.' + value)) {
                return this.lang.get('attributes.' + attribute.name + '.' + value);
            }

            if (attribute.type == "boolean") {
                return this.lang.get('attributes.boolean.' + (value == "1") ? "true" : "false");
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

            var searched = this.models.filter(function (model) {
                return _this2.modelIsInSearch(model) && _this2.modelIsInFilters(model);
            });

            return searched;
        }
    }, {
        key: 'modelIsInSearch',
        value: function modelIsInSearch(model) {
            if (this.searchText.length == 0) {
                return true;
            }

            for (var key in model) {
                if (model.hasOwnProperty(key)) {
                    var value = model[key];

                    if (String(value).toLowerCase().indexOf(this.searchText.toLowerCase()) !== -1) {
                        return true;
                    }
                }
            }

            return false;
        }
    }, {
        key: 'modelIsInFilters',
        value: function modelIsInFilters(model) {
            var values = this.modelValues[model.id];

            for (var key in values) {
                var value = values[key];
                var attribute = this.attribute(key);

                if (!attribute || !attribute.filter || attribute.filter == "") continue;

                if (!value) {
                    return false;
                }

                if (String(value).toLowerCase().indexOf(attribute.filter.toLowerCase()) === -1) {
                    return false;
                }
            }

            return true;
        }
    }, {
        key: 'updateSelectAll',
        value: function updateSelectAll() {
            var _this3 = this;

            var models = this.getModelsgetModels();

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
            this.selectAll = false;

            this.modelApi.delete(model.id);

            for (var i = 0; i < this.models.length; i++) {
                if (this.models[i] === model) {
                    return this.models.splice(i, 1);
                }
            }
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
    }, {
        key: 'applyScopes',
        value: function applyScopes($event) {
            var $formInputs = $($event.target).parents('form').find(':input');
            var params = {};

            $formInputs.each(function (index, formInput) {
                var $formInput = $(formInput);
                var inputName = $formInput.attr('name');
                var inputValue = $formInput.val();

                if (!inputName || !inputValue) {
                    return;
                }

                params[inputName] = inputValue;
            });

            this.loadModels(params);
        }
    }, {
        key: 'pageChanged',
        value: function pageChanged() {
        }
    }, {
        key: 'sortIcon',
        value: function sortIcon(name) {
            switch (this.attribute(name).order) {
                case 'desc':
                    return 'fa fa-sort-desc';
                case 'asc':
                    return 'fa fa-sort-asc';
                default:
                    return 'fa fa-sort';
            }
        }
    }, {
        key: 'sortBy',
        value: function sortBy(name) {
            _.forEach(this.attributes, function (attribute) {
                if (attribute.name != name) {
                    attribute.order = '';
                }
            });

            var base = this;
            var attribute = this.attribute(name);
            attribute.order = this.nextOrderDirection(attribute.order);

            switch (attribute.order) {
                case 'desc':
                    return this.models = _.sortBy(this.getModels(), function (model) {
                        return base.sortByFunction(model, attribute);
                    }).reverse();
                case 'asc':
                    return this.models = _.sortBy(this.getModels(), function (model) {
                        return base.sortByFunction(model, attribute);
                    });
                default:
                    return this.models = _.sortBy(this.getModels(), 'id');
            }
        }
    }, {
        key: 'sortByFunction',
        value: function sortByFunction(model, attribute) {
            var value = model[attribute.name];

            if (attribute.type == "datetime") {

                if (!value || !moment(value).isValid()) return "";

                return moment(value).format('YYYY-MM-DD-HH-mm');
            }

            return String(value).toLowerCase();
        }
    }, {
        key: 'nextOrderDirection',
        value: function nextOrderDirection(orderDirection) {
            switch (orderDirection) {
                case 'desc':
                    return 'asc';
                case 'asc':
                    return '';
                default:
                    return 'desc';
            }
        }
    }]);

    return IndexResourceController;
}();

exports.default = IndexResourceController;

}, {}], 52: [function (require, module, exports) {
'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

Object.defineProperty(exports, "__esModule", {
    value: true
});

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

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

}, {}], 53: [function (require, module, exports) {
'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

Object.defineProperty(exports, "__esModule", {
    value: true
});

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

// Intended for CreateResourceController & EditResourceController

var ResourceController = function () {
    function ResourceController($injector, api, formDataService, contentBlockFactory, modelStateService, errorHandlerService) {
        _classCallCheck(this, ResourceController);

        this.$injector = $injector;
        this.api = this.$injector.get('api');
        this.formDataService = this.$injector.get('formDataService');
        this.contentBlockFactory = this.$injector.get('contentBlockFactory');
        this.contentBlockService = this.contentBlockFactory();
        this.modelStateService = this.$injector.get('modelStateService');
        this.errorHandlerService = this.$injector.get('errorHandlerService');
        this.inputs = {}; // ng-model Controller of the input fields will bind to this object
    }

    _createClass(ResourceController, [{
        key: 'hasError',
        value: function hasError(inputName) {
            var formControl = this.form[inputName];

            if (!formControl) {
                return;
            }

            var atLeastOneError = Object.keys(formControl.$error).length > 0;
            var isDirty = formControl.$dirty;

            if (atLeastOneError && isDirty) {
                return 'has-error';
            }
        }
    }, {
        key: 'catchServerSideErrors',
        value: function catchServerSideErrors(err) {
            if (!err.data || !err.data.errors) {
                this.errorHandlerService.showUnexpected(err);
                return;
            }

            var errors = err.data.errors;
            console.error(err);
            this.handleServerSideErrors(errors);
        }
    }, {
        key: 'handleServerSideErrors',
        value: function handleServerSideErrors(errors) {
            this.clearServerSideErrors();
            this.showServerSideErrors(errors);
        }
    }, {
        key: 'showServerSideErrors',
        value: function showServerSideErrors(errors) {
            var _this = this;

            _.forOwn(errors, function (value, key) {
                var formControl = _this.form[key];
                var errorMessage = value[0];

                if (formControl) {
                    _this.attachServerSideError(formControl, errorMessage);
                    return;
                }

                toastr.error(errorMessage);
            });
        }
    }, {
        key: 'clearServerSideErrors',
        value: function clearServerSideErrors() {
            this.formControls().forEach(function (formControl) {
                delete formControl.$error.mezzoServerSide;
            });
        }
    }, {
        key: 'attachServerSideError',
        value: function attachServerSideError(formControl, errorMessage) {
            formControl.$error.mezzoServerSide = errorMessage;
            formControl.$dirty = true;
        }
    }, {
        key: 'submitButtonClass',
        value: function submitButtonClass() {
            if (this.form.$invalid) {
                return 'disabled';
            }
        }
    }, {
        key: 'formControls',
        value: function formControls() {
            return _.filter(this.form, function (potentialFormControl) {
                var isFormControl = potentialFormControl && potentialFormControl.$error;

                return isFormControl;
            });
        }
    }, {
        key: 'attemptSubmit',
        value: function attemptSubmit() {
            console.info('attemptSubmit()');

            if (this.form.$invalid) {
                console.warn('attemptSubmit() failed because of an invalid form');
                this.dirtyFormControls(); // if a submit attempt failed because of an $invalid form all validation messages should be visible

                return false;
            }

            return true;
        }

        // Override this method in extending class

    }, {
        key: 'doSubmit',
        value: function doSubmit(formData) {
            console.warn('doSubmit() should be implemented by the extending class!');
            return Promise.resolve();
        }
    }, {
        key: 'submit',
        value: function submit() {
            var _this2 = this;

            console.info('submit()');

            tinyMCE.triggerSave();

            if (!this.attemptSubmit()) {
                return false;
            }

            this.loading = true;
            var formData = this.getFormData();

            console.info('doSubmit() with', formData);

            this.doSubmit(formData).then(function () {
                console.info('doSubmit().then()');

                _this2.loading = false;
            }).catch(function (err) {
                console.info('doSubmit().catch()');

                _this2.loading = false;

                _this2.catchServerSideErrors(err);
            });
        }
    }, {
        key: 'dirtyFormControls',
        value: function dirtyFormControls() {
            this.formControls().forEach(function (formControl) {
                formControl.$dirty = true;
            });
        }
    }, {
        key: 'getFormData',
        value: function getFormData() {
            var formData = {};

            this.htmlForm().find(':input[name]').each(function (index, formInput) {
                var $formInput = $(formInput);
                var name = $formInput.attr('name');
                var value = $formInput.val();

                /* Start checkbox edge case */
                // match checkbox key e.g. categories[1] or categories[10]
                var regex = /(.+)\[([0-9]+)\]/i;
                var match = name.match(regex);

                if (match) {
                    var checkboxKey = match[1];
                    var checkboxId = match[2];
                    var checkbox = _.get(formData, checkboxKey);

                    if (!_.isArray(checkbox)) {
                        checkbox = [];

                        _.set(formData, checkboxKey, checkbox);
                    }

                    if (!$formInput.prop('checked')) {
                        return;
                    }

                    checkbox.push(checkboxId);

                    return;
                }
                /* End checkbox edge case */

                _.set(formData, name, value);
            });

            return formData;
        }
    }, {
        key: 'htmlForm',
        value: function htmlForm() {
            return $('form[name="vm.form"]');
        }
    }]);

    return ResourceController;
}();

exports.default = ResourceController;

}, {}], 54: [function (require, module, exports) {
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

}, {}], 55: [function (require, module, exports) {
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
        key: 'transform',
        value: function transform(data) {
            var stripped = this.unfoldData(data);

            stripped = this.unpackRelationInputs(this.form()[0], stripped);
            stripped = this.formatTimestamps(stripped);

            //TODO: Move this into a class
            return {
                stripped: _.cloneDeep(stripped),
                flattened: this.flattenObject(_.cloneDeep(stripped))
            };
        }
    }, {
        key: 'unfoldData',
        value: function unfoldData(formData) {
            var cleaned = {};

            if (!formData || (typeof formData === 'undefined' ? 'undefined' : _typeof(formData)) !== 'object') return formData;

            if (formData.data) {
                return this.unfoldData(formData.data);
            }

            for (var i in formData) {
                cleaned[i] = this.unfoldData(formData[i]);
            }

            return cleaned;
        }
    }, {
        key: 'unpackRelationInputs',
        value: function unpackRelationInputs(form, data) {
            var clean = _.clone(data);
            $(form).find('select').each(function (id, elem) {
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

            //unpack checkboxes
            for (var i in _.clone(clean)) {
                var attribute = clean[i];

                if (!_.isObject(attribute) || !attribute[0]) continue;

                //run through the checkbox array (each relation entry)
                for (var j in attribute) {
                    var relationEntry = attribute[j];
                    var checkboxName = i + '[' + relationEntry.id + ']';
                    var selector = 'input[type=checkbox][name="' + checkboxName + '"]';

                    if ($(selector).length == 0) continue;

                    clean[checkboxName] = true;
                }
            }

            return clean;
        }
    }, {
        key: 'formatTimestamps',
        value: function formatTimestamps(formData) {
            var cleaned = {};

            //Unpack everything
            if (formData && _.isArray(formData)) {
                cleaned = [];
                for (var i in formData) {
                    cleaned[i] = this.formatTimestamps(formData[i]);
                }
                return cleaned;
            }

            if (formData && _.isObject(formData)) {
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

        // Source: https://gist.github.com/penguinboy/762197

    }, {
        key: 'flattenObject',
        value: function flattenObject(ob) {
            var toReturn = {};

            for (var i in ob) {
                if (!ob.hasOwnProperty(i)) continue;

                if (_typeof(ob[i]) == 'object') {
                    var flatObject = this.flattenObject(ob[i]);
                    for (var x in flatObject) {
                        if (!flatObject.hasOwnProperty(x)) continue;

                        toReturn[i + '.' + x] = flatObject[x];
                    }
                } else {
                    toReturn[i] = ob[i];
                }
            }
            return toReturn;
        }
    }]);

    return FormDataService;
}();

exports.default = FormDataService;

}, {}], 56: [function (require, module, exports) {
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
    "./CreateResourceController": 48,
    "./EditResourceController": 49,
    "./IndexResourceController": 51,
    "./ModelStateService": 52,
    "./ShowResourceController": 54,
    "./formDataService": 55,
    "./registerStateDirective": 57,
    "./stateProvider": 58
}], 57: [function (require, module, exports) {
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

}, {"./Action": 47}], 58: [function (require, module, exports) {
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

}, {}], 59: [function (require, module, exports) {
'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

Object.defineProperty(exports, "__esModule", {
    value: true
});

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var SubscriptionsController = function () {

    /*@ngInject*/

    function SubscriptionsController(api, $scope, $rootScope, $element) {
        _classCallCheck(this, SubscriptionsController);

        this.api = api;
        this.modelApi = api.model('Subscription');
        this.$form = $element.parents('form')[0];

        var base = this;
        $scope.$on('mezzo.formdata.set', function (event, mass) {
            base.fill(mass.data, mass.form);
        });

        $rootScope.$on('mezzo.model.update', function () {
            console.log('event', one, two, three);
        });

        $scope.$on('mezzo.model.update', function () {
            console.log('event', one, two, three);
        });
    }

    _createClass(SubscriptionsController, [{
        key: 'fill',
        value: function fill(data, form) {
            if (form != this.$form) {
                return;
            }

            this.subscriptions = data.subscriptions;

            this.sort();
        }
    }, {
        key: 'subscribedUntilString',
        value: function subscribedUntilString(subscription) {
            return this.subscribedUntilDate(subscription).format('DD.MM.YYYY HH:mm');
        }
    }, {
        key: 'isCancelled',
        value: function isCancelled(subscription) {
            return subscription.cancelled == 1;
        }
    }]);

    return SubscriptionsController;
}();

exports.default = SubscriptionsController;

}, {}], 60: [function (require, module, exports) {
'use strict';

var _subscriptionsDirective = require('./subscriptionsDirective');

var _subscriptionsDirective2 = _interopRequireDefault(_subscriptionsDirective);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var _module = angular.module('MezzoUsers', []);

_module.directive('mezzoUserSubscriptions', _subscriptionsDirective2.default);

}, {"./subscriptionsDirective": 61}], 61: [function (require, module, exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = subscriptionsDirective;

var _SubscriptionsController = require('./SubscriptionsController');

var _SubscriptionsController2 = _interopRequireDefault(_SubscriptionsController);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

/*@ngInject*/
function subscriptionsDirective() {
    return {
        restrict: 'E',
        templateUrl: '/mezzolabs/mezzo/cockpit/templates/subscriptionsDirective.html',
        scope: {
            naming: '@'
        },
        controller: _SubscriptionsController2.default,
        controllerAs: 'vm',
        bindToController: true
    };
}

}, {"./SubscriptionsController": 59}], 62: [function (require, module, exports) {
"use strict";

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = config;

var _customRoutes = require("./customRoutes");

var _customRoutes2 = _interopRequireDefault(_customRoutes);

    var _lang = require("./lang");

    var _lang2 = _interopRequireDefault(_lang);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

/*@ngInject*/
    function config($locationProvider, $httpProvider, $stateProvider, $translateProvider) {
    $httpProvider.defaults.headers.common.Accept = 'application/vnd.MezzoLabs.v1+json';

    (0, _customRoutes2.default)($stateProvider);
        (0, _lang2.default)($translateProvider);

    $locationProvider.html5Mode(true);
}

}, {"./customRoutes": 63, "./lang": 65}], 63: [function (require, module, exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = customRoutes;

var _EditSubscriptionsController = require('./../modules/resource/EditSubscriptionsController');

var _EditSubscriptionsController2 = _interopRequireDefault(_EditSubscriptionsController);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

/*@ngInject*/
function customRoutes($stateProvider) {

    $stateProvider.state('subscriptionsuser', {
        url: '/mezzo/user/user/subscriptions/:modelId',
        templateUrl: '/mezzo/user/user/subscriptions.html',
        controller: _EditSubscriptionsController2.default,
        controllerAs: 'vm'
    });
}

}, {"./../modules/resource/EditSubscriptionsController": 50}], 64: [function (require, module, exports) {
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

    $('.nav-main > li.has-pages > a span').click(function () {
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

    var noUiView = $('div[ui-view]').length === 0;

    if (noUiView) {
        console.info('Backend Rendered Page detected!');

        $('a[href]:not([data-mezzo-href-prevent])').click(function () {
            window.location.reload();
        });
    }
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

}, {}], 65: [function (require, module, exports) {
    'use strict';

    Object.defineProperty(exports, "__esModule", {
        value: true
    });
    exports.default = addTranslations;
    /*@ngInject*/
    function addTranslations($translateProvider, languageService) {

        $translateProvider.translations('de', {
            'ATTRIBUTES.GENDER': {m: 'Herr', f: 'Frau'},
            'FOO': 'Dies ist ein Absatz'
    });

        $translateProvider.preferredLanguage('de');
    }

}, {}], 66: [function (require, module, exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = run;
/*@ngInject*/
function run($rootScope) {
    showStateChangeErrors();

    function showStateChangeErrors() {
        $rootScope.$on('$stateChangeError', onStateChangeError);
    }

    function onStateChangeError(event, toState, toParams, fromState, fromParams, error) {
        console.error(event, toState, toParams, fromState, fromParams, error);

        var messageBuilder = ['<strong>Event:</strong> ' + event.name, '<strong>To state:</strong> ' + JSON.stringify(toState), '<strong>To params:</strong> ' + JSON.stringify(toParams), '<strong>From state:</strong> ' + JSON.stringify(fromState), '<strong>From params:</strong> ' + JSON.stringify(fromParams), '<strong>Error:</strong> ' + JSON.stringify(error)];
        var message = messageBuilder.join('<br>');

        swal({
            title: 'Unexpected Error :(',
            html: message,
            type: 'error'
        });
    }
}

},{}]},{},[1]);

//# sourceMappingURL=app.js.map
