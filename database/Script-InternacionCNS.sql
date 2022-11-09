create table tipo_usuarios
(
	id 							  serial primary key,
	referencia				varchar(50),
	nivel_usuario			integer
);

insert into tipo_usuarios (referencia ,nivel_usuario) 
	values ('ADMINISTRADOR',1),('MEDICO',2),('ENFERMERA',3),('AUXILIAR',3),('ESTADISTICO',3);

create table usuarios
(
	id 								  serial primary key,
	nick_usuario			  varchar(50),
	nombre_usuario			varchar(50),	
	paterno_usuario			varchar(50),
	materno_usuario			varchar(50),	
	clave_usuario		 	  varchar(150),
	estado_usuario			integer default 0,
	fecha_creacion			timestamp without time zone DEFAULT now(),
	id_tipo_usuario			integer,
	eliminado 				  integer default 0,
	foreign key(id_tipo_usuario) references tipo_usuarios(id)	
);
/* estado usuario
 * 0 = Inactivo
 * 1 = Activo 
 * eliminado
 * 0 = no eliminado
 * 1 = eliminado*/

insert into usuarios (nick_usuario, nombre_usuario, paterno_usuario, materno_usuario, clave_usuario, id_tipo_usuario) 
values ('ADMIN', 'ROMMEL', 'MAMANI', 'MONTOYA', '$2a$07$asxx54ahjppf45sd87a5auClwFRoHFg67zDiW.ep7ruyd9bNvbgiu', 1)

create table departamentos
(
	id 										  serial primary key,
	nombre_departamento			varchar(50),
	abrev_departamento			varchar(10)	
);

insert into departamentos (nombre_departamento,abrev_departamento) 
values ('CHUQUISACA','CH'),('LA PAZ','LP'),('COCHABAMBA','CB'),('ORURO','OR'),('POTOSI','PT'),('TARIJA','TJ'),('SANTA CRUZ','SC'),('BENI','BE'),('PANDO','PD')

create table establecimientos
(
	id 													serial primary key,
	nombre_establecimiento		  varchar(50),
	abrev_establecimiento		    varchar(20),	
	ubicacion_establecimiento	  varchar(50),
	id_departamento				      integer,	
	eliminado 					        integer default 0,
	foreign key(id_departamento) references departamentos(id)	
);
/* eliminado
 * 0 = no eliminado
 * 1 = eliminado*/

insert into establecimientos (nombre_establecimiento,abrev_establecimiento,ubicacion_establecimiento,id_departamento) 
values ('HOSPITAL OBRERO NRO.5','HO5','AV. EL MAESTRO S/N',5),('CIMFA 10 DE NOVIEMBRE','CIMFA 10 NOV','AV. UNIVERSITARIA S/N',5)

create table tipo_servicios
(
	id 									serial primary key,
	tipo_servicio				varchar(50)
);

insert into tipo_servicios (tipo_servicio) 
values ('INTERNACION'),('CONSULTA EXTERNA'),('EMERGENCIA'),('CONSULTA FAMILIAR')

create table consultorios
(
	id 									serial primary key,
	nombre_consultorio	varchar(50),
	id_tipo_servicio		integer,		
	eliminado 					integer default 0,
	foreign key(id_tipo_servicio) references tipo_servicios(id)	
);
/* eliminado
 * 0 = no eliminado
 * 1 = eliminado*/
insert into consultorios (nombre_consultorio,id_tipo_servicio) 
values ('EMERGENCIA',3),('CONSULTA EXTERNA',2),('ZONA 1',4),('ZONA 2',4),('ZONA 3',4),('ZONA 4',4),('ZONA 5',4),('ZONA 6',4),('ZONA 7',4),('ZONA 8',4),('ZONA 9',4),('ZONA 10',4),('ZONA 11',4),('ZONA 12',4),('ZONA 13',4),('ZONA 14',4),('ZONA 15',4),('ZONA 16',4),('ZONA 17',4),('ZONA 18',4),('ZONA 19',4),('ZONA 20',4),('ZONA 21',4),('ZONA 22',4),('ZONA 23',4)

