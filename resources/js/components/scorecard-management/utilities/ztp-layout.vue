<template>
	<div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div class="row">
							<div class="col-md-3">
								ZTP Management
							</div>
							<div class="col-md-9">
								<div>
									<router-link to="/add-ztp">
										<button type="button" ref="modal_div" class="btn btn-primary pull-right">
											<i class="batch-icon batch-icon-plus"></i> Add new ZTP
										</button>
									</router-link>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div v-if="ztps.length == 0">
							<h1 class="text-center">---No Data Yet---</h1>

						</div>
						<div v-else>
							<table class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>ZTP Name</th>
										<th>Account</th>
										<th>Account Type</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="ztp in ztps">
										<td style="width:20%">
											<p>{{ ztp.ztp_name}}</p>
										</td>

										<td style="width:20%">
											<p>{{ ztp.account.account_name}}</p>
										</td>

										<td style="width:20%">
											<p>{{ ztp.account_type.account_type_name }}</p>
										</td>
										
										<td style="width:20%">
											<a class="btn btn-success">
												<i class="batch-icon batch-icon-quill"></i>
											</a>
											<a class="btn btn-danger" @click.prevent="removeZTP(ztp.id)">
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
		</div>	
	</div>
</template>


<script>

	export default{
		name : 'ztp-layout',
		

		data(){
			return{
				ztps : []
			}
		},

		created(){
			this.getZTPs()
		},

		methods : {
			async getZTPs(){

				let response = await this.$requestservice.getRequest('/api/get-ztps')

				this.ztps = response.data

			},

			async removeZTP(id){
				let confirm = await this.$alertmessageservice.confirmationMessage()

				if(confirm){
					let response = await this.$requestservice.deleteRequest('/api/delete-ztp/'+id)

					if(response.status == 200){
						this.$alertmessageservice.successMessage('ZTP deleted successfully')
						this.getZTPs()
					}
				}
			}
		}
	};
</script>