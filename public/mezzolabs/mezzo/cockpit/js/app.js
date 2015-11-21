(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
'use strict';

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

require('./setup/jquery');

require('./modules/resource');

require('./modules/fileManager');

require('./modules/contentBuilder');

var _setupConfig = require('./setup/config');

var _setupConfig2 = _interopRequireDefault(_setupConfig);

var _commonCompileDirective = require('./common/compileDirective');

var _commonCompileDirective2 = _interopRequireDefault(_commonCompileDirective);

var _commonEnterDirectiveJs = require('./common/enterDirective.js');

var _commonEnterDirectiveJs2 = _interopRequireDefault(_commonEnterDirectiveJs);

var _commonUidServiceJs = require('./common/uidService.js');

var _commonUidServiceJs2 = _interopRequireDefault(_commonUidServiceJs);

var _commonApiApiService = require('./common/api/apiService');

var _commonApiApiService2 = _interopRequireDefault(_commonApiApiService);

var app = angular.module('Mezzo', ['ui.router', 'ngMessages', 'angular-sortable-view', 'ngFileUpload', 'MezzoFileManager', 'MezzoResources', 'MezzoContentBuilder']);

app.config(_setupConfig2['default']);
app.directive('mezzoCompile', _commonCompileDirective2['default']);
app.directive('mezzoEnter', _commonEnterDirectiveJs2['default']);
app.factory('uid', _commonUidServiceJs2['default']);
app.factory('api', _commonApiApiService2['default']);

},{"./common/api/apiService":4,"./common/compileDirective":5,"./common/enterDirective.js":6,"./common/uidService.js":7,"./modules/contentBuilder":9,"./modules/fileManager":17,"./modules/resource":21,"./setup/config":24,"./setup/jquery":25}],2:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});

var _createClass = (function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ('value' in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; })();

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError('Cannot call a class as a function'); } }

var _ModelApi = require('./ModelApi');

var _ModelApi2 = _interopRequireDefault(_ModelApi);

var Api = (function () {
    function Api($http) {
        _classCallCheck(this, Api);

        this.$http = $http;
    }

    _createClass(Api, [{
        key: 'get',
        value: function get(url) {
            return this.apiPromise(this.$http.get(url));
        }
    }, {
        key: 'delete',
        value: function _delete(url) {
            return this.apiPromise(this.$http['delete'](url));
        }
    }, {
        key: 'model',
        value: function model(modelName) {
            return new _ModelApi2['default'](this, modelName);
        }
    }, {
        key: 'apiPromise',
        value: function apiPromise($httpPromise) {
            return $httpPromise.then(function (response) {
                return response.data.data;
            })['catch'](function (err) {
                console.error(err);
                throw err;
            });
        }
    }, {
        key: 'files',
        value: function files() {
            return this.get('/api/files');
        }
    }, {
        key: 'contentBlockTemplate',
        value: function contentBlockTemplate(hash) {
            return this.$http.get('/mezzo/content-block-types/' + hash + '.html').then(function (response) {
                return response.data;
            })['catch'](function (err) {
                console.error(err);
                throw err;
            });
        }
    }]);

    return Api;
})();

exports['default'] = Api;
module.exports = exports['default'];

},{"./ModelApi":3}],3:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});

var _createClass = (function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ('value' in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; })();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError('Cannot call a class as a function'); } }

var ModelApi = (function () {
    function ModelApi(api, modelName) {
        _classCallCheck(this, ModelApi);

        this.api = api;
        this.modelName = modelName;
        this.modelPlural = this.modelName.toLowerCase() + 's';
        this.apiUrl = '/api/' + this.modelPlural;
    }

    _createClass(ModelApi, [{
        key: 'index',
        value: function index() {
            return this.api.get(this.apiUrl);
        }
    }, {
        key: 'delete',
        value: function _delete(modelId) {
            return this.api['delete'](this.apiUrl + '/' + modelId);
        }
    }]);

    return ModelApi;
})();

exports['default'] = ModelApi;
module.exports = exports['default'];

},{}],4:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});
exports['default'] = apiService;

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var _Api = require('./Api');

var _Api2 = _interopRequireDefault(_Api);

/*@ngInject*/

function apiService($http) {
    return new _Api2['default']($http);
}

module.exports = exports['default'];

},{"./Api":2}],5:[function(require,module,exports){
/*@ngInject*/
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});
exports['default'] = compileDirective;

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

;
module.exports = exports['default'];

},{}],6:[function(require,module,exports){
/*@ngInject*/
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});
exports['default'] = enterDirective;

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

