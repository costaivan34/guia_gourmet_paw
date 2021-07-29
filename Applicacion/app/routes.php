 <?php

    $router->get('', 'SitioController@index');
    $router->get('contacto', 'PagesController@contacto');
    $router->post('sendConsulta', 'SitioController@sendConsulta');

    $router->post('login', 'UsersController@validarLogin');
    $router->get('dashboard/logout', 'UsersController@cerrarLogin');
    $router->get('logout', 'UsersController@cerrarLogin');

    $router->get('dashboard/account', 'UsersController@dash');
    $router->get('dashboard/sitios', 'UsersController@dash_sitios');
    $router->get('dashboard/password', 'UsersController@dash_password');
    $router->get('dashboard/setting', 'PagesController@dash');

    $router->post('actualizarPerfil', 'UsersController@actualizarPerfil');
    $router->post('cambioPassword', 'UsersController@actualizarPassword');
    
    
    $router->get('resto', 'SitioController@getOne');
    $router->get('resto/new', 'PagesController@newOne');
    $router->get('platos', 'SitioController@getPlatos');
    $router->get('plato', 'PlatoController@getOne');
    $router->get('paginacionPlatos', 'SitioController@getPlatoPage');
    $router->get('categorias', 'SitioController@getCategorias');
    $router->get('cerca', 'SitioController@cerca');
    $router->get('marcadores', 'SitioController@getMarcadores');
    $router->get('currentPosition', 'SitioController@currentPosition');

    $router->get('buscador', 'SitioController@buscador');
    $router->get('buscar', 'SitioController@buscar');
    
    $router->get('paginacionComentarios', 'SitioController@getComentarioPage');
    $router->get('comentarios', 'SitioController@getComentarios');
    $router->post('sendComentario', 'SitioController@sendComentario');
    $router->get('not_found', 'PagesController@notFound');
    $router->get('internal_error', 'PagesController@internalError');


    
   