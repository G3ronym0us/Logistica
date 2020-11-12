<template>
    <form method="POST" v-on:submit.prevent="updateBeneficiario(id)">
    <div class="modal fade" id="edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Editar Beneficiario</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" name="name" v-model="name">
                    <span  class="text-danger"></span>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Actualizar">
                </div>
            </div>
        </div>
    </div>
</form>
</template>


<script>
    export default {
        props:['id','name'],
        data (){
            return{
                ename: '',
            }
        },
        methods: {
            updateBeneficiario: function(id) {
                var url = 'beneficiario/'+id;
                axios.put(url, {
                    name: this.ename,
                }).then(response => {
                    //this.getBeneficiarios();
                    this.ename = '';
                    this.errors = [];
                    this.$emit('recargar');
                    $('#edit').modal('hide');
                    toastr.success('Beneficiario editado!');
                }).catch(error => {
                    this.errors = 'Corrija para poder crear con exito!';
                });
            }
        }
    }
</script>