module.exports = exports['default'];

},{}],7:[function(require,module,exports){
"use strict";

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports["default"] = uidService;
var id = 0;

/*@ngInject*/

function uidService() {
    return nextUid;
}

function nextUid() {
    return id++;
}
module.exports = exports["default"];

},{}],8:[function(require,module,exports){
"use strict";

Object.defineProperty(exports, "__esModule", {
    value: true
});

    var _createClass = (function () {
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
    })();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

    var CreatePageController = (function () {

        /*@ngInject*/

        function CreatePageController(api, $sce) {
            _classCallCheck(this, CreatePageController);

            this.api = api;
            this.$sce = $sce;
            this.contentBlocks = [];
            this.templates = {};
        }

        _createClass(CreatePageController, [{
            key: "addContentBlock",
            value: function addContentBlock(key, title, hash, propertyInputName) {
                var contentBlock = {
                    key: key,
                    title: title,
                    hash: hash,
                    propertyInputName: propertyInputName,
                    template: null
                };

                this.fillTemplate(contentBlock);
                this.contentBlocks.push(contentBlock);
            }
        }, {
            key: "fillTemplate",
            value: function fillTemplate(contentBlock) {
                var _this = this;

                var cachedTemplate = this.templates[contentBlock.hash];

                if (cachedTemplate) {
                    return contentBlock.template = cachedTemplate;
            }

                this.api.contentBlockTemplate(contentBlock.hash).then(function (template) {
                    var trustedTemplate = _this.$sce.trustAsHtml(template);
                    contentBlock.template = trustedTemplate;
                    _this.templates[contentBlock.hash] = trustedTemplate;
                });
            }
        }]);

        return CreatePageController;
    })();

    exports["default"] = CreatePageController;
module.exports = exports["default"];

},{}],9:[function(require,module,exports){
'use strict';

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

    var _CreatePageController = require('./CreatePageController');

    var _CreatePageController2 = _interopRequireDefault(_CreatePageController);

    var _module = angular.module('MezzoContentBuilder', []);

    _module.controller('CreatePageController', _CreatePageController2['default']);

}, {"./CreatePageController": 8}],
    10: [function (require, module, exports) {
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

exports["default"] = Category;
module.exports = exports["default"];

},{}],11:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});

var _createClass = (function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ('value' in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; })();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError('Cannot call a class as a function'); } }

var File = (function () {
    function File(title, name, extension) {
        _classCallCheck(this, File);

        this.title = title;
        this.name = name;
        this.extension = extension;
        this.type = 'file';
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
})();

exports['default'] = File;
module.exports = exports['default'];

},{}],12:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});

var _createClass = (function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ('value' in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; })();

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError('Cannot call a class as a function'); } }

var _File = require('./File');

var _File2 = _interopRequireDefault(_File);

var _Folder = require('./Folder');

var _Folder2 = _interopRequireDefault(_Folder);

var _categories = require('./categories');

var _categories2 = _interopRequireDefault(_categories);

var FileManagerController = (function () {

    /*@ngInject*/

    function FileManagerController($scope, api, Upload) {
        _classCallCheck(this, FileManagerController);

        this.$scope = $scope;
        this.api = api;
        this.Upload = Upload;

        this.categories = _categories2['default'];
        this.category = this.categories[0];
        this.orderOptions = ['Title', 'Last modified'];
        this.orderBy = this.orderOptions[0];
        this.selected = null;

        this.initFiles();
    }

    _createClass(FileManagerController, [{
        key: 'initFiles',
        value: function initFiles() {
            var _this = this;

            this.library = new _Folder2['default']('Library');
            this.folder = this.library;
            this.files = this.library.files;

            this.api.files().then(function (apiFiles) {
                apiFiles.forEach(function (apiFile) {
                    var file = new _File2['default'](apiFile.filename, apiFile.filename, apiFile.extension);

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

                return;
            }

            this.selected = file;
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
            var folder = new _Folder2['default'](name, this.folder);

            this.folder.files.push(folder);
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
            for (var i = 0; i < this.files.length; i++) {
                if (file === this.files[i]) {
                    this.files.splice(i, 1);

                    return;
                }
            }
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
                console.log(response);
                _this4.initFiles();
            })['catch'](function (err) {
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
    }]);

    return FileManagerController;
})();

exports['default'] = FileManagerController;
module.exports = exports['default'];

},{"./File":11,"./Folder":13,"./categories":14}],13:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});

