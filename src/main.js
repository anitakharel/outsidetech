import Vue from 'vue'
import App from './App.vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
import VueRouter from 'vue-router'
import router from './routes'
import Swal from 'sweetalert2'

Vue.config.productionTip = false
Vue.use(VueAxios, axios);
Vue.use(VueRouter);
Window.Swal = Swal;

new Vue({
    el: '#app',
    components: { App },
    mounted(){
    },
    router,
    render: h => h('app'),
    methods:{
    },
    computed:{
    },
    watch: {
    }
});