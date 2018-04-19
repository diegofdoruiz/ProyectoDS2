@extends ('layouts.admin')
@section ('contenido')
	<div class="col-md-4 col-md-offset-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1 class="panel-title">Bienvenido {{ auth()->user()->name }} - {{ $type }}</h1>
			</div>
			<div class="panel-body">
				<strong>Email:{{ auth()->user()->email }} </strong>
			</div>
			<div class="panel-footer">
				<form method="POST" action="{{ route('logout') }}">
					{{ csrf_field() }}
					<button class="btn btn-danger btn-xs btn-block" >Cerrar sesión</button>
				</form>
			</div>
		</div>
	</div>
@endsection