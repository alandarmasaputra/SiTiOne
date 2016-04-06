@extends('layout.app')

@section('body_content')
<div class="container-fluid login-form">
	<form role="form" method="POST" action="{{ url('/login') }}">
		{!! csrf_field() !!}

		<div>
			<label>Username</label>

			<div>
				<input type="text" name="username" value="{{ old('username') }}">
			</div>
		</div>

		<div>
			<label>Password</label>

			<div>
				<input type="password" name="password">
			</div>
		</div>

		<div>
			<div>
				<button type="submit">
					Login
				</button>
			</div>
		</div>
	</form>
               
</div>
@endsection