create table servicios
(
	id 									serial primary key,
	nombre_servicio			varchar(50),
	id_establecimiento	integer,
	id_tipo_servicio		integer,		
	foreign key(id_establecimiento) references establecimientos(id),
	foreign key(id_tipo_servicio) references tipo_servicios(id)
);

insert into servicios (nombre_servicio,id_establecimiento,id_tipo_servicio) 
values ('PEDIATRIA',1,1),('MATERNIDAD GINECOLOGIA',1,1),('NEONATOLOGIA',1,1),('MEDICINA INTERNA',1,1),('CIRUGIA',1,1),('NEUMOLOGIA',1,1),('UTI',1,1)

create table especialidades
(
	id 										serial primary key,
	nombre_especialidad		varchar(50),
	id_servicio						integer,
	codigo_especialidad		integer,
	foreign key(id_servicio) references servicios(id)
);

insert into especialidades (nombre_especialidad,id_servicio,codigo_especialidad) 
values ('MEDICINA INTERNA',4,10),('GASTROENTEROLOGIA',4,25),('CARDIOLOGIA',4,3),('NEUROLOGIA',4,32),('NEFROLOGIA',4,24),('ENDOCRINOLOGIA',4,12),('ONCOLOGIA',4,2),('HEMATOLOGIA',4,26),('REUMATOLOGIA',4,21),('PSIQUIATRA',4,18),('OTORRINOLARINGOLOGIA',4,15),('OFTALMOLOGIA',4,13),('UROLOGIA',4,20),
('CIRUGIA GENERAL',5,4),('NEUROCIRUGIA',5,11),('TRAUMATOLOGIA',5,19),
('NEUMOLOGIA',6,36),
('PEDIATRIA',1,16),
('NEONATOLOGIA',3,30),
('UTI',7,38),
('GINECOLOGIA',2,7),('MATERNIDAD',2,35)

create table medicos
(
	id									serial primary key,
	nombre_medico				varchar(50),
	paterno_medico			varchar(50),	
	materno_medico			varchar(50),
	matricula_medico		varchar(20),
	prefijo_medico			varchar(20),
	direccion_medico		varchar(100),
	telefono_medico			varchar(10),
	clave_medico				varchar(20),
	eliminado 					integer default 0,
	id_especialidad 		integer,
	foreign key(id_especialidad) references especialidades(id)	
);
/* eliminado
 * 0 = no eliminado
 * 1 = eliminado*/

create table anestesiologos
(
	id												serial primary key,
	nombre_anestesiologo			varchar(50),
	paterno_anestesiologo			varchar(50),	
	materno_anestesiologo			varchar(50),
	matricula_anestesiologo		varchar(20),
	prefijo_anestesiologo			varchar(20),
	direccion_anestesiologo		varchar(100),
	telefono_anestesiologo		varchar(10),
	clave_anestesiologo				varchar(20),
	tipo_anestesiologo				varchar(20),
	eliminado 								integer default 0
);
/* eliminado
 * 0 = no eliminado
 * 1 = eliminado*/ 

insert into anestesiologos (nombre_anestesiologo,paterno_anestesiologo,materno_anestesiologo,matricula_anestesiologo,prefijo_anestesiologo,direccion_anestesiologo,telefono_anestesiologo,clave_anestesiologo,tipo_anestesiologo) 
values ('IVANNA MARIANA','URIOSTE','ROJAS','','DRA.','','','','MEDICO'),
('JULIO','CONTRERAS','MONTECINOS','','DR.','','','','MEDICO'),
('ROXANA XIMENA','SANCHEZ','MARTINEZ','','DRA.','','','','MEDICO'),
('RUBEN L.','ALBIS','TARDIO','','DR.','','','','MEDICO'),
('ANA LUISA','MORALES','RODRIGUEZ','','DRA.','','','','MEDICO')

