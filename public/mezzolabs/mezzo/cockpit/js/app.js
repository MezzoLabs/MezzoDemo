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

var app = angular.module('Mezzo', ['ui.router', 'ui.sortable', 'ui.bootstrap', 'mezzo.ui.tinymce', 'pascalprecht.translate', 'ngMessages', 'angular-sortable-view', 'angular-loading-bar', 'ngFileUpload', 'MezzoCommon', 'MezzoResources', 'MezzoFileManager', 'MezzoEvents', 'MezzoUsers', 'MezzoContentBlocks', 'MezzoGoogleMaps']);

app.config(_config2.default);
app.run(_run2.default);

}, {
    "./common": 32,
    "./modules/contentBlocks": 44,
    "./modules/events": 48,
    "./modules/fileManager": 59,
    "./modules/googleMaps": 60,
    "./modules/resource": 73,
    "./modules/users": 79,
    "./setup/config": 80,
    "./setup/jquery": 82,
    "./setup/run": 84
}], 2: [function (require, module, exports) {
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
                message = err.statusText + '. ' + err.data.message;
            }

            if (message.indexOf('{') == -1) {
                message = this.htmlDecode(message);
            }

            console.error(err);
            sweetAlert('Oops, something spilled...', message, 'error');
            throw err;
        }
    }, {
        key: 'htmlDecode',
        value: function htmlDecode(text) {
            var doc = new DOMParser().parseFromString(text, "text/html");
            return doc.documentElement.textContent;
        }
    }]);

    return ErrorHandlerService;
    }();

