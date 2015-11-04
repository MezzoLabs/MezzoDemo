(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
'use strict';

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var _setupConfig = require('./setup/config');

var _setupConfig2 = _interopRequireDefault(_setupConfig);

var _setupAddState = require('./setup/add-state');

var _setupAddState2 = _interopRequireDefault(_setupAddState);

var _setupRun = require('./setup/run');

var _setupRun2 = _interopRequireDefault(_setupRun);

var _register = require('./register');

var _register2 = _interopRequireDefault(_register);

var app = angular.module('Mezzo', ['ui.router', 'templates', 'angular-sortable-view', 'ngFileUpload', 'ngMessages']);

app.config(_setupConfig2['default']);
(0, _setupAddState2['default'])(app);
app.run(_setupRun2['default']);
(0, _register2['default'])(app);

},{"./register":52,"./setup/add-state":53,"./setup/config":54,"./setup/run":56}],2:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError('Cannot call a class as a function'); } }

var prefix = '/mezzo/';

var Route = function Route(url, views) {
    _classCallCheck(this, Route);

    this.url = prefix + url;
    this.views = views;
};

exports['default'] = Route;
module.exports = exports['default'];

},{}],3:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError('Cannot call a class as a function'); } }

var _Route = require('./Route');

var _Route2 = _interopRequireDefault(_Route);

var State = function State(name, url, views) {
    _classCallCheck(this, State);

    this.name = name;
    this.route = new _Route2['default'](url, views);
};

exports['default'] = State;
module.exports = exports['default'];

},{"./Route":2}],4:[function(require,module,exports){
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

},{}],5:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});
exports['default'] = { name: 'mezzoEnter', directive: directive };

/*@ngInject*/function directive() {
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

},{}],6:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var _State = require('./State');

var _State2 = _interopRequireDefault(_State);

exports['default'] = { name: 'mezzoRegisterState', directive: directive };

/*@ngInject*/
function directive(addState) {
    return {
        restrict: 'A',
        link: link
    };

    function link(scope, element, attributes) {
        var uri = attributes.uri;
        var title = attributes.title;
        var templateUrl = '/mezzo/' + uri + '.html';
        var state = new _State2['default'](title, uri, {
            main: {
                templateUrl: templateUrl
            }
        });

        addState(state);
    }
}
module.exports = exports['default'];

},{"./State":3}],7:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});
var id = 0;

exports['default'] = { name: 'uid', service: service };

/*@ngInject*/function service() {
    return uid;
}

function uid() {
    return id++;
}
module.exports = exports['default'];

},{}],8:[function(require,module,exports){
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
            return this.hasExtension('png', 'jpg', 'gif');
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

},{}],9:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});

var _get = function get(_x2, _x3, _x4) { var _again = true; _function: while (_again) { var object = _x2, property = _x3, receiver = _x4; desc = parent = getter = undefined; _again = false; if (object === null) object = Function.prototype; var desc = Object.getOwnPropertyDescriptor(object, property); if (desc === undefined) { var parent = Object.getPrototypeOf(object); if (parent === null) { return undefined; } else { _x2 = parent; _x3 = property; _x4 = receiver; _again = true; continue _function; } } else if ('value' in desc) { return desc.value; } else { var getter = desc.get; if (getter === undefined) { return undefined; } return getter.call(receiver); } } };

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

},{"./File":8}],10:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});

var _createClass = (function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ('value' in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; })();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError('Cannot call a class as a function'); } }

var FilesAsideController = (function () {

    /*@ngInject*/
    function FilesAsideController(fileManager) {
        _classCallCheck(this, FilesAsideController);

        this.fileManager = fileManager;
        this.categories = [{ label: 'Everything', icon: 'ion-ios-home', everything: true }, { label: 'Images', icon: 'ion-ios-photos', filter: function filter(file) {
                return file.isImage();
            } }, { label: 'Videos', icon: 'ion-ios-videocam', filter: function filter(file) {
                return file.isVideo();
            } }, { label: 'Audio', icon: 'ion-ios-mic', filter: function filter(file) {
                return file.isAudio();
            } }, { label: 'Documents', icon: 'ion-ios-paper', filter: function filter(file) {
                return file.isDocument();
            } }];
        this.fileManager.category = this.categories[0];
        this.orderOptions = ['Title', 'Last modified'];
        this.orderBy = this.orderOptions[0];
    }

    _createClass(FilesAsideController, [{
        key: 'isActive',
        value: function isActive(category) {
            if (category === this.fileManager.category) {
                return 'active';
            }
        }
    }, {
        key: 'selectCategory',
        value: function selectCategory(category) {
            this.fileManager.category = category;
        }
    }]);

    return FilesAsideController;
})();

