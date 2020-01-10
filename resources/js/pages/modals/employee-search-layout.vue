<template>
	<div>
		<div class="modal fade employee-search" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Search employee to be added</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-header">
										<div class="row">
											<div class="col-md-3">
												User List
											</div>
											<div class="col-md-9">
												<input type="text" name="" id="input" class="form-control" placeholder="Search Employee..." v-model="keyword">
											</div>
										</div>
									</div>
									<div class="card-table table-responsive">
										<table class="table table-hover align-middle">
											<thead class="thead-light">
												<tr>
													<th>Member</th>
													<th>Email</th>
													
													<th>Employee ID</th>
													<th class="text-right">Action</th>
												</tr>
											</thead>
											<tbody>
												<tr v-for="user in users">
													<td>
														<div class="media">
															<div class="profile-picture bg-gradient bg-primary float-right d-flex mr-3">
																<!-- <img src="assets/img/profile-pic.jpg" width="44" height="44"> -->
																<vue-initials-img :name="user.name" size="44"/>
															</div>
															<div class="media-body">
																<div class="heading mt-1">
																	{{ user.name }}
																</div>
																<div class="subtext">{{ user.given_name}} </div>
															</div>
														</div>
													</td>
													<td>
														<a href="#">{{ user.email }}</a>
													</td>
													
													<td>{{ user.employee_id}}</td>
													<td class="text-right">
														<a class="btn btn-primary" data-dismiss="modal" @click="setEmployeeData(user.employee_id)">
															<i class="batch-icon batch-icon-options"></i>
														</a>
														
													</td>
												</tr>
												
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</template>
 
<script>
	export default{
		name : 'employee-search-layout',

		data(){
			return{
				users : [],
				keyword : ''
			}
		},

		created(){
			
		},
		methods : {
			setEmployeeData(id){
				let employee = this.users.filter(user => {
					return user.employee_id === id
				})

				


				axios.get('/api/check-if-added/'+employee[0].email)
				.then(response=>{
					this.$store.dispatch("setEmployee",employee)
				})
				.catch(err=>{
					this.$alertmessageservice.failMessage("Employee already added")
				})

			}
		},

		watch : {
			async keyword (data){
				if(data.length == 0){
					this.users = []
					return
				}

				let response = await this.$requestservice.getRequest('/api/search-ldap-user/'+data)

				this.users = []
				response.data.forEach(user=>{
					if(user.givenname){
						if(user.mail){
							this.users.push({name : user.name[0],email : user.mail[0], employee_id : user.samaccountname[0],given_name : user.givenname[0]})
						}
					}
				})
			}
		}
	};
</script>