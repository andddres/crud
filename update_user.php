<?php 
include('connection.php');
$tipo_documento_id = $_POST['tipo_documento_id'];
$numero_documento = $_POST['numero_documento'];
$nombre1 = $_POST['nombre1'];
$nombre2 = $_POST['nombre2'];
$apellido1 = $_POST['apellido1'];
$apellido2 = $_POST['apellido2'];
$genero_id = $_POST['genero_id'];
$departamento_id = $_POST['departamento_id'];
$municipio_id = $_POST['municipio_id'];
$id = $_POST['id'];

$sql = "UPDATE `paciente` SET  `tipo_documento_id`='$tipo_documento_id' , `numero_documento`= '$numero_documento', `nombre1`='$nombre1',  `nombre2`='$nombre2',
`apellido1`='$apellido1',`apellido2`='$apellido2',`genero_id`='$genero_id',`departamento_id`='$departamento_id',`municipio_id`='$municipio_id' WHERE id='$id'";
$query= mysqli_query($con,$sql);
$lastId = mysqli_insert_id($con);
if($query ==true)
{
   
    $data = array(
        'status'=>'true',
       
    );

    echo json_encode($data);
}
else
{
     $data = array(
        'status'=>'false',
      
    );

    echo json_encode($data);
} 

?>