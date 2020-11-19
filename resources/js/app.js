0/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 window.jquery = require('jquery');

require('./bootstrap');

window.Vue = require('vue');
window.axios = require('axios');
window.toastr= require('toastr');
import pdf from 'vue-pdf'

    export default {
    components: {
        pdf
    }
    }

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('beneficiario-component', require('./components/BeneficiarioComponent.vue').default);
Vue.component('beneficiario-edit-component', require('./components/BeneficiarioEditComponent.vue').default);
Vue.component('beneficiario-new-component', require('./components/BeneficiarioNewComponent.vue').default);

Vue.component('correlativo-component', require('./components/CorrelativoComponent.vue').default);
Vue.component('correlativo-edit-component', require('./components/CorrelativoEditComponent.vue').default);
Vue.component('correlativo-new-component', require('./components/CorrelativoNewComponent.vue').default);

Vue.component('catalogo-component', require('./components/CatalogoComponent.vue').default);

Vue.component('unidad-component', require('./components/UnidadComponent.vue').default);

Vue.component('detalles-component', require('./components/DetallesCorrelativoComponent.vue').default);

Vue.component('user-component', require('./components/UserTableComponent.vue').default);

Vue.component('nav-component', require('./components/NavegacionComponent.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

new Vue({
	el: '#app'
});


/*
		var app = new Vue({
			el: '#app',
			created: function() {
				this.getCorrelativos();
				this.getBeneficiarios();
				this.getMunicipios();
			},
			data: {
			  lists: [],
			  municipios: [],
			  beneficiarios: [],
			  errors: [],
			  n_partida: '',
			  municipio_id: '',
			  beneficiario_id: '',
			  proyecto: '',
			  orden_compra: '',
			  pagination: {
				'total': 0,
				'current_page': 0,
				'per_page': 0,
				'last_page': 0,
				'from': 0,
				'to': 0
			}
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
				getCorrelativos: function() {
					var url = 'api/getCorrelativos';
					axios.get(url).then(response => {
						this.lists = response.data.data
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
						this.beneficiarios = response.data
						this.pagination = response.data.pagination
					});
				},
				formatNumPartida: function() {
					this.n_partida = this.n_partida.replace("-","");
					if(this.n_partida.length >= 3 && this.n_partida.length <= 5){
						this.n_partida = this.n_partida.substr(0,3)+'-'+this.n_partida.substr(3,2);
					}
					if(this.n_partida.length >= 6 && this.n_partida.length <= 7){
						this.n_partida = this.n_partida.replace("-","");
						this.n_partida = this.n_partida.replace("-","");
						this.n_partida = this.n_partida.substr(0,3)+'-'+this.n_partida.substr(3,2)+'-'+this.n_partida.substr(5,2);
					}
					if(this.n_partida.length >= 8){
						this.n_partida = this.n_partida.replace("-","");
						this.n_partida = this.n_partida.replace("-","");
						this.n_partida = this.n_partida.substr(0,3)+'-'+this.n_partida.substr(3,2)+'-'+this.n_partida.substr(5,2)+'-'+this.n_partida.substr(7,2);
					}

				},
				changePage: function(page) {
					this.pagination.current_page = page;
					this.getKeeps(page);
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
						this.getCorrelativos();
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
		  })
*/