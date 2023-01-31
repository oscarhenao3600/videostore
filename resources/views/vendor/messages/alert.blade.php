@if(Session::has('danger'))
    <div class="alert alert-danger alert-dismissible box-color danger-alert" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin-right: 10px;">
            <span aria-hidden="true">&times;</span>
        </button>
        <div class="box-header">
            <h3>{!! Session::get('alert-title') !!}</h3>
            <small></small>
        </div>
        <div class="box-body">
            <p class="m-0 text-muted">
                {!! Session::get('danger') !!}
            </p>
        </div>
    </div>
@endif

@if(Session::has('default'))
    <div class="alert alert-default alert-dismissible box-color default" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin-right: 10px;">
            <span aria-hidden="true">&times;</span>
        </button>
        <div class="box-header">
            <h3>{!! Session::get('alert-title') !!}</h3>
            <small></small>
        </div>
        <div class="box-body">
            <p class="m-0 text-muted">
                {!! Session::get('default') !!}
            </p>
        </div>
    </div>
@endif

@if(Session::has('info'))
    <div class="alert alert-info alert-dismissible box-color info-alert" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin-right: 10px;">
            <span aria-hidden="true">&times;</span>
        </button>
        <div class="box-header">
            <h3>{!! Session::get('alert-title') !!}</h3>
            <small></small>
        </div>
        <div class="box-body">
            <p class="m-0 text-muted">
                {!! Session::get('info') !!}
            </p>
        </div>
    </div>
@endif

@if(Session::has('primary'))
    <div class="alert alert-primary alert-dismissible box-color primary-alert" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin-right: 10px;">
            <span aria-hidden="true">&times;</span>
        </button>
        <div class="box-header">
            <h3>{!! Session::get('alert-title') !!}</h3>
            <small>Transacción realizada correctamente.</small>
        </div>
        <div class="box-body">
            <p class="m-0 text-muted">
                {!! Session::get('primary') !!}
            </p>
        </div>
    </div>
@endif

@if(Session::has('success'))
    <div class="alert alert-success alert-dismissible box-color success-alert" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin-right: 10px;">
            <span aria-hidden="true">&times;</span>
        </button>
        <div class="box-header">
            <h3>{!! Session::get('alert-title') !!}</h3>
            <small>Transacción realizada correctamente.</small>
        </div>
        <div class="box-body">
            <p class="m-0 text-muted">
                {!! Session::get('success') !!}
            </p>
        </div>
    </div>
@endif

@if(Session::has('warning'))
    <div class="alert alert-warning alert-dismissible box-color warning-alert" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin-right: 10px;">
            <span aria-hidden="true">&times;</span>
        </button>
        <div class="box-header">
            <h3>{!! Session::get('alert-title') !!}</h3>
            <small>Transacción realizada correctamente.</small>
        </div>
        <div class="box-body">
            <p class="m-0 text-muted">
                {!! Session::get('warning') !!}
            </p>
        </div>
    </div>
@endif