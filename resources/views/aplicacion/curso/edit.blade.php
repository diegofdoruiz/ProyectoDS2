@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-12 col-md-6 co-sm-6 col-xs-12">
			<h3>Editar Curso: {{ $curso->codigo }} {{$curso->nombre}}</h3>
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
	{!! Form::model($curso, ['method' => 'PATCH', 'action'=>['CursoController@update', $curso->codigo]]) !!}
	{{ Form::token() }}
	<div class="row">
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="codigo">Código</label>
				<input type="text" name="codigo" class="form-control" value="{{$curso->codigo}}" placeholder="Código..." disabled>
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" class="form-control" value="{{$curso->nombre}}" placeholder="Nombre...">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="creditos">Créditos</label>
				<input type="text" name="creditos" class="form-control" value="{{$curso->creditos}}" placeholder="Ej 4...">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="magistrales">Horas magistrales</label>
				<input type="text" name="magistrales" class="form-control" value="{{$curso->horas_magistrales}}" placeholder="Ej 4...">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="independientes">Horas estudio independiente</label>
				<input type="text" name="independientes" class="form-control" value="{{$curso->horas_independientes}}" placeholder="Ej 12...">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="validacion">Validable</label>
				<select name="validacion" class="form-control">
					<option value="">Seleccione</option>
					<option value="SI" {{ $curso->validacion == "SI" ? 'selected' : '' }}>SI</option>
					<option value="NO" {{ $curso->validacion == "NO" ? 'selected' : '' }}>NO</option>
				</select>
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="habilitacion">Habilitable</label>
				<select name="habilitacion" class="form-control">
					<option value="">Seleccione</option>
					<option value="SI" {{ $curso->habilitacion == "SI" ? 'selected' : '' }}>SI</option>
					<option value="NO" {{ $curso->habilitacion == "NO" ? 'selected' : '' }}>NO</option>
				</select>
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="semestre">Ubicación (Semestre)</label>
				<input type="text" name="semestre" class="form-control" value="{{$curso->num_semestre}}" placeholder="Ej 7...">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="tipo">Tipo de curso</label>
				<select name="tipo" class="form-control" >
					<option value="">Seleccione</option>
					<option value="Asignatura básica" {{ $curso->tipo == "Asignatura básica" ? 'selected' : '' }}>
						Asignatura básica
					</option>
					<option value="Asignatura profesional" {{ $curso->tipo == "Asignatura profesional" ? 'selected' : '' }}>
						Asignatura profesional
					</option>
					<option value="Electiva complementaria" {{ $curso->tipo == "Electiva complementaria" ? 'selected' : '' }}>
						Electiva complementaria
					</option>
					<option value="Electiva profesional" {{ $curso->tipo == "Electiva profesional" ? 'selected' : '' }}>
						Electiva profesional
					</option>
				</select>
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="programa">Programa al que pertenece</label>
				<select name="programa" class="form-control" value="{{old('programa')}}">
					<option value="">Seleccione</option>
					@foreach ($programas as $programa)
						@if ($curso->codigo_programa == $programa->codigo)
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
				<label for="estado">Estado</label>
				<input type="text" name="estado" class="form-control" value="{{$curso->estado}}" placeholder="Ej 1">
			</div>
		</div>
	</div>
	<div class="row">
	    <div id="div_pre" class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
	        <p>
	            <span class="glyphicon glyphicon-ok-circle"></span>
	            <strong>Pre-requisitos </strong>
	        </p>
	        <ul id="pre_req" class="country-block" >
	        	@foreach($cursos as $curso)
	            	<li class="opt-sel" value ="{{$curso->codigo}}" onclick="return setPre(this)">{{$curso->nombre}}</li> 
	        	@endforeach   
	        </ul>
	    </div>
	    <div id="div_sel" class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
	        <p>
	            <span class="glyphicon glyphicon-remove-circle"></span>
	            <strong>Añadidos</strong>
	        </p>
	        <input type="hidden" id="seleccionados" name="seleccionados">
	        <ul id="sel_req" class="country-block">
	        	@foreach($cursos_pre as $curso_pre)
	            	<li class="opt-sel" value ="{{$curso_pre->codigo}}" onclick="return setPre(this)">{{$curso_pre->nombre}}</li> 
	        	@endforeach 
	        </ul>
	    </div>
	</div>
	<div class="row">
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">cancelar</button>
			</div>
		</div>
	</div>
	{!! Form::close() !!}			
@endsection