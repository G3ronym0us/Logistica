<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">Correlativo</div>

                    <div class="card-body">

                            <div id="app" class="container">
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
                                                <tr v-for="correlativo in correlativos" :key="correlativo.id">
                                                    <td>{{ correlativo.id }}</td>
                                                    <td style="white-space: nowrap;">{{ correlativo.created_at }}</td>
                                                    <td>{{ correlativo.municipio }}</td>
                                                    <td style="white-space: nowrap;">{{ correlativo.n_partida }}</td>
                                                    <td>{{ correlativo.proyecto }}</td>
                                                    <td>{{ correlativo.beneficiario }}</td>
                                                    <td>{{ correlativo.orden_compra }}</td>
                                                    <td><button class="btn btn-warning" v-on:click.prevent="editCorrelativo(correlativo)">Editar</button></td>
                                                    <td><button class="btn btn-danger" v-on:click.prevent="deleteCorrelativo(correlativo.id)">Eliminar</button></td>
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
    <form method="POST" v-on:submit.prevent="updateCorrelativo(id)">
    <div class="modal fade" id="editCorrelativo">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Editar Correlativo {{id}} </h4>
                    
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <label for="municipio">Municipio {{ municipio_id }} </label>
                    <select name="municipio" id="municipio" class="form-control" v-model="municipio_id">
                        <option v-bind:value="municipio.id" v-for="municipio in municipios" :key="municipio.id">{{ municipio.name }}</option>
                    </select>

                    <label for="n_partida">Numero de Partida {{ n_partida }} </label>
                    <input type="number" class="form-control" name="name" v-model="n_partida"><!-- v-on:keyup="formatNumPartida"-->

                    <label for="proyecto">Proyecto {{ proyecto }} </label>
                    <select name="proyecto" id="proyecto" class="form-control" v-model="proyecto">
                        <option value="ZONA" >ZONA</option>
                    </select>

                    <label for="beneficiario">Beneficiario {{ beneficiario_id }} </label>
                    <select name="beneficiario" id="beneficiario" class="form-control" v-model="beneficiario_id">
                        <option v-bind:value="beneficiario.id" v-for="beneficiario in beneficiarios" :key="beneficiario.id">{{ beneficiario.name }}</option>
                    </select>

                    <label for="orden_compra">Orden de Compra {{ orden_compra }}  </label>
                    <input type="number" class="form-control" name="orden_compra" v-model="orden_compra">
                    
                    <!--
                    <span v-for="error in errors" class="text-danger">@{{ error }}</span>
                    -->
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Guardar">
                </div>
            </div>
        </div>
        
    </div>
</form>		<correlativo-new-component @recargarCorrelativos="getCorrelativos"></correlativo-new-component>
    </div>
</template>

<script>
export default {
    
	data () {
        return {
            correlativos: [],
            municipios: [],
            beneficiarios: [],
            id: '',
            municipio_id: '',
            n_partida: '',
            proyecto: '',
            beneficiario_id: '',
            orden_compra: '',
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
        this.getCorrelativos();
        this.getMunicipios();
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
        getCorrelativos: function(page) {
            var url = 'api/getCorrelativos?page='+page;
            axios.get(url).then(response => {
                this.correlativos = response.data.data
                this.pagination = response.data
            });
        },
        editCorrelativo: function(correlativo){
            this.id   = correlativo.id;
            this.municipio_id = correlativo.municipio_id;
            this.n_partida = correlativo.n_partida;
            this.proyecto = correlativo.proyecto;
            this.beneficiario_id = correlativo.beneficiario_id;
            this.orden_compra = correlativo.orden_compra;
            $('#editCorrelativo').modal('show');
        },
        changePage: function(page) {
            this.pagination.current_page = page;
            this.getCorrelativos(page);
        },
        getMunicipios: function(){
            var url = 'api/getMunicipios';
            axios.get(url).then(response => {
                this.municipios = response.data
            });
        },
        getBeneficiarios: function(){
            var url = 'api/getBeneficiariosFull';
            axios.get(url).then(response => {
                this.beneficiarios = response.data.beneficiarios.data
                this.pagination = response.data.pagination
            });
        },
        updateCorrelativo: function(id) {
            var url = 'correlativo/'+id;
            axios.put(url, {
                municipio_id: this.municipio_id,
                n_partida: this.n_partida,
                proyecto: this.proyecto,
                beneficiario_id: this.beneficiario_id,
                orden_compra: this.orden_compra
            }).then(response => {
                this.getCorrelativos();
                this.municipio_id = '';
                this.n_partida = '';
                this.beneficiario_id = '';
                this.proyecto = '';
                this.orden_compra = '';
                this.errors = [];
                $('#editCorrelativo').modal('hide');
                toastr.success('Correlativo editado con exito!');
            }).catch(error => {
                this.errors = 'Corrija para poder crear con exito!';
            });
        },
        deleteCorrelativo: function(id) {
					var url = 'correlativo/' + id;
					axios.delete(url).then(response => { //eliminamos
						this.getCorrelativos(); //listamos
						toastr.success('Correlativo eliminado correctamente'); //mensaje
					});
				},
    }
}
</script>