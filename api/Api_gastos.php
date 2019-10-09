<?php

//Api.php

class API
{
	private $connect = '';

	function __construct()
	{
		$this->database_connection();
	}

	function database_connection()
	{
		$this->connect = new PDO("mysql:host=localhost;dbname=granja_db", "root", "");
	}

	function fetch_all()
	{
		$query = "SELECT * FROM gastos ORDER BY id_gastos;";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			while($row = $statement->fetch(PDO::FETCH_ASSOC))
			{
				$data[] = $row;
			}
			return $data;
		}
	}

	function insert()
	{
		if(isset($_POST["nro_documento"]))
		{
			$form_data = array(
				':nro_documento'		        =>	$_POST["nro_documento"],
				':fecha'		=>	$_POST["fecha"],
				':detalle'		=>	$_POST["detalle"],
				':importe'	=>	$_POST["importe"],
				':observacion'	=>	$_POST["observacion"]

			);
			$query = "
			INSERT INTO gastos
			(nro_documento,fecha,detalle,importe,observacion) VALUES 
			(:nro_documento,:fecha,:detalle,:importe,:observacion);
			";
			$statement = $this->connect->prepare($query);
			if($statement->execute($form_data))
			{
				$data[] = array(
					'success'	=>	'1'
				);
			}
			else
			{
				$data[] = array(
					'success'	=>	'0'
				);
			}
		}
		else
		{
			$data[] = array(
				'success'	=>	'0'
			);
		}
		return $data;
	}

	function fetch_single($id)
	{
		$query = "SELECT * FROM gastos where id_gastos='".$id."'";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			foreach($statement->fetchAll() as $row)
			{
				$data['id_gastos'] = $row['id_gastos'];
				$data['nro_documento'] = $row['nro_documento'];
				$data['fecha'] = $row['fecha'];
				$data['detalle'] = $row['detalle'];
				$data['importe'] = $row['importe'];
				$data['observacion'] = $row['observacion'];
			}
			return $data;
		}
	}

	function update()
	{
		if(isset($_POST["nro_documento"]))
		{
			$form_data = array(
				':nro_documento'		        =>	$_POST["nro_documento"],
				':fecha'		=>	$_POST["fecha"],
				':detalle'		=>	$_POST["detalle"],
				':importe'	=>	$_POST["importe"],
				':observacion'	=>	$_POST["observacion"],
				':id'	            =>	$_POST["hidden_id"]
			);
			$query = "
			UPDATE gastos 
			SET nro_documento = :nro_documento
				, fecha = :fecha 
				, detalle = :detalle 
				, importe = :importe  
				, observacion = :observacion 
			WHERE id_gastos = :id
			";
			$statement = $this->connect->prepare($query);
			if($statement->execute($form_data))
			{
				$data[] = array(
					'success'	=>	'1'
				);
			}
			else
			{
				$data[] = array(
					'success'	=>	'0'
				);
			}
		}
		else
		{
			$data[] = array(
				'success'	=>	'0'
			);
		}
		return $data;
	}
	function delete($id)
	{
		$query = "DELETE FROM gastos WHERE id_gastos = '".$id."'";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			$data[] = array(
				'success'	=>	'1'
			);
		}
		else
		{
			$data[] = array(
				'success'	=>	'0'
			);
		}
		return $data;
	}
}

?>