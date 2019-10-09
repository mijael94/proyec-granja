<?php

//fetch.php

$api_url = "http://localhost/granja/api/test_api_medicina.php?action=fetch_all";

$client = curl_init($api_url);

curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($client);

$result = json_decode($response);

$output = '';

if(count($result) > 0)
{
	foreach($result as $row)
	{
		$output .= '
		<tr>
			<td>'.$row->cod_medicina.'</td>
			<td>'.$row->fecha_llegada.'</td>
			<td>'.$row->cantidad.'</td>
			<td>'.$row->descripcion_med.'</td>
			<td>'.$row->fecha_venc.'</td>
			<td>'.$row->precio.'</td>
			<td><button type="button" name="edit" class="btn btn-warning btn-xs edit" id="'.$row->id_medicina.'">Edit</button></td>
			<td><button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row->id_medicina.'">Delete</button></td>
		</tr>
		';
	}
}
else
{
	$output .= '
	<tr>
		<td colspan="7" align="center">No Data Found</td>
	</tr>
	';
}

echo $output;

?>