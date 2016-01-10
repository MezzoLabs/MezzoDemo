{!! cockpit_form()->openNestedRelation($renderer->attribute()) !!}

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Google Search</label>
            <input type="text" class="google_search form-control"
                   data-mezzo-google-maps-search data-street="address[street]"
                   data-street-number="address[street_extra]" data-street="address[street]"
                   data-postal-code="address[zip]" data-city="address[city]"
                   data-latitude="address[latitude]" data-longitude="address[longitude]"/>
        </div>
    </div>
    <div class="col-md-3">
        {!! $renderer->renderNested('latitude', ['readonly' => 'readonly', 'default' => "0.0"]) !!}
    </div>
    <div class="col-md-3">
        {!! $renderer->renderNested('longitude', ['readonly' => 'readonly', 'default' => "0.0"]) !!}
    </div>
    <div class="col-md-12">
        <hr/>
    </div>
    <div class="col-md-6">
        {!! $renderer->renderNested('addressee') !!}
    </div>
    <div class="col-md-6">

        {!! $renderer->renderNested('organization') !!}
    </div>
    <div class="col-md-9">
        {!! $renderer->renderNested('street') !!}
    </div>
    <div class="col-md-3">

        {!! $renderer->renderNested('street_extra') !!}
    </div>
    <div class="clearfix"></div>

    <div class="col-md-3">

        {!! $renderer->renderNested('zip') !!}
    </div>
    <div class="col-md-3">
        {!! $renderer->renderNested('city') !!}
    </div>
    <div class="col-md-3">
        {!! $renderer->renderNested('country') !!}
    </div>

    <div class="clearfix"></div>
    <div class="col-md-3">

        {!! $renderer->renderNested('phone') !!}
    </div>
    <div class="col-md-3">
        {!! $renderer->renderNested('fax') !!}
    </div>
    <div class="clearfix"></div>

</div>

{!! cockpit_form()->closeNestedRelation() !!}