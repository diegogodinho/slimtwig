delete from funcionalidade;
delete from acaofuncionalidade;
delete from permissao;
ALTER TABLE funcionalidade AUTO_INCREMENT = 1;
ALTER TABLE acaofuncionalidade AUTO_INCREMENT = 1;
ALTER TABLE permissao AUTO_INCREMENT = 1;

/*---Funcionalidades--*/
INSERT INTO `funcionalidade` (`id`, `nome`, `pai_id`, `acessar`) VALUES (1, 'Cadastros Basicos', null, b'1');
INSERT INTO `funcionalidade` (`id`, `nome`, `pai_id`, `acessar`) VALUES (2, 'Tipo de Imovel', 1, b'1');
INSERT INTO `funcionalidade` (`id`, `nome`, `pai_id`, `acessar`) VALUES (3, 'Item de Imovel', 1, b'1');
INSERT INTO `funcionalidade` (`id`, `nome`, `pai_id`, `acessar`) VALUES (4, 'Estado', 1, b'1');
INSERT INTO `funcionalidade` (`id`, `nome`, `pai_id`, `acessar`) VALUES (5, 'Cidade', 1, b'1');
INSERT INTO `funcionalidade` (`id`, `nome`, `pai_id`, `acessar`) VALUES (6, 'Bairro', 1, b'1');

INSERT INTO `funcionalidade` (`id`, `nome`, `pai_id`, `acessar`) VALUES (7, 'Seguranca', null, b'1');
INSERT INTO `funcionalidade` (`id`, `nome`, `pai_id`, `acessar`) VALUES (8, 'Cadastros de Usuarios', 7, b'1');
INSERT INTO `funcionalidade` (`id`, `nome`, `pai_id`, `acessar`) VALUES (9, 'Grupos e Permissoes', 7, b'1');

/*Rotas Padrao que todos os usuarios devem ter acesso*/
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'home', '/restrict', 'get,post', '8', b'0');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'home', '/restrict/logout', 'get,post', '8', b'0');

/*--Acoes Funcionalidades--*/
/*--Usuario--*/
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Exibir', '/restrict/usuario', 'get,post', '8', b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Incluir','/restrict/usuario/new', 'get,post', '8', b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Editar', '/restrict/usuario/{id}', 'get,post', '8', b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Ativar', '/restrict/usuario/actdeact/{id}', 'post', '8', b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Editar Profile', '/restrict/usuario/profile', 'get,post', '8', b'0');
/*--Tipo imovel--*/
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Exibir', '/restrict/tipoimovel', 'get,post', '2', b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Incluir','/restrict/tipoimovel/new', 'get,post', '2', b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Editar', '/restrict/tipoimovel/{id}', 'get,post', '2', b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Ativar', '/restrict/tipoimovel/actdeact/{id}', 'post', '2', b'1');
/*--Item imovel--*/
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Exibir', '/restrict/itemimovel', 'get,post', '3', b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Incluir','/restrict/itemimovel/new', 'get,post', '3', b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Editar', '/restrict/itemimovel/{id}', 'get,post', '3', b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Ativar', '/restrict/itemimovel/actdeact/{id}', 'post', '3', b'1');
/*--Estado--*/
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Exibir', '/restrict/estado', 'get,post', '4',b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Incluir','/restrict/estado/new', 'get,post', '4', b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Editar', '/restrict/estado/{id}', 'get,post', '4', b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Ativar', '/restrict/estado/actdeact/{id}', 'post', '4', b'1');
/*--Cidade--*/
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Exibir', '/restrict/cidade', 'get,post', '5',b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Incluir','/restrict/cidade/new', 'get,post', '5', b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Editar', '/restrict/cidade/{id}', 'get,post', '5', b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Ativar', '/restrict/cidade/actdeact/{id}', 'post', '5', b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Exibir Drop Cidade', '/restrict/cidade/getcidadedropdown', 'post', '5', b'0');
/*--Bairro--*/
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Exibir', '/restrict/bairro', 'get,post', '6',b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Incluir','/restrict/bairro/new', 'get,post', '6', b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Editar', '/restrict/bairro/{id}', 'get,post', '6', b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Ativar', '/restrict/bairro/actdeact/{id}', 'post', '6', b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Exibir Drop Bairro', '/restrict/bairro/getcidadedropdown', 'post', '6', b'0');
/*--Grupos E Permissoes--*/
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Exibir', '/restrict/grupo', 'get,post', '9',b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Incluir','/restrict/grupo/new', 'get,post', '9', b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Editar', '/restrict/grupo/{id}', 'get,post', '9', b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Ativar', '/restrict/grupo/actdeact/{id}', 'post', '9', b'1');

/*


select * from funcionalidade f left join acaofuncionalidade a on f.id = a.id
left join permissao p on a.id = p.acaofuncionalidade_id
left join grupo g on p.grupo_id = g.id
where g.id = 2 or a.precisadepermissao = 0

*/