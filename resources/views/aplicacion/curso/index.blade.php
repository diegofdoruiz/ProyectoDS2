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
						<th style="width:50px; font-size: 12px;">Código</th>
						<th style="width:30px; font-size: 12px;">Nombre</th>
					    <th style="width:30px; font-size: 12px;">Créditos</th>
					    <th style="width:30px; font-size: 12px;">Horas magistrales</th>
					    <th style="width:30px; font-size: 12px;">Estudio Independiente</th>
					    <th style="width:30px; font-size: 12px;">Validable</th>
					    <th style="width:30px; font-size: 12px;">Habilitable</th>
					    <th style="width:30px; font-size: 12px;">Semestre</th>
					    <th style="width:30px; font-size: 12px;">Tipo</th>
					    <!--<th>Estado</th>-->
					    <th>Opciones</th>
					</thead>
					@foreach ($cursos as $curso)
					<tr>
						<td><a href="{{ URL::action('CursoController@show', $curso->codigo) }}"> {{ $curso->codigo }} </a></td>
						<td><a href="{{ URL::action('CursoController@show', $curso->codigo) }}"> {{ $curso->nombre }} </a></td>
						<td><a href="{{ URL::action('CursoController@show', $curso->codigo) }}"> {{ $curso->creditos }} </a></td>
						<td><a href="{{ URL::action('CursoController@show', $curso->codigo) }}"> {{ $curso->horas_magistrales }} </a></td>
						<td><a href="{{ URL::action('CursoController@show', $curso->codigo) }}"> {{ $curso->horas_independientes }} </a></td>
						<td><a href="{{ URL::action('CursoController@show', $curso->codigo) }}"> {{ $curso->validacion }} </a></td>
						<td><a href="{{ URL::action('CursoController@show', $curso->codigo) }}"> {{ $curso->habilitacion }} </a></td>
						<td><a href="{{ URL::action('CursoController@show', $curso->codigo) }}"> {{ $curso->num_semestre }} </a></td>
						<td><a href="{{ URL::action('CursoController@show', $curso->codigo) }}"> {{ $curso->tipo }} </a></td>
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
@endsection