create table salas
(
	id 								serial primary key,
	nombre_sala				varchar(50),
	descripcion_sala	varchar(50),
	id_servicio				integer,		
	eliminado 				integer default 0,
	foreign key(id_servicio) references servicios(id)	
);
/* eliminado
 * 0 = no eliminado
 * 1 = eliminado*/

insert into salas (nombre_sala,descripcion_sala,id_servicio) 
values ('SALA RESERVADO','',1),('SALA #1','',1),('SALA #2','',1),('SALA #3','',1),
('SALA #1 ARO','',2),('SALA #2','',2),('SALA #6','',2),('SALA #7','',2),('SALA #8 PUERPERIO QUIRURGICO','',2),('SALA #10','',2),('SALA #11','',2),('SALA #12','',2),('SALA #13','',2),
('SALA RECEPCION','RECEPCION',3),('SALA UCIN','TERAPIA INTERMEDIA',3),('SALA UTI','TERAPIA INTENSIVA',3),('SALA SEPTICA','SEPTICA',3),
('BLOQUE A','',4),('BLOQUE B','',4),('BLOQUE C','',4),
('SALA #1','',5),('SALA #2','',5),('SALA #3','',5),('SALA #4','',5),('SALA #5','',5),('SALA #6','',5),('SALA #7','',5),('SALA #8','',5),('SALA #9','',5),('SALA #10','',5),('SALA #11','',5),
('SALA #1','',6),('SALA #2','',6),('SALA #3','',6),('SALA #4','',6),('SALA #5','',6),('SALA #6','',6),
('SALA #1','',7)

create table camas
(
	id 								  serial primary key,
	nombre_cama		      varchar(50),
	descripcion_cama		varchar(50),
	id_sala					    integer,
	id_especialidad			integer,
	estado_cama			    integer default 0,		
	eliminado 				  integer default 0,
	foreign key(id_sala) references salas(id),
	foreign key(id_especialidad) references especialidades(id)	
);
/* eliminado
 * 0 = no eliminado
 * 1 = eliminado*/

 /* estado_cama
 * 0 = libre
 * 1 = ocupado*/

