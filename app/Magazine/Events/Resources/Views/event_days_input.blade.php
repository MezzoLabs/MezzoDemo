<div class="list-group">
    <div class="list-element"></div>
</div>

<?php for($x = 0; $x != 3; $x++): ?>
<div class="row">
    <div class="col-md-5">
        <label>From</label>
        {!! $renderer->formBuilder()->input('datetime-local', 'dates[@{{ days.formKey }}][date_from]') !!}

    </div>
    <div class="col-md-5">
        <label>To</label>
        {!! $renderer->formBuilder()->input('datetime-local', 'dates[@{{ days.formKey }}]][date_to]') !!}
    </div>
    <div class="col-md-2">
        <button class="btn btn-small btn-secondary btn-block">Add day</button>
    </div>
</div>
<hr/>

<?php endfor; ?>

