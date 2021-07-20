# Programacion en Ambiente Web -TP Final

## Propuesta

**Nombre del proyecto:**   La Guia Gourmet

**Propósito:**    Sitio de locales gastronomicos.

**Descripción:**

La idea principal que se propone es permitir a los locales gastronomicos poder vender sus servicios a traves de este sitio.
Que les permita mostrar su oferta gastronomica e invitar de forma virtual a que nuevos clientes se acerquen y vivan la experiencia unica que brindan,
mediante imagenes del lugar y de los platos que sirven.
Simplificando la tarea de encontrar un lugar acorde a las necesidades de los clientes,mostrando de forma sencilla su información de contacto y ubicacion.
Sin dejar de lado la historia que cuentan estos locales, mediante una amplia descripcion.

Se propone de esta forma acercar a los dueños de locales gastronomicos a sus clientes,que brinden toda la informacion sobre su negocio y permitan que los usuarios dejen sus opiniones y atraigan más personas.


---

## Tecnologias

- Front-end: HTML, CSS y Javascript.
- Back-end: PHP, utilizando framework otorgado en la cursada de PAW.

---

## Presupuesto funcional

Algunas definiciones:

-**Sitio**: Local Gastronomico.

-**Platos**: Plato elaborado en algún Sitio( Entrada, Plato Principal, Postre ).

-**Usuario**: Usuario logueado en la pagina.

El sistema cuenta con las siguientes **secciones**:


- Home o página principal.
- Listado de Sitios con filtros de busqueda.
- Perfil de Sitio.
- Platos.
- Sitios cercanos al Usuario.
- Perfil del Usuario.
  - Gestor de Sitios.
  - Gestor de información del Usuario 
- Login 
- Nuevo Usuario.

### Tareas

#### Modelo de datos

Informacion que debe persistir el sitio:

- Sitios: Nombre, Descripcion, Imagenes, Horarios, Infrmacion de Contacto, Servicios Disponibles, Ubicación, Lista de Platos, Opiniones.
- Platos: Nombre, Descripción, Imagenes, información Nutricional, Ingredientes.
- Usuarios: Nombre, Mail, listado de Sitios.
- Comentario: Nombre, Mail, titulo, puntuacion de sabor, puntuacion de precio, puntuacion de ambiente. 


#### Home page

![Home](/Diseño/W_Home.png)


#### Portada Sitio Gastronómico

![Home](/Diseño/W_view_Restaurant.png)

#### Portada Plato

![Home](/Diseño/W_view_Plato.png)

#### Busqueda Sitio Gastronómicoss

![Home](/Diseño/W_Busqueda_Restaurantes.png)