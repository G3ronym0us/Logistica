<template>
    <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" @click="linkCrear()">Crear Correlativo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" @click="linkCorrelativo()">Correlativos</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Configuración</a>
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
</template>

<script>
export default {
    methods: {
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