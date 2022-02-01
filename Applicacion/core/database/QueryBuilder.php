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
        $statement = $this->pdo->prepare('SELECT * FROM :tabla');
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
    private function cleanParameterName($parameters)
    {
        $cleaned_params = [];
        foreach ($parameters as $name => $value) {
            $cleaned_params[str_replace('-', '', $name)] = $value;
        }
        return $cleaned_params;
    }

    public function validarLogin($usuario)
    {
        $statement = $this->pdo->prepare(
            "SELECT password FROM usuarios
            WHERE mail=:usuario "
        );
        $statement->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function save_image($FILES){
            $dest_path = './private/users/default/perfil.jpg';
            if ( isset($FILES['archivosubido']) &&is_uploaded_file($FILES['archivosubido']['tmp_name']) ) {
                $fileTmpPath = $FILES['archivosubido']['tmp_name'];
                $mail = $_POST['mailUser'];
                $uploadFileDir = './private/users/' . $mail . '/';
                if (!file_exists($uploadFileDir)) {
                    mkdir($uploadFileDir, 0777, true);
                    $dest_path = $uploadFileDir . '/perfil.jpg';
                    move_uploaded_file($fileTmpPath, $dest_path);
                    $dest_path = substr($dest_path, 1);
                }
            }
            return  $dest_path;
    }


    public function agregarUsuario(
        $mail,
        $nombreUsuario,
        $nombre,
        $apellido,
        $pais,
        $telefono,
        $password,
        $FILES
    ) {
        try {
            $this->pdo->beginTransaction();
          
            $path_img = $this->save_image($FILES);

            $statement = $this->pdo->prepare(
                "INSERT INTO  usuarios (mail,nombreUsuario,nombre,apellido,pais,telefono,password,fotoPerfil) 
                VALUES (:mail,:nombreUsuario ,:nombre ,:apellido,:pais ,:telefono,:passwsord, :path_img)"
            );
            $statement->bindParam(':mail', $mail, PDO::PARAM_STR);
            $statement->bindParam(
                ':nombreUsuario',
                $nombreUsuario,
                PDO::PARAM_STR
            );
            $statement->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $statement->bindParam(':apellido', $apellido, PDO::PARAM_STR);
            $statement->bindParam(':pais', $pais, PDO::PARAM_STR);
            $statement->bindParam(':telefono', $telefono, PDO::PARAM_STR);
            $statement->bindParam(':passwsord', $password, PDO::PARAM_STR);
            $statement->bindParam(':path_img', $path_img, PDO::PARAM_STR);
            $statement->execute();
            $idUser = $this->pdo->lastInsertId();
            $this->pdo->commit();
            return   $idUser;
        } catch (\PDOException $e) {
            // rollback the transaction
            $this->pdo->rollBack();
           // die($e->getMessage());
            // show the error message
            return 0;
        }
    }

    public function updatePassword($user, $password)
    {
        try {
            $this->pdo->beginTransaction();
            $statement = $this->pdo->prepare("UPDATE usuarios u
            SET u.password = :pass WHERE u.mail= :user");
            $statement->bindParam(':pass', $password, PDO::PARAM_STR);
            $statement->bindParam(':user', $user, PDO::PARAM_STR);
            $statement->execute();

            $this->pdo->commit();
            return 1;
        } catch (\PDOException $e) {
            // rollback the transaction
            $this->pdo->rollBack();
            // show the error message
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
        try {
            $this->pdo->beginTransaction();
            $statement = $this->pdo->prepare("UPDATE usuarios u
            SET u.nombre = :nombre, u.apellido = :apellido,
            u.pais = :ubicacion,u.telefono = :telefono 
            WHERE u.mail= :mail");
            $statement->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $statement->bindParam(':apellido', $apellido, PDO::PARAM_STR);
            $statement->bindParam(':ubicacion', $ubicacion, PDO::PARAM_STR);
            $statement->bindParam(':telefono', $telefono, PDO::PARAM_STR);
            $statement->bindParam(':mail', $mail, PDO::PARAM_STR);
            $statement->execute();
            $this->pdo->commit();
            return 1;
        } catch (\PDOException $e) {
            // rollback the transaction
            $this->pdo->rollBack();
            // show the error message
            return 0;
        }
    }

    public function isFree($mail)
    {
        $statement = $this->pdo->prepare(
            'SELECT * FROM `usuarios` WHERE mail=:mail '
        );
        $statement->bindParam(':mail', $mail, PDO::PARAM_STR);
        $statement->execute();
        return $statement->rowCount();
    }

    public function agregarConsulta($nombre, $apellido, $mail, $ftexto)
    {
        try {
            $this->pdo->beginTransaction();
            $statement = $this->pdo->prepare(
              'INSERT INTO  consultas (mail,nombre,apellido,mensaje) 
               VALUES (:mail,:nombre ,:apellido,:ftexto )'
            );
            $statement->bindParam(':mail', $mail, PDO::PARAM_STR);
            $statement->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $statement->bindParam(':apellido', $apellido, PDO::PARAM_STR);
            $statement->bindParam(':ftexto', $ftexto, PDO::PARAM_STR);
            $statement->execute();
            $this->pdo->commit();
            //  var_dump("commit");
            return 1;
        } catch (\PDOException $e) {
            // rollback the transaction
            $this->pdo->rollBack();
            // show the error message
            return 0;
        }
    }

    public function agregarPlato(
        $namePlato,
        $subject,
        $idSitio,
        $IP,
        $IE,
        $IC,
        $IPP,
        $IG,
        $IS,
        $archivos,
        $Carac
    ) {
        try {
            $this->pdo->beginTransaction();
            $statement = $this->pdo
                ->prepare("INSERT INTO platos(nombre, descripcion, idSitio) 
            VALUES (:namePlato,:subsject,:idSitio)");
            $statement->bindParam(':namePlato', $namePlato, PDO::PARAM_STR);
            $statement->bindParam(':subsject', $subject, PDO::PARAM_STR);
            $statement->bindParam(':idSitio', $idSitio, PDO::PARAM_INT);
            $statement->execute();
            //  var_dump("platos");
            $idPlato = $this->pdo->lastInsertId();

            $this->agregarInfor(1, $IP, $idPlato);
            $this->agregarInfor(2, $IE, $idPlato);
            $this->agregarInfor(3, $IC, $idPlato);
            $this->agregarInfor(4, $IPP, $idPlato);
            $this->agregarInfor(5, $IG, $idPlato);
            $this->agregarInfor(6, $IS, $idPlato);
            //   var_dump("agregarInfor");
            $this->agregarCaracteristicas($Carac, $idPlato);
            //    var_dump("agregarCaracteristicas");
            $this->agregarImagenes1($archivos, $idPlato);
            //  var_dump("agregarImagenes1");
            $this->pdo->commit();
            //  var_dump("commit");
            return 1;
        } catch (\PDOException $e) {
            // rollback the transaction
            $this->pdo->rollBack();
            var_dump('rollBack');
            // show the error message
            return 0;
        }
    }

    public function agregarImagenes1($Archivos, $idPlato)
    {
        if (
            isset($Archivos['archivosubido']) &&
            is_uploaded_file($Archivos['archivosubido']['tmp_name'])
        ) {
            $fileTmpPath = $_FILES['archivosubido']['tmp_name'];
            $uploadFileDir = './private/plates/' . $idPlato . '/';
            mkdir($uploadFileDir, 0777, true);
            $dest_path = $uploadFileDir . '/1.jpg';
            move_uploaded_file($fileTmpPath, $dest_path);
        }
        $dest_path = substr($dest_path, 1);
        $statement = $this->pdo->prepare(
            'INSERT INTO imagenesplatos(idPlato, path) VALUES (:idPlato,:dest_path)'
        );
        $statement->bindParam(':idPlato', $idPlato, PDO::PARAM_INT);
        $statement->bindParam(':dest_path', $dest_path, PDO::PARAM_STR);

        $statement->execute();
    }

    public function agregarCaracteristicas($caract, $idPlato)
    {
        foreach ($caract as $value) {
            $statement = $this->pdo->prepare(
                'INSERT INTO listacaractplato (idPlato,idCaract) VALUES (:idPlato,:valsue)'
            );
            $statement->bindParam(':idPlato', $idPlato, PDO::PARAM_INT);
            $statement->bindParam(':valsue', $value, PDO::PARAM_INT);
            $statement->execute();
        }
    }

    public function agregarInfor($Info, $Valor, $idPlato)
    {
        $statement = $this->pdo->prepare(
            'INSERT INTO valornutricional (idPlato,idInfo, valor) VALUES (:idPlato,:Info,:Valor)'
        );
        $statement->bindParam(':idPlato', $idPlato, PDO::PARAM_INT);
        $statement->bindParam(':Info', $Info, PDO::PARAM_INT);
        $statement->bindParam(':Valor', $Valor, PDO::PARAM_INT);
        $statement->execute();
    }

    public function agregarSitio(
        $nameSitio,
        $subject,
        $DireccionSitio,
        $LocalidadSitio,
        $ProvinciaSitio,
        $longitud,
        $latitud,
        $MailSitio,
        $TelefonoSitio,
        $user,
        $horarios,
        $servicios,
        $FILES
    ) {
        try {
            $this->pdo->beginTransaction();
            $statement = $this->pdo->prepare("INSERT INTO sitios 
            (nombre, descripcion, telefono, sitioWeb,idUsuario, idCategoria) 
            VALUES (:nameSitio,:subsject, :TelefonoSitio,:MailSitio, 
            (SELECT idUsuario FROM usuarios WHERE nombreUsuario=:user) ,1)");
            $statement->bindParam(':nameSitio', $nameSitio, PDO::PARAM_STR);
            $statement->bindParam(':subsject', $subject, PDO::PARAM_STR);
            $statement->bindParam(
                ':TelefonoSitio',
                $TelefonoSitio,
                PDO::PARAM_STR
            );
            $statement->bindParam(':MailSitio', $MailSitio, PDO::PARAM_STR);
            $statement->bindParam(':user', $user, PDO::PARAM_STR);

            $statement->execute();

            $idSitio = $this->pdo->lastInsertId();
           //  var_dump('agregarServicio');
            $this->agregarServicio($servicios, $idSitio);
            
           //  var_dump('agregarUbicacion');
            $this->agregarUbicacion(
                $idSitio,
                $DireccionSitio,
                $LocalidadSitio,
                $ProvinciaSitio,
                $longitud,
                $latitud
            );
           // var_dump('agregarHorarios');
            $this->agregarHorarios($idSitio, $horarios);
            
            $this->agregarImagenes($idSitio,$FILES);


            $this->pdo->commit();
            //  var_dump("commit");
            return $idSitio;
        } catch (\PDOException $e) {
            // rollback the transaction
            $this->pdo->rollBack();
            var_dump('rollBack');
            //die($e->getMessage());
            // show the error message
            return 0;
        }
    }

    public function agregarServicio($servicios, $idSitio)
    {
        foreach ($servicios as $value) {
            $statement = $this->pdo->prepare(
                'INSERT INTO listacaractsitio(idSitio, idCaract) VALUES (:idSitio,:idServicio)'
            );
            $statement->bindParam(':idSitio', $idSitio, PDO::PARAM_INT);
            $statement->bindParam(':idServicio', $value, PDO::PARAM_INT);
            $statement->execute();
        }
    }

    public function agregarHorarios($idSitio, $horarios) {
        $x = 0;
        while ( $x<count($horarios)):
            $dia = $horarios[$x]; // 0 a 6
            $de = $horarios[$x + 1]; // 0 a 23 menor que $hasta
            $hasta = $horarios[$x + 2]; // 0 a 23 mayor que $de
            var_dump($x);
            $statement = $this->pdo->prepare(
                'INSERT INTO 
                horario (idSitio, idDia, HDesde, HHasta)
                 VALUES (:idSitio, :idDia, :HDesde, :HHasta)'
            );
            $statement->bindParam(':idSitio', $idSitio, PDO::PARAM_INT);
            $statement->bindParam(':idDia', $dia, PDO::PARAM_INT);
            $statement->bindParam(':HDesde', $de, PDO::PARAM_INT);
            $statement->bindParam(':HHasta', $hasta, PDO::PARAM_INT);
            $statement->execute();
            $x= $x + 3;
        endwhile;
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
        $statement->bindParam(':Y', $Y, PDO::PARAM_STR);
        $statement->bindParam(':X', $X, PDO::PARAM_STR);
        $statement->execute();
    }

    public function agregarImagenes($idSitio, $Archivos){
            //Como el elemento es un arreglos utilizamos foreach para extraer todos los valores
            foreach ($Archivos['archivosubido']['tmp_name'] as $key => $tmp_name) {
                //Validamos que el archivo exista
                if ($Archivos['archivosubido']['name'][$key]) {
                    $filename = $Archivos['archivosubido']['name'][$key]; //Obtenemos el nombre original del archivo
                    $source = $Archivos['archivosubido']['tmp_name'][$key]; //Obtenemos un nombre temporal del archivo
                    $directorio = './private/sites/' . $idSitio . '/'; //Declaramos un  variable con la ruta donde guardaremos los archivos
                    //Validamos si la ruta de destino existe, en caso de no existir la creamos
                    if (!file_exists($directorio)) {
                        mkdir($directorio, 0777) or
                            die(
                                'No se puede crear el directorio de extracci&oacute;n'
                            );
                    }
                    $dir = opendir($directorio); //Abrimos el directorio de destino
                    $target_path = $directorio . '/' . $filename; //Indicamos la ruta de destino, así como el nombre del archivo
                    //Movemos y validamos que el archivo se haya cargado correctamente
                    //El primer campo es el origen y el segundo el destino
                    if (move_uploaded_file($source, $target_path)) {
                        $target_path = substr($target_path, 1);
                        $statement = $this->pdo->prepare(
                            'INSERT INTO imagenessitios(idSitio, path) VALUES (:idSitio,:paths)'
                        );
                        $statement->bindParam(':idSitio', $idSitio, PDO::PARAM_INT);
                        $statement->bindParam(':paths', $target_path, PDO::PARAM_STR);
                        $statement->execute();
                        //	echo "El archivo $filename se ha almacenado en forma exitosa.<br>";
                    } else {
                        //	echo "Ha ocurrido un error, por favor inténtelo de nuevo.<br>";
                    }
                    closedir($dir); //Cerramos el directorio de destino
                }
            }
    }

    public function selectPlatosList($idSitio){
        $statement = $this->pdo->prepare("SELECT p.nombre, p.descripcion
         FROM platos p WHERE p.idSitio = :idSitio");
        $statement->bindParam(':idSitio', $idSitio, PDO::PARAM_INT);
        $statement->execute();
        if ($statement->rowCount() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function selectSitio($idSitio)
    {
        $statement = $this->pdo->prepare(
            'SELECT * FROM sitios WHERE idSitio= :idSitio'
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

    public function selectPlatos($idSitio)
    {
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

    public function selectPlato($idSitio, $idPlato)
    {
        $statement = $this->pdo->prepare("SELECT nombre, descripcion
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
    public function selectInfo($idPlato)
    {
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
            'DELETE FROM listacaractplato WHERE idPlato =:idPlato'
        );
        $statement->bindParam(':idPlato', $idPlato, PDO::PARAM_INT);
        $statement->execute();
    }
    public function eliminarValorPlatos($idPlato)
    {
        $statement = $this->pdo->prepare(
            'DELETE FROM valornutricional WHERE idPlato =:idPlato'
        );
        $statement->bindParam(':idPlato', $idPlato, PDO::PARAM_INT);
        $statement->execute();
    }

    public function eliminarImagenesPlatos($idPlato)
    {
        $statement = $this->pdo->prepare(
            'DELETE FROM imagenesplatos WHERE idPlato =:idPlato'
        );
        $statement->bindParam(':idPlato', $idPlato, PDO::PARAM_INT);
        $statement->execute();
    }

    public function eliminarPlatos($idPlato)
    {
        try {
            $this->pdo->beginTransaction();
            $this->eliminarImagenesPlatos($idPlato);
            $this->eliminarValorPlatos($idPlato);
            $this->eliminarCaracPlatos($idPlato);

            $statement = $this->pdo->prepare(
                'DELETE FROM platos WHERE idPlato =:idPlato'
            );

            $statement->bindParam(':idPlato', $idPlato, PDO::PARAM_INT);
            $statement->execute();
            $this->pdo->commit();
            //  var_dump("commit");
            return 1;
        } catch (\PDOException $e) {
            // rollback the transaction
            $this->pdo->rollBack();
            var_dump('rollBack');
            // show the error message
            return 0;
        }
    }

    public function eliminarCaractSitio($idSitio)
    {
        $statement = $this->pdo->prepare(
            'DELETE FROM listacaractsitio WHERE idSitio =:idSitio'
        );
        $statement->bindParam(':idSitio', $idSitio, PDO::PARAM_INT);
        $statement->execute();
    }

    public function eliminarComentarioSitios($idSitio)
    {
        $statement = $this->pdo->prepare(
            'DELETE FROM comentariositios WHERE idSitio =:idSitio'
        );
        $statement->bindParam(':idSitio', $idSitio, PDO::PARAM_INT);
        $statement->execute();
    }

    public function eliminarHorario($idSitio)
    {
        $statement = $this->pdo->prepare(
            'DELETE FROM horario WHERE idSitio =:idSitio'
        );
        $statement->bindParam(':idSitio', $idSitio, PDO::PARAM_INT);
        $statement->execute();
    }

    public function eliminarImagenesSitios($idSitio)
    {
        $statement = $this->pdo->prepare(
            'DELETE FROM imagenessitios WHERE idSitio =:idSitio'
        );
        $statement->bindParam(':idSitio', $idSitio, PDO::PARAM_INT);
        $statement->execute();
    }

    public function eliminarUbicacion($idSitio)
    {
        $statement = $this->pdo->prepare(
            'DELETE FROM ubicacion WHERE idSitio =:idSitio'
        );
        $statement->bindParam(':idSitio', $idSitio, PDO::PARAM_INT);
        $statement->execute();
    }

    public function eliminarSitio($idSitio)
    {
        try {
            $this->pdo->beginTransaction();

            $this->eliminarCaractSitio($idSitio);
            $this->eliminarComentarioSitios($idSitio);
            $this->eliminarImagenesSitios($idSitio);
            $this->eliminarUbicacion($idSitio);
            $this->eliminarHorario($idSitio);
            $statement = $this->pdo->prepare(
                'DELETE FROM sitios WHERE idSitio =:idSitio'
            );
            $statement->bindParam(':idSitio', $idSitio, PDO::PARAM_INT);
            $statement->execute();
            $this->pdo->commit();
            //  var_dump("commit");
            return 1;
        } catch (\PDOException $e) {
            // rollback the transaction
            $this->pdo->rollBack();
            // var_dump("rollBack");
            // show the error message
            //die($e->getMessage());
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
        $Clave = '%' . $Clave . '%';
        $Provincia = '%' . $Provincia . '%';
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
        $Clave = '%' . $Clave . '%';
        $Provincia = '%' . $Provincia . '%';
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
        $Clave = '%' . $Clave . '%';

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
        $Clave = '%' . $Clave . '%';
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
        $Clave = '%' . $Clave . '%';
        $Provincia = '%' . $Provincia . '%';
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
        $Clave = '%' . $Clave . '%';
        $Provincia = '%' . $Provincia . '%';
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
        $Clave = '%' . $Clave . '%';
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
        $Clave = '%' . $Clave . '%';
        $statement->bindParam(':Clave', $Clave, PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetchColumn();
    }

    public function getDatosUsuario($user)
    {
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

    public function getUsuario($user)
    {
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
}
