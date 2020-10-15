@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Beneficiario') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    Esta es la vista de Beneficiario 

                        <div id="main" class="container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <a href="#" class="btn btn-primary float-right" data-toggle="modal" data-target="#create">Nuevo Beneficiario</a>
                                    <table class="table table-hover table-striped" id="example">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>BENEFICIARIO</th>
                                                <th colspan="2">&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="item in lists">
                                                <td>@{{ item.id }}</td>
                                                <td>@{{ item.name }}</td>
                                                <td><button class="btn btn-warning" v-on:click.prevent="editBeneficiario(item)">Editar</button></td>
                                                <td><button class="btn btn-danger" v-on:click.prevent="deleteBeneficiario(item)">Eliminar</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <nav>
                                        <ul class="pagination">
                                            <li class="page-item" v-if="pagination.current_page > 1">
                                                <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page - 1)">
                                                    <span>Atras</span>
                                                </a>
                                            </li>

                                            <li class="page-item" v-for="page in pagesNumber" v-bind:class="[page == isActived ? 'active' : '']">
                                                <a class="page-link" href="#" @click.prevent="changePage(page)">
                                                    @{{ page }}
                                                </a>
                                            </li>
                                        
                                            <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                                <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page + 1)">
                                                    <span>Siguiente</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                    @include('beneficiario.create')
                                    @include('beneficiario.edit')
                                </div>
                            </div>
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection