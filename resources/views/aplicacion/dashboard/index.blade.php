@extends ('layouts.admin')
@section ('contenido')
	<div style = "margin-top: 5%" class="col-md-4 col-md-offset-4">
		<div style = "text-align: center" class="panel panel-default">
			<div class="panel-heading">
				<h1 class="panel-title">Bienvenido {{ auth()->user()->name }} - <strong>({{ $type }})</strong></h1>
			</div>
			<div  class="panel-body">
				<strong>Email: {{ auth()->user()->email }} </strong>
			</div>
			@if(auth()->user()->rol != 1)
			<div  class="panel-body">
				<a href="/programa" class="btn btn-primary btn-block" role="button">Programas</a>
			</div>
			@endif
			<div  class="panel-body">
				<a href="/curso" class="btn btn-primary btn-block" role="button">Cursos</a>
			</div>
			<div  class="panel-body">
				<a href="/reportes" class="btn btn-primary btn-block" role="button">Reportes</a>
			</div>
			@if(auth()->user()->rol == 4)
			<div  class="panel-body">
				<a href="/usuario" class="btn btn-primary btn-block" role="button">Usuarios</a>
			</div>
			@endif
			<div class="panel-footer">
				<form method="POST" action="{{ route('logout') }}">
					{{ csrf_field() }}
					<button class="btn btn-danger btn-xs btn-block" >Salir</button>
				</form>
			</div>
		</div>
	</div>
@endsection