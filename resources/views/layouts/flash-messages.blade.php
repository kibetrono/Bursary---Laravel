@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block p-2">
        <button type='button' class="close" data-dismiss='alert'>×</button>
        <i class="icon fas fa-check"></i> {{ $message }}
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block p-2">
        <button type='button' class="close" data-dismiss='alert'>×</button>
        <i class="icon fas fa-ban"></i> {{ $message }}
    </div>
@endif

@if ($message = Session::get('smtp_error'))
    <div class="alert alert-danger alert-block p-0 position-fixed" style="top: 20px; right: 20px; z-index: 9999;">
        <button type='button' class="close" data-dismiss='alert' aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <i class="icon fas fa-ban"></i> {{ $message }}
    </div>
@endif


@if ($message = Session::get('warning'))
    <div class="alert alert-warning alert-block p-2">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif

@if ($message = Session::get('info'))
    <div class="alert alert-info alert-block p-2">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger p-2 mt-3">
        <button type="button" class="close" data-dismiss="alert">×</button>
        Please check the form below for errors
    </div>
@endif
