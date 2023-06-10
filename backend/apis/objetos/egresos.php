<?php
require_once('../database/db.php');
class Egresos {
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    
     function leer(){
            $instruccion = "CALL sp_mostrarEgresos()";
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
    
     function crearEgreso ($descripcion,$monto){
        $instruccion = "CALL sp_insertar_egreso('$descripcion','$monto')";
            $consulta = $this->conn->query($instruccion);
            if(!$consulta){
                echo "no hay registros";
            }else{
                return $consulta;
                $this->conn->close();
            }
     }
    
     function eliminarEgreso ($id){
        $instruccion = "CALL sp_eliminar_egreso('$id')";
            $consulta = $this->conn->query($instruccion);
            if(!$consulta){
                echo "el registro no existe";
            }else{
                return $consulta;
                $this->conn->close();
            }
     }
}
?>