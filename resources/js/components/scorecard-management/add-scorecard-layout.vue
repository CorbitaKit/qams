<template>
	<div class="row">
		<div class="col-md-12" v-if="! is_view_scorecard">
			<div class="card">
				<div class="card-header">
					Scorecard Management <span v-if="scorecard.header.id">: </span>{{ scorecard.header.name }}
				</div>
				<div class="card-body scorcard-body">
					
					<h2>Scorecard Header</h2>
					<hr>
					<el-form :model="scorecard" :rules="rules" label-width="100px" ref="scorecard">
						
						<div class="row">
							<div class="col-md-5">
								<el-form-item label="Type">
									<el-select
										v-model="scorecard.header.account_type_id"
									    filterable
										:disabled ="scorecard.is_clone"
									    class="element_input_role"
									    default-first-option
									    placeholder="Choose scorecard account type">
									    <el-option
									      v-for="item in account_types"
									      :key="item.value"
									      :label="item.label"
									      :value="item.value">
									    </el-option>
									</el-select>
								</el-form-item>
							</div>
						<!-- </div>
						<div class="row"> -->
							<div class="col-md-6">
								<el-form-item label="Acount">
									<el-select
										v-model="scorecard.header.account_id"
									    filterable
									  	allow-create
									    class="element_input_role"
									    default-first-option
									    placeholder="Choose scorecard account">
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
					<!-- 	<div class="row">
							<div class="col-md-11">
								<el-form-item label="Name">
									<el-input
									  placeholder=""
									  v-model="scorecard.header.name"
									  :disabled="true">
									</el-input>
								</el-form-item>
							</div>
						</div> -->
						
						<div class="row">
							<div class="col-md-8">
								<h2>Scorecard Body</h2>
							</div>
							<div class="col-md-3 weight">
								<h4 class="weight-counter" v-if="weight < 100">Total weight: {{ weight }}</h4>
								<h4 class="weight-counter" style="color:green" v-else-if="weight == 100">Total weight: {{ weight }}</h4>
								<h4 class="weight-counter" style="color:red" v-else-if="weight > 100">Total weight: {{ weight }}</h4>
						
							</div>
						</div>
						<div v-for="(category,i) in scorecard.body.category">
							<hr>
							<div class="row">
								
								<div class="col-md-11 pr-0">
									<el-form-item label="Category">
										<el-select
										    v-model="category.id"
										    :disabled ="scorecard.is_clone"
										  	class="element_input_role"
										  	@change="getParameterByCategoryAndAccountType(i)"
										    placeholder="Select scorecard category">
										    <el-option
										      v-for="item in categories"
										      :key="item.value"
										      :label="item.label"
										      :value="item.value"
										      :disabled="item.disabled">
										    </el-option>
										</el-select>
									</el-form-item>
								</div>
								<div class="col-md-1" v-if="scorecard.body.category.length > 1">
									<a href="javascript:;" @click="removeCategory(i)"><h1 v-if="! scorecard.is_clone" style="color:red;">x</h1></a>
								</div>
							</div>
							<div class="row" v-for="(params,x) in scorecard.body.category[i].parameters">
								<div class="col-md-8">
									<el-form-item label="Parameter">
										<el-select
										    v-model="params.id"
										  	class="element_input_role"
										  	:disabled ="scorecard.is_clone"
										  	@change="setParameterName(i,x,params.id)"
										    placeholder="Select category parameter">
										    <el-option
										      v-for="item in parameters[i]"
										      :key="item.value"
										      :label="item.label"
										      :value="item.value"
										      :disabled="item.disabled">
										    </el-option>
										</el-select>
									</el-form-item>
								</div>
								<div class="col-md-3">
									<el-form-item label="Weight">
										<el-input placeholder="Input weight" :disabled ="scorecard.is_clone" @blur="calculateWeight" v-model="params.weight"></el-input>
									</el-form-item>
								</div>
								<div class="col-md-1" v-if="scorecard.body.category[i].parameters.length > 1">
									<a style="display: inline-block;" href="javascript:;" @click="removeParameter(i,x,params.id)">
										<h1 v-if="! scorecard.is_clone" style="color:red;">x</h1>
									</a>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
								<!-- 	<a href="javascript:;" class="pull-right" @click="addNewParameter(i)">
										Add parameter
									</a> -->
									
									<button type="button" v-if="! scorecard.is_clone"  @click="addNewParameter(i)" class="btn btn-params btn-danger btn-sm pull-right">
										Add parameter
									</button>
								</div>
							</div>
						</div>
						
						<hr>
						<div class="row">
							<div class="col-md-11 pr-0">
								
								<button type="button" class="btn btn-primary pull-right left-margin" @click.prevent="createScorecard">
									Save Scorecard
								</button>
								
								<button type="button" @click.prevent="checkIfcanView" class="btn btn-primary left-margin pull-right">
									View Scorecard
								</button>

								<button type="button" v-if="! scorecard.is_clone" @click="addNewCategory" class="btn btn-primary pull-right left-margin">
									Add Category
								</button>

								<button type="button" @click="cancelAction" class="btn btn-danger pull-right">
									Cancel
								</button>

							</div>
						</div>
					</el-form>
				</div>
			</div>
		</div>
		<display-layout v-else></display-layout>
	</div>