insert into camas (nombre_cama,descripcion_cama,id_sala)
values ('CAMA 1 UTI','',1),('CAMA 2 UTI','',1),
('CAMA 1','',2),('CAMA 2','',2),('CAMA 3','',2),('CAMA 4','',2),('CAMA 5','',2),('CAMA 6','',2),
('CAMA 7','',3),('CAMA 8','',3),('CAMA 9','',3),('CAMA 10','',3),('CAMA 11','',3),
('CAMA 12','',4),('CAMA 13','',4),('CAMA 14','',4),('CAMA 15','',4),('CAMA 16','',4),('CAMA 17','',4),
('CAMA 1','',5),('CAMA 2','',5),('CAMA 3','',5),
('CAMA 4','',6),
('CAMA 6','',7),('CAMA 7','',7),('CAMA 8','',7),
('CAMA 9','',8),('CAMA 10','',8),('CAMA 11','',8),
('CAMA 12','',9),('CAMA 13','',9),('CAMA 14','',9),
('CAMA 15','',10),('CAMA 16','',10),
('CAMA 17','',11),('CAMA 18','',11),('CAMA 19','',11),
('CAMA 20','',12),('CAMA 21','',12),('CAMA 22','',12),
('CAMA 23','',13),('CAMA 24','',13),('CAMA 25','',13),
('UNIDAD 1','',14),('UNIDAD 2','',14),('UNIDAD 3','',14),
('UNIDAD 1','',15),('UNIDAD 2','',15),('UNIDAD 3','',15),('UNIDAD 4','',15),('UNIDAD 5','',15),('UNIDAD 6','',15),
('UNIDAD 1','',16),('UNIDAD 2','',16),('UNIDAD 3','',16),('UNIDAD 4','',16),
('UNIDAD 1','',17),('UNIDAD 2','',17),('UNIDAD 3','',17),('UNIDAD 4','',17),('UNIDAD 5','',17),
('CAMA 1','',18),('CAMA 2','',18),('CAMA 3','',18),('CAMA 4','',18),('CAMA 5','',18),('CAMA 6','',18),('CAMA 7','',18),('CAMA 8','',18),('CAMA 9','',18),('CAMA 10','',18),('CAMA 11','',18),('CAMA 12','',18),('CAMA 13','',18),('CAMA 14','',18),('CAMA 15','',18),('CAMA 16','',18),('CAMA 17','',18),('CAMA 18','',18),
('CAMA 19','',19),('CAMA 20','',19),('CAMA 21','',19),('CAMA 22','',19),('CAMA 23','',19),('CAMA 24','',19),('CAMA 25','',19),('CAMA 26','',19),('CAMA 27','',19),('CAMA 28','',19),('CAMA 29','',19),
('CAMA 30','',20),('CAMA 31','',20),('CAMA 32','',20),('CAMA 33','',20),('CAMA 34','',20),('CAMA 35','',20),('CAMA 36','',20),('CAMA 37','',20),('CAMA 38','',20),('CAMA 39','',20),('CAMA 40','',20),('CAMA 41','',20),('CAMA 42','',20),('CAMA 43','',20),('CAMA 44','',20),
('CAMA 1','',21),('CAMA 2','',21),
('CAMA 3','',22),('CAMA 4','',22),('CAMA 5','',22),
('CAMA 6','',23),('CAMA 7','',23),('CAMA 8','',23),
('CAMA 10','',24),('CAMA 11','',24),('CAMA 12','',24),('CAMA 13','',24),('CAMA 14','',24),
('CAMA 15','',25),('CAMA 16','',25),('CAMA 17','',25),('CAMA 18','',25),('CAMA 19','',25),('CAMA 20','',25),
('CAMA 21','',26),('CAMA 22','',26),('CAMA 23','',26),
('CAMA 24','',27),('CAMA 25','',27),('CAMA 26','',27),('CAMA 27','',27),('CAMA 28','',27),
('CAMA 29','',28),('CAMA 30','',28),('CAMA 31','',28),('CAMA 32','',28),('CAMA 33','',28),
('CAMA 34','',29),('CAMA 35','',29),('CAMA 36','',29),('CAMA 37','',29),('CAMA 38','',29),
('CAMA 39','',30),('CAMA 40','',30),('CAMA 41','',30),('CAMA 42','',30),
('CAMA 43','',31),('CAMA 44','',31),
('CAMA 1','',32),('CAMA 2','',32),
('CAMA 3','',33),('CAMA 4','',33),('CAMA 5','',33),('CAMA 6','',33),('CAMA 7','',33),
('CAMA 8','',34),('CAMA 9','',34),('CAMA 10','',34),('CAMA 11','',34),('CAMA 12','',34),('CAMA 13','',34),
('CAMA 14','',35),('CAMA 15','',35),
('CAMA 16','',36),('CAMA 17','',36),('CAMA 18','',36),
('CAMA 19','',37),('CAMA 20','',37),
('CAMA 1','',38),('CAMA 2','',38),('CAMA 3','',38),('CAMA 4','',38),('CAMA 5','',38)

create table pacientes
(
	id 									serial primary key,
	nombre_paciente			varchar(50),
	paterno_paciente		varchar(50),	
	materno_paciente		varchar(50),
	documento_ci				varchar(20),
	cod_asegurado				varchar(20),	
	cod_beneficiario	 	varchar(20),
	fecha_nacimiento		date,
	estado_civil				varchar(20),
	sexo								varchar(10),
	domicilio						varchar(100),
	telefono 						varchar(10),
	nro_empleador				varchar(20),
	nombre_empleador		varchar(100),
	estado_asegurado		varchar(20),
	particular					integer default 0,
	eliminado 					integer default 0,
	id_consultorio			integer,
	foreign key(id_consultorio) references consultorios(id)	
);
/* particular
 * 0 = paciente afiliado
 * 1 = paciente particular*/
/* eliminado
 * 0 = no eliminado
 * 1 = eliminado*/