exports['default'] = { name: 'FilesAsideController', controller: FilesAsideController };
module.exports = exports['default'];

},{}],11:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});
exports['default'] = { name: 'mezzoDraggable', directive: directive };

/*@ngInject*/function directive() {
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

},{}],12:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});
exports['default'] = { name: 'mezzoDroppable', directive: directive };

/*@ngInject*/function directive(fileManager) {
    return {
        restrict: 'A',
        link: link
    };

    function link(scope, element, attributes) {
        var $element = $(element);
        var droppable = attributes.mezzoDroppable;

        if (droppable === 'true') {
            $element.droppable({
                hoverClass: 'success',
                drop: function drop(event, ui) {
                    var draggable = ui.draggable;

                    ui.helper.remove();
                    fileManager.drop(element, draggable);
                }
            });
        }
    }
}
module.exports = exports['default'];

},{}],13:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});

var _createClass = (function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ('value' in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; })();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError('Cannot call a class as a function'); } }

exports['default'] = { name: 'fileManager', service: service };

/*@ngInject*/function service() {
    return new FileManagerService();
}

var FileManagerService = (function () {
    function FileManagerService() {
        _classCallCheck(this, FileManagerService);

        this.category = null;
        this.onDrop = null;
    }

    _createClass(FileManagerService, [{
        key: 'drop',
        value: function drop(droppable, draggable) {
            this.onDrop(droppable, draggable);
        }
    }]);

    return FileManagerService;
})();

module.exports = exports['default'];

},{}],14:[function(require,module,exports){
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

var FilesMainController = (function () {

    /*@ngInject*/
    function FilesMainController($scope, fileManager) {
        var _this = this;

        _classCallCheck(this, FilesMainController);

        this.$scope = $scope;
        this.fileManager = fileManager;

        this.selected = null;
        this.library = new _Folder2['default']('Library');
        var folder1 = new _Folder2['default']('folder1', this.library);
        var folder2 = new _Folder2['default']('folder2', this.library);
        var folder3 = new _Folder2['default']('folder3', folder1);
        folder1.files = [folder3, new _File2['default']('File 3', 'file3', 'mp3')];

        this.library.files = [folder1, folder2, new _File2['default']('File 1', 'file1', 'txt'), new _File2['default']('File 2', 'file2', 'jpg')];

        this.folder = this.library;
        this.files = this.library.files;

        fileManager.onDrop = function (droppable, draggable) {
            var files = _this.sortedFiles();
            var folderIndex = $(droppable).data('index');
            var draggedIndex = $(draggable).data('index');
            var folder = files[folderIndex];
            var dragged = files[draggedIndex];

            _this.moveFile(dragged, folder);
            _this.$scope.$apply();
        };
    }

    _createClass(FilesMainController, [{
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
            return this.category().everything && !this.search;
        }
    }, {
        key: 'showCategoryAsFolderHierarchy',
        value: function showCategoryAsFolderHierarchy() {
            return !this.category().everything && !this.search;
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

            var category = this.fileManager.category;

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
        key: 'category',
        value: function category() {
            return this.fileManager.category;
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
        value: function upload(files) {
            // TODO: implement upload
        }
    }]);

    return FilesMainController;
})();

exports['default'] = { name: 'FilesMainController', controller: FilesMainController };
module.exports = exports['default'];

},{"./File":8,"./Folder":9}],15:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var _commonState = require('../../common/State');

var _commonState2 = _interopRequireDefault(_commonState);

exports['default'] = new _commonState2['default']('files', 'files', {
    aside: {
        templateUrl: 'modules/file-manager/aside.html',
        controller: 'FilesAsideController as vm'
    },
    main: {
        templateUrl: 'modules/file-manager/main.html',
        controller: 'FilesMainController as vm'
    }
});
module.exports = exports['default'];

},{"../../common/State":3}],16:[function(require,module,exports){
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
                templateUrl: 'modules/model-builder/components/' + templateUrl,
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

},{}],17:[function(require,module,exports){
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
                templateUrl: 'modules/model-builder/components/' + templateUrl,
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

},{}],18:[function(require,module,exports){
'use strict';

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var _ComponentOptions = require('../ComponentOptions');

var _ComponentOptions2 = _interopRequireDefault(_ComponentOptions);

module.exports = new _ComponentOptions2['default']('mezzoCheckboxOptions', 'checkbox/checkbox-options.html');

},{"../ComponentOptions":17}],19:[function(require,module,exports){
'use strict';

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var _Component = require('../Component');

var _Component2 = _interopRequireDefault(_Component);

module.exports = new _Component2['default']('mezzoCheckbox', 'checkbox/checkbox.html', modifyOptions);

function modifyOptions(options) {
    options.label = 'Label';
}

},{"../Component":16}],20:[function(require,module,exports){
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

},{}],21:[function(require,module,exports){
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

},{"../ComponentOptions":17}],22:[function(require,module,exports){
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

},{"../Component":16}],23:[function(require,module,exports){
'use strict';

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var _ComponentOptions = require('../ComponentOptions');

var _ComponentOptions2 = _interopRequireDefault(_ComponentOptions);

module.exports = new _ComponentOptions2['default']('mezzoOwnerOptions', 'owner/owner-options.html');

},{"../ComponentOptions":17}],24:[function(require,module,exports){
'use strict';

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var _Component = require('../Component');

var _Component2 = _interopRequireDefault(_Component);

module.exports = new _Component2['default']('mezzoOwner', 'owner/owner.html', modifyOptions);

function modifyOptions(options) {}

},{"../Component":16}],25:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});
exports['default'] = {
    ONE: '1',
    MANY: 'n'
};
module.exports = exports['default'];

},{}],26:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});

