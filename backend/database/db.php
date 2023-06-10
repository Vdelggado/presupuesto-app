<?php 

class DataBase {

public $db;

function conexion (){

    $this->db = new mysqli('localhost:8082','root','','proyectoSemestral');
    if($this->db->connect_errno){
        echo "fallo al conectar a la base de datos".$this->db->connect_errno;
    }else {

        return $this->db;
    }

}

}

?>