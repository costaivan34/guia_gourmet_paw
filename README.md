# Programacion en Ambiente Web -TP Final

## Propuesta

**Nombre del proyecto:**   La Guia Gourmet

**Propósito:**    Sitio de locales gastronómicos.

**Descripción:**

La idea principal que se propone es permitir a los locales gastronómicos poder vender sus servicios a través de este sitio.
Que les permita mostrar su oferta gastronómica e invitar de forma virtual a que nuevos clientes se acerquen y vivan la experiencia única que brindan,
mediante imágenes del lugar y de los platos que sirven.
Simplificando la tarea de encontrar un lugar acorde a las necesidades de los clientes,mostrando de forma sencilla su información de contacto y ubicación.
Sin dejar de lado la historia que cuentan estos locales, mediante una amplia descripción.

Se propone de esta forma acercar a los dueños de locales gastronómicos a sus clientes, brindando toda la informacion sobre su negocio y permitiendo que los usuarios dejen sus opiniones y atraigan a más personas.


---

## Tecnologias

- Front-end: HTML, CSS y Javascript.
- Back-end: PHP, utilizando framework otorgado en la cursada de PAW.

---

## Presupuesto funcional

Algunas definiciones:

-**Sitio**: Local Gastronómico.

-**Platos**: Plato elaborado en algún Sitio( Entrada, Plato Principal, Postre ).

-**Usuario**: Usuario logueado en la página.

El sistema cuenta con las siguientes **secciones**:


- Home o página principal.
- Listado de Sitios con filtros de búsqueda.
- Perfil de Sitio.
- Platos.
- Sitios cercanos al Usuario.
- Perfil del Usuario.
  - Gestor de Sitios.
  - Gestor de información del Usuario 
- Login 
- Nuevo Usuario.


#### Modelo de datos

Información que debe persistir el sitio:

- Sitios: Nombre, Descripción, Imágenes, Horarios, Información de Contacto, Servicios Disponibles, Ubicación, Lista de Platos, Opiniones.
- Platos: Nombre, Descripción, Imágenes, Información Nutricional, Ingredientes.
- Usuarios: Nombre, Mail, listado de Sitios.
- Comentario: Nombre, Mail, Descripción, Puntuación de sabor, Puntuación de precio, Puntuación de ambiente. 


#### Home page

![Home](/Diseño/Inicio.png)


#### Portada Sitio Gastronómico

![Home](/Diseño/Sitio-Descripcion.png)

#### Portada Plato

![Home](/Diseño/Plato-Modal.png)

#### Búsqueda Sitio Gastronómicos

![Home](/Diseño/Buscador.png)
