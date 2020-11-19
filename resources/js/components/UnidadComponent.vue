<template>
    
    <div class="container">
    	<div class="row justify-content-center">
            <div class="col-md-10">         
                <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" @click="linkCrear()">Crear Correlativo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" @click="linkCorrelativo()">Correlativos</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Configuración</a>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" @click="linkBeneficiario()">Beneficiario</a>
                    <a class="dropdown-item" @click="linkCatalogo()">Catalago</a>
                    <a class="dropdown-item" @click="linkUnidad()">Unidad de Medida</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" @click="linkUsuario()">Usuarios</a>
                    </div>
                </li>
                <!--
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li>
                -->
            </ul>    
             </div>
        	<div class="col-md-10">
            	<div class="card">
                	<div class="card-header">Unidad de Medida</div>
					<div class="card-body">
                    	Esta es la vista de Unidades de Medidas 
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <button class="btn btn-primary float-right"  v-on:click.prevent="newUnidad()">Nueva Unidad de Medida</button>
                                    <table class="table table-hover table-striped" id="example">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>UNIDAD</th>
                                                <th colspan="2">&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="unidad in unidades" :key="unidad.id">
                                                <td>{{ unidad.id }}</td>
                                                <td>{{ unidad.name }}</td>
                                                <td><button class="btn btn-warning" v-on:click.prevent="editUnidad(unidad)">Editar</button></td>
                                                <td><button class="btn btn-danger" v-on:click.prevent="deleteUnidad(unidad)">Eliminar</button></td>
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

                                            <li class="page-item" v-for="page in pagesNumber" :key="page" v-bind:class="[page == isActived ? 'active' : '']">
                                                <a class="page-link" href="#" @click.prevent="changePage(page)">
                                                    {{ page }}
                                                </a>
                                            </li>
                                        
                                            <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                                <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page + 1)">
                                                    <span>Siguiente</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                	</div>
            	</div>
        	</div>
    	</div>

        <form method="POST" v-on:submit.prevent="storeUnidad()">
        
            <div class="modal fade" id="option">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 v-if="option == 'edit'">Editar Unidad de Medida</h4>
                            <h4 v-else>Nuevo Unidad de Medida</h4>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" name="name" v-model="fillUnidades.name">
                            <span  class="text-danger"></span>

                        </div>
                        <div class="modal-footer">
                            <input v-if="option == 'edit'" type="submit" class="btn btn-primary" value="Actualizar">
                            <input v-if="option == 'new'" type="submit" class="btn btn-primary" value="Guardar">
                        </div>
                    </div>
                </div>
            </div>
        </form>

	</div>
</template>

<script>
    export default {
			data () {
                return{
                    unidades: [],
					fillUnidades: {
						'id': '',
                        'name': '',
                    },
                    option: '',
                    errors: [],
                    pagination: {
                        'total': 0,
                        'current_page': 0,
                        'per_page': 0,
                        'last_page': 0,
                        'from': 0,
                        'to': 0
					},
					offset: 3,
                }
                
            },
            created: function() {
				this.getUnidades();
			},
			computed: {
				isActived: function() {
					return this.pagination.current_page;
				},
				withoutErrors: function() {
					this.errors = '';
				},
				pagesNumber: function() {
					if(!this.pagination.to){
						return [];
					}
		
					var from = this.pagination.current_page - this.offset; 
					if(from < 1){
						from = 1;
					}
		
					var to = from + (this.offset * 2); 
					if(to >= this.pagination.last_page){
						to = this.pagination.last_page;
					}
		
					var pagesArray = [];
					while(from <= to){
						pagesArray.push(from);
						from++;
					}
					return pagesArray;
				}
			},
			methods: {
				getUnidades: function(page){
					var url = 'api/getUnidades?page='+page;
					axios.get(url).then(response => {
						this.unidades = response.data.unidades.data
						this.pagination = response.data.pagination
					});
                },
                newUnidad: function(){
                    this.option = 'new';
					$('#option').modal('show');
                },
                editUnidad: function(unidad){
					this.fillUnidades.id   = unidad.id;
                    this.fillUnidades.name = unidad.name;
                    this.fillUnidades.unidad_medida = unidad.unidad_medida;
                    this.fillUnidades.valor = unidad.valor;
                    this.option = 'edit';
					$('#option').modal('show');
                },
                storeUnidad: function() {
                    if(this.option == 'edit'){
                        var url = 'unidad_medida/'+this.fillUnidades.id;
                            axios.put(url, {
                            name: this.fillUnidades.name,
                        }).then(response => {
                            this.fillUnidades.name = '';
                            this.errors = [];
                            this.getUnidades();
                            $('#option').modal('hide');
                            toastr.success('Unidad de Medida editada con exito!');
                        }).catch(error => {
                            this.errors = 'Corrija para poder crear con exito!';
                        })
                    }else{
                        var url = 'unidad_medida';
                            axios.post(url, {
                            name: this.fillUnidades.name,
                        }).then(response => {
                            this.fillUnidades.name = '';
                            this.errors = [];
                            this.getUnidades();
                            $('#option').modal('hide');
                            toastr.success('Unidad de Medida guardada con exito!');
                        }).catch(error => {
                            this.errors = 'Corrija para poder crear con exito!';
                        })
                    }

                    
                },
				changePage: function(page) {
					this.pagination.current_page = page;
					this.getUnidades(page);
				},
				deleteUnidad: function(unidad) {
					var url = 'unidad_medida/' + unidad.id;
					axios.delete(url).then(response => { //eliminamos
						this.getUnidades(); //listamos
						toastr.success('Eliminado correctamente'); //mensaje
					});
                },
                linkCrear: function(){
            window.location.href = 'http://localhost:8000' +'/detalles'

        },
        linkCorrelativo: function(){
            window.location.href = 'http://localhost:8000' +'/correlativo'
        },
        linkBeneficiario: function(){
            window.location.href = 'http://localhost:8000' +'/beneficiario'
        },
        linkCatalogo: function(){
            window.location.href = 'http://localhost:8000' +'/catalogo'
        },
        linkUnidad: function(){
            window.location.href = 'http://localhost:8000' +'/unidad_medida'
        },
        linkUsuario: function(){
            window.location.href = 'http://localhost:8000' +'/usuario'
        },
				
			}
    }
</script>
