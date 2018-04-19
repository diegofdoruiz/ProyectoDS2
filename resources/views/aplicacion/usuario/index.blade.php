@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Usuarios <a href="usuario/create"><button class="btn btn-success">Nuevo</button></a></h3>
			@include('aplicacion.usuario.search')
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Código</th>
						<th>Cédula</th>
					    <th>Primer Nombre</th>
					    <th>Segundo Nombre</th>
					    <th>Primer Apellido</th>
					    <th>Segundo Apellido</th>
					    <th>Username</th>
					    <th>Rol</th>
					    <th>Correo</th>
					    <th>Contrasena</th>
					    <th>Opciones</th>
					</thead>
					@foreach ($usuarios as $usuario)
					<tr>
						<td>{{ $usuario->codigo }}</td>
						<td>{{ $usuario->cedula }}</td>
						<td>{{ $usuario->primer_nombre }}</td>
						<td>{{ $usuario->segundo_nombre }}</td>
						<td>{{ $usuario->primer_apellido }}</td>
						<td>{{ $usuario->segundo_apellido }}</td>
						<td>{{ $usuario->name }}</td>
						<td>{{ $usuario->rol }}</td>
						<td>{{ $usuario->email }}</td>
						<td>{{ $usuario->password }}</td>
						<td>
							<a href="{{ URL::action('Strategy\UsuarioDecano@edit', $usuario->codigo) }}"><button class="btn btn-info">Editar</button></a>
							<a href="" data-target="#modal-delete-{{$usuario->codigo}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
						</td>
					</tr>
					@include('aplicacion.usuario.modal')
					@endforeach
				</table>
			</div>
			{{$usuarios->render()}}
		</div>
	</div>
@endsection