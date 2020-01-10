<template>
	
	<!-- <el-carousel indicator-position="outside" :autoplay="false">
	    <el-carousel-item v-for="item in 4" :key="item">
	      	<div class="col-md-12 mb-5">
				<div class="card">
					<div class="card-body">
						
						<header-layout></header-layout>	
						<hr>
						<body-layout></body-layout>
					
					</div>
				</div>
			</div>
	    </el-carousel-item>
	</el-carousel> -->

	<div>
		<div class="row" v-if="! isViewed">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div class="row">
							<div class="col-md-4">
								Scorecard Management
							</div>
							<div class="col-md-8">
								<div>
									<router-link to="/scorecard">
										<button type="button" ref="modal_div" class="btn btn-primary pull-right">
											<i class="batch-icon batch-icon-plus"></i> Create Scorecard
										</button>
									</router-link>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body">
						<!-- <div v-if="categories.length == 0">
							<h1 class="text-center">---No Data Yet---</h1>
						</div> -->
						<div>
							<table class="table table-bordered table-hover">
								<thead>
									<tr>
										<th class="text-center">Scorecard Name</th>
										<th style="width: 80px;" class="text-center">Version</th>
										<th class="text-center">Account Type</th>
										<th class="text-center">Account</th>
										<th style="width: 90px;" class="text-center">Status</th>
										<th class="text-center">Action</th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="scorecard in scorecards">
										<td class="text-center">
											{{ scorecard.scorecard_name}} <br>By: <b>{{ scorecard.author.name}}</b>
										</td>
										<td class="text-center">
											{{ scorecard.Version}}
										</td>
										<td class="text-center">
											{{ scorecard.account_type.account_type_name}}
										</td>
										<td class="text-center">
											{{ scorecard.account.account_name}}
										</td>
										<td class="text-center">
											<div v-if="scorecard.status == 0">
												<span class="badge badge-warning">Pending</span>
											</div>
											<div v-else-if="scorecard.status == 2">
												<span class="badge badge-danger">Declined</span>
											</div>
											<div v-else>
												<span class="badge badge-success">Approved</span>
											</div>
										</td>
										<td class="text-center">
											<el-tooltip class="item" effect="dark" content="Edit Scorecard" placement="top-start">
												<a class="btn btn-success btn-sm" @click="editScorecard(scorecard.id)">
													<i class="batch-icon batch-icon-quill"></i>
												</a>
											</el-tooltip>
											<el-tooltip class="item" effect="dark" content="View Scorecard Layout" placement="top-start">
												<a class="btn btn-primary btn-sm" @click="viewScorecard(scorecard.id)">
													<i class="batch-icon batch-icon-eye"></i>
												</a>
											</el-tooltip>
											
											<el-tooltip class="item" effect="dark" content="Clone Scorecard" placement="top-start">
												<a class="btn btn-default btn-sm" @click="cloneScorecard(scorecard.id)">
													<i class="batch-icon batch-icon-browser-windows"></i>
												</a>
											</el-tooltip>

											<el-tooltip class="item" effect="dark" content="Delete Scorecard" placement="top-start">
												<a class="btn btn-danger btn-sm" @click="removeScorecard(scorecard.id)">
													<i class="batch-icon batch-icon-bin"></i>
												</a>
											</el-tooltip>
											
										</td>
									</tr>
								</tbody>
							</table>
						</div>

						
					</div>
				</div>
			</div>
		</div>	
		<display-layout v-else></display-layout>
	</div>
</template>


<script>
	import DisplayLayout from './score-card-layout.vue'

	export default{
		name : 'score-card-layout',

		components : {
			DisplayLayout
		},

		data(){
			return{
				scorecards : [],

				bodies : [],

				isViewed : false
			
			}
		},

		created(){
			this.getScorecards()
		},

		computed : {
			scorecard(){
				return this.$store.state.scorecard
			},

			
			
		},

		methods : {
			async getScorecards(){
				let response = await this.$requestservice.getRequest('/api/get-scorecards')

				if(response.status == 200){
					this.scorecards = response.data
				}
			},

			editScorecard(id){
				this.createScorecard(id)

				setTimeout(()=>{
					this.$router.push('/scorecard')
				},800)
			},

			cloneScorecard(id){
				this.createScorecard(id)

				

				setTimeout(()=>{
					this.scorecard.is_clone = true
					this.$router.push('/scorecard')
				},800)

			},

			viewScorecard(id){
				this.createScorecard(id)

				setTimeout(()=>{
					this.isViewed = true
				},800)
			},

			async createScorecard(id){
				this.$store.commit('clearScorecard')
				this.$store.commit("removeCategory",0)
				let response = await this.$requestservice.getRequest('/api/get-scorecard/'+id)

				if(response.status == 200){

					this.$store.commit("setScorecardHeader",response.data)

					this.createScorecardBody(id)
					
				}
			},

			async createScorecardBody(id){
				let response = await this.$requestservice.getRequest('/api/get-scorecard-body/'+id)

				if(response.status == 200){
					let prev_id = 0
					let ctr = 0
					for (var i in response.data){
						if(prev_id != response.data[i].category_id){
							this.generateCategory(response.data[i],ctr,id)
							prev_id = response.data[i].category_id
							ctr +=1
						}

					}
				}

		
			},

			async generateCategory(category,cat_index,id){

				let cat_name = category.category[0].category_name
				let params_category =  {
					id : category.category_id,
					category_name : cat_name,
					parameters : []
				}

				
				this.$store.commit("generateScorecardCategory",params_category)


				let response = await this.$requestservice.getRequest('/api/get-scorecard-body-parameters/'+category.category_id+'/'+id)

				if(response.status == 200){
					for (var i in response.data){
						this.generateParameter(cat_index,response.data[i])
					
					}
				}
			},

			async removeScorecard(id){
				let confirm = await this.$alertmessageservice.confirmationMessage()

				if(confirm){

					let response = await this.$requestservice.deleteRequest('/api/delete-scorecard/'+id)

					if(response.status == 200){
						this.$alertmessageservice.successMessage('scorecard deleted successfully')
						this.getScorecards()
					}else{
						this.$alertmessageservice.failMessage("You are not allowed to perform this action")
					}
				}
			},

			generateParameter(cat_index,parameter){

				

				let params = [cat_index, {
					id : parameter.parameter_id,
					parameter_name : parameter.parameter[0].parameter_name,
					weight : parameter.weight
				}]

				this.$store.commit("generateScorecardParameter",params)

				// this.$router.push('/score-card-view')
				
			},

			setBoolean(){
				if(this.isViewed){
					this.isViewed = false
					return
				}

				this.isViewed = true
			}
		},

		

	
	};
</script>
<style type="text/css">
	table td.text-center {
	    color: #72848c;
	    font-weight: 400;
	}
</style>

