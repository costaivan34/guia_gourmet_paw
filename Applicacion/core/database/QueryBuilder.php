<?php

namespace App\Core\Database;

use PDO;
use Exception;

class QueryBuilder
{
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
    public function __construct($pdo, $logger = null)
    {
        $this->pdo = $pdo;
        $this->logger = $logger ? $logger : null;
    }

    /**
     * Select all records from a database table.
     *
     * @param string $table
     */
    public function selectAll($table)
    {
        $statement = $this->pdo->prepare("SELECT * FROM :tabla");
        $statement->bindParam(':tabla', $table, PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Insert a record into a table.
     *
     * @param  string $table
     * @param  array  $parameters
     */
    public function insert($table, $parameters)
    {
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

    private function sendToLog(Exception $e)
    {
        if ($this->logger) {
            $this->logger->error('Error', ['Error' => $e]);
        }
    }

    /**
     * Limpia guiones - que puedan venir en los nombre de los parametros
     * ya que esto no funciona con PDO
     *
     * Ver: http://php.net/manual/en/pdo.prepared-statemensssts.php#97162
     */
    private function cleanParameterName($parameters)  {
        $cleaned_params = [];
        foreach ($parameters as $name => $value) {
            $cleaned_params[str_replace('-', '', $name)] = $value;
        }
        return $cleaned_params;
    }

    public function validarLogin($usuario) {
        $statement = $this->pdo->prepare(
            "SELECT password FROM usuarios
            WHERE mail=:usuario "
        );
        $statement->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function agregarUsuario(
        $mail,
        $nombreUsuario,
        $nombre,
        $apellido,
        $pais,
        $telefono,
        $password,
        $path_img
    ) {
        try {
            $this->pdo->beginTransaction();
            $statement = $this->pdo->prepare(
                "INSERT INTO  usuarios (mail,nombreUsuario,nombre,apellido,pais,telefono,password,fotoPerfil) 
                VALUES (:mail,:nombreUsuario ,:nombre ,:apellido,:pais ,:telefono,:passwsord, :path_img)"
            );
            $statement->bindParam(':mail', $mail, PDO::PARAM_STR);
            $statement->bindParam(':nombreUsuario', $nombreUsuario, PDO::PARAM_STR);
            $statement->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $statement->bindParam(':apellido', $apellido, PDO::PARAM_STR);
            $statement->bindParam(':pais', $pais, PDO::PARAM_STR);
            $statement->bindParam(':telefono', $telefono, PDO::PARAM_STR);
            $statement->bindParam(':passwsord', $password, PDO::PARAM_STR);
            $statement->bindParam(':path_img', $path_img, PDO::PARAM_STR);
            $statement->execute();
           
          $this->pdo->commit();
            
        } catch (\PDOException $e) {
            // rollback the transaction
            $this->pdo->rollBack();
        
            // show the error message
            die($e->getMessage());
        }
    }

    public function agregarConsulta($nombre, $apellido, $mail, $ftexto)
    {
        $statement = $this->pdo->prepare(
            "INSERT INTO  consultas (mail,nombre,apellido,mensaje) VALUES (:mail,:nombre ,:apellido,:ftexto )"
        );
        $statement->bindParam(':mail', $mail, PDO::PARAM_STR);
        $statement->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $statement->bindParam(':apellido', $apellido, PDO::PARAM_STR);
        $statement->bindParam(':ftexto', $ftexto, PDO::PARAM_STR);
        $statement->execute();
        if ($statement->rowCount() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

   

    public function agregarPlato( $namePlato, $subject,  $idSitio,
    $IP,$IE,$IC,$IPP,$IG,$IS,$archivos,$Carac){
        try {
            $this->pdo->beginTransaction();
            
            $statement = $this->pdo
                ->prepare("INSERT INTO platos(nombre, descripcion, idSitio) 
            VALUES (:namePlato,:subsject,:idSitio)");
            $statement->bindParam(':namePlato', $namePlato, PDO::PARAM_INT);
            $statement->bindParam(':subsject', $subject, PDO::PARAM_STR);
            $statement->bindParam(':idSitio', $idSitio, PDO::PARAM_INT);
            $statement->execute();
            
            $idPlato = $this->pdo->lastInsertId();
            
            $this->agregarInfor(1, $IP, $idPlato);
            $this->agregarInfor(2, $IE, $idPlato);
            $this->agregarInfor(3, $IC, $idPlato);
            $this->agregarInfor(4, $IPP, $idPlato);
            $this->agregarInfor(5, $IG, $idPlato);
            $this->agregarInfor(6, $IS, $idPlato);

            $this->agregarCaracteristicas($Carac, $idPlato);

            $this->agregarImagenes1($archivos, $idPlato);

            $this->pdo->commit();
            
    } catch (\PDOException $e) {
        // rollback the transaction
        $this->pdo->rollBack();
    
        // show the error message
        die($e->getMessage());
    }
    }
   
    public function agregarImagenes1($Archivos, $idPlato){
        if (  isset($Archivos['archivosubido']) &&  is_uploaded_file($Archivos['archivosubido']['tmp_name'])) {
            $fileTmpPath = $_FILES['archivosubido']['tmp_name'];
            $uploadFileDir = './private/plates/' . $idPlato . '/';
            mkdir($uploadFileDir, 0777, true);
            $dest_path = $uploadFileDir . '/1.jpg';
            move_uploaded_file($fileTmpPath, $dest_path);
        }
        $dest_path = substr($dest_path, 1);
        $statement = $this->pdo->prepare(
            "INSERT INTO imagenesplatos(idPlato, path) VALUES (:idPlato,:dest_path)"
        );
        $statement->bindParam(':idPlato', $idPlato, PDO::PARAM_INT);
        $statement->bindParam(':dest_path', $dest_path, PDO::PARAM_STR);

        $statement->execute();
    }

    public function agregarCaracteristicas($caract, $idPlato) {
        foreach ($caract as $value) {
            $datos = $this->agregarCaracteristicas($value, $idPlato);
            $statement = $this->pdo->prepare(
            "INSERT INTO listacaractplato (idPlato,idCaract) VALUES (:idPlato,:valsue)");
            $statement->bindParam(':idPlato', $idPlato, PDO::PARAM_INT);
            $statement->bindParam(':valsue', $value, PDO::PARAM_INT);
            $statement->execute();
        }
    }

    public function agregarInfor($Info, $Valor, $idPlato) {
        $statement = $this->pdo->prepare(
            "INSERT INTO valornutricional (idPlato,idInfo, valor) VALUES (:idPlato,:Info,:Valor)"
        );
        $statement->bindParam(':idPlato', $idPlato, PDO::PARAM_INT);
        $statement->bindParam(':Info', $Info, PDO::PARAM_INT);
        $statement->bindParam(':Valor', $Valor, PDO::PARAM_INT);
        $statement->execute();
        if ($statement->rowCount() > 0) {
            return $this->pdo->lastInsertId();
        } else {
            return 0;
        }
    }
   

    public function agregarSitio(
        $nameSitio,
        $subject,
        $TelefonoSitio,
        $MailSitio,
        $user,
        $cat
    ) {
        $statement = $this->pdo
            ->prepare("INSERT INTO sitios (nombre, descripcion, telefono, sitioWeb,idUsuario, idCategoria) 
        VALUES (:nameSitio,:subject, :TelefonoSitio,:MailSitio, 
        (SELECT idUsuario FROM usuarios WHERE nombreUsuario=:user) ,:cat )");
            $statement->bindParam(':nameSitio', $nameSitio, PDO::PARAM_STR);
            $statement->bindParam(':subject', $subject, PDO::PARAM_STR);
            $statement->bindParam(':TelefonoSitio', $TelefonoSitio, PDO::PARAM_STR);
            $statement->bindParam(':MailSitio', $MailSitio, PDO::PARAM_STR);    
            $statement->bindParam(':user', $user, PDO::PARAM_STR); 
            $statement->bindParam(':cat', $cat, PDO::PARAM_INT); 
        $statement->execute();
        if ($statement->rowCount() > 0) {
            return $this->pdo->lastInsertId();
        } else {
            return 0;
        }
    }

    public function agregarServicio($idServicio, $idSitio)
    {
        $statement = $this->pdo->prepare(
            "INSERT INTO listacaractsitio(idSitio, idCaract) VALUES (:idSitio,:idServicio)"
        );
        $statement->bindParam(':idSitio', $idSitio, PDO::PARAM_INT);
        $statement->bindParam(':idServicio', $idServicio, PDO::PARAM_INT);
        $statement->execute();
        if ($statement->rowCount() > 0) {
            return $this->pdo->lastInsertId();
        } else {
            return 0;
        }
    }
    public function selectPlatosList($idSitio)
    {
        $statement = $this->pdo
            ->prepare("SELECT p.nombre, p.descripcion
         FROM platos p WHERE p.idSitio = :idSitio");
         $statement->bindParam(':idSitio', $idSitio, PDO::PARAM_INT);
        $statement->execute();
        if ($statement->rowCount() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function agregarHorarios($idSitio, $idDia, $HDesde, $HHasta){
        $statement = $this->pdo->prepare(
            "INSERT INTO horario (idSitio, idDia, HDesde, HHasta) VALUES (idSitio, :idDia, :HDesde, :HHasta)"
        );
        $statement->bindParam(':idSitio', $idSitio, PDO::PARAM_INT);
        $statement->bindParam(':idDia', $idDia, PDO::PARAM_INT);
        $statement->bindParam(':HDesde', $HDesde, PDO::PARAM_INT);
        $statement->bindParam(':HHasta', $HHasta, PDO::PARAM_INT);
        $statement->execute();
        if ($statement->rowCount() > 0) {
            return $this->pdo->lastInsertId();
        } else {
            return 0;
        }
    }

    public function agregarUbicacion(
        $idSitio,
        $direccion,
        $ciudad,
        $provincia,
        $X,
        $Y
    ) {
        $statement = $this->pdo->prepare(
            "INSERT INTO ubicacion(idSitio, direccion, ciudad, provincia, X, Y) 
            VALUES (:idSitio, :direccion, :ciudad, :provincia,:X, :Y)"
        );
        $statement->bindParam(':idSitio', $idSitio, PDO::PARAM_INT);
        $statement->bindParam(':direccion', $direccion, PDO::PARAM_STR);
        $statement->bindParam(':ciudad', $ciudad, PDO::PARAM_STR);
        $statement->bindParam(':provincia', $provincia, PDO::PARAM_STR);
        $statement->bindParam(':Y', $Y, PDO::PARAM_INT);
        $statement->bindParam(':X', $X, PDO::PARAM_INT);
        $statement->execute();
        if ($statement->rowCount() > 0) {
            return $this->pdo->lastInsertId();
        } else {
            return 0;
        }
    }

    public function agregarImagenes($idSitio, $path)
    {
        $statement = $this->pdo->prepare(
            "INSERT INTO imagenessitios(idSitio, path) VALUES (:idSitio,:paths)"
        );
        $statement->bindParam(':idSitio', $idSitio, PDO::PARAM_INT);
        $statement->bindParam(':paths', $path, PDO::PARAM_STR);
        $statement->execute();
        if ($statement->rowCount() > 0) {
            return $this->pdo->lastInsertId();
        } else {
            return 0;
        }
    }


    public function selectSitio($idSitio) {
        $statement = $this->pdo->prepare(
            "SELECT * FROM sitios WHERE idSitio= :idSitio"
        );
        $statement->bindParam(':idSitio', $idSitio, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectUbicacion($idSitio)
    {
        $statement = $this->pdo
            ->prepare("SELECT idUbicacion, direccion, ciudad, provincia, x, y FROM ubicacion
     WHERE idSitio = :idSitio");
     $statement->bindParam(':idSitio', $idSitio, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectHorarios($idSitio)
    {
        $statement = $this->pdo->prepare(
            "SELECT h.idDia, h.HDesde, h.HHasta, sd.nombre FROM horario h INNER JOIN semanasdias sd ON h.idDia=sd.idDia
              WHERE idSitio = :idSitio"
        );
        $statement->bindParam(':idSitio', $idSitio, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }


    public function selectListaCaractSitio($idSitio)
    {
        $statement = $this->pdo
            ->prepare("SELECT cs.nombre FROM listacaractsitio lcs 
         INNER JOIN caracteristicasitio cs  ON  lcs.idCaract = cs.idCaracteristica 
         WHERE lcs.idSitio = :idSitio");
         $statement->bindParam(':idSitio', $idSitio, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectImagenesSitio($idSitio)
    {
        $statement = $this->pdo->prepare("SELECT cs.idImagen, cs.path
     FROM  imagenessitios cs WHERE cs.idSitio = :idSitio");
     $statement->bindParam(':idSitio', $idSitio, PDO::PARAM_INT);        
           
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectValoracionSitio($idSitio)
    {
        $statement = $this->pdo
            ->prepare("SELECT avg(cs.valoracionSabor) as valoracionSabor,avg( cs.valoracionPrecio)as valoracionPrecio,
    avg(cs.valoracionAmbiente)as valoracionAmbiente  FROM comentariositios cs WHERE cs.idsitio = :idSitio");
     $statement->bindParam(':idSitio', $idSitio, PDO::PARAM_INT);

        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectAllComentarios($idSitio, $offset, $per_page)
    {
        $statement = $this->pdo
            ->prepare("SELECT cs.nombre, cs.descripcion,cs.fecha,cs.valoracionSabor,
                cs.valoracionPrecio,cs.valoracionAmbiente
         FROM comentariositios cs WHERE cs.idsitio = :idSitio LIMIT :offset, :per_page");
               $statement->bindParam(':idSitio', $idSitio, PDO::PARAM_INT);
               $statement->bindParam(':offset', $offset, PDO::PARAM_INT);
               $statement->bindParam(':per_page', $per_page, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectAllPlatos($idSitio, $offset, $per_page)
    {
        //$statement = $this->pdo->prepare(" SELECT p.idPlato, p.nombre, p.precio, ip.path FROM platos p
        //INNER JOIN imagenesplatos ip on p.idPlato=ip.idPlato WHERE p.idSitio=$idSitio LIMIT $offset, $per_page" );
        $statement = $this->pdo
            ->prepare(" SELECT p.idPlato, p.nombre, ip.path FROM platos p 
     INNER JOIN imagenesplatos ip ON p.idPlato= ip.idPlato 
      WHERE p.idSitio=:idSitio ORDER BY p.idPlato  LIMIT :offset, :per_page");
      $statement->bindParam(':idSitio', $idSitio, PDO::PARAM_INT);
      $statement->bindParam(':offset', $offset, PDO::PARAM_INT);
      $statement->bindParam(':per_page', $per_page, PDO::PARAM_INT);
      $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectPlatos($idSitio)  {
        $statement = $this->pdo
            ->prepare(" SELECT p.idPlato, p.nombre, ip.path FROM platos p 
     INNER JOIN imagenesplatos ip ON p.idPlato= ip.idPlato 
      WHERE p.idSitio=:idSitio ORDER BY p.idPlato");
          $statement->bindParam(':idSitio', $idSitio, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function getPages($idSitio, $tabla)
    {
        $statement = $this->pdo->prepare(" SELECT count(*) 
    FROM $tabla p WHERE p.idSitio=:idSitio");
    $statement->bindParam(':idSitio', $idSitio, PDO::PARAM_INT);
    $statement->execute();
        return $statement->fetchColumn();
    }

    public function getPagesAllSitios()
    {
        $total_pages_sql = $this->pdo->prepare(
            'SELECT count(*)  FROM sitios s '
        );
        $total_pages_sql->execute();
        return $total_pages_sql->fetchColumn();
    }

    public function getCategorias()
    {
        $statement = $this->pdo->prepare("SELECT * 
    FROM categorias");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectImagenPlato($idPlato)
    {
        $statement = $this->pdo->prepare("SELECT p.path
     FROM imagenesplatos p WHERE p.idPlato = :idPlato ");
        $statement->bindParam(':idPlato', $idPlato, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectPlato($idSitio, $idPlato) {
        $statement = $this->pdo
            ->prepare("SELECT nombre, descripcion
     FROM platos  WHERE idPlato=:idPlato and idSitio=:idSitio");
       $statement->bindParam(':idPlato', $idPlato, PDO::PARAM_INT);
       $statement->bindParam(':idSitio', $idSitio, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

 


    //recuperar ListaInfo de plato X
    public function selectListaInfo($idListaInfo)
    {
        $statement = $this->pdo
            ->prepare("SELECT inf.nombre, vn.valor FROM  listainfo li 
     INNER JOIN valornutricional vn  ON  li.idValor = vn.idValor 
     INNER JOIN infonutricional inf  ON  vn.idInfo = inf.idInfo
     WHERE li.idListaInfo = :idListaInfo");
     $statement->bindParam(':idListaInfo', $idListaInfo, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    //recuperar ListaCaract de plato X
    public function selectListaCaract($idPlato)
    {
        $statement = $this->pdo
            ->prepare("SELECT cs.nombre FROM listacaractplato lcs 
    INNER JOIN caracteristicaplato cs  ON  lcs.idCaract = cs.idCaracteristica 
    WHERE lcs.idPlato = :idPlato");
    $statement->bindParam(':idPlato', $idPlato, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    //recuperar ListaCaract de plato X
    public function selectInfo($idPlato) {
        $statement = $this->pdo
            ->prepare("SELECT i.nombre,v.valor FROM valornutricional v 
    INNER JOIN infonutricional i  ON  i.idInfo = v.idInfo 
    WHERE v.idPlato = :idPlato");
     $statement->bindParam(':idPlato', $idPlato, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectDestacados()
    {
        $statement = $this->pdo
            ->prepare("SELECT  s.idSitio,s.nombre,u.ciudad, u.provincia, i.path FROM sitios s 
    INNER JOIN ubicacion u  ON  s.idSitio = u.idSitio
    RIGHT JOIN imagenessitios i ON  s.idSitio = i.idSitio
    GROUP BY idSitio  LIMIT 0, 6");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectCerca()
    {
        $statement = $this->pdo
            ->prepare("SELECT s.idSitio,s.nombre, u.X, u.Y, i.path FROM sitios s 
    INNER JOIN ubicacion u  ON  s.idSitio = u.idSitio
    INNER JOIN imagenessitios i ON  s.idSitio = i.idSitio 
     ");
        /*$statement = $this->pdo->prepare("SELECT s.idSitio, s.nombre, s.idCategoria, u.X, u.Y 
    FROM sitios s INNER JOIN ubicacion u ON u.idSitio = s.idSitio 
    WHERE u.ciudad like CONCAT('%','$Ciudad','%') AND u.provincia like CONCAT('%','$Provincia','%') ");*/
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function eliminarCaracPlatos($idPlato)
    {
        $statement = $this->pdo->prepare(
            "DELETE FROM listacaractplato WHERE idPlato =$idPlato"
        );
        $statement->execute();
    }
    public function eliminarValorPlatos($idPlato)
    {
        $statement = $this->pdo->prepare(
            "DELETE FROM valornutricional WHERE idPlato =$idPlato"
        );
        $statement->execute();
    }

    public function eliminarImagenesPlatos($idPlato)
    {
        $statement = $this->pdo->prepare(
            "DELETE FROM imagenesplatos WHERE idPlato =$idPlato"
        );
        $statement->execute();
    }

    public function eliminarPlatos($idPlato)
    {
        $statement = $this->pdo->prepare(
            "DELETE FROM platos WHERE idPlato =$idPlato"
        );
        $statement->execute();
    }

    public function eliminarCaractSitio($idSitio)
    {
        $statement = $this->pdo->prepare(
            "DELETE FROM listacaractsitio WHERE idSitio =$idSitio"
        );
        $statement->execute();
    }

    public function eliminarComentarioSitios($idSitio)
    {
        $statement = $this->pdo->prepare(
            "DELETE FROM comentariositios WHERE idSitio =$idSitio"
        );
    }

    public function eliminarHorario($idSitio)
    {
        $statement = $this->pdo->prepare(
            "DELETE FROM horario WHERE idSitio =$idSitio"
        );
        $statement->execute();
    }

    public function eliminarImagenesSitios($idSitio)
    {
        $statement = $this->pdo->prepare(
            "DELETE FROM imagenessitios WHERE idSitio =$idSitio"
        );
        $statement->execute();
    }

    public function eliminarUbicacion($idSitio)
    {
        $statement = $this->pdo->prepare(
            "DELETE FROM ubicacion WHERE idSitio =$idSitio"
        );
        $statement->execute();
    }

    public function eliminarSitio($idSitio)
    {
        $statement = $this->pdo->prepare(
            "DELETE FROM sitios WHERE idSitio =$idSitio"
        );
        $statement->execute();
        if ($statement->rowCount() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function selectSitioBuscar(
        $Clave,
        $Provincia,
        $Categoria,
        $offset,
        $per_page
    ) {
        $statement = $this->pdo
            ->prepare("SELECT s.idSitio,s.nombre,u.ciudad, u.provincia,i.path FROM sitios s 
    INNER JOIN ubicacion u  ON  s.idSitio = u.idSitio
    INNER JOIN imagenessitios i ON  s.idSitio = i.idSitio
    WHERE s.nombre like :Clave AND u.provincia like :Provincia AND idCategoria=:Categoria
    GROUP BY idSitio
    LIMIT :offset, :per_page");
          $Clave = "%".$Clave."%";
          $Provincia = "%".$Provincia."%";
         $statement->bindParam(':Clave', $Clave, PDO::PARAM_STR);
         $statement->bindParam(':Provincia', $Provincia, PDO::PARAM_STR);
         $statement->bindParam(':Categoria', $Categoria, PDO::PARAM_INT);
         $statement->bindParam(':offset', $offset, PDO::PARAM_INT);
         $statement->bindParam(':per_page', $per_page, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectSitioBuscarProvincia(
        $Clave,
        $Provincia,
        $offset,
        $per_page
    ) {
        $statement = $this->pdo
            ->prepare("SELECT s.idSitio,s.nombre,u.ciudad, u.provincia, i.path FROM sitios s 
    INNER JOIN ubicacion u  ON  s.idSitio = u.idSitio
    INNER JOIN imagenessitios i ON  s.idSitio = i.idSitio
    WHERE s.nombre like :Clave AND u.provincia like :Provincia
    GROUP BY idSitio 
    LIMIT :offset, :per_page");
          $Clave = "%".$Clave."%";
          $Provincia = "%".$Provincia."%";
         $statement->bindParam(':Clave', $Clave, PDO::PARAM_STR);
         $statement->bindParam(':Provincia', $Provincia, PDO::PARAM_STR);
         $statement->bindParam(':offset', $offset, PDO::PARAM_INT);
         $statement->bindParam(':per_page', $per_page, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectSitioBuscarCategoria(
        $Clave,
        $Categoria,
        $offset,
        $per_page
    ) {
        $statement = $this->pdo
            ->prepare("SELECT s.idSitio,s.nombre,u.ciudad, u.provincia, i.path FROM sitios s
    INNER JOIN ubicacion u  ON  s.idSitio = u.idSitio
    INNER JOIN imagenessitios i ON  s.idSitio = i.idSitio
    WHERE s.nombre like :Clave  AND idCategoria=:Categoria'
    GROUP BY idSitio
    LIMIT :offset, :per_page");
          $Clave = "%".$Clave."%";

         $statement->bindParam(':Clave', $Clave, PDO::PARAM_STR);
         $statement->bindParam(':Categoria', $Categoria, PDO::PARAM_INT);
         $statement->bindParam(':offset', $offset, PDO::PARAM_INT);
         $statement->bindParam(':per_page', $per_page, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    //recuperar listado de todos los sitios
    public function selectSitioBuscarAllSitios($Clave, $offset, $per_page)
    {
        $statement = $this->pdo
            ->prepare("SELECT s.idSitio,s.nombre,u.ciudad, u.provincia, u.X,u.Y, i.path FROM sitios s 
    INNER JOIN ubicacion u  ON  s.idSitio = u.idSitio
    RIGHT JOIN imagenessitios i ON  s.idSitio = i.idSitio
    WHERE s.nombre like :Clave
    GROUP BY idSitio 
    LIMIT :offset, :per_page");
          $Clave = "%".$Clave."%";
         $statement->bindParam(':Clave', $Clave, PDO::PARAM_STR);
         $statement->bindParam(':offset', $offset, PDO::PARAM_INT);
         $statement->bindParam(':per_page', $per_page, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    //-----------------------------------------------------------------------------------------------

    public function PAGselectSitioBuscar($Clave, $Provincia, $Categoria)
    {
        $statement = $this->pdo
            ->prepare("SELECT count(*) as cantidad FROM (SELECT s.idSitio,s.nombre,u.ciudad, u.provincia
    , i.path FROM sitios s
    INNER JOIN ubicacion u  ON  s.idSitio = u.idSitio
    INNER JOIN imagenessitios i ON  s.idSitio = i.idSitio
    WHERE s.nombre like :Clave AND u.provincia like :Provincia AND idCategoria=:Categoria
    GROUP BY idSitio
    ) AS Pasd");
      $Clave = "%".$Clave."%";
      $Provincia = "%".$Provincia."%";
     $statement->bindParam(':Clave', $Clave, PDO::PARAM_STR);
     $statement->bindParam(':Provincia', $Provincia, PDO::PARAM_STR);
     $statement->bindParam(':Categoria', $Categoria, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchColumn();
    }

    public function PAGselectSitioBuscarProvincia($Clave, $Provincia)
    {
        $statement = $this->pdo
            ->prepare("SELECT count(*) as cantidad FROM (SELECT s.idSitio,s.nombre,u.ciudad, u.provincia
    , i.path FROM sitios s 
    INNER JOIN ubicacion u  ON  s.idSitio = u.idSitio
    INNER JOIN imagenessitios i ON  s.idSitio = i.idSitio
    WHERE s.nombre like :Clave AND u.provincia like :Provincia
    GROUP BY idSitio) AS Pasd");
     $Clave = "%".$Clave."%";
     $Provincia = "%".$Provincia."%";
    $statement->bindParam(':Clave', $Clave, PDO::PARAM_STR);
    $statement->bindParam(':Provincia', $Provincia, PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetchColumn();
    }

    public function PAGselectSitioBuscarCategoria($Clave, $Categoria)
    {
        $statement = $this->pdo
            ->prepare("SELECT count(*) as cantidad FROM (SELECT s.idSitio,s.nombre,u.ciudad, u.provincia
    , i.path FROM sitios s 
    INNER JOIN ubicacion u  ON  s.idSitio = u.idSitio
    INNER JOIN imagenessitios i ON  s.idSitio = i.idSitio
    WHERE s.nombre like :Clave  AND idCategoria= :Categoria GROUP BY idSitio) AS Pasd
    ");
       $Clave = "%".$Clave."%";
       $statement->bindParam(':Clave', $Clave, PDO::PARAM_STR);
       $statement->bindParam(':Categoria', $Categoria, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchColumn();
    }

    //recuperar listado de todos los sitios
    public function PAGselectSitioBuscarAllSitios($Clave)
    {
        $statement = $this->pdo
            ->prepare("SELECT count(*) as cantidad FROM (SELECT s.idSitio,s.nombre,u.ciudad, u.provincia,
     i.path FROM sitios s 
    INNER JOIN ubicacion u  ON  s.idSitio = u.idSitio
    RIGHT JOIN imagenessitios i ON  s.idSitio = i.idSitio
    WHERE s.nombre like :Clave
    GROUP BY idSitio 
    ) AS Pasd");
    $Clave = "%".$Clave."%";
     $statement->bindParam(':Clave', $Clave, PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetchColumn();
    }

    public function getDatosUsuario($user){
        $statement = $this->pdo->prepare(
            " SELECT `idUsuario`, `mail`, `nombreUsuario`, `nombre`, `apellido`, 
             `pais`, `telefono`, `fotoPerfil` 
            FROM `usuarios` WHERE `mail` = :user "
        );
        
        $statement->bindParam(':user', $user, PDO::PARAM_STR);
        //$statement->bindParam(':params', $params, PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function getUsuario($user) {
        $statement = $this->pdo->prepare(
            " SELECT `idUsuario`, `mail`, `nombreUsuario`, `nombre`, 
            `apellido`, `pais`, `telefono`, `fotoPerfil` 
            FROM `usuarios` WHERE `nombreUsuario` = :user "
        );
        $statement->bindParam(':user', $user, PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function getSitiosUsuario($user)
    {
        $statement = $this->pdo->prepare(" SELECT  s.idSitio, s.nombre, i.path 
     FROM usuarios u INNER JOIN sitios s on s.idUsuario= u.idUsuario 
     LEFT JOIN imagenessitios i ON  s.idSitio = i.idSitio
     WHERE u.nombreUsuario=:user
     GROUP BY idSitio ");
          $statement->bindParam(':user', $user, PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function updatePassword($user, $password) {
        $statement = $this->pdo->prepare("UPDATE usuarios u
    SET u.password = :pass WHERE u.mail= :user");
     $statement->bindParam(':pass', $password, PDO::PARAM_STR);
     $statement->bindParam(':user', $user, PDO::PARAM_STR);

        $statement->execute();
        if ($statement->rowCount() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function updateUsuario(
        $mail,
        $nombre,
        $apellido,
        $ubicacion,
        $telefono
    ) {
        $statement = $this->pdo->prepare("UPDATE usuarios u
    SET u.nombre = :nombre, u.apellido = :apellido,
     u.pais = :ubicacion:,u.telefono = :telefono 
    WHERE u.mail= :mail");
     $statement->bindParam(':nombre', $nombre, PDO::PARAM_STR);
     $statement->bindParam(':apellido', $apellido, PDO::PARAM_STR);
     $statement->bindParam(':ubicacion', $ubicacion, PDO::PARAM_STR);
     $statement->bindParam(':telefono', $telefono, PDO::PARAM_STR);
     $statement->bindParam(':mail', $mail, PDO::PARAM_STR);

     $statement->execute();
        if ($statement->rowCount() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function isFree($mail) {
        $statement = $this->pdo->prepare(
            "SELECT * FROM `usuarios` WHERE mail=:mail "
        );
        $statement->bindParam(':mail', $mail, PDO::PARAM_STR);
        $statement->execute();
        return $statement->rowCount();
       
    }
    
}
