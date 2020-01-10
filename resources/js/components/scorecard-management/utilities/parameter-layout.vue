<template>
	<div>
		<div class="row" v-cloak>
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div class="row">
							<div class="col-md-4">
								Parameter management
							</div>
							<div class="col-md-8">
								<router-link to="/add-new-parameter">
									<button type="button" class="btn btn-primary pull-right">
										<i class="batch-icon batch-icon-plus"></i> Add new parameter
									</button>
								</router-link>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div v-if="parameters.length == 0">
							<h1 class="text-center">---No Data Yet---</h1>
						</div>
						<div v-else>
							<table class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>Parameter Name</th>
										<th>Description</th>
										<th>Category</th>
										<th>Type</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="parameter in parameters">
										<td style="width:15%">
											<p>{{ parameter.parameter_name}}</p>
										</td>
										<td style="width:40%">
											<p>{{ parameter.description}}</p>
										</td>
										<td style="width:15%">
											<p>{{ parameter.category.category_name}}</p>
										</td>
										<td style="width:10%">
											<p v-for="account_type in parameter.account_types">{{ account_type.account_type_name }}</p>
										</td>
										<td style="width:15%">
											<a class="btn btn-success" @click="editParameter(parameter)">
												<i class="batch-icon batch-icon-quill"></i>
											</a>
											<a class="btn btn-danger" @click="destroyParameter(parameter.id)">
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
		name : 'parameter-layout',

		
		data(){
			return{
				parameters : [],
				
			}
		},

		created(){
			this.getParameters()
			// this.getCategories()
		},


		methods : {

			async getParameters(){

				let response = await this.$requestservice.getRequest('/api/get-parameters')

				this.parameters = response.data
				
			},

			async destroyParameter(id){

				let confirm = await this.$alertmessageservice.confirmationMessage()

				if(confirm){
					let response = await this.$requestservice.deleteRequest('/api/delete-parameter/'+id)
					if(response.status == 200){
						this.$alertmessageservice.successMessage('Parameter deleted successfully')
						this.getParameters()
					}
				}
			},

			editParameter(parameter){
				this.$store.dispatch('setParameter',parameter)
				this.$router.push('/add-new-parameter')
			}
		}
	};
</script>

<style scoped>
	.el-input__inner{
		height: 40px !important;
		
	}

	.element_input{
		width: 872px !important;
	}

	.left{
		margin-left:3px;
	}
	.el-select-dropdown {
	  position: absolute !important;
	}
</style>