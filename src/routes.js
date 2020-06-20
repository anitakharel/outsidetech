import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const router = new VueRouter({
	mode : 'history',
	routes: [
		{ 
			path: '/',
			name: 'Product',
			component: require('./components/Product.vue').default
		},
		{ 
			path: '/list_product',
			name: 'ListProduct',
			component: require('./components/ListProduct.vue').default
		},
		{ 
			path: '/add_product',
			name: 'AddProduct',
			component: require('./components/AddProduct.vue').default
		},
		{ 
			path: '/login',
			name: 'UserLogin',
			component: require('./components/Login.vue').default
		},
		{ 
			path: '/payment',
			name: 'Payment',
			component: require('./components/Payment.vue').default
		}
	]
});

export default router