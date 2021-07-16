/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: {
        elementId:'',
        elementUrl: '',
        showSpinner:false,
    },
    methods:{
        getElementData(event){
            this.elementId = event.currentTarget.getAttribute('data-id');
            this.elementUrl = event.currentTarget.getAttribute('href');
        },
        deleteIt(){
            if(this.elementId !=''){
                this.showSpinner=true;
                axios.delete(this.elementUrl).then((response) => {
                    this.showSpinner=false;
                    $("#deleteModal").modal('hide');
                    if (response.data.error){
                        Toast.fire({
                            icon: 'error',
                            title: response.data.message,
                        });
                    }else{
                        $("#target"+this.elementId).fadeOut();
                        Toast.fire({
                            icon: 'success',
                            title: response.data.message,
                        });
                    }
                },(error) => {
                    this.showSpinner=false;
                    $("#deleteModal").modal('hide');
                    Toast.fire({
                        icon: 'warning',
                        title: 'Error inesperado, intente de nuevo mas tarde',
                    });
                });
            }
        }
    }
});