var _createClass = (function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ('value' in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; })();

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError('Cannot call a class as a function'); } }

var _Mode = require('./Mode');

var _Mode2 = _interopRequireDefault(_Mode);

var Model = (function () {
    function Model(id, name) {
        _classCallCheck(this, Model);

        this.id = id;
        this.name = name;
        this.mode = _Mode2['default'].ONE;

        this.updateNaming();
        this.updateColumn();
    }

    _createClass(Model, [{
        key: 'label',
        value: function label() {
            if (this.mode === _Mode2['default'].ONE) {
                return this.name;
            }

            if (this.mode === _Mode2['default'].MANY) {
                return pluralize(this.name);
            }

            return this.name;
        }
    }, {
        key: 'updateNaming',
        value: function updateNaming() {
            this.naming = this.name.toLowerCase();
        }
    }, {
        key: 'updateColumn',
        value: function updateColumn() {
            this.column = this.name.toLowerCase() + '_id';
        }
    }]);

    return Model;
})();

exports['default'] = Model;
module.exports = exports['default'];

},{"./Mode":25}],27:[function(require,module,exports){
"use strict";

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports["default"] = alphabetical;

function alphabetical(str1, str2) {
    if (str1 < str2) {
        return -1;
    }

    if (str1 > str2) {
        return 1;
    }

    return 0;
}
module.exports = exports["default"];

},{}],28:[function(require,module,exports){
'use strict';

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var _ComponentOptions = require('../ComponentOptions');

var _ComponentOptions2 = _interopRequireDefault(_ComponentOptions);

module.exports = new _ComponentOptions2['default']('mezzoRelationOptions', 'relation/relation-options.html');

},{"../ComponentOptions":17}],29:[function(require,module,exports){
'use strict';

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var _Component = require('../Component');

var _Component2 = _interopRequireDefault(_Component);

var _Model = require('./Model');

var _Model2 = _interopRequireDefault(_Model);

var _Mode = require('./Mode');

var _Mode2 = _interopRequireDefault(_Mode);

var _sentence = require('./sentence');

var _sentence2 = _interopRequireDefault(_sentence);

var _alphabetical = require('./alphabetical');

var _alphabetical2 = _interopRequireDefault(_alphabetical);

var Position = {
    LEFT: 0,
    RIGHT: 1
};

module.exports = new _Component2['default']('mezzoRelation', 'relation/relation.html', modifyOptions);

function modifyOptions(options) {
    options.models = [new _Model2['default'](1, 'User'), new _Model2['default'](2, 'Category')];
    options.leftModel = new _Model2['default'](0, 'Tutorial');
    options.rightModel = options.models[0];
    options.title = null;
    options.columnPosition = Position.LEFT;
    options.pivotTable = null;
    options.Mode = _Mode2['default'];
    options.Position = Position;

    options.sentence = function () {
        return (0, _sentence2['default'])(options.leftModel, options.rightModel);
    };
    options.onModelUpdate = onModelUpdate;
    options.showPivotTable = function () {
        return options.leftModel.mode === _Mode2['default'].MANY && options.rightModel.mode === _Mode2['default'].MANY;
    };
    options.showLeftColumn = function () {
        return options.columnPosition === Position.LEFT && !options.showPivotTable();
    };
    options.showRightColumn = function () {
        return options.columnPosition === Position.RIGHT && !options.showPivotTable();
    };
    options.hasOrHave = function () {
        return options.leftModel.mode === _Mode2['default'].ONE ? 'has' : 'have';
    };

    onModelUpdate();

    function onModelUpdate() {
        options.title = options.rightModel.label();
        options.pivotTable = getPivotTableName();

        options.rightModel.updateNaming();
        options.rightModel.updateColumn();
    }

    function getPivotTableName() {
        var modelNames = [options.leftModel.name.toLowerCase(), options.rightModel.name.toLocaleLowerCase()];
        var sortedNames = modelNames.sort(_alphabetical2['default']);

        return sortedNames.join('_');
    }
}

},{"../Component":16,"./Mode":25,"./Model":26,"./alphabetical":27,"./sentence":30}],30:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var _Mode = require('./Mode');

