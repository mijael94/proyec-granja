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
		$query = "SELECT * FROM medicina ORDER BY id_medicina;";
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
		if(isset($_POST["cod_medicina"]))
		{
			$form_data = array(
				':cod_medicina'		        =>	$_POST["cod_medicina"],
				':fecha_llegada'		=>	$_POST["fecha_llegada"],
				':cantidad'		=>	$_POST["cantidad"],
				':descripcion_med'	=>	$_POST["descripcion_med"],
				':fecha_venc'	=>	$_POST["fecha_venc"],
				':precio'	=>	$_POST["precio"]

			);
			$query = "
			INSERT INTO medicina
			(cod_medicina,fecha_llegada,cantidad,descripcion_med,fecha_venc,precio) VALUES 
			(:cod_medicina,:fecha_llegada,:cantidad,:descripcion_med,:fecha_venc,:precio);
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
		$query = "SELECT * FROM medicina where id_medicina='".$id."'";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			foreach($statement->fetchAll() as $row)
			{
				$data['id_medicina'] = $row['id_medicina'];
				$data['cod_medicina'] = $row['cod_medicina'];
				$data['fecha_llegada'] = $row['fecha_llegada'];
				$data['cantidad'] = $row['cantidad'];
				$data['descripcion_med'] = $row['descripcion_med'];
				$data['fecha_venc'] = $row['fecha_venc'];
				$data['precio'] = $row['precio'];
			}
			return $data;
		}
	}

	function update()
	{
		if(isset($_POST["cod_medicina"]))
		{
			$form_data = array(
				':cod_medicina'		        =>	$_POST["cod_medicina"],
				':fecha_llegada'		=>	$_POST["fecha_llegada"],
				':cantidad'		=>	$_POST["cantidad"],
				':descripcion_med'	=>	$_POST["descripcion_med"],
				':fecha_venc'	=>	$_POST["fecha_venc"],
				':precio'	=>	$_POST["precio"],
				':id'	            =>	$_POST["hidden_id"]
			);
			$query = "
			UPDATE medicina 
			SET cod_medicina = :cod_medicina
				, fecha_llegada = :fecha_llegada 
				, cantidad = :cantidad  
				, descripcion_med = :descripcion_med 
				, fecha_venc = :fecha_venc
				, precio = :precio
			WHERE id_medicina = :id
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
		$query = "DELETE FROM medicina WHERE id_medicina = '".$id."'";
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