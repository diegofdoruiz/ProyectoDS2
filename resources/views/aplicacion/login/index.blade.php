@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div style = "margin-top: 5%" class="col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div style = "text-align: center"  class="panel-heading">
					<h1 class="panel-title">Acceso a la aplicación</h1>
				</div>
				<div class="panel-body">
					<form method="POST" action="{{ route('login') }}">
						{{ csrf_field() }}
						<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
							<label for="email">Email</label>
							<input class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="Ingerese email">
							{!! $errors->first('email', '<span class="help-block">:message</span>') !!}
						</div>
						<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
							<label for="password">Contraseña</label>
							<input class="form-control" type="password" name="password" placeholder="Ingerese Contraseña">
							{!! $errors->first('password', '<span class="help-block">:message</span>') !!}
						</div>
						<button class="btn btn-danger btn-block">Acceder</button>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection