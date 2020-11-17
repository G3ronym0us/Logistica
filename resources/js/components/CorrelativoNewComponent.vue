<template>

    <form method="POST" v-on:submit.prevent="createCorrelativo">
    <div class="modal fade" id="create">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Nuevo Correlativo</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="municipio">Municipio</label>
                    <select name="municipio" id="municipio" class="form-control" v-model="municipio_id">
                        <option v-bind:value="municipio.id" v-for="municipio in municipios" :key="municipio.id">{{ municipio.name }}</option>
                    </select>

                    <label for="n_partida">Numero de Partida</label>
                    <input type="number" class="form-control" name="name" v-model="n_partida" v-on:keyup="formatNumPartida">

                    <label for="proyecto">Proyecto</label>
                    <select name="proyecto" id="proyecto" class="form-control" v-model="proyecto">
                        <option value="ZONA" >ZONA</option>
                    </select>

                    <label for="beneficiario">Beneficiario</label>
                    <select name="beneficiario" id="beneficiario" class="form-control" v-model="beneficiario_id">
                        <option v-bind:value="beneficiario.id" v-for="beneficiario in beneficiarios" :key="beneficiario.id">{{ beneficiario.name }}</option>
                    </select>

                    <label for="orden_compra">Orden de Compra</label>
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
</form>
</template>

<script>
export default {
    data (){
        return{
            municipios: [],
            beneficiarios: [],
            municipio_id: '',
            n_partida: '',
            formatNumPartida: '',
            proyecto: '',
            beneficiario_id: '',
            orden_compra: '',
        }
    },
    created: function() {
        this.getMunicipios();
        this.getBeneficiarios();
    },
    methods: {
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
                this.$emit('recargarCorrelativos');
                this.n_partida = '';
                this.municipio_id = '';
                this.beneficiario_id = '';
                this.proyecto = '';
                this.orden_compra = '';
                this.errors = [];
                $('#create').modal('hide');
                toastr.success('Nuevo Correlativo creado!');
            }).catch(error => {
                this.errors = 'Corrija para poder crear con exito!';
            });
        }
    }
}
</script>