@extends ('layouts.admin')
@section ('contenido')

	<H1 style="font-size: 30px; font-weight: bold;">{{$curso->nombre}} {{$curso->codigo}} ({{$curso->creditos}} créditos)</H1>
	<input id="curso-id" type="hidden" name="" class="" value="{{$curso->codigo}}" placeholder="">

	<div id="competencias">
		<H5 style="text-align: center;">A continuación se encuentran las competencias que se espera los estudiantes hayan adquirido al finalizar el curso.</H5>
	</div>

<button style="margin-left: 40%; margin-top: 1%; margin-bottom: 2%" id="btn-crear-competencia" type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearcompetencia" data-whatever="Nueva Competencia">NUEVA COMPETENCIA</button>

<div class="modal fade" id="crearcompetencia" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div style="font-family:'Courier'; width: 690px;" class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <H3 style="text-align: center; font-family:'Courier'; font-weight: bold;" class="modal-title" id="exampleModalLabel">NUEVA COMPETENCIA</H3>
        <button style="margin-top: -30px;" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Descripción:</label>
            <textarea id="competencia-txt" type="text" class="form-control" placeholder="Ingrese descripción"></textarea>
          </div>
			<div id="crear-r-a" class="form-group" style="background: #E8F8F5; padding: 10px">
				<div id="r-a-temp">
					<H4 style="text-align: center;  font-family:'Courier'; font-weight: bold;">RESULTADOS DE APRENDIZAJE</H4>
				</div>
				<p style="text-align: center;">Nuevo Resultado de Aprendizaje</p>
				<!--Verbos para resultado de aprendizaje  -->
				<fieldset>
				<label for="ra-select-verbo">Verbo:</label>
				<select id="ra-select-verbo">
					<option value="">Seleccione</option>
					@foreach ($verbos as $verbo)
						<option value="{{$verbo->verbo}}">{{ $verbo->verbo }}</option>
					@endforeach
				</select>
					</fieldset>
				<fieldset>
				<!--Contenidos para resultado de aprendizaje -->
				<label for="ra-select-contenido">Contenido:</label>
				<select id="ra-select-contenido">
					<option value="">Seleccione</option>
					@foreach ($contenidos as $contenido)
						<option value="{{$contenido->contenido}}">{{ $contenido->contenido }}</option>
					@endforeach
				</select>
					</fieldset>
				<fieldset>
				<!--Contextos para resultado de aprendizaje -->
				<label for="ra-select-contexto">Contexto:</label>
				<select id="ra-select-contexto">
					<option value="">Seleccione</option>
					@foreach ($contextos as $contexto)
						<option value="{{$contexto->contexto}}">{{ $contexto->contexto }}</option>
					@endforeach
				</select>
					</fieldset>
				<fieldset>
				<!--Propósitos para resultado de aprendizaje -->
				<label for="ra-select-proposito">Propósito:</label>
				<select id="ra-select-proposito">
					<option value="">Seleccione</option>
					@foreach ($propositos as $proposito)
						<option value="{{$proposito->proposito}}">{{ $proposito->proposito }}</option>
					@endforeach
				</select>
					</fieldset>

				<div id="crear-a-f" class="form-group" style="background: #F4ECF7; padding: 10px">
					<div id="a-f-temp">
						<H5 style="text-align: center;  font-family:'Courier'; font-weight: bold;">ACTIVIDADES DE FORMACIÓN</H5>
					</div>
					<p style="text-align: center;">Nueva Actividad de Formación</p>
					<fieldset>
					<label for="">Nombre de AF </label>
					<input type="text" id="a-f-nombre" name="" class="" value="" placeholder="Ingrese Nombre">
						</fieldset>
					<fieldset>
						<label for="recipient-name" class="col-form-label">Descripción:</label>
					<textarea type="text" id="a-f-descripcion"  name="" class="form-control" value="" placeholder="Ingrese Descripción"></textarea>
						</fieldset>

						<button style="margin-left: 40%; margin-top: 1%" id="btn-a-f" type="button" class="btn btn-warning" onclick="return actividadFormacion(1)">Agregar AF</button>
				</div>

				<div id="crear-i-l" class="form-group" style="background: #FEF5E7; padding: 10px">
					<div id="i-l-temp">
						<H5 style="text-align: center;  font-family:'Courier'; font-weight: bold;">INDICADORES DE LOGRO</H5>
					</div>
					<p style="text-align: center;">Nuevo indicador de logro</p>
					<fieldset>
					<!--Verbos para indicador de logro -->
						<label for="il-select-verbo">Verbo:</label>
						<select id="il-select-verbo">
						<option value="">Seleccione</option>
						@foreach ($verbos as $verbo)
							<option value="{{$verbo->verbo}}">{{ $verbo->verbo }}</option>
						@endforeach
					</select>
						</fieldset>
					<fieldset>
					<!--Contenidos para indicador de logro -->
						<label for="il-select-contenido">Contenido:</label>
					<select id="il-select-contenido">
						<option value="">Seleccione</option>
						@foreach ($contenidos as $contenido)
							<option value="{{$contenido->contenido}}">{{ $contenido->contenido }}</option>
						@endforeach
					</select>
						</fieldset>
							<fieldset>
					<!--Contextos para indicador de logro -->
								<label for="il-select-contexto">Contexto:</label>
					<select id="il-select-contexto">
						<option value="">Seleccione</option>
						@foreach ($contextos as $contexto)
							<option value="{{$contexto->contexto}}">{{ $contexto->contexto }}</option>
						@endforeach
					</select>
								</fieldset>

					<div id="crear-a-e" class="form-group" style="background: #FADBD8; padding: 10px">
						<div id="a-e-creadas">
							<H6 style="text-align: center;  font-family:'Courier'; font-weight: bold;">ACTIVIDADES DE EVALUACIÓN</H6>
							<p style="text-align: center;">Nueva actividad de evaluación</p>
						</div>
						<p>Nueva actividad de evaluación.</p>
						<fieldset>
							<label for="">Nombre de AE </label>
						<input type="text" id="a-e-nombre" name="" class="" value="" placeholder="Ingrese Nombre">
							</fieldset>
						<fieldset>
							<label id="" for="">Descripción</label>
						<textarea type="text" id="a-e-descripcion" name="" class="form-control" value="" placeholder="Ingrese descripción"></textarea>
							</fieldset>
							<button style="margin-left: 40%; margin-top: 1%" id="btn-a-e" type="button" class="btn btn-warning" onclick="return actividadEvaluacion()">Agregar AE</button>
					</div>
					<button style="margin-left: 40%; margin-top: 1%" id="btn-i-l" type="button" class="btn btn-warning" onclick="return indicadorLogro()">Agregar IL</button>
				</div>
				<button style="margin-left: 25%; margin-top: 1%" id="btn-r-a" type="button" class="btn btn-danger" onclick="return resultadoAprendizaje()">Guardar Resultado de Aprendizaje</button>
			</div>






        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
		  <button id="btn-competencia" type="button" class="btn btn-success" onclick="return competencia()">GUARDAR COMPETENCIA</button>
      </div>
    </div>
  </div>
