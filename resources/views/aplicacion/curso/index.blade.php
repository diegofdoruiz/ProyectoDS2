@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h1 style="font-size: 30px; font-weight: bold; text-align: center">Listado de Cursos</h1>
			<H5 style="text-align: center;"><u>Nota:</u> Haga click sobre el nombre de un curso si desea diseñar sus competencias.</H5>
		</div>
	</div>
	<div style="margin-left: 30%; width: 40%" class="row">
		@include('aplicacion.curso.search')
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th style="width:50px;">Código</th>
						<th style="width:250px;">Nombre</th>
					    <th style="width:30px;">Créditos</th>
					    <th style="width:30px;">Horas magistrales</th>
					    <th style="width:30px;">Estudio Independiente</th>
					    <th style="width:30px;">Validable</th>
					    <th style="width:30px;">Habilitable</th>
					    <th style="width:30px;">Semestre</th>
					    <th style="width:30px;">Tipo</th>
					    <!--<th>Estado</th>-->
					    <th>Opciones</th>
					</thead>
					@foreach ($cursos as $curso)
					<tr>
						<td><a href="{{ URL::action('CursoController@show', $curso->codigo) }}"> {{ $curso->codigo }} </a></td>
						<td><a href="{{ URL::action('CursoController@show', $curso->codigo) }}"> {{ $curso->nombre }} </a></td>
						<td> {{ $curso->creditos }}</td>
						<td> {{ $curso->horas_magistrales }} </td>
						<td> {{ $curso->horas_independientes }} </td>
						<td> {{ $curso->validacion }} </td>
						<td> {{ $curso->habilitacion }} </td>
						<td> {{ $curso->num_semestre }} </td>
						<td> {{ $curso->tipo }} </td>
						<!--<td>{{ $curso->estado }}</td>-->
						<td>
							<div class="btn-group btn-group-sm" role="group" aria-label="buttons">
								<a href="{{ URL::action('CursoController@edit', $curso->codigo) }}"><button type="button" class="btn btn-info">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$curso->codigo}}" data-toggle="modal"><button type="button" class="btn btn-danger">Eliminar</button></a>
							</div>
						</td>
					</tr>
					@include('aplicacion.curso.modal')
					@endforeach
				</table>
			</div>
			{{$cursos->render()}}
		</div>
	</div>

	<div style="margin-left: 42%" class="row">
		<a href="curso/create"><button class="btn btn-success">Agregar Nuevo Curso</button></a>
	</div>
@endsection