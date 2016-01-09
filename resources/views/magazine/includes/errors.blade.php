@if($errors->has())
    <div class="alert alert-warning">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

@if(Session::has('status'))
    <div class="alert alert-info">
        {{ Session::get('status') }}
    </div>
@endif

@if(Session::has('message'))
    <div class="alert alert-success">
        {{ Session::get('message') }}
    </div>
@endif

@if(Session::has('error'))
    <div class="alert alert-warning">
        {{ Session::get('error') }}
    </div>
@endif

