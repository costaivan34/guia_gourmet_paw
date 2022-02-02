## Instalación

 - Clonar el repositorio
 - Crear un schema de base de datos con algun cliente MySQL.
 - Importar el archivo `db_import.sql` del directorio `sql/` al schema creado anteriormente.
 - Si desea utilizar datos de ejemplo para probar el sistema, importe el archivo `datos_ejemplos.sql`
  - Configurar la base de datos creada y los usuarios correspondientes
  - Crear un archivo `config.php` (Hay un ejemplo para copiar en `config.php.example`)
 - Ejecutar `composer install`

## Deploy / ejecución

### Local

Ejecutar:

```
git clone https://github.com/costaivan34/guia_gourmet_paw
cd Applicacion/
php -S localhost:8888
```

Luego ingresar a http://localhost:8888/inicio

### Online

Ingresar a https://la-guia-gourmet.000webhostapp.com/inicio
