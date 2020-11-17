<template>
    
    <div class="container">
    	<div class="row justify-content-center">
        	<div class="col-md-8">
            	<div class="card">
                	<div class="card-header">Catalogo</div>
					<div class="card-body">
                    	Esta es la vista de Catalogo 
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <button class="btn btn-primary float-right"  v-on:click.prevent="newCatalogo()">Nuevo Catalogo</button>
                                    <table class="table table-hover table-striped" id="example">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>PRODUCTO</th>
                                                <th>UNIDAD</th>
                                                <th>VALOR</th>
                                                <th colspan="2">&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="producto in catalogo" :key="producto.id">
                                                <td>{{ producto.id }}</td>
                                                <td>{{ producto.name }}</td>
                                                <td>{{ producto.unidad_medida }}</td>
                                                <td>{{ producto.valor }}</td>
                                                <td><button class="btn btn-warning" v-on:click.prevent="editCatalogo(producto)">Editar</button></td>
                                                <td><button class="btn btn-danger" v-on:click.prevent="deleteCatalogo(producto)">Eliminar</button></td>
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

        <form method="POST" v-on:submit.prevent="storeCatalogo()">
        
            <div class="modal fade" id="optionCatalogo">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 v-if="option == 'edit'">Editar Producto</h4>
                            <h4 v-else>Nuevo Producto</h4>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" name="name" v-model="fillCatalogo.name">
                            <span  class="text-danger"></span>

                            <label for="unidad_medida">Unidad de Medida</label>
                            <select name="unidad_medida" id="unidad_medida" class="form-control" v-model="fillCatalogo.unidad_medida">
                                <option v-bind:value="unidad.name" v-for="unidad in unidades" :key="unidad.id">{{ unidad.name }}</option>
                            </select>
                            <span  class="text-danger"></span>

                            <label for="valor">Valor</label>
                            <input type="text" class="form-control" name="valor" v-model="fillCatalogo.valor">
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
                    catalogo: [],
                    unidades: [],
					fillCatalogo: {
						'id': '',
                        'name': '',
                        'unidad_medida': '',
                        'valor': ''
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
                this.getCatalogos();
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
				getUnidades: function(){
                    var url = 'api/getUnidades';
                    axios.get(url).then(response => {
                        this.unidades = response.data.unidades.data
                    });
                },
                getCatalogos: function(page){
					var url = 'api/getCatalogos?page='+page;
					axios.get(url).then(response => {
						this.catalogo = response.data.catalogos.data
						this.pagination = response.data.pagination
					});
                },
                newCatalogo: function(){
                    this.option = 'new';
					$('#optionCatalogo').modal('show');
                },
                editCatalogo: function(catalogo){
					this.fillCatalogo.id   = catalogo.id;
                    this.fillCatalogo.name = catalogo.name;
                    this.fillCatalogo.unidad_medida = catalogo.unidad_medida;
                    this.fillCatalogo.valor = catalogo.valor;
                    this.option = 'edit';
					$('#optionCatalogo').modal('show');
                },
                storeCatalogo: function() {
                    if(this.option == 'edit'){
                        var url = 'catalogo/'+this.fillCatalogo.id;
                            axios.put(url, {
                            name: this.fillCatalogo.name,
                        }).then(response => {
                            this.fillCatalogo.name = '';
                            this.errors = [];
                            this.getCatalogos();
                            $('#optionCatalogo').modal('hide');
                            toastr.success('Producto editado con exito!');
                        }).catch(error => {
                            this.errors = 'Corrija para poder crear con exito!';
                        })
                    }else{
                        var url = 'catalogo';
                            axios.post(url, {
                            name: this.fillCatalogo.name,
                        }).then(response => {
                            this.fillCatalogo.name = '';
                            this.errors = [];
                            this.getCatalogos();
                            $('#optionCatalogo').modal('hide');
                            toastr.success('Producto guardado con exito!');
                        }).catch(error => {
                            this.errors = 'Corrija para poder crear con exito!';
                        })
                    }

                    
                },
				changePage: function(page) {
					this.pagination.current_page = page;
					this.getBeneficiarios(page);
				},
				deleteCatalogo: function(catalogo) {
					var url = 'catalogo/' + catalogo.id;
					axios.delete(url).then(response => { //eliminamos
						this.getCatalogos(); //listamos
						toastr.success('Eliminado correctamente'); //mensaje
					});
				},
				
			}
    }
</script>
