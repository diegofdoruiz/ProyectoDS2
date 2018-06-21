@extends ('layouts.admin')

<!-- Web content -->
@section ('contenido')
	<div id="report-content">
		<H1 style="font-size: 30px; font-weight: bold; text-align: center">Consulta de Reportes</H1>
		<H5 style="text-align: center;">A continuación seleccione el tipo de reporte que desea visualizar:</H5>
		<div style="margin-top: 1%;" id="div-set-report">
			<input type="hidden" id="data-user-report" value="{{$usuario->rol}}-{{$usuario->codigo}}">
			
			<div style="margin-left: 40%" id="div-select-report">
				<label for="select-report" class="">Tipo de Reporte:  </label>
				<select style="margin-left: 2px" id="select-report">
					<option>Seleccione</option>
					<option>Reporte 1</option>
					@if($usuario->rol != 1)
						<option>Reporte 2</option>
					@endif
					<option>Reporte 3</option>
				</select>
			</div>

			<H5 style="text-align: left;  margin-bottom: 2%"><strong>Reporte 1:</strong> Si desea ver el diseño completo de un curso en forma de tabla. <br>
				<strong>Reporte 2:</strong> Si desea ver las competencias trabajadas en un programa académico por semestre en forma de tabla. <br>
				<strong>Reporte 3:</strong> Si desea ver un reporte visual de la jerarquía de competencias de un curso con sus respectivos resultados de aprendizaje e indicadores de logro.<br>
			</H5>

			<div id="div-cursos-report" style="display: none; margin-left: 30%; margin-bottom: 1%">
				<label for="select-cursos" class="">Seleccione un curso:</label>
				<select style="margin-left: 2px" id="select-cursos">
				</select>
			</div>

			<div id="div-programas-report" style="display: none; margin-left: 30%;">
				<label for="select-programas" class="">Seleccione un programa:</label>
				<select style="margin-left: 2px" id="select-programas">
				</select>
			</div>
			<div id="div-semestres-report" style="display: none; margin-left: 35%; margin-bottom: 1%">
				<label for="select-semestres" class="">Seleccione un semestre:</label>
				<select style="margin-left: 2px" id="select-semestres">
					<option value="0">Todos</option>
					@for($i=1; $i<=10; $i++)
						<option value="{{ $i }}">{{$i}}</option>
					@endfor
				</select>
			</div>

			<button style="margin-left: 43%; margin-bottom: 1%" id="btn-report" type="button" class="btn btn-danger" onclick="return getData()">Generar Reporte</button>

		</div>
		<div id="show-report">
			<div id="div-report1" style="display: none;">
				<div id="div-header-report1">
					
				</div>
				<div class="table-responsive">
					<table id="table-report1" class="table table-striped table-bordered table-condensed table-hover">
						<thead>
							<th>Competencias</th>
							<th>Resultados de aprendizaje</th>
						    <th>Indicadores de logro</th>
						</thead>
						<tbody id="body-table-report1">
							
						</tbody>
					</table>	
				</div>
				<button style="font-size:15px; margin-left: 42%; margin-bottom: 1%" type="button" class="btn btn-info" onclick="javascript:window.imprimirReporte('div-report1');">Imprimir <i class="fa fa-print"></i></button>
			</div>
			<div id="div-report2" style="display: none;">
				<div id="div-header-report2">
					
				</div>
				<div class="table-responsive">
					<table id="table-report2" class="table table-striped table-bordered table-condensed table-hover">
						<thead>
							<th>Cursos</th>
							<th>Semestre</th>
							<th>Competencias</th>
						</thead>
						<tbody id="body-table-report2">
							
						</tbody>
					</table>
				</div>
				<button style="font-size:15px; margin-left: 42%; margin-bottom: 1%" type="button" class="btn btn-success" onclick="javascript:window.imprimirReporte('div-report2');">Imprimir <i class="fa fa-print"></i></button>
			</div>
			<div id="div-report3" style="display: none;">
				<div id="div-header-report3">
					
				</div>
				<div id="competencias">
					<H5 style="text-align: center;">A continuación se encuentran las competencias que se espera los estudiantes hayan adquirido al finalizar el curso.</H5>
				</div>
				<button style="font-size:15px; margin-left: 42%; margin-bottom: 1%" type="button" class="btn btn-warning" onclick="javascript:window.imprimirReporte('div-report3');">Imprimir <i class="fa fa-print"></i></button>
			</div>	
		</div>
	</div>
