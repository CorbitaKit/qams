import Vue from 'vue'
import VueRouter from 'vue-router'
import DashboardLayout from './components/dashboard-layout.vue'
import UserManagementLayout from './pages/dashboard/member-management-layout.vue'
import AddNewUserLayout from './components/user-management/add-new-user-layout.vue'
import ScoreCardLayout from './components/scorecard-management/score-card-list-layout.vue'
import CategoryLayout from './components/scorecard-management/utilities/category-layout.vue'
import ParameterLayout from './components/scorecard-management/utilities/parameter-layout.vue'
import AddNewScorecardLayout from './components/scorecard-management/add-scorecard-layout.vue'
import ScoreCardViewLayout from './components/scorecard-management/score-card-layout.vue'
import AccountTypeLayout from './components/scorecard-management/utilities/account-type-layout.vue'
import AddNewParameter from './components/scorecard-management/utilities/add-new-parameter.vue'
import ZTPLayout from './components/scorecard-management/utilities/ztp-layout.vue'
import AddNewZTP from './components/scorecard-management/utilities/add-new-ztp.vue'


Vue.use(VueRouter)

const routes = [

	{
		path : "/dashboard",
		component : DashboardLayout
	},
	{
		path : "/member-management",
		component : UserManagementLayout
	},
	{
		path : "/add-new-user",
		component : AddNewUserLayout
	},
	{
		path : "/score-card-list",
		component : ScoreCardLayout
	},
	{
		path : '/category-list',
		component : CategoryLayout
	},
	{
		path : '/parameter-list',
		component : ParameterLayout
	},
	{
		path : '/scorecard',
		component : AddNewScorecardLayout
	},
	{
		path :'/score-card-view',
		component : ScoreCardViewLayout
	},
	{
		path : '/account-type-layout',
		component : AccountTypeLayout
	},
	{
		path : '/add-new-parameter',
		component : AddNewParameter
	},
	{
		path : '/ztp-layout',
		component : ZTPLayout
	},
	{
		path : '/add-ztp',
		component : AddNewZTP
	}



]

export default new VueRouter({routes,mode:'history',base : __dirname})