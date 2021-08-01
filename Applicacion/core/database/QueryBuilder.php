<?php

namespace App\Core\Database;

use PDO;
use Exception;

class QueryBuilder{
    /**
     * The PDO instance.
     *
     * @var PDO
     */
    protected $pdo;

    /**
     * Create a new QueryBuilder instance.
     *
     * @param PDO $pdo
     */
    public function __construct($pdo, $logger = null){
        $this->pdo = $pdo;
        $this->logger = ($logger) ? $logger : null;
    }

    /**
     * Select all records from a database table.
     *
     * @param string $table
     */
    public function selectAll($table){
        $statement = $this->pdo->prepare(
            "SELECT * FROM {$table}"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Insert a record into a table.
     *
     * @param  string $table
     * @param  array  $parameters
     */
    public function insert($table, $parameters){
        $parameters = $this->cleanParameterName($parameters);
        $sql = sprintf(
            'insert into %s (%s) values (%s)',
            $table,
            implode(', ', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
        );

        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute($parameters);
        } catch (Exception $e) {
            $this->sendToLog($e);
        }
    }

    private function sendToLog(Exception $e){
        if ($this->logger) {
            $this->logger->error('Error', ["Error" => $e]);
        }
    }

    /**
     * Limpia guiones - que puedan venir en los nombre de los parametros
     * ya que esto no funciona con PDO
     *
     * Ver: http://php.net/manual/en/pdo.prepared-statemensssts.php#97162
     */
    private function cleanParameterName($parameters){
        $cleaned_params = [];
        foreach ($parameters as $name => $value) {
            $cleaned_params[str_replace('-', '', $name)] = $value ;
        }
        return $cleaned_params;
    }


    public function validarLogin($usuario ,$password){
        $statement = $this->pdo->prepare(
            "SELECT count(*) as cuenta FROM usuarios
            WHERE mail='$usuario' AND password='$password'"
        );
        $statement->execute();
        return $statement->fetchColumn();
    }

    public function agregarUsuario($mail ,$nombreUsuario ,$nombre ,$apellido ,$pais ,$telefono,$password,$path_img){
        $statement = $this->pdo->prepare("INSERT INTO  usuarios (mail,nombreUsuario,nombre,apellido,pais,telefono,password,fotoPerfil) VALUES ('$mail' ,'$nombreUsuario' ,'$nombre' ,'$apellido','$pais' ,'$telefono','$password', '$path_img')");
        $statement->execute();
        if($statement->rowCount() > 0){
            return 1;
        }else{
            return 0;
        }
    }

    public function agregarConsulta($nombre ,$apellido ,$mail ,$ftexto){
        $statement = $this->pdo->prepare("INSERT INTO  consultas (mail,nombre,apellido,mensaje) VALUES ('$mail','$nombre' ,'$apellido','$ftexto' )");
        $statement->execute();
        if($statement->rowCount() > 0){
            return 1;
        }else{
            return 0;
        }
    }


public function selectSitio($idSitio){
    /*
    $statement = $this->pdo->prepare("SELECT idsitio, nombre, descripcion, telefono, sitioweb, valoracionPrecio,
     valoracionAmbiente, valoracionServicio FROM sitio WHERE idSitio= $idSitio");

    */
    $statement = $this->pdo->prepare("SELECT * FROM sitios WHERE idSitio= $idSitio");
     $statement->execute();
     
    return $statement->fetchAll(PDO::FETCH_CLASS);
}

public function selectUbicacion($idSitio){
    $statement = $this->pdo->prepare("SELECT idUbicacion, direccion, ciudad, provincia, x, y FROM ubicacion
     WHERE idSitio = $idSitio");
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_CLASS);
}
 
public function selectHorarios($idSitio){
    $statement = $this->pdo->prepare("SELECT h.idDia, h.HDesde, h.HHasta, sd.nombre FROM horario h INNER JOIN semanasdias sd ON h.idDia=sd.idDia  WHERE idSitio = $idSitio");
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_CLASS);
}

public function selectMediosPagos($idListaMedios){
    $statement = $this->pdo->prepare("SELECT mp.idMedio, mp.nombre,mp.coutas
    FROM listamediospagos lmp 
    INNER JOIN mediospago mp  ON  lmp.idMedio=mp.idMedio
    WHERE lmp.idListaPagos = $idListaMedios");
$statement->execute();
return $statement->fetchAll(PDO::FETCH_CLASS);
} 


public function selectListaCaractSitio($idSitio){ 
    $statement = $this->pdo->prepare("SELECT cs.nombre FROM listacaractsitio lcs 
         INNER JOIN caracteristicasitio cs  ON  lcs.idCaract = cs.idCaracteristica 
         WHERE lcs.idSitio = $idSitio");
    $statement->execute();
    
    return $statement->fetchAll(PDO::FETCH_CLASS );
}

public function selectImagenesSitio($idSitio){ 
    $statement = $this->pdo->prepare("SELECT cs.idImagen, cs.path
     FROM  imagenessitios cs WHERE cs.idSitio = $idSitio");
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_CLASS);
}


public function selectValoracionSitio($idSitio){ 
    $statement = $this->pdo->prepare
    ("SELECT avg(cs.valoracionSabor) as valoracionSabor,avg( cs.valoracionPrecio)as valoracionPrecio,
    avg(cs.valoracionAmbiente)as valoracionAmbiente  FROM comentariositios cs WHERE cs.idsitio = $idSitio");
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_CLASS);
}

public function selectAllComentarios($idSitio,$offset,$per_page){ 
    $statement = $this->pdo->prepare
    ("SELECT cs.nombre, cs.descripcion,cs.fecha,cs.valoracionSabor,
                cs.valoracionPrecio,cs.valoracionAmbiente
         FROM comentariositios cs WHERE cs.idsitio = $idSitio LIMIT $offset, $per_page");
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_CLASS);
}

public function selectAllPlatos($idSitio,$offset, $per_page){ 
    //$statement = $this->pdo->prepare(" SELECT p.idPlato, p.nombre, p.precio, ip.path FROM platos p 
    //INNER JOIN imagenesplatos ip on p.idPlato=ip.idPlato WHERE p.idSitio=$idSitio LIMIT $offset, $per_page" );
     $statement = $this->pdo->prepare(" SELECT p.idPlato, p.nombre, p.precio, ip.path FROM platos p 
     INNER JOIN imagenesplatos ip ON p.idPlato= ip.idPlato 
      WHERE p.idSitio=$idSitio ORDER BY p.idPlato  LIMIT $offset, $per_page" );
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_CLASS);
}

public function getPages($idSitio,$tabla){ 
    $total_pages_sql =  $this->pdo->prepare(" SELECT count(*) 
    FROM $tabla p WHERE p.idSitio=$idSitio" );
    $total_pages_sql->execute();
    return $total_pages_sql->fetchColumn();
}

public function getPagesAllSitios(){ 
    $total_pages_sql =  $this->pdo->prepare("SELECT count(*)  FROM sitios s " );
    $total_pages_sql->execute();
    return $total_pages_sql->fetchColumn();
}


public function getCategorias(){ 
    $statement =  $this->pdo->prepare("SELECT * 
    FROM categorias" );
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_CLASS);
}

public function selectImagenPlato($idPlato){
    $statement = $this->pdo->prepare
    ("SELECT p.path
     FROM imagenesplatos p WHERE p.idPlato = $idPlato ");
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_CLASS);
}


public function selectPlato($idSitio,$idPlato){ 
    $statement = $this->pdo->prepare
    ("SELECT p.nombre, p.descripcion, p.precio
     FROM platos p WHERE p.idPlato = $idPlato and p.idSitio = $idSitio");
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_CLASS);
}


//recuperar ListaInfo de plato X
public function selectListaInfo($idListaInfo){ 
    $statement = $this->pdo->prepare( "SELECT inf.nombre, vn.valor FROM  listainfo li 
     INNER JOIN valornutricional vn  ON  li.idValor = vn.idValor 
     INNER JOIN infonutricional inf  ON  vn.idInfo = inf.idInfo
     WHERE li.idListaInfo = $$idListaInfo");
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_CLASS);
}

//recuperar ListaCaract de plato X
public function selectListaCaract($idPlato){
    $statement = $this->pdo->prepare("SELECT cs.nombre FROM listacaractplato lcs 
    INNER JOIN caracteristicaplato cs  ON  lcs.idCaract = cs.idCaracteristica 
    WHERE lcs.idPlato = $idPlato");
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_CLASS);
}

//recuperar ListaCaract de plato X
public function selectInfo($idPlato){ 
    $statement = $this->pdo->prepare("SELECT i.nombre,v.valor FROM valornutricional v 
    INNER JOIN infonutricional i  ON  i.idInfo = v.idInfo 
    WHERE v.idPlato = $idPlato");
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_CLASS);
}

public function selectDestacados(){ 
    $statement = $this->pdo->prepare("SELECT  s.idSitio,s.nombre,u.ciudad, u.provincia,count(idComentario)
    as Ncomentarios, i.path FROM sitios s INNER JOIN comentariositios cs ON  s.idSitio = cs.idSitio
    INNER JOIN ubicacion u  ON  s.idSitio = u.idSitio
    RIGHT JOIN imagenessitios i ON  s.idSitio = i.idSitio
    GROUP BY idSitio  LIMIT 0, 9");
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_CLASS);
}

public function selectCerca(){ 
    $statement = $this->pdo->prepare("SELECT s.idSitio,s.nombre,u.ciudad, u.provincia, u.X, u.Y,count(idComentario)
    as Ncomentarios, i.path, ca.nombre as cat FROM sitios s INNER JOIN comentariositios cs ON  s.idSitio = cs.idSitio
    INNER JOIN ubicacion u  ON  s.idSitio = u.idSitio
    INNER JOIN imagenessitios i ON  s.idSitio = i.idSitio
    INNER JOIN categorias ca ON s.idCategoria= ca.idCategoria
     ");


    /*$statement = $this->pdo->prepare("SELECT s.idSitio, s.nombre, s.idCategoria, u.X, u.Y 
    FROM sitios s INNER JOIN ubicacion u ON u.idSitio = s.idSitio 
    WHERE u.ciudad like CONCAT('%','$Ciudad','%') AND u.provincia like CONCAT('%','$Provincia','%') ");*/
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_CLASS);
}



public function selectSitioBuscar($Clave,$Provincia,$Categoria,$offset,$per_page){    
    $statement = $this->pdo->prepare("SELECT s.idSitio,s.nombre,u.ciudad, u.provincia,count(idComentario)
    as Ncomentarios, i.path FROM sitios s INNER JOIN comentariositios cs ON  s.idSitio = cs.idSitio
    INNER JOIN ubicacion u  ON  s.idSitio = u.idSitio
    INNER JOIN imagenessitios i ON  s.idSitio = i.idSitio
    WHERE s.nombre like CONCAT('%','$Clave','%') AND u.provincia like CONCAT('%','$Provincia','%') AND idCategoria=$Categoria
    GROUP BY idSitio
    LIMIT $offset, $per_page");
     $statement->execute();
    return $statement->fetchAll(PDO::FETCH_CLASS);
}


public function selectSitioBuscarProvincia($Clave,$Provincia,$offset,$per_page){
    $statement = $this->pdo->prepare("SELECT s.idSitio,s.nombre,u.ciudad, u.provincia,count(idComentario)
    as Ncomentarios, i.path FROM sitios s INNER JOIN comentariositios cs ON  s.idSitio = cs.idSitio
    INNER JOIN ubicacion u  ON  s.idSitio = u.idSitio
    INNER JOIN imagenessitios i ON  s.idSitio = i.idSitio
    WHERE s.nombre like CONCAT('%','$Clave','%') AND u.provincia like CONCAT('%','$Provincia','%')
    GROUP BY idSitio 
    LIMIT $offset, $per_page");
     $statement->execute();
    return $statement->fetchAll(PDO::FETCH_CLASS);
}

public function selectSitioBuscarCategoria($Clave,$Categoria,$offset,$per_page){
    $statement = $this->pdo->prepare("SELECT s.idSitio,s.nombre,u.ciudad, u.provincia,count(idComentario)
    as Ncomentarios, i.path FROM sitios s INNER JOIN comentariositios cs ON  s.idSitio = cs.idSitio
    INNER JOIN ubicacion u  ON  s.idSitio = u.idSitio
    INNER JOIN imagenessitios i ON  s.idSitio = i.idSitio
    WHERE s.nombre like CONCAT('%','$Clave','%')  AND idCategoria=$Categoria
    GROUP BY idSitio
    LIMIT $offset, $per_page");
     $statement->execute();
    return $statement->fetchAll(PDO::FETCH_CLASS);
}

 //recuperar listado de todos los sitios
 public function selectSitioBuscarAllSitios($Clave,$offset,$per_page){ 
    $statement = $this->pdo->prepare("SELECT s.idSitio,s.nombre,u.ciudad, u.provincia,count(idComentario)
    as Ncomentarios, i.path FROM sitios s INNER JOIN comentariositios cs ON  s.idSitio = cs.idSitio
    INNER JOIN ubicacion u  ON  s.idSitio = u.idSitio
    RIGHT JOIN imagenessitios i ON  s.idSitio = i.idSitio
    WHERE s.nombre like CONCAT('%','$Clave','%')
    GROUP BY idSitio 
    LIMIT $offset, $per_page");
   $statement->execute();
   return $statement->fetchAll(PDO::FETCH_CLASS);
}



//-----------------------------------------------------------------------------------------------



public function PAGselectSitioBuscar($Clave,$Provincia,$Categoria){    
    $statement = $this->pdo->prepare("SELECT count(*) as cantidad FROM (SELECT s.idSitio,s.nombre,u.ciudad, u.provincia,count(idComentario)
    as Ncomentarios, i.path FROM sitios s INNER JOIN comentariositios cs ON  s.idSitio = cs.idSitio
    INNER JOIN ubicacion u  ON  s.idSitio = u.idSitio
    INNER JOIN imagenessitios i ON  s.idSitio = i.idSitio
    WHERE s.nombre like CONCAT ('%','$Clave','%') AND u.provincia like CONCAT('%','$Provincia','%') AND idCategoria=$Categoria
    GROUP BY idSitio
    ) AS Pasd"); 
      $statement->execute();
      return $statement->fetchColumn();
}


public function PAGselectSitioBuscarProvincia($Clave,$Provincia){
    $statement = $this->pdo->prepare("SELECT count(*) as cantidad FROM (SELECT s.idSitio,s.nombre,u.ciudad, u.provincia,count(idComentario)
    as Ncomentarios, i.path FROM sitios s INNER JOIN comentariositios cs ON  s.idSitio = cs.idSitio
    INNER JOIN ubicacion u  ON  s.idSitio = u.idSitio
    INNER JOIN imagenessitios i ON  s.idSitio = i.idSitio
    WHERE s.nombre like CONCAT('%','$Clave','%') AND u.provincia like CONCAT('%','$Provincia','%') 
    GROUP BY idSitio) AS Pasd");
    $statement->execute();
    return $statement->fetchColumn();
}

public function PAGselectSitioBuscarCategoria($Clave,$Categoria){
    $statement = $this->pdo->prepare("SELECT count(*) as cantidad FROM (SELECT s.idSitio,s.nombre,u.ciudad, u.provincia,count(idComentario)
    as Ncomentarios, i.path FROM sitios s INNER JOIN comentariositios cs ON  s.idSitio = cs.idSitio
    INNER JOIN ubicacion u  ON  s.idSitio = u.idSitio
    INNER JOIN imagenessitios i ON  s.idSitio = i.idSitio
    WHERE s.nombre like CONCAT('%','$Clave','%')  AND idCategoria=$Categoria GROUP BY idSitio) AS Pasd
    ");
    $statement->execute();
    return $statement->fetchColumn();
}

 //recuperar listado de todos los sitios
 public function PAGselectSitioBuscarAllSitios($Clave){ 
    $statement = $this->pdo->prepare("SELECT count(*) as cantidad FROM (SELECT s.idSitio,s.nombre,u.ciudad, u.provincia,count(idComentario)
    as Ncomentarios, i.path FROM sitios s INNER JOIN comentariositios cs ON  s.idSitio = cs.idSitio
    INNER JOIN ubicacion u  ON  s.idSitio = u.idSitio
    RIGHT JOIN imagenessitios i ON  s.idSitio = i.idSitio
    WHERE s.nombre like CONCAT('%','$Clave','%')
    GROUP BY idSitio 
    ) AS Pasd");
    $statement->execute();
    return $statement->fetchColumn();
}

public function getDatosUsuario($user){ 
   
     $statement = $this->pdo->prepare(" SELECT `idUsuario`, `mail`, `nombreUsuario`, `nombre`, `apellido`, `direccion`, `pais`, `telefono`, `fotoPerfil` FROM `usuarios` WHERE mail='$user' " );
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_CLASS);
}

public function getUsuario($user){ 
    $statement = $this->pdo->prepare(" SELECT `idUsuario`, `mail`, `nombreUsuario`, `nombre`, `apellido`, `direccion`, `pais`, `telefono`, `fotoPerfil` FROM `usuarios` WHERE nombreUsuario='$user' " );
   $statement->execute();
   return $statement->fetchAll(PDO::FETCH_CLASS);
}


public function getSitiosUsuario($user){ 
    $statement = $this->pdo->prepare(" SELECT s.idSitio, s.nombre
     FROM usuarios u INNER JOIN sitios s on s.idUsuario= u.idUsuario 
     WHERE u.nombreUsuario='$user' " );
   $statement->execute();
   return $statement->fetchAll(PDO::FETCH_CLASS);
}

public function updatePassword($user, $password){ 
    $statement = $this->pdo->prepare("UPDATE usuarios u
    SET u.password = '$password' WHERE u.mail= '$user'");
    $statement->execute();
    if($statement->rowCount() > 0){
        return 1;
    }else{
        return 0;
    }
    
}


public function updateUsuario($mail, $nombre, $apellido, $ubicacion, $telefono){ 
    $statement = $this->pdo->prepare("UPDATE usuarios u
    SET u.nombre = '$nombre', u.apellido = '$apellido', u.pais = '$ubicacion',u.telefono = '$telefono' WHERE u.mail= '$mail'");
    $statement->execute();
    if($statement->rowCount() > 0){
        return 1;
    }else{
        return 0;
    }
    
}

}


