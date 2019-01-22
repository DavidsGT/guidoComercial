<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$venta->idventa}}">
	
	{!! Form::open(array('action'=>array('FacturaController@destroy',$venta->idventa),'method'=>'delete')) !!}

<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="close">
				<span aria-hidden="true">x</span>
			</button>
			<h4 class="modal-title">Recaudar Valores</h4>

		</div>
		<div class="modal-body">
			<p>Ingrese los valores a Recaudar</p>

  <div class="row">
		<div class="col-lg-5 col-mg-5 col-sg-5 col-xs-12">
			<div class="form-group">
				<label for="vendedor">Valor a facturar</label>
				<input type="text" readonly="" name="valfactu" id="valfactu" value="{{ $venta->total_venta + $venta->impuesto }}" class="form-control">	
			</div>
		</div>
		<div class="col-lg-5 col-mg-5 col-sg-5 col-xs-12">
			<div class="form-group">
				<label for="">Valor a Reacudar</label>
				<input type="number" name="valreca" id="valreca" value="" required="" class="form-control" placeholder="Valor a Reacudar....">	
			</div>
		</div>
		<div class="col-lg-5 col-mg-5 col-sg-5 col-xs-12">
			<div class="form-group">
				<label for="cambio">Su cambio es:</label>
				<input type="text" readonly="" name="valcambio" id="valcambio" value="" class="form-control" placeholder="Su cambio es....">	
			</div>
		</div>
		</div>
	</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary">Confirmar</button>
		</div>		
	</div>
</div>
	
@push ('scripts')
<script>

 $(document).ready(function () {
 
          $("#valreca").keyup(function () {
              var value = $(this).val();
             // alert(value);
              var valor2 = $("#valfactu").val();
              var cambio =  Math.round((parseFloat(value) - parseFloat(valor2))*100)/100;
             $("#valcambio").val(cambio);
              
          });
      });

</script>
@endpush

{!! Form::close()!!}
</div>
