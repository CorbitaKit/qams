import VueApexCharts from 'vue-apexcharts'
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import VueInitialsImg from 'vue-initials-img';
import AlertMessage from '.././services/alertmessage.js'
import RequestService from '.././services/requestservices.js'
import FlashValues from '.././services/flashvalues.js'
import locale from 'element-ui/lib/locale/lang/en'
import VueMask from 'v-mask'

const GlobalImports = {
	install(vue){
		Vue.component('apexchart',VueApexCharts)
		Vue.use(ElementUI, {locale})
		Vue.use(VueInitialsImg)
		Vue.use(require('vue-moment'));
		Vue.use(RequestService)
		Vue.use(AlertMessage)
		Vue.use(VueMask)
		Vue.use(FlashValues)
	}
}

export default GlobalImports