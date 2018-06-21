
	<li class="dropdown user user-menu">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			<small class="bg-red">Online</small>
			<span style="font-size: 17px" class="hidden-xs">{{ auth()->user()->name }}</span>
		</a>
		<ul class="dropdown-menu">
			<!-- User image -->
			<li style="background-color: white; height: 100%; width: 100%" class="user-header">
					<a class="dropdown-item" href="/dashboard">Dashboard</a>
					<a class="dropdown-item" href="/curso">Administrar Cursos</a>
					@if (auth()->user()->rol!=1)
					<a class="dropdown-item" href="/programa">Administrar Programas</a>
					@endif
                    <a class="dropdown-item" href="/reportes">Reportes</a>
                    @if (auth()->user()->rol==4)
                    <a class="dropdown-item" href="/usuario">Administrar Miembros</a>
                    @endif

			</li>
			<!-- Menu Footer-->
			<li class="user-footer">

				<form method="POST" action="{{ route('logout') }}">
					{{ csrf_field() }}
					<button class="btn btn-danger btn-xs btn-block" >Cerrar sesión</button>
				</form>
			</li>
		</ul>
	</li>
