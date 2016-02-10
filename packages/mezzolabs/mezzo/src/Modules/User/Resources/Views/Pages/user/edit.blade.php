@extends(cockpit_view('edit.page.layout'))

@section('main_panel:before')
    <div class="row">
        <div class="col-md-8">
@endsection

@section('main_panel:after')
        </div>
        <div class="col-md-4">
            <div class="panel">
                <div class="panel-body">
                    <a href="{!! angular_route('cockpit::user.subscriptions', 'vm.modelId') !!}" class="btn btn-block btn-default"><i class="ion-bookmark"></i> Subscriptions</a>
                </div>
            </div>
        </div>
    </div>
@endsection