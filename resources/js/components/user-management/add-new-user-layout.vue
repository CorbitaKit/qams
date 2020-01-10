<template>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-md-3">
							User management
						</div>
						<div class="col-md-9">
							<button type="button" class="btn btn-primary pull-right" 
									@click="is_search = true"
									data-toggle="modal" 
									data-target=".employee-search">
								<i class="batch-icon batch-icon-zoom-in-alt"></i> Search Employee
							</button>
						</div>
					</div>
				</div>
				<div class="card-body">
					<el-form ref="form" :model="employee" label-width="100px">
						<div class="row">
							<div class="col-md-6">
								<el-form-item label="Name">
									<el-input placeholder="Please input name" v-model="employee.name"></el-input>
								</el-form-item>
							</div>
							<div class="col-md-6">
								<el-form-item label="Email">
									<el-input placeholder="Please input Email" v-model="employee.email"></el-input>
								</el-form-item>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<el-form-item label="ID">
									<el-input placeholder="Please input employee ID" v-model="employee.employee_id"></el-input>
								</el-form-item>
							</div>
							<div class="col-md-6">
								<el-form-item label="Role">
									<el-select
										v-model="employee.role_id"
									    filterable
									    class="element_input_role"
									    default-first-option
									    placeholder="Choose employee role">
									    <el-option
									      v-for="item in roles"
									      :key="item.value"
									      :label="item.label"
									      :value="item.value">
									    </el-option>
									</el-select>
								</el-form-item>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<el-form-item label="Account">
									<el-select
									    v-model="employee.account_id"
									   	multiple
									   
								    	default-first-option
									    class="element_input_role"
									    
									    placeholder="Select employee Projects">
									    <el-option
									      v-for="item in projects"
									      :key="item.value"
									      :label="item.label"
									      :value="item.value">
									    </el-option>
									</el-select>
								</el-form-item>
							</div>

						</div>



						<hr>
						<div class="row">
							<div class="col-md-12">
								<button type="button" class="btn btn-primary pull-right" @click.prevent="submitEmployeeData">
									<i class="batch-icon batch-icon-polaroid-alt"></i> {{ action_text }} Employee
								</button>
							</div>
						</div>
					</el-form>
				</div>


			</div>
			
		</div>

		<employee-search-layout v-if="is_search"></employee-search-layout>

	</div>

</template>

<script>
	import EmployeeSearchLayout from '../.././pages/modals/employee-search-layout.vue'
	export default{
		name : 'add-new-user-layout',
		components : {
			EmployeeSearchLayout
		},

		computed : {
			employee(){
				return this.$store.state.emp
			}
		},
		data(){
			return{
				roles : [],

				is_search : false,

				projects : [],

				action_text : "Add"
			}
		},

		created(){

			this.getRoles()
			this.getAccounts()

			if(this.employee.id){
				this.action_text = "Update"
				this.getEmployeeProject()
			}
			
		},

		methods : {

			async getRoles(){
				let response = await this.$requestservice.getRequest('/api/get-roles')

				response.data.forEach(role=>{
					
					this.roles.push({value : role.id, label : role.name})
				})

			},

			async getAccounts(){
				let response = await this.$requestservice.getRequest('/api/get-accounts')

				response.data.forEach(account=>{
					this.projects.push({value : account.id, label : account.account_name})
				})
			},

			async submitEmployeeData(){

				if(this.employee.id){
					this.updateEmployeeData()
					return
				}


				let response = await this.$requestservice.postRequest('/api/submit-employee-data',this.employee)

				if(response.status == 201){
					this.$alertmessageservice.successMessage('Employee data saved successfully')
					this.$store.dispatch("clearEmploye")
					this.$router.push('/member-management')

				}else{
					this.$alertmessageservice.failMessage("Please fill up all the fields")
				}
				
			},

			async getEmployeeProject(){
				let response = await this.$requestservice.getRequest('/api/get-employee-accounts/'+this.employee.id)

				response.data.forEach(employee_account=>{
					this.employee.account_id.push(employee_account.account_id)
				})
			},

			async updateEmployeeData(){
				let response = await this.$requestservice.postRequest('/api/update-employee-data/'+this.employee.id,this.employee)
				this.$store.dispatch("clearEmploye")
				this.action_text = "Add"
				this.$router.push('/member-management')
			}
		}
	};
</script>

<style scoped>
	.el-input__inner{
		height: 40px !important;
		
		
	}

	.element_input_role{
		width: 96% !important;
	}



</style>