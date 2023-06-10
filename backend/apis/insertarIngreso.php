<?php 
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json;charset=UTF-8");

require_once('../database/db.php');
require_once('objetos/ingresos.php');

$db = new DataBase();
$conn = $db->conexion();
$ingreso = new Ingresos($conn);

$data = json_decode(file_get_contents("php://input"));

if(
    !empty($data->monto) &&
    !empty($data->descripcion)
   ){
    $monto= $data->monto;
    $descrip = $data->descripcion;

    if($ingreso->crearIngreso($descrip,$monto)){
        // asignar codigo de respuesta - 201 creado
        http_response_code(201);
        // informar al usuario
        echo json_encode(array("message" => "El producto ha sido creado."));
        }
        // si no puede crear el producto, informar al usuario
        else{
        // asignar codigo de respuesta - 503 servicio no disponible
        http_response_code(503);
        // informar al usuario
        echo json_encode(array("message" => "No se puede crear el producto."));
        }
       
   }
   
?>