var _Mode2 = _interopRequireDefault(_Mode);

exports['default'] = phrase;

function phrase(model1, model2) {
    var sentence = [];

    if (model1.mode === _Mode2['default'].ONE) {
        sentence.push('One ' + model1.label() + ' has');
    } else {
        sentence.push('Many ' + model1.label() + ' have');
    }

    if (model2.mode === _Mode2['default'].ONE) {
        sentence.push('one');
    } else {
        sentence.push('many');
    }

    sentence.push(model2.label());

    return sentence.join(' ');
}
module.exports = exports['default'];

},{"./Mode":25}],31:[function(require,module,exports){
'use strict';

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var _ComponentOptions = require('../ComponentOptions');

var _ComponentOptions2 = _interopRequireDefault(_ComponentOptions);

module.exports = new _ComponentOptions2['default']('mezzoTextMultiOptions', 'text-multi/text-multi-options.html');

},{"../ComponentOptions":17}],32:[function(require,module,exports){
'use strict';

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var _Component = require('../Component');

var _Component2 = _interopRequireDefault(_Component);

module.exports = new _Component2['default']('mezzoTextMulti', 'text-multi/text-multi.html', modifyOptions);

function modifyOptions(options) {
    options.label = 'Label';
    options.placeholder = 'Placeholder';
}

},{"../Component":16}],33:[function(require,module,exports){
'use strict';

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var _ComponentOptions = require('../ComponentOptions');

var _ComponentOptions2 = _interopRequireDefault(_ComponentOptions);

module.exports = new _ComponentOptions2['default']('mezzoTextSingleOptions', 'text-single/text-single-options.html');

},{"../ComponentOptions":17}],34:[function(require,module,exports){
'use strict';

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var _Component = require('../Component');

var _Component2 = _interopRequireDefault(_Component);

module.exports = new _Component2['default']('mezzoTextSingle', 'text-single/text-single.html', modifyOptions);

function modifyOptions(options) {
    options.label = 'Label';
    options.placeholder = 'Placeholder';
}

},{"../Component":16}],35:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError('Cannot call a class as a function'); } }

var ModelBuilderController =

/*@ngInject*/function ModelBuilderController(modelBuilder) {
    _classCallCheck(this, ModelBuilderController);

    this.modelBuilder = modelBuilder;
    this.buttons = [button('Single line text', 'ion-document', 'text-single'), button('Paragraph text', 'ion-document-text', 'text-multi'), button('Checkbox', 'ion-android-checkbox-outline', 'checkbox'), button('Dropdown', 'ion-android-arrow-dropdown-circle', 'dropdown'), button('Relation', 'ion-arrow-swap', 'relation'), button('Owner', 'ion-person', 'owner')];
};

exports['default'] = { name: 'ModelBuilderController', controller: ModelBuilderController };

function button(label, icon, component) {
    return { label: label, icon: icon, component: component };
}
module.exports = exports['default'];

},{}],36:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});

var _createClass = (function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ('value' in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; })();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError('Cannot call a class as a function'); } }

exports['default'] = { name: 'modelBuilder', service: service };

/*@ngInject*/function service(componentService, uid) {
    return new ModelBuilder(componentService, uid);
}

