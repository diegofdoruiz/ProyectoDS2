<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>UNIVALLE | Facultad de Ingeniería </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    <link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}">
    <link rel="shortcut icon" href="{{asset('img/logo')}}">
    <style type="text/css">
        .lista-programas{
          font-size: 15px;
          border-radius: 4px;
          border: 1px solid #c9c9c9;
          background: #EBF5FB;
          /*margin: 0;*/
          padding-left: 2px;
          padding-right: 2px;
          height: 150px;
          overflow-y: scroll;
        }
        .curso-prerequisito{
          font-size: 15px;
          border-radius: 4px;
          border: 1px solid #d9d9d9;
          background: #E8F8F5;
          /*margin: 0;*/
          padding-left: 2px;
          padding-right: 2px;
          height: 150px;
          overflow-y: scroll;
        }
        .opt-sel {
          cursor: pointer;
          background: #EBEDEF;
          border: 0.5px solid #d9d9d9;
          border-radius: 2px;
          font-size: 14px;
          margin-top: 3px;
          margin-bottom: 3px;
          max-width: 100%;
          text-overflow:ellipsis;
          white-space:nowrap;
          overflow:hidden;
        }
        .opt-sel:hover{
          background: #F8F9F9;
          border-radius: 2px;
          white-space: initial;
          overflow:visible;
        }
    </style>

  </head>
  <body style="font-family:'Courier';" class="hold-transition skin-red sidebar-mini">
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="/" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>UV</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>UV Ingenierías </b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- User Account: style can be found in dropdown.less -->
                <!--User-->
            @if (auth()->user()==NULL)
                    <li class="dropdown user user-menu">
                        <a href="/login">
                            <i class="fa fa-user"></i>
                            <span>INICIAR SESIÓN</span>
                        </a>
                        </li>
            @else
                @include('aplicacion.dashboard.nav')
            @endif


            <!--Fin user-->

            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
                    
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>
            
            <li class="treeview">
              <a href="/">
                <i class="fa fa-laptop"></i>
                <span>HOME</span>
              </a>
            </li>
            
            <li class="treeview">
              <a href="/programa/general">
                <i class="fa fa-th"></i>
                <span>PROGRAMAS</span>
              </a>
            </li>
            <li class="treeview">
              <a href="/curso/general">
                <i class="fa fa-th"></i>
                <span>CURSOS</span>
              </a>
            </li>
                       
            <li class="treeview">
              <a href="/usuario/general">
                <i class="fa fa-users"></i> <span>Miembros</span>
              </a>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>





       <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div style="background-color: white;" class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
          
          <div class="row">
            <div class="col-md-12">
              <div class="box">
		                          <!--Contenido-->
                              @if (session()->has('flash'))
                                <div class="alert alert-info">{{ session('flash') }}</div>
                              @endif
                              @yield('contenido')
                              @yield('scripts')
		                          <!--Fin Contenido-->
                  	</div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <!--Fin-Contenido-->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2018-2020 <a href="www.univalle.edu.co"> Univalle - Ingeniería de Sistemas</a>.</strong> All rights reserved.
      </footer>
    <!-- jQuery 2.1.4 -->
    <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('js/app.min.js')}}"></script>
    <!-- Script para manejar funciones del la web -->
    </div>
  </body>
</html>
