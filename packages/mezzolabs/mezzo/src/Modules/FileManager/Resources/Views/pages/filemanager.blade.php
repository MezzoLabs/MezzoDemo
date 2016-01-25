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
    <div class="mezzo__filemanager_container">
        <!-- Move Modal -->
        <div id="move-modal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content modal-sm">
                    <div class="modal-header">
                        <h4 class="modal-title">Move <span ng-bind="vm.selected.title"></span> to...</h4>
                    </div>
                    <div class="modal-body">
                        <script type="text/ng-template" id="node.html">
                            <button type="button" class="btn btn-default btn-xs" ng-bind="folder.title"
                                    ng-click="vm.moveTo(folder)"></button>
                            <ul style="list-style-type: none; padding-left: 20px">
                                <li ng-repeat="folder in folder.files" ng-include="'node.html'"
                                    ng-if="folder.isFolder"></li>
                            </ul>
                        </script>
                        <div ng-include="'node.html'" ng-init="folder = vm.library"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Move Modal -->

        <div class="panel panel-bordered" style="margin-bottom: 0; border-left: 3px solid #eee;">
            <div class="panel-body">
                <!-- Search -->
                <input type="search" class="form-control pull-right" style="width: 200px" placeholder="Search"
                       ng-model="vm.search">
                <!-- Search -->
                <!-- Upload -->
                <button type="button" class="btn btn-primary" ngf-select="vm.upload($file)">
                    <span style="display: inline-block; width: 20px">
                        <span class="ion-ios-cloud-upload"></span>
                    </span>
                    <span style="display: inline-block">Upload</span>
                </button>
                <!-- Upload -->
                <!-- Add Folder -->
                <button type="button" class="btn btn-primary" ng-click="vm.addFolderPrompt()">
                    <span style="display: inline-block; width: 20px">
                        <span class="ion-ios-folder"></span>
                    </span>
                    <span style="display: inline-block">Add folder</span>
                </button>
                <!-- Add Folder -->
                <!-- Refresh -->
                <button type="button" class="btn btn-default" ng-click="vm.refresh()" ng-disabled="vm.loading">
                    <span class="ion-loop"></span>
                </button>
                <!-- Refresh -->
                <!-- Move -->
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#move-modal"
                        ng-disabled="!vm.canMoveOrDelete()">
                    <span style="display: inline-block; width: 20px">
                        <span class="ion-arrow-swap"></span>
                    </span>
                    <span style="display: inline-block">Move</span>
                </button>
                <!-- Move -->
                <!-- Delete -->
                <button type="button" class="btn btn-default" ng-click="vm.deleteFiles()"
                        ng-disabled="!vm.canMoveOrDelete()">
                    <span style="display: inline-block; width: 20px">
                        <span class="ion-close"></span>
                    </span>
                    <span style="display: inline-block">Delete</span>
                </button>
                <!-- Delete -->
            </div>
        </div>

        <!-- Folder Navigation -->
        <ol class="breadcrumb" style="margin-bottom: 0; border-left: 3px solid #eee;">
            <li ng-bind="vm.search" ng-if="vm.search"></li>
            <li ng-bind="vm.category.label" ng-if="vm.showCategoryAsFolderHierarchy()"></li>
            <li ng-repeat="folder in vm.folderHierarchy()" ng-class="{ active: $last }"
                ng-if="vm.showFolderHierarchy()">
                <a href="" ng-bind="folder.title" ng-click="vm.enterFolder(folder)" ng-if="!$last"></a>
                <span ng-bind="folder.title" ng-if="$last"></span>
            </li>
        </ol>
        <!-- Folder Navigation -->

        <!-- Files -->
        <table class="files table table-hover table-responsive">
            <tbody>
            <tr ng-repeat="file in vm.sortedFiles()"
                ng-click="vm.selectFile(file)"
                ng-class="{ danger: file === vm.selected }"
                mezzo-draggable="@{{ !file.isFolder }}"
                mezzo-droppable="@{{ file.isFolder }}"
                data-index="@{{ $index }}">
                <td style="width: 20px">
                    <span class="ion-ios-folder" ng-show="file.isFolder"></span>
                    <span ng-class="file.icon()" ng-hide="file.isFolder"></span>
                </td>
                <td>
                    <a href="" style="color: #555555" ng-bind="file.title" ng-click="vm.enterFolder(file)"
                       ng-show="file.isFolder"></a>
                    <span ng-bind="file.title" ng-hide="file.isFolder"></span>
                </td>
                <td>
                    <span ng-show="file.isFolder" ng-bind="vm.items(file)"></span>
                </td>
            </tr>
            </tbody>
        </table>
        <!-- Files -->
    </div>

@endsection

@section('quickview_title')
    File
@endsection

@section('quickview_content')
    <div class="section" ng-if="vm.selected.thumbnail()">
        <img style="padding: 3px;" class="img-responsive" ng-src="@{{ vm.selected.thumbnail('small') }}"/>
    </div>
    <hr/>

    <div class="section section-file-info wrapper">
        <p class="attribute-info">
            <label>Name</label>
            <input class="form-control" type="text" disabled value="@{{ vm.selected.name }}"/>
        </p>
        <p class="attribute-info">
            <label>Folder</label>
            <input class="form-control" type="text" disabled value="@{{ vm.selected.displayFolderPath() }}"/>
        </p>
        <p class="attribute-info">
            <label>Link</label>
        <div class="input-group">
            <input class="form-control" style="height: 38px;" type="text" disabled value="@{{ vm.selected.url }}"/>
            <span class="input-group-btn">
                <a class="btn btn-info" target="_blank" ng-href="@{{ vm.selected.url }}"><i
                            class="fa fa-chevron-right"></i></a>
            </span>
        </div><!-- /input-group -->

        </p>
    </div>
    <hr/>
    <div class="section section-addon-inputs  wrapper">
        <div class="form-group" ng-if="vm.selected.isImage()">
            <label>{{ cockpit_form()->title('imagefile', 'caption') }}</label>
            <input ng-model="vm.selected.addon.caption" name="caption"
                   class="form-control" {!! cockpit_form()->attributes('imagefile', 'caption') !!} >
        </div>
        <input type="submit" ng-click="vm.submitAddon()" class="btn btn-primary btn-block">
    </div>

@endsection