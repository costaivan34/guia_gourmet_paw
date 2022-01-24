 <?php

    $router->get('inicio', 'SitioController@index');
    $router->get('contacto', 'PagesController@contacto');
    $router->post('sendConsulta', 'SitioController@sendConsulta');

    $router->post('login', 'UsersController@validarLogin');
    $router->get('dashboard/logout', 'UsersController@cerrarLogin');
    $router->get('logout', 'UsersController@cerrarLogin');

    $router->get('dashboard/account', 'UsersController@dash');
    $router->get('dashboard/sitios', 'UsersController@dash_sitios');
    $router->get('dashboard/plato', 'UsersController@dash_platos');
    $router->get('dashboard/password', 'UsersController@dash_password');
    $router->get('dashboard/setting', 'PagesController@dash');

    $router->get('user/new', 'UsersController@new_user' );
    $router->post('user/CreateUser', 'UsersController@store' );



    $router->post('actualizarPerfil', 'UsersController@actualizarPerfil');
    $router->post('cambioPassword', 'UsersController@actualizarPassword');
    
    
    $router->get('resto', 'SitioController@getOne');
    $router->get('resto/new', 'SitioController@newOne');
    $router->post('resto/CreateResto', 'SitioController@store' );
    $router->post('resto/DeleteResto', 'SitioController@delete' );
    
    $router->get('platos', 'SitioController@getPlatos');
    $router->get('plato', 'PlatoController@getOne');
    $router->get('plato/new', 'PlatoController@newOne');
    $router->post('plato/CreatePlato', 'PlatoController@store' );
    $router->post('plato/DeletePlato', 'PlatoController@delete' );

    $router->get('paginacionPlatos', 'SitioController@getPlatoPage');
    $router->get('categorias', 'SitioController@getCategorias');
    $router->get('mail', 'SitioController@getMail');
    $router->get('cerca', 'SitioController@cerca');
    $router->get('marcadores', 'SitioController@getMarcadores');
    $router->get('buscador', 'SitioController@buscador');
    $router->get('buscar', 'SitioController@buscar');
    
    $router->get('paginacionComentarios', 'SitioController@getComentarioPage');
    $router->get('comentarios', 'SitioController@getComentarios');
    $router->post('sendComentario', 'SitioController@sendComentario');
    $router->get('not_found', 'PagesController@notFound');
    $router->get('internal_error', 'PagesController@internalError');


    
   