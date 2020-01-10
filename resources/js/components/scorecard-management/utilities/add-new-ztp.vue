<template>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-md-3">
							Add New ZTP
						</div>
						<div class="col-md-9">
							
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="col-md-12">
						<el-form ref="form" label-width="100px">
							<div class="row">
								<div class="col-md-12">
									<el-form-item label="Parameter">
										<el-input placeholder="Please input ztp name" v-model="ztp.ztp_name"></el-input>
									</el-form-item>
								</div>
							</div>
						
							<div class="row">
								<div class="col-md-12">
									<el-form-item label="Account">
										<el-select v-model="ztp.account_id"  placeholder="Select ZTP Account">
										    <el-option
										      v-for="item in accounts"
										      :key="item.value"
										      :label="item.label"
										      :value="item.value">
										    </el-option>
										  </el-select>
									</el-form-item>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<el-form-item label="Type">
										<el-select
											v-model="ztp.account_type_id"
										    filterable
										 
										    default-first-option
										    placeholder="Choose ZTP account type">
										    <el-option
										      v-for="item in account_types"
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
									<button @click.prevent="submitZTP" type="button" class="btn btn-primary pull-right left">
										Add ZTP
									</button>
									
									<button @click.prevent="cancelAction" type="button" class="btn btn-danger pull-right">
										Cancel
									</button>
									
								</div>
							</div>
						</el-form>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	
	export default{

		data(){
			return{
				ztp : {
					ztp_name : '',
					account_id : null,
					account_type_id : null
				},

				accounts : [],
				account_types : []
			}
		},

		created(){
			this.init()
		},

		methods : {
			init(){
				this.getAccounts()
				this.getAccountTypes()
			},

			async getAccounts(){

				let response = await this.$requestservice.getRequest('/api/get-accounts')

				if(response.status == 200){

					response.data.forEach((account)=>{
						this.accounts.push({label : account.account_name, value : account.id})
					})
				}

			},

			async getAccountTypes(){
				let response = await this.$requestservice.getRequest('/api/get-account-types')

				if(response.status == 200){
					response.data.forEach((account_type)=>{
						this.account_types.push({label : account_type.account_type_name, value : account_type.id})
					})
				}
			},

			async submitZTP(){

				let response = await this.$requestservice.postRequest('/api/submit-ztp-data',this.setParams())

				if(response.status == 201){
					this.setDataToNull()
					this.$alertmessageservice.successMessage('ZTP Created successfully')
					this.$router.push('/ztp-layout')
				}
			},

			cancelAction(){
				this.setDataToNull()
				this.$router.push('/ztp-layout')
			},

			setParams(){
				let data = new FormData()

				data.append('ztp_name',this.ztp.ztp_name)
				data.append('account_id',this.ztp.account_id)
				data.append('account_type_id',this.ztp.account_type_id)

				return data
			},

			setDataToNull(){
				this.ztp.ztp_name = ''
				this.ztp.account_id = 0
				this.ztp.account_type_id = 0
			}


		}

	};
</script>

<style scoped>
	.el-select{
		width: 98%;
	}

	.left{
		margin-left:3px;
	}
</style>