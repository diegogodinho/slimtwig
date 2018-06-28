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
    $this->get('/usuario/profile', 'UsuarioController:ProfileView')->setName('usuario.profileview');
    $this->post('/usuario/profile', 'UsuarioController:UpdateProfile')->setName('usuario.profile');
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
    //Estado
    $this->get('/estado', 'EstadoController:IndexView')->setName('estado.indexview');
    $this->post('/estado', 'EstadoController:All')->setName('estado');
    $this->get('/estado/new', 'EstadoController:CreateView')->setName('estado.createview');
    $this->post('/estado/new', 'EstadoController:Create')->setName('estado.create');
    $this->get('/estado/{id}', 'EstadoController:EditView')->setName('estado.editview');
    $this->post('/estado/{id}', 'EstadoController:Update')->setName('estado.edit');
    $this->post('/estado/actdeact/{id}', 'EstadoController:ActivateDeactivate')->setName('estado.actdeact');
    //Cidade
    $this->get('/cidade', 'CidadeController:IndexView')->setName('cidade.indexview');
    $this->post('/cidade', 'CidadeController:All')->setName('cidade');
    $this->get('/cidade/new', 'CidadeController:CreateView')->setName('cidade.createview');
    $this->post('/cidade/new', 'CidadeController:Create')->setName('cidade.create');
    $this->post('/cidade/getcidadedropdown', 'CidadeController:GetCidadeDropDownPorEstado')->setName('cidade.cidadedropdown');
    $this->get('/cidade/{id}', 'CidadeController:EditView')->setName('cidade.editview');
    $this->post('/cidade/{id}', 'CidadeController:Update')->setName('cidade.edit');
    $this->post('/cidade/actdeact/{id}', 'CidadeController:ActivateDeactivate')->setName('cidade.actdeact');    
    //Bairro
    $this->get('/bairro', 'BairroController:IndexView')->setName('bairro.indexview');
    $this->post('/bairro', 'BairroController:All')->setName('bairro');
    $this->get('/bairro/new', 'BairroController:CreateView')->setName('bairro.createview');
    $this->post('/bairro/new', 'BairroController:Create')->setName('bairro.create');
    $this->post('/bairro/getbairrodropdown', 'BairroController:GetBairroDropDownPorCidade')->setName('bairro.bairrodropdown');
    $this->get('/bairro/{id}', 'BairroController:EditView')->setName('bairro.editview');
    $this->post('/bairro/{id}', 'BairroController:Update')->setName('bairro.edit');
    $this->post('/bairro/actdeact/{id}', 'BairroController:ActivateDeactivate')->setName('bairro.actdeact');
    //Construtora
    $this->get('/construtora', 'ConstrutoraController:IndexView')->setName('construtora.indexview');
    $this->post('/construtora', 'ConstrutoraController:All')->setName('construtora');
    $this->get('/construtora/new', 'ConstrutoraController:CreateView')->setName('construtora.createview');
    $this->post('/construtora/new', 'ConstrutoraController:Create')->setName('construtora.create');
    $this->post('/construtora/getbairrodropdown', 'ConstrutoraController:GetBairroDropDownPorCidade')->setName('construtora.bairrodropdown');
    $this->get('/construtora/{id}', 'ConstrutoraController:EditView')->setName('construtora.editview');
    $this->post('/construtora/{id}', 'ConstrutoraController:Update')->setName('construtora.edit');
    $this->post('/construtora/actdeact/{id}', 'ConstrutoraController:ActivateDeactivate')->setName('construtora.actdeact');

})->add(new App\Middleware\PermissionMiddleware($container))
->add(new App\Middleware\AuthorizationMiddleware($container));

$app->add(new App\Middleware\ValidationErrorsMiddleware($container));
$app->add(new App\Middleware\OldMiddleware($container));