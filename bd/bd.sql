--BD INMOBILIARIA EXAMEN

--tabla propietarios
drop table if exists propietarios cascade;
create table propietarios (
    id       	bigserial   constraint pk_propietarios primary key,
    dni     	varchar(9) 	not null constraint uq_propietarios_dni unique,
   	nombre   	varchar(30) not null,
   	telefono  varchar(9)  not null
);

--tabla inmuebles

drop table if exists inmuebles cascade;
create table inmuebles (
    id       			    bigserial   	constraint pk_inmuebles primary key,
    numero				    numeric(9) 		not null constraint uq_inmuebles_numero unique,
    caracteristicas   varchar(90),
   	precio   			    numeric (9) 	not null,
   	habitaciones		  numeric(6),
   	banos				      numeric(2),
   	propietarios_id   bigint       	constraint fk_inmuebles_propietarios
                              			references propietarios (id)
                              			on delete set null on update cascade
);

--tabla extras
drop table if exists extras cascade;
create table extras (
    id            bigserial   constraint pk_extras primary key,
    inmuebles_id  bigint      constraint fk_extras_inmuebles
                              references inmuebles (id)
                              on delete set null on update cascade,
    lavavajillas  boolean     not null,
    trastero      boolean     not null,
    garaje        boolean     not null
);
