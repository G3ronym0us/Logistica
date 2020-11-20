<template>
    
    <div class="container">
    	<div class="row justify-content-center">
            <div class="col-md-10">         
                
             </div>
        	<div class="col-md-10">
            	<div class="card">
                	<div class="card-header">Configuración > Usuarios</div>
					<div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <button class="btn btn-primary float-right"  v-on:click.prevent="newUsuario()">Nuevo Usuario</button>
                                    <table class="table table-hover table-striped table-responsive" id="example">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>NAME</th>
                                                <th>EMAIL</th>
                                                <th>ROL</th>
                                                <th colspan="2">&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="usuario in usuarios" :key="usuario.id">
                                                <td>{{ usuario.id }}</td>
                                                <td>{{ usuario.name }}</td>
                                                <td>{{ usuario.email }}</td>
                                                <td>{{ usuario.rol }}</td>
                                                <td><button class="btn btn-warning" v-on:click.prevent="editUsuario(usuario)">Editar</button></td>
                                                <td><button class="btn btn-danger" v-on:click.prevent="deleteUsuario(usuario)">Eliminar</button></td>
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

        <form method="POST" v-on:submit.prevent="storeUsuario()">
        
            <div class="modal fade" id="optionUsuario">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 v-if="option == 'edit'">Editar Usuario</h4>
                            <h4 v-else>Nuevo Usuario</h4>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" name="name" v-model="fillUsuario.name">
                            
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" v-model="fillUsuario.email">

                            <label for="rol">ROL</label>
                            <select name="rol" id="rol" class="form-control" v-model="fillUsuario.rol">
                                <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                                <option value="MODERADOR">MODERADOR</option>
                                <option value="USUARIO">USUARIO</option>
                            </select>

                            <label for="password">Contraseña</label>
                            <input type="password" class="form-control" name="password" v-model="fillUsuario.password" >

                            <label for="rpassword">Repetir Contraseña</label>
                            <input type="password" class="form-control" name="rpassword" v-model="fillUsuario.rpassword">
                            
                            <span  class="text-danger" v-for="error in errors">{{ error }}</span>
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
                    usuarios: [],
					fillUsuario: {
						'id': null,
                        'name': null,
                        'email': null,
                        'rol': 'USUARIO',
                        'password': null,
                        'rpassword': null,
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
                this.getUsuarios();
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
                getUsuarios: function(page){
					var url = 'api/getUsuarios?page='+page;
					axios.get(url).then(response => {
						this.usuarios = response.data.usuarios.data
						this.pagination = response.data.pagination
					});
                },
                newUsuario: function(){
                    this.option = 'new';
					$('#optionUsuario').modal('show');
                },
                editUsuario: function(usuario){
					this.fillUsuario.id   = usuario.id;
                    this.fillUsuario.name = usuario.name;
                    this.fillUsuario.email = usuario.email;
                    this.fillUsuario.rol = usuario.rol;
                    
                    this.option = 'edit';
					$('#optionUsuario').modal('show');
                },
                storeUsuario: function() {
                    if(this.option == 'edit'){
                        var url = 'usuario/'+this.fillUsuario.id;
                            axios.put(url, {
                            name: this.fillUsuario.name,
                            email: this.fillUsuario.email,
                            rol: this.fillUsuario.rol,
                            password: this.fillUsuario.password
                        }).then(response => {
                            this.fillUsuario.name = null;
                            this.fillUsuario.email = null;
                            this.fillUsuario.rol = null;
                            this.fillUsuario.password = null;
                            this.errors = [];
                            this.getUsuarios();
                            $('#optionUsuario').modal('hide');
                            toastr.success('Usuario editado con exito!');
                        }).catch(error => {
                            this.errors = 'Corrija para poder crear con exito!';
                        })
                    }else{
                        console.log(this.fillUsuario.rol);
                        var url = 'usuario';
                            axios.post(url, {
                            name: this.fillUsuario.name,
                            email: this.fillUsuario.email,
                            rol: this.fillUsuario.rol,
                            password: this.fillUsuario.password
                        }).then(response => {
                            this.fillUsuario.name = null;
                            this.fillUsuario.email = null;
                            this.fillUsuario.rol = null;
                            this.fillUsuario.password = null;
                            this.errors = [];
                            this.getUsuarios();
                            $('#optionUsuario').modal('hide');
                            toastr.success('Usuario guardado con exito!');
                        }).catch(error => {
                            this.errors = 'Corrija para poder crear con exito!';
                        })
                    }

                    
                },
				changePage: function(page) {
					this.pagination.current_page = page;
					this.getUsuarios(page);
				},
				deleteUsuario: function(usuario) {
					var url = 'usuario/' + usuario.id;
					axios.delete(url).then(response => { //eliminamos
						this.getUsuarios(); //listamos
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
