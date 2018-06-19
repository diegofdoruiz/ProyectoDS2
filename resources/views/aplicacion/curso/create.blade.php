@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-12 col-md-12 co-sm-12 col-xs-12">
			<h1 style="font-size: 30px; font-weight: bold; text-align: center">Nuevo Curso</h1>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif
		</div>
	</div>
	{!! Form::open(array('url'=>'curso', 'method'=>'POST', 'onsubmit'=>'return validate()')) !!}
	{{ Form::token() }}
	<div id="formulario" class="row">
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div id="div-codigo" class="form-group">
				<label id="alert-codigo" for="codigo">Código</label>
				<input type="text" id="codigo" name="codigo" class="form-control" value="{{old('codigo')}}" placeholder="Código...">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div id="div-nombre" class="form-group">
				<label id="alert-nombre" for="nombre">Nombre</label>
				<input type="text" id="nombre" name="nombre" class="form-control" value="{{old('nombre')}}" placeholder="Nombre...">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="row">
				<div class="col-xs-6 col-sm-6">
					<div id="div-creditos" class="form-group">
						<label id="alert-creditos" for="creditos">Créditos</label>
						<input type="text" id="creditos" name="creditos" class="form-control" value = "{{ old('creditos') > 0 ?  old('creditos') : ''}}" placeholder="Ej 4...">
					</div>
				</div>
				<div class="col-xs-6 col-sm-6">
					<div id="div-hmagistrales" class="form-group">
						<label id="alert-hmagistrales" for="magistrales">Horas Magistrales</label>
						<input type="text" id="hmagistrales" name="magistrales" class="form-control" value="{{ old('magistrales') > 0 ?  old('magistrales') : ''}}" placeholder="Ej 4...">
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div id="div-hindependientes" class="form-group">
				<label id="alert-hindependientes" for="independientes">Horas Independientes</label>
				<input type="text" id="hindependientes" name="independientes" class="form-control" value="{{ old('independientes') > 0 ?  old('independientes') : ''}}" placeholder="Ej 8..." readonly>
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="row">
				<div class="col-xs-6 col-sm-6">
					<div id="div-validacion" class="form-group">
						<label id="alert-validacion" for="validacion">Validable</label>
						<select id="validacion" name="validacion" class="form-control">
							<option value="">Seleccione</option>
							<option value="SI" {{ old('validacion') == "SI" ? 'selected' : '' }}>SI</option>
							<option value="NO" {{ old('validacion') == "NO" ? 'selected' : '' }}>NO</option>
						</select>
					</div>
				</div>
				<div class="col-xs-6 col-sm-6">
					<div id="div-habilitacion" class="form-group">
						<label id="alert-habilitacion" for="habilitacion">Habilitable</label>
						<select id="habilitacion" name="habilitacion" class="form-control">
							<option value="">Seleccione</option>
							<option value="SI" {{ old('habilitacion') == "SI" ? 'selected' : '' }}>SI</option>
							<option value="NO" {{ old('habilitacion') == "NO" ? 'selected' : '' }}>NO</option>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="row">
				<div class="col-xs-6 col-sm-6">
					<div id="div-tipo" class="form-group">
						<label id="alert-tipo" for="tipo">Tipo de curso</label>
						<select id="tipo" name="tipo" class="form-control" >
							<option value="">Seleccione</option>
							<option value="Asignatura básica" {{ old('tipo') == "Asignatura básica" ? 'selected' : '' }}>
								Asignatura básica
							</option>
							<option value="Asignatura profesional" {{ old('tipo') == "Asignatura profesional" ? 'selected' : '' }}>
								Asignatura profesional
							</option>
							<option value="Electiva complementaria" {{ old('tipo') == "Electiva complementaria" ? 'selected' : '' }}>
								Electiva complementaria
							</option>
							<option value="Electiva profesional" {{ old('tipo') == "Electiva profesional" ? 'selected' : '' }}>
								Electiva profesional
							</option>
						</select>
					</div>
				</div>
				<div class="col-xs-6 col-sm-6">
					<div id="div-semestre" class="form-group">
						<label id="alert-semestre" for="semestre">Ubicación (Semestre)</label>
						<select id="semestre" name="semestre" class="form-control" onchange="prerequisitosDisponibles(this)">
							<option value="">Seleccione</option>
							@for($i=1; $i<=15; $i++)
							<option value="{{$i}}" {{ old('semestre') == $i ? 'selected' : '' }}>{{$i}}</option>
							@endfor
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="row">
				<div class="col-xs-12 col-sm-12">
					<label for="">Click para seleccionar programas</label>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6 col-sm-6">
				    <div id="div_pre_pro">
				        <ul id="pre_pro" class="lista-programas" >
				        	@foreach($programas as $programa)
				        		<li class="opt-sel" data-value="{{$programa->codigo}}" onclick="setPrograma(this);">{{$programa->nombre}}</li>
				        	@endforeach
				        </ul>
				    </div>
				</div>
				<div class="col-xs-6 col-sm-6">
				    <div id="div_sel_pro">
				        <input type="hidden" id="programas" name="programas" velue="">
				        <ul id="sel_pro" class="lista-programas"></ul>
				    </div>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="row">
				<div class="col-xs-12 col-sm-12">
					<label for="">Click para seleccionar Prerequisitos</label>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6 col-sm-6">
				    <div id="div_pre">
				        <ul id="pre_req" class="curso-prerequisito" ></ul>
				    </div>
				</div>
				<div class="col-xs-6 col-sm-6">
				    <div id="div_sel">
				        <input type="hidden" id="seleccionados" name="seleccionados" value="">
				        <ul id="sel_req" class="curso-prerequisito"></ul>
				    </div>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="col-xs-12 col-sm-12">
				<div class="row">
					<br>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form-group">
			<button style="margin-left: 40%" id="guardar" class="btn btn-success" type="submit">Guardar Curso</button>
			<button class="btn btn-danger" type="button" onclick="history.back()">Ir Atrás</button>
		</div>
	</div>

	{!! Form::close() !!}			
