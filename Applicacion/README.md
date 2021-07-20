## Instalación

 - Clonar el repositorio
 - Crear un schema de base de datos con algun cliente MySQL
 - Ejecutar los migrations del directorio `sql/` en orden
 - Crear un archivo `config.php` (Hay un ejemplo para copiar en `config.php.example`)
  - Configurar la base de datos creada y los usuarios correspondientes
 - Ejecutar `composer install`

## Deploy / ejecución

### Local

Ejecutar:

```
git clone https://github.com/costaivan34/guia_gourmet_paw
cd Applicacion/
php -S localhost:8888
```

Luego ingresar a http://localhost:8888