</template>

<script>
	import DisplayLayout from './score-card-layout.vue'
	export default{
		name : 'add-scorecard-layout',

		components : {
			DisplayLayout
		},

		data(){
			return {

				is_view_scorecard : false,
				categories : [],
				is_created : false,
				weight : 0,
				account_types : [],
				accounts : [],
				parameters : [],

				rules : {
					account_type_id: [
			            { required: true, message: 'This field is required', trigger: 'blur' },
			        ],

			        account_id: [
			            { required: true, message: 'This field is required', trigger: 'blur' },
			        ],

			        category_id: [
			            { required: true, message: 'This field is required', trigger: 'blur' },
			        ],
			        parameter_id: [
			            { required: true, message: 'This field is required', trigger: 'blur' },
			        ],
			        weight: [
			            { required: true, message: 'This field is required', trigger: 'blur' },
			        ],

				}

			}
		},
		created(){ 

			this.init()
			if(this.scorecard.header.id){
				this.getCategories()
				this.checkForCustomAccount(this.scorecard.header.account_id)
				for(var i in this.scorecard.body.category){
					this.getParameterByCategoryAndAccountType(i)
				}
				setTimeout(()=>{
					
					this.calculateWeight()
				},500)

			}else{
				this.$store.dispatch("clearScorecard")
			}
		},

		computed : {
			scorecard(){
				return this.$store.state.scorecard
			},

			
			
		},

		
		methods : {

			async init(){
				this.getAccountTypes()
				this.getAccounts()

			},

			async getAccountTypes(){
				let response = await this.$requestservice.getRequest('/api/get-account-types')

				if(response.status == 200){
					response.data.forEach(account_type=>{
						this.account_types.push({value : account_type.id, label : account_type.account_type_name})
					})
				}
			},

			async getAccounts(){
				let response = await this.$requestservice.getRequest('/api/get-accounts')

				if(response.status == 200){
					response.data.forEach(account=>{
						this.accounts.push({value : account.id, label : account.account_name})
					})
				}
			},


			async createScorecard(){

				// this.$refs.scorecard.validate((valid) => {
		  //         if (valid) {
		  //           alert('submit!');
		  //         } else {
		  //           console.log('error submit!!');
		  //           return false;
		  //         }
		  //       });


				let url = '/api/create-scorecard'
				this.calculateWeight()
				if(this.weight > 100 || this.weight < 100){
					this.$alertmessageservice.failMessage("Weight should be equal to 100 please add or remove parameter")
					return
				}

				if(this.scorecard.header.id && ! this.scorecard.is_clone){
					url = 'api/update-scorecard'
					
				}


				let response = await this.$requestservice.postRequest(url,this.scorecard)

				if(response.status == 201){

					this.$alertmessageservice.successMessage('Scorecard Created Successfully')

					this.is_created = true

					this.$router.push('/score-card-list')
					
				}else{
					this.$alertmessageservice.failMessage("Opps something went wrong")
				}

			},


			disabledAllselectedParameters(){
				for(var i in this.scorecard.body.category){

					for(var x in this.scorecard.body.category[i].parameters){

						this.disabledselectedParameter(i,this.scorecard.body.category[i].parameters[x].id)
					}
				}
			},


		
			setBoolean(){


				if(this.is_view_scorecard){
					this.is_view_scorecard = false
				}else{
					this.is_view_scorecard = true
				}
			},


			async getCategories(){

				let response = await this.$requestservice.getRequest('/api/get-categories')

				response.data.forEach(category=>{
					this.categories.push({value : category.id, label : category.category_name, disabled : false})
				})
			},


			
			
			async getParameterByCategoryAndAccountType(index){
				
				// this.enableCategory()

				let id = this.scorecard.body.category[index].id
				
				this.setCategoriesBoolean(id)

				let response = await this.$requestservice.getRequest('/api/get-parameter-by-category-and-account-type/'+id+'/'+this.scorecard.header.account_type_id)
				let params = []
				
				response.data.forEach(parameter=>{
					params.push({value : parameter.id, label : parameter.parameter_name, disabled : false})
				})



				this.parameters.push(params)

				this.setCategoryName(index,id)

				this.disabledAllselectedParameters()
			},


			enableCategory(){
				for(var i in this.categories){
					if(this.categories[i].disabled){
						this.categories[i].disabled = false
					}
				}
			},

			async checkForCustomAccount(account_id){
				let response = await this.$requestservice.getRequest('/api/get-custom-account/'+account_id)

				if(response.data){
		
					this.accounts.push({value : response.data.id, label : response.data.account_name})
				}
			},

			setCategoriesBoolean(id){
				for(var i in this.categories){
					if(this.categories[i].value == id){
						if(this.categories[i].disabled){
							this.categories[i].disabled = false
						}else{
							this.categories[i].disabled = true
						}
						break
					}
				}
			},

			disabledselectedParameter(category_index,params_id){

		
			
			
				for(var i in this.parameters[category_index]){
					
					if(this.parameters[category_index][i].value == params_id){
					
						this.parameters[category_index][i].disabled = true
					}
				}
			},

			enabledRemovedParameter(category_index,params_id){
				for(var i in this.parameters[category_index]){
					
					if(this.parameters[category_index][i].value == params_id){
					
						this.parameters[category_index][i].disabled = false
					}
				}
			},

			setParameterName(category_index,params_index,params_id){

	
				this.disabledselectedParameter(category_index,params_id)



				let id = this.scorecard.body.category[category_index].parameters[params_index].id

				let parameter_name = ''

				for(let i in this.parameters[category_index]){
					if(this.parameters[category_index][i].value == id){
						parameter_name = this.parameters[category_index][i].label
						break
					}
				}

				let params = [category_index,params_index,parameter_name]

				this.$store.dispatch("insertParameterName",params)

			},

			setCategoryName(index,id){
				let category_name = ''

				for(let i in this.categories){
					if(this.categories[i].value == id){
						category_name = this.categories[i].label
						break
					}
				}

				let params = [category_name,index]
				this.$store.dispatch("insertCategoryName",params)
			},


			calculateWeight(){
				this.weight = 0
				for(var i in this.scorecard.body.category){
					for(var x in this.scorecard.body.category[i].parameters){
						if(this.scorecard.body.category[i].parameters[x].weight){
							this.weight += parseInt(this.scorecard.body.category[i].parameters[x].weight)
						}
					}
				}
			},



			addNewParameter(index){
				
				this.$store.dispatch("addNewParameter",index)
			},



			removeParameter(cat_index,params_index,params_id){

				this.enabledRemovedParameter(cat_index,params_id)

				let params = [cat_index,params_index]
				this.$store.dispatch("removeParameter",params)
				this.calculateWeight()
				

			},

			addNewCategory(){
				
				this.$store.dispatch("addNewCategory")
			},

			removeCategory(index){
				
				if(this.scorecard.body.category[index].parameters.length > 1){
					this.$alertmessageservice.warningMessage("Please remove all parameters first before removing the category")
					return
				}

				this.calculateWeight()
				this.setCategoriesBoolean(this.scorecard.body.category[index].id)
				this.$store.dispatch("removeCategory",index)
			},

			cancelAction(){
				
				
				this.$router.push('/score-card-list')
				
			},

			checkIfcanView(){
				if(this.scorecard.body.category[0].id == null || this.scorecard.body.category[0].parameters[0].id == null || this.scorecard.body.category[0].parameters[0].weight == null){
					this.$alertmessageservice.failMessage("Scorecard cannot be view")
				}else{
					this.setBoolean()
				}
			}

			


		},

		watch : {
			'scorecard.header.account_type_id'(data){
				this.categories = []
				this.getCategories()
			},
		},

		beforeRouteLeave(to,from,next){
			
			if(! this.is_created){
				this.$confirm('You have unsave data are you sure you want to leave?', 'Warning', {
		          confirmButtonText: 'Yes',
		          cancelButtonText: 'Cancel',
		          type: 'warning'
		        })
		        .then(() => {
		        	this.$store.dispatch("clearScorecard")
		        	next()
		        })
			}else{
				this.$store.dispatch("clearScorecard")
		
				next()
			}
		}
	};
</script>


<style>
	.el-input__inner{
		height: 40px !important;
		font-weight: bolder !important;

	}

	.element_input_role{
		width: 98% !important;


	}

	.left-margin{
		margin-left : 5px;
		color:white;
	}

	.btn-params{
		margin-right:77px;
	}

	.weight{
		text-align: right
	}

	.scorcard-body input {
		font-size: 13px;
	}
	
	.scorcard-body .weight-counter {
	    font-weight: bold !important;
	    padding-top: 9px;
	}


</style>