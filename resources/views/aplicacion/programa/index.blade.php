@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h1 style="font-size: 30px; font-weight: bold; text-align: center">Listado de Programas Académicos</h1>
		</div>
	</div>
	<div style="margin-left: 30%; width: 40%" class="row">
		@include('aplicacion.programa.search')
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Código</th>
						<th>Nombre</th>
					    <th>Semestre</th>
					    <th>Créditos</th>
					    <th>Escuela</th>
					    <th>Director</th>
					    <th>Estado</th>
					    <th>Opciones</th>
					</thead>
					@foreach ($programas as $programa)
					<tr>
						<td>{{ $programa->codigo }}</td>
						<td>{{ $programa->nombre }}</td>
						<td>{{ $programa->num_semestres }}</td>
						<td>{{ $programa->creditos }}</td>
						<td>{{ $programa->codigo_escuela }}</td>
						<td>{{ $programa->director }}</td>
						<td>{{ $programa->estado }}</td>
						<td>
							<a href="{{ URL::action('ProgramaController@edit', $programa->codigo) }}"><button class="btn btn-info">Editar</button></a>
							<a href="" data-target="#modal-delete-{{$programa->codigo}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
						</td>
					</tr>
					@include('aplicacion.programa.modal')
					@endforeach
				</table>
			</div>
			{{$programas->render()}}
		</div>
	</div>

	<div style="margin-left: 40%" class="row">
		<a href="programa/create"><button class="btn btn-success">Agregar Nuevo Programa</button></a>
	</div>
@endsection