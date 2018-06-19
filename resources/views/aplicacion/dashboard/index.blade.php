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
			<div class="panel-footer">
				<form method="POST" action="{{ route('logout') }}">
					{{ csrf_field() }}
					<button class="btn btn-danger btn-xs btn-block" >Salir</button>
				</form>
			</div>
		</div>
	</div>
@endsection