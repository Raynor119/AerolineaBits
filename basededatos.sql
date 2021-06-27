create table usuario(cedula varchar(13) primary key not null,usuario varchar(255) not null,contraseña varchar(255) not null, email varchar(255) not null,telefono bigint null);

create table persona(cedula varchar(13) primary key not null,nombre varchar(255) not null,roll varchar(255) not null,check(roll='pasajero' or roll='recepcionista'));

alter table usuario
add foreign key (cedula) references persona(cedula);

create table aeropuerto(codigo varchar(13) primary key not null,nombre varchar(255) not null,ciudad varchar(255) not null,siglas varchar(255) not null);

create table reserva(id serial,cedulaU varchar(13)not null,Estado_reserva varchar(255) not null default "no pago",idEquipaje int null,idVuelo int not null,
								idPago int null);
alter table reserva
add primary key (id);

create table equipaje(id INT NOT NULL AUTO_INCREMENT,tipo_maleta varchar(255) not null,PRIMARY KEY (id));

create table vuelos(id int not null AUTO_INCREMENT,fecha date not null default now(),
								CodAO varchar(13) not null,CodAD varchar(13) not null,puestos int default 0,PRIMARY KEY (id));

create table pago(id int not null AUTO_INCREMENT,formadepago varchar(255) not null,cuenta varchar(255) not null,
							bancoApagar varchar(255) not null,monto bigint not null,PRIMARY KEY (id));


alter table reserva
add foreign key (cedulaU) references usuario(cedula),
add foreign key (idVuelo) references vuelos(id),
add foreign key (idPago) references pago(id),
add foreign key (idEquipaje) references equipaje(id);

alter table vuelos
add foreign key (CodAO) references aeropuerto(codigo),
add foreign key (CodAD) references aeropuerto(codigo);

insert into persona (cedula,nombre,roll) values("1005035317","camilo","recepcionista");
insert into usuario (cedula,usuario,contraseña,email,telefono) values("1005035317","raynor","67895421d","raynor119@gmail.com",3134646360);

insert into persona (cedula,nombre,roll) values("1005035318","Steven","pasajero");
insert into usuario (cedula,usuario,contraseña,email,telefono) values("1005035318","pasajero1","123456789","raynor119@gmail.com",3134646360);

insert into aeropuerto (codigo,nombre,ciudad,siglas) values("1A2P3","Aeropuerto Internacional El Dorado","Bogota","A.I.E.D");
insert into aeropuerto (codigo,nombre,ciudad,siglas) values("2A3P4","Aeropuerto Internacional Camilo Daza","Cucuta","A.I.C.D");
insert into aeropuerto (codigo,nombre,ciudad,siglas) values("3A4P1","Aeropuerto Internacional Alfonso Bonilla Aragon","Cali","A.I.A.B.A");
insert into aeropuerto (codigo,nombre,ciudad,siglas) values("4A1P3","Aeropuerto Internacional Rafael Nuñez","Cartagena","A.I.R.N");
insert into aeropuerto (codigo,nombre,ciudad,siglas) values("5A3P8","Aeropuerto Internacional Palonegro","Bucaramanga","A.I.P");
insert into aeropuerto (codigo,nombre,ciudad,siglas) values("6A2P1","Aeropuerto Aguas Claras","Ocaña","A.A.C");

insert into vuelos (CodAO,CodAD) values("1A2P3","6A2P1");
insert into vuelos (CodAO,CodAD) values("1A2P3","3A4P1");
insert into vuelos (CodAO,CodAD) values("1A2P3","2A3P4");
insert into vuelos (CodAO,CodAD) values("1A2P3","5A3P8");
insert into vuelos (CodAO,CodAD) values("1A2P3","4A1P3");
insert into vuelos (CodAO,CodAD) values("2A3P4","1A2P3");
insert into vuelos (CodAO,CodAD) values("2A3P4","4A1P3");
insert into vuelos (CodAO,CodAD) values("2A3P4","3A4P1");
insert into vuelos (CodAO,CodAD) values("2A3P4","5A3P8");
insert into vuelos (CodAO,CodAD) values("2A3P4","6A2P1");