exports.default = ErrorHandlerService;

},{}],3:[function(require,module,exports){
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

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

    var LanguageService = function () {
    function LanguageService($translate) {
        _classCallCheck(this, LanguageService);

        this.$translate = $translate;

        this.cache = {};

        //TODO MOVE THIS TO CONFIG
        this.lang = {
            de: {
                general: {
                    create: 'Erstellen',
                    delete: 'Löschen',
                    update: 'Editieren',
                    rename: 'Umbenennen',
                    yes: 'Ja',
                    no: 'Nein',
                    cancel: 'Abbrechen'
                },
                messages: {
                    missing_permissions: 'Sie haben nicht genügend Rechte um diese Aktion auszuführen.',
                    shure_to_delete_models: {
                        title: 'Sind Sie sich sicher?',
                        text: '{count} Ressource wird gelöscht.|{count} Ressourcen werden gelöscht.'
                    },
                    are_you_sure: {
                        title: 'Sind Sie sich sicher?',
                        text: ''
                    }
                },
                filemanager: {
                    library: 'Bibliothek',
                    item: 'Datei|Dateien',
                    order_by: 'Ordnen',
                    order_options: {
                        folders: 'Ordner',
                        title: 'Titel',
                        last_modified: 'Letzte Änderung'
                    },
                    messages: {
                        enter_folder_name: 'Neuen Ordnernamen eingeben'
                    },
                    categories: {
                        everything: 'Alles',
                        images: 'Bilder',
                        videos: 'Videos',
                        audio: 'Audio',
                        documents: 'Dokumente'
                    },
                    exists_already: 'exisitiert bereits.'
                },
                attributes: {
                    gender: {
                        m: 'Herr',
                        f: 'Frau'
                    },
                    backend: {
                        1: 'Cockpit',
                        0: 'Website'
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
            var count = arguments.length <= 1 || arguments[1] === undefined ? 1 : arguments[1];
            var vars = arguments.length <= 2 || arguments[2] === undefined ? {} : arguments[2];
            var language = arguments.length <= 3 || arguments[3] === undefined ? 'de' : arguments[3];

            var cacheKey = this.uniqueCacheKey(key, language);

            if (!this.cache[cacheKey]) {
                this.cache[cacheKey] = this.findInTree(key, language);
            }

            var string = this.amountSubstring(this.cache[cacheKey], count);

            for (var i in vars) {
                string = string.replace("{" + i + "}", vars[i]);
            }

            return string;
        }
    }, {
        key: 'amountSubstring',
        value: function amountSubstring(languageString) {
            var amount = arguments.length <= 1 || arguments[1] === undefined ? 1 : arguments[1];

            if (languageString.indexOf('|') == -1) {
                return languageString;
            }

            var substrings = languageString.split('|');

            if (amount != 1 && substrings[1]) {
                return substrings[1];
            }

            return substrings[0];
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
    }]);

    return LanguageService;
    }();

exports.default = LanguageService;

},{}],4:[function(require,module,exports){
"use strict";

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

},{}],5:[function(require,module,exports){
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

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

    var RelationInputController = function () {

    /*@ngInject*/

    function RelationInputController(api, $scope, $element, $timeout, eventDispatcher) {
        _classCallCheck(this, RelationInputController);

        this.api = api;
        this.modelApi = this.api.model(this.related);
        this.model = null;
        this.$element = $element;
        this.models = [];
        this.selected = null;
        this.modelsLoaded = false;
        this.$timeout = $timeout;
        this.uniqueKey = _.random(10000, 90000);

        this.eventDispatcher = eventDispatcher;
        this.formController = null;

        this.registerListeners();

        this.loadModels();
    }

    _createClass(RelationInputController, [{
        key: 'registerListeners',
        value: function registerListeners() {
            var _this = this;

            var formReceived = this.eventDispatcher.findInHistory('form.received');

            if (formReceived) {
                this.eventDispatcher.on('relationinput.models_loaded.' + this.uniqueKey, function (events, payloads) {
                    _this.fill(formReceived.payload.data, formReceived.form);
                });

                return;
            }

            this.eventDispatcher.on(['form.received', 'relationinput.models_loaded.' + this.uniqueKey], function (events, payloads) {
                _this.fill(payloads['form.received'].data, payloads['form.received'].form);
            });
        }
    }, {
        key: 'linked',
        value: function linked(scope, element, attrs, ctrls) {
            this.formController = ctrls;
        }
    }, {
        key: 'loadModels',
        value: function loadModels() {
            var _this2 = this;

            var params = {
                scopes: this.scopes
            };

            this.modelApi.index(params).then(function (models) {
                _this2.models = models;

                _this2.modelsLoaded = true;

                _this2.eventDispatcher.makeAndFire('relationinput.models_loaded.' + _this2.uniqueKey, { 'models': models });
            });
        }
    }, {
        key: 'fill',
        value: function fill(data, form) {
            var _this3 = this;

            if (!this.modelsLoaded) {
                console.error('fill without models loaded');
            }

            if (form != this.formController) return false;

            this.selected = _.get(data, this.$element.attr('name'));

            var htmlValue = _.clone(this.selected);

            this.$timeout(function () {
                if (htmlValue && _.isObject(htmlValue) && typeof htmlValue['id'] == 'undefined') {
                    htmlValue = _.map(htmlValue, 'id');
                }

                $(_this3.$element).val(htmlValue).trigger('change', { 'filledFromApi': true }).blur();
            });
        }
    }]);

    return RelationInputController;
    }();

exports.default = RelationInputController;

},{}],6:[function(require,module,exports){
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

var _ModelApi = require('./ModelApi');

var _ModelApi2 = _interopRequireDefault(_ModelApi);

var _RelationApi = require('./RelationApi');

var _RelationApi2 = _interopRequireDefault(_RelationApi);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

    var Api = function () {

    /** @ngInject */

    function Api($http, eventDispatcher) {
        _classCallCheck(this, Api);

        this.$http = $http;
        this.eventDispatcher = eventDispatcher;
        this.latestResponse = null;
    }

    _createClass(Api, [{
        key: 'get',
        value: function get(url) {
            var params = arguments.length <= 1 || arguments[1] === undefined ? {} : arguments[1];
            var options = arguments.length <= 2 || arguments[2] === undefined ? {} : arguments[2];

            var config = {
                params: params
            };

            return this.apiPromise(this.$http.get(url, config), options);
        }
    }, {
        key: 'post',
        value: function post(url, data) {
            var config = arguments.length <= 2 || arguments[2] === undefined ? {} : arguments[2];

            return this.apiPromise(this.$http.post(url, data, config));
        }
    }, {
        key: 'put',
        value: function put(url, data) {
            var config = arguments.length <= 2 || arguments[2] === undefined ? {} : arguments[2];

            return this.apiPromise(this.$http.put(url, data, config));
        }
    }, {
        key: 'delete',
        value: function _delete(url) {
            return this.apiPromise(this.$http.delete(url));
        }
    }, {
        key: 'model',
        value: function model(modelName) {
            return new _ModelApi2.default(this, modelName, this.eventDispatcher);
        }
    }, {
        key: 'relation',
        value: function relation(modelName, relationName) {
            return new _RelationApi2.default(this, modelName, relationName, this.eventDispatcher);
        }
    }, {
        key: 'apiPromise',
        value: function apiPromise($httpPromise) {
            var _this = this;

            var options = arguments.length <= 1 || arguments[1] === undefined ? {} : arguments[1];

            return $httpPromise.then(function (response) {

                _this.latestResponse = response;

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
        key: 'renameFile',
        value: function renameFile(file) {
            var payload = {
                title: file.title,
                filename: file.name
            };

            return this.put('/api/files/' + file.id, payload).catch(function (err) {
                if (err.data) {
                    return swal(err.data.status_code.toString(), err.data.message, 'error');
                }
            });
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

},{"./ModelApi":8,"./RelationApi":9}],7:[function(require,module,exports){
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

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

    var HttpRequestTrackerService = function () {
    function HttpRequestTrackerService($rootScope) {
        var _this = this;

        _classCallCheck(this, HttpRequestTrackerService);

        this.busy = false;

        $rootScope.$on('http:loading:progress', function () {
            _this.setBusy(true);
        });

        $rootScope.$on('http:loading:finish', function () {
            _this.setBusy(false);
        });
    }

    _createClass(HttpRequestTrackerService, [{
        key: 'setBusy',
        value: function setBusy(isBusy) {
            this.busy = isBusy;
        }
    }, {
        key: 'isBusy',
        value: function isBusy() {
            return this.busy;
        }
    }]);

    return HttpRequestTrackerService;
    }();

exports.default = HttpRequestTrackerService;

},{}],8:[function(require,module,exports){
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

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

    var ModelApi = function () {
    function ModelApi(api, modelName, eventDispatcher) {
        _classCallCheck(this, ModelApi);

        this.api = api;
        this.modelName = modelName;

        this.modelPlural = _.kebabCase(pluralize(this.modelName));
        this.apiUrl = '/api/' + this.modelPlural;
        this.eventDispatcher = eventDispatcher;
    }

    _createClass(ModelApi, [{
        key: 'index',
        value: function index() {
            var params = arguments.length <= 0 || arguments[0] === undefined ? {} : arguments[0];
            var options = arguments.length <= 1 || arguments[1] === undefined ? {} : arguments[1];

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
            var config = arguments.length <= 2 || arguments[2] === undefined ? {} : arguments[2];

            this.throwEvent('update', { data: formData, id: modelId });

            var request = this.api.put(this.apiUrl + '/' + modelId, formData, config);
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

            this.eventDispatcher.makeAndFire('model.' + name, payload);
        }
    }, {
        key: 'latestResponse',
        value: function latestResponse() {
            return this.api.latestResponse;
        }
    }]);

    return ModelApi;
    }();

exports.default = ModelApi;

},{}],9:[function(require,module,exports){
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

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

    var ModelApi = function () {
    function ModelApi(api, modelName, relationName, eventDispatcher) {
        _classCallCheck(this, ModelApi);

        this.api = api;
        this.modelName = modelName;
        this.relationName = relationName;

        this.modelPlural = _.kebabCase(pluralize(this.modelName));
        this.modelUri = '/api/' + this.modelPlural;
        this.eventDispatcher = eventDispatcher;
    }

    _createClass(ModelApi, [{
        key: 'index',
        value: function index(modelId) {
            var params = arguments.length <= 1 || arguments[1] === undefined ? { 'sort': '-id' } : arguments[1];
            var options = arguments.length <= 2 || arguments[2] === undefined ? {} : arguments[2];

            return this.api.get(this.modelUri + '/' + modelId + '/' + this.relationName, params);
        }
    }]);

    return ModelApi;
    }();

exports.default = ModelApi;

},{}],10:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
    exports.default = apiActionDirective;
    /*@ngInject*/
    function apiActionDirective(api, errorHandlerService, languageService) {
        return {
            restrict: 'A',
            link: link
        };

        function link(scope, element, attributes) {
            var uri = attributes.href;
            var parameters = JSON.parse(attributes.parameters);

            console.log(element);

            //TODO:
            $(element).click(function ($event) {
                $event.preventDefault();

                if (attributes.needsConfirmation == "1") {
                    return showConfirmation(function () {
                        sendAction(uri, parameters);
                    });
            }

                sendAction(uri, parameters);
            });
        }

        function showConfirmation(callback) {
            swal({
                title: languageService.get('messages.are_you_sure.title'),
                text: '',
                type: "warning",
                showCancelButton: true,
                confirmButtonText: languageService.get('general.yes'),
                cancelButtonText: languageService.get('general.cancel'),
                closeOnConfirm: false
            }, function () {
                callback();
            });
        }

        function sendAction(uri, parameters) {
            return api.get(uri, parameters).then(function (result) {
                return showResult(result);
            }).catch(function (err) {
                return errorHandlerService.showUnexpected(err);
            });
        }

        function showResult(result) {
            if (result.message && result.title) {
                console.log('result');
                swal(result.title, result.message, 'success');
                return;
        }

            alert('Unexpected action result!');
        }
    };

}, {}], 11: [function (require, module, exports) {
    'use strict';

    Object.defineProperty(exports, "__esModule", {
        value: true
    });
exports.default = apiService;

var _Api = require('./Api');

var _Api2 = _interopRequireDefault(_Api);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

/*@ngInject*/
function apiService($http, eventDispatcher) {
    return new _Api2.default($http, eventDispatcher);
}

}, {"./Api": 6}], 12: [function (require, module, exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

exports.default = function ($q, $rootScope, $log) {
    var loadingCount = 0;

    return {
        request: function request(config) {
            if (++loadingCount === 1) $rootScope.$broadcast('http:loading:progress');
            return config || $q.when(config);
        },

        response: function response(_response) {
            if (--loadingCount === 0) $rootScope.$broadcast('http:loading:finish');
            return _response || $q.when(_response);
        },

        responseError: function responseError(response) {
            if (--loadingCount === 0) $rootScope.$broadcast('http:loading:finish');
            return $q.reject(response);
        }
    };
};

}, {}], 13: [function (require, module, exports) {
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

}, {}], 14: [function (require, module, exports) {
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

}, {}], 15: [function (require, module, exports) {
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

}, {}], 16: [function (require, module, exports) {
"use strict";

Object.defineProperty(exports, "__esModule", {
    value: true
});

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var Event = function Event(key, payload) {
    _classCallCheck(this, Event);

    this.key = key;
    this.payload = payload;
};

exports.default = Event;

}, {}], 17: [function (require, module, exports) {
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

var _Listener = require('./Listener');

var _Listener2 = _interopRequireDefault(_Listener);

var _Event = require('./Event');

var _Event2 = _interopRequireDefault(_Event);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

    var EventDispatcherService = function () {
    function EventDispatcherService($rootScope) {
        var _this = this;

        _classCallCheck(this, EventDispatcherService);

        this.listeners = [];
        this.eventHistory = [];

        this.$rootScope = $rootScope;

        this.$rootScope.$on('$stateChangeStart', function (event, toState, toParams, fromState, fromParams, options) {
            _this.clear();
        });
    }

    /**
     * Execute all the listeners that listen to this event.
     *
     * @param {MezzoEvent} event
     */

    _createClass(EventDispatcherService, [{
        key: 'fire',
        value: function fire(event) {
            this.eventHistory.push(event);

            for (var i in this.listeners) {
                var listener = this.listeners[i];

                if (!listener.listensTo(event)) {
                    continue;
                }

                var execution = listener.execute(event, event.payload);

                if (execution === false) {
                    console.error('A listener stopped the chain', listener, event);
                    return false;
                }
            }

            return true;
        }

        /**
         * Register a new listener
         *
         * @param {Listener} listener
         */

    }, {
        key: 'listen',
        value: function listen(listener) {
            this.listeners.push(listener);
        }

        /**
         * Alias for this.listen
         *
         * @param {Listener} listener
         */

    }, {
        key: 'register',
        value: function register(listener) {
            this.listen(listener);
        }

        /**
         * Creates and registers a new listener.
         *
         * @param {string} eventKey
         * @param callback
         * @returns {Listener}
         */

    }, {
        key: 'makeListener',
        value: function makeListener(eventKey, callback) {
            var listener = new _Listener2.default(eventKey, callback);

            this.listen(listener);

            return listener;
        }

        /**
         * Creates an event and fires it directly.
         *
         *
         * @param eventKey
         * @param payload
         */

    }, {
        key: 'makeAndFire',
        value: function makeAndFire(eventKey, payload) {
            var event = new _Event2.default(eventKey, payload);

            return this.fire(event);
        }

        /**
         * Alias for makelistener
         *
         *
         * @param eventKey
         * @param callback
         * @returns {Listener}
         */

    }, {
        key: 'on',
        value: function on(eventKey, callback) {
            if (Array.isArray(eventKey)) return this.listenForAll(eventKey, callback);

            return this.makeListener(eventKey, callback);
        }
    }, {
        key: 'listenForAll',
        value: function listenForAll(eventKeys, callback) {
            var _this2 = this;

            var received = {};
            var payloads = {};
            var events = {};

            var _loop = function _loop() {
                var eventKey = eventKeys[i];
                _this2.makeListener(eventKey, function (event, payload) {
                    received[event.key] = 1;
                    payloads[eventKey] = payload;
                    events[eventKey] = event;

                    if (_.size(received) == eventKeys.length) {
                        callback(events, payloads);
                    }
                });
            };

            for (var i in eventKeys) {
                _loop();
            }
        }
    }, {
        key: 'findInHistory',
        value: function findInHistory(eventKey) {
            return _.find(this.eventHistory, function (event) {
                return event.key == eventKey;
            });
        }
    }, {
        key: 'getOrListenFor',
        value: function getOrListenFor(eventKey, callback) {
            var inHistory = this.findInHistory(eventKey);
            if (inHistory) {
                return callback(inHistory);
            }

            this.on(eventKey, callback);
        }
    }, {
        key: 'isInHistory',
        value: function isInHistory(eventKey) {
            return !!this.findInHistory(eventKey);
        }
    }, {
        key: 'clear',
        value: function clear() {
            for (var i in this.listeners) {
                delete this.listeners[i];
            }

            for (var j in this.eventHistory) {
                delete this.eventHistory[j];
            }

            this.listeners = [];
            this.eventHistory = [];
        }
    }]);

    return EventDispatcherService;
    }();

exports.default = EventDispatcherService;

}, {"./Event": 16, "./Listener": 18}], 18: [function (require, module, exports) {
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

var _Event = require('./Event');

var _Event2 = _interopRequireDefault(_Event);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

    var Listener = function () {
    function Listener(eventKey, callback) {
        _classCallCheck(this, Listener);

        this.eventKey = eventKey;
        this.callback = callback;
    }

    /**
     * Check if this listener belongs to a certain event.
     *
     * @param event
     * @returns {boolean}
     */

    _createClass(Listener, [{
        key: 'listensTo',
        value: function listensTo(event) {
            return event.key == this.eventKey;
        }

        /**
         * Run the callback with the payload given in the fired event.
         *
         * @param {Event} event
         * @param {object} payload
         */

    }, {
        key: 'execute',
        value: function execute(event, payload) {
            return this.callback(event, payload);
        }
    }]);

    return Listener;
    }();

exports.default = Listener;

}, {"./Event": 16}], 19: [function (require, module, exports) {
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

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

    var FormDataReader = function () {
    function FormDataReader() {
        _classCallCheck(this, FormDataReader);
    }

    _createClass(FormDataReader, [{
        key: 'read',
        value: function read(form) {
            var formData = {};

            var $form = $(form);

            $form.find(':input[name]').each(function (index, formInput) {
                //TODO Move to own function (each edge case gets one)
                var $formInput = $(formInput);
                var name = $formInput.attr('name');
                var value = $formInput.val();

                if ($formInput.is('input[type=radio]')) {
                    if (!$formInput.prop('checked')) {
                        return;
                    }
                }

                /* Start checkbox edge case */
                // match checkbox key e.g. categories[1] or categories[10]
                var regex = /(.+)\[([0-9]+)\]/i;
                var match = name.match(regex);

                if (match && $formInput.is('input[type=checkbox]')) {
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

                if ($formInput.is('input[type=checkbox]')) {
                    _.set(formData, name, $formInput.prop('checked') ? 1 : 0);
                    return;
                }
                /* End checkbox edge case */

                _.set(formData, name, value);
            });

            return formData;
        }
    }]);

    return FormDataReader;
    }();

exports.default = FormDataReader;

}, {}], 20: [function (require, module, exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _Event = require('./../events/Event');

var _Event2 = _interopRequireDefault(_Event);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

    var FormEvent = function (_MezzoEvent) {
    _inherits(FormEvent, _MezzoEvent);

    function FormEvent(key, payload, form) {
        _classCallCheck(this, FormEvent);

        var _this = _possibleConstructorReturn(this, Object.getPrototypeOf(FormEvent).call(this, key, payload));

        _this.form = form;
        return _this;
    }

    return FormEvent;
    }(_Event2.default);

exports.default = FormEvent;

}, {"./../events/Event": 16}], 21: [function (require, module, exports) {
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

var _Listener = require('./../events/Listener');

var _Listener2 = _interopRequireDefault(_Listener);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

    var FormEventListener = function (_EventListener) {
    _inherits(FormEventListener, _EventListener);

    function FormEventListener(eventKey, callback, form) {
        _classCallCheck(this, FormEventListener);

        var _this = _possibleConstructorReturn(this, Object.getPrototypeOf(FormEventListener).call(this, eventKey, callback));

        _this.form = form;

        return _this;
    }

    /**
     * Check if this listener belongs to a certain event and the according form.
     *
     * @param event
     * @returns {boolean}
     */

    _createClass(FormEventListener, [{
        key: 'listensTo',
        value: function listensTo(event) {
            return event.key == this.eventKey && event.form == this.form;
        }
    }]);

    return FormEventListener;
    }(_Listener2.default);

exports.default = FormEventListener;

}, {"./../events/Listener": 18}], 22: [function (require, module, exports) {
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

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

    var FormInputService = function () {
    function FormInputService() {
        _classCallCheck(this, FormInputService);
    }

    _createClass(FormInputService, [{
        key: 'getFormInputByElement',

        // We need to wait until the name of the input name has been interpolated by Sir Angular
        value: function getFormInputByElement(inputElement, scope, formController) {
            return new Promise(function (resolve, reject) {
                var destroyNameWatch = scope.$watch(function () {
                    return inputElement.attr('name');
                }, onInputNameChange);

                function onInputNameChange(newName, oldName) {
                    var formInput = formController[newName];

                    if (!formInput) {
                        return;
                    }

                    destroyNameWatch();

                    return resolve(formInput);
                }
            });
        }
    }]);

    return FormInputService;
    }();

exports.default = FormInputService;

}, {}], 23: [function (require, module, exports) {
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

var _FormEvent = require('./FormEvent');

var _FormEvent2 = _interopRequireDefault(_FormEvent);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

    var FormObject = function () {
    function FormObject(form, formController) {
        _classCallCheck(this, FormObject);

        if (!formController) {
            alert('Invalid form controller.');
            console.error(form, formController);
        }

        this.form = form;
        this.controller = formController;
    }

    _createClass(FormObject, [{
        key: 'controls',
        value: function controls() {
            return _.filter(this.controller, function (potentialFormControl) {
                var isFormControl = potentialFormControl && potentialFormControl.$error;

                return isFormControl;
            });
        }
    }, {
        key: 'dirtyControls',
        value: function dirtyControls() {
            this.controls().forEach(function (formControl) {
                formControl.$dirty = true;
            });
        }
    }, {
        key: 'submitButtonClass',
        value: function submitButtonClass() {
            if (this.controller && this.controller.$invalid) {
                return 'disabled';
            }

            return '';
        }
    }, {
        key: 'showServerSideErrors',
        value: function showServerSideErrors(errors) {
            var _this = this;

            _.forOwn(errors, function (value, key) {
                var formControl = _this.controller[key];
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
            this.controls().forEach(function (formControl) {
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
        key: 'isInvalid',
        value: function isInvalid() {
            return this.controller.$invalid;
        }
    }, {
        key: 'fire',
        value: function fire(eventDispatcher, name, data) {
            if (!this.form) {
                alert('Cannot fire event without form.');
                console.error('No form given', this);
                return;
            }

            return eventDispatcher.fire(new _FormEvent2.default(name, data, angular.element(this.form)[0]));
        }
    }, {
        key: 'focusFirstInvalidInput',
        value: function focusFirstInvalidInput() {
            var invalidInput = $(this.form).find(':input[name].ng-invalid').first();
            var tabPane = invalidInput.parents('div.tab-pane').first();

            if (!tabPane.length) {
                // Input is not within a tab, we can focus it now!
                invalidInput.focus();
                return;
            }

            var tabId = tabPane.attr('id');
            var tabLinkSelector = 'a[data-target="#' + tabId + '"]';
            var tabLink = $(tabLinkSelector);

            tabLink.tab('show');
            invalidInput.focus();
        }
    }]);

    return FormObject;
    }();

exports.default = FormObject;

}, {"./FormEvent": 20}], 24: [function (require, module, exports) {
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

var _FormDataReader = require('./FormDataReader');

var _FormDataReader2 = _interopRequireDefault(_FormDataReader);

var _FormObject = require('./FormObject');

var _FormObject2 = _interopRequireDefault(_FormObject);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

    var FormSubmitter = function () {
    function FormSubmitter(controller, $injector) {
        _classCallCheck(this, FormSubmitter);

        this.pageController = controller;
        this.isBusy = false;
        this.formObject = null;
        this.reader = new _FormDataReader2.default();
        this.eventDispatcher = $injector.get('eventDispatcher');
        this.errorHandlerService = $injector.get('errorHandlerService');
    }

    _createClass(FormSubmitter, [{
        key: 'run',
        value: function run(form, formController, mergeOptions) {
            var _this = this;

            var options = this.options = _.merge({
                doSubmit: this.pageController.doSubmit
            }, mergeOptions);

            if (this.isBusy) {
                console.error('Resource controller is still busy. Cannot submit at the moment.');
                return false;
            }

            this.setForm(form, formController);

            this.isBusy = true;

            console.info('submit()');

            tinyMCE.triggerSave();

            if (!this.attemptSubmit()) {
                this.formObject.focusFirstInvalidInput();
                this.unsetForm();
                return false;
            }

            this.loading = true;

            var formData = this.getData(form);

            this.fireEvent('form.submitting', { data: formData, form: form });

            options.doSubmit(formData).then(function (response) {
                console.info('doSubmit().then()');
            }).catch(function (err) {
                console.info('doSubmit().catch()');
                _this.catchServerSideErrors(err);
                _this.fireEvent('form.submitted', { data: formData, form: form });
            }).finally(function () {
                _this.loading = false;
                _this.unsetForm();
            });
        }
    }, {
        key: 'catchServerSideErrors',
        value: function catchServerSideErrors(err) {
            if (!err.data || !err.data.errors) {
                this.errorHandlerService.showUnexpected(err);
                return;
            }

            var errors = err.data.errors;
            console.warn('Server side error', err);
            this.handleServerSideErrors(errors);
        }
    }, {
        key: 'handleServerSideErrors',
        value: function handleServerSideErrors(errors) {
            this.clearServerSideErrors();
            this.showServerSideErrors(errors);
        }
    }, {
        key: 'clearServerSideErrors',
        value: function clearServerSideErrors() {
            return this.formObject.clearServerSideErrors();
        }
    }, {
        key: 'showServerSideErrors',
        value: function showServerSideErrors(errors) {
            return this.formObject.showServerSideErrors(errors);
        }
    }, {
        key: 'attemptSubmit',
        value: function attemptSubmit() {
            if (this.formObject.isInvalid()) {
                console.warn('attemptSubmit() failed because of an invalid form', this.formObject);
                this.formObject.dirtyControls(); // if a submit attempt failed because of an $invalid form all validation messages should be visible

                return false;
            }

            return true;
        }
    }, {
        key: 'controls',
        value: function controls() {
            return this.formObject.controls();
        }
    }, {
        key: 'fireEvent',
        value: function fireEvent(name, data) {
            this.formObject.fire(this.eventDispatcher, name, data);
        }
    }, {
        key: 'setForm',
        value: function setForm(form, formController) {
            this.formObject = new _FormObject2.default(form, formController);
        }
    }, {
        key: 'unsetForm',
        value: function unsetForm() {
            this.isBusy = false;
            this.formObject = null;
        }
    }, {
        key: 'getData',
        value: function getData(form) {
            return this.reader.read(form);
        }
    }]);

    return FormSubmitter;
    }();

exports.default = FormSubmitter;

}, {"./FormDataReader": 19, "./FormObject": 23}], 25: [function (require, module, exports) {
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
            var validationMessagesTemplate = '<mezzo-validation-messages></mezzo-validation-messages>';
            var ngModel = 'vm.inputs[\'' + nameAttribute + '\']';

            this.addModelConnection($formInput, ngModel);

            $formInput.not('[readonly],[disabled]').attr('ng-disabled', 'vm.loading');

            if ($formGroup.find('mezzo-validation-messages').length == 0) {
                $formGroup
                //.attr('ng-class', `vm.hasError('${ nameAttribute }')`)
                .attr('mezzo-has-error', '').append(validationMessagesTemplate);
            }

            var isSelect = $formInput.is('select');

            if (isSelect) {
                var firstOption = $formInput.children(':first');

                if (firstOption.length) {
                    var selectDefaultValue = firstOption.val();

                    $formInput.attr('ng-init', ngModel + (' = \'' + selectDefaultValue + '\''));
                }
            }
        }
    }, {
        key: 'addModelConnection',
        value: function addModelConnection($formInput, ngModelValue) {
            if ($formInput.is('[type=checkbox],[type=radio]')) {
                if ($formInput.attr('ng-checked')) return false;

                return $formInput.attr('ng-checked', ngModelValue);
            }

            if ($formInput.attr('ng-model')) return false;

            return $formInput.attr('ng-model', ngModelValue);
        }
    }]);

    return FormValidationService;
    }();

exports.default = FormValidationService;

}, {}], 26: [function (require, module, exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = formValidationDirective;
/*@ngInject*/
function formValidationDirective(formValidationService, eventDispatcher, $compile) {
    return {
        restrict: 'A',
        compile: compile
    };

    function compile(element) {
        eventDispatcher.on('form.received', function (event, payload) {
            setTimeout(function () {
                assignTo($(element));
            }, 1);
        });

        assignTo($(element));
    }

    function assignTo(formElement) {
        $(formElement).find(':input').each(function (index, formInput) {
            formValidationService.assign(formInput);
        });
    }
}

}, {}], 27: [function (require, module, exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = hasErrorDirective;
/*@ngInject*/
function hasErrorDirective(formInputService) {
    return {
        restrict: 'A',
        require: '^form',
        link: link
    };

    function link(scope, element, attributes, formController) {
        var inputElement = findInputWithinElement(element);

        if (!inputElement.length) {
            console.warn('Mezzo has error directive is unable to find input with a name within its children!', element);
            return;
        }

        formInputService.getFormInputByElement(inputElement, scope, formController).then(function (formInput) {
            scope.$watch(function () {
                return formInput.$valid;
            }, onFormInputChange);
            scope.$watch(function () {
                return formInput.$dirty;
            }, onFormInputChange);

            function onFormInputChange() {
                var isDirty = formInput.$dirty;
                var isValid = formInput.$valid;

                if (!isDirty) {
                    return;
                }

                $(element).toggleClass('has-error', !isValid);
            }
        }).catch(function (err) {
            return console.error(err);
        });

        function findInputWithinElement(element) {
            return $(element).children(':input[name]').first();
        }
    }
}

}, {}], 28: [function (require, module, exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = globalSearchDirective;
/*@ngInject*/
function globalSearchDirective() {
    return {
        restrict: 'A',
        link: link
    };

    function link(scope, element, attributes) {
        scope.foo = "hello";

        scope.active = false;

        scope.activeClass = function () {
            return scope.active ? 'active' : '';
        };

        scope.toggleActive = function () {
            scope.active = !scope.active;
        };

        scope.queryChanged = function () {
            var query = scope.query;

            var result = search(query);

            if (result) {
                scope.showModal();
            }
        };

        scope.showModal = function () {
            $('#global-search__modal').modal();
        };
    }

    function search(query) {
        if (query.length < 3) return false;

        return true;
    }
}

}, {}], 29: [function (require, module, exports) {
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

}, {}], 30: [function (require, module, exports) {
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

}, {}], 31: [function (require, module, exports) {
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
            $event.stopPropagation();
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

}, {}], 32: [function (require, module, exports) {
'use strict';

var _compileDirective = require('./compileDirective');

var _compileDirective2 = _interopRequireDefault(_compileDirective);

var _enterDirective = require('./enterDirective.js');

var _enterDirective2 = _interopRequireDefault(_enterDirective);

var _relationInputDirective = require('./relationInputDirective');

var _relationInputDirective2 = _interopRequireDefault(_relationInputDirective);

    var _relationOutputDirective = require('./relations/relationOutputDirective');

    var _relationOutputDirective2 = _interopRequireDefault(_relationOutputDirective);

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

var _formValidationDirective = require('./forms/formValidationDirective');

var _formValidationDirective2 = _interopRequireDefault(_formValidationDirective);

var _validationMessagesDirective = require('./validationMessagesDirective');

var _validationMessagesDirective2 = _interopRequireDefault(_validationMessagesDirective);

var _globalSearchDirective = require('./globalsearch/globalSearchDirective');

var _globalSearchDirective2 = _interopRequireDefault(_globalSearchDirective);

var _hasErrorDirective = require('./forms/hasErrorDirective');

var _hasErrorDirective2 = _interopRequireDefault(_hasErrorDirective);

var _uidService = require('./uidService.js');

var _uidService2 = _interopRequireDefault(_uidService);

var _apiService = require('./api/apiService');

var _apiService2 = _interopRequireDefault(_apiService);

var _hasControllerService = require('./hasControllerService');

var _hasControllerService2 = _interopRequireDefault(_hasControllerService);

var _QuickviewService = require('./QuickviewService');

var _QuickviewService2 = _interopRequireDefault(_QuickviewService);

var _FormValidationService = require('./forms/FormValidationService');

var _FormValidationService2 = _interopRequireDefault(_FormValidationService);

var _LanguageService = require('./LanguageService');

var _LanguageService2 = _interopRequireDefault(_LanguageService);

var _ErrorHandlerService = require('./ErrorHandlerService');

var _ErrorHandlerService2 = _interopRequireDefault(_ErrorHandlerService);

var _EventDispatcherService = require('./events/EventDispatcherService');

var _EventDispatcherService2 = _interopRequireDefault(_EventDispatcherService);

var _httpInterceptorFactory = require('./api/httpInterceptorFactory');

var _httpInterceptorFactory2 = _interopRequireDefault(_httpInterceptorFactory);

var _HttpRequestTrackerService = require('./api/HttpRequestTrackerService');

var _HttpRequestTrackerService2 = _interopRequireDefault(_HttpRequestTrackerService);

var _FormInputService = require('./forms/FormInputService');

var _FormInputService2 = _interopRequireDefault(_FormInputService);

    var _apiActionDirective = require('./api/action/apiActionDirective');

    var _apiActionDirective2 = _interopRequireDefault(_apiActionDirective);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var _module = angular.module('MezzoCommon', []);

_module.directive('mezzoCompile', _compileDirective2.default);
_module.directive('mezzoEnter', _enterDirective2.default);
_module.directive('mezzoRelationInput', _relationInputDirective2.default);
    _module.directive('mezzoRelationOutput', _relationOutputDirective2.default);
_module.directive('mezzoHrefReload', _hrefReloadDirective2.default);
_module.directive('mezzoHrefPrevent', _hrefPreventDirective2.default);
_module.directive('mezzoSelect2', _select2Directive2.default);
_module.directive('mezzoRichtext', _tinymceDirective2.default);
_module.directive('mezzoDatetimepicker', _dateTimePickerDirective2.default);
_module.directive('mezzoQuickview', _quickviewDirective2.default);
_module.directive('mezzoQuickviewClose', _quickviewCloseDirective2.default);
_module.directive('mezzoFormValidation', _formValidationDirective2.default);
_module.directive('mezzoValidationMessages', _validationMessagesDirective2.default);
_module.directive('mezzoGlobalsearch', _globalSearchDirective2.default);
_module.directive('mezzoHasError', _hasErrorDirective2.default);
    _module.directive('mezzoApiAction', _apiActionDirective2.default);
_module.factory('uid', _uidService2.default);
_module.factory('api', _apiService2.default);
_module.factory('hasController', _hasControllerService2.default);
_module.service('quickviewService', _QuickviewService2.default);
_module.service('formValidationService', _FormValidationService2.default);
_module.service('errorHandlerService', _ErrorHandlerService2.default);
_module.service('languageService', _LanguageService2.default);
_module.service('eventDispatcher', _EventDispatcherService2.default);
_module.factory('httpInterceptor', _httpInterceptorFactory2.default).config(function ($httpProvider) {
    $httpProvider.interceptors.push('httpInterceptor');
});
_module.service('HttpRequestTracker', _HttpRequestTrackerService2.default);
_module.service('formInputService', _FormInputService2.default);

}, {
    "./ErrorHandlerService": 2,
    "./LanguageService": 3,
    "./QuickviewService": 4,
    "./api/HttpRequestTrackerService": 7,
    "./api/action/apiActionDirective": 10,
    "./api/apiService": 11,
    "./api/httpInterceptorFactory": 12,
    "./compileDirective": 13,
    "./dateTimePickerDirective": 14,
    "./enterDirective.js": 15,
    "./events/EventDispatcherService": 17,
    "./forms/FormInputService": 22,
    "./forms/FormValidationService": 25,
    "./forms/formValidationDirective": 26,
    "./forms/hasErrorDirective": 27,
    "./globalsearch/globalSearchDirective": 28,
    "./hasControllerService": 29,
    "./hrefPreventDirective": 30,
    "./hrefReloadDirective": 31,
    "./quickviewCloseDirective": 33,
    "./quickviewDirective": 34,
    "./relationInputDirective": 35,
    "./relations/relationOutputDirective": 37,
    "./select2Directive": 38,
    "./tinymceDirective": 39,
    "./uidService.js": 40,
    "./validationMessagesDirective": 41
}], 33: [function (require, module, exports) {
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

}, {}], 34: [function (require, module, exports) {
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

}, {}], 35: [function (require, module, exports) {
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
        require: "^form",
        controller: _RelationInputController2.default,
        controllerAs: 'vm',
        bindToController: true,
        link: function link(scope, element, attrs, ctrls) {
            scope.vm.linked(scope, element, attrs, ctrls);
        }
    };
}

}, {"./RelationInputController": 5}], 36: [function (require, module, exports) {
    "use strict";

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

    var RelationOutputController = function () {
        function RelationOutputController($scope, eventDispatcher) {
            _classCallCheck(this, RelationOutputController);

            this.$scope = $scope;
            this.eventDispatcher = eventDispatcher;

            this.items = {};
            this.searchText = "";

            this.setListeners();
        }

        _createClass(RelationOutputController, [{
            key: "setListeners",
            value: function setListeners() {
                var _this = this;

                this.eventDispatcher.getOrListenFor('form.received', function (event) {
                    _this.fillItems(event.payload.data[_this.naming]);
                });
        }
        }, {
            key: "fillItems",
            value: function fillItems(items) {
                this.items = items;
            }
        }, {
            key: "filteredItems",
            value: function filteredItems() {
                var _this2 = this;

                return _.filter(this.items, function (item) {
                    return _this2.itemIsInSearch(item);
                });
            }
        }, {
            key: "itemIsInSearch",
            value: function itemIsInSearch(item) {
                if (this.searchText.length == 0) {
                    return true;
            }

                for (var key in item) {
                    if (item.hasOwnProperty(key)) {
                        var value = item[key];

                        if (String(value).toLowerCase().indexOf(this.searchText.toLowerCase()) !== -1) {
                            return true;
                    }
                }
            }

                return false;
            }
        }]);

        return RelationOutputController;
    }();

    exports.default = RelationOutputController;

}, {}], 37: [function (require, module, exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
    exports.default = relationInputDirective;

    var _RelationOutputController = require('./RelationOutputController');

    var _RelationOutputController2 = _interopRequireDefault(_RelationOutputController);

    function _interopRequireDefault(obj) {
        return obj && obj.__esModule ? obj : {default: obj};
    }

    /*@ngInject*/
    function relationInputDirective() {
        return {
            restrict: 'E',
            templateUrl: '/mezzolabs/mezzo/cockpit/templates/relationOutputDirective.html',
            replace: true,
            scope: {
                related: '@',
                scopes: '@',
                naming: '@',
                title: '@'
            },
            require: "^form",
            controller: _RelationOutputController2.default,
            controllerAs: 'vm',
            bindToController: true
        };
    }

}, {"./RelationOutputController": 36}], 38: [function (require, module, exports) {
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

}, {}], 39: [function (require, module, exports) {
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

}, {}], 40: [function (require, module, exports) {
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

}, {}], 41: [function (require, module, exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = validationMessagesDirective;
/*@ngInject*/
function validationMessagesDirective(formInputService) {
    return {
        restrict: 'E',
        require: '^form',
        templateUrl: '/mezzolabs/mezzo/cockpit/templates/validationMessagesDirective.html',
        scope: true,
        link: link
    };

    function link(scope, element, attributes, formController) {
        scope.formInput = undefined;
        var inputElement = $(element).siblings(':input[name]').first();

        if (!inputElement.length) {
            console.warn('Mezzo validation messages directive is unable to find its corresponding input element with a name!', element);
            return;
        }

        formInputService.getFormInputByElement(inputElement, scope, formController).then(function (formInput) {
            scope.formInput = formInput;
        }).catch(function (err) {
            return console.error(err);
        });
    }
}

}, {}], 42: [function (require, module, exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = compileContentBlockDirective;
/*@ngInject*/
function compileContentBlockDirective($parse, $compile, formValidationService, eventDispatcher) {
    return {
        restrict: 'A',
        require: '^form',
        link: link
    };

    function link(scope, element, attributes, form) {
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
            element.find('div.form-group :input').each(function (index, formInput) {
                formValidationService.assign(formInput);
            });
            $compile(element.contents())(scope);
        }
    }
}

}, {}], 43: [function (require, module, exports) {
'use strict';

    var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) {
        return typeof obj;
    } : function (obj) {
        return obj && typeof Symbol === "function" && obj.constructor === Symbol ? "symbol" : typeof obj;
    };

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
exports.default = registerContentBlockFactory;

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

/*@ngInject*/
function registerContentBlockFactory($compile, api, eventDispatcher) {
    return function contentBlockFactory(formController) {
        return new ContentBlockService($compile, api, eventDispatcher, formController);
    };
}

    var ContentBlockService = function () {
    function ContentBlockService($compile, api, eventDispatcher) {
        var _this = this;

        _classCallCheck(this, ContentBlockService);

        this.$compile = $compile;
        this.api = api;
        this.modelApi = api.model('ContentBlock');
        this.contentBlocks = [];
        this.templates = {};
        this.formController = {};

        var base = this;

        eventDispatcher.on('form.updated', function (event, payload) {
            return _this.onFormUpdate(event, payload);
        });

        this.sortableOptions = {
            handle: 'a .ion-arrow-move',
            setup: function setup(ed) {
                ed.on('remove', function () {
                    console.log('mce better remove');
                });
            },
            start: function start(e, ui) {
                console.log('sort');
                $(ui.item).parent().find('[ui-tinymce]').each(function () {
                    $(this).css('opacity', 0.05);
                    tinymce.execCommand('mceRemoveEditor', false, $(this).attr('id'));
                });
            },
            stop: function stop(e, ui) {
                $(ui.item).parent().find('[ui-tinymce]').each(function () {
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
            var block = arguments.length <= 3 || arguments[3] === undefined ? {} : arguments[3];

            var contentBlock = {
                id: block.id,
                key: key,
                sort: block.sort ? block.sort : this.contentBlocks.length + 1,
                cssClass: 'block__' + key.replace(/\\/g, '_'),
                handle: block.name ? block.name : '',
                hash: hash,
                title: title,
                options: block.options ? block.options : {},
                nameInForm: this.currentId++,
                template: null
            };

            this.fillTemplate(contentBlock);
            this.contentBlocks.push(contentBlock);

            this.refreshSortings();
        }
    }, {
        key: 'removeContentBlock',
        value: function removeContentBlock(nameInForm) {
            var index = this.findIndex(nameInForm);

            if (index === false) {
                console.error('Cannot find index for name: ' + nameInForm);
                return false;
            }

            var block = this.contentBlocks[index];

            if (block.id) {
                this.modelApi.delete(block.id).then(function () {
                    toastr.success(block.id + ' deleted');
                });
            }

            this.contentBlocks.splice(index, 1);

            this.refreshSortings(true);
        }
    }, {
        key: 'contentBlockOptionsDialog',
        value: function contentBlockOptionsDialog(nameInForm) {
            var block = this.contentBlocks[this.findIndex(nameInForm)];

            console.log(block);

            swal({
                title: 'Options',
                html: '<div class="form-group">' + '<label>Block Handle</label>' + '<input id="handle-name" type="text" value="' + block.handle + '" class="form-control">' + '</div>',
                confirmButtonText: 'Set'
            }, function () {

                block.handle = $('#handle-name').val();
            });
        }
    }, {
        key: 'findIndex',
        value: function findIndex(nameInForm) {
            for (var i in this.contentBlocks) {
                if (this.contentBlocks[i].nameInForm == nameInForm) return i;
            }

            return false;
        }
    }, {
        key: 'fillTemplate',
        value: function fillTemplate(contentBlock) {
            var _this2 = this;

            var cachedTemplate = this.templates[contentBlock.hash];

            if (cachedTemplate) {
                return contentBlock.template = cachedTemplate;
            }

            this.api.contentBlockTemplate(contentBlock.hash).then(function (template) {
                contentBlock.template = template;
                _this2.templates[contentBlock.hash] = template;
            });
        }
    }, {
        key: 'refreshSortings',
        value: function refreshSortings() {
            var updateSort = arguments.length <= 0 || arguments[0] === undefined ? false : arguments[0];

            this.contentBlocks = _.sortBy(this.contentBlocks, 'sort');

            if (updateSort == false) {
                return;
            }

            for (var i in this.contentBlocks) {
                this.contentBlocks[i].sort = parseInt(i) + 1;
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

                block.sort = index + 1;
            });
        }
    }, {
        key: 'tinyMceModels',
        value: function tinyMceModels() {}
    }, {
        key: 'onFormUpdate',
        value: function onFormUpdate(event, data) {
            if (!data.stripped.content) {
                //console.error('Form update without content.');
                return true;
            }

            console.log('on form update', event, this.formController);

            if (event.form != this.formController) {
                console.log('invalid form event');
                return;
            }

            var contentBlocksData = data.stripped.content.blocks;

            for (var i in this.contentBlocks) {
                var contentBlock = this.contentBlocks[i];

                for (var j in contentBlocksData) {
                    var contentBlockData = contentBlocksData[j];

                    if (contentBlockData.sort == contentBlock.sort) {

                        if (contentBlock.id != contentBlockData.id && contentBlock.id != "" && typeof contentBlock.id != "undefined") {
                            alert('Unexpected error with content block id.');
                            console.log(event, this.formController);
                            console.error(_typeof(contentBlock.id), _typeof(contentBlockData.id), contentBlock.id, contentBlockData.id);
                            console.error('Content block ids wont fit.', contentBlock, contentBlockData);
                        }

                        if (contentBlock.id != contentBlockData.id) {
                            contentBlock.id = contentBlockData.id;
                            console.log('assign content block id' + contentBlock.id);
                        }
                    }
                }
            }
        }
    }]);

    return ContentBlockService;
    }();

}, {}], 44: [function (require, module, exports) {
'use strict';

var _contentBlockFactory = require('./contentBlockFactory');

var _contentBlockFactory2 = _interopRequireDefault(_contentBlockFactory);

var _compileContentBlockDirective = require('./compileContentBlockDirective');

var _compileContentBlockDirective2 = _interopRequireDefault(_compileContentBlockDirective);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var _module = angular.module('MezzoContentBlocks', []);

_module.factory('contentBlockFactory', _contentBlockFactory2.default);
_module.directive('mezzoCompileContentBlock', _compileContentBlockDirective2.default);

}, {"./compileContentBlockDirective": 42, "./contentBlockFactory": 43}], 45: [function (require, module, exports) {
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

var _FormEventListener = require('./../../common/forms/FormEventListener');

var _FormEventListener2 = _interopRequireDefault(_FormEventListener);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

    var FilePickerController = function () {

    /*@ngInject*/

    function FilePickerController(api, $scope, $element, eventDispatcher) {
        _classCallCheck(this, FilePickerController);

        this.days = [];

        this.format = 'DD.MM.YYYY HH:mm';

        this.api = api;
        this.modelApi = api.model('EventDay');
        this.eventDispatcher = eventDispatcher;

        this.$element = $element;
        this.$form = $element.parents('form')[0];
        this.formController = null;

        var base = this;

        this.addDay();
    }

    _createClass(FilePickerController, [{
        key: 'linked',
        value: function linked(scope, element, attrs, ctrls) {
            this.formController = ctrls;
            this.registerListeners();
        }
    }, {
        key: 'registerListeners',
        value: function registerListeners() {
            var _this = this;

            var receivedListener = new _FormEventListener2.default('form.received', function (event, mass) {
                return _this.fill(mass.data.days);
            }, this.formController);

            var updatedListener = new _FormEventListener2.default('form.updated', function (event, mass) {
                return _this.fill(mass.stripped.days);
            }, this.formController);

            this.eventDispatcher.listen(receivedListener);
            this.eventDispatcher.listen(updatedListener);
        }
    }, {
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
        value: function fill(days) {

            if (_.size(days) == 0) {
                return;
            }

            this.days = [];

            for (var i in days) {
                var day = days[i];
                this.addDay(day.start, day.end, day.id);
            }

            this.sort();
        }
    }, {
        key: 'onSend',
        value: function onSend(data) {}
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
            //this.sort();
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

}, {"./../../common/forms/FormEventListener": 21}], 46: [function (require, module, exports) {
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
        require: '^form',
        controller: _EventDaysController2.default,
        controllerAs: 'vm',
        bindToController: true,
        link: function link(scope, element, attrs, ctrls) {
            scope.vm.linked(scope, element, attrs, ctrls);
        }
    };
}

}, {"./EventDaysController": 45}], 47: [function (require, module, exports) {
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

}, {}], 48: [function (require, module, exports) {
'use strict';

var _eventDaysDirective = require('./eventDaysDirective');

var _eventDaysDirective2 = _interopRequireDefault(_eventDaysDirective);

var _eventVenueDirective = require('./eventVenueDirective');

var _eventVenueDirective2 = _interopRequireDefault(_eventVenueDirective);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var _module = angular.module('MezzoEvents', []);

_module.directive('mezzoEventDays', _eventDaysDirective2.default);
_module.directive('mezzoEventVenue', _eventVenueDirective2.default);

}, {"./eventDaysDirective": 46, "./eventVenueDirective": 47}], 49: [function (require, module, exports) {
"use strict";

Object.defineProperty(exports, "__esModule", {
    value: true
});

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var Category = function Category(key, label, icon) {
    var filter = arguments.length <= 3 || arguments[3] === undefined ? null : arguments[3];
    var everything = arguments.length <= 4 || arguments[4] === undefined ? false : arguments[4];

    _classCallCheck(this, Category);

    this.key = key;
    this.label = label;
    this.icon = icon;
    this.filter = filter;
    this.everything = everything;
};

exports.default = Category;

}, {}], 50: [function (require, module, exports) {
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

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

    var File = function () {
    function File(apiFile) {
        _classCallCheck(this, File);

        this.id = apiFile.id;
        this.title = this.nameWithoutExtension(apiFile.filename);
        this.name = apiFile.filename;
        this.created_at = apiFile.created_at;
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
        key: 'displayPath',
        value: function displayPath() {
            return this.displayFolderPath() + '/' + this.name;
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
    }, {
        key: 'nameWithoutExtension',
        value: function nameWithoutExtension(name) {
            var lastDotIndex = name.lastIndexOf('.');

            if (lastDotIndex === -1) {
                return name;
            }

            return name.substr(0, lastDotIndex);
        }
    }]);

    return File;
    }();

exports.default = File;

}, {}], 51: [function (require, module, exports) {
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

    function FileManagerController($scope, api, Upload, quickviewService, languageService) {
        _classCallCheck(this, FileManagerController);

        this.$scope = $scope;
        this.lang = languageService;
        this.api = api;
        this.Upload = Upload;
        this.quickviewService = quickviewService;

        this.categories = this.translateCategories(_categories2.default);
        this.category = this.categories[0];
        this.orderOptions = this.orderOptionsTranslated(['folders', 'title', 'last_modified']);
        this.orderBy = _.keys(this.orderOptions)[0];
        this.selected = null;
        this.loading = false;

        this.initFiles();
    }

    _createClass(FileManagerController, [{
        key: 'initFiles',
        value: function initFiles() {
            var _this = this;

            var folder = arguments.length <= 0 || arguments[0] === undefined ? null : arguments[0];

            this.library = new _Folder2.default(this.translate('library'), null, true);
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
                    //console.log('folders before:', folders);
                    var folderForFile = _this.getFolderByPath(folders, folderPathArray);
                    //console.log('folders after:', folders, folderForFile);
                    folderForFile.files.push(file);
                });
            });

            // Move to the given folder if it is not the Library (Home) folder
            if (folder && folder.parent) {
                var newFolder = this.getFolderByPath(folders, folder.pathArray());
                this.enterFolder(newFolder);
            }
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

            if (this.fileExists(name)) {
                swal({
                    title: 'Oops...',
                    text: name + ' ' + this.translate('exists_already') + '!',
                    type: 'error'
                });
                return;
            }

            swal.closeModal();

            var newFolder = new _Folder2.default(name, this.folder);

            this.folder.files.push(newFolder);
        }
    }, {
        key: 'getFiles',
        value: function getFiles() {
            var _this2 = this;

            if (this.search) {
                return this.searchFiles();
            }

            var category = this.category;

            if (category.everything && this.orderOption() == 'folders') {
                return this.files;
            }

            var filteredFiles = [];

            this.allFiles().forEach(function (file) {
                if (category.filter(file) && (_this2.orderOption() == 'folders' || !file.isFolder)) {
                    filteredFiles.push(file);
                }
            });

            if (this.orderOption() == 'last_modified') {
                filteredFiles = _.orderBy(filteredFiles, 'created_at', 'desc');
            }

            if (this.orderOption() == 'title') {
                filteredFiles = _.orderBy(filteredFiles, 'title', 'asc');
            }

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
            var _this3 = this;

            var folder = arguments.length <= 0 || arguments[0] === undefined ? this.library : arguments[0];

            var files = [];

            folder.files.forEach(function (file) {
                files.push(file);

                if (file.isFolder) {
                    files = files.concat(_this3.allFiles(file));
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

            return count + ' ' + this.lang.get('filemanager.item', count);
        }
    }, {
        key: 'deleteFiles',
        value: function deleteFiles() {
            var _this4 = this;

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

                    _this4.selected = null;

                    _this4.deleteFile(file);
                    _this4.$scope.$apply();
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
            var _this5 = this;

            if (!file) {
                return false;
            }

            var folder = this.folder;

            this.Upload.upload({
                url: '/api/files/upload',
                data: {
                    file: file,
                    folder: folder.path()
                },
                headers: {
                    Accept: 'application/vnd.MezzoLabs.v1+json'
                }
            }).then(function (response) {
                _this5.initFiles(folder);
            }).catch(function (err) {

                if (err.data.message) {
                    toastr.error(err.data.message);
                }

                if (err.statusText) {
                    toastr.error(err.status + ': ' + err.statusText);
                }

                toastr.error('Oops.. unknown error.');

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
            this.initFiles(this.folder);
        }
    }, {
        key: 'fileIsSelected',
        value: function fileIsSelected() {
            return this.selected && !this.selected.isFolder;
        }
    }, {
        key: 'addFolderPrompt',
        value: function addFolderPrompt() {
            var _this6 = this;

            swal({
                title: this.translate('messages.enter_folder_name'),
                html: '<input id="new-folder-name" type="text" class="form-control">',
                confirmButtonText: this.lang.get('general.create'),
                closeOnConfirm: false
            }, function () {
                var newFolderName = $('#new-folder-name').val();

                _this6.addFolder(newFolderName);
                _this6.$scope.$apply();
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
    }, {
        key: 'doOrder',
        value: function doOrder() {
            if (this.unordered()) {
                return;
            }
        }
    }, {
        key: 'orderOption',
        value: function orderOption() {
            return _.snakeCase(this.orderBy);
        }
    }, {
        key: 'unordered',
        value: function unordered() {
            return this.orderOption() == 'folders';
        }
    }, {
        key: 'translate',
        value: function translate(key) {
            var count = arguments.length <= 1 || arguments[1] === undefined ? 1 : arguments[1];

            return this.lang.get('filemanager.' + key, count);
        }
    }, {
        key: 'translateCategories',
        value: function translateCategories(categories) {
            for (var i in categories) {
                categories[i].label = this.translate('categories.' + _.snakeCase(categories[i].key));
            }

            return categories;
        }
    }, {
        key: 'orderOptionsTranslated',
        value: function orderOptionsTranslated(keys) {
            var options = {};

            for (var i in keys) {
                options[keys[i]] = this.translate('order_options.' + keys[i]);
            }

            return options;
        }
    }, {
        key: 'showRenamePrompt',
        value: function showRenamePrompt() {
            var _this7 = this;

            swal({
                title: this.lang.get('general.rename'),
                html: '<input id="new-file-name" type="text" value="' + this.selected.title + '" class="form-control">',
                confirmButtonText: this.lang.get('general.rename'),
                closeOnConfirm: false
            }, function () {
                var newFileName = $('#new-file-name').val();

                _this7.rename(_this7.selected, newFileName);
                _this7.$scope.$apply();
            });
        }
    }, {
        key: 'rename',
        value: function rename(file, name) {
            if (!name || !name.length) {
                return;
            }

            if (this.fileExists(name)) {
                swal({
                    title: 'Oops...',
                    text: name + ' ' + this.translate('exists_already') + '!',
                    type: 'error'
                });
                return;
            }

            swal.closeModal();

            file.title = name;
            file.name = name + '.' + file.extension;

            this.api.renameFile(file);
        }
    }, {
        key: 'fileExists',
        value: function fileExists(name) {
            return !!_.find(this.folder.files, { name: name });
        }
    }]);

    return FileManagerController;
    }();

exports.default = FileManagerController;

}, {"./File": 50, "./Folder": 53, "./categories": 54}], 52: [function (require, module, exports) {
'use strict';

    var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) {
        return typeof obj;
    } : function (obj) {
        return obj && typeof Symbol === "function" && obj.constructor === Symbol ? "symbol" : typeof obj;
    };

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

var _File = require('./File');

var _File2 = _interopRequireDefault(_File);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

    var FilePickerController = function () {

    /*@ngInject*/

    function FilePickerController(api, $scope, eventDispatcher) {
        _classCallCheck(this, FilePickerController);

        this.api = api;
        this.files = [];
        this.preview = null;
        this.searchText = '';
        this.eventDispatcher = eventDispatcher;
        this.uniqueKey = _.random(10000, 90000);

        this.$parent = $scope.$parent;

        this.pagination = {
            size: 10,
            current: 1,
            perPage: 5
        };

        this.registerListeners();

        this.loadFiles();
    }

    _createClass(FilePickerController, [{
        key: 'registerListeners',
        value: function registerListeners() {
            var _this = this;

            //Form was already received -> we dont have to wait for the selected value
            if (this.eventDispatcher.isInHistory('form.received')) {
                return this.eventDispatcher.on('filepicker.files_loaded.' + this.uniqueKey, function (event, payload) {
                    _this.selectOldValue();
                });
            }

            // Wait for the form content and the possible files before selecting the old value
            return this.eventDispatcher.on(['form.received', 'filepicker.files_loaded.' + this.uniqueKey], function (events, payloads) {
                _this.selectOldValue();
            });
        }
    }, {
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

            $(target).parents('mezzo-file-picker').find('.modal').modal();
        }
    }, {
        key: 'loadFiles',
        value: function loadFiles() {
            var _this2 = this;

            this.api.files().then(function (apiFiles) {
                apiFiles.forEach(function (apiFile) {
                    var file = new _File2.default(apiFile);

                    if (_this2.fileType && file.type !== _this2.fileType) {
                        return;
                    }

                    _this2.files.push(file);
                });

                _this2.filesLoaded();
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
            this.eventDispatcher.makeAndFire('filepicker.files_loaded.' + this.uniqueKey, { 'files': this.files });
        }
    }, {
        key: 'selectOldValue',
        value: function selectOldValue() {
            var inputValue = this.$parent.vm.inputs[this.name];
            var modelValue = this.$parent.vm.content[this.name];

            if (modelValue && (typeof modelValue === 'undefined' ? 'undefined' : _typeof(modelValue)) === 'object') {
                return this.selectValueArray(modelValue);
            }

            if (!inputValue || inputValue == "") return false;

            inputValue = String(inputValue);

            if (inputValue.indexOf(',') == -1) {
                this.selectId(inputValue);
                this.confirmSelected();
                return true;
            }

            var ids = inputValue.split(',');
            for (var i in ids) {
                this.selectId(ids[i]);
            }

            this.confirmSelected();

            return true;
        }
    }, {
        key: 'selectValueArray',
        value: function selectValueArray(value) {
            for (var i in value) {
                this.selectId(value[i].id);
            }

            this.confirmSelected();

            return true;
        }
    }, {
        key: 'filteredFiles',
        value: function filteredFiles() {
            var _this3 = this;

            if (this.searchText.length > 0) {
                return this.files.filter(function (file) {
                    return file.name.indexOf(_this3.searchText) !== -1;
                });
            }

            return this.files;
        }
    }, {
        key: 'pagedFiles',
        value: function pagedFiles() {
            var files = this.filteredFiles();

            var start = (this.pagination.current - 1) * this.pagination.perPage;
            var end = this.pagination.current * this.pagination.perPage - 1;

            return files.slice(start, end);
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
            var _this4 = this;

            if (!id || id == "") return false;

            var file = _.find(this.files, function (file) {
                return _this4.id(file) == id;
            });

            /**
             * File got deleted.
             */
            if (!file) {
                return;
            }

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
        key: 'deselect',
        value: function deselect(file) {
            file.selected = false;

            this.confirmSelected();
        }
    }, {
        key: 'confirmSelected',
        value: function confirmSelected() {
            this.$parent.vm.inputs[this.name] = this.selectedIdsString();
        }
    }, {
        key: 'selectedIdsString',
        value: function selectedIdsString() {
            var _this5 = this;

            var selected = this.selectedFiles();

            if (selected.length === 1) {
                return this.id(selected[0]);
            }

            var fileIds = [];

            selected.forEach(function (file) {
                return fileIds.push(_this5.id(file));
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
            var _this6 = this;

            var values = [value];

            if (value.indexOf(',') !== -1) {
                values = value.split(',');
            }

            for (var i = 0; i < values.length; i++) {
                values[i] = parseInt(values[i], 10);
            }

            this.files.forEach(function (file) {
                if (_.contains(values, _this6.id(file))) {
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

}, {"./File": 50}], 53: [function (require, module, exports) {
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

            return '/' + this.pathArray().join('/');
        }
    }, {
        key: 'pathArray',
        value: function pathArray() {
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

            return folders;
        }
    }]);

    return Folder;
    }(_File3.default);

exports.default = Folder;

}, {"./File": 50}], 54: [function (require, module, exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _Category = require('./Category');

var _Category2 = _interopRequireDefault(_Category);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

exports.default = [new _Category2.default('everything', 'Everything', 'ion-ios-home', everythingFilter, true), new _Category2.default('images', 'Images', 'ion-ios-photos', imageFilter), new _Category2.default('videos', 'Videos', 'ion-ios-videocam', videoFilter), new _Category2.default('audio', 'Audio', 'ion-ios-mic', audioFilter), new _Category2.default('documents', 'Documents', 'ion-ios-paper', documentFilter)];

function everythingFilter(file) {
    return true;
}

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

}, {"./Category": 49}], 55: [function (require, module, exports) {
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

}, {}], 56: [function (require, module, exports) {
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

}, {}], 57: [function (require, module, exports) {
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

}, {"./FilePickerController": 52}], 58: [function (require, module, exports) {
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

}, {}], 59: [function (require, module, exports) {
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
//module.directive('mezzoFilePickerValue', filePickerValueDirective);
_module.controller('CreateFileController', _FileManagerController2.default);

}, {
    "./FileManagerController": 51,
    "./draggableDirective.js": 55,
    "./droppableDirective.js": 56,
    "./filePickerDirective": 57,
    "./filePickerValueDirective": 58
}], 60: [function (require, module, exports) {
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

}, {"./mapDirective": 61, "./mapService": 62, "./searchDirective": 63}], 61: [function (require, module, exports) {
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

}, {}], 62: [function (require, module, exports) {
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

}, {}], 63: [function (require, module, exports) {
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
                    key: 'short_name',
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

}, {}], 64: [function (require, module, exports) {
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

}, {}], 65: [function (require, module, exports) {
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

var _ResourceController2 = require('./ResourceController');

var _ResourceController3 = _interopRequireDefault(_ResourceController2);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

    var CreateResourceController = function (_ResourceController) {
    _inherits(CreateResourceController, _ResourceController);

    /*@ngInject*/

    function CreateResourceController($injector, $scope) {
        _classCallCheck(this, CreateResourceController);

        return _possibleConstructorReturn(this, Object.getPrototypeOf(CreateResourceController).call(this, $injector, $scope));
    }

    _createClass(CreateResourceController, [{
        key: 'init',
        value: function init(modelName) {
            var options = arguments.length <= 1 || arguments[1] === undefined ? {} : arguments[1];

            this.options = options;
            this.modelName = modelName;
            this.modelApi = this.api.model(this.modelName);
        }
    }, {
        key: 'doSubmit',
        value: function doSubmit(formData) {
            var _this2 = this;

            return this.modelApi.create(formData).then(function (model) {
                toastr.success('Success! ' + model._label + ' created');

                if (model._permissions && !model._permissions.edit) {
                    toastr.warning('No rights to edit.');
                    _this2.index();
                    return;
                }

                _this2.edit(model.id);
            });
        }
    }, {
        key: 'edit',
        value: function edit(modelId) {

            this.modelStateService.name(this.modelName).id(modelId).edit();
        }
    }, {
        key: 'index',
        value: function index() {
            this.modelStateService.name(this.modelName).index();
        }
    }]);

    return CreateResourceController;
    }(_ResourceController3.default);

exports.default = CreateResourceController;

}, {"./ResourceController": 70}], 66: [function (require, module, exports) {
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

var _get = function get(object, property, receiver) { if (object === null) object = Function.prototype; var desc = Object.getOwnPropertyDescriptor(object, property); if (desc === undefined) { var parent = Object.getPrototypeOf(object); if (parent === null) { return undefined; } else { return get(parent, property, receiver); } } else if ("value" in desc) { return desc.value; } else { var getter = desc.get; if (getter === undefined) { return undefined; } return getter.call(receiver); } };

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _ResourceController2 = require('./ResourceController');

var _ResourceController3 = _interopRequireDefault(_ResourceController2);

var _FormEvent = require('./../../common/forms/FormEvent');

var _FormEvent2 = _interopRequireDefault(_FormEvent);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

    var EditResourceController = function (_ResourceController) {
    _inherits(EditResourceController, _ResourceController);

    /*@ngInject*/

    function EditResourceController($injector, $scope) {
        _classCallCheck(this, EditResourceController);

        var _this = _possibleConstructorReturn(this, Object.getPrototypeOf(EditResourceController).call(this, $injector, $scope));

        _this.$scope = $scope;
        _this.$stateParams = $injector.get('$stateParams');
        _this.$rootScope = $injector.get('$rootScope');
        _this.eventDispatcher = $injector.get('eventDispatcher');
        _this.modelId = _this.$stateParams.modelId;

        _this.content = {};

        _this.includes = ['content'];

        _this.$scope.$on('$routeChangeStart', function (next, current) {
            alert('route change scope edit resource');
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
        key: 'canEdit',
        value: function canEdit() {
            if (!this.content._permissions) {
                return true;
            }

            return this.content._permissions.edit;
        }
    }, {
        key: 'beforeSubmit',
        value: function beforeSubmit() {
            if (!this.canEdit()) {
                swal('Error', this.language.get('messages.missing_permissions'), 'error');
                return false;
            }

            return _get(Object.getPrototypeOf(EditResourceController.prototype), 'beforeSubmit', this).call(this);
        }
    }, {
        key: 'doSubmit',
        value: function doSubmit(formData) {
            var _this2 = this;

            return this.modelApi.update(this.modelId, formData, { params: { include: this.includes.join(',') } }).then(function (model) {
                _this2.fireEvent('form.updated', _this2.formDataService.transform(model));
                toastr.success('Success! ' + model._label + ' updated');
            });
        }
    }, {
        key: 'loadContent',
        value: function loadContent() {
            var _this3 = this;

            var params = {
                include: this.includes.join(',')
            };
            this.loading = true;

            this.modelApi.content(this.modelId, params).then(function (model) {
                _this3.contentLoaded(model);

                _this3.canEdit();
            }).catch(function (err) {

                if (err.data) {
                    swal(err.data.status_code.toString(), err.data.message, 'error');
                }

                _this3.redirectToIndex();
            });
        }
    }, {
        key: 'contentLoaded',
        value: function contentLoaded(model) {
            this.initContentBlocks(model);
            this.initLockable(model);

            var cleaned = this.formDataService.transform(model);

            this.content = cleaned.stripped;

            this.inputs = cleaned.flattened;

            this.loading = false;

            this.eventDispatcher.fire(new _FormEvent2.default('form.received', {
                data: cleaned.stripped,
                flattened: cleaned.flattened,
                form: this.form
            }, this.form));
        }
    }, {
        key: 'initContentBlocks',
        value: function initContentBlocks(model) {
            var _this4 = this;

            if (!model.content || !model.content.data.blocks) {
                return;
            }

            var blocks = model.content.data.blocks.data;

            blocks.forEach(function (block) {
                var hash = md5(block.class);

                _this4.contentBlockService.addContentBlock(block.class, hash, block._label, block);
            });
        }
    }, {
        key: 'startResourceLocking',
        value: function startResourceLocking() {
            var _this5 = this;

            var thirtySeconds = 30 * 1000;
            this.lockTask = setInterval(function () {
                return _this5.lock();
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
            _get(Object.getPrototypeOf(EditResourceController.prototype), 'onDestroy', this).call(this);
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
                return this.redirectToIndexBecauseLocked(model._locked_by);
            }

            this.startResourceLocking();
        }
    }, {
        key: 'redirectToIndexBecauseLocked',
        value: function redirectToIndexBecauseLocked(lockedBy) {
            var title = 'Oops...';
            var message = 'You are not allowed to edit this resource while it is locked by ' + lockedBy + '!';

            sweetAlert(title, message, 'error');
            this.redirectToIndex();
        }
    }, {
        key: 'redirectToIndex',
        value: function redirectToIndex() {
            this.modelStateService.name(this.modelName).index();
        }
    }]);

    return EditResourceController;
    }(_ResourceController3.default);

exports.default = EditResourceController;

}, {"./../../common/forms/FormEvent": 20, "./ResourceController": 70}], 67: [function (require, module, exports) {
'use strict';

    var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) {
        return typeof obj;
    } : function (obj) {
        return obj && typeof Symbol === "function" && obj.constructor === Symbol ? "symbol" : typeof obj;
    };

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

var _QueryObject = require('./QueryObject');

var _QueryObject2 = _interopRequireDefault(_QueryObject);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

    var IndexResourceController = function () {

    /*@ngInject*/

        function IndexResourceController($scope, api, modelStateService, languageService, eventDispatcher, errorHandlerService) {
        var _this = this;

        _classCallCheck(this, IndexResourceController);

        this.$scope = $scope;
        this.api = api;
        this.lang = languageService;
        this.modelStateService = modelStateService;
        this.includes = [];
        this.language = languageService;
            this.errorHandler = errorHandlerService;
        this.models = [];
        this.modelValues = {};
        this.searchText = '';
        this.selectAll = false;
        this.loading = false;
        this.attributes = {};
        this.perPage = 15;
        this.currentPage = 1;
        this.options = {
            backendPagination: false
        };
        this.eventDispatcher = eventDispatcher;
        this.totalCount = 0;
        this.pagination = {
            size: 10
        };

        this.queryObject = _QueryObject2.default.makeFromController(this);
        this.formParameters = {};

        this.$scope.$on('$destroy', function () {
            return _this.onDestroy();
        });
    }

    _createClass(IndexResourceController, [{
        key: 'init',
        value: function init(modelName, defaultIncludes, options) {
            this.modelName = modelName;
            this.modelApi = this.api.model(modelName);
            this.includes = defaultIncludes;
            this.options = _.merge(this.options, options);

            this.loadModels();
        }
    }, {
        key: 'addAttribute',
        value: function addAttribute(name, type) {
            var options = arguments.length <= 2 || arguments[2] === undefined ? {} : arguments[2];

            this.attributes[name] = { name: name, type: type, order: '', filter: '', options: options };
        }
    }, {
        key: 'attribute',
        value: function attribute(name) {
            return _.find(this.attributes, ['name', name]);
        }
    }, {
        key: 'loadModels',
        value: function loadModels() {
            var _this2 = this;

            var params = arguments.length <= 0 || arguments[0] === undefined ? {} : arguments[0];

            this.loading = true;
            params.include = this.includes.join(',');

            this.queryObject = _QueryObject2.default.makeFromController(this);

            params = _.merge(this.queryObject.getParameters(), params);

            return this.modelApi.index(params).then(function (data) {
                var latestResponse = _this2.modelApi.latestResponse();

                _this2.models = data;

                if (_this2.options.backendPagination) {
                    _this2.totalCount = latestResponse.headers('X-Total-Count');
                } else {
                    _this2.totalCount = _.size(_this2.models);
                }

                _this2.models.forEach(function (model) {
                    return model._meta = {};
                });
            }).catch(function (err) {
                return _this2.errorHandler.showUnexpected(err);
            }).finally(function () {
                _this2.loading = false;
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

            if (this.options.backendPagination) {
                return models;
            }

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

            if (value && attribute.type == "distance") {
                return parseFloat(value);
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
            var _this3 = this;

            var searched = this.models.filter(function (model) {
                return _this3.modelIsInSearch(model) && _this3.modelIsInFilters(model);
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
            var _this4 = this;

            var models = this.getModelsgetModels();

            models.forEach(function (model) {
                return model._meta.selected = _this4.selectAll;
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
            var _this5 = this;

            var selected = this.selected();

            swal({
                title: this.language.get('messages.shure_to_delete_models.title'),
                text: this.language.get('messages.shure_to_delete_models.text', selected.length, { count: selected.length }),
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: this.language.get('general.delete'),
                confirmButtonColor: '#fb503b'
            }, function (confirmed) {
                if (!confirmed) {
                    return;
                }

                selected.forEach(function (model) {
                    return _this5.removeModel(model);
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
            return $first && !this.isLocked(model) && (!model._permissions || model._permissions.edit);
        }

        /**
         *
         * Apply parameters that were given in the API-Query formular.
         *
         * @param $event
         */

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

            this.formParameters = params;

            this.loadModels(params);
        }

        /**
         * Triggered when the user hits a pagination link.
         */

    }, {
        key: 'pageChanged',
        value: function pageChanged() {
            if (!this.options.backendPagination) {
                return;
            }

            this.loadModels();
        }

        /**
         *
         *
         * @param name
         * @returns {string}
         */

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

        /**
         * Move the sorting of a certain column one step further.
         * (desc -> asc -> none)
         *
         * @param name
         */

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

            if (!this.options.backendPagination) {
                return this.clientSideSort(attribute);
            }

            this.loadModels();
        }

        /**
         *
         * Perform a client side sorting, this is only possible if we have all the models.
         * In other words, we can only do this if we dont use the client side pagination.
         *
         * @param name
         * @param order
         * @returns {*}
         */

    }, {
        key: 'clientSideSort',
        value: function clientSideSort(attribute, order) {
            var _this6 = this;

            switch (attribute.order) {
                case 'desc':
                    return this.models = _.sortBy(this.getModels(), function (model) {
                        return _this6.sortByFunction(model, attribute);
                    }).reverse();
                case 'asc':
                    return this.models = _.sortBy(this.getModels(), function (model) {
                        return _this6.sortByFunction(model, attribute);
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

            if (value && typeof value == 'number') {
                return value;
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
    }, {
        key: 'useFilters',
        value: function useFilters() {
            return !this.options.backendPagination;
        }
    }, {
        key: 'useSortings',
        value: function useSortings(column) {
            var attribute = this.attribute(column);

            if (!attribute) {
                return false;
            }

            if (!this.options.backendPagination) {
                return true;
            }

            return attribute.options.column != "";
        }
    }, {
        key: 'useSearch',
        value: function useSearch() {
            return !this.options.backendPagination;
        }
    }, {
        key: 'buildQuery',
        value: function buildQuery() {}
    }, {
        key: 'filterChanged',
        value: function filterChanged() {
            console.log('filter changed');
        }
    }, {
        key: 'onDestroy',
        value: function onDestroy() {}
    }]);

    return IndexResourceController;
    }();

exports.default = IndexResourceController;

}, {"./QueryObject": 69}], 68: [function (require, module, exports) {
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
            this.go('index' + this.modelStateName());
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

            this.$state.go(stateName, stateParams).then(function () {}).catch(function (error) {
                console.log(error);
            });
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

}, {}], 69: [function (require, module, exports) {
"use strict";

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

var _IndexResourceController = require("./IndexResourceController");

var _IndexResourceController2 = _interopRequireDefault(_IndexResourceController);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

    var QueryObject = function () {
    function QueryObject() {
        _classCallCheck(this, QueryObject);

        this.clear();
    }

    _createClass(QueryObject, [{
        key: "clear",
        value: function clear() {
            this.scopes = {};

            this.searchText = "";

            this.paginationObject = {
                offset: 0,
                limit: false
            };

            this.filters = {};

            this.sortings = {};

            this.overwritingParameters = {};
        }

        /**
         *
         * @param {string} column
         * @param {string} direction
         * @returns {QueryObject}
         */

    }, {
        key: "addSorting",
        value: function addSorting(column, direction) {
            if (!column || column == "") return this;

            this.sortings[column] = direction;

            return this;
        }

        /**
         *
         * @param {string} query
         * @returns {QueryObject}
         */

    }, {
        key: "search",
        value: function search(query) {
            this.searchText = query;

            return this;
        }

        /**
         *
         * @param {int} offset
         * @param {int} limit
         * @returns {QueryObject}
         */

    }, {
        key: "pagination",
        value: function pagination(offset, limit) {
            this.paginationObject.offset = offset;
            this.paginationObject.limit = limit;

            return this;
        }

        /**
         *
         * @param {string} column
         * @param {string} value
         * @returns {QueryObject}
         */

    }, {
        key: "addFilter",
        value: function addFilter(column, value) {
            this.filters[column] = value;

            return this;
        }

        /**
         *
         * @param {string} name
         * @param {Array} parameters
         */

    }, {
        key: "addScope",
        value: function addScope(name, parameters) {
            this.scopes[name] = _.values(parameters);
        }

        /**
         * Get the parameters for this query.
         *
         * @returns {Object}
         */

    }, {
        key: "getParameters",
        value: function getParameters() {
            var parameters = {};

            if (_.size(this.sortings) > 0) {
                parameters.sort = this.sortString();
            }

            if (this.paginationObject.offset != 0 || this.paginationObject.limit) {
                parameters.offset = this.paginationObject.offset;
                parameters.limit = this.paginationObject.limit;
            }

            if (this.searchText != "") {
                parameters.q = this.searchText;
            }

            if (_.size(this.scopes) > 0) {
                parameters.scopes = this.scopes;
            }

            return _.merge(parameters, this.overwritingParameters);
        }

        /**
         *
         * @returns {string}
         */

    }, {
        key: "sortString",
        value: function sortString() {
            var sortingStrings = [];

            for (var column in this.sortings) {
                var direction = this.sortings[column];

                if (direction == "asc" || direction == "ascending" || direction == "" || direction == false) {
                    sortingStrings.push(column);
                    continue;
                }

                sortingStrings.push('-' + column);
            }

            return sortingStrings.join(',');
        }

        /**
         *
         * @param {IndexResourceController} controller
         */

    }], [{
        key: "makeFromController",
        value: function makeFromController(controller) {
            var queryObject = new QueryObject();

            if (controller.options.backendPagination) {
                queryObject.pagination((controller.currentPage - 1) * controller.perPage, controller.perPage);

                queryObject.search(controller.searchText);

                _.forEach(controller.attributes, function (attribute) {
                    if (attribute.order != '') {
                        queryObject.addSorting(attribute.options.column, attribute.order);
                    }
                });
            }

            this.overwritingParameters = controller.formParameters;

            return queryObject;
        }
    }]);

    return QueryObject;
    }();

exports.default = QueryObject;

}, {"./IndexResourceController": 67}], 70: [function (require, module, exports) {
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

var _FormEvent = require('./../../common/forms/FormEvent');

var _FormEvent2 = _interopRequireDefault(_FormEvent);

var _FormSubmitter = require('./../../common/forms/FormSubmitter');

var _FormSubmitter2 = _interopRequireDefault(_FormSubmitter);

var _FormObject = require('./../../common/forms/FormObject');

var _FormObject2 = _interopRequireDefault(_FormObject);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

// Intended for CreateResourceController & EditResourceController

    var ResourceController = function () {
    function ResourceController($injector, $scope) {
        var _this = this;

        _classCallCheck(this, ResourceController);

        this.$injector = $injector;
        this.api = this.$injector.get('api');
        this.formDataService = this.$injector.get('formDataService');
        this.contentBlockFactory = this.$injector.get('contentBlockFactory');
        this.contentBlockService = this.contentBlockFactory();
        this.modelStateService = this.$injector.get('modelStateService');
        this.errorHandlerService = this.$injector.get('errorHandlerService');
        this.eventDispatcher = this.$injector.get('eventDispatcher');
        this.$timeout = this.$injector.get('$timeout');
        this.formSubmitter = new _FormSubmitter2.default(this, $injector);
        this.httpRequestTracker = this.$injector.get('HttpRequestTracker');
        this.language = this.$injector.get('languageService');
        this.inputs = {}; // ng-model Controller of the input fields will bind to this object
        this.isBusy = false;
        this.$scope = $scope;
        this.options = {};

        this.form = {}; //name of the main form is vm.form

        setTimeout(function () {
            _this.contentBlockService.formController = _this.form;
        }, 1);

        // TODO: Make resource controller ready for multiple forms.
        this.submittingForm = null;

        this.$scope.$on('$destroy', function () {
            return _this.onDestroy();
        });
    }

    _createClass(ResourceController, [{
        key: 'submitButtonClass',
        value: function submitButtonClass(formController) {
            if (this.formController && this.formController.$invalid || this.httpRequestTracker.busy) {
                return 'disabled';
            }

            return '';
        }

        // Override this method in extending class

    }, {
        key: 'doSubmit',
        value: function doSubmit(formData) {
            console.error('doSubmit() should be implemented by the extending class!');
            return Promise.resolve();
        }
    }, {
        key: 'submit',
        value: function submit($event, formController) {
            var _this2 = this;

            if (this.beforeSubmit() === false) {
                return false;
            }

            return this.formSubmitter.run($event.target, formController, {
                doSubmit: function doSubmit(formData) {
                    return _this2.doSubmit(formData);
                }
            });
        }
    }, {
        key: 'beforeSubmit',
        value: function beforeSubmit() {
            //To be overwrite
            return true;
        }
    }, {
        key: 'tinymceOptions',
        value: function tinymceOptions() {
            return {
                plugins: ["link"],
                toolbar: "undo redo | bold italic underline | link",
                menubar: "",
                elementpath: false
            };
        }
    }, {
        key: 'fireEvent',
        value: function fireEvent(name, data) {
            return this.eventDispatcher.fire(new _FormEvent2.default(name, data, this.form));
        }
    }, {
        key: 'getInput',
        value: function getInput(name) {
            return this.inputs[name];
        }
    }, {
        key: 'activeForm',
        value: function activeForm() {
            return this.submittingForm ? this.submittingForm : this.form;
        }
    }, {
        key: 'formObject',
        value: function formObject(form, formController) {

            return new _FormObject2.default(form, formController);
        }
    }, {
        key: 'onDestroy',
        value: function onDestroy() {}
    }]);

    return ResourceController;
    }();

exports.default = ResourceController;

}, {
    "./../../common/forms/FormEvent": 20,
    "./../../common/forms/FormObject": 23,
    "./../../common/forms/FormSubmitter": 24
}], 71: [function (require, module, exports) {
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

}, {}], 72: [function (require, module, exports) {
'use strict';

    var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) {
        return typeof obj;
    } : function (obj) {
        return obj && typeof Symbol === "function" && obj.constructor === Symbol ? "symbol" : typeof obj;
    };

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

}, {}], 73: [function (require, module, exports) {
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

var _EditUserSubscriptionsController = require('./relations/EditUserSubscriptionsController');

var _EditUserSubscriptionsController2 = _interopRequireDefault(_EditUserSubscriptionsController);

var _ShowResourceController = require('./ShowResourceController');

var _ShowResourceController2 = _interopRequireDefault(_ShowResourceController);

var _PivotRowsController = require('./relations/PivotRowsController');

var _PivotRowsController2 = _interopRequireDefault(_PivotRowsController);

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

_module.controller('PivotRowsController', _PivotRowsController2.default);

_module.controller('EditUserSubscriptionsController', _EditUserSubscriptionsController2.default);

}, {
    "./CreateResourceController": 65,
    "./EditResourceController": 66,
    "./IndexResourceController": 67,
    "./ModelStateService": 68,
    "./ShowResourceController": 71,
    "./formDataService": 72,
    "./registerStateDirective": 74,
    "./relations/EditUserSubscriptionsController": 76,
    "./relations/PivotRowsController": 77,
    "./stateProvider": 78
}], 74: [function (require, module, exports) {
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

        /**
         if(action === Action.CREATE) {
            registerState(uri.replace('create', 'edit'), page.replace('Create', 'Edit'), Action.EDIT);
        }
         */

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

}, {"./Action": 64}], 75: [function (require, module, exports) {
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

var _FormDataReader = require('./../../../common/forms/FormDataReader');

var _FormDataReader2 = _interopRequireDefault(_FormDataReader);

var _FormSubmitter = require('./../../../common/forms/FormSubmitter');

var _FormSubmitter2 = _interopRequireDefault(_FormSubmitter);

var _FormObject = require('./../../../common/forms/FormObject');

var _FormObject2 = _interopRequireDefault(_FormObject);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

    var EditRelationsController = function () {
    /**
     * @ngInject
     * @param $injector
     * @param $scope
     */

    function EditRelationsController($injector, $scope) {
        var _this = this;

        _classCallCheck(this, EditRelationsController);

        this.$injector = $injector;
        this.$scope = $scope;

        this.api = this.$injector.get('api');
        this.formDataService = this.$injector.get('formDataService');
        this.eventDispatcher = this.$injector.get('eventDispatcher');
        this.$timeout = this.$injector.get('$timeout');

        this.$stateParams = $injector.get('$stateParams');
        this.modelId = this.$stateParams.modelId;

        this.modelName = null;
        this.relationName = null;

        this.modelApi = null;
        this.relationApi = null;

        this.relationItems = {};
        this.modelItem = {};
        this.inputs = {};

        this.formDataReader = new _FormDataReader2.default();
        this.formSubmitter = new _FormSubmitter2.default(this, $injector);

        this.$scope.$on('$destroy', function () {
            return _this.onDestroy();
        });
    }

    _createClass(EditRelationsController, [{
        key: 'onDestroy',
        value: function onDestroy() {}
    }, {
        key: 'init',
        value: function init(modelName, relationName) {
            this.modelName = modelName;
            this.relationName = relationName;

            this.modelApi = this.api.model(modelName);
            this.relationApi = this.api.relation(modelName, relationName);

            this.loadRelationItems();
            this.loadModelItem();
        }
    }, {
        key: 'loadRelationItems',
        value: function loadRelationItems() {
            var _this2 = this;

            this.relationApi.index(this.modelId).then(function (data) {
                _this2.relationItemsLoaded(data);
            });
        }
    }, {
        key: 'loadModelItem',
        value: function loadModelItem() {
            var _this3 = this;

            this.modelApi.content(this.modelId).then(function (data) {
                _this3.modelItemLoaded(data);
            });
        }
    }, {
        key: 'relationItemsLoaded',
        value: function relationItemsLoaded(data) {
            var _this4 = this;

            var cleaned = this.formDataService.transform(data);

            var prefixedAndFlattened = {};

            _.forEach(cleaned.flattened, function (value, key) {
                prefixedAndFlattened[_this4.relationName + '.' + key] = value;
            });

            this.inputs = prefixedAndFlattened;
            this.relationItems = cleaned.stripped;

            this.addRelationForm().$setPristine();
        }
    }, {
        key: 'modelItemLoaded',
        value: function modelItemLoaded(data) {
            var cleaned = this.formDataService.transform(data);

            this.modelItem = cleaned.stripped;
        }
    }, {
        key: 'submit',
        value: function submit($event, formController) {
            if (formController == this.addRelationForm()) {
                return this.submitAddRelation($event);
            }

            return this.submitEditRelation($event, formController);
        }
    }, {
        key: 'submitAddRelation',
        value: function submitAddRelation($event) {
            var _this5 = this;

            return this.formSubmitter.run($event.target, this.addRelationForm(), {
                doSubmit: function doSubmit(formData) {
                    return _this5.doAddRelation(formData);
                }
            });
        }
    }, {
        key: 'doAddRelation',
        value: function doAddRelation(formData) {
            var _this6 = this;

            return this.modelApi.update(this.modelId, formData, {}).then(function (model) {
                toastr.success('Added to ' + _this6.relationName);
                _this6.loadRelationItems();
            });
        }
    }, {
        key: 'submitEditRelation',
        value: function submitEditRelation($event, formController) {
            var _this7 = this;

            return this.formSubmitter.run($event.target, formController, {
                doSubmit: function doSubmit(formData) {
                    return _this7.doEditRelation(formData);
                }
            });
        }
    }, {
        key: 'doEditRelation',
        value: function doEditRelation(formData) {
            var _this8 = this;

            return this.modelApi.update(this.modelId, formData, {}).then(function (model) {
                toastr.success('Edited ' + _this8.relationName);
            });
        }
    }, {
        key: 'addRelationForm',
        value: function addRelationForm() {
            return this.form;
        }
    }, {
        key: 'editRelationForms',
        value: function editRelationForms() {
            return this.forms;
        }
    }, {
        key: 'deleteRelationItem',
        value: function deleteRelationItem(relationItem) {}
    }]);

    return EditRelationsController;
    }();

exports.default = EditRelationsController;

}, {
    "./../../../common/forms/FormDataReader": 19,
    "./../../../common/forms/FormObject": 23,
    "./../../../common/forms/FormSubmitter": 24
}], 76: [function (require, module, exports) {
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

var _EditRelationsController = require('./EditRelationsController');

var _EditRelationsController2 = _interopRequireDefault(_EditRelationsController);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

    var EditUserSubscriptionsController = function (_EditRelationsControl) {
    _inherits(EditUserSubscriptionsController, _EditRelationsControl);

    /*@ngInject*/

    function EditUserSubscriptionsController($injector, $scope) {
        _classCallCheck(this, EditUserSubscriptionsController);

        var _this = _possibleConstructorReturn(this, Object.getPrototypeOf(EditUserSubscriptionsController).call(this, $injector, $scope));

        _this.relationModelsApi = _this.api.model('Subscription');
        return _this;
    }

    _createClass(EditUserSubscriptionsController, [{
        key: 'deleteRelationItem',
        value: function deleteRelationItem(relationItem) {
            var _this2 = this;

            if (!confirm('Delete?')) {
                return false;
            }

            this.relationModelsApi.delete(relationItem.id).then(function () {
                _this2.loadRelationItems();
                toastr.info('Subscription "' + relationItem.id + '" deleted.');
            });
        }
    }, {
        key: 'user',
        value: function user() {
            return this.modelItem;
        }
    }]);

    return EditUserSubscriptionsController;
    }(_EditRelationsController2.default);

exports.default = EditUserSubscriptionsController;

}, {"./EditRelationsController": 75}], 77: [function (require, module, exports) {
"use strict";

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

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

    var PivotRowsController = function () {
    function PivotRowsController($scope) {
        _classCallCheck(this, PivotRowsController);

        this.vm = $scope.vm;
    }

    _createClass(PivotRowsController, [{
        key: "init",
        value: function init() {}
    }]);

    return PivotRowsController;
    }();

exports.default = PivotRowsController;

}, {}], 78: [function (require, module, exports) {
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

}, {}], 79: [function (require, module, exports) {
'use strict';

var _module = angular.module('MezzoUsers', []);

}, {}], 80: [function (require, module, exports) {
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

}, {"./customRoutes": 81, "./lang": 83}], 81: [function (require, module, exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = customRoutes;

/*@ngInject*/
function customRoutes($stateProvider) {

    $stateProvider.state('subscriptionsuser', {
        url: '/mezzo/user/user/edit/:modelId/subscriptions',
        templateUrl: '/mezzo/user/user/edit/subscriptions.html',
        controller: 'EditUserSubscriptionsController',
        controllerAs: 'vm'
    });
}

}, {}], 82: [function (require, module, exports) {
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

}, {}], 83: [function (require, module, exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = addTranslations;
/*@ngInject*/
function addTranslations($translateProvider, languageService) {

    $translateProvider.translations('de', {
        'ATTRIBUTES.GENDER': { m: 'Herr', f: 'Frau' },
        'FOO': 'Dies ist ein Absatz'
    });

    $translateProvider.preferredLanguage('de');
}

}, {}], 84: [function (require, module, exports) {
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
