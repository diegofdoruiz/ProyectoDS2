<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$rol->codigo}}">
	{{Form::Open(array('action'=>array('RolController@destroy', $rol->codigo), 'method'=>'DELETE'))}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">x</span>
			</button>
			<h4 class="modal-title"></h4>
		</div>
		<div class="modal-body">
			<p>Comfirme si desea eliminar el rol {{$rol->rol}}</p>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary">Confirmar</button>
		</div>	
		</div>
	</div>
	{{Form::close()}}
</div>