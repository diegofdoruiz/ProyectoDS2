
	<li class="dropdown user user-menu">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			<small class="bg-red">Online</small>
			<span style="font-size: 17px" class="hidden-xs">{{ auth()->user()->name }}</span>
		</a>
		<ul class="dropdown-menu">
			<!-- User image -->
			<li style="background-color: white; height: 100%; width: 100%" class="user-header">
				@if (auth()->user()->rol==1)
					<a class="dropdown-item" href="/curso">Administrar Cursos</a>
					<a class="dropdown-item" href="/diseño-curso">Diseñar Curso</a>
					<a class="dropdown-item" href="/reportes">Reportes</a>
                @elseif(auth()->user()->rol==2 || auth()->user()->rol==3)
                        <a class="dropdown-item" href="/programa">Administrar Programas</a>
                        <a class="dropdown-item" href="/curso">Administrar Cursos</a>
                        <a class="dropdown-item" href="/reportes">Reportes</a>
                @else
                    <a class="dropdown-item" href="/usuario">Administrar Miembros</a>
                @endif
                    <a class="dropdown-item" href="/configuracion">Configuración</a>

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