</div>
		

@endsection

@section('scripts')
<!-- jQuery 2.1.4 -->
<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
<script type="text/javascript">

	//Carga inicial de competencias
	var cc = document.getElementById("curso-id").value;
	getCompetencias(cc);

	function actividadFormacion(opcion){
		var nombre = document.getElementById("a-f-nombre").value;
		var descripcion = document.getElementById("a-f-descripcion").value;
		if(nombre.length < 5 || descripcion.length < 5){
			alert('El nombre o la descripción tiene menos de 5 caractéres');
			return false;
		}else{
			var a_f_div = document.getElementById("a-f-temp");
			if(a_f_div.getElementsByClassName("actis-form")[0] == null){
				var actis_form = document.createElement("DIV");
				actis_form.className = "actis-form";
				var list_a_f = document.createElement("UL");
				list_a_f.className = "a-f-list";
				actis_form.appendChild(list_a_f);
				a_f_div.appendChild(actis_form);
			}else{
				var actis_form = a_f_div.getElementsByClassName("actis-form")[0];
				var list_a_f = actis_form.getElementsByClassName("a-f-list")[0];
			}
			
			var li_a_f = document.createElement("LI");
			li_a_f.className = "a_f_item";

			var p = document.createElement("P");

			var li_span_1 = document.createElement("SPAN");
			li_span_1.className = "name-a-f";
			li_span_1.innerHTML = nombre;

			var clear_span = document.createElement("SPAN");
			clear_span.innerHTML = "&nbsp";

			var li_span_2 = document.createElement("SPAN");
			li_span_2.className = "descripcion-a-f";
			li_span_2.innerHTML = descripcion;

			p.appendChild(li_span_1);
			p.appendChild(clear_span);
			p.appendChild(li_span_2);

			li_a_f.appendChild(p);
			list_a_f.appendChild(li_a_f);

			//Limpiar inputs de actividad de evaluación
			document.getElementById("a-f-nombre").value="";
			document.getElementById("a-f-descripcion").value="";

			//Recoger la div de crear actividad de evaluación
			document.getElementById("btn-crear-a-f").click();

			return false;
		}
	}

	function actividadEvaluacion(){
		var nombre = document.getElementById("a-e-nombre").value;
		var descripcion = document.getElementById("a-e-descripcion").value;
		if(nombre.length < 5 || descripcion.length < 5){
			alert('El nombre o la descripción tiene menos de 5 caractéres');
			return false;
		}else{
			var div_a_e = document.getElementById("a-e-creadas");

			if(div_a_e.getElementsByClassName("a-e-list")[0] == null){
				var list_a_e = document.createElement("UL");	
				list_a_e.className = "a-e-list";
			}else{
				var list_a_e = div_a_e.getElementsByClassName("a-e-list")[0];
			}

			var li_a_e = document.createElement("LI");
			li_a_e.className = "a_e_item";

			var p = document.createElement("P");

			var li_span_1 = document.createElement("SPAN");
			li_span_1.className = "name-a-e";
			li_span_1.innerHTML = nombre;

			var clear_span = document.createElement("SPAN");
			clear_span.innerHTML = "&nbsp";

			var li_span_2 = document.createElement("SPAN");
			li_span_2.className = "descripcion-a-e";
			li_span_2.innerHTML = descripcion;

			p.appendChild(li_span_1);
			p.appendChild(clear_span);
			p.appendChild(li_span_2);

			li_a_e.appendChild(p);
			list_a_e.appendChild(li_a_e);
			div_a_e.appendChild(list_a_e);

			//Limpiar inputs de actividad de evaluación
			document.getElementById("a-e-nombre").value="";
			document.getElementById("a-e-descripcion").value="";

			//Recoger la div de crear actividad de evaluación
			document.getElementById("btn-crear-a-e").click();

			return false;
		}
	}

	function indicadorLogro(){
		var i_l_temp = document.getElementById("i-l-temp");
		var verbo = document.getElementById("il-select-verbo");
		var contenido = document.getElementById("il-select-contenido");
		var contexto = document.getElementById("il-select-contexto");
		var lista_a_e = document.getElementById("a-e-creadas").getElementsByClassName("a-e-list")[0];
		if(verbo.selectedIndex == 0){
			alert("Debe seleccionar un verbo para el indicador de logro");
			return false;
		}else if(contenido.selectedIndex == 0){
			alert("Debe seleccionar un contenido para el indicador de logro");
			return false;
		}else if(contexto.selectedIndex == 0){
			alert("Debe seleccionar un contexto para el indicador de logro");
			return false;
		}else if(lista_a_e == null){
			alert("Debe agregar al menos una actividad de evaluación para el indicador de logro");
			return false;
		}

		if(i_l_temp.getElementsByClassName("indis-logro")[0] == null){
			var indis_logro = document.createElement("DIV");
			indis_logro.className = "indis-logro";
			i_l_temp.appendChild(indis_logro);
		}else{
			var indis_logro = i_l_temp.getElementsByClassName("indis-logro")[0];
		}

		var il_div = document.createElement("DIV");
		il_div.className = "i-l-div";

		var il_descripcion = document.createElement("DIV");
		il_descripcion.className = "i-l-descripcion";

		var p = document.createElement("P");
		p.innerHTML = verbo.options[verbo.selectedIndex].text+" "+contenido.options[contenido.selectedIndex].text+" "+contexto.options[contexto.selectedIndex].text;
		il_descripcion.appendChild(p);

		il_div.appendChild(il_descripcion);

		var a_e_div = document.createElement("DIV");
		a_e_div.className = "a-e-div";

		var p = document.createElement("H5");
		p.style.fontWeight = "bold";
		p.innerHTML = "Actividades de evaluación";

		a_e_div.appendChild(p);
		a_e_div.appendChild(lista_a_e);

		il_div.appendChild(a_e_div);

		indis_logro.appendChild(il_div);

		//Limpiar selects de indicador de logro
		document.getElementById("il-select-verbo").selectedIndex=0;
		document.getElementById("il-select-contenido").selectedIndex=0;
		document.getElementById("il-select-contexto").selectedIndex=0;
		//Limpiar las actividades de evaluación de la lista
		$("#a-e-list").empty();
		//Recoger la div de crear indicador de logro
		document.getElementById("btn-crear-i-l").click();

		return false;
	}

	function resultadoAprendizaje(){
		var r_a_temp = document.getElementById("r-a-temp");
		var verbo = document.getElementById("ra-select-verbo");
		var contenido = document.getElementById("ra-select-contenido");
		var contexto = document.getElementById("ra-select-contexto");
		var proposito = document.getElementById("ra-select-proposito");
		var actis_form = document.getElementById("a-f-temp").getElementsByClassName("actis-form")[0];
		var indis_logro = document.getElementById("i-l-temp").getElementsByClassName("indis-logro")[0];
		if(verbo.selectedIndex == 0){
			alert("Debe seleccionar un verbo para el resultado de aprendizaje");
			return false;
		}else if(contenido.selectedIndex == 0){
			alert("Debe seleccionar un contenido para el resultado de aprendizaje");
			return false;
		}else if(contexto.selectedIndex == 0){
			alert("Debe seleccionar un contexto para el resultado de aprendizaje");
			return false;
		}else if(proposito.selectedIndex  == 0){
			alert("Debe seleccionar un propoósito para el resultado de aprendizaje");
			return false;
		}else if(actis_form == null){
			alert("Debe agregar al menos una actividad de formación para el resultado de aprendizaje");
			return false;
		}else if(indis_logro == null){
			alert("Debe agregar al menos un indicador de logro para el resultado de aprendizaje");
			return false;
		}

		var ra_div = document.createElement("DIV");
		ra_div.className = "r-a-div";

		var ra_descripcion = document.createElement("DIV");
		ra_descripcion.className = "r-a-descripcion";

		var p = document.createElement("P");
		p.innerHTML = verbo.options[verbo.selectedIndex].text+" "+contenido.options[contenido.selectedIndex].text+" "
					+contexto.options[contexto.selectedIndex].text+" "+proposito.options[proposito.selectedIndex].text;
		ra_descripcion.appendChild(p);

		ra_div.appendChild(ra_descripcion);

		var h4_1 = document.createElement("H4");
		h4_1.style.fontWeight = "bold";
		h4_1.innerHTML = "Actividades de formación";
		var actis_form = document.getElementById("a-f-temp").getElementsByClassName("actis-form")[0];
		ra_div.appendChild(h4_1);
		ra_div.appendChild(actis_form);

		var h4_2 = document.createElement("H4");
		h4_2.style.fontWeight = "bold";
		h4_2.innerHTML = "Indicadores de logro";
		var indis_logro = document.getElementById("i-l-temp").getElementsByClassName("indis-logro")[0];
		ra_div.appendChild(h4_2);
		ra_div.appendChild(indis_logro);

		r_a_temp.appendChild(ra_div);

		//Limpiar selects de indicador de logro
		document.getElementById("ra-select-verbo").selectedIndex=0;
		document.getElementById("ra-select-contenido").selectedIndex=0;
		document.getElementById("ra-select-contexto").selectedIndex=0;
		document.getElementById("ra-select-proposito").selectedIndex=0;

		//Recoger la div de crear indicador de logro
		document.getElementById("btn-crear-r-a").click();

		return false;
	}


	function competencia(){
		var curso_id = document.getElementById("curso-id").value;
		var descrip_competencia = document.getElementById("competencia-txt").value;
		var results_aprend = document.getElementById("r-a-temp").getElementsByClassName("r-a-div");
		if(descrip_competencia.length < 5){
			alert("Debe agregar la descripción con más de 5 caractéres para la competencia");
			return false;
		}else if(results_aprend.length == 0){
			alert("Debe agregar por lo menos un resultado de aprendizaje para la competencia");
			return false;
		}

		var object_competencia = new Object();//Objeto para guardar todo el contenido de una competencia
		object_competencia.curso = curso_id;
		object_competencia.descripcion = descrip_competencia;
		object_competencia.resultados_aprendizaje = [];
		for(var i=0; i<results_aprend.length; i++){
			var objeto_r_a = new Object();
			var ra_descripcion = results_aprend[i].getElementsByClassName("r-a-descripcion")[0].getElementsByTagName("P")[0].innerHTML;
			var ra_actis_form = results_aprend[i].getElementsByClassName("actis-form")[0].getElementsByClassName("a-f-list")[0].getElementsByClassName("a_f_item");
			var ra_indis_logro = results_aprend[i].getElementsByClassName("indis-logro")[0].getElementsByClassName("i-l-div");
			objeto_r_a.descripcion = ra_descripcion;

			objeto_r_a.actividades_formacion = [];
			for(var j=0; j<ra_actis_form.length; j++){
				var ra_a_f = new Object();
				var ra_a_f_item = ra_actis_form[j].getElementsByTagName("P")[0];
				var ra_a_f_name = ra_a_f_item.getElementsByClassName("name-a-f")[0].innerHTML;
				var ra_a_f_description = ra_a_f_item.getElementsByClassName("descripcion-a-f")[0].innerHTML;
				ra_a_f.name = ra_a_f_name;
				ra_a_f.description = ra_a_f_description;
				objeto_r_a.actividades_formacion.push(ra_a_f);
			}

			objeto_r_a.indicadores_logro = [];
			for(var k=0; k<ra_indis_logro.length; k++){
				var i_l_logro = new Object();
				var il_descripcion = ra_indis_logro[k].getElementsByClassName("i-l-descripcion")[0].getElementsByTagName("P")[0].innerHTML;
				i_l_logro.descripcion = il_descripcion;

				var actis_eval = ra_indis_logro[k].getElementsByClassName("a-e-div")[0].getElementsByClassName("a-e-list")[0].getElementsByClassName("a_e_item");
				i_l_logro.actividades_evaluacion = [];
				for(var l=0; l<actis_eval.length; l++){
					var il_a_e = new Object();
					var il_a_e_item = actis_eval[l].getElementsByTagName("P")[0];
					var il_a_e_name = il_a_e_item.getElementsByClassName("name-a-e")[0].innerHTML;
					var il_a_e_description = il_a_e_item.getElementsByClassName("descripcion-a-e")[0].innerHTML;
					il_a_e.name = il_a_e_name;
					il_a_e.descripcion = il_a_e_description;
					i_l_logro.actividades_evaluacion.push(il_a_e);
				}
				objeto_r_a.indicadores_logro.push(i_l_logro);
			}
			object_competencia.resultados_aprendizaje.push(objeto_r_a);
		}
		//console.log(object_competencia); //Objeto competencia terminado.
		var data = JSON.stringify(object_competencia);
		var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var response = this.responseText;
                if(response == "OK"){
                	//Limpiar campo de descripción de crear competencia
                	document.getElementById("competencia-txt").value = "";
                	//limpiar la div de los resultados de aprendizaje
                	for(var i=0; i<results_aprend.length; i++){
                		results_aprend[i].remove();
            		}
            		//Recoger la div de crear competencia
            		getCompetencias(curso_id);
					document.getElementById("btn-crear-competencia").click();
                	delete object_competencia;
                }else{
                	alert("La competencia no se ha creado correctamente");
                }
            }
        };
        xhttp.open("GET", "../crear_competencia?data="+data, true);
        xhttp.setRequestHeader("Content-type", "application/json; charset=utf-8");
        xhttp.send();
		//console.log(data);
	}

	function getCompetencias(codigo_curso){
		var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

            	//Gestionar elementos html para las competencias
                var response = this.responseText;
                var response_array = JSON.parse(response);
                var array_comp = response_array['competencias'];

                //Borrar las competencias de la div para cuando se elimine alguna se ponen  solo las que queden en la base de datos de nuevo
                var div_competencias = document.getElementById("competencias");
                while (div_competencias.hasChildNodes()) {
				    div_competencias.removeChild(div_competencias.lastChild);
				}

				var titulo_h3_ = document.createElement("H5");
				titulo_h3_.style.textAlign = "center";
				titulo_h3_.innerHTML = "A continuación se encuentran las competencias que se espera los estudiantes hayan adquirido al finalizar el curso.";

				div_competencias.appendChild(titulo_h3_);
               	
                for(var i=0; i<array_comp.length; i++){
                	var div_competencia = document.createElement("DIV");
                	div_competencia.className = "competencia";
                	var div_comp_desc = document.createElement("DIV");
                	div_comp_desc.className = "comp_desc";
					var p_comp_desc_ = document.createElement("H4");
					p_comp_desc_.innerHTML = "COMPETENCIA "+parseInt(i+1);
					p_comp_desc_.style.fontWeight = 'bold';
                	var p_comp_desc = document.createElement("P");
                	p_comp_desc.innerHTML = array_comp[i]['descripcion'];
					div_comp_desc.appendChild(p_comp_desc_);
					div_comp_desc.appendChild(p_comp_desc);
					div_comp_desc.style.marginLeft = "5%";
                	div_competencia.appendChild(div_comp_desc);

                	var titulo_h4_ = document.createElement("H4");
					titulo_h4_.style.textDecorationLine = "underline";
					titulo_h4_.style.fontWeight = 'bold';
                	titulo_h4_.innerHTML = "Resultados de aprendizaje";
					titulo_h4_.style.marginLeft = "5%";
                	div_competencia.appendChild(titulo_h4_);

                	//Gestionar divs para los resultados de aprendizaje
                	var div_resultados_aprendizaje = document.createElement("DIV");
                	div_resultados_aprendizaje.className = "resultados-aprendizaje";
                	var res_apren_array = array_comp[i]['resultados_aprendizaje'];
                	for(var j=0; j<res_apren_array.length; j++){
                		var div_r_a = document.createElement("DIV");
                		div_r_a.className = "resultado-aprendizaje";
						div_r_a.style.marginLeft = "10%";

                		var div_r_a_desc = document.createElement("DIV");
                		div_r_a_desc.className = "r-a-descripcion";
                		var p_r_a_desc = document.createElement("P");
                		p_r_a_desc.innerHTML = "RA "+parseInt(i+1)+"."+parseInt(j+1)+" : "+res_apren_array[j]['descripcion']; 
                		div_r_a_desc.appendChild(p_r_a_desc);
                		div_r_a.appendChild(div_r_a_desc);

                		var titulo_h4 = document.createElement("H4");
						titulo_h4.style.fontWeight = 'bold';
	                	titulo_h4.innerHTML = "Actividades de formación";
	                	div_r_a.appendChild(titulo_h4);

                		//Gestionar elementos para actividades de formación
                		var div_actividades_formacion = document.createElement("DIV");
                		div_actividades_formacion.className = "actividades-formacion";
                		var a_f_list = document.createElement("UL");
                		a_f_list.className = "a-f-list";
                		div_actividades_formacion.appendChild(a_f_list);
                		var acti_form_array =  res_apren_array[j]['actividades_formacion'];
                		for(var k=0; k<acti_form_array.length; k++){
                			var a_f_item = document.createElement("LI");
                			a_f_item.className = "a-f-item";
                			a_f_item.innerHTML = acti_form_array[k]['name']+" : "+acti_form_array[k]['descripcion'];
                			a_f_list.appendChild(a_f_item);
                		}//fin for actividades formación
                		div_r_a.appendChild(div_actividades_formacion);

                		var titulo_h4_1 = document.createElement("H4");
	                	titulo_h4_1.innerHTML = "Indicadores de logro";
						titulo_h4_1.style.fontWeight = 'bold';
	                	div_r_a.appendChild(titulo_h4_1);


                		//Gestionar elementos para indicadores de logro
            			var div_indicadores_logro = document.createElement("DIV");
                		div_indicadores_logro.className = "indicadores-logro";
                		var indic_logro_array =  res_apren_array[j]['indicadores_logro'];
                		for(var k=0; k<indic_logro_array.length; k++){
                			var div_indicador_logro = document.createElement("DIV");
                			div_indicador_logro.className = "indicador-logro";
							div_indicador_logro.style.marginLeft = "5%";
                			var div_i_l_desc = document.createElement("DIV");
                			div_i_l_desc.className = "i-l-descripcion";
                			var p_i_l_desc = document.createElement("P");
                			p_i_l_desc.innerHTML = "IL "+parseInt(i+1)+"."+parseInt(j+1)+"."+parseInt(k+1)+" : "+indic_logro_array[k]['descripcion'];
                			div_i_l_desc.appendChild(p_i_l_desc);
                			div_indicador_logro.appendChild(div_i_l_desc);

                			//Gestionar elementos para las actividades de evaluación
                			var titulo_h5 = document.createElement("H5");
		                	titulo_h5.innerHTML = "Actividades de evaluación";
							titulo_h5.style.fontWeight = 'bold';
							titulo_h5.style.fontStyle = 'Italic';
		                	div_indicador_logro.appendChild(titulo_h5);

		                	var div_actividades_evaluacion = document.createElement("DIV");
	                		div_actividades_evaluacion.className = "actividades-evaluacion";
	                		var a_e_list = document.createElement("UL");
	                		a_e_list.className = "a-e-list";
	                		div_actividades_evaluacion.appendChild(a_e_list);
		                	var acti_eval_array = indic_logro_array[k]['actividades_evaluacion'];
		                	for(var l=0; l<acti_eval_array.length; l++){
	                			var a_e_item = document.createElement("LI");
	                			a_e_item.className = "a-e-item";
	                			a_e_item.innerHTML = acti_eval_array[l]['name']+" : "+acti_eval_array[l]['descripcion'];
	                			a_e_list.appendChild(a_e_item);
	                		}//Fin for actividades evaluacion
	                		div_indicador_logro.appendChild(div_actividades_evaluacion);

                			div_indicadores_logro.appendChild(div_indicador_logro);
                		}//Fin for indicadores logro
                		div_r_a.appendChild(div_indicadores_logro);


                		div_resultados_aprendizaje.appendChild(div_r_a);
                	}//fin for resultados aprendizaje
                	div_competencia.appendChild(div_resultados_aprendizaje);

                	//boton para borrar competencia 
                	var curso_id = document.getElementById("curso-id").value;
                	var competencia_id = array_comp[i]['codigo_competencia'];
                	var btn_borrar = document.createElement("BUTTON");
                	btn_borrar.value = "Borrar competencia";
                	btn_borrar.innerHTML = "Borrar competencia "+parseInt(i+1);
					btn_borrar.style.marginLeft = "5%";
                	btn_borrar.setAttribute( "onClick", "borrarCompetencia('"+curso_id+"', '"+competencia_id+"')");
                	btn_borrar.className = "btn btn-danger";
                	div_competencia.appendChild(btn_borrar);

                	//Div temporal para separar las competencias
                	var div_borrar = document.createElement("DIV");
                	var p_borrar = document.createElement("P");
                	p_borrar.innerHTML = "------------------------------     Fin de competencia      ------------------------------";
                	div_borrar.appendChild(p_borrar);
                	div_competencia.appendChild(div_borrar);

                	div_competencias.appendChild(div_competencia);
                }//end for competencias
            }
        };
        //xhttp.open("GET", "http://localhost:8000/get_competencias?codigo=750080M", true);
        xhttp.open("GET", "../get_competencias?codigo="+codigo_curso, true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send();
	}

	function borrarCompetencia(codigo_curso, codigo_competencia){
		var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var response = this.responseText;
                if(response == "OK"){
                	getCompetencias(codigo_curso);
                	alert("Competencia eliminada correctamente");
                }
            }
        };
        xhttp.open("GET", "../eliminar_competencia?competencia="+codigo_competencia, true);
        xhttp.setRequestHeader("Content-type", "text/plain");
        xhttp.send();
	}
</script>
@stop
