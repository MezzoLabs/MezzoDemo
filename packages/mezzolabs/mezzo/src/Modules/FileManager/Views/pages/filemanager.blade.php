@extends(cockpit_content_container())

@section('content-aside')
    <!-- Categories -->
    <ul class="nav nav-pills nav-stacked">
        <li ng-repeat="category in vm.categories" ng-class="vm.isActive(category)">
            <a href="" ng-click="vm.selectCategory(category)">
                <span style="display: inline-block; width: 20px">
                    <span ng-class="category.icon"></span>
                </span>
                <span ng-bind="category.label"></span>
            </a>
        </li>
    </ul>
    <!-- Categories -->

    <!-- Order by -->
    <div class="well">
        <label for="order-by">Order by</label>
        <select id="order-by"
                class="form-control"
                ng-model="vm.orderBy"
                ng-options="item for item in vm.orderOptions">
        </select>
    </div>
    <!-- Order by -->
@endsection

@section('content')
    <!-- Add folder Modal -->
    <div id="add-folder-modal" class="modal fade">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add a new folder</h4>
                </div>
                <div class="modal-body">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Folder name" ng-model="vm.folderName" mezzo-enter="vm.addFolder(vm.folderName)">
                        <span class="input-group-btn">
                            <button class="btn btn-success" type="button" ng-click="vm.addFolder(vm.folderName)" ng-disabled="!vm.folderName">
                                <span class="ion-plus"></span>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Add folder Modal -->

    <!-- Move Modal -->
    <div id="move-modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content modal-sm">
                <div class="modal-header">
                    <h4 class="modal-title">Move <span ng-bind="vm.selected.title"></span> to...</h4>
                </div>
                <div class="modal-body">
                    <script type="text/ng-template" id="node.html">
                        <button type="button" class="btn btn-default btn-xs" ng-bind="folder.title" ng-click="vm.moveTo(folder)"></button>
                        <ul style="list-style-type: none; padding-left: 20px">
                            <li ng-repeat="folder in folder.files" ng-include="'node.html'" ng-if="folder.isFolder"></li>
                        </ul>
                    </script>
                    <div ng-include="'node.html'" ng-init="folder = vm.library"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Move Modal -->

    <div class="panel panel-bordered" style="margin-bottom: 0">
        <div class="panel-body">
            <!-- Search -->
            <input type="search" class="form-control pull-right" style="width: 200px" placeholder="Search" ng-model="vm.search">
            <!-- Search -->
            <!-- Upload & Add folder -->
            <div class="btn-group">
                <button type="button" class="btn btn-primary" ngf-select="vm.upload($files)" ngf-multiple="true" ngf-drop="vm.upload($files)">
                <span style="display: inline-block; width: 20px">
                    <span class="ion-ios-cloud-upload"></span>
                </span>
                    <span style="display: inline-block">Upload</span>
                </button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-folder-modal">
                <span style="display: inline-block; width: 20px">
                    <span class="ion-ios-folder"></span>
                </span>
                    <span style="display: inline-block">Add folder</span>
                </button>
            </div>
            <!-- Upload & Add Folder -->
            <!-- Refresh -->
            <button type="button" class="btn btn-default">
                <span class="ion-loop"></span>
            </button>
            <!-- Refresh -->
            <!-- Move & Delete -->
            <div class="btn-group">
                <button type="button" class="btn btn-default"  data-toggle="modal" data-target="#move-modal" ng-disabled="!vm.selected">
                <span style="display: inline-block; width: 20px">
                    <span class="ion-arrow-swap"></span>
                </span>
                    <span style="display: inline-block">Move</span>
                </button>
                <button type="button" class="btn btn-default" ng-click="vm.deleteFiles()" ng-disabled="!vm.selected">
                <span style="display: inline-block; width: 20px">
                    <span class="ion-close"></span>
                </span>
                    <span style="display: inline-block">Delete</span>
                </button>
            </div>
            <!-- Move & Delete -->
        </div>
    </div>

    <!-- Folder Navigation -->
    <ol class="breadcrumb" style="margin-bottom: 0">
        <li ng-bind="vm.search" ng-if="vm.search"></li>
        <li ng-bind="vm.category.label" ng-if="vm.showCategoryAsFolderHierarchy()"></li>
        <li ng-repeat="folder in vm.folderHierarchy()" ng-class="{ active: $last }" ng-if="vm.showFolderHierarchy()">
            <a href="" ng-bind="folder.title" ng-click="vm.enterFolder(folder)" ng-if="!$last"></a>
            <span ng-bind="folder.title" ng-if="$last"></span>
        </li>
    </ol>
    <!-- Folder Navigation -->

    <!-- Files -->
    <table class="table table-hover table-responsive">
        <tbody>
        <tr ng-repeat="file in vm.sortedFiles()"
            ng-click="vm.selectFile(file)"
            ng-class="{ danger: file === vm.selected }"
            mezzo-draggable
            mezzo-droppable="[[file.isFolder]]"
            data-index="[[$index]]">
            <td style="width: 20px">
                <span class="ion-ios-folder" ng-show="file.isFolder"></span>
                <span ng-class="file.icon()" ng-hide="file.isFolder"></span>
            </td>
            <td>
                <a href="" style="color: #555555" ng-bind="file.title" ng-click="vm.enterFolder(file)" ng-show="file.isFolder"></a>
                <span ng-bind="file.title" ng-hide="file.isFolder"></span>
            </td>
            <td>
                <span ng-show="file.isFolder" ng-bind="vm.items(file)"></span>
            </td>
        </tr>
        </tbody>
    </table>
    <!-- Files -->

@endsection