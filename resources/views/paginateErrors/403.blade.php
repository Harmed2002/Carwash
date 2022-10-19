@extends('adminlte::page')
<!-- , ['iFrameEnabled' => true] -->

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info mt-2">
                <div class="card-body p-0" style="display: block;">
            <section class="content">
                <div class="error-page">
                    <h2 class="headline text-warning"> 403</h2>
                    <div class="error-content">
                        <h3><i class="fas fa-exclamation-triangle text-warning"></i>Ups! Página no disponible.</h3>
                        <p>
                            No poseé el permiso requerido para realizar este proceso.
                             <a href="{{ url()->previous() }}">Volver a la vista anterior.</a>                   
                        </p>
                    </div>

                </div>

            </section>
                </div></div>
        </div>
    </div>
@endsection
