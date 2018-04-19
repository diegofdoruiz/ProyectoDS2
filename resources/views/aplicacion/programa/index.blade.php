@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Programas <a href="programa/create"><button class="btn btn-success">Nuevo</button></a></h3>
			@include('aplicacion.programa.search')
		</div>
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
@endsection