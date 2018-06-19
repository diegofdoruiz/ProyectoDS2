@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h1 style="font-size: 30px; font-weight: bold; text-align: center">Listado de Usuarios </h1>
		</div>
	</div>
	<div style="margin-left: 30%; width: 40%" class="row">
		@include('aplicacion.usuario.search')
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Código</th>
					    <th>Primer Nombre</th>
					    <th>Primer Apellido</th>
					    <th>Username</th>
					    <th>Rol</th>
					    <th style="width: 8%">Correo</th>
					    <th>Escuela</th>
					    <th>Opciones</th>
					</thead>
					@foreach ($usuarios as $usuario)
					<tr>
						<td>{{ $usuario->codigo }}</td>
						<td>{{ $usuario->primer_nombre }}</td>
						<td>{{ $usuario->primer_apellido }}</td>
						<td>{{ $usuario->name }}</td>
					    <td>{{$usuario->rol}}</td>
						<td class="col-md-2">{{ $usuario->email }}</td>
						<td>{{ $usuario->nombre }}</td>
						<td>
							<a href="{{ URL::action('Strategy\UsuarioDecano@edit', $usuario->codigo) }}"><button class="btn btn-info btn-sm">Editar</button></a>
							<a href="" data-target="#modal-delete-{{$usuario->codigo}}" data-toggle="modal"><button class="btn btn-danger btn-sm">Eliminar</button></a>
						</td>
					</tr>
					@include('aplicacion.usuario.modal')
					@endforeach
				</table>
			</div>
			{{$usuarios->render()}}
		</div>
	</div>

	<div style="margin-left: 40%" class="row">
		<a href="usuario/create"><button class="btn btn-success">Agregar Nuevo Usuario</button></a>
	</div>
@endsection