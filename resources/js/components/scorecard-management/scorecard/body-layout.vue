<template>
	<div>
		<div class="table-responsive">
			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>CATEGORY</th>
						<th>PARAMETERS</th>
						<th>DESCRIPTION</th>
						<th>WEIGHT</th>
						<th>REMARKS</th>
						<th>COACHING REMARKS</th>
					</tr>
				</thead>
				<tbody v-for="(category,i) in scorecard.body.category">
					<tr v-for="(params,x) in scorecard.body.category[i].parameters">
						<td id="category" :rowspan="scorecard.body.category[i].parameters.length" v-if="x == 0">
							<h6>{{ scorecard.body.category[i].category_name }}</h6>
						</td>
						<td>
							<p>
								{{ scorecard.body.category[i].parameters[x].parameter_name }}
							</p>

						</td>
						<td>
							<p>
								{{ scorecard.body.category[i].parameters[x].parameter_name }}
							</p>
						</td>
						<td>
							<p>
								{{ scorecard.body.category[i].parameters[x].weight }}%
							</p>
						</td>
						<td>
							<p>
								Yes
							</p>
						</td>
						<td>
							<p>
								
							</p>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</template>

<script>
	export default{
		name : 'body-layout',
		computed : {
			scorecard(){
				return this.$store.state.scorecard
			}
		},

		destroyed() {
			this.$store.state.scorecard.header.id = null;
		},

		data(){
			return {
				cat_name : ''
			}
		},

		methods : {
		
				
		}

		// created(){
		// 	for(var i in this.scorecard.body.category){
		// 		console.log(this.scorecard.body.category[i].parameters.length)
		// 	}
		// }
	};
</script>

<style>
	#category h6{
		position: absolute;
		
		transform-origin: 0 0;
		transform: rotate(90deg);
		margin-left: 50px;
		
	}

	#category{
		height: 202px;
	}
</style>