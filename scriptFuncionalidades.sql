delete from funcionalidade;
delete from acaofuncionalidade;
delete from permissao;
ALTER TABLE funcionalidade AUTO_INCREMENT = 1;
ALTER TABLE acaofuncionalidade AUTO_INCREMENT = 1;
ALTER TABLE permissao AUTO_INCREMENT = 1;
 

/*---Funcionalidades--*/
INSERT INTO `funcionalidade` (`id`, `nome`, `pai_id`, `acessar`) VALUES (null, 'Cadastros Basicos', null, b'1');
select @idCadastrosBasicos := LAST_INSERT_ID();

INSERT INTO `funcionalidade` (`id`, `nome`, `pai_id`, `acessar`) VALUES (null, 'Tipo de Imovel', @idCadastrosBasicos, b'1');
select @idTipoImovel := LAST_INSERT_ID();
INSERT INTO `funcionalidade` (`id`, `nome`, `pai_id`, `acessar`) VALUES (null, 'Item de Imovel', @idCadastrosBasicos, b'1');
select @idItemImovel := LAST_INSERT_ID();
INSERT INTO `funcionalidade` (`id`, `nome`, `pai_id`, `acessar`) VALUES (null, 'Estado', @idCadastrosBasicos, b'1');
select @idEstado := LAST_INSERT_ID();
INSERT INTO `funcionalidade` (`id`, `nome`, `pai_id`, `acessar`) VALUES (null, 'Cidade', @idCadastrosBasicos, b'1');
select @idCidade := LAST_INSERT_ID();
INSERT INTO `funcionalidade` (`id`, `nome`, `pai_id`, `acessar`) VALUES (null, 'Bairro', @idCadastrosBasicos, b'1');
select @idBairro := LAST_INSERT_ID();
INSERT INTO `funcionalidade` (`id`, `nome`, `pai_id`, `acessar`) VALUES (null, 'Construtora', @idCadastrosBasicos, b'1');
select @idConstrutora := LAST_INSERT_ID();

INSERT INTO `funcionalidade` (`id`, `nome`, `pai_id`, `acessar`) VALUES (null, 'Seguranca', null, b'1');
select @idSeguranca := LAST_INSERT_ID();
INSERT INTO `funcionalidade` (`id`, `nome`, `pai_id`, `acessar`) VALUES (null, 'Cadastros de Usuarios', @idSeguranca, b'1');
select @idCadastrosDeUsuarios := LAST_INSERT_ID();
INSERT INTO `funcionalidade` (`id`, `nome`, `pai_id`, `acessar`) VALUES (null, 'Grupos e Permissoes', @idSeguranca, b'1');
select @idGruposEPermissoes := LAST_INSERT_ID();

/*Rotas Padrao que todos os usuarios devem ter acesso*/
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'home', '/restrict', 'get,post', '1', b'0');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'home', '/restrict/logout', 'get,post', '1', b'0');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Salvar fotos de Perfil', '/restrict/foto/usuario/save', 'get,post', '1', b'0');

/*--Acoes Funcionalidades--*/
/*--Tipo imovel--*/
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Exibir', '/restrict/tipoimovel', 'get,post', @idTipoImovel, b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Incluir','/restrict/tipoimovel/new', 'get,post', @idTipoImovel, b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Editar', '/restrict/tipoimovel/{id}', 'get,post', @idTipoImovel, b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Ativar', '/restrict/tipoimovel/actdeact/{id}', 'post', @idTipoImovel, b'1');
/*--Item imovel--*/
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Exibir', '/restrict/itemimovel', 'get,post', @idItemImovel, b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Incluir','/restrict/itemimovel/new', 'get,post', @idItemImovel, b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Editar', '/restrict/itemimovel/{id}', 'get,post', @idItemImovel, b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Ativar', '/restrict/itemimovel/actdeact/{id}', 'post', @idItemImovel, b'1');
/*--Estado--*/
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Exibir', '/restrict/estado', 'get,post', @idEstado,b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Incluir','/restrict/estado/new', 'get,post', @idEstado, b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Editar', '/restrict/estado/{id}', 'get,post', @idEstado, b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Ativar', '/restrict/estado/actdeact/{id}', 'post', @idEstado, b'1');
/*--Cidade--*/
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Exibir', '/restrict/cidade', 'get,post', @idCidade,b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Incluir','/restrict/cidade/new', 'get,post', @idCidade, b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Editar', '/restrict/cidade/{id}', 'get,post', @idCidade, b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Ativar', '/restrict/cidade/actdeact/{id}', 'post', @idCidade, b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Exibir Drop Cidade', '/restrict/cidade/getcidadedropdown', 'post', @idCidade, b'0');
/*--Bairro--*/
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Exibir', '/restrict/bairro', 'get,post', @idBairro,b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Incluir','/restrict/bairro/new', 'get,post', @idBairro, b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Editar', '/restrict/bairro/{id}', 'get,post', @idBairro, b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Ativar', '/restrict/bairro/actdeact/{id}', 'post', @idBairro, b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Exibir Drop Bairro', '/restrict/bairro/getbairrodropdown', 'post', @idBairro, b'0');
/*--Construtora--*/
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Exibir', '/restrict/construtora', 'get,post', @idConstrutora,b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Incluir','/restrict/construtora/new', 'get,post', @idConstrutora, b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Editar', '/restrict/construtora/{id}', 'get,post', @idConstrutora, b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Ativar', '/restrict/construtora/actdeact/{id}', 'post', @idConstrutora, b'1');
/*--Usuario--*/
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Exibir', '/restrict/usuario', 'get,post', @idCadastrosDeUsuarios, b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Incluir','/restrict/usuario/new', 'get,post', @idCadastrosDeUsuarios, b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Editar', '/restrict/usuario/{id}', 'get,post', @idCadastrosDeUsuarios, b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Ativar', '/restrict/usuario/actdeact/{id}', 'post', @idCadastrosDeUsuarios, b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Editar Profile', '/restrict/usuario/profile', 'get,post', @idCadastrosDeUsuarios, b'0');

/*--Grupos E Permissoes--*/
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Exibir', '/restrict/grupo', 'get,post', @idGruposEPermissoes,b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Incluir','/restrict/grupo/new', 'get,post', @idGruposEPermissoes, b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Editar', '/restrict/grupo/{id}', 'get,post', @idGruposEPermissoes, b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Ativar', '/restrict/grupo/actdeact/{id}', 'post', @idGruposEPermissoes, b'1');
/*


select * from funcionalidade f left join acaofuncionalidade a on f.id = a.id
left join permissao p on a.id = p.acaofuncionalidade_id
left join grupo g on p.grupo_id = g.id
where g.id = 2 or a.precisadepermissao = 0

*/