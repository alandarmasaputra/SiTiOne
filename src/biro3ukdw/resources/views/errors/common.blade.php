@if(isset($errors) || session('errorMessage') || session('successMessage'))
	<div class="notification-bar">
	@if(session('errorMessage'))
	<div>
		<span class="label">Alert</span> {{ session('errorMessage') }}
	</div>
	@endif
	@if(session('successMessage'))
	<div>
		<span class="label">Success</span> {{ session('successMessage') }}
	</div>    
	@endif
	@if (isset($errors) && count($errors)>0)
		@foreach ($errors->all() as $error)
		<div>
			<span class="label">Alert</span> {{ $error }}
		</div>
		@endforeach
	@endif

	</div>
@endif