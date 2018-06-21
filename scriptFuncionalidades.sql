delete from funcionalidade;
delete from acaofuncionalidade;
ALTER TABLE funcionalidade AUTO_INCREMENT = 1;
ALTER TABLE acaofuncionalidade AUTO_INCREMENT = 1;

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

/*--Acoes Funcionalidades--*/
/*--Usuario--*/
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Exibir', 'restrict/usuario', 'get,post', '8', b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Incluir','restrict/usuario/new', 'get,post', '8', b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Editar', 'restrict/usuario/{id}', 'get,post', '8', b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Ativar', 'restrict/usuario/actdeact/{id}', 'post', '8', b'1');
/*--Tipo imovel--*/
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Exibir', 'restrict/tipoimovel', 'get,post', '2', b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Incluir','restrict/tipoimovel/new', 'get,post', '2', b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Editar', 'restrict/tipoimovel/{id}', 'get,post', '2', b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Ativar', 'restrict/tipoimovel/actdeact/{id}', 'post', '2', b'1');
/*--Item imovel--*/
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Exibir', 'restrict/itemimovel', 'get,post', '3', b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Incluir','restrict/itemimovel/new', 'get,post', '3', b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Editar', 'restrict/itemimovel/{id}', 'get,post', '3', b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Ativar', 'restrict/itemimovel/actdeact/{id}', 'post', '3', b'1');
/*--Estado--*/
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Exibir', 'restrict/estado', 'get,post', '4',b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Incluir','restrict/estado/new', 'get,post', '4', b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Editar', 'restrict/estado/{id}', 'get,post', '4', b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Ativar', 'restrict/estado/actdeact/{id}', 'post', '4', b'1');
/*--Cidade--*/
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Exibir', 'restrict/cidade', 'get,post', '5',b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Incluir','restrict/cidade/new', 'get,post', '5', b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Editar', 'restrict/cidade/{id}', 'get,post', '5', b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Ativar', 'restrict/cidade/actdeact/{id}', 'post', '5', b'1');
INSERT INTO `acaofuncionalidade` (`id`, `nome`, `url`, `metodo`, `funcionalidade_id`,`precisadepermissao`) VALUES (null, 'Exibir Drop Cidade', 'restrict/cidade/getcidadedropdown', 'post', '5', b'0');


/*


select f.nome, a.nome,a.metodo
  from funcionalidade f left join acaofuncionalidade a on f.id = a.funcionalidade_id
                        left join permissao p on a.id = p.acaofuncionalidade_id
                        left join grupo g on g.id = p.grupo_id
where g.id = 1 or g.id is null
order by f.id

*/