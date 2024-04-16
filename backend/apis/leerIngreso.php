<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json;charset=UTF-8");

require_once('../database/db.php');
require_once('objetos/ingresos.php');

$db = new DataBase();
$conn = $db->conexion();
$ingreso = new  Ingresos($conn);

$datos = $ingreso->leer();
if($datos){
  
$nfilas = count($datos);

if($nfilas>0){
    $products_arr=array();
    $products_arr["records"]=array();
    foreach($datos as $resultado){
        extract($resultado);
        $ingreArr = array(
            "id"=> $id,
            "descripcion"=>$descripcion,
            "monto" => $monto
        );

        array_push($products_arr['records'],$ingreArr);
    }

//asignarcodigoderespuesta-200OK
http_response_code(200);
//mostrarproductosenformatojson 
echo json_encode($products_arr);


}


}else{

    //asignarcodigoderespuesta-404Noencontrado
    http_response_code(404);
    //informarlealusuarioquenoseencontraronproductos
    echo json_encode(array("message"=>"Nose encontraron productos."));
}

?>