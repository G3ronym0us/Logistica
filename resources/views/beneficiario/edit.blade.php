<form method="POST" v-on:submit.prevent="updateBeneficiario(fillBeneficiario.id)">
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
                    <input type="text" class="form-control" name="name" v-model="fillBeneficiario.name">
                    <span v-for="error in errors" class="text-danger">@{{ error }}</span>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Actualizar">
                </div>
            </div>
        </div>
    </div>
</form>