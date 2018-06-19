@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-12 col-md-6 co-sm-6 col-xs-12">
			<h1 style="font-size: 30px; font-weight: bold; text-align: center">Editar Programa <br> <i>{{$programa->nombre}} ({{ $programa->codigo }})</i></h1>
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
	{!! Form::model($programa, ['method' => 'PATCH', 'action'=>['ProgramaController@update', $programa->codigo]]) !!}
	{{ Form::token() }}
	<div class="row">
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="codigo">Código</label>
				<input type="text" name="codigo" class="form-control" value="{{$programa->codigo}}" placeholder="Código..." disabled>
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" class="form-control" value="{{$programa->nombre}}" placeholder="Nombre...">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="semestres">Semestres</label>
				<input type="text" name="semestres" class="form-control" value="{{$programa->num_semestres}}" placeholder="Ej 10...">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="creditos">Créditos</label>
				<input type="text" name="creditos" class="form-control" value="{{$programa->creditos}}" placeholder="Ej 170...">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="escuela">Escuela</label> 
				<select name="escuela" class="form-control" readonly>
					<option value="{{$escuela->codigo}}" selected >{{$escuela->nombre}}</option>
				</select>
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="director">Creador del plan</label>
				<select name="director" class="form-control" readonly>
					<option value="{{$usuario->codigo}}" selected >{{$usuario->primer_nombre}} {{$usuario->primer_apellido}}</option>
				</select>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form-group">
			<button style="margin-left: 40%" class="btn btn-success" type="submit">Guardar Programa</button>
			<button class="btn btn-danger" type="button" onclick="history.back()">Ir Atrás</button>
		</div>
	</div>
	{!! Form::close() !!}			
@endsection