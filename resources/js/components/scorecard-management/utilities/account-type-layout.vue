<template>
	<div>
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-md-4">
							Account Type management
						</div>
						<div class="col-md-8">
							<button type="button" class="btn btn-primary pull-right"
									@click="is_adding = true"
									data-toggle="modal" 
									data-target=".add-account-type">
								<i class="batch-icon batch-icon-plus"></i> Add new account type
							</button>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div v-if="account_types.length == 0">
						<h1 class="text-center">---No Data Yet---</h1>
					</div>
					<div v-else>
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>Account Type Name</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="account_type in account_types">
									<td style="width:75%">
										<p>{{ account_type.account_type_name}}</p>
									</td>
									<td style="width:15%">
										<a class="btn btn-success" 
										   @click="editAccountType(account_type)"
									       data-toggle="modal" 
									       data-target=".add-account-type">
											<i class="batch-icon batch-icon-quill"></i>
										</a>
										<a class="btn btn-danger" @click="deleteAccountType(account_type.id)">
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
		<add-account-type v-if="is_adding"></add-account-type>
	</div>
</template>


<script>
	import AddAccountType from '../../.././pages/modals/add-new-account-type-layout.vue'
	export default{

		data(){
			return {
			
				account_types : [],
				is_adding : false,
				account_type_id : null
			}
		},

		components : {
			AddAccountType
		},

		created(){
			this.getAccountTypes()

		},

		methods : {
			async getAccountTypes(){
				let response = await this.$requestservice.getRequest('/api/get-account-types')

				this.account_types = response.data
				this.resetBoolean()
			},

			editAccountType(account_type){
				this.resetBoolean()
				this.$store.dispatch("setAccountType",account_type)
			},

			async deleteAccountType(id){
				let confirm = await this.$alertmessageservice.confirmationMessage()

				if(confirm){

					let response = await this.$requestservice.deleteRequest('/api/delete-account-type/'+id)

					if(response.status == 200){
						this.$alertmessageservice.successMessage('Account Type deleted successfully')
						this.getAccountTypes()
					}
				}

			},

			resetBoolean(){
				if(this.is_adding){
					this.is_adding = false
				}else{
					this.is_adding = true
				}
			}


		}

	};
</script>

<style>
	.el-input__inner{
		height: 36px !important;
	}
	.el-input{
		width: 98% !important;
	}
</style>