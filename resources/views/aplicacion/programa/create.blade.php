@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-12 col-md-6 co-sm-6 col-xs-12">
			<h3>Nuevo Programa</h3>
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
	{!! Form::open(array('url'=>'programa', 'method'=>'POST', 'autocomplete'=>'off')) !!}
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
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" class="form-control" value="{{old('nombre')}}" placeholder="Nombre...">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="semestre">Semestre</label>
				<input type="text" name="semestres" class="form-control" value="{{old('semestres')}}" placeholder="Ej 10...">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="creditos">Créditos</label>
				<input type="text" name="creditos" class="form-control" value="{{old('creditos')}}" placeholder="Ej 160...">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="escuela">Escuela</label>
				<select name="escuela" class="form-control">
					<option value="">Seleccione</option>
					@foreach ($escuelas as $escuela)
						<option value="{{$escuela->codigo}}">{{$escuela->nombre}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="director">Director de plan</label>
				<select name="director" class="form-control">
					<option value="">Seleccione</option>
					@foreach ($directores as $director)
						<option value="{{$director->codigo}}">{{$director->primer_nombre}} {{$director->primer_apellido}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="estado">Estado</label>
				<input type="text" name="estado" class="form-control" value="{{old('estado')}}" placeholder="Ej 1...">
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