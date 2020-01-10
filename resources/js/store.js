import Vue from 'vue'
import Vuex from 'vuex'
import {requestservice} from './services/requestservices.js'
Vue.use(Vuex)

export const store = new Vuex.Store({

	state : {

		user : [],
		parameter : {
			parameter_name : '',
			description : '',
			category_id : '',
			account_type_id : '',
		},

		category : {
			category_name : '',
		},
		
		account_type : {
			account_type_name : ''
		},
		
		emp : {
			id : null,
			name : '',
			employee_id : '',
			role_id : null,
			supervisor_id : null,
			account_id : [],
			email : ''
		},

		scorecard : {

			is_clone : false,
			header : {

				id : null,
				status : 0,
				name : '',
				account_type_id : null,
				account_id : null,
				created_by : null,
			},
			body : {
				category :[{
					id : null,
					category_name : '',
					parameters : [{
						id : null,
						parameter_name : '',
						weight : null
					}]
					
				}]
			}

		}
	},



	mutations : {


		setUser : (state,payload) =>{
			state.user = payload
		},

		
		setEmployee : (state,payload) =>{
		
			state.emp.name = payload[0].name
			state.emp.employee_id = payload[0].employee_id,
			state.emp.email = payload[0].email
		},

		addNewParameter : (state,payload) =>{
			state.scorecard.body.category[payload].parameters.push({ id : null, parameter_name : '', weight : null})
		},

		removeParameter : (state,payload) =>{
			state.scorecard.body.category[payload[0]].parameters.splice(payload[1],1)
		},

		addNewCategory : (state) =>{
			state.scorecard.body.category.push({parameters:[{id : null, parameter_name : '', weight:null}]})
		},

		removeCategory : (state,payload) =>{
			state.scorecard.body.category.splice(payload,1)
		},

		setAccountType : (state,payload) =>{
			state.account_type = payload
		},

		SetCategory : (state, payload) =>{
			state.category = payload
		},

		setParameter : (state, payload) =>{
			state.parameter = payload
		},

		setScorecardName : (state, payload) =>{
			state.scorecard.header.name = payload
		},

		insertCategoryName : (state,payload) =>{
			state.scorecard.body.category[payload[1]].category_name = payload[0]
		},

		insertParameterName : (state, payload) => {

			state.scorecard.body.category[payload[0]].parameters[payload[1]].parameter_name = payload[2]
		},

		clearScorecard : (state) =>{
			state.scorecard = {
				is_clone : false,
				header : {
					id : null,
					status : 0,
					name : '',
					account_type_id : null,
					account_id : null,
					created_by : null,
				},
				body : {
					category :[{
						id : null,
						category_name : '',
						parameters : [{
							id : null,
							parameter_name : '',
							weight : null
						}]
						
					}]
				}

			}
		},

		clearEmploye : (state) =>{
			state.emp = {
				id : null,
				name : '',
				employee_id : '',
				role_id : null,
				supervisor_id : null,
				account_id : [],
				email : ''
			}
		},

		setScorecardHeader : (state,payload) => {
			state.scorecard.header.id = payload.id
			state.scorecard.header.name = payload.scorecard_name
			state.scorecard.header.account_id = payload.account_id
			state.scorecard.header.account_type_id = payload.account_type_id
			state.scorecard.header.status = payload.status
		},

		generateScorecardCategory : (state,payload) => {

			state.scorecard.body.category.push(payload)
		},

		generateScorecardParameter : (state,payload) => {
			state.scorecard.body.category[payload[0]].parameters.push(payload[1])
		},

		setEmployeeData : (state,payload) => {
			state.emp = payload
		}
	},

	actions : {

		setUser : (context,payload) =>{
			context.commit("setUser",payload)
		},
		setEmployee : (context,payload) =>{
			context.commit("setEmployee",payload)
		},

		addNewParameter : (context,payload) =>{
			context.commit("addNewParameter",payload)
		},

		removeParameter : (context,payload) =>{

			context.commit("removeParameter",payload)
		},

		addNewCategory : (context) =>{
			context.commit("addNewCategory")
		},

		removeCategory : (context,payload) =>{
			context.commit("removeCategory",payload)
		},

		setAccountType : (context,payload) =>{
			context.commit('setAccountType',payload)
		},

		setCategory : (context, payload) => {
			context.commit('SetCategory',payload)
		},

		setParameter : (context, payload) => {
			context.commit('setParameter',payload)
		},

		setScorecardName : (context, payload) => {
			context.commit('setScorecardName',payload)
		},

		insertCategoryName : (context, payload) => {
			context.commit("insertCategoryName",payload)
		},

		insertParameterName : (context, payload) => {
			context.commit("insertParameterName",payload)
		},

		clearScorecard : (context) => {
			context.commit("clearScorecard")
		},

		setScorecardHeader : (context,payload) => {
			context.commit("setScorecardHeader",payload)
		},

		generateScorecardCategory : (context,payload) => {
			context.commit("generateScorecardCategory",payload)
		},

		generateScorecardParameter : (context,payload) => {
			context.commit("generateScorecardParameter",payload)
		},

		setEmployeeData : (context,payload) => {
			context.commit("setEmployeeData",payload)
		},

		clearEmploye : (context) => {
			context.commit("clearEmploye")
		}
	},




})