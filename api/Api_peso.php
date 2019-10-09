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
		$query = "SELECT * FROM peso ORDER BY id_peso;";
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
		if(isset($_POST["fecha"]))
		{
			$form_data = array(
				':fecha'		        =>	$_POST["fecha"],
				':peso'		=>	$_POST["peso"],
				':uni_medida'		=>	$_POST["uni_medida"]

			);
			$query = "
			INSERT INTO peso
			(fecha,peso,uni_medida) VALUES 
			(:fecha,:peso,:uni_medida);
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
		$query = "SELECT * FROM peso where id_peso='".$id."'";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			foreach($statement->fetchAll() as $row)
			{
				$data['id_peso'] = $row['id_peso'];
				$data['fecha'] = $row['fecha'];
				$data['peso'] = $row['peso'];
				$data['uni_medida'] = $row['uni_medida'];
				
			}
			return $data;
		}
	}

	function update()
	{
		if(isset($_POST["fecha"]))
		{
			$form_data = array(
				':fecha'		=>	$_POST["fecha"],
				':peso'		=>	$_POST["peso"],
				':uni_medida'	=>	$_POST["uni_medida"],
				':id'	            =>	$_POST["hidden_id"]
			);
			$query = "
			UPDATE peso 
			SET fecha = :fecha
				, peso = :peso 
				, uni_medida = :uni_medida 
			WHERE id_peso = :id
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
		$query = "DELETE FROM peso WHERE id_peso = '".$id."'";
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