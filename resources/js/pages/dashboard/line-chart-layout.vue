<template>
	<div class="row">
		<div class="col-md-12 col-lg-12 col-xl-12 mb-12">
			<div class="card">
				<div class="card-header">
					Score Overview
					<div class="header-btn-block">
						<span class="data-range dropdown">
							<a href="#" class="btn btn-primary dropdown-toggle" id="navbar-dropdown-sales-overview-header-button" data-toggle="dropdown" data-flip="false" aria-haspopup="true" aria-expanded="false">
								<i class="batch-icon batch-icon-calendar"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-dropdown-sales-overview-header-button">
								<a class="dropdown-item" href="today.html">Today</a>
								<a class="dropdown-item" href="week.html">This Week</a>
								<a class="dropdown-item" href="month.html">This Month</a>
								<a class="dropdown-item active" href="year.html">This Year</a>
							</div>
						</span>
					</div>
				</div>
				<div class="card-body">
					<div>
						<apexchart height="300" type="line" :options="line.options" :series="line.series"></apexchart>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>


<script>
	export default{
		name : 'line-chart-layout',
		data(){
			return {
				line : {
					options: {
				    	chart: {
				          id: 'vuechart'
				        },
				        xaxis: {
				          categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998]
				        }
				    },
				    series: [{
				    	name: 'series-1',
				        data: [30, 40, 45, 50, 49, 60, 70, 91]
				    }]
				},
				donut : {
					options: {},
      				series: [44, 55, 41, 17, 15]
				}
			}
		}
	};
</script>