@endsection
@section('scripts')
<!-- jQuery 2.1.4 -->
<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
<script type="text/javascript">
    /*Set prerequisitos cuando se va a editar*/
    jQuery(document).ready(function($){
	    document.getElementById("codigo").addEventListener("input", function(){
	    	$('#div-codigo').removeClass('has-error');
	    	document.getElementById("alert-codigo").innerHTML="Código";
		});
		document.getElementById("nombre").addEventListener("input", function(){
	    	$('#div-nombre').removeClass('has-error');
	    	document.getElementById("alert-nombre").innerHTML="Nombre";
		});
		document.getElementById("creditos").addEventListener("input", function(){
	    	$('#div-creditos').removeClass('has-error');
	    	document.getElementById("alert-creditos").innerHTML="Créditos";
	    	$('#div-hindependientes').removeClass('has-error');
	    	document.getElementById("alert-hindependientes").innerHTML="Horas Independientes";
	    	var creditos = document.getElementById("creditos").value;
	    	var hmagistrales = document.getElementById("hmagistrales").value;
	    	var hindependientes = (creditos*3)-hmagistrales;
	    	document.getElementById("hindependientes").value = hindependientes;
		});
		document.getElementById("hmagistrales").addEventListener("input", function(){
	    	$('#div-hmagistrales').removeClass('has-error');
	    	document.getElementById("alert-hmagistrales").innerHTML="Horas Magistrales";
	    	$('#div-hindependientes').removeClass('has-error');
	    	document.getElementById("alert-hindependientes").innerHTML="Horas Independiente";
	    	var creditos = document.getElementById("creditos").value;
	    	var hmagistrales = document.getElementById("hmagistrales").value;
	    	var hindependientes = (creditos*3)-hmagistrales;
	    	document.getElementById("hindependientes").value = hindependientes;
		});
		document.getElementById("validacion").addEventListener("change", function(){
	    	$('#div-validacion').removeClass('has-error');
	    	document.getElementById("alert-validacion").innerHTML="Validable";
		});
		document.getElementById("habilitacion").addEventListener("change", function(){
	    	$('#div-habilitacion').removeClass('has-error');
	    	document.getElementById("alert-habilitacion").innerHTML="Habilitable";
		});
		document.getElementById("semestre").addEventListener("change", function(){
	    	$('#div-semestre').removeClass('has-error');
	    	document.getElementById("alert-semestre").innerHTML="Ubicación (Semestre)";
		});
		document.getElementById("tipo").addEventListener("change", function(){
	    	$('#div-tipo').removeClass('has-error');
	    	document.getElementById("alert-tipo").innerHTML="Tipo de curso";
		});
    });
    /*Seleccionar programas*/
    function setPrograma(item){
        input_programas = document.getElementById("programas");//contenedor de códigos seleccionados
        var ul_select = document.getElementById("sel_pro");
        var programa_seleccionado = item.getAttribute("data-value");//Toma el nuevo valor seleccionado
        ul_select.appendChild(item);
        var pro_selects = input_programas.value;//Toma los valores ya pro_seleccionados
        pro_selects = pro_selects.concat(programa_seleccionado+" ");//concat nuevo y anteriores
        input_programas.value=pro_selects;//asigna todos los seleccionados
        var array_li_selected = ul_select.getElementsByTagName("LI");
        for(var i=0; i<array_li_selected.length; i++){
            if(array_li_selected[i].getAttribute("data-value")==programa_seleccionado){
                array_li_selected[i].setAttribute( "onClick", "return unSetPrograma(this)");
            }
        }
        pro_selects="";
        return false;
    }
    /*Retornar un item programa seleccionado*/
    function unSetPrograma(item){
        input_programas = document.getElementById("programas");//contenedor de códigos seleccionados
        var ul_pro_pre = document.getElementById("pre_pro"); //lista de prerrequisitos
        var programa_unseleccionado = item.getAttribute('data-value');//Toma el nuevo valor seleccionado
        ul_pro_pre.appendChild(item);//retornar item a la lista de prerequisito
        var pro_selects = input_programas.value;//Toma los valores ya seleccionados
        pro_selects = pro_selects.replace(programa_unseleccionado+" ", "");//sacar el programa de los seleccionados
        input_programas.value=pro_selects;//asigna todos los seleccionados
        var array_li_pre_pro = ul_pro_pre.getElementsByTagName("LI");
        for(var i=0; i<array_li_pre_pro.length; i++){
            if(array_li_pre_pro[i].getAttribute("data-value")==programa_unseleccionado){
                array_li_pre_pro[i].setAttribute( "onClick", "return setPrograma(this)");
            }
        }
        pro_selects="";
        return false;
    }



    function setPre(item){
        var input_seleccionados = document.getElementById("seleccionados");//contenedor de códigos seleccionados
        var ul_select = document.getElementById("sel_req");
        var codigo_seleccionado = item.getAttribute("data-value");//Toma el nuevo valor seleccionado
        ul_select.appendChild(item);
        var seleccionados = input_seleccionados.value;//Toma los valores ya seleccionados
        seleccionados = seleccionados.concat(codigo_seleccionado+" ");//concat nuevo y anteriores
        input_seleccionados.value=seleccionados;//asigna todos los seleccionados
        var array_li_selected = ul_select.getElementsByTagName("LI");
        for(var i=0; i<array_li_selected.length; i++){
            if(array_li_selected[i].getAttribute("data-value")==codigo_seleccionado){
                array_li_selected[i].setAttribute( "onClick", "return unSetPre(this)");
            }
        }
        console.log(seleccionados);
        seleccionados="";
        return false;
    }
    /*Retornar un item seleccionado*/
    function unSetPre(item){
        input_seleccionados = document.getElementById("seleccionados");//contenedor de códigos seleccionados
        var ul_prerequisitos = document.getElementById("pre_req"); //lista de prerrequisitos
        ul_prerequisitos.appendChild(item);//retornar item a la lista de prerequisito
        var codigo_unseleccionado = item.getAttribute('data-value');//Toma el nuevo valor seleccionado
        var seleccionados = input_seleccionados.value;//Toma los valores ya seleccionados
        seleccionados = seleccionados.replace(codigo_unseleccionado+" ", "");//sacar el código de los seleccionados
        input_seleccionados.value=seleccionados;//asigna todos los seleccionados
        var array_li_prerequisitos = ul_prerequisitos.getElementsByTagName("LI");
        for(var i=0; i<array_li_prerequisitos.length; i++){
            if(array_li_prerequisitos[i].getAttribute("data-value")==codigo_unseleccionado){
                array_li_prerequisitos[i].setAttribute( "onClick", "return setPre(this)");
            }
        }
        console.log(seleccionados);
        seleccionados="";
        return false;
    }

    /*Validar campos en el formulario */
    function validate(){
    	var codigo = document.getElementById("codigo");
    	var nombre = document.getElementById("nombre");
    	var creditos = document.getElementById("creditos");
    	var hmagistrales = document.getElementById("hmagistrales");
    	var hindependientes = document.getElementById("hindependientes");
    	var validacion = document.getElementById("validacion");
    	var habilitacion = document.getElementById("habilitacion");
    	var semestre = document.getElementById("semestre");
    	var tipo = document.getElementById("tipo");
    	var programa = document.getElementById("programa");
    	var patron_codigo = /^[a-zA-Z0-9]+$/;
    	if(codigo.value.search(patron_codigo) == -1){
    		$('#div-codigo').addClass('has-error');
    		document.getElementById("alert-codigo").textContent="Código (Error. Código no válido)";
    		return false;
    	}
    	var patron_nombre = /^[a-zA-Z0-9\s]+$/;
    	if(nombre.value.search(patron_nombre) == -1){
    		$('#div-nombre').addClass('has-error');
    		document.getElementById("alert-nombre").textContent="Nombre (Error. Nombre válido)";
    		return false;
    	}
    	var patron_creditos = /^[1-9]+$/;
    	if(creditos.value.search(patron_creditos) == -1){
    		$('#div-creditos').addClass('has-error');
    		document.getElementById("alert-creditos").textContent="Créditos (Error. Valor numérico)";
    		return false;
    	}
    	var patron_hmagistrales = /^[1-9]+$/;
    	if(hmagistrales.value.search(patron_hmagistrales) == -1){
    		$('#div-hmagistrales').addClass('has-error');
    		document.getElementById("alert-hmagistrales").textContent="Magistrales (Error. Valor numérico)";
    		return false;
    	}
    	var patron_hindependientes = /^[1-9]+$/;
    	if(hindependientes.value.search(patron_hindependientes) == -1){
    		$('#div-hindependientes').addClass('has-error');
    		document.getElementById("alert-hindependientes").textContent="Horas Estudio Ind (Error créditos*3 != HM+HI)";
    		return false;
    	}
    	if(validacion.options[validacion.selectedIndex].value == 0){
    		$('#div-validacion').addClass('has-error');
    		document.getElementById("alert-validacion").textContent="Validable (Error. seleccione una opción)";
    		return false;
    	}
    	if(habilitacion.options[habilitacion.selectedIndex].value == 0){
    		$('#div-habilitacion').addClass('has-error');
    		document.getElementById("alert-habilitacion").textContent="Habilitable (Error. seleccione una opción)";
    		return false;
    	}
    	if(tipo.options[tipo.selectedIndex].value == 0){
    		$('#div-tipo').addClass('has-error');
    		document.getElementById("alert-tipo").textContent="Tipo (Error. seleccione una opción)";
    		return false;
    	}
    	if(semestre.options[semestre.selectedIndex].value == 0){
    		$('#div-semestre').addClass('has-error');
    		document.getElementById("alert-semestre").textContent="Ubicación (Error. seleccione una opción)";
    		return false;
    	}
      }

      /*Validar número de semestre y habilitar los prerequisitos de acuerdo a al semestre*/
      function prerequisitosDisponibles(select){
      	$("#pre_req").empty();//Remover todos items en los prerequisitos 
      	$("#sel_req").empty();//Remover todos items en los prerequisitos 
        var option = select.options[select.selectedIndex].value;
        var pre_req = document.getElementById("pre_req");
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              var cursos = JSON.parse(this.responseText);
              for(var i=0; i<cursos.length; i++){
                var select_option = document.createElement("LI");
                select_option.className = "opt-sel";
                select_option.setAttribute('data-value', cursos[i].codigo);
                select_option.setAttribute( "onClick", "return setPre(this)");
                select_option.innerHTML = cursos[i].nombre;
                pre_req.appendChild(select_option);
              }
           }
        };
        xhttp.open("GET", "../prerequisitos?semestre="+option, true);
        xhttp.send(); 
      }
    </script>
@stop



