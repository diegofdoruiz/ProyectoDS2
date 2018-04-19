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
						@switch($usuario->rol)
					    @case(1)
					        <td>Docente</td>
					        @break
					    @case(2)
					        <td>Dir Plan</td>
					        @break
					    @case(3)
					        <td>Decano</td>
					        @break
					    @case(4)
					        <td>Administrador</td>
					        @break
					    @default
					        <td>Nada</td>
						@endswitch
						<td class="col-md-2">{{ $usuario->email }}</td>
						<td>{{ $usuario->codigo_escuela }}</td>
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
@endsection