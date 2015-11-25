<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Google Search</label>
            {!! $renderer->formBuilder()->text('address[name]') !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Latitude</label>
            {!! $renderer->renderNested('latitude', ['disabled' => 'disabled']) !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Longitude</label>
            {!! $renderer->renderNested('latitude', ['disabled' => 'disabled']) !!}
        </div>
    </div>
    <div class="col-md-12">
        <hr/>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Addressee</label>
            {!! $renderer->formBuilder()->text('address[addressee]') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Organization</label>
            {!! $renderer->formBuilder()->text('address[organization]') !!}
        </div>
    </div>
    <div class="col-md-9">
        <div class="form-group">
            <label>Street</label>
            {!! $renderer->formBuilder()->text('address[street]') !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Street Extra</label>
            {!! $renderer->formBuilder()->text('address[street_extra]') !!}
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="col-md-3">
        <div class="form-group">
            <label>Zipcode</label>
            {!! $renderer->formBuilder()->text('address[zip]') !!}
        </div>
    </div>
    <div class="col-md-9">
        <div class="form-group">
            <label>City</label>
            {!! $renderer->formBuilder()->text('address[city]') !!}
        </div>
    </div>

    <div class="clearfix"></div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Phone</label>
            {!! $renderer->formBuilder()->input('phone', 'address[phone]') !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Fax</label>
            {!! $renderer->formBuilder()->input('phone', 'address[fax]') !!}
        </div>
    </div>
    <div class="clearfix"></div>

</div>