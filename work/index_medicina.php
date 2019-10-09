

<!DOCTYPE html>
<html>
	<head>
		<title>DATOS MEDICINA</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">
			<br />
			
			<h3 align="center">ADMINISTRADOR DATOS MEDICINA</h3>
			<br />
			<div align="right" style="margin-bottom:5px;">
				<button type="button" name="add_button" id="add_button" class="btn btn-success btn-xs">Add</button>
			</div>

			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>COD MEDICINA</th>
							<th>FECHA LLEGADA</th>
							<th>CANTIDAD</th>
							<th>DESCRIPCION MEDICINA</th>
							<th>FECHA VENCIMIENTO</th>
							<th>PRECIO</th>
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
		        	<h4 class="modal-title">Datos Medicina</h4>
		      	</div>
		      	<div class="modal-body">
		      		<div class="form-group">
			        	<label>codigo medicina</label>
			        	<input type="text" name="cod_medicina" id="cod_medicina" class="form-control" />
			        </div>
			        <div class="form-group">
			        	<label>fecha llegada</label>
			        	<input type="date" name="fecha_llegada" id="fecha_llegada" class="form-control" />
			        </div>
					<div class="form-group">
			        	<label>cantidad</label>
			        	<input type="text" name="cantidad" id="cantidad" class="form-control" />
			        </div>
					<div class="form-group">
			        	<label>descripcion medicina</label>
			        	<input type="text" name="descripcion_med" id="descripcion_med" class="form-control" />
			        </div>
					<div class="form-group">
			        	<label>fecha vencimiento</label>
			        	<input type="date" name="fecha_venc" id="fecha_venc" class="form-control" />
			        </div>
					<div class="form-group">
			        	<label>precio</label>
			        	<input type="text" name="precio" id="precio" class="form-control" />
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
			url:"fetch_medicina.php",
			success:function(data)
			{
				$('tbody').html(data);
			}
		})
	}

	$('#add_button').click(function(){
		$('#action').val('insert');
		$('#button_action').val('Insert');
		$('.modal-title').text('DATOS MEDICINA');
		$('#apicrudModal').modal('show');
	});

	$('#api_crud_form').on('submit', function(event){
		event.preventDefault();
		if($('#cod_medicina').val() == '')
		{
			alert("Ingresar cod_medicina");
		}
		else if($('#fecha_llegada').val() == '')
		{
			alert("Ingrese fecha_llegada ");
		}
		else if($('#cantidad').val() == '')
		{
			alert("Ingresar cantidad");
		}
		else if($('#descripcion_med').val() == '')
		{
			alert("Ingrese descripcion_med");
		}
		else if($('#fecha_venc').val() == '')
		{
			alert("Ingresar fecha_venc");
		}
		else if($('#precio').val() == '')
		{
			alert("Ingresar precio");
		}
		else
		{
			var form_data = $(this).serialize();
			$.ajax({
				url:"action_medicina.php",
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
			url:"action_medicina.php",
			method:"POST",
			data:{id:id, action:action},
			dataType:"json",
			success:function(data)
			{
				$('#hidden_id').val(data.id_medicina);
				$('#cod_medicina').val(data.cod_medicina);
				$('#fecha_llegada').val(data.fecha_llegada);
				$('#cantidad').val(data.cantidad);
				$('#descripcion_med').val(data.descripcion_med);
				$('#fecha_venc').val(data.fecha_venc);
				$('#precio').val(data.precio);
				$('#action').val('update');
				$('#button_action').val('Update');
				$('.modal-title').text('Modificar Datos Medicina');
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
				url:"action_medicina.php",
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