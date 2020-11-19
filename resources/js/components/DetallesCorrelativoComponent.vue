<template>
    <div class="container">
    	<div class="row justify-content-center">
            <div class="col-md-12">         
                <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" @click="linkCrear()">Crear Correlativo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" @click="linkCorrelativo()">Correlativos</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-cog"></i>Configuración</a>
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
        	<div class="col-md-12">
            	<div class="card">
                    <form method="POST" v-on:submit.prevent="storeCorrelativo()">
                	<div class="card-header">Crear Correlativo</div>
					<div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="municipio">Municipio</label>
                                <select name="municipio" id="municipio" class="form-control" v-model="municipio_id" required>
                                    <option :value="null" disabled>Seleccione</option>
                                    <option v-bind:value="municipio.id" v-for="municipio in municipios" :key="municipio.id">{{ municipio.name }}</option>
                                </select>
                                
                            </div>

                            <div class="col-md-4">
                                <label for="n_partida">Numero de Partida</label>
                                <input type="number" class="form-control" name="name" v-model="n_partida" required>
                            </div>

                            <div class="col-md-4">
                                <label for="proyecto">Proyecto</label>
                                <select name="proyecto" id="proyecto" class="form-control" v-model="proyecto" required>
                                    <option value="ZONA" >ZONA</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="beneficiario">Beneficiario</label>
                                <select name="beneficiario" id="beneficiario" class="form-control" v-model="beneficiario_id" required>
                                    <option :value="null" disabled>Seleccione</option>
                                    <option v-bind:value="beneficiario.id" v-for="beneficiario in beneficiarios" :key="beneficiario.id">{{ beneficiario.name }}</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="orden_compra">Orden de Compra</label>
                                <input type="number" class="form-control" name="orden_compra" v-model="orden_compra" required>
                            </div>

                            <div class="col-md-5">
                                <label for="tmovimiento">Tipo de Movimiento</label>
                                <select name="tmovimiento" id="tmovimiento" class="form-control" v-model="tmovimiento" required>
                                    <option value="ENTREGA DE BIENES MATERIALES" >ENTREGA DE BIENES MATERIALES</option>
                                </select>
                            </div>
                            
                        </div>
                        <br><br>
                        <div class="row border">
                            <div class="col-md-12 justify-content-center bg-warning">
                                <center>DETALLES</center>  
                            </div>
                        </div>


                        <div id="detalles_title">
                            <div class="row border border-top-0">
                                <div class="col-md-3 border-right text-center bg-info">
                                    DENOMINACIÓN
                                </div>
                                <div class="col-md-2 border-right text-center bg-info">
                                    CANTIDAD
                                </div>
                                <div class="col-md-2 border-right text-center bg-info">
                                    U. DE MEDIDA
                                </div>
                                <div class="col-md-2 border-right text-center bg-info">
                                    V. UNITARIO
                                </div>
                                <div class="col-md-2 text-center bg-info">
                                    V.TOTAL
                                </div>
                                <div class="col-md-1 bg-info">
                                </div>
                            </div>


                        </div>

                        <div id="detalles">
                            <div class="row border border-top-0" v-for="(detalle, index) of detalles" v-bind:key="detalle.catalago_id">
                                <div class="col-md-3 border-right">
                                    <label>{{ detalle.catalogo_name }}</label>
                                </div>
                                <div class="col-md-2 border-right text-right">
                                    <label>{{ detalle.cantidad }} Bs.</label>
                                </div>
                                <div class="col-md-2 border-right">
                                    <label>{{ detalle.unidad_medida }}</label>
                                </div>
                                <div class="col-md-2 border-right text-right">
                                    <label>{{ detalle.valor_unitario }} Bs.</label>
                                </div>
                                <div class="col-md-2 border-right text-right">
                                    <label>{{ detalle.valor_total }} Bs.</label>
                                </div>
                                <div class="col-md-1">
                                  <button class="btn btn-danger" type="button" @click="eliminarDetalle(index)">Eliminar</button>
                                </div>
                            </div>


                        </div>

                        <div class="row border border-top-0">

                            <div class="col-md-3 border-right">
                                <select name="catalogo" id="catalogo" ref="catalogo" class="form-control" @change="pass_cantidad($event)" v-model="catalogo_id">
                                    <option :value="null" disabled>Seleccione</option>
                                    <option v-bind:value="producto.id" v-for="producto in catalogo" :key="producto.id">{{ producto.name }}</option>
                                </select>
                            </div>
                            <div class="col-md-2 border-right">
                                <input type="number" class="form-control" name="cantidad" ref="cantidad" @keyup="calcular()" v-model="cantidad" placeholder="Cant.">
                            </div>
                            <div class="col-md-2 border-right">
                                <select name="unidad_medida" id="unidad_medida" class="form-control" v-model="unidad_medida">
                                    <option v-bind:value="unidad.name" v-for="unidad in unidades" :key="unidad.id">{{ unidad.name }}</option>
                                </select>
                            </div>
                            <div class="col-md-2 border-right">
                                <input type="number" class="form-control" name="valor_unitario" v-model="valor_unitario" placeholder="V. Unit" readonly>
                            </div>
                            <div class="col-md-2 border-right">
                                <input type="number" class="form-control" name="valor_total" v-model="valor_total" placeholder="V. Total" readonly>
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-info" @click="agregarDetalle()">Agregar</button>
                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-md-3 offset-md-9">
                                
                                    <button class="btn btn-info">Guardar</button>
                               
                            </div>
                        </div>
                    	
                        

                        

                        

                        
                        
                    </div>
                     </form>
            	</div>
        	</div>
    	</div>
	</div>