var _get = function get(_x2, _x3, _x4) { var _again = true; _function: while (_again) { var object = _x2, property = _x3, receiver = _x4; _again = false; if (object === null) object = Function.prototype; var desc = Object.getOwnPropertyDescriptor(object, property); if (desc === undefined) { var parent = Object.getPrototypeOf(object); if (parent === null) { return undefined; } else { _x2 = parent; _x3 = property; _x4 = receiver; _again = true; desc = parent = undefined; continue _function; } } else if ('value' in desc) { return desc.value; } else { var getter = desc.get; if (getter === undefined) { return undefined; } return getter.call(receiver); } } };

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError('Cannot call a class as a function'); } }

function _inherits(subClass, superClass) { if (typeof superClass !== 'function' && superClass !== null) { throw new TypeError('Super expression must either be null or a function, not ' + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var _File2 = require('./File');

var _File3 = _interopRequireDefault(_File2);

var Folder = (function (_File) {
    _inherits(Folder, _File);

    function Folder(name) {
        var parent = arguments.length <= 1 || arguments[1] === undefined ? null : arguments[1];

        _classCallCheck(this, Folder);

        _get(Object.getPrototypeOf(Folder.prototype), 'constructor', this).call(this, name, name, '');

        this.parent = parent;
        this.type = 'folder';
        this.isFolder = true;
        this.files = [];
    }

    return Folder;
})(_File3['default']);

exports['default'] = Folder;
module.exports = exports['default'];

},{"./File":11}],14:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var _Category = require('./Category');

var _Category2 = _interopRequireDefault(_Category);

exports['default'] = [new _Category2['default']('Everything', 'ion-ios-home', null, true), new _Category2['default']('Images', 'ion-ios-photos', imageFilter), new _Category2['default']('Videos', 'ion-ios-videocam', videoFilter), new _Category2['default']('Audio', 'ion-ios-mic', audioFilter), new _Category2['default']('Documents', 'ion-ios-paper', documentFilter)];

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
module.exports = exports['default'];

},{"./Category":10}],15:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});
exports['default'] = draggableDirective;

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

module.exports = exports['default'];

},{}],16:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});
exports['default'] = droppableDirective;

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

module.exports = exports['default'];

},{}],17:[function(require,module,exports){
'use strict';

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var _draggableDirectiveJs = require('./draggableDirective.js');

var _draggableDirectiveJs2 = _interopRequireDefault(_draggableDirectiveJs);

var _droppableDirectiveJs = require('./droppableDirective.js');

var _droppableDirectiveJs2 = _interopRequireDefault(_droppableDirectiveJs);

var _FileManagerControllerJs = require('./FileManagerController.js');

var _FileManagerControllerJs2 = _interopRequireDefault(_FileManagerControllerJs);

var _module = angular.module('MezzoFileManager', ['ui.router']);

_module.config(function ($stateProvider) {
    $stateProvider.state('FileManager', {
        url: '/mezzo/file-manager',
        templateUrl: 'mezzo/file-manager/file/create.html',
        controller: 'FileManagerController',
        controllerAs: 'vm'
    });
});

_module.directive('mezzoDraggable', _draggableDirectiveJs2['default']);
_module.directive('mezzoDroppable', _droppableDirectiveJs2['default']);
_module.controller('FileManagerController', _FileManagerControllerJs2['default']);

},{"./FileManagerController.js":12,"./draggableDirective.js":15,"./droppableDirective.js":16}],18:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});

var _createClass = (function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ('value' in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; })();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError('Cannot call a class as a function'); } }

var ResourceCreateController = (function () {

    /*@ngInject*/

    function ResourceCreateController(api) {
        _classCallCheck(this, ResourceCreateController);

        this.api = api;
    }

    _createClass(ResourceCreateController, [{
        key: 'submit',
        value: function submit() {
            if (this.form.$invalid) {
                return false;
            }

            //TODO
        }
    }, {
        key: 'hasError',
        value: function hasError(formControl) {
            if (Object.keys(formControl.$error).length && formControl.$dirty) {
                return 'has-error';
            }
        }
    }]);

    return ResourceCreateController;
})();

exports['default'] = ResourceCreateController;
module.exports = exports['default'];

},{}],19:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError('Cannot call a class as a function'); } }

var ResourceEditController =

/*@ngInject*/
function ResourceEditController() {
    _classCallCheck(this, ResourceEditController);

    console.log('ResourceEditController');
};

exports['default'] = ResourceEditController;
module.exports = exports['default'];

},{}],20:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});

var _createClass = (function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ('value' in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; })();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError('Cannot call a class as a function'); } }

