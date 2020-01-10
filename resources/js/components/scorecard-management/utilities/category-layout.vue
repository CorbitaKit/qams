<template>
	<div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div class="row">
							<div class="col-md-3">
								Category Management
							</div>
							<div class="col-md-9">
								<div>
									<button @click.prevent="setBoolean" type="button" ref="modal_div" class="btn btn-primary pull-right" data-toggle="modal" data-target=".add-category">
										<i class="batch-icon batch-icon-plus"></i> Add new category
									</button>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div v-if="categories.length == 0">
							<h1 class="text-center">---No Data Yet---</h1>

						</div>
						<div v-else>
							<table class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>Category Name</th>
										
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="category in categories">
										<td style="width:80%">
											<p>{{ category.category_name}}</p>
										</td>
										
										<td style="width:20%">
											<a class="btn btn-success" @click.prevent="editCategory(category)" data-toggle="modal" data-target=".add-category">
												<i class="batch-icon batch-icon-quill"></i>
											</a>
											<a class="btn btn-danger" @click.prevent="removeCategory(category.id)">
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
		<add-category v-if="is_adding"></add-category>		
	</div>
</template>

<script>
	import AddCategory from '../../.././pages/modals/add-new-category-layout.vue' 
	export default{
		data(){
			return{
			
				categories : [],
			
				is_adding : false
				
			}
		},

		components : {
			AddCategory
		},

		created(){
			this.getCategories()

		},

		

		methods : {
			async getCategories(){
				
				let response = await this.$requestservice.getRequest('/api/get-categories')

				this.categories = response.data

			},

			

			async removeCategory(id){

				let confirm = await this.$alertmessageservice.confirmationMessage()

				if(confirm){

					let response = await this.$requestservice.deleteRequest('/api/delete-category/'+id)

					if(response.status == 200){
						this.$alertmessageservice.successMessage('Category deleted successfully')
						this.getCategories()
					}
				}
			},

			editCategory(category){
				this.setBoolean()
				this.$store.dispatch('setCategory',category)
			},

			setBoolean(){
				if(this.is_adding){
					this.is_adding = false
				}else{
					this.is_adding = true
				}
			}
		}
	};
</script>

<style scoped>
	.el-input{
		width : 98% !important;
	}

	.element_select{
		width: 98% !important;
	}

	.el-select-dropdown {
	  position: static !important;
	}
</style>