</template>


<script>
export default {
    data (){
        return{
            detalles: [],
            municipios: [],
            beneficiarios: [],
            catalogo: [],
            unidades: [],
            municipio_id: null,
            n_partida: null,
            formatNumPartida: null,
            proyecto: 'ZONA',
            beneficiario_id: null,
            orden_compra: null,
            tmovimiento: 'ENTREGA DE BIENES MATERIALES',
            catalogo_id: null,
            catalogo_name: null,
            cantidad: null,
            unidad_medida: 'UNIDAD',
            valor_unitario: null,
            valor_total: null,
            errors: {
                municipio_id: null,
            }

        }
    },
    created: function() {
        this.getCatalogos();
        this.getMunicipios();
        this.getBeneficiarios();
        this.getUnidades();
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
        createCorrelativo: function() {
            var url = 'correlativo';
            axios.post(url, {
                municipio_id: this.municipio_id,
                n_partida: this.n_partida,
                proyecto: this.proyecto,
                beneficiario_id: this.beneficiario_id,
                orden_compra: this.orden_compra
            }).then(response => {
                this.n_partida = null,
                this.municipio_id = null,
                this.beneficiario_id = null,
                this.proyecto = null,
                this.orden_compra = null,
                this.errors = [];
            }).catch(error => {
                this.errors = 'Corrija para poder crear con exito!';
            });
            
        },
        storeCorrelativo: function(){
            if(this.detalles.length === 0){
                toastr.error('El correlativo debe tener al menos un detalle.')
            }else{
                var url = 'correlativo';
                axios.post(url, {
                    municipio_id: this.municipio_id,
                    n_partida: this.n_partida,
                    proyecto: this.proyecto,
                    beneficiario_id: this.beneficiario_id,
                    orden_compra: this.orden_compra
                }).then(response => {
                    this.n_partida = null;
                    this.municipio_id = null;
                    this.beneficiario_id = null;
                    this.orden_compra = null;
                    this.errors = [];
                    toastr.success('Nuevo Correlativo creado!');
                }).catch(error => {
                    this.errors = 'Corrija para poder crear con exito!';
                });
                var url = 'detalles';
                axios.post(url,{
                    detalles: this.detalles,
                }).then(response => {
                    this.detalles = [];
                    toastr.success('Nuevo Correlativo creado!');
                    
                }).catch(error => {
                    this.errors = 'Corrija para poder crear con exito!';
                });
            }
        },
        pass_cantidad: function(id){
            this.$refs.cantidad.focus();
            var id = event.target.value;
            var url = 'api/searchProduct/'+id;
            axios.get(url).then(response => {
                this.valor_unitario = response.data.valor;
                this.unidad_medida = response.data.unidad_medida;
                this.calcular();
            })
            this.calcular();
        },
        calcular: function() {
            this.valor_total = this.cantidad * this.valor_unitario;
        }, 
        eliminarDetalle: function(index){
            console.log('okey');
             
            this.detalles.splice(index, 1); //elimina el producto del arreglo

        },
        agregarDetalle: function() {
            console.log('okey');
            var filtro = this.detalles.find(producto => producto.catalogo_id === this.catalogo_id)
            if(this.catalogo_id == null){
                this.$refs.catalogo.focus();
            }else if(this.cantidad == null || this.cantidad == 0){
                this.$refs.cantidad.focus();   
            }else{

                /*if(filtro){
                    detalles.forEach(element => {
                        if(element.catalogo_id === this.catalogo_id){
                            console.log(element.catalogo_name)
                        }
                    });
                }else{*/
                    var aux = this.catalogo.find(producto => producto.id === this.catalogo_id)

                    var nuevo = { "catalogo_id" : this.catalogo_id, "catalogo_name": aux.name, "cantidad" : this.cantidad, "unidad_medida": this.unidad_medida, "valor_unitario": this.valor_unitario, "valor_total": this.valor_total};

                    this.detalles.push(nuevo);

                    this.catalogo_id = null;
                    this.cantidad = null;
                    this.unidad_medida = null;
                    this.valor_unitario = null;
                    this.valor_total = null;

                    this.$refs.catalogo.focus();
               // }

            }
            
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