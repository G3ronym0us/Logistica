<template>
    <form method="POST" v-on:submit.prevent="createBeneficiario">
    <div class="modal fade" id="create">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Nuevo Beneficiario</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" name="name" v-model="name">
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
            name: '',
        }
    },
    methods: {
        createBeneficiario: function() {
            var url = 'beneficiario';
            axios.post(url, {
                name: this.name,
            }).then(response => {
                //this.getBeneficiarios();
                this.name = '';
                this.errors = [];
                this.$emit('recargar');
                $('#create').modal('hide');
                toastr.success('Nuevo Beneficiario creado!');
            }).catch(error => {
                this.errors = 'Corrija para poder crear con exito!';
            });
        }
    }
}
</script>