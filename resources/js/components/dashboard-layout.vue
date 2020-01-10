<template>
	<div>
		<widget-layout></widget-layout>
		<line-chart-layout></line-chart-layout>
		<hr>
		<div class="row">
			<team-member-layout></team-member-layout>
			<activity-layout></activity-layout>
			<request-layout></request-layout>
		</div>
		<hr>

		<member-management-layout v-if="user.role.name == 'Manager'"></member-management-layout>
	</div>
</template>


<script>
	import WidgetLayout from '.././pages/dashboard/widget-layout.vue'
	import LineChartLayout from '.././pages/dashboard/line-chart-layout.vue'
	import TeamMemberLayout from '.././pages/dashboard/team-member-layout.vue'
	import MemberManagementLayout from '.././pages/dashboard/member-management-layout.vue'
	import ActivityLayout from '.././pages/dashboard/activity-layout.vue'
	import RequestLayout from '.././pages/dashboard/request-layout.vue'

	export default{
		name : 'dashboard-layout',
		components : {
			WidgetLayout,
			LineChartLayout,
			TeamMemberLayout,
			MemberManagementLayout,
			ActivityLayout,
			RequestLayout
		},

		data(){
			return{
				user : [],
			}
		},



		created(){
			let id = document.getElementById('user').value

			this.setUser(id)

		},

		methods : {
			async setUser(id){

				let response = await this.$requestservice.getRequest('/api/get-employee-loggedin/'+id)

				this.user = response.data

				console.log(this.user)

			}
		}
	};
</script>