@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-12 col-md-12 co-sm-12 col-xs-12">
			<h1 style="font-size: 30px; font-weight: bold; text-align: center">Editar Usuario <br> <i>{{$usuario->primer_nombre}} ({{ $usuario->codigo }}) </i> </h1>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif
		</div>
	</div>
	{!! Form::model($usuario, ['method' => 'PATCH', 'action'=>['Strategy\UsuarioDecano@update', $usuario->codigo]]) !!}
	{{ Form::token() }}
	<div class="row">
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="codigo">Código</label>
				<input type="text" name="codigo" class="form-control" value="{{$usuario->codigo}}" placeholder="Código..." disabled>
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="primer_nombre">Primer Nombre</label>
				<input type="text" name="primer_nombre" class="form-control" value="{{$usuario->primer_nombre}}" placeholder="Ej Pepito...">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="segundo_nombre">Segundo Nombre</label>
				<input type="text" name="segundo_nombre" class="form-control" value="{{$usuario->segundo_nombre}}" placeholder="Ej Antonio...">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="primer_apellido">Primer Apellido</label>
				<input type="text" name="primer_apellido" class="form-control" value="{{$usuario->primer_apellido}}" placeholder="Ej Peréz...">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="segundo_apellido">Segundo Apellido</label>
				<input type="text" name="segundo_apellido" class="form-control" value="{{$usuario->segundo_apellido}}" placeholder="Ej Rubio...">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="name">Username</label>
				<input type="text" name="name" class="form-control" value="{{$usuario->name}}" placeholder="Ej Peperez..">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="rol">Rol</label>
				<select name="rol" class="form-control">
					@foreach ($roles as $rol)
						@if($rol->codigo == $usuario->codigo)
							<option value="{{$rol->codigo}}" selected>{{$rol->rol}}</option>
						@else
							<option value="{{$rol->codigo}}">{{$rol->rol}}</option>
						@endif
					@endforeach
				</select>
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="escuela">Escuela</label>
				<select name="escuela" class="form-control">
					@foreach ($escuelas as $escuela)
						@if($escuela->codigo == $usuario->codigo_escuela)
							<option value="{{$escuela->codigo}}" selected>{{$escuela->nombre}}</option>
						@else
							<option value="{{$escuela->codigo}}">{{$escuela->nombre}}</option>
						@endif
					@endforeach
				</select>
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="email">Correo</label>
				<input type="text" name="email" class="form-control" value="{{$usuario->email}}" placeholder="Ej pepito@gmail.com">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" name="password" class="form-control" value="" placeholder="Ej Dejar vacío para no cambiar">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form-group">
			<button style="margin-left: 40%" class="btn btn-success" type="submit">Guardar Usuario</button>
			<button class="btn btn-danger" type="button" onclick="history.back()">Ir Atrás</button>
		</div>
	</div>
	{!! Form::close() !!}			
@endsection