CREATE DATABASE IF NOT EXISTS maths;

USE maths;

CREATE TABLE IF NOT EXISTS usuarios (
  id_usuario INT AUTO_INCREMENT,
  nombre_usuario VARCHAR(50),
  edad INT,
  correo VARCHAR(150),
  contraseña VARCHAR(500),
  id_avatar INT,
  UNIQUE (correo),
  PRIMARY KEY (id_usuario)
);


CREATE TABLE IF NOT EXISTS avatares (
  id_avatar INT AUTO_INCREMENT,
  nombre_avatar VARCHAR(100),
  imagen_avatar VARCHAR(255),
  PRIMARY KEY (id_avatar)
);

CREATE TABLE IF NOT EXISTS modulos (
  id_modulo INT,
  nombre_modulo VARCHAR(100),
  descripcion_modulo TEXT,
  PRIMARY KEY (id_modulo)
);

CREATE TABLE IF NOT EXISTS lecciones (
  id_leccion INT,
  id_modulo INT,
  titulo_leccion VARCHAR(200),
  acreditado VARCHAR(3) DEFAULT 'NO',
  PRIMARY KEY (id_leccion),
  FOREIGN KEY (id_modulo) REFERENCES Modulos (id_modulo)
  ON DELETE NO ACTION 
  ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS examen (
  id_examen INT AUTO_INCREMENT,
  id_modulo INT,
  titulo_examen VARCHAR(200),
  PRIMARY KEY (id_examen),
  FOREIGN KEY (id_modulo) REFERENCES Modulos (id_modulo)
  ON DELETE NO ACTION 
  ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS examenes_realizados (
  id_realizado INT AUTO_INCREMENT,
  id_examen INT,
  id_usuario INT,
  titulo_examen VARCHAR(200),
  fecha_realizacion DATE,
  calificacion FLOAT,
  PRIMARY KEY (id_realizado),
  FOREIGN KEY (id_examen) REFERENCES Examen (id_modulo),
  FOREIGN KEY (id_usuario) REFERENCES Usuarios (id_usuario)
  ON DELETE CASCADE
  ON UPDATE CASCADE
);



CREATE TABLE IF NOT EXISTS preguntas_examenes (
  id_pregunta INT AUTO_INCREMENT,
  id_examen INT,
  enunciado_pregunta TEXT,
  respuesta_correcta VARCHAR(255),
  imagen_pregunta VARCHAR(255),
  PRIMARY KEY (id_pregunta),
  FOREIGN KEY (id_examen) REFERENCES Examen (id_examen)
  ON DELETE NO ACTION 
  ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS premios (
  id_premio INT AUTO_INCREMENT,
  nombre_premio VARCHAR(100),
  descripcion_premio TEXT,
  id_usuario INT,
  PRIMARY KEY (id_premio),
  FOREIGN KEY (id_usuario) REFERENCES Usuarios (id_usuario)
  ON DELETE NO ACTION 
  ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS Lecciones_Completadas (
  id_completado INT AUTO_INCREMENT,
  id_usuario INT,
  id_leccion INT,
  fecha_completado DATE,
  PRIMARY KEY (id_completado),
  FOREIGN KEY (id_usuario) REFERENCES Usuarios (id_usuario)
  ON DELETE CASCADE
  ON UPDATE CASCADE,
  FOREIGN KEY (id_leccion) REFERENCES Lecciones (id_leccion)
  ON DELETE CASCADE 
  ON UPDATE CASCADE
);


INSERT INTO avatares (nombre_avatar, imagen_avatar) VALUES ("Avatar 1", "assets/img/avatar/Avatar1.jpeg");

ALTER TABLE examenes_realizados
DROP FOREIGN KEY id_usuario,
ADD FOREIGN KEY (id_usuario) 
REFERENCES Usuarios (id_usuario) 
ON DELETE CASCADE
ON UPDATE CASCADE;

INSERT INTO modulos (id_modulo, nombre_modulo, descripcion_modulo) VALUES
('1', 'Descubriendo las formas', ' En este modulo el niño practica las figuras geometricas desde el inicio'),
('2', 'Nombre leccion', ' En este modulo el niño practica '),
('3', 'Nombre leccion', ' En este modulo el niño practica '),
('4', 'Nombre leccion', ' En este modulo el niño practica '),
('5', 'Nombre leccion', ' En este modulo el niño practica '),
('6', 'Nombre leccion', ' En este modulo el niño practica '),
('7', 'Nombre leccion', ' En este modulo el niño practica '),
('8', 'Nombre leccion', ' En este modulo el niño practica '),
('9', 'Nombre leccion', ' En este modulo el niño practica '),
('10', 'Nombre leccion', ' En este modulo el niño practica '),
('11', 'Nombre leccion', ' En este modulo el niño practica '),
('12', 'Nombre leccion', ' En este modulo el niño practica '),
('13', 'Nombre leccion', ' En este modulo el niño practica '),
('14', 'Nombre leccion', ' En este modulo el niño practica '),
('15', 'Nombre leccion', ' En este modulo el niño practica '),
('16', 'Nombre leccion', ' En este modulo el niño practica ');

INSERT INTO modulos (id_modulo, nombre_modulo, descripcion_modulo) VALUES
('17', 'Sumemos diversion', ' En este modulo el niño practica la suma'),
('18', 'Restando en accion', ' En este modulo el niño practica la resta'),
('19', 'Explorando las tablas', ' En este modulo el niño practica las tablas de multiplicar');
('20', 'Nombre leccion', ' En este modulo el niño practica ')
('21', 'Nombre leccion', ' En este modulo el niño practica ')
('22', 'Nombre leccion', ' En este modulo el niño practica ')
('23', 'Nombre leccion', ' En este modulo el niño practica ')
('24', 'Nombre leccion', ' En este modulo el niño practica ')
('25', 'Nombre leccion', ' En este modulo el niño practica ')
('16', 'Nombre leccion', ' En este modulo el niño practica ')
('27', 'Nombre leccion', ' En este modulo el niño practica ')
('28', 'Nombre leccion', ' En este modulo el niño practica ')
('29', 'Nombre leccion', ' En este modulo el niño practica ')
('30', 'Nombre leccion', ' En este modulo el niño practica ')
('31', 'Nombre leccion', ' En este modulo el niño practica ')
('32', 'Nombre leccion', ' En este modulo el niño practica ');



INSERT INTO lecciones (id_leccion, id_modulo, titulo_leccion) VALUES 
('11','1', 'Leccion 1, Modulo descubriendo las formas'),
('12','1', 'Leccion 2, Modulo descubriendo las formas'),
('13','1', 'Leccion 3, Modulo descubriendo las formas'),
('14','1', 'Leccion 4, Modulo descubriendo las formas'),
('15','1', 'Leccion 5, Modulo descubriendo las formas'),
('16','1', 'Leccion 6, Modulo descubriendo las formas'),
('17','1', 'Leccion 7, Modulo descubriendo las formas'),
('18','1', 'Leccion 8, Modulo descubriendo las formas'),
('19','1', 'Examen, Modulo descubriendo las formas');

INSERT INTO lecciones (id_leccion, id_modulo, titulo_leccion) VALUES 
('171','17', 'Leccion 1, Modulo sumando diversion'),
('172','17', 'Leccion 2, Modulo sumando diversion'),
('173','17', 'Leccion 3, Modulo sumando diversion'),
('174','17', 'Leccion 4, Modulo sumando diversion'),
('175','17', 'Leccion 5, Modulo sumando diversion'),
('176','17', 'Leccion 6, Modulo sumando diversion'),
('177','17', 'Leccion 7, Modulo sumando diversion'),
('178','17', 'Leccion 8, Modulo sumando diversion'),
('179','17', 'Examen, Modulo sumando diversion')
;

INSERT INTO lecciones (id_leccion, id_modulo, titulo_leccion) VALUES 
('181','18', 'Leccion 1, Modulo restando en accion'),
('182','18', 'Leccion 2, Modulo restando en accion'),
('183','18', 'Leccion 3, Modulo restando en accion'),
('184','18', 'Leccion 4, Modulo restando en accion'),
('185','18', 'Leccion 5, Modulo restando en accion'),
('186','18', 'Leccion 6, Modulo restando en accion'),
('187','18', 'Leccion 7, Modulo restando en accion'),
('188','18', 'Leccion 8, Modulo restando en accion'),
('188','18', 'Examen, Modulo restando en accion')
;

INSERT INTO lecciones (id_leccion, id_modulo, titulo_leccion) VALUES 
('191','19', 'Leccion 1, Explorando las tablas'),
('192','19', 'Leccion 2, Explorando las tablas'),
('193','19', 'Leccion 3, Explorando las tablas'),
('194','19', 'Leccion 4, Explorando las tablas'),
('195','19', 'Leccion 5, Explorando las tablas'),
('196','19', 'Leccion 19,Explorando las tablas'),
('197','19', 'Leccion 7, Explorando las tablas'),
('198','19', 'Leccion 8, Explorando las tablas'),
('199','19', 'Examen, Explorando las tablas')
;

