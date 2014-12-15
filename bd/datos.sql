--insercion en propietarios
insert into propietarios(dni, nombre, telefono)
values	('48894440M', 'isaac','956377878'),
		('48834540H', 'paco','956378998'),
		('55534540H', 'jose','956547698'),
		('44434540H', 'lola','956378546'),
        ('12345678Z', 'pepe','956987456');

--insercion en inmuebles
insert into inmuebles(numero, caracteristicas, precio, habitaciones, banos, propietarios_id)
values	(123456789,'Orientacion sur',129000,4,2,1),
		(333456999,'Orientacion norte',170000,5,6,2),
		(333453399,'Orientacion norte',90000,1,1,4),
		(333456988,'Orientacion este',250000,2,3,5),
		(333454499,'Muy bonita',170000,3,4,1),
		(223456999,'Una caja de cerillos',70000,1,1,2),
        (123459599,'Orientacion sur',320000,1,1,3);

--insercion en extras
insert into extras(inmuebles_id,lavavajillas,trastero,garaje)
values	(1,'true','false','true'),
		(2, 'true','true','true'),
		(3,'false','false','false'),
		(4,'false','true','true'),
		(5,'true','false','false'),
		(6,'true', 'true','false'),
		(7,'false','true','false');
