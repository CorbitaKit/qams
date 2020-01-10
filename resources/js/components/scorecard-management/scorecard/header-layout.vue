<template>
	<div>
		<!-- <h5 class="card-text">Scorecard Name: <u>{{ scorecard.header.name }}</u></h5> -->
<!-- 		<h5 class="card-text">Scorecard Account Type: {{ scorecard.header.account_type_id }}</h5> -->
		<!-- <h5 class="card-text">Scorecard Account Type: <u>{{ header.account_type }}</u></h5> -->
		<!-- <p class="card-text">Agent Name: </p> -->
		<div id="scorecard_header">
			<div class="container">
				<div class="row">
					<div class="col-md-9" id="scorecard_header_text">
						<h5>FWS QA Monitoring Form |<i><u>{{ header.name }}</u></i></h5>
					</div>
					<div class="col-md-3" id="scorecard_header_logo">
						<img src="assets/img/logo.png" width="170" height="50" alt="QuillPro">
					</div>
				</div>
				
			</div>
		</div>
		<br>

	
		<div class="row">
			<div class="col-md-8">
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>Agent Name</th>
							<th>Supervisor</th>
							<th>Date of call</th>
							<th>Phone No</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col-md-4">
				<div class="row">
					<div class="col-md-6 scorecard_result">
						<p>Total Score</p>
					</div>
					<div class="col-md-6 scorecard_result left">
						<p>Remarks</p>
					</div>
					<div class="col-md-6 scorecard_result">
						<p>100%</p>
					</div>
					<div class="col-md-6 scorecard_result left">
						<p>Passed</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default{
		name : 'header-layout',

		computed : {
			scorecard(){
				return this.$store.state.scorecard
			}
		},

		data(){
			return{
				header : {

					account : '',
					account_type : '',
					name : '',
				}
			}
		},

		created(){
			this.getHeaderData()
		},

		methods : {
			getHeaderData(){

				this.getAccountName()
				this.getAccountTypeName()
				this.getScorecardName()
			},

			async getAccountName(){
				let response = await this.$requestservice.getRequest('/api/get-account/'+this.scorecard.header.account_id)

				if(response.status == 200){
					this.header.account = response.data.account_name

					
				}
			},

			async getAccountTypeName(){
				let response = await this.$requestservice.getRequest('/api/get-account-type/'+this.scorecard.header.account_type_id)

				if(response.status == 200){
					this.header.account_type = response.data.account_type_name
				}
			},

			async getScorecardName(){
				if(this.scorecard.header.id){
					this.header.name = this.scorecard.header.name
				}else{
					let response = await this.$requestservice.getRequest('/api/get-scorecard-name/'+this.scorecard.header.account_id+"/"+this.scorecard.header.account_type_id)

					this.header.name = response.data
				}
				
				// console.log(response.data)

			}
		}
	};
</script>

<style>
  #scorecard_header{
  	border-top: 2px solid black;
  	border-bottom: 2px solid black;
  	width: 100%;
  	height: 80px;
  	margin-right: 10px;

  }

  #scorecard_header_text{
  	margin-top:28px;
  }

  #scorecard_header_logo{
  	margin-top:14px;

  }

  .scorecard_result{
  	border:1px solid black;
  	padding:2px;
  	text-align: center;
  	margin-left: -8px;
  	height: 53px;
  }

  .scorecard_result p{
  	margin-top: 10px;
  }

  .left{
  	border-left: none;
  }

  .el-carousel__container{
  	height: 1000px !important;
  }
  
 
</style>