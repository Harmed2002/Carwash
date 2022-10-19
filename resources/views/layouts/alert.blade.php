@if (Session::has('message'))
    <div class="alert alert-success alert-dismissible fade show pl-5 pr-5">
        <h5><i class="icon fas fa-ban"></i>Éxito</h5> {{ Session::get('message') }}<button type="button"
            class="close" data-dismiss="alert" aria-hidden="true">×</button>
    </div>
@endif
<div class="messageSuccess pa-4">
</div>
<div class="messageError pa-4">
</div>
@if (Session::has('error_message'))
    <div class="alert alert-danger alert-dismissible fade show pl-5 pr-5">
        <h5><i class="icon fas fa-ban"></i> Error</h5> {{ Session::get('error_message') }}<button type="button"
            class="close" data-dismiss="alert" aria-hidden="true">×</button>
    </div>
@endif

@if (Session::has('info_message'))
    <div class="alert alert-info alert-dismissible fade show pl-5 pr-5">
        <h5><i class="icon fas fa-ban"></i> Información</h5> {{ Session::get('info_message') }}<button type="button"
            class="close" data-dismiss="alert" aria-hidden="true">×</button>
    </div>
@endif

@if (Session::has('warning_message'))
    <div class="alert alert-warning alert-dismissible fade show pl-5 pr-5">
        <h5><i class="icon fas fa-ban"></i>Advertencia</h5> {{ Session::get('warning_message') }}<button type="button"
            class="close" data-dismiss="alert" aria-hidden="true">×</button>
    </div>
@endif


@if ($errors->any())

    <div class="alert alert-warning alert-dismissible fade show pl-5 pr-5">
        <h5><i class="icon fas fa-ban"></i>Algo salio mal</h5>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    </div>
@endif
