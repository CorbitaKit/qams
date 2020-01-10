<template>
	<div>
		<div class="row">
			<div class="col-md-12 mb-5">
				<div class="card">
					<div class="card-body">
						<header-layout></header-layout>
						<hr>
						<body-layout></body-layout>
						<div class="row">
							<div class="col-md-12">
							<div v-if="! scorecard.header.id">
								<button  type="button" @click="backToCreate" class="btn btn-danger pull-right">Back to create scorecard
								</button>
							</div>
							<div v-else>
								<button type="button" @click="backToListView" class="btn btn-primary pull-right">Back to Scorecard List
								</button>

								<button v-if="scorecard.header.status == 0" type="button" @click="setScorecardStatus(1)" class="btn btn-success pull-right right">Approve Scorecard
								</button>

								<button v-if="scorecard.header.status == 0" type="button" @click="setScorecardStatus(2)" class="btn btn-danger pull-right right">Decline
								</button>
							</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>


<script>
	import HeaderLayout from './scorecard/header-layout.vue'
	import BodyLayout from './scorecard/body-layout.vue'

	export default{
		name : 'display-layout',

		components : {
			HeaderLayout,
			BodyLayout
		},

		computed : {
			scorecard(){
				return this.$store.state.scorecard
			},



			
			
		},

		methods : {
			backToCreate(){
				this.$parent.setBoolean()
			},

			backToListView(){
				this.$parent.setBoolean()
			},

			async setScorecardStatus(status){


				let message = "Scorecard Approved"

				if(status == 2) message = "Scorecard declined"

				let response = await this.$requestservice.getRequest('/api/set-scorecard-status/'+this.scorecard.header.id+'/'+status)



				if(response.status == 200){
					this.$alertmessageservice.successMessage(message)
					this.$parent.getScorecards()
					this.$parent.setBoolean()
				}else{
					this.$alertmessageservice.failMessage("You are not allowed to perform this action")
				}
			},

		}
	};
</script>

<style scoped>
	.right{
		margin-right: 5px;
	}
</style>