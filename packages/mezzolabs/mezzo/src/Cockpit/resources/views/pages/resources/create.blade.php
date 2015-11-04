@extends('cockpit::layouts.default.content.container')


@section('content')
    <div class="wrapper">
        <div class="row">
            <div class="col-sm-3 center-block">
                <div class="well">

                    <h1>New Tutorial</h1>

                    <hr>

                    <form name="vm.form" novalidate ng-submit="vm.submit()">

                        <!-- Title -->
                        <div class="form-group" ng-class="vm.hasError(vm.form.title)">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Title"
                                   ng-model="vm.model.title"
                                   required minlength="3" maxlength="30">

                            <div class="help-block text-danger" ng-messages="vm.form.title.$error"
                                 ng-show="vm.form.title.$dirty">
                                <div ng-message="required">required</div>
                                <div ng-message="minlength">minlength</div>
                                <div ng-message="maxlength">maxlength</div>
                            </div>
                        </div>
                        <!-- Title -->

                        <!-- Body -->
                        <div class="form-group" ng-class="vm.hasError(vm.form.body)">
                            <label>Body</label>
                        <textarea name="body" class="form-control" placeholder="Body" ng-model="vm.model.body"
                                  required minlength="10" maxlength="1000">
                        </textarea>

                            <div class="help-block text-danger" ng-messages="vm.form.body.$error"
                                 ng-show="vm.form.body.$dirty">
                                <div ng-message="required">required</div>
                                <div ng-message="minlength">minlength</div>
                                <div ng-message="maxlength">maxlength</div>
                            </div>
                        </div>
                        <!-- Body -->

                        <!-- Created at -->
                        <div class="form-group" ng-class="vm.hasError(vm.form.createdAt)">
                            <label>Created at</label>
                            <input type="datetime-local" name="createdAt" class="form-control" placeholder="Created at"
                                   ng-model="vm.model.createdAt"
                                   required>

                            <div class="help-block text-danger" ng-messages="vm.form.createdAt.$error"
                                 ng-show="vm.form.createdAt.$dirty">
                                <div ng-message="required">required</div>
                            </div>
                        </div>
                        <!-- Created at -->

                        <!-- Updated at -->
                        <div class="form-group" ng-class="vm.hasError(vm.form.updatedAt)">
                            <label>Updated at</label>
                            <input type="datetime-local" name="updatedAt" class="form-control" placeholder="Updated at"
                                   ng-model="vm.model.updatedAt"
                                   required>

                            <div class="help-block text-danger" ng-messages="vm.form.updatedAt.$error"
                                 ng-show="vm.form.updateddAt.$dirty">
                                <div ng-message="required">required</div>
                            </div>
                        </div>
                        <!-- Updated at -->

                        <!-- User -->
                        <div class="form-group" ng-class="vm.hasError(vm.form.userId)">
                            <label>User</label>
                            <select name="userId" class="form-control" ng-model="vm.model.userId"
                                    ng-options="user.name for user in vm.users track by user.id"
                                    required>
                            </select>

                            <div class="help-block text-danger" ng-messages="vm.form.userId.$error"
                                 ng-show="vm.form.userId.$dirty">
                                <div ng-message="required">required</div>
                            </div>
                        </div>
                        <!-- User -->

                        <!-- Parent -->
                        <div class="form-group">
                            <label>Parent</label>
                            <select name="parent" class="form-control" ng-model="vm.model.parent"
                                    ng-options="tutorial.name for tutorial in vm.tutorials track by tutorial.id">
                            </select>
                        </div>
                        <!-- Parent -->

                        <hr>

                        <!-- Submit -->
                        <button type="submit" class="btn btn-primary center-block" ng-disabled="vm.form.$invalid">
                            <span class="ion-checkmark-circled"></span>
                            Create new Tutorial
                        </button>
                        <!-- Submit -->

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection