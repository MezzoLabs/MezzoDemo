angular.module("templates", []).run(["$templateCache", function($templateCache) {$templateCache.put("modules/file-manager/aside.html","<!-- Categories -->\r\n<ul class=\"nav nav-pills nav-stacked\">\r\n    <li ng-repeat=\"category in vm.categories\" ng-class=\"vm.isActive(category)\">\r\n        <a href=\"\" ng-click=\"vm.selectCategory(category)\">\r\n            <span style=\"display: inline-block; width: 20px\">\r\n                <span ng-class=\"category.icon\"></span>\r\n            </span>\r\n            <span ng-bind=\"category.label\"></span>\r\n        </a>\r\n    </li>\r\n</ul>\r\n<!-- Categories -->\r\n\r\n<!-- Order by -->\r\n<div class=\"well\">\r\n    <label for=\"order-by\">Order by</label>\r\n    <select id=\"order-by\"\r\n            class=\"form-control\"\r\n            ng-model=\"vm.orderBy\"\r\n            ng-options=\"item for item in vm.orderOptions\">\r\n    </select>\r\n</div>\r\n<!-- Order by -->");
$templateCache.put("modules/file-manager/main.html","<!-- Add folder Modal -->\r\n<div id=\"add-folder-modal\" class=\"modal fade\">\r\n    <div class=\"modal-dialog modal-sm\">\r\n        <div class=\"modal-content\">\r\n            <div class=\"modal-header\">\r\n                <h4 class=\"modal-title\">Add a new folder</h4>\r\n            </div>\r\n            <div class=\"modal-body\">\r\n                <div class=\"input-group\">\r\n                    <input type=\"text\" class=\"form-control\" placeholder=\"Folder name\" ng-model=\"vm.folderName\" mezzo-enter=\"vm.addFolder(vm.folderName)\">\r\n                    <span class=\"input-group-btn\">\r\n                        <button class=\"btn btn-success\" type=\"button\" ng-click=\"vm.addFolder(vm.folderName)\" ng-disabled=\"!vm.folderName\">\r\n                            <span class=\"ion-plus\"></span>\r\n                        </button>\r\n                    </span>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</div>\r\n<!-- Add folder Modal -->\r\n\r\n<!-- Move Modal -->\r\n<div id=\"move-modal\" class=\"modal fade\">\r\n    <div class=\"modal-dialog\">\r\n        <div class=\"modal-content modal-sm\">\r\n            <div class=\"modal-header\">\r\n                <h4 class=\"modal-title\">Move {{vm.selected.title}} to...</h4>\r\n            </div>\r\n            <div class=\"modal-body\">\r\n                <script type=\"text/ng-template\" id=\"node.html\">\r\n                    <button type=\"button\" class=\"btn btn-default btn-xs\" ng-bind=\"folder.title\" ng-click=\"vm.moveTo(folder)\"></button>\r\n                    <ul style=\"list-style-type: none; padding-left: 20px\">\r\n                        <li ng-repeat=\"folder in folder.files\" ng-include=\"\'node.html\'\" ng-if=\"folder.isFolder\"></li>\r\n                    </ul>\r\n                </script>\r\n                <div ng-include=\"\'node.html\'\" ng-init=\"folder = vm.library\"></div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</div>\r\n<!-- Move Modal -->\r\n\r\n<div class=\"well\" style=\"margin-bottom: 0\">\r\n    <!-- Search -->\r\n    <input type=\"search\" class=\"form-control pull-right\" style=\"width: 200px\" placeholder=\"Search\" ng-model=\"vm.search\">\r\n    <!-- Search -->\r\n    <!-- Upload & Add folder -->\r\n    <div class=\"btn-group\">\r\n        <button type=\"button\" class=\"btn btn-primary\" ngf-select=\"vm.upload($files)\" ngf-multiple=\"true\" ngf-drop=\"vm.upload($files)\">\r\n            <span style=\"display: inline-block; width: 20px\">\r\n                <span class=\"ion-ios-cloud-upload\"></span>\r\n            </span>\r\n            <span style=\"display: inline-block\">Upload</span>\r\n        </button>\r\n        <button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#add-folder-modal\">\r\n            <span style=\"display: inline-block; width: 20px\">\r\n                <span class=\"ion-ios-folder\"></span>\r\n            </span>\r\n            <span style=\"display: inline-block\">Add folder</span>\r\n        </button>\r\n    </div>\r\n    <!-- Upload & Add Folder -->\r\n    <!-- Refresh -->\r\n    <button type=\"button\" class=\"btn btn-default\">\r\n        <span class=\"ion-loop\"></span>\r\n    </button>\r\n    <!-- Refresh -->\r\n    <!-- Move & Delete -->\r\n    <div class=\"btn-group\">\r\n        <button type=\"button\" class=\"btn btn-default\"  data-toggle=\"modal\" data-target=\"#move-modal\" ng-disabled=\"!vm.selected\">\r\n            <span style=\"display: inline-block; width: 20px\">\r\n                <span class=\"ion-arrow-swap\"></span>\r\n            </span>\r\n            <span style=\"display: inline-block\">Move</span>\r\n        </button>\r\n        <button type=\"button\" class=\"btn btn-default\" ng-click=\"vm.deleteFiles()\" ng-disabled=\"!vm.selected\">\r\n            <span style=\"display: inline-block; width: 20px\">\r\n                <span class=\"ion-close\"></span>\r\n            </span>\r\n            <span style=\"display: inline-block\">Delete</span>\r\n        </button>\r\n    </div>\r\n    <!-- Move & Delete -->\r\n</div>\r\n\r\n<!-- Folder Navigation -->\r\n<ol class=\"breadcrumb\" style=\"margin-bottom: 0\">\r\n    <li ng-bind=\"vm.search\" ng-if=\"vm.search\"></li>\r\n    <li ng-bind=\"vm.category().label\" ng-if=\"vm.showCategoryAsFolderHierarchy()\"></li>\r\n    <li ng-repeat=\"folder in vm.folderHierarchy()\" ng-class=\"{ active: $last }\" ng-if=\"vm.showFolderHierarchy()\">\r\n        <a href=\"\" ng-bind=\"folder.title\" ng-click=\"vm.enterFolder(folder)\" ng-if=\"!$last\"></a>\r\n        <span ng-bind=\"folder.title\" ng-if=\"$last\"></span>\r\n    </li>\r\n</ol>\r\n<!-- Folder Navigation -->\r\n\r\n<!-- Files -->\r\n<table class=\"table table-hover table-responsive\">\r\n    <tbody>\r\n        <tr ng-repeat=\"file in vm.sortedFiles()\"\r\n            ng-click=\"vm.selectFile(file)\"\r\n            ng-class=\"{ danger: file === vm.selected }\"\r\n            mezzo-draggable\r\n            mezzo-droppable=\"{{file.isFolder}}\"\r\n            data-index=\"{{$index}}\">\r\n            <td style=\"width: 20px\">\r\n                <span class=\"ion-ios-folder\" ng-show=\"file.isFolder\"></span>\r\n                <span ng-class=\"file.icon()\" ng-hide=\"file.isFolder\"></span>\r\n            </td>\r\n            <td>\r\n                <a href=\"\" style=\"color: #555555\" ng-bind=\"file.title\" ng-click=\"vm.enterFolder(file)\" ng-show=\"file.isFolder\"></a>\r\n                <span ng-bind=\"file.title\" ng-hide=\"file.isFolder\"></span>\r\n            </td>\r\n            <td>\r\n                <span ng-show=\"file.isFolder\" ng-bind=\"vm.items(file)\"></span>\r\n            </td>\r\n        </tr>\r\n    </tbody>\r\n</table>\r\n<!-- Files -->");
$templateCache.put("modules/model-builder/aside.html","<!-- Tabs -->\r\n<ul class=\"nav nav-tabs\">\r\n    <li class=\"active\">\r\n        <a href=\"#add-field-tab\" data-toggle=\"tab\">Add Field</a>\r\n    </li>\r\n    <li ng-class=\"{ disabled: vm.modelBuilder.selectedField === null }\">\r\n        <a href=\"#edit-field-tab\" data-toggle=\"tab\">Edit Field</a>\r\n    </li>\r\n</ul>\r\n<!-- Tabs -->\r\n\r\n<br>\r\n\r\n<!-- Tab Content -->\r\n<div class=\"tab-content\" style=\"padding: 5px; overflow-x: hidden\">\r\n\r\n    <!-- Add Field Tab -->\r\n    <div id=\"add-field-tab\" class=\"tab-pane fade in active\">\r\n\r\n        <!-- Save -->\r\n        <button type=\"button\" class=\"btn btn-success btn-block\">\r\n            <span class=\"ion-checkmark-circled pull-right\"></span>\r\n            Save\r\n        </button>\r\n        <!-- Save -->\r\n\r\n        <hr>\r\n\r\n        <!-- Add Buttons -->\r\n        <div class=\"btn-group-vertical btn-block\">\r\n            <button type=\"button\" class=\"btn btn-default\" ng-repeat=\"button in vm.buttons\" ng-click=\"vm.modelBuilder.addField(button.component)\">\r\n                <span class=\"pull-right\" ng-class=\"button.icon\"></span>\r\n                <span ng-bind=\"button.label\"></span>\r\n            </button>\r\n        </div>\r\n        <!-- Add Buttons -->\r\n\r\n    </div>\r\n    <!-- Add Field Tab -->\r\n\r\n    <!-- Edit Field Tab -->\r\n    <div id=\"edit-field-tab\" class=\"tab-pane fade\">\r\n\r\n        <div mezzo-compile=\"vm.modelBuilder.selectedField.optionsDirective\"></div>\r\n\r\n        <hr>\r\n\r\n        <label>Validation Rules</label>\r\n        <div class=\"input-group\">\r\n            <input type=\"text\" class=\"form-control\" placeholder=\"e.g. required\" ng-model=\"vm.modelBuilder.validationRule\" mezzo-enter=\"vm.modelBuilder.addValidationRule()\">\r\n            <span class=\"input-group-btn\">\r\n                <button type=\"button\" class=\"btn btn-default\" ng-click=\"vm.modelBuilder.addValidationRule()\" ng-disabled=\"!vm.modelBuilder.validationRule\">\r\n                    <span class=\"ion-plus\"></span>\r\n                </button>\r\n            </span>\r\n        </div>\r\n        <ul>\r\n            <li ng-repeat=\"rule in vm.modelBuilder.selectedField.options.validationRules\">\r\n                <a href=\"\" class=\"validation-rule\" ng-click=\"vm.modelBuilder.removeValidationRule(rule)\">\r\n                    <span ng-bind=\"rule\"></span> <span class=\"validation-rule-times\">&times;</span>\r\n                </a>\r\n            </li>\r\n        </ul>\r\n\r\n        <hr>\r\n\r\n        <button type=\"button\" class=\"btn btn-danger btn-block\" ng-click=\"vm.modelBuilder.deleteField(vm.modelBuilder.selectedField)\">\r\n            <span class=\"ion-close pull-right\"></span>\r\n            Delete field\r\n        </button>\r\n\r\n    </div>\r\n    <!-- Edit Field Tab -->\r\n\r\n</div>\r\n<!-- Tab Content -->");
$templateCache.put("modules/model-builder/main.html","<div sv-root sv-part=\"vm.modelBuilder.fields\" style=\"padding: 10px\">\r\n    <div ng-repeat=\"field in vm.modelBuilder.fields\" ng-click=\"vm.modelBuilder.selectField(field)\" ng-class=\"{ \'well well-sm\': field === vm.modelBuilder.selectedField }\" sv-element>\r\n        <div mezzo-compile=\"field.mainDirective\"></div>\r\n    </div>\r\n</div>");
$templateCache.put("modules/page-builder/aside.html","<div style=\"padding: 15px\">\r\n    <button type=\"button\" class=\"btn btn-primary btn-block\" ng-click=\"addWidget()\">Add widget</button>\r\n</div>");
$templateCache.put("modules/page-builder/main.html","<div class=\"gridster\"></div>");
$templateCache.put("modules/permissions/permissions.html","<div class=\"wrapper\">\r\n    <div class=\"row\">\r\n        <div class=\"col-sm-6 center-block\">\r\n            <div class=\"well\">\r\n\r\n                <h2>Permissions</h2>\r\n\r\n                <hr>\r\n\r\n                <table class=\"table table-responsive table-hover\">\r\n                    <thead>\r\n\r\n                    <tr>\r\n                        <th>ID</th>\r\n                        <th>Model</th>\r\n                        <th>Name</th>\r\n                        <th>Label</th>\r\n                    </tr>\r\n\r\n                    </thead>\r\n                    <tbody>\r\n\r\n                    <tr ng-show=\"vm.loading\">\r\n                        <td colspan=\"4\">\r\n                            <div class=\"progress\" ng-show=\"vm.loading\">\r\n                                <div class=\"progress-bar progress-bar-striped active\" style=\"width: 100%\">Please be patient...</div>\r\n                            </div>\r\n                        </td>\r\n                    </tr>\r\n\r\n                    <tr ng-repeat=\"permission in vm.permissions track by permission.id\">\r\n                        <td>\r\n                            <strong ng-bind=\"permission.id\"></strong>\r\n                        </td>\r\n                        <td ng-bind=\"permission.model\"></td>\r\n                        <td ng-bind=\"permission.name\"></td>\r\n                        <td ng-bind=\"permission.label\"></td>\r\n                    </tr>\r\n\r\n                    </tbody>\r\n                </table>\r\n\r\n            </div>\r\n        </div>\r\n    </div>\r\n</div>");
$templateCache.put("modules/user/list/user-list.html","<div class=\"wrapper\">\r\n    <div class=\"row\">\r\n        <div class=\"col-sm-6 center-block\">\r\n            <div class=\"well\">\r\n\r\n                <h2>Users</h2>\r\n\r\n                <hr>\r\n\r\n                <table class=\"table table-responsive table-hover\">\r\n                    <thead>\r\n\r\n                        <tr>\r\n                            <th>ID</th>\r\n                            <th>Name</th>\r\n                            <th>Email</th>\r\n                            <th>Created at</th>\r\n                            <th>Updated at</th>\r\n                        </tr>\r\n\r\n                    </thead>\r\n                    <tbody>\r\n\r\n                        <tr ng-show=\"vm.loading\">\r\n                            <td colspan=\"5\">\r\n                                <div class=\"progress\" ng-show=\"vm.loading\">\r\n                                    <div class=\"progress-bar progress-bar-striped active\" style=\"width: 100%\">Please be patient...</div>\r\n                                </div>\r\n                            </td>\r\n                        </tr>\r\n\r\n                        <tr ng-repeat=\"user in vm.users track by user.id\">\r\n                            <td>\r\n                                <strong ng-bind=\"user.id\"></strong>\r\n                            </td>\r\n                            <td>\r\n                                <a ui-sref=\"user-show({ userId: user.id })\" ng-bind=\"user.name\"></a>\r\n                            </td>\r\n                            <td ng-bind=\"user.email\"></td>\r\n                            <td ng-bind=\"vm.moment(user.updated_at)\" title=\"{{user.updated_at}}\" data-toggle=\"tooltip\"></td>\r\n                            <td ng-bind=\"vm.moment(user.created_at)\" title=\"{{user.created_at}}\" data-toggle=\"tooltip\"></td>\r\n                        </tr>\r\n\r\n                    </tbody>\r\n                </table>\r\n\r\n            </div>\r\n        </div>\r\n    </div>\r\n</div>");
$templateCache.put("modules/user/show/user-show.html","<div class=\"wrapper\">\r\n    <div class=\"row\">\r\n        <div class=\"col-sm-4 center-block\">\r\n            <div class=\"well\">\r\n\r\n                <div class=\"progress\" ng-show=\"vm.loading\">\r\n                    <div class=\"progress-bar progress-bar-striped active\" style=\"width: 100%\">Please be patient...</div>\r\n                </div>\r\n\r\n                <form ng-show=\"vm.user\" ng-submit=\"vm.saveUser(vm.user)\">\r\n\r\n                    <h2 class=\"text-center\" ng-bind=\"vm.user.name\"></h2>\r\n\r\n                    <hr>\r\n\r\n                    <div class=\"row text-center\">\r\n                        <div class=\"col-sm-6\">\r\n                            Created <span ng-bind=\"vm.moment(vm.user.created_at)\"></span>\r\n                        </div>\r\n                        <div class=\"col-sm-6\">\r\n                            Last updated <span ng-bind=\"vm.moment(vm.user.updated_at)\"></span>\r\n                        </div>\r\n                    </div>\r\n\r\n                    <hr>\r\n\r\n                    <div class=\"form-group\">\r\n                        <label for=\"name\">Name</label>\r\n                        <input id=\"name\" type=\"text\" class=\"form-control\" ng-model=\"vm.user.name\">\r\n                    </div>\r\n\r\n                    <div class=\"form-group\">\r\n                        <label for=\"email\">Email</label>\r\n                        <input id=\"email\" type=\"text\" class=\"form-control\" ng-model=\"vm.user.email\">\r\n                    </div>\r\n\r\n                    <hr>\r\n\r\n                    <div class=\"row\">\r\n                        <div class=\"col-sm-6\">\r\n                            <a ui-sref=\"user-list\" class=\"btn btn-warning btn-block center-block\">\r\n                                <span class=\"ion-backspace\"></span>\r\n                                Cancel\r\n                            </a>\r\n                        </div>\r\n                        <div class=\"col-sm-6\">\r\n                            <button type=\"submit\" class=\"btn btn-primary btn-block center-block\">\r\n                                <span class=\"ion-checkmark-circled\"></span>\r\n                                Save changes\r\n                            </button>\r\n                        </div>\r\n                    </div>\r\n\r\n                </form>\r\n\r\n            </div>\r\n        </div>\r\n    </div>\r\n</div>");
$templateCache.put("modules/model-builder/components/owner/owner-options.html","");
$templateCache.put("modules/model-builder/components/owner/owner.html","<div class=\"form-group\">\r\n    <label>Owner</label>\r\n    <select class=\"form-control\">\r\n        <option>Simon</option>\r\n        <option>Marc</option>\r\n    </select>\r\n</div>");
$templateCache.put("modules/model-builder/components/dropdown/dropdown-options.html","<div class=\"row\">\r\n\r\n    <div class=\"col-sm-8\">\r\n        <label>Label</label>\r\n        <input type=\"text\" class=\"form-control\" placeholder=\"Label\" ng-model=\"options.label\">\r\n    </div>\r\n\r\n    <div class=\"col-sm-4\">\r\n        <div class=\"checkbox\">\r\n            <label>\r\n                <input type=\"checkbox\" ng-model=\"options.multiple\">\r\n                Multiple\r\n            </label>\r\n        </div>\r\n    </div>\r\n\r\n</div>\r\n\r\n<br/>\r\n\r\n<label>Items</label>\r\n<div class=\"row\">\r\n\r\n    <div class=\"col-sm-5\">\r\n        <input type=\"text\" class=\"form-control\" placeholder=\"Item Label\" ng-model=\"itemLabel\">\r\n    </div>\r\n\r\n    <div class=\"col-sm-5\">\r\n        <input type=\"text\" class=\"form-control\" placeholder=\"Item Value\" ng-model=\"itemValue\">\r\n    </div>\r\n\r\n    <div class=\"col-sm-2\">\r\n        <button type=\"button\" class=\"btn btn-primary\" ng-click=\"addItem(itemLabel, itemValue)\">\r\n            <span class=\"glyphicon glyphicon-plus\"></span>\r\n        </button>\r\n    </div>\r\n\r\n</div>\r\n\r\n<br/>\r\n\r\n<div class=\"btn-group-vertical\">\r\n    <button type=\"button\" class=\"btn btn-default btn-xs\" ng-repeat=\"item in options.items track by $index\" ng-click=\"removeItem($index)\">\r\n        <span ng-bind=\"item.label\"></span> (<span ng-bind=\"item.value\"></span>)\r\n    </button>\r\n</div>");
$templateCache.put("modules/model-builder/components/dropdown/dropdown.html","<label ng-bind=\"options.label\" ng-show=\"options.label.length\"></label>\r\n<select class=\"form-control\" ng-options=\"item.value as item.label for item in options.items track by $index\" ng-model=\"options.selectSingle\" ng-hide=\"options.multiple\"></select>\r\n<select class=\"form-control\" multiple ng-options=\"item.value as item.label for item in options.items track by $index\" ng-model=\"options.selectMultiple\" ng-show=\"options.multiple\"></select>");
$templateCache.put("modules/model-builder/components/checkbox/checkbox-options.html","<label>Label</label>\r\n<input type=\"text\" class=\"form-control\" placeholder=\"Label\" ng-model=\"options.label\">");
$templateCache.put("modules/model-builder/components/checkbox/checkbox.html","<div class=\"checkbox\">\r\n    <label>\r\n        <input type=\"checkbox\">\r\n        <span ng-bind=\"options.label\"></span>\r\n    </label>\r\n</div>");
$templateCache.put("modules/model-builder/components/relation/advanced-options-table.html","<table class=\"table\">\r\n    <thead>\r\n        <tr>\r\n            <th ng-bind=\"options.leftModel.label()\"></th>\r\n            <th ng-bind=\"options.rightModel.label()\"></th>\r\n        </tr>\r\n    </thead>\r\n    <tbody>\r\n        <tr>\r\n            <!-- Left Model -->\r\n            <td>\r\n                <!-- Naming -->\r\n                <div class=\"form-group\">\r\n                    <label>Naming</label>\r\n                    <input type=\"text\" class=\"form-control\" placeholder=\"Naming\" ng-model=\"options.leftModel.naming\">\r\n                </div>\r\n                <!-- Naming -->\r\n                <!-- Column Radio -->\r\n                <div class=\"radio\" ng-hide=\"options.showPivotTable()\">\r\n                    <label>\r\n                        <input type=\"radio\" name=\"column\" ng-value=\"options.Position.LEFT\" ng-model=\"options.columnPosition\" checked>\r\n                        Column\r\n                    </label>\r\n                </div>\r\n                <!-- Column Radio -->\r\n                <!-- Column Name -->\r\n                <div class=\"form-group\" ng-show=\"options.showLeftColumn()\">\r\n                    <label>Column</label>\r\n                    <input type=\"text\" class=\"form-control\" placeholder=\"Column\" ng-model=\"options.leftModel.column\">\r\n                </div>\r\n                <div ng-show=\"options.showPivotTable()\">\r\n                    <label>Column</label>\r\n                    <div class=\"input-group\">\r\n                        <span class=\"input-group-addon\">\r\n                            <span ng-bind=\"options.pivotTable\"></span>.\r\n                        </span>\r\n                        <input type=\"text\" class=\"form-control\" placeholder=\"Column\" ng-model=\"options.leftModel.column\">\r\n                    </div>\r\n                </div>\r\n                <!-- Column Name -->\r\n            </td>\r\n            <!-- Left Model -->\r\n            <!-- Right Model -->\r\n            <td>\r\n                <!-- Naming -->\r\n                <div class=\"form-group\">\r\n                    <label>Naming</label>\r\n                    <input type=\"text\" class=\"form-control\" placeholder=\"Naming\" ng-model=\"options.rightModel.naming\">\r\n                </div>\r\n                <!-- Naming -->\r\n                <!-- Column Radio -->\r\n                <div class=\"radio\" ng-hide=\"options.showPivotTable()\">\r\n                    <label>\r\n                        <input type=\"radio\" name=\"column\" ng-value=\"options.Position.RIGHT\" ng-model=\"options.columnPosition\">\r\n                        Column\r\n                    </label>\r\n                </div>\r\n                <!-- Column Radio -->\r\n                <!-- Column Name -->\r\n                <div class=\"form-group\" ng-show=\"options.showRightColumn()\">\r\n                    <label>Column</label>\r\n                    <input type=\"text\" class=\"form-control\" placeholder=\"Column\" ng-model=\"options.rightModel.column\">\r\n                </div>\r\n                <div ng-show=\"options.showPivotTable()\">\r\n                    <label>Column</label>\r\n                    <div class=\"input-group\">\r\n                        <span class=\"input-group-addon\">\r\n                            <span ng-bind=\"options.pivotTable\"></span>.\r\n                        </span>\r\n                        <input type=\"text\" class=\"form-control\" placeholder=\"Column\" ng-model=\"options.rightModel.column\">\r\n                    </div>\r\n                </div>\r\n                <!-- Column Name -->\r\n            </td>\r\n            <!-- Right Model -->\r\n        </tr>\r\n    </tbody>\r\n</table>");
$templateCache.put("modules/model-builder/components/relation/advanced-options.html","<div class=\"modal fade\">\r\n    <div class=\"modal-dialog\">\r\n        <div class=\"modal-content\">\r\n            <div class=\"modal-header\">\r\n                <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>\r\n                <h4 class=\"modal-title\">Advanced Options</h4>\r\n            </div>\r\n            <div class=\"modal-body\">\r\n                <!-- Title -->\r\n                <div class=\"form-group\">\r\n                    <label>Title</label>\r\n                    <input type=\"text\" class=\"form-control\" placeholder=\"Title\" ng-model=\"options.title\" disabled>\r\n                </div>\r\n                <!-- Title -->\r\n                <!-- Relation Sentence -->\r\n                <p class=\"text-primary\" ng-bind=\"options.sentence()\"></p>\r\n                <!-- Relation Sentence -->\r\n                <!-- Pivot Table -->\r\n                <div class=\"form-group\" ng-show=\"options.showPivotTable()\">\r\n                    <label>Pivot Table</label>\r\n                    <input type=\"text\" class=\"form-control\" placeholder=\"Pivot Table\" ng-model=\"options.pivotTable\">\r\n                </div>\r\n                <!-- Pivot Table -->\r\n                <ng-include src=\"\'modules/model-builder/components/relation/advanced-options-table.html\'\"></ng-include>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</div>");
$templateCache.put("modules/model-builder/components/relation/relation-options.html","<div class=\"form-group\">\r\n    <label>Title</label>\r\n    <input type=\"text\" class=\"form-control\" placeholder=\"Title\" ng-model=\"options.title\">\r\n</div>\r\n\r\n<div class=\"row\">\r\n\r\n    <div class=\"col-xs-5\">\r\n        <select class=\"form-control\" ng-model=\"options.leftModel.mode\">\r\n            <option value=\"1\">One</option>\r\n            <option value=\"n\">Many</option>\r\n        </select>\r\n    </div>\r\n\r\n    <div class=\"col-xs-7\" style=\"vertical-align: middle\">\r\n        <select class=\"form-control\" disabled>\r\n            <option ng-bind=\"options.leftModel.label()\"></option>\r\n        </select>\r\n    </div>\r\n\r\n</div>\r\n\r\n<hr>\r\n\r\n<div style=\"text-align: center\">\r\n    <strong ng-bind=\"options.hasOrHave()\"></strong>\r\n</div>\r\n\r\n<hr>\r\n\r\n<div class=\"row\">\r\n\r\n    <div class=\"col-xs-5\">\r\n        <select class=\"form-control\" ng-model=\"options.rightModel.mode\" ng-change=\"options.onModelUpdate()\">\r\n            <option value=\"1\">One</option>\r\n            <option value=\"n\">Many</option>\r\n        </select>\r\n    </div>\r\n\r\n    <div class=\"col-xs-7\">\r\n        <select class=\"form-control\"\r\n                ng-options=\"model.label() for model in options.models track by model.id\"\r\n                ng-model=\"options.rightModel\"\r\n                ng-change=\"options.onModelUpdate()\"></select>\r\n    </div>\r\n\r\n</div>\r\n\r\n<hr>\r\n\r\n<button type=\"button\" class=\"btn btn-default btn-block text-muted\" data-toggle=\"modal\" data-target=\"div.modal\">\r\n    <span class=\"ion-gear-a pull-right\"></span>\r\n    Advanced Options\r\n</button>\r\n\r\n<ng-include src=\"\'modules/model-builder/components/relation/advanced-options.html\'\"></ng-include>");
$templateCache.put("modules/model-builder/components/relation/relation.html","<div class=\"form-group\">\r\n    <label ng-bind=\"options.title\"></label>\r\n    <p class=\"text-primary\" ng-bind=\"options.sentence()\"></p>\r\n    <select class=\"form-control\" ng-if=\"options.rightModel.mode === options.Mode.ONE\">\r\n        <option>Simon</option>\r\n        <option>Marc</option>\r\n    </select>\r\n    <div ng-show=\"options.rightModel.mode === options.Mode.MANY\">\r\n        <select class=\"form-control chosen\" multiple>\r\n            <option>Beginner</option>\r\n            <option>Intermediate</option>\r\n            <option>Expert</option>\r\n        </select>\r\n        <script>\r\n            $(\'select.chosen\').chosen();\r\n        </script>\r\n    </div>\r\n</div>");
$templateCache.put("modules/model-builder/components/text-single/text-single-options.html","<label>Label</label>\r\n<input type=\"text\" class=\"form-control\" placeholder=\"Label\" ng-model=\"options.label\">\r\n\r\n<label>Placeholder</label>\r\n<input type=\"text\" class=\"form-control\" placeholder=\"Placeholder\" ng-model=\"options.placeholder\">");
$templateCache.put("modules/model-builder/components/text-single/text-single.html","<div class=\"form-group\">\r\n    <label ng-bind=\"options.label\"></label>\r\n    <input type=\"text\" class=\"form-control\" placeholder=\"{{options.placeholder}}\">\r\n</div>");
$templateCache.put("modules/model-builder/components/text-multi/text-multi-options.html","<label>Label</label>\r\n<input type=\"text\" class=\"form-control\" placeholder=\"Label\" ng-model=\"options.label\">\r\n\r\n<label>Placeholder</label>\r\n<input type=\"text\" class=\"form-control\" placeholder=\"Placeholder\" ng-model=\"options.placeholder\">");
$templateCache.put("modules/model-builder/components/text-multi/text-multi.html","<div class=\"form-group\">\r\n    <label ng-bind=\"options.label\"></label>\r\n    <textarea class=\"form-control\" placeholder=\"{{options.placeholder}}\"></textarea>\r\n</div>");}]);