CREATE DATABASE db_2ads;

USE db_2ads;
create table tb_usuario(
	id int auto_increment primary key,
    email varchar(50),
    senha varchar(50),
    ativo varchar(1)
);

create table tb_produto(
	id_prod int primary key auto_increment,
    cod_prod int,
    nome_prod varchar(60),
	descricao_prod varchar(100),
    preco_prod decimal(10,2),
    img_path varchar (100)
);

insert into tb_produto values (null, 'Teste', 'TesteTeste',10.2,'jkhsgfdsgkjdsa');
select * from tb_produto where cod_prod = 1;

create table tb_black(
    data_inicio datetime,
    data_fim datetime,
    ano varchar(4)
);


select * from tb_produto;

insert into tb_produto values(null,11,'Teste2','TestandoNovamente',10.50,'img/path.teste');
insert into tb_produto values(null,10,'Teste','Testando',10.5,'img/path.teste');

update tb_produto 
set cod_prod=20
where cod_prod=10;

insert into tb_usuario (id,email,senha,ativo) values (null,'adminz@email.com','12345678','s'); 