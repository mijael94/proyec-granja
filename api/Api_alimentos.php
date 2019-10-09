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
		$query = "SELECT * FROM alimentos ORDER BY id_alimentos;";
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
		if(isset($_POST["cod_alimento"]))
		{
			$form_data = array(
				':cod_alimento'		        =>	$_POST["cod_alimento"],
				':hora'		=>	$_POST["hora"],
				':cantidad'		=>	$_POST["cantidad"],
				':producto'	=>	$_POST["producto"],
				':fecha_venc'	=>	$_POST["fecha_venc"],
				':precio'	=>	$_POST["precio"]

			);
			$query = "
			INSERT INTO alimentos
			(cod_alimento,hora,cantidad,producto,fecha_venc,precio) VALUES 
			(:cod_alimento,:hora,:cantidad,:producto,:fecha_venc,:precio);
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
		$query = "SELECT * FROM alimentos where id_alimentos='".$id."'";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			foreach($statement->fetchAll() as $row)
			{
				$data['id_alimentos'] = $row['id_alimentos'];
				$data['cod_alimento'] = $row['cod_alimento'];
				$data['hora'] = $row['hora'];
				$data['cantidad'] = $row['cantidad'];
				$data['producto'] = $row['producto'];
				$data['fecha_venc'] = $row['fecha_venc'];
				$data['precio'] = $row['precio'];
			}
			return $data;
		}
	}

	function update()
	{
		if(isset($_POST["cod_alimento"]))
		{
			$form_data = array(
				':cod_alimento'		        =>	$_POST["cod_alimento"],
				':hora'		=>	$_POST["hora"],
				':cantidad'		=>	$_POST["cantidad"],
				':producto'	=>	$_POST["producto"],
				':fecha_venc'	=>	$_POST["fecha_venc"],
				':precio'	=>	$_POST["precio"],
				':id'	            =>	$_POST["hidden_id"]
			);
			$query = "
			UPDATE alimentos 
			SET cod_alimento = :cod_alimento
				, hora = :hora 
				, cantidad = :cantidad 
				, producto = :producto  
				, fecha_venc = :fecha_venc 
				, precio = :precio 
			WHERE id_alimentos = :id
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
		$query = "DELETE FROM alimentos WHERE id_alimentos = '".$id."'";
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