<div class="container">
	@if(Session::has('flash_primary'))    
	<div class="alert alert-primary alert-dismissible fade show" role="alert">
		<strong>Primary</strong> {!! session('flash_primary') !!}
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> 
	</div>
	@endif

	@if(Session::has('flash_secondary'))
	<div class="alert alert-secondary alert-dismissible fade show" role="alert">
		<strong>Secondary</strong> {!! session('flash_secondary') !!}
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> 
	</div>
	@endif

	@if(Session::has('flash_success'))           
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		<strong>Success</strong> {!! session('flash_success') !!}
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> 
	</div>
	@endif

	@if(Session::has('flash_danger'))         
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
		<strong>Danger</strong> {!! session('flash_danger') !!}
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> 
	</div>
	@endif

	@if(Session::has('flash_warning'))           
	<div class="alert alert-warning alert-dismissible fade show" role="alert">
		<strong>Warning</strong> {!! session('flash_warning') !!}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	@endif

	@if(Session::has('flash_info'))       
	<div class="alert alert-info alert-dismissible fade show" role="alert">
		<strong>Info</strong> {!! session('flash_info') !!}
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> 
	</div>
	@endif

	@if(Session::has('flash_light'))           
	<div class="alert alert-light alert-dismissible fade show" role="alert">
		<strong>Light</strong> {!! session('flash_light') !!}
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> 
	</div>
	@endif

	@if(Session::has('flash_dark'))            
	<div class="alert alert-dark alert-dismissible fade show" role="alert">
		<strong>Dark</strong> {!! session('flash_dark') !!}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	@endif

</div>