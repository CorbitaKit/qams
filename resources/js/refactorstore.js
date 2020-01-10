import Vue from 'vue'
import Vuex from 'vuex'
import {requestservice} from './services/requestservices.js'
Vue.use(Vuex)

export const refactorStore = new Vuex.Store({
	state : {
		user : [],
		
	}
})