var ModelBuilder = (function () {
    function ModelBuilder(componentService, uid) {
        _classCallCheck(this, ModelBuilder);

        this.componentService = componentService;
        this.uid = uid;
        this.fields = [];
        this.selectedField = null;
    }

    _createClass(ModelBuilder, [{
        key: 'addField',
        value: function addField(name) {
            var field = {
                id: this.uid(),
                name: name,
                options: {
                    validationRules: []
                },
                mainDirective: 'mezzo-' + name,
                optionsDirective: 'mezzo-' + name + '-options'
            };

            this.componentService.setOptions(field.options);
            this.fields.push(field);
        }
    }, {
        key: 'deleteField',
        value: function deleteField(deleted) {
            $('a[href="#add-field-tab"]').tab('show');

            this.selectedField = null;

            for (var i = 0; i < this.fields.length; i++) {
                var field = this.fields[i];

                if (field.id === deleted.id) {
                    this.fields.splice(i, 1);
                    return;
                }
            }
        }
    }, {
        key: 'selectField',
        value: function selectField(field) {
            $('a[href="#edit-field-tab"]').tab('show');

            this.selectedField = field;

            this.componentService.setOptions(field.options);
        }
    }, {
        key: 'addValidationRule',
        value: function addValidationRule() {
            var rule = this.validationRule.toLowerCase();

            if (!rule || rule.length === 0 || this.hasValidationRule(rule)) {
                return false;
            }

            this.validationRule = '';

            this.selectedField.options.validationRules.push(rule);
        }
    }, {
        key: 'removeValidationRule',
        value: function removeValidationRule(validationRule) {
            var rules = this.selectedField.options.validationRules;

            for (var i = 0; i < rules.length; i++) {
                if (rules[i] === validationRule) {
                    rules.splice(i, 1);
                    return;
                }
            }
        }
    }, {
        key: 'hasValidationRule',
        value: function hasValidationRule(validationRule) {
            var rules = this.selectedField.options.validationRules;

            for (var i = 0; i < rules.length; i++) {
                if (rules[i] === validationRule) {
                    return true;
                }
            }

            return false;
        }
    }]);

    return ModelBuilder;
})();

module.exports = exports['default'];

},{}],37:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var _commonState = require('../../common/State');

var _commonState2 = _interopRequireDefault(_commonState);

exports['default'] = new _commonState2['default']('models', 'models', {
    aside: {
        templateUrl: 'modules/model-builder/aside.html',
        controller: 'ModelBuilderController as vm'
    },
    main: {
        templateUrl: 'modules/model-builder/main.html',
        controller: 'ModelBuilderController as vm'
    }
});
module.exports = exports['default'];

},{"../../common/State":3}],38:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});
exports['default'] = { name: 'PagesAsideController', controller: controller };

/*@ngInject*/function controller($scope) {
    $scope.addWidget = addWidget;

    function addWidget() {
        var gridster = $('div.gridster').gridster().data('gridster');

        gridster.add_widget('<div class="panel panel-bordered"><i class="ion-close"></i></div>');

        $('.panel .ion-close').click(function () {
            gridster.remove_widget($(this).parent('.panel'));
        });
    }
}
module.exports = exports['default'];

},{}],39:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});
exports['default'] = { name: 'PagesMainController', controller: controller };

function controller() {
    $('div.gridster').gridster({
        widget_margins: [10, 10],
        widget_base_dimensions: [140, 140],
        widget_selector: 'div',
        resize: {
            enabled: true
        }
    });
}
module.exports = exports['default'];

},{}],40:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var _commonState = require('../../common/State');

var _commonState2 = _interopRequireDefault(_commonState);

exports['default'] = new _commonState2['default']('pages', 'pages', {
    aside: {
        templateUrl: 'modules/page-builder/aside.html',
        controller: 'PagesAsideController'
    },
    main: {
        templateUrl: 'modules/page-builder/main.html',
        controller: 'PagesMainController'
    }
});
module.exports = exports['default'];

},{"../../common/State":3}],41:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var _commonState = require('../../common/State');

var _commonState2 = _interopRequireDefault(_commonState);

exports['default'] = new _commonState2['default']('permissions', 'permissions', {
    main: {
        templateUrl: 'modules/permissions/permissions.html',
        controller: 'PermissionsController',
        controllerAs: 'vm'
    }
});
module.exports = exports['default'];

},{"../../common/State":3}],42:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError('Cannot call a class as a function'); } }

var PermissionsController =

/*@ngInject*/function PermissionsController($http) {
    var _this = this;

    _classCallCheck(this, PermissionsController);

    this.$http = $http;
    this.permissions = [];
    this.loading = true;

    this.$http.get('/api/permissions').then(function (response) {
        _this.loading = false;
        _this.permissions = response.data;
    })['catch'](function (err) {
        return console.error(err);
    });
};

exports['default'] = { name: 'PermissionsController', controller: PermissionsController };
module.exports = exports['default'];

},{}],43:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});

var _createClass = (function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ('value' in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; })();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError('Cannot call a class as a function'); } }

