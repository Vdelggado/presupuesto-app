<?php 
require_once('../database/db.php');
class Ingresos{
    private $conn;

public function __construct($db)
{
    $this->conn = $db;
}

 function leer(){
        $instruccion = "CALL sp_mostrarIngresos()";
        $consulta = $this->conn->query($instruccion);
        $resultado = $consulta->fetch_all(MYSQLI_ASSOC);
        if(!$consulta){
            echo "no hay registros";
        }else{
            return $resultado;
            $resultado->close();
            $this->conn->close();
        }
 }

 function crearIngreso ($descripcion,$monto){
    $instruccion = "CALL sp_insertar_ingreso('$descripcion','$monto')";
        $consulta = $this->conn->query($instruccion);
        if(!$consulta){
            echo "no hay registros";
        }else{
            return $consulta;
            $this->conn->close();
        }
 }

 function eliminarIngreso ($id){
    
    $instruccion = "CALL sp_eliminar_ingreso('$id')";
        $consulta = $this->conn->query($instruccion);
        if(!$consulta){
            echo "el registro no existe";
        }else{
            return $consulta;
            $this->conn->close();
        }
 }



 function presupuestoTotal(){
    $valor = $this->leer();
    $total = 0;
    foreach($valor as $dato){
        $total += $dato['monto'];
    }

    return $total;
 }
}
?>