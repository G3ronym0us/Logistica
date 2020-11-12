<template>
    
    <div class="container">
    	<div class="row justify-content-center">
        	<div class="col-md-8">
            	<div class="card">
                	<div class="card-header">Beneficiario</div>
					<div class="card-body">
                    	Esta es la vista de Beneficiario 
                        <div class="container">
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
                                            <tr v-for="item in lists" :key="item.id">
                                                <td>{{ item.id }}</td>
                                                <td>{{ item.name }}</td>
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
		<beneficiario-edit-component @recargar="getBeneficiarios" v-bind=fillBeneficiario></beneficiario-edit-component>
		<beneficiario-new-component @recargar="getBeneficiarios"></beneficiario-new-component>
	</div>
</template>

<script>
    export default {
			data () {
                return{
                    lists: [],
					fillBeneficiario: {
						'id': '',
						'name': ''
					},
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
				this.getBeneficiarios();
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
				editBeneficiario: function(beneficiario){
					this.fillBeneficiario.id   = beneficiario.id;
					this.fillBeneficiario.name = beneficiario.name;
					$('#edit').modal('show');
				},
				getBeneficiarios: function(page){
					var url = 'api/getBeneficiariosFull?page='+page;
					axios.get(url).then(response => {
						this.lists = response.data.beneficiarios.data
						this.pagination = response.data.pagination
					});
				},
				changePage: function(page) {
					this.pagination.current_page = page;
					this.getBeneficiarios(page);
				},
				deleteBeneficiario: function(beneficiario) {
					var url = 'beneficiario/' + beneficiario.id;
					axios.delete(url).then(response => { //eliminamos
						this.getBeneficiarios(); //listamos
						toastr.success('Eliminado correctamente'); //mensaje
					});
				},
				
			}
    }
</script>