@endsection



<!-- Scripts -->
@section('scripts')
<!-- jQuery 2.1.4 -->
<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
<script type="text/javascript">

	start();
	function start(){
		document.getElementById("select-report").addEventListener("change", function(){
			document.getElementById("div-report1").style.display="none";
			document.getElementById("div-report2").style.display="none";
			document.getElementById("div-report3").style.display="none";
			var index_report = document.getElementById("select-report").selectedIndex;
			if(index_report == 1 || index_report == 3){
				var div_programas_report = document.getElementById("div-programas-report");
	            div_programas_report.style.display="none";
	            var div_semestres_report = document.getElementById("div-semestres-report");
	            div_semestres_report.style.display="none";
	            $('#select-cursos').empty();
				configurarCursos();
			}else if(index_report == 2){
				var div_cursos_report = document.getElementById("div-cursos-report");
	            div_cursos_report.style.display="none";
	            $('#select-programas').empty();
	            configurarProgramas();
			}
		});
	}

	function configurarCursos(){
		var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var response = this.responseText;
                var response_array = JSON.parse(response);
                var array_cursos = response_array['cursos'];
                var div_cursos_report = document.getElementById("div-cursos-report");
                div_cursos_report.style.display="table";
                var select_cursos = document.getElementById("select-cursos");
                var option = document.createElement("OPTION");
            	option.className = "option-curso-reporte";
            	option.innerHTML = "Seleccione";
            	select_cursos.appendChild(option);
                for(var i=0; i<array_cursos.length; i++){
                	option = document.createElement("OPTION");
                	option.className = "option-curso-reporte";
                	option.innerHTML = array_cursos[i]['codigo']+" - "+array_cursos[i]['nombre'];
                	select_cursos.appendChild(option);
                }
            }
        };
        xhttp.open("GET", "../reportes/cursos", true);
        xhttp.setRequestHeader("Content-type", "text/plain");
        xhttp.send();
	}

	function configurarProgramas(){
		var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var response = this.responseText;
                var response_array = JSON.parse(response);
                var array_cursos = response_array['programas'];
                var div_programas_report = document.getElementById("div-programas-report");
            	div_programas_report.style.display="table";
            	var div_semestres_report = document.getElementById("div-semestres-report");
	            div_semestres_report.style.display="table";
	            document.getElementById('select-semestres').selectedIndex = 0;
                var select_programas = document.getElementById("select-programas");
                var option = document.createElement("OPTION");
            	option.className = "option-programa-reporte";
            	option.innerHTML = "Seleccione";
            	select_programas.appendChild(option);
                for(var i=0; i<array_cursos.length; i++){
                	option = document.createElement("OPTION");
                	option.className = "option-programa-reporte";
                	option.innerHTML = array_cursos[i]['codigo']+" - "+array_cursos[i]['nombre'];
                	select_programas.appendChild(option);
                }
            }
        };
        xhttp.open("GET", "../reportes/programas", true);
        xhttp.setRequestHeader("Content-type", "text/plain");
        xhttp.send();
	}

	function getData(){
		var reporte = document.getElementById("select-report").selectedIndex;
		if(reporte == 0){
			alert("Seleccione un tipo de reporte");
			return false;
		}	
		var parametros;
		switch(reporte){
			case 1:
				if(document.getElementById("select-cursos").options.length < 1)
					return false;
				if(document.getElementById("select-cursos").selectedIndex == 0){
					alert("Seleccione un curso");
					return false;
				}
				var select_codigo = document.getElementById("select-cursos"); 
				var codigo_curso = select_codigo.options[select_codigo.selectedIndex].text.split(" - ")[0];
				parametros = "?reporte=1&codigo_curso="+codigo_curso;
				break;
			case 2:
				if(document.getElementById("select-programas").options.length < 1)
					return false;
				if(document.getElementById("select-programas").selectedIndex == 0){
					alert("Seleccione un programa");
					return false;
				}
				var selec_programa = document.getElementById("select-programas");
				var codigo_programa = selec_programa.options[selec_programa.selectedIndex].text.split(" - ")[0];
				var selec_semestre = document.getElementById("select-semestres").selectedIndex;
				parametros = "?reporte=2&codigo_programa="+codigo_programa+"&semestre="+selec_semestre;
				break;
			case 3:
				if(document.getElementById("select-cursos").options.length < 1)
					return false;
				if(document.getElementById("select-cursos").selectedIndex == 0){
					alert("Seleccione un curso");
					return false;
				}
				var select_codigo = document.getElementById("select-cursos"); 
				var codigo_curso = select_codigo.options[select_codigo.selectedIndex].text.split(" - ")[0];
				parametros = "?reporte=3&codigo_curso="+codigo_curso;
				break;
			default:
				break;
		}
		
		var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var response = this.responseText;
                var response_array = JSON.parse(response);
                switch(reporte){
                	case 1:
                		setReporte1(response_array);
                		break;
            		case 2:
            			setReporte2(response_array);
            			break;
        			case 3:
        				setReporte3(response_array);
        				break;
        			default:
        				break;
                }
            }
        };
        xhttp.open("GET", "../reportes/get_data"+parametros, true);
        xhttp.setRequestHeader("Content-type", "text/plain");
        xhttp.send();
        return false;
	}

	function setReporte1(data){
		document.getElementById("div-report1").style.display="inline";
		document.getElementById("div-report2").style.display="none";
		document.getElementById("div-report3").style.display="none";

		/*** Encabezado del reporte***/
        var header_report1 = document.getElementById("div-header-report1");
        while (header_report1.firstChild) {
		    header_report1.removeChild(header_report1.firstChild);
		}
		var curso = data['curso'];
		var h4 = document.createElement("H4");
		h4.innerHTML = "<u><strong>Reporte 1: Diseño Completo del Curso</strong></u>";
		header_report1.appendChild(h4);
		var h3 = document.createElement("H3");
        h3.innerHTML = "<strong>"+ curso['nombre']+" <i>("+curso['codigo']+")</i><strong>";
		h3.style.textAlign = 'center';
		header_report1.appendChild(h3);

        /*** Estructura del cuerpo del reporte***/
        var cuerpo_tabla = document.getElementById("body-table-report1");
        while (cuerpo_tabla.firstChild) {
		    cuerpo_tabla.removeChild(cuerpo_tabla.firstChild);
		}

        var array_comp = data['competencias'];
        for(var i=0; i<array_comp.length; i++){
        	var body_table_report1 = document.getElementById("body-table-report1");
        	var res_apren_array = array_comp[i]['resultados_aprendizaje'];
        	var fila_tabla = document.createElement("TR");
        	var td_competencia = document.createElement("TD");
			td_competencia.innerHTML = array_comp[i]['descripcion'];
			td_competencia.style.fontWeight="bold";
			fila_tabla.appendChild(td_competencia);
			fila_tabla.style.background = '#BAE4FF';
        	for(var j=0; j<res_apren_array.length; j++){
        		
        		if(j != 0){
        			fila_tabla = document.createElement("TR");

        			td_competencia = document.createElement("TD");
    				fila_tabla.appendChild(td_competencia);
					fila_tabla.style.background = '#CEECFF';
        		}

        		var td_ra = document.createElement("TD");
    			td_ra.innerHTML = res_apren_array[j]['descripcion'];

    			//Actividades de formación
        		var div_af_ra = document.createElement("DIV");
        		//Título
        		var titulo_h6 = document.createElement("H6");
				titulo_h6.style.fontWeight = 'bold';
            	titulo_h6.innerHTML = "Actividades de formación";
            	div_af_ra.appendChild(titulo_h6);

        		var a_f_list = document.createElement("UL");
        		var acti_form_array =  res_apren_array[j]['actividades_formacion'];
        		for(var k=0; k<acti_form_array.length; k++){
        			var a_f_item = document.createElement("LI");
        			a_f_item.innerHTML = acti_form_array[k]['name']+" : "+acti_form_array[k]['descripcion'];
        			a_f_list.appendChild(a_f_item);
        		}//fin for actividades formación
        		div_af_ra.appendChild(a_f_list);
        		td_ra.appendChild(div_af_ra);
				fila_tabla.appendChild(td_ra);

    			var indic_logro_array =  res_apren_array[j]['indicadores_logro'];
    			for(var k=0; k<indic_logro_array.length; k++){
    				if(k != 0){
    					fila_tabla = document.createElement("TR");

	        			td_competencia1 = document.createElement("TD");
	        			td_competencia2 = document.createElement("TD");
	    				fila_tabla.appendChild(td_competencia1);
	    				fila_tabla.appendChild(td_competencia2);
    				}

    				var td_il = document.createElement("TD");
        			td_il.innerHTML = indic_logro_array[k]['descripcion'];

    				//Actividades de evaluación
	        		var div_ae_il = document.createElement("DIV");
	        		//Título
	        		var titulo_h6 = document.createElement("H6");
					titulo_h6.style.fontWeight = 'bold';
	            	titulo_h6.innerHTML = "Actividades de evaluación";
	            	div_ae_il.appendChild(titulo_h6);
	        		var a_e_list = document.createElement("UL");
	        		var acti_eval_array = indic_logro_array[k]['actividades_evaluacion'];
	        		for(var l=0; l<acti_eval_array.length; l++){
	        			var a_e_item = document.createElement("LI");
	        			a_e_item.innerHTML = acti_eval_array[l]['name']+" : "+acti_eval_array[l]['descripcion'];
	        			a_e_list.appendChild(a_e_item);
	        		}//fin for actividades formación
	        		div_ae_il.appendChild(a_e_list);
	        		td_il.appendChild(div_ae_il);
        			fila_tabla.appendChild(td_il);
        			body_table_report1.appendChild(fila_tabla);
					body_table_report1.style.background = '#DAF1FF';

        		}//Fin for indicadores logro
        	}//Fin for resultados aprendizaje
		}//end for competencias
	}	

	function setReporte2(data){
		document.getElementById("div-report1").style.display="none";
		document.getElementById("div-report2").style.display="inline";
		document.getElementById("div-report3").style.display="none";

		/***********Encabezado del reporte 2 ************/
		var header_report2 = document.getElementById("div-header-report2");
        while (header_report2.firstChild) {
		    header_report2.removeChild(header_report2.firstChild);
		}
		var programa = data['programa'];
		var h4 = document.createElement("H4");
		h4.innerHTML = "<u><strong>Reporte 2: Competencias en un Programa Académico</strong></u>";
		header_report2.appendChild(h4);
		var h3 = document.createElement("H3");
		h3.innerHTML = "<strong>"+ programa['nombre']+" <i>("+programa['codigo']+")</i><strong>";
		h3.style.textAlign = 'center';
		header_report2.appendChild(h3);

		/***********Cuerpo del reporte 2 ****************/
		var cuerpo_tabla = document.getElementById("body-table-report2");
		while (cuerpo_tabla.firstChild) {
		    cuerpo_tabla.removeChild(cuerpo_tabla.firstChild);
		}
		var array_comp = data['competencias'];
		var semestre_actual = 0;
		var fila_tabla = document.createElement("TR");
		fila_tabla.style.background ='#D4FFDA';
		for(var i=0; i<array_comp.length; i++){
			if(array_comp[i]['num_semestre'] > semestre_actual){
				fila_tabla = document.createElement("TR");
				semestre_actual = array_comp[i]['num_semestre'];
				var td_competencia1 = document.createElement("TD");
				td_competencia1.innerHTML = array_comp[i]['codigo']+" "+array_comp[i]['nombre'];
				var td_competencia2 = document.createElement("TD");
				td_competencia2.innerHTML = semestre_actual;
				fila_tabla.appendChild(td_competencia1);
				fila_tabla.appendChild(td_competencia2);
				fila_tabla.style.background ='#D4FFDA';
			}else{
				fila_tabla = document.createElement("TR");
				var td_competencia1 = document.createElement("TD");
				var td_competencia2 = document.createElement("TD");
				fila_tabla.appendChild(td_competencia1);
				fila_tabla.appendChild(td_competencia2);
				fila_tabla.style.background ='#DFFFE4';
			}
			var td_competencia3 = document.createElement("TD");
			td_competencia3.innerHTML = array_comp[i]['descripcion'];
			fila_tabla.appendChild(td_competencia3);
			var body_table_report2 = document.getElementById("body-table-report2");
			body_table_report2.appendChild(fila_tabla);
			body_table_report2.style.background ='#DFFFE4';
		}
	}

	function setReporte3(data){
		document.getElementById("div-report1").style.display="none";
		document.getElementById("div-report2").style.display="none";
		document.getElementById("div-report3").style.display="inline";

        /*** Encabezado del reporte***/
        var header_report3 = document.getElementById("div-header-report3");
        while (header_report3.firstChild) {
		    header_report3.removeChild(header_report3.firstChild);
		}
		var curso = data['curso'];
		var h4 = document.createElement("H4");
		h4.innerHTML = "<u><strong>Reporte 3: Jerarquía de Competencias de un Curso</strong></u>";
		header_report3.appendChild(h4);
		var h3 = document.createElement("H3");
		h3.innerHTML = "<strong>"+ curso['nombre']+" <i>("+curso['codigo']+")</i><strong>";
		h3.style.textAlign = 'center';
        header_report3.appendChild(h3);

        /***Cuerpo del reporte***/
        var div_competencias = document.getElementById("competencias");
		div_competencias.style.background = '#FFF0BA';
        while (div_competencias.hasChildNodes()) {
		    div_competencias.removeChild(div_competencias.lastChild);
		}
       	var array_comp = data['competencias'];
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
			div_comp_desc.style.background = '#FFF0BA';
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
				div_r_a.style.marginRight = "1%";

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

        	//Div temporal para separar las competencias
        	div_competencias.appendChild(div_competencia);
        }//end for competencias
	}

	function imprimirReporte(id_div){
		var index;
		if(id_div == 'div-report1' || id_div == 'div-report3'){
			index = document.getElementById("select-cursos").selectedIndex;
		}else if(id_div == 'div-report2'){
			index = document.getElementById("select-programas").selectedIndex;
		}
		var index_report = document.getElementById("select-report").selectedIndex;
		var printContents = document.getElementById(id_div).innerHTML;
     	var originalContents = document.body.innerHTML;
     	document.body.innerHTML = printContents;
     	window.print();
     	document.body.innerHTML = originalContents;
     	document.getElementById("select-report").selectedIndex = index_report;
     	if(id_div == 'div-report1' || id_div == 'div-report3'){
			document.getElementById("select-cursos").selectedIndex = index;
		}else if(id_div == 'div-report2'){
			document.getElementById("select-programas").selectedIndex = index;
		}
     	start();
	}


</script>
@stop