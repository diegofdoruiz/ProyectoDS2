@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Cursos <a href="curso/create"><button class="btn btn-success">Nuevo</button></a></h3>
			@include('aplicacion.curso.search')
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Código</th>
						<th>Nombre</th>
					    <th>Créditos</th>
					    <th>Horas magistrales</th>
					    <th>Estudio Independiente</th>
					    <th>Validable</th>
					    <th>Habilitable</th>
					    <th>Semestre</th>
					    <th>Tipo</th>
					    <th>Programa</th>
					    <th>Estado</th>
					    <th>Opciones</th>
					</thead>
					@foreach ($cursos as $curso)
					<tr>
						<td>{{ $curso->codigo }}</td>
						<td>{{ $curso->nombre }}</td>
						<td>{{ $curso->creditos }}</td>
						<td>{{ $curso->horas_magistrales }}</td>
						<td>{{ $curso->horas_independientes }}</td>
						<td>{{ $curso->validacion }}</td>
						<td>{{ $curso->habilitacion }}</td>
						<td>{{ $curso->num_semestre }}</td>
						<td>{{ $curso->tipo }}</td>
						<td>{{ $curso->codigo_programa }}</td>
						<td>{{ $curso->estado }}</td>
						<td>
							<a href="{{ URL::action('CursoController@edit', $curso->codigo) }}"><button class="btn btn-info">Editar</button></a>
							<a href="" data-target="#modal-delete-{{$curso->codigo}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
						</td>
					</tr>
					@include('aplicacion.curso.modal')
					@endforeach
				</table>
			</div>
			{{$cursos->render()}}
		</div>
	</div>
@endsection