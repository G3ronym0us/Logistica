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
                        <option v-bind:value="municipio.id" v-for="municipio in municipios">@{{ municipio.name }}</option>
                    </select>

                    <label for="n_partida">Numero de Partida</label>
                    <input type="number" class="form-control" name="name" v-model="n_partida" v-on:keyup="formatNumPartida">

                    <label for="proyecto">Proyecto</label>
                    <select name="proyecto" id="proyecto" class="form-control" v-model="proyecto">
                        <option value="ZONA" >ZONA</option>
                    </select>

                    <label for="beneficiario">Beneficiario</label>
                    <select name="beneficiario" id="beneficiario" class="form-control" v-model="beneficiario_id">
                        <option v-bind:value="beneficiario.id" v-for="beneficiario in beneficiarios">@{{ beneficiario.name }}</option>
                    </select>

                    <label for="orden_compra">Orden de Compra</label>
                    <input type="number" class="form-control" name="orden_compra" v-model="orden_compra">

                    <span v-for="error in errors" class="text-danger">@{{ error }}</span>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Guardar">
                </div>
            </div>
        </div>
    </div>
</form>