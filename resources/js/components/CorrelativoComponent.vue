<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">         
                
        </div>
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
                                                    <th colspan="3">&nbsp;</th>
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
                                                        <td><button class="btn btn-info" v-on:click.prevent="detalleCorrelativo(correlativo)">Detalles</button></td>                                                        
                                                        <td><button class="btn btn-warning" v-on:click.prevent="imprimirCorrelativo(correlativo)">Imprimir</button></td>
                                                        <td><button class="btn btn-danger" v-if="rol === 'ADMINISTRADOR'" v-on:click.prevent="deleteCorrelativo(correlativo.id)">Eliminar</button></td>
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


    <div class="modal fade" id="detalleCorrelativo">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Detalles de Correlativo {{id}} </h4>
                    
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3 offset-md-6 bg-secondary text-white  border border-dark">
                            FECHA
                        </div>
                        <div class="col-md-3">
                            {{ d_fecha }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 bg-secondary text-white">
                            MUNICIPIO
                        </div>
                        <div class="col-md-3">
                            {{ d_municipio_name }}
                        </div>
                        <div class="col-md-3 bg-secondary text-white">
                            N° DE PARTIDA
                        </div>
                        <div class="col-md-3">
                            {{ d_partida }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 bg-secondary text-white">
                            PROYECTO
                        </div>
                        <div class="col-md-2">
                            {{ d_proyecto}}
                        </div>
                        <div class="col-md-3 bg-secondary text-white">
                            BENEFICIARIO
                        </div>
                        <div class="col-md-5">
                            {{ d_beneficiario }}
                        </div>
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-hover table-striped table-responsive" id="detalles_correlativo">
                                <thead>
                                    <tr>
                                        <th>PRODUCTO</th>
                                        <th>CANTIDAD</th>
                                        <th>VALOR UNITARIO</th>
                                        <th>VALOR TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="detalle in detalles" :key="detalle.id">
                                            <td width="40%">{{ detalle.name }}</td>
                                            <td width="10%">{{ detalle.cantidad }}</td>
                                            <td width="25%">{{ detalle.valor }}</td>
                                            <td width="25%">{{ detalle.subtotal }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    

                </div>
                
            </div>
        </div>
        
    </div>
</form>		<correlativo-new-component @recargarCorrelativos="getCorrelativos"></correlativo-new-component>
    </div>
</template>

<script>

export default {
    props: ['rol'],
	data () {
        return {
            correlativos: [],
            municipios: [],
            beneficiarios: [],
            detalles: [],
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
            d_fecha: null,
            d_municipio_name: null,
            d_partida: null,
            d_proyecto: null,
            d_beneficiario: null,
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
        },

    },
    methods: {
        getNombre: function(id){
            var url = 'api/getNombre/'+id;
            axios.get(url).then(response => {
                return response.data;
            });
        },
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
        imprimirCorrelativo: function(correlativo){
            this.id   = correlativo.id;
           window.location.href = 'http://localhost:8000' +'/imprimirCorrelativo/'+this.id;
        },
        detalleCorrelativo: function(correlativo){
            this.d_fecha = correlativo.created_at;
            var id = correlativo.municipio_id;
            this.getMunicipio(id);
            this.d_partida = correlativo.n_partida;
            this.d_proyecto = correlativo.proyecto;
            var id = correlativo.beneficiario_id;
            this.getBeneficiario(id);
            var url = 'api/getDetalles/'+correlativo.id;
            axios.get(url).then(response => {
                this.detalles = response.data;
                console.log(response.data);
            });
            //this.d_beneficiario = correlativo.n_partida;
            
            $('#detalleCorrelativo').modal('show');
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
        getMunicipio: function(id){
            var url = 'api/getMunicipio/'+id;
            axios.get(url).then(response => {
                this.d_municipio_name = response.data.name
            });
        },
        getBeneficiario: function(id){
            var url = 'api/getBeneficiario/'+id;
            axios.get(url).then(response => {
                this.d_beneficiario = response.data.name
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
                linkCrear: function(){
            window.location.href = 'http://localhost:8000' +'/detalles'

        },
    }
}
</script>