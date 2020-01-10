<!DOCTYPE html>
<html>
<head>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>QA Monitoring System</title>

	@include('assets.styles')
	<script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>


</head>

<body>
<div class="container-fluid" id="app" v-cloak>
	<div class="row">
		@include('importants.sidebar')
		<div class="right-column">
			@include('importants.navbar')
			<main class="main-content p-5" role="main">
				
				@yield('content')
				 
			</main>
		</div>
	</div>
</div>
@include('assets.scripts')
</body>
</html>