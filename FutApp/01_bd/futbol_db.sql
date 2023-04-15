/* Esta base de datos ha sido creada por Guillermo Garcia */

/**************** CREAR LA BASE DE DATOS ****************/
DROP DATABASE IF EXISTS futbolGD;
CREATE DATABASE futbolGD;
USE futbolGD;

/* Creacion tabla plantilla */
DROP TABLE IF EXISTS plantilla;
CREATE TABLE plantilla (
    id_jugador int(6) unsigned NOT NULL AUTO_INCREMENT,
    id_empleado int(6) unsigned,
    nombre varchar(30),
    apellidos varchar(60),
    peso float(4),
    altura int(3),
    numero_plantilla int(2),
    posicion varchar (20),
    direccion varchar(50),
    localidad varchar(30),
    nacionalidad varchar(30),
    telefono int(9),
    mail varchar(80),
    descripcion varchar(200),    
    ultima_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT pk_id_jugador PRIMARY KEY(id_jugador)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

/* Creacion tabla estadisticas_jugadores */
DROP TABLE IF EXISTS estadisticas_jugadores;
CREATE TABLE estadisticas_jugadores (
    id_estadisticas int(6) unsigned NOT NULL AUTO_INCREMENT,
    id_jugador int(6) unsigned,
    partido_jugado int(3),
    goles int(4),
    asistencias int(4),
    amarillas int(4),
    rojas int(3),
    partidos_sancion int(3),
    minutos_jugados_amistoso int (4),
    minutos_jugados_oficial int (4),
    minutos_jugados_torneo int (4),
    puntuacion_media float (4),
    titular int(3),
    suplente int(3),
    convocado int (3),
    no_convocado int (3),
    sustituido int (3),
    sustituto int (3),
    jugador_partido int (3),
    descripcion varchar(200),    
    ultima_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT pk_id_estadisticas PRIMARY KEY(id_estadisticas),
    CONSTRAINT fk_id_jugador FOREIGN KEY(id_jugador) REFERENCES plantilla(id_jugador)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/* Creacion tabla estadisticas_partido */
DROP TABLE IF EXISTS estadisticas_partido;
CREATE TABLE estadisticas_partido (
    id_partido int(6) unsigned NOT NULL AUTO_INCREMENT,
    id_estadisticas int(6) unsigned,
    id_jugador int(6) unsigned,
    temporada int(3),
    jornada int(2),
    tipo int(10),
    fecha date,
    hora time,
    goles_favor int(2),
    goles_contra int(2),
    min_gol_favor int (3),
    min_gol_contra int (3),
    amarillas int(4),
    min_amarilla int(4),
    rojas int(3),
    min_roja int(4),
    min_jugados int(3),
    min_extra int (4),
    jugador_partido int (6),
    cambios int(3),
    min_cambios int (3),
    descripcion varchar(200),    
    ultima_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT pk_id_partidos PRIMARY KEY(id_partido),
    CONSTRAINT fk_id_estadisticas FOREIGN KEY(id_estadisticas) REFERENCES estadisticas_jugadores(id_estadisticas),
    CONSTRAINT fk_id_jugador2 FOREIGN KEY(id_jugador) REFERENCES plantilla(id_jugador)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/* Creacion tabla clubes */
DROP TABLE IF EXISTS clubes;
CREATE TABLE clubes (
    id_club int(6) unsigned NOT NULL AUTO_INCREMENT,
    codigo int (6),
    nombre varchar(80),
    direccion varchar(50),
    localidad varchar(30),
    municipio varchar(30),
    telefono int(9),
    mail varchar(100),
    presidente varchar (100),
    director_deportivo varchar (100),
    otros varchar (100),
    descripcion varchar(200),    
    ultima_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT pk_id_club PRIMARY KEY(id_club)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

/* Creacion tabla empleados */
DROP TABLE IF EXISTS empleados;
CREATE TABLE empleados (
    id_empleado int(6) unsigned NOT NULL AUTO_INCREMENT,
    id_club int(6) unsigned,
    id_habilidad int(6) unsigned,
    codigo_empleado int (6),
    posicion varchar (20),
    nombre varchar(30),
    apellidos varchar(60),
    equipo varchar(20),
    equipo_letra char (1),
    puesto varchar (30),
    salario int(2),
    direccion varchar(50),
    localidad varchar(30),
    nacionalidad varchar(30),
    telefono int(9),
    mail varchar(80),
    descripcion varchar(200),    
    ultima_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT pk_id_empleado PRIMARY KEY(id_empleado),
    CONSTRAINT fk_id_club FOREIGN KEY(id_club) REFERENCES club(id_club),
    CONSTRAINT fk_id_habilidad FOREIGN KEY(id_habilidad) REFERENCES habilidades(id_habilidad),
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

/* Creacion tabla habilidades */
DROP TABLE IF EXISTS habilidades;
CREATE TABLE habilidades (
    id_habilidad int(6) unsigned NOT NULL AUTO_INCREMENT,
    id_empleado int(6) unsigned NOT NULL AUTO_INCREMENT,
    tipo varchar (20) DEFAULT 'Punto fuerte',
    habilidad varchar (30),
    puntuacion int (2),
    ultima_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT pk_id_habilidad PRIMARY KEY(id_habilidad),
    CONSTRAINT fk_id_empleado FOREIGN KEY(id_empleado) REFERENCES empleados(id_empleado)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

/* Creacion tabla estilo_juego */
DROP TABLE IF EXISTS estilo_juego;
CREATE TABLE estilo_juego (
    id_estilo_juego int(6) unsigned NOT NULL AUTO_INCREMENT,
    id_empleado int(6) unsigned NOT NULL AUTO_INCREMENT,
    puntuacion int (2),
    descripcion varchar (30),
    ultima_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT pk_estilo_juego PRIMARY KEY(estilo_juego),
    CONSTRAINT fk_id_empleado FOREIGN KEY(id_empleado) REFERENCES empleados(id_empleado)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;