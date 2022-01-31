<?php

namespace App\Models;

use App\Core\Model;

class Page extends Model{

    public function agregarConsulta($nombre, $apellido, $mail, $texto){
        $datos = $this->db->agregarConsulta($nombre, $apellido, $mail, $texto);
        return $datos;
    }

}
