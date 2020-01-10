<template>
	<div>
		<div class="modal fade add-category" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Add new category</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<el-form ref="form" label-width="100px">
							<div class="row">
								<div class="col-md-12">
									<el-form-item label="Name">
										<el-input placeholder="Please input category name" v-model="category.category_name"></el-input>
									</el-form-item>
								</div>
								
							</div>
						</el-form>
					</div>
					<div class="modal-footer">
						<button type="button" @click.prevent="cancelAction" class="btn btn-secondary"  data-dismiss="modal">Close</button>
						<button type="button" @click.prevent="addCategory" class="btn btn-primary" data-dismiss="modal">{{ action_name}} category</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		name : 'add-category',

		computed : {
			category(){
				return this.$store.state.category
			}
		},

		data(){
			return {
				action_name : ''
			}
		},

		created(){
			if(this.category.id){
				this.action_name = 'Update'
			}else{
				this.action_name = 'Add'
			}
		},

		methods : {
			async addCategory(){
				if(this.category.id){
					this.updateCategory()
					return
				}

				let response = await this.$requestservice.postRequest('/api/submit-category',this.setParams())

				if(response.status == 201){
					this.$alertmessageservice.successMessage('Category Created Successfully')
					this.successAction()
				}
			},

			async updateCategory(){
				let response = await this.$requestservice.postRequest('/api/update-category/'+this.category.id,this.setParams())

				if(response.status == 200){
					this.$alertmessageservice.successMessage('Category Updated Successfully')
					this.successAction()
				}
			},

			setParams(){
				let data = new FormData()

				data.append('category_name',this.category.category_name)

				return data
			},

			successAction(){
				this.$parent.getCategories()
				this.cancelAction()
			},

			cancelAction(){
				this.$store.dispatch("setCategory",{category_name : '', id : null})
				this.$parent.setBoolean()
			}
		}
	}; 
</script>