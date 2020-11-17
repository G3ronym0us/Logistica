<template>
    <form method="POST" v-on:submit.prevent="updateCorrelativo(id)">
    <div class="modal fade" id="editCorrelativo">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Editar Correlativo {{id}} </h4>
                    <pre> {{ $data }} </pre>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <label for="municipio">Municipio {{ municipio_id }} </label>
                    <select name="municipio" id="municipio" class="form-control" v-model="municipio_selected">
                        <option v-bind:value="municipio.id" v-for="municipio in municipios" :key="municipio.id" :selected="municipio.id == 3">{{ municipio.name }}</option>
                    </select>

                    <label for="n_partida">Numero de Partida {{ n_partida }} </label>
                    <input type="number" class="form-control" name="name" v-model="e_n_partida"><!-- v-on:keyup="formatNumPartida"-->

                    <label for="proyecto">Proyecto {{ proyecto }} </label>
                    <select name="proyecto" id="proyecto" class="form-control" v-model="e_proyecto">
                        <option value="ZONA" >ZONA</option>
                    </select>

                    <label for="beneficiario">Beneficiario {{ beneficiario_id }} </label>
                    <select name="beneficiario" id="beneficiario" class="form-control" v-model="e_beneficiario_id">
                        <option v-bind:value="beneficiario.id" v-for="beneficiario in beneficiarios" :key="beneficiario.id">{{ beneficiario.name }}</option>
                    </select>

                    <label for="orden_compra">Orden de Compra {{ orden_compra }}  </label>
                    <input type="number" class="form-control" name="orden_compra" v-model="e_orden_compra">
                    
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
</form>
</template>

<script>
export default {
    props:['id','municipio_id', 'n_partida', 'proyecto', 'beneficiario_id', 'orden_compra'],
    data () {
        return {
            municipios: [],
            beneficiarios: [],
            municipio_selected: '',
            e_n_partida: '',
            e_proyecto: '',
            e_beneficiario_id: '',
            e_orden_compra: '',
        }
    },
    created: function() {
        this.getCorrelativoForEdit();
        this.getMunicipios();
        this.getBeneficiarios();
    },
    methods: {
        getCorrelativoForEdit: function() {
            var url = 'api/getCorrelativo'+this.id;
            axios.get(url).then(response => {
                console.log(response);
                
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
        updateCorrelativo: function(id) {
            var url = 'correlativo/'+id;
            axios.put(url, {
                municipio_id: this.municipio_selected,
                n_partida: this.e_n_partida,
                proyecto: this.e_proyecto,
                beneficiario_id: this.e_beneficiario_id,
                orden_compra: this.e_orden_compra
            }).then(response => {
                this.$emit('recargarCorrelativos');
                this.e_n_partida = '';
                this.municipio_selected = '';
                this.e_beneficiario_id = '';
                this.e_proyecto = '';
                this.e_orden_compra = '';
                this.errors = [];
                $('#editCorrelativo').modal('hide');
                toastr.success('Correlativo editado con exito!');
            }).catch(error => {
                this.errors = 'Corrija para poder crear con exito!';
            });
        }
    }
    
}
</script>