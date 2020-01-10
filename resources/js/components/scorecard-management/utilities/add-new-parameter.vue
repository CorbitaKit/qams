<template>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-md-3">
							Add New Parameter
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
									<el-input placeholder="Please input parameter name" v-model="parameter.parameter_name"></el-input>
								</el-form-item>
							</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<el-form-item label="Definition">
										<el-input type="textarea" :rows="2" placeholder="Please input description" v-model="parameter.description"></el-input>
									</el-form-item>
								</div>
								
							</div>
							<div class="row">
								<div class="col-md-12">
									<el-form-item label="Category">
										<el-select
											v-model="parameter.category_id"
										    filterable
										    allow-create
										    class="element_input"
										    default-first-option
										    placeholder="Choose parameter category">
										    <el-option
										      v-for="item in categories"
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
										<el-select v-model="parameter.account_type_id" multiple placeholder="Select">
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
									<button @click.prevent="submitParameter" type="button" class="btn btn-primary pull-right left">
										{{action_text}} Parameter
									</button>
									
									<button @click.prevent="successAction" type="button" class="btn btn-danger pull-right">
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
		name : 'add-parameter',

		data(){
			return{
				categories : [],
				account_types : [],
				action_text : ''
			}
		},

		created(){
			if(this.parameter.id){
				this.action_text = "Update"
			}else{
				this.action_text = "Add"
			}

			this.init()
		},
		computed : {
			parameter(){
				return this.$store.state.parameter
			}
		},

		methods : {
			init(){
				this.getCategories()
				this.getAccountTypes()
			},

			async getCategories(){
				let response = await this.$requestservice.getRequest('/api/get-categories')

				if(response.status == 200){
					response.data.forEach((category)=>{
						this.categories.push({value : category.id, label : category.category_name})
					})
				}
			},

			async getAccountTypes(){
				let response = await this.$requestservice.getRequest('/api/get-account-types')

				if(response.status == 200){
					response.data.forEach((account_type)=>{
						this.account_types.push({value : account_type.id, label : account_type.account_type_name})
					})
				}
			},

			async submitParameter(){

				if(this.parameter.id){
					this.updateParameter()
					return
				}

				let response = await this.$requestservice.postRequest('/api/submit-parameter',this.setParams())

				if(response.status == 201){
					this.$alertmessageservice.successMessage('Parameter Created Successfully')
					this.successAction()
				}else{
					console.log(response)
					this.$alertmessageservice.failMessage('Opps, Something went wrong')
				}
			},

			async updateParameter(){
				let response = await this.$requestservice.postRequest('/api/update-parameter/'+this.parameter.id,this.setParams())

				if(response.status == 200){
					this.$alertmessageservice.successMessage('Parameter Updated Successfully')
					this.successAction()
				}else{

					this.$alertmessageservice.failMessage('Opps, Something went wrong')
				}
			},


			successAction(){
				this.$store.dispatch('setParameter',this.setParameterDataToNull())
				this.$router.push('/parameter-list')
			},



			setParameterDataToNull(){
				return {
					parameter_name : '',
					description : '',
					category_id : null,
					account_type_id : null,
					id : null
				}
			},

			setParams(){
				let data = new FormData()

				data.append('parameter_name',this.parameter.parameter_name)
				data.append('description',this.parameter.description)
				data.append('category_id',this.parameter.category_id)
				data.append('account_type_id',this.parameter.account_type_id)

				return data
			},

		},
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