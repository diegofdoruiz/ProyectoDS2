@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-12 col-md-6 co-sm-6 col-xs-12">
			<h3>Nuevo Usuario</h3>
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
	{!! Form::open(array('url'=>'usuario', 'method'=>'POST', 'autocomplete'=>'off')) !!}
	{{ Form::token() }}
	<div class="row">
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="codigo">Código</label>
				<input type="text" name="codigo" class="form-control" value="{{old('codigo')}}" placeholder="Código...">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="cedula">Cédula</label>
				<input type="text" name="cedula" class="form-control" value="{{old('cedula')}}" placeholder="Cédula...">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="primer_nombre">Primer Nombre</label>
				<input type="text" name="primer_nombre" class="form-control" value="{{old('primer_nombre')}}" placeholder="Ej Pepito...">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="segundo_nombre">Segundo Nombre</label>
				<input type="text" name="segundo_nombre" class="form-control" value="{{old('segundo_nombre')}}" placeholder="Ej Antonio...">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="primer_apellido">Primer Apellido</label>
				<input type="text" name="primer_apellido" class="form-control" value="{{old('primer_apellido')}}" placeholder="Ej Peréz...">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="segundo_apellido">Segundo Apellido</label>
				<input type="text" name="segundo_apellido" class="form-control" value="{{old('segundo_apellido')}}" placeholder="Ej Rubio...">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="name">Username</label>
				<input type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="Ej Peperez..">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="rol">Rol</label>
				<select name="rol" class="form-control">
					@foreach ($roles as $rol)
						<option value="{{$rol->codigo}}" {{ $rol->codigo == old('rol') ? 'selected' : '' }}>
							{{$rol->rol}}
						</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="escuela">Escuela</label>
				<select name="escuela" class="form-control">
					@foreach ($escuelas as $escuela)
						<option value="{{$escuela->codigo}}" {{ $escuela->codigo == old('escuela') ? 'selected' : '' }}>
							{{$escuela->nombre}}
						</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="email">Email</label>
				<input type="text" name="email" class="form-control" value="{{old('email')}}" placeholder="Ej pepito@gmail.com">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" name="password" class="form-control" value="{{old('password')}}" placeholder="Ej **********">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">cancelar</button>
			</div>
		</div>
	</div>
	{!! Form::close() !!}			
@endsection