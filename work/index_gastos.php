<!DOCTYPE html>
<html>
	<head>
		<title>DATOS GASTOS</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">
			<br />
			
			<h3 align="center">ADMINISTRADOR DATOS GASTOS</h3>
			<br />
			<div align="right" style="margin-bottom:5px;">
				<button type="button" name="add_button" id="add_button" class="btn btn-success btn-xs">Add</button>
			</div>

			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>NRO DOCUMENTO</th>
							<th>FECHA</th>
							<th>DETALLE</th>
							<th>IMPORTE</th>
							<th>OBSERVACION</th>
							<th>MODIFICAR</th>
							<th>ELIMINAR</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</body>
</html>

<div id="apicrudModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" id="api_crud_form">
				<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        	<h4 class="modal-title">Datos Gastos</h4>
		      	</div>
		      	<div class="modal-body">
		      		<div class="form-group">
			        	<label>nro documento</label>
			        	<input type="text" name="nro_documento" id="nro_documento" class="form-control" />
			        </div>
			        <div class="form-group">
			        	<label>fecha</label>
			        	<input type="date" name="fecha" id="fecha" class="form-control" />
			        </div>
					<div class="form-group">
			        	<label>detalle</label>
			        	<input type="text" name="detalle" id="detalle" class="form-control" />
			        </div>
					<div class="form-group">
			        	<label>importe</label>
			        	<input type="text" name="importe" id="importe" class="form-control" />
			        </div>
					<div class="form-group">
			        	<label>observacion</label>
			        	<input type="text" name="observacion" id="observacion" class="form-control" />
			        </div>
			    </div>
			    <div class="modal-footer">
			    	<input type="hidden" name="hidden_id" id="hidden_id" />
			    	<input type="hidden" name="action" id="action" value="insert" />
			    	<input type="submit" name="button_action" id="button_action" class="btn btn-info" value="Insert" />
			    	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      		</div>
			</form>
		</div>
  	</div>
</div>


<script type="text/javascript">
$(document).ready(function(){

	fetch_data();

	function fetch_data()
	{
		$.ajax({
			url:"fetch_gastos.php",
			success:function(data)
			{
				$('tbody').html(data);
			}
		})
	}

	$('#add_button').click(function(){
		$('#action').val('insert');
		$('#button_action').val('Insert');
		$('.modal-title').text('DATOS GASTOS');
		$('#apicrudModal').modal('show');
	});

	$('#api_crud_form').on('submit', function(event){
		event.preventDefault();
		if($('#nro_documento').val() == '')
		{
			alert("Ingresar nro_documento");
		}
		else if($('#fecha').val() == '')
		{
			alert("Ingrese fecha ");
		}
		else if($('#detalle').val() == '')
		{
			alert("Ingresar detalle");
		}
		else if($('#importe').val() == '')
		{
			alert("Ingrese importe");
		}
		else if($('#observacion').val() == '')
		{
			alert("Ingresar observacion");
		}
		else
		{
			var form_data = $(this).serialize();
			$.ajax({
				url:"action_gastos.php",
				method:"POST",
				data:form_data,
				success:function(data)
				{
					fetch_data();
					$('#api_crud_form')[0].reset();
					$('#apicrudModal').modal('hide');
					if(data == 'insert')
					{
						alert("Data Inserted using PHP API");
					}
					if(data == 'update')
					{
						alert("Data Updated using PHP API");
					}
				}
			});
			console.info("luego de ajax")
		}
	});

	$(document).on('click', '.edit', function(){
		var id = $(this).attr('id');
		var action = 'fetch_single';
		$.ajax({
			url:"action_gastos.php",
			method:"POST",
			data:{id:id, action:action},
			dataType:"json",
			success:function(data)
			{
				$('#hidden_id').val(data.id_gastos);
				$('#nro_documento').val(data.nro_documento);
				$('#fecha').val(data.fecha);
				$('#detalle').val(data.detalle);
				$('#importe').val(data.importe);
				$('#observacion').val(data.observacion);
				$('#action').val('update');
				$('#button_action').val('Update');
				$('.modal-title').text('Modificar Datos Gastos');
				$('#apicrudModal').modal('show');
			}
		})
	});

	$(document).on('click', '.delete', function(){
		var id = $(this).attr("id");
		var action = 'delete';
		if(confirm("Esta seguro de eliminar el Dato"))
		{
			$.ajax({
				url:"action_gastos.php",
				method:"POST",
				data:{id:id, action:action},
				success:function(data)
				{
					fetch_data();
					alert("Data Deleted using PHP API");
				}
			});
		}
	});

});
</script>