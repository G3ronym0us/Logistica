@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">{{ __('Correlativo') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <div id="appCorrelativo" class="container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <a href="#" class="btn btn-primary float-right" data-toggle="modal" data-target="#create">Nuevo Correlativo</a>
                                    <table class="table table-hover table-striped table-responsive" id="correlativos-table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>FECHA</th>
                                                <th>MUNICIPIO</th>
                                                <th>N° DE PARTIDA</th>
                                                <th>PROYECTO</th>
                                                <th>BENEFICIARIO</th>
                                                <th>ORDEN DE COMPRA</th>
                                                <th colspan="2">&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="item in lists">
                                                <td>@{{ item.id }}</td>
                                                <td style="white-space: nowrap;">@{{ item.created_at }}</td>
                                                <td>@{{ item.municipio }}</td>
                                                <td style="white-space: nowrap;">@{{ item.n_partida }}</td>
                                                <td>@{{ item.proyecto }}</td>
                                                <td>@{{ item.beneficiario }}</td>
                                                <td>@{{ item.orden_compra }}</td>
                                                <td><button class="btn btn-warning" v-on:click.prevent="">Editar</button></td>
                                                <td><button class="btn btn-danger" v-on:click.prevent="">Eliminar</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                            
                                    @include('correlativo.create')
                                    @include('correlativo.edit')
                                </div>
                            </div>
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection