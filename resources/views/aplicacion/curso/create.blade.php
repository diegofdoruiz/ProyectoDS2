@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-12 col-md-6 co-sm-6 col-xs-12">
			<h3>Nuevo Curso</h3>
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
	{!! Form::open(array('url'=>'curso', 'method'=>'POST', 'onsubmit' => 'return validar()')) !!}
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
				<label for="creditos">Créditos</label>
				<input type="text" id="creditos" name="creditos" class="form-control" value = "{{ old('creditos') > 0 ?  old('creditos') : 0}}" placeholder="Ej 160...">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="magistrales">Horas Magistrales</label>
				<input type="text" id="magistrales" name="magistrales" class="form-control" value="{{ old('magistrales') > 0 ?  old('magistrales') : 0}}" placeholder="Ej 4...">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="independientes">Horas Estudio Independiente</label>
				<input type="text" id="independientes" name="independientes" class="form-control" value="{{ old('independientes') > 0 ?  old('independientes') : 0}}" placeholder="Ej 12...">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="validacion">Validable</label>
				<select name="validacion" class="form-control">
					<option value="">Seleccione</option>
					<option value="SI" {{ old('validacion') == "SI" ? 'selected' : '' }}>SI</option>
					<option value="NO" {{ old('validacion') == "NO" ? 'selected' : '' }}>NO</option>
				</select>
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="habilitacion">Habilitable</label>
				<select name="habilitacion" class="form-control">
					<option value="">Seleccione</option>
					<option value="SI" {{ old('habilitacion') == "SI" ? 'selected' : '' }}>SI</option>
					<option value="NO" {{ old('habilitacion') == "NO" ? 'selected' : '' }}>NO</option>
				</select>
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="semestre">Ubicación (Semestre)</label>
				<input type="text" name="semestre" class="form-control" value="{{old('semestre')}}" placeholder="Ej 7...">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="tipo">Tipo de curso</label>
				<select name="tipo" class="form-control" >
					<option value="">Seleccione</option>
					<option value="Asignatura básica" {{ old('tipo') == "Asignatura básica" ? 'selected' : '' }}>
						Asignatura básica
					</option>
					<option value="Asignatura profesional" {{ old('tipo') == "Asignatura profesional" ? 'selected' : '' }}>
						Asignatura profesional
					</option>
					<option value="Electiva complementaria" {{ old('tipo') == "Electiva complementaria" ? 'selected' : '' }}>
						Electiva complementaria
					</option>
					<option value="Electiva profesional" {{ old('tipo') == "Electiva profesional" ? 'selected' : '' }}>
						Electiva profesional
					</option>
				</select>
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="programa">Programa al que pertenece</label>
				<select name="programa" class="form-control">
					<option value="">Seleccione</option>
					@foreach ($programas as $programa)
						@if (old('programa') == $programa->codigo)
						      <option value="{{ $programa->codigo }}" selected>{{ $programa->nombre }}</option>
						@else
						      <option value="{{ $programa->codigo }}">{{ $programa->nombre }}</option>
						@endif
					@endforeach
				</select>
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