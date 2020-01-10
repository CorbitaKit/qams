<template>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-md-3">
							User Management
						</div>
						<div class="col-md-9">
							<input type="text" name="" id="input" class="form-control" placeholder="Search Member...">
						</div>
					</div>
				</div>
				<div class="card-table table-responsive">
					<table class="table table-hover align-middle">
						<thead class="thead-light">
							<tr>
								<th>Member</th>
								<th>Email</th>
								<th>Role</th>
								<th>Created</th>
								<th class="text-right">Action</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="employee in employees">
								<td>
									<div class="media">
										<div class="profile-picture bg-gradient bg-primary float-right d-flex mr-3">
											<!-- <img src="assets/img/profile-pic.jpg" width="44" height="44"> -->

											<vue-initials-img :name="employee.name" size="44"/>
										</div>
										<div class="media-body">
											<div class="heading mt-1">
												{{ employee.name }}
											</div>
											
										</div>
									</div>
								</td>
								<td>
									<a href="#"> {{ employee.email }}</a>
								</td>

								<td>
									<span class="badge badge-success">{{ employee.role.name }}</span>
								</td>
								
								<td>{{ employee.created_at | moment("dddd, MMMM Do YYYY")}}</td>
								<td class="text-right">
									<a class="btn btn-success" @click.prevent="editEmployee(employee.id)">
										<i class="batch-icon batch-icon-quill"></i>
									</a>
									<a class="btn btn-danger" @click.prevent="deleteEmployee(employee.id)">
										<i class="batch-icon batch-icon-bin"></i>
									</a>
								</td>
							</tr>
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
		
</template>

<script>
	export default{
		name : 'member-manegement-layout',

		data(){
			return{
				employees : []
			}
		},

		created(){
			this.getEmployees()
		},

		methods : {
			async getEmployees(){
				
				let response = await this.$requestservice.getRequest('/api/get-employees')

				if(response.status == 200){
					this.employees = response.data
				}
			},

			async editEmployee(id){
				let response = await this.$requestservice.getRequest('/api/get-employee/'+id)

				this.$store.dispatch("setEmployeeData",response.data)

				this.$router.push('/add-new-user')
			},

			async deleteEmployee(id){
				let confirm = await this.$alertmessageservice.confirmationMessage()

				if(confirm){
					let response = await this.$requestservice.deleteRequest('/api/delete-employee/'+id)

					if(response.status == 200){
						this.$alertmessageservice.successMessage('Employee deleted successfully')
						this.getEmployees()
					}				
				}
			}
		}
	};
</script>