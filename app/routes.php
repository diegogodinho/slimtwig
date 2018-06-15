<?php

$app->get('/',function($request, $response) use ($container){
    return $container->view->render($response, 'public.twig');
})->setName('public');

$app->get('/restrict', 'HomeController:Index')->setName('home');
$app->get('/restrict/login', 'LoginController:Index')->setName('login');
$app->post('/restrict/login', 'LoginController:Login');

$app->group('/restrict', function() {
    //usuario
    $this->get('/usuario', 'UsuarioController:IndexView')->setName('usuario.indexview');
    $this->post('/usuario', 'UsuarioController:All')->setName('usuario');
    $this->get('/usuario/new', 'UsuarioController:CreateView')->setName('usuario.createview');
    $this->post('/usuario/new', 'UsuarioController:Create')->setName('usuario.create');
    $this->get('/usuario/{id}', 'UsuarioController:EditView')->setName('usuario.editview');
    $this->post('/usuario/{id}', 'UsuarioController:Update')->setName('usuario.edit');
    $this->post('/usuario/actdeact/{id}', 'UsuarioController:ActivateDeactivate')->setName('usuario.actdeact');
    $this->get('/logout', 'LoginController:LogOut')->setName('logout');        
    //Foto    
    $this->get('/foto', 'FotoController:IndexView')->setName('foto.indexview');
    $this->post('/foto', 'FotoController:All')->setName('foto');
    $this->get('/foto/new', 'FotoController:CreateView')->setName('foto.createview');
    $this->post('/foto/new', 'FotoController:Create')->setName('foto.create');
    $this->post('/foto/del/{id}', 'FotoController:Delete')->setName('foto.del');    
    $this->post('/foto/setwatermark', 'FotoController:SetWaterMark')->setName('foto.setwatermark');    
    $this->post('/foto/usuario/save', 'FotoController:SaveFotoUsuario')->setName('foto.createfotousuario');    
    //Tags
    $this->get('/itemimovel', 'ItemImovelController:IndexView')->setName('itemimovel.indexview');
    $this->post('/itemimovel', 'ItemImovelController:All')->setName('itemimovel');
    $this->get('/itemimovel/new', 'ItemImovelController:CreateView')->setName('itemimovel.createview');
    $this->post('/itemimovel/new', 'ItemImovelController:Create')->setName('itemimovel.create');
    $this->get('/itemimovel/{id}', 'ItemImovelController:EditView')->setName('itemimovel.editview');
    $this->post('/itemimovel/{id}', 'ItemImovelController:Update')->setName('itemimovel.edit');
    $this->post('/itemimovel/actdeact/{id}', 'ItemImovelController:ActivateDeactivate')->setName('itemimovel.actdeact');
    //Cliente
    $this->get('/cliente', 'ClienteController:IndexView')->setName('cliente.indexview');
    $this->post('/cliente', 'ClienteController:All')->setName('cliente');
    $this->get('/cliente/new', 'ClienteController:CreateView')->setName('cliente.createview');
    //$this->post('/cliente/new', 'ClienteController:Create')->setName('cliente.create');
    $this->get('/cliente/{id}', 'ClienteController:EditView')->setName('cliente.editview');
    // $this->post('/cliente/{id}', 'ClienteController:Update')->setName('cliente.edit');
    $this->post('/cliente/actdeact/{id}', 'ClienteController:ActivateDeactivate')->setName('cliente.actdeact');    
    //TipoImovel
    $this->get('/tipoimovel', 'TipoImovelController:IndexView')->setName('tipoimovel.indexview');
    $this->post('/tipoimovel', 'TipoImovelController:All')->setName('tipoimovel');
    $this->get('/tipoimovel/new', 'TipoImovelController:CreateView')->setName('tipoimovel.createview');
    $this->post('/tipoimovel/new', 'TipoImovelController:Create')->setName('tipoimovel.create');
    $this->get('/tipoimovel/{id}', 'TipoImovelController:EditView')->setName('tipoimovel.editview');
    $this->post('/tipoimovel/{id}', 'TipoImovelController:Update')->setName('tipoimovel.edit');
    $this->post('/tipoimovel/actdeact/{id}', 'TipoImovelController:ActivateDeactivate')->setName('tipoimovel.actdeact');
    //Grupo
    $this->get('/grupo', 'GrupoController:IndexView')->setName('grupo.indexview');
    $this->post('/grupo', 'GrupoController:All')->setName('grupo');
    $this->get('/grupo/new', 'GrupoController:CreateView')->setName('grupo.createview');
    $this->post('/grupo/new', 'GrupoController:Create')->setName('grupo.create');
    $this->get('/grupo/{id}', 'GrupoController:EditView')->setName('grupo.editview');
    $this->post('/grupo/{id}', 'GrupoController:Update')->setName('grupo.edit');
    $this->post('/grupo/actdeact/{id}', 'GrupoController:ActivateDeactivate')->setName('grupo.actdeact');

})->add(new App\Middleware\AuthorizationMiddleware($container));
$app->add(new App\Middleware\ValidationErrorsMiddleware($container));
$app->add(new App\Middleware\OldMiddleware($container));