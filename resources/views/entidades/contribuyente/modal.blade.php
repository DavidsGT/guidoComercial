<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$per->id}}">
	{!! Form::open(array('action'=>array('ContribuyenteController@destroy',$per->id),'method'=>'delete')) !!}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true">x</span>
				</button>
				<h4 class="modal-title">Eliminar Contribuyente</h4>

			</div>
			<div class="modal-body">
				<p>Confirme si desea Eliminar el Contribuyente</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Confirmar</button>
			</div>		
		</div>
	</div>
	{!! Form::close()!!}
</div>
<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-details-{{$per->id}}">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true">x</span>
				</button>
				<h4 class="modal-title">DETALLEES DEL CONTRIBUYENTE</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
						<div class="form-group">
							<b>Ruc: </b><br>
							{{$per->ruc}}
						</div>
					</div>
					<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
						<div class="form-group">
							<b>Razon Social: </b><br>
							{{$per->razon_social}}
						</div>
					</div>
					<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
						<div class="form-group">
							<b>Codigo de Establecimiento: </b><br>
							{{$per->cod_establecimiento}}
						</div>
					</div>
					<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
						<div class="form-group">
							<b>Tipo de Emision: </b><br>
							{{$per->tipo_emision}}
						</div>
					</div>
					<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
						<div class="form-group">
							<b>Codigo de Emision: </b><br>
							{{$per->cod_emision}}
						</div>
					</div>
					<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
						<div class="form-group">
							<b>Dirección Matriz :</b><br>
							{{$per->direccion_matriz}}
						</div>
					</div>
					<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
						<div class="form-group">
							<b>Teléfono: </b><br>
							{{$per->telefono}}
						</div>
					</div>
					<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
						<div class="form-group">
							<b>E-mail: </b><br>
							{{$per->email}}
						</div>
					</div>
					<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
						<div class="form-group">
							<b>Tipo Doc. del Representante: </b><br>
							{{$per->tipo_doc}}
						</div>
					</div>
					<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
						<div class="form-group">
							<b>Num. Doc. del Representante: </b><br>
							{{$per->num_documento}}
						</div>
					</div>
					<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
						<div class="form-group">
							<b>Ruc Contador: </b><br>
							{{$per->ruc_contador}}
						</div>
					</div>
					<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
						<div class="form-group">
							<b>Lleva Contabilidad?: </b><br>
							@if ($per->lleva_contabilidad == 1)
								Si
							@else
								No
							@endif
						</div>
					</div>
					<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
						<div class="form-group">
							<b>Tipo de Ambiente: </b><br>
							{{$per->tipo_ambiente}}
						</div>
					</div>
					<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
						<div class="form-group">
							<b>Tiempo Máximo de Espera: </b><br>
							{{$per->tiempo_max_espera}}
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>		
		</div>
	</div>
</div>