create table grupo_cie10
(
	id 						serial primary key,
	nombre				varchar(300),
	eliminado			integer default 0	
);
/* eliminado
 * 0 = no eliminado
 * 1 = eliminado*/

create table cie10
(
	id 							serial primary key,
	codigo					varchar(10),
	descripcion			varchar(300),	
	id_grupo_cie10	integer,
	tipo						varchar(20),
	eliminado 			integer default 0,
	foreign key(id_grupo_cie10) references grupo_cie10(id)	
);
/* eliminado
 * 0 = no eliminado
 * 1 = eliminado*/

create table paciente_ingresos
(
	id 												      serial primary key,
	fecha_ingreso			              date,
	hora_ingreso			              time,	
	estado_paciente			            integer default 0,
	maternidad			  		          integer default 0,
	neonato			  		    		      integer default 0,
	id_cie10				                integer,
	diagnostico_especifico1		      text,
	diagnostico_especifico2		      text,
	diagnostico_especifico3		      text,
	id_consultorio	                integer,
	id_medico				                integer,
	id_paciente				              integer,
	id_establecimiento		          integer,	
	id_servicio		 						      integer,
	id_especialidad						      integer,
	id_sala					                integer,
	id_cama					                integer,
	referencia											integer default 0,
	transferencia											integer default 0,
	foreign key(id_cie10) references cie10(id),
	foreign key(id_medico) references medicos(id),
	foreign key(id_consultorio) references consultorios(id),
	foreign key(id_paciente) references pacientes(id),
	foreign key(id_establecimiento) references establecimientos(id),
	foreign key(id_servicio) references servicios(id),
	foreign key(id_especialidad) references especialidades(id),
	foreign key(id_sala) references salas(id),
	foreign key(id_cama) references camas(id)
);
/* estado ingreso
 * 0 = Ingresado
 * 1 = Dado de Alta */

create table paciente_internados
(
	id 												serial primary key,
	estado_internado		      integer default 0,
	diagnostico_especifico1		text,
	diagnostico_especifico2		text,
	diagnostico_especifico3		text,
	id_medico				          integer,
	id_paciente				        integer,
	id_establecimiento		    integer,	
	id_servicio		 						integer,
	id_especialidad						integer,
	id_sala					          integer,
	id_cama					          integer,
	id_paciente_ingreso				integer,
	foreign key(id_medico) references medicos(id),
	foreign key(id_paciente) references pacientes(id),
	foreign key(id_establecimiento) references establecimientos(id),
	foreign key(id_servicio) references servicios(id),
	foreign key(id_especialidad) references especialidades(id),
	foreign key(id_sala) references salas(id),
	foreign key(id_cama) references camas(id),
	foreign key(id_paciente_ingreso) references paciente_ingresos(id)
);
/* estado internado
 * 0 = Internado
 * 1 = Dado de Alta */

create table paciente_ingreso_medicos
(
	id_paciente_ingreso 		integer,
	id_medico								integer,
	foreign key(id_paciente_ingreso) references paciente_ingresos(id),
	foreign key(id_medico) references medicos(id)
);

create table paciente_egresos
(
	id 												serial primary key,
	fecha_egreso							date,
	hora_egreso								time,	
	id_cie10									integer,
	diagnostico_egreso1				text,
	diagnostico_egreso2				text,
	diagnostico_egreso3				text,
	causa_egreso							varchar(100),
	condicion_egreso					varchar(100),
	fallecido									integer default 0,
	fallecido_causa_clinica		text,
	fallecido_causa_autopsia	text,
	id_paciente_ingreso				integer,	
	id_medico		 							integer,
	contrareferencia					integer default 0,
	foreign key(id_cie10) references cie10(id),
	foreign key(id_paciente_ingreso) references paciente_ingresos(id),
	foreign key(id_medico) references medicos(id)
);

/* fallecido
 * 0 = vivo
 * 1 = muerto */