var ResourceCreateController = (function () {

    /*@ngInject*/
    function ResourceCreateController($http) {
        _classCallCheck(this, ResourceCreateController);

        this.$http = $http;
        this.model = {};

        /* Fake data */
        this.users = [{ id: 0, name: 'Simon' }, { id: 1, name: 'Marc' }, { id: 2, name: 'John Doe' }, { id: 3, name: 'MSDOS Manfred' }];
        this.tutorials = [{ id: 0, name: 'Mezzo Tutorial' }, { id: 1, name: 'How to peel an Egg Tutorial Part 1' }, { id: 2, name: 'How to sit down Tutorial' }];
        /* Fake data */
    }

    _createClass(ResourceCreateController, [{
        key: 'submit',
        value: function submit() {
            if (this.form.$invalid) {
                return false;
            }

            var payload = {
                title: this.model.title,
                body: this.model.body,
                created_at: this.model.createdAt,
                updated_at: this.model.updatedAt,
                user_id: this.model.userId,
                parent: this.model.parent
            };

            this.$http.post('/api/tutorials', payload).then(function (result) {
                console.log(result);
            })['catch'](function (err) {
                return console.error(err);
            });
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

exports['default'] = { name: 'ResourceCreateController', controller: ResourceCreateController };
module.exports = exports['default'];

},{}],44:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var _commonState = require('../../../common/State');

var _commonState2 = _interopRequireDefault(_commonState);

exports['default'] = new _commonState2['default']('resource-create', 'model/create', {
    main: {
        templateUrl: '/mezzo/sample/tutorial/create.html',
        controller: 'ResourceCreateController',
        controllerAs: 'vm'
    }
});
module.exports = exports['default'];

},{"../../../common/State":3}],45:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});

var _createClass = (function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ('value' in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; })();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError('Cannot call a class as a function'); } }

var ResourceIndexController = (function () {

    /*@ngInject*/
    function ResourceIndexController($scope, $http) {
        var _this = this;

        _classCallCheck(this, ResourceIndexController);

        this.$scope = $scope;
        this.$http = $http;
        this.models = [];
        this.searchText = '';
        this.selectAll = false;
        this.removing = 0;

        $http.get('/api/tutorials').success(function (response) {
            _this.models = response.data;

            _this.models.forEach(function (model) {
                return model._meta = {};
            });
        }).error(function (err) {
            return console.error(err);
        });
    }

    _createClass(ResourceIndexController, [{
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

            this.removeRemoteModel(model).success(function (result) {
                console.log(result);
                _this5.removeLocalModel(model);
            }).error(function (err) {
                return console.error(err);
            })['finally'](function () {
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
            return this.$http['delete']('/api/tutorials/' + model.id, {
                headers: {
                    Accept: 'application/vnd.MezzoLabs.v1+json'
                }
            });
        }
    }, {
        key: 'countSelected',
        value: function countSelected() {
            return this.selected().length;
        }
    }]);

    return ResourceIndexController;
})();

exports['default'] = { name: 'ResourceIndexController', controller: ResourceIndexController };
module.exports = exports['default'];

},{}],46:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var _commonState = require('../../../common/State');

var _commonState2 = _interopRequireDefault(_commonState);

exports['default'] = new _commonState2['default']('resource-index', 'model/list', {
    main: {
        templateUrl: '/mezzo/sample/tutorial/index.html',
        controller: 'ResourceIndexController',
        controllerAs: 'vm'
    }
});
module.exports = exports['default'];

},{"../../../common/State":3}],47:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var _commonState = require('../../../common/State');

var _commonState2 = _interopRequireDefault(_commonState);

exports['default'] = new _commonState2['default']('user-list', 'users', {
    main: {
        templateUrl: 'modules/user/list/user-list.html',
        controller: 'UserListController',
        controllerAs: 'vm'
    }
});
module.exports = exports['default'];

},{"../../../common/State":3}],48:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});

var _createClass = (function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ('value' in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; })();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError('Cannot call a class as a function'); } }

var UserListController = (function () {

    /*@ngInject*/
    function UserListController($http, userService) {
        _classCallCheck(this, UserListController);

        this.$http = $http;
        this.userService = userService;
        this.users = userService.users || [];

        if (!this.users || this.users.length === 0) {
            this.loadUsers();
        }
    }

    _createClass(UserListController, [{
        key: 'loadUsers',
        value: function loadUsers() {
            var _this = this;

            this.loading = true;

            this.$http.get('/api/users').then(function (response) {
                _this.loading = false;
                _this.users = response.data;
                _this.userService.users = _this.users;

                setTimeout(_this.initTooltips, 1);
            })['catch'](function (err) {
                return console.error(err);
            });
        }
    }, {
        key: 'moment',
        value: (function (_moment) {
            function moment(_x) {
                return _moment.apply(this, arguments);
            }

            moment.toString = function () {
                return _moment.toString();
            };

            return moment;
        })(function (date) {
            return moment(date).fromNow();
        })
    }, {
        key: 'initTooltips',
        value: function initTooltips() {
            $('[data-toggle="tooltip"]').tooltip({
                container: 'body'
            });
        }
    }]);

    return UserListController;
})();

exports['default'] = { name: 'UserListController', controller: UserListController };
module.exports = exports['default'];

},{}],49:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var _commonState = require('../../../common/State');

var _commonState2 = _interopRequireDefault(_commonState);

exports['default'] = new _commonState2['default']('user-show', 'user/:userId', {
    main: {
        templateUrl: 'modules/user/show/user-show.html',
        controller: 'UserShowController',
        controllerAs: 'vm'
    }
});
module.exports = exports['default'];

},{"../../../common/State":3}],50:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});

var _createClass = (function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ('value' in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; })();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError('Cannot call a class as a function'); } }

var UserShowController = (function () {

    /*@ngInject*/
    function UserShowController($http, $stateParams) {
        _classCallCheck(this, UserShowController);

        this.$http = $http;
        this.$routeParams = $stateParams;
        this.user = null;
        this.userId = $stateParams.userId;

        this.loadUser(this.userId);
    }

    _createClass(UserShowController, [{
        key: 'loadUser',
        value: function loadUser(userId) {
            var _this = this;

            this.loading = true;
            var apiUrl = '/api/users/' + userId;

            this.$http.get(apiUrl).then(function (response) {
                _this.loading = false;
                _this.user = response.data.user;
            })['catch'](function (err) {
                return console.error(err);
            });
        }
    }, {
        key: 'saveUser',
        value: function saveUser() {
            this.$http.put('/api/users/' + this.userId, this.user).then(function (response) {
                console.log(response);
            })['catch'](function (err) {
                return console.error(err);
            });
        }
    }, {
        key: 'moment',
        value: (function (_moment) {
            function moment(_x) {
                return _moment.apply(this, arguments);
            }

            moment.toString = function () {
                return _moment.toString();
            };

            return moment;
        })(function (date) {
            return moment(date).fromNow();
        })
    }]);

    return UserShowController;
})();

exports['default'] = { name: 'UserShowController', controller: UserShowController };
module.exports = exports['default'];

},{}],51:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});
exports['default'] = { name: 'userService', service: service };

/*@ngInject*/function service() {
    return {};
}
module.exports = exports['default'];

},{}],52:[function(require,module,exports){
'use strict';

module.exports = function (app) {
				register(require('./common/compile.directive.js'));
				register(require('./common/enter.directive.js'));
				register(require('./common/register-state.directive.js'));
				register(require('./common/uid.service.js'));
				register(require('./modules/file-manager/aside.controller.js'));
				register(require('./modules/file-manager/main.controller.js'));
				register(require('./modules/file-manager/draggable.directive.js'));
				register(require('./modules/file-manager/droppable.directive.js'));
				register(require('./modules/file-manager/file-manager.service.js'));
				register(require('./modules/model-builder/model-builder.controller.js'));
				register(require('./modules/model-builder/model-builder.service.js'));
				register(require('./modules/page-builder/aside.controller.js'));
				register(require('./modules/page-builder/main.controller.js'));
				register(require('./modules/permissions/permissions.controller.js'));
				register(require('./modules/user/user.service.js'));
				register(require('./modules/model-builder/components/component.service.js'));
				register(require('./modules/user/list/user-list.controller.js'));
				register(require('./modules/user/show/user-show.controller.js'));
				register(require('./modules/resource/create/resource-create.controller.js'));
				register(require('./modules/resource/index/resource-index.controller.js'));
				register(require('./modules/model-builder/components/owner/owner-options.directive.js'));
				register(require('./modules/model-builder/components/owner/owner.directive.js'));
				register(require('./modules/model-builder/components/checkbox/checkbox-options.directive.js'));
				register(require('./modules/model-builder/components/checkbox/checkbox.directive.js'));
				register(require('./modules/model-builder/components/dropdown/dropdown-options.directive.js'));
				register(require('./modules/model-builder/components/dropdown/dropdown.directive.js'));
				register(require('./modules/model-builder/components/text-multi/text-multi-options.directive.js'));
				register(require('./modules/model-builder/components/text-multi/text-multi.directive.js'));
				register(require('./modules/model-builder/components/relation/relation-options.directive.js'));
				register(require('./modules/model-builder/components/relation/relation.directive.js'));
				register(require('./modules/model-builder/components/text-single/text-single-options.directive.js'));
				register(require('./modules/model-builder/components/text-single/text-single.directive.js'));

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

},{"./common/compile.directive.js":4,"./common/enter.directive.js":5,"./common/register-state.directive.js":6,"./common/uid.service.js":7,"./modules/file-manager/aside.controller.js":10,"./modules/file-manager/draggable.directive.js":11,"./modules/file-manager/droppable.directive.js":12,"./modules/file-manager/file-manager.service.js":13,"./modules/file-manager/main.controller.js":14,"./modules/model-builder/components/checkbox/checkbox-options.directive.js":18,"./modules/model-builder/components/checkbox/checkbox.directive.js":19,"./modules/model-builder/components/component.service.js":20,"./modules/model-builder/components/dropdown/dropdown-options.directive.js":21,"./modules/model-builder/components/dropdown/dropdown.directive.js":22,"./modules/model-builder/components/owner/owner-options.directive.js":23,"./modules/model-builder/components/owner/owner.directive.js":24,"./modules/model-builder/components/relation/relation-options.directive.js":28,"./modules/model-builder/components/relation/relation.directive.js":29,"./modules/model-builder/components/text-multi/text-multi-options.directive.js":31,"./modules/model-builder/components/text-multi/text-multi.directive.js":32,"./modules/model-builder/components/text-single/text-single-options.directive.js":33,"./modules/model-builder/components/text-single/text-single.directive.js":34,"./modules/model-builder/model-builder.controller.js":35,"./modules/model-builder/model-builder.service.js":36,"./modules/page-builder/aside.controller.js":38,"./modules/page-builder/main.controller.js":39,"./modules/permissions/permissions.controller.js":42,"./modules/resource/create/resource-create.controller.js":43,"./modules/resource/index/resource-index.controller.js":45,"./modules/user/list/user-list.controller.js":48,"./modules/user/show/user-show.controller.js":50,"./modules/user/user.service.js":51}],53:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});