var ResourceIndexController = (function () {

    /*@ngInject*/

    function ResourceIndexController($scope, api) {
        _classCallCheck(this, ResourceIndexController);

        this.$scope = $scope;
        this.api = api;
        this.models = [];
        this.searchText = '';
        this.selectAll = false;
        this.loading = false;
        this.removing = 0;
    }

    _createClass(ResourceIndexController, [{
        key: 'init',
        value: function init(modelName) {
            this.modelApi = this.api.model(modelName);

            this.loadModels();
        }
    }, {
        key: 'loadModels',
        value: function loadModels() {
            var _this = this;

            this.loading = true;

            return this.modelApi.index().then(function (data) {
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
            var keys = this.getModelKeys(model);
            var values = [];

            keys.forEach(function (key) {
                return values.push(model[key]);
            });

            return values;
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
        value: function create() {
            //TODO
        }
    }, {
        key: 'edit',
        value: function edit() {
            //TODO
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
            })['catch'](function () {
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
            return this.modelApi['delete'](model.id);
        }
    }, {
        key: 'countSelected',
        value: function countSelected() {
            return this.selected().length;
        }
    }]);

    return ResourceIndexController;
})();

exports['default'] = ResourceIndexController;
module.exports = exports['default'];

},{}],21:[function(require,module,exports){
'use strict';

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var _stateProvider = require('./stateProvider');

var _stateProvider2 = _interopRequireDefault(_stateProvider);

var _registerStateDirective = require('./registerStateDirective');

var _registerStateDirective2 = _interopRequireDefault(_registerStateDirective);

var _ResourceIndexController = require('./ResourceIndexController');

var _ResourceIndexController2 = _interopRequireDefault(_ResourceIndexController);

var _ResourceCreateController = require('./ResourceCreateController');

var _ResourceCreateController2 = _interopRequireDefault(_ResourceCreateController);

var _ResourceEditController = require('./ResourceEditController');

var _ResourceEditController2 = _interopRequireDefault(_ResourceEditController);

var _module = angular.module('MezzoResources', []);

_module.provider('$stateProvider', _stateProvider2['default']);
_module.directive('mezzoRegisterState', _registerStateDirective2['default']);
_module.controller('ResourceIndexController', _ResourceIndexController2['default']);
_module.controller('ResourceCreateController', _ResourceCreateController2['default']);
_module.controller('ResourceEditController', _ResourceEditController2['default']);

},{"./ResourceCreateController":18,"./ResourceEditController":19,"./ResourceIndexController":20,"./registerStateDirective":22,"./stateProvider":23}],22:[function(require,module,exports){
/*@ngInject*/
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});
exports['default'] = registerStateDirective;

        function registerStateDirective($stateProvider, $controller) {
    return {
        restrict: 'A',
        link: link
    };

    function link(scope, element, attributes) {
        var uri = attributes.uri;
        var page = attributes.page;
        var action = attributes.action;
        var controller = controllerForPage(page);

        if (!controller) {
            controller = controllerForAction(action);
        }

        $stateProvider.state(page, {
            url: '/mezzo/' + uri,
            templateUrl: '/mezzo/' + uri + '.html',
            controller: controller,
            controllerAs: 'vm'
        });
    }

            function controllerForPage(page) {
                try {
                    var controllerName = page + 'Controller';

                    $controller(controllerName);

                    return controllerName;
                } catch (err) {
                    return null;
                }
    }

            function controllerForAction(action) {
                if (action === 'index') {
                    return 'ResourceIndexController';
                }

                if (action === 'create') {
                    return 'ResourceCreateController';
                }

                if (action === 'edit') {
                    return 'ResourceEditController';
                }

                if (action === 'show') {
                    return 'ResourceShowController';
                }

                throw new Error('No suitable Controller found for action "' + action + '"!');
            }
}

        module.exports = exports['default'];

},{}],23:[function(require,module,exports){
/*@ngInject*/
"use strict";

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports["default"] = stateProvider;

function stateProvider($stateProvider) {
    this.$get = $get;

    function $get() {
        return $stateProvider;
    }
}

module.exports = exports["default"];

},{}],24:[function(require,module,exports){
/*@ngInject*/
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});
exports['default'] = config;

function config($locationProvider, $urlRouterProvider, $httpProvider, $interpolateProvider) {
    $httpProvider.defaults.headers.common.Accept = 'application/vnd.MezzoLabs.v1+json';

    $locationProvider.html5Mode(true);
    $urlRouterProvider.otherwise('/mezzo');
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
}

module.exports = exports['default'];

},{}],25:[function(require,module,exports){
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

    //$('select').select2(); uncomment for model builder
});

},{}]},{},[1]);
