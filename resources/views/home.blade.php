@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="{{ url('beneficiario') }}" class="btn btn-primary">Beneficiario</a href="beneficiario">

                    <a href="{{ url('correlativo') }}" class="btn btn-primary">Correlativo</a>

                    <a href="{{ url('catalogo') }}" class="btn btn-primary">Catalogo</a>

                    <a href="{{ url('unidad_medida') }}" class="btn btn-primary">Unidad de Medida</a>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