exports['default'] = function (app) {
    app.provider('addState', /*@ngInject*/function ($stateProvider) {
        this.$get = function () {
            return addState;
        };

        function addState(state) {
            $stateProvider.state(state.name, state.route);
        }
    });
};

module.exports = exports['default'];

},{}],54:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var _states = require('./states');

var _states2 = _interopRequireDefault(_states);

exports['default'] = config;

/*@ngInject*/function config($locationProvider, $stateProvider, $urlRouterProvider, $httpProvider) {
    $httpProvider.defaults.headers.common.Accept = 'application/vnd.MezzoLabs.v1+json';

    $locationProvider.html5Mode(true);
    $urlRouterProvider.otherwise('/mezzo');
    _states2['default'].forEach(function (state) {
        return $stateProvider.state(state.name, state.route);
    });
}
module.exports = exports['default'];

},{"./states":57}],55:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});

exports['default'] = function () {
    $(function () {
        return init();
    });
};

function init() {
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
}
module.exports = exports['default'];

},{}],56:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var _jquery = require('./jquery');

var _jquery2 = _interopRequireDefault(_jquery);

exports['default'] = run;

/*@ngInject*/function run($rootScope, $state) {
    $rootScope.aside = aside;

    (0, _jquery2['default'])();

    function aside() {
        var views = $state.current.views;

        if (views) {
            return views.aside;
        }

        return false;
    }
}
module.exports = exports['default'];

},{"./jquery":55}],57:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, '__esModule', {
    value: true
});

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var _modulesModelBuilderState = require('../modules/model-builder/state');

var _modulesModelBuilderState2 = _interopRequireDefault(_modulesModelBuilderState);

var _modulesPageBuilderStateJs = require('../modules/page-builder/state.js');

var _modulesPageBuilderStateJs2 = _interopRequireDefault(_modulesPageBuilderStateJs);

var _modulesFileManagerState = require('../modules/file-manager/state');

var _modulesFileManagerState2 = _interopRequireDefault(_modulesFileManagerState);

var _modulesResourceIndexState = require('../modules/resource/index/state');

var _modulesResourceIndexState2 = _interopRequireDefault(_modulesResourceIndexState);

var _modulesResourceCreateState = require('../modules/resource/create/state');

var _modulesResourceCreateState2 = _interopRequireDefault(_modulesResourceCreateState);

var _modulesUserList = require('../modules/user/list');

var _modulesUserList2 = _interopRequireDefault(_modulesUserList);

var _modulesUserShow = require('../modules/user/show');

var _modulesUserShow2 = _interopRequireDefault(_modulesUserShow);

var _modulesPermissions = require('../modules/permissions');

var _modulesPermissions2 = _interopRequireDefault(_modulesPermissions);

exports['default'] = [_modulesModelBuilderState2['default'], _modulesPageBuilderStateJs2['default'], _modulesFileManagerState2['default'], _modulesResourceIndexState2['default'], _modulesResourceCreateState2['default'], _modulesUserList2['default'], _modulesUserShow2['default'], _modulesPermissions2['default']];
module.exports = exports['default'];

},{"../modules/file-manager/state":15,"../modules/model-builder/state":37,"../modules/page-builder/state.js":40,"../modules/permissions":41,"../modules/resource/create/state":44,"../modules/resource/index/state":46,"../modules/user/list":47,"../modules/user/show":49}]},{},[1]);
