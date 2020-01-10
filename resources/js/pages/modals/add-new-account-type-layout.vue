<template>
	<div class="modal fade add-account-type" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Add New Account Type</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12">
								<label>Account Type Name</label>
								<el-input placeholder="Please input account type name" v-model="account_type.account_type_name">
									
								</el-input>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" @click.prevent="cancelAction" class="btn btn-secondary"  data-dismiss="modal">Close</button>
						<button type="button" @click.prevent="addAccountType" class="btn btn-primary" data-dismiss="modal">{{ action_text }} Account Type</button>
					</div>
				</div>
				
			</div>
		</div>
</template>

<script>
	export default{
		name : 'add-account-type',

		data(){
			return{
				
				action_text : 'Add',
				
			}
		},

		computed : {
			account_type(){
				return this.$store.state.account_type
			}
		},

		created(){
			if(this.account_type.id){

				this.action_text = "Update"
			}else{
				this.action_text = "Add"
			}
		},

		

		methods : {
			async addAccountType(){
				if(this.account_type.id){
					this.updateAccountType()
					return
				}

				let response = await this.$requestservice.postRequest('/api/create-account-type',this.setParams())
				if(response.status == 201){
					this.$alertmessageservice.successMessage('Account Type Created')
					this.successAction()
					
				}else{
					this.$alertmessageservice.failMessage('Opps, Something went wrong')
				}
				
			},

			async updateAccountType(){
				let response = await this.$requestservice.postRequest('/api/update-account-type/'+this.account_type.id,this.setParams())
				if(response.status == 200){
					this.$alertmessageservice.successMessage('Account Type Updated Successfully')
					this.successAction()
				}else{
					this.$alertmessageservice.failMessage('Opps, Something went wrong')
				}


			},

			successAction(){
				this.$parent.getAccountTypes()
				this.cancelAction()
			},

			setParams(){
				let data = new FormData()
				data.append("account_type_name",this.account_type.account_type_name)

				return data
			},

			

			cancelAction(){
				this.$store.dispatch("setAccountType",{account_type_name : '', id : null})
				this.$parent.resetBoolean()
			}
		}
	};
</script>