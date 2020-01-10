import router from './routes.js'
import GlobalImport from './plugins/global-import.js'
import {store} from './store.js'


require('./bootstrap');

window.Vue = require('vue');
Vue.use(GlobalImport)

new Vue({
	router,
	store,
	computed:{
		currentPage(){
			return this.$route.path
		}
	},
	data(){
		return{
			transitionName : 'slide-left'
		}
	},
	beforeRouteUpdate(to, from, next){
		const toDepth = to.path.split('/').length
		const fromDepth = from.path.split('/').length
		this.transitionName = toDepth < fromDepth ? 'slide-right' : 'slide-left'
		next()
	}

}).$mount("#app");