create table transferencias
(
	id 											serial primary key,
	fecha_transferencia			date,
	id_paciente_ingreso			integer,	
	id_medico		 						integer,
	diagnostico_trans1			text,
	diagnostico_trans2			text,
	diagnostico_trans3			text,
	id_servicio_trans				integer,
	id_servicio_ant					integer,
	id_especialidad_trans		integer,
	id_especialidad_ant			integer,
	id_sala_trans						integer,
	id_sala_ant							integer,
	id_cama_trans						integer,
	id_cama_ant							integer,
	foreign key(id_paciente_ingreso) references paciente_ingresos(id),
	foreign key(id_medico) references medicos(id),
	foreign key(id_servicio_trans) references servicios(id),
	foreign key(id_servicio_ant) references servicios(id),
	foreign key(id_especialidad_trans) references especialidades(id),
	foreign key(id_especialidad_ant) references especialidades(id),
	foreign key(id_cama_trans) references camas(id),
	foreign key(id_cama_ant) references camas(id),
	foreign key(id_sala_trans) references salas(id),
	foreign key(id_sala_ant) references salas(id)
);

create table maternidades
(
	id 													serial primary key,
	procedencia									varchar(10),
	gestacion 									integer,
	paridad 										integer,
	cesarea 										integer,
	aborto 											integer,
	edad_gestacional_fum				numeric(10,2),
	edad_gestacional_ecografia	numeric(10,2),
	tipo_intervencion						varchar(10),
	tipo_parto									varchar(30),
	tipo_aborto									varchar(50),
	liquido_amniotico						varchar(30),
	fecha_nacido								date,
	hora_nacido									time,
	peso_nacido									numeric(10,3),
	sexo_nacido									varchar(10),
	estado_nacido								varchar(20),
	alumbramiento								varchar(20),
	perine											varchar(20),
	sangrado										varchar(20),
	estado_madre								varchar(20),
	nombre_esposo								varchar(150),
	id_paciente_ingreso					integer,
	foreign key(id_paciente_ingreso) references paciente_ingresos(id)
);

create table neonatos 
(

	id 													serial primary key,
	peso_neonato								numeric(10,3),
	talla_neonato								numeric(10,2),
	pc_neonato									numeric(10,2),
	pt_neonato									numeric(10,2),
	apgar_ini										integer,
	apgar_fin										integer,
	edad_gestacional_neonato		numeric(10,2),
	tipo_parto_neonato					varchar(20),
	descripcion_parto						text,
	id_paciente_ingreso					integer,
	foreign key(id_paciente_ingreso) references paciente_ingresos(id)

);

create table cirugias
(
	id 												serial primary key,
	fecha_intervencion				date,
	hora_intervencion 				time,
	id_medico_cirujano				integer,
	id_medico_anestesiologo		integer,
	id_tecnico_anestesiologo	integer,
	foreign key(id_medico_cirujano) references medicos(id),
	foreign key(id_medico_anestesiologo) references anestesiologos(id),
	foreign key(id_tecnico_anestesiologo) references anestesiologos(id)
);

create table depositos
(
	id 											serial primary key,
	fecha_deposito					date,
	id_paciente_ingreso			integer,	
	id_servicio_depo				integer,
	id_servicio_ant					integer,
	id_sala_depo						integer,
	id_sala_ant							integer,
	id_cama_depo						integer,
	id_cama_ant							integer,
	foreign key(id_paciente_ingreso) references paciente_ingresos(id),
	foreign key(id_servicio_depo) references servicios(id),
	foreign key(id_servicio_ant) references servicios(id),
	foreign key(id_cama_depo) references camas(id),
	foreign key(id_cama_ant) references camas(id),
	foreign key(id_sala_depo) references salas(id),
	foreign key(id_sala_ant) references salas(id)
);

create table referencias
(
	id 															serial primary key,
	id_establecimiento							integer,
	adecuado 												integer,
	justificado											integer,
	oportuno												integer,
	id_paciente_ingreso							integer,
	foreign key(id_establecimiento) references establecimientos(id),
	foreign key(id_paciente_ingreso) references paciente_ingresos(id)
);