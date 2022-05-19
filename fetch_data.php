<?php include('connection.php');

$output= array();
$sql = "SELECT
paciente.id,
TIPOS_DOCUMENTO.nombre AS tipo_documento_id,
PACIENTE.numero_documento,
PACIENTE.nombre1,
PACIENTE.nombre2,
PACIENTE.apellido1,
PACIENTE.apellido2,
GENERO.nombre AS genero_id,
DEPARTAMENTOS.nombre AS departamento_id,
municipios.nombre AS municipio_id
FROM
paciente
INNER JOIN tipos_documento ON paciente.tipo_documento_id = tipos_documento.id
INNER JOIN genero ON paciente.genero_id = genero.id
INNER JOIN departamentos ON paciente.departamento_id = departamentos.id
INNER JOIN municipios ON paciente.municipio_id = municipios.id AND paciente.departamento_id = municipios.departamento_id";

$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
	0 => 'id',
	1 => 'tipo_documento_id',
	2 => 'numero_documento',
	3 => 'nombre1',
	4 => 'nombre2',
	5 => 'apellido1',
	6 => 'apellido2',
	7 => 'genero_id',
	8 => 'departamento_id',
	9 => 'municipio_id',

);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE numero_documento like '%".$search_value."%'";
	$sql .= " OR nombre1 like '%".$search_value."%'";
	$sql .= " OR nombre2 like '%".$search_value."%'";
	$sql .= " OR apellido1 like '%".$search_value."%'";
	$sql .= " OR apellido2 like '%".$search_value."%'";
}

if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
	$sql .= " ORDER BY id desc";
}

if($_POST['length'] != -1)
{
	$start = $_POST['start'];
	$length = $_POST['length'];
	$sql .= " LIMIT  ".$start.", ".$length;
}	

$query = mysqli_query($con,$sql);
$count_rows = mysqli_num_rows($query);
$data = array();
while($row = mysqli_fetch_assoc($query))
{
	$sub_array = array();
	$sub_array[] = '<a href="javascript:void();" data-id="'.$row['id'].'"  class="btn btn-info btn-sm editbtn" >Edit</a>  <a href="javascript:void();" data-id="'.$row['id'].'"  class="btn btn-danger btn-sm deleteBtn" >Delete</a>';
	$sub_array[] = $row['id'];
	$sub_array[] = $row['tipo_documento_id'];
	$sub_array[] = $row['numero_documento'];
	$sub_array[] = $row['nombre1'];
	$sub_array[] = $row['nombre2'];
	$sub_array[] = $row['apellido1'];
	$sub_array[] = $row['apellido2'];
	$sub_array[] = $row['genero_id'];
	$sub_array[] = $row['departamento_id'];
	$sub_array[] = $row['municipio_id'];
	$data[] = $sub_array;
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);
