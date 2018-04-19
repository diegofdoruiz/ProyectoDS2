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
    <script type="text/javascript">
        document.getElementById("btn_pre").addEventListener("click", function(){
            alert('gsgas');
        });

        document.getElementById("guardar").addEventListener("click", function(){
            var creditos = parseInt(document.getElementById("creditos").value);
            var magistrales = parseInt(document.getElementById('magistrales').value);
            var independientes = parseInt(document.getElementById('independientes').value);
            var semanal1 = creditos*3;
            var semanal2 = magistrales+independientes;
            if(semanal1 == 0 || semanal2 == 0){
              alert("Por favor seleccione valores válidos: \n"+
                    "Créditos x 3 = "+ semanal1.toString()+"\n"+
                    "Magistrales + independientes = "+semanal2.toString());
              return false;
            }else if(semanal1 != semanal2){
              alert("Las horas de trabajo semanal no coinciden: \n" +
                    "Créditos x 3 = "+ semanal1.toString()+"\n"+
                    "Magistrales + independientes = "+semanal2.toString());
              return false;
            }else{
              return true;
            }
          });
    </script>
      
    <!-- jQuery 2.1.4 -->
    <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('js/app.min.js')}}"></script>
    </div>
  </body>
</html>
