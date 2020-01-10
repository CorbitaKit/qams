<nav id="sidebar" class="px-0 bg-dark bg-gradient sidebar">
	<ul class="nav nav-pills flex-column">
		<li class="logo-nav-item">
			<a class="navbar-brand" href="#">
				<img src="assets/img/logo.png" width="170" height="50" alt="flatworld">
			</a>
		</li>

		<li>
			<h6 class="nav-header">General</h6>
		</li>
		<li class="nav-item active">
			<router-link to="/dashboard" :class="[currentPage.includes('dashboard') ? 'active' : '', 'nav-link']">
				<i class="batch-icon batch-icon-browser-alt"></i>
				Dashboard <span class="sr-only">(current)</span>
			</a>
		</li>
		@if(Auth()->user()->employee->role->name == 'Manager')
		<li class="nav-item">
			<a class="nav-link nav-parent" href="#">
				<i class="batch-icon batch-icon-users"></i>
				User management
			</a>
			<ul class="nav nav-pills flex-column">
				<li class="nav-item">
					<router-link to="/add-new-user" :class="[currentPage.includes('add-new-user') ? 'active' : '', 'nav-link']">
						Add new user
					</router-link>
				</li>
				<li class="nav-item">
					<router-link to="/member-management" :class="[currentPage.includes('member-management') ? 'active' : '', 'nav-link']">
						User list
					</router-link>
				</li>
				
			</ul>
		</li>
		@endif

		<li class="nav-item">
			<a class="nav-link nav-parent" href="#">
				<i class="batch-icon batch-icon-paragraph-alt-center"></i>
				Scorecard
			</a>
			<ul class="nav nav-pills flex-column">
				<li class="nav-item">
					<router-link to="/score-card-list" :class="[currentPage.includes('score-card-list') ? 'active' : '', 'nav-link']">
						Scorecard List
					</router-link>
				</li>
				<li class="nav-item">
					<router-link to="/scorecard" :class="[currentPage.includes('scorecard') ? 'active' : '', 'nav-link']">
						Create Scorecard
					</router-link>
				</li>
			</ul>
		</li>
		@if(Auth()->user()->employee->role->name == 'Manager')
		<li class="nav-item">
			<a class="nav-link nav-parent" href="#">
				<i class="batch-icon batch-icon-settings-alt-2"></i>
				Utilities
			</a>
			<ul class="nav nav-pills flex-column">
				<li class="nav-item">
					<router-link to="/category-list" :class="[currentPage.includes('category-list') ? 'active' : '', 'nav-link']">
						Categories
					</router-link>
				</li>
				<li class="nav-item">
					<router-link to="/parameter-list" :class="[currentPage.includes('parameter-list') ? 'active' : '', 'nav-link']">
						Parameters
					</router-link>
				</li>
				<li class="nav-item">
					<router-link to="/account-type-layout" :class="[currentPage.includes('account-type-layout') ? 'active' : '', 'nav-link']">
						Account Types
					</router-link>
				</li>
				<li class="nav-item">
					<router-link to="/ztp-layout" :class="[currentPage.includes('ztp-layout') ? 'active' : '', 'nav-link']">
						ZTPs
					</router-link>
				</li>
			</ul>
		</li>
		@endif
	</ul>
</nav>