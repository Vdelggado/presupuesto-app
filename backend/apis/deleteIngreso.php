<?php 
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json;charset=UTF-8");

require_once('../database/db.php');
require_once('objetos/ingresos.php');

$db = new DataBase();
$conn = $db->conexion();
$ingreso = new Ingresos($conn);
$data = json_decode(file_get_contents("php://input"));

echo $data->id;
if(
    !empty($data->id)
   ){
    $id= $data->id;
    if($ingreso->eliminarIngreso($id)){
        // asignar codigo de respuesta - 201 creado
        http_response_code(201);
        // informar al usuario
        echo json_encode(array("message" => "se elimino correctamente"));
        }
        // si no puede crear el producto, informar al usuario
        else{
        // asignar codigo de respuesta - 503 servicio no disponible
        http_response_code(503);
        // informar al usuario
        echo json_encode(array("message" => "No se puede crear el producto."));
        }
       
   }else{
     echo "estas bien feo programando";
   }



?>