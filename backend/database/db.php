<?php 

class DataBase {

public $db;

function conexion (){

    $this->db = new mysqli('','','','');
    if($this->db->connect_errno){
        echo "fallo al conectar a la base de datos".$this->db->connect_errno;
    }else {

        return $this->db;
    }

}

}

?>