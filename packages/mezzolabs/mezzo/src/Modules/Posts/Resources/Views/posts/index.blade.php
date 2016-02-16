@extends('cockpit::pages.layouts.index')


@section('index_table_body_cell')


    <span ng-if="$first" style="display: inline-block; width: 35px">
        <img width="35" ng-if="model.mainImage && $first" ng-src="@{{ model.mainImage.data.url }}?size=thumb"/>
    </span>

    @parent

    <b ng-if="$first">
        @{{ (model._is_published) ? '' : '- Private' }}
    </b>

@endsection