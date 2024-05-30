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

CREATE TABLE IF NOT EXISTS examenes_realizados (
  id_realizado INT NOT NULL AUTO_INCREMENT,
  id_examen INT,
  id_usuario INT,
  titulo_examen VARCHAR(255) NOT NULL,
  fecha_realizacion DATE NOT NULL,
  calificacion INT NOT NULL,
  PRIMARY KEY (id_realizado),
  FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE ON UPDATE CASCADE
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


INSERT INTO modulos (id_modulo, nombre_modulo, descripcion_modulo) VALUES
('1', 'Descubriendo las formas', ' En este módulo el niño practica las figuras geométricas desde el inicio'),
('2', 'Propiedades de las formas', 'En este módulo el niño conoce las propiedades de las formas'),
('3', 'Nombre leccion', ' En este módulo el niño practica '),
('4', 'Nombre leccion', ' En este módulo el niño practica '),
('5', 'Nombre leccion', ' En este módulo el niño practica '),
('6', 'Nombre leccion', ' En este módulo el niño practica '),
('7', 'Nombre leccion', ' En este módulo el niño practica '),
('8', 'Nombre leccion', ' En este módulo el niño practica '),
('9', 'Nombre leccion', ' En este módulo el niño practica '),
('10', 'Nombre leccion', ' En este módulo el niño practica '),
('11', 'Nombre leccion', ' En este módulo el niño practica '),
('12', 'Nombre leccion', ' En este módulo el niño practica '),
('13', 'Nombre leccion', ' En este módulo el niño practica '),
('14', 'Nombre leccion', ' En este módulo el niño practica '),
('15', 'Nombre leccion', ' En este módulo el niño practica '),
('16', 'Nombre leccion', ' En este módulo el niño practica ');

INSERT INTO modulos (id_modulo, nombre_modulo, descripcion_modulo) VALUES
('17', 'Sumemos diversion', ' En este módulo el niño practica la suma'),
('18', 'Restando en accion', ' En este módulo el niño practica la resta'),
('19', 'Explorando las tablas', ' En este módulo el niño practica las tablas de multiplicar'),
('20', 'La magia de multiplicar', ' En este módulo el niño practica la multiplicación');
('21', 'Nombre leccion', ' En este módulo el niño practica ')
('22', 'Nombre leccion', ' En este módulo el niño practica ')
('23', 'Nombre leccion', ' En este módulo el niño practica ')
('24', 'Nombre leccion', ' En este módulo el niño practica ')
('25', 'Nombre leccion', ' En este módulo el niño practica ')
('16', 'Nombre leccion', ' En este módulo el niño practica ')
('27', 'Nombre leccion', ' En este módulo el niño practica ')
('28', 'Nombre leccion', ' En este módulo el niño practica ')
('29', 'Nombre leccion', ' En este módulo el niño practica ')
('30', 'Nombre leccion', ' En este módulo el niño practica ')
('31', 'Nombre leccion', ' En este módulo el niño practica ')
('32', 'Nombre leccion', ' En este módulo el niño practica ');



INSERT INTO lecciones (id_leccion, id_modulo, titulo_leccion) VALUES 
('11','1', 'Leccion 1, módulo descubriendo las formas'),
('12','1', 'Leccion 2, módulo descubriendo las formas'),
('13','1', 'Leccion 3, módulo descubriendo las formas'),
('14','1', 'Leccion 4, módulo descubriendo las formas'),
('15','1', 'Leccion 5, módulo descubriendo las formas'),
('16','1', 'Leccion 6, módulo descubriendo las formas'),
('17','1', 'Leccion 7, módulo descubriendo las formas'),
('18','1', 'Leccion 8, módulo descubriendo las formas'),
('19','1', 'Leccion 9, módulo descubriendo las formas');

INSERT INTO lecciones (id_leccion, id_modulo, titulo_leccion) VALUES 
('21','2', 'Leccion 1, módulo propiedades de las formas'),
('22','2', 'Leccion 2, módulo propiedades de las formas'),
('23','2', 'Leccion 3, módulo propiedades de las formas'),
('24','2', 'Leccion 4, módulo propiedades de las formas'),
('25','2', 'Leccion 5, módulo propiedades de las formas'),
('26','2', 'Leccion 6, módulo propiedades de las formas'),
('27','2', 'Leccion 7, módulo propiedades de las formas'),
('28','2', 'Leccion 8, módulo propiedades de las formas'),
('29','2', 'Leccion 9, módulo propiedades de las formas');

INSERT INTO lecciones (id_leccion, id_modulo, titulo_leccion) VALUES 
('31','3', 'Leccion 1, módulo formas en el munfo ral'),
('32','3', 'Leccion 2, módulo formas en el mundo real'),
('33','3', 'Leccion 3, módulo formas en el mundo real'),
('34','3', 'Leccion 4, módulo formas en el mundo real'),
('35','3', 'Leccion 5, módulo formas en el mundo real'),
('36','3', 'Leccion 6, módulo formas en el mundo real'),
('37','3', 'Leccion 7, módulo formas en el mundo real'),
('38','3', 'Leccion 8, módulo formas en el mundo real'),
('39','3', 'Leccion 9, módulo formas en el mundo real');

INSERT INTO lecciones (id_leccion, id_modulo, titulo_leccion) VALUES 
('171','17', 'Leccion 1, módulo sumemos diversión'),
('172','17', 'Leccion 2, módulo sumemos diversión'),
('173','17', 'Leccion 3, módulo sumemos diversión'),
('174','17', 'Leccion 4, módulo sumemos diversión'),
('175','17', 'Leccion 5, módulo sumemos diversión'),
('176','17', 'Leccion 6, módulo sumemos diversión'),
('177','17', 'Leccion 7, módulo sumemos diversión'),
('178','17', 'Leccion 8, módulo sumemos diversión')
;

INSERT INTO lecciones (id_leccion, id_modulo, titulo_leccion) VALUES 
('181','18', 'Leccion 1, módulo restando en acción'),
('182','18', 'Leccion 2, módulo restando en acción'),
('183','18', 'Leccion 3, módulo restando en acción'),
('184','18', 'Leccion 4, módulo restando en acción'),
('185','18', 'Leccion 5, módulo restando en acción'),
('186','18', 'Leccion 6, módulo restando en acción'),
('187','18', 'Leccion 7, módulo restando en acción'),
('188','18', 'Leccion 8, módulo restando en acción')
;

INSERT INTO lecciones (id_leccion, id_modulo, titulo_leccion) VALUES 
('191','19', 'Leccion 1, Explorando las tablas'),
('192','19', 'Leccion 2, Explorando las tablas'),
('193','19', 'Leccion 3, Explorando las tablas'),
('194','19', 'Leccion 4, Explorando las tablas'),
('195','19', 'Leccion 5, Explorando las tablas'),
('196','19', 'Leccion 19,Explorando las tablas'),
('197','19', 'Leccion 7, Explorando las tablas'),
('198','19', 'Leccion 8, Explorando las tablas');

INSERT INTO lecciones (id_leccion, id_modulo, titulo_leccion) VALUES 
('201','20', 'Leccion 1, La magia de multiplicar'),
('202','20', 'Leccion 2, La magia de multiplicar'),
('203','20', 'Leccion 3, La magia de multiplicar'),
('204','20', 'Leccion 4, La magia de multiplicar'),
('205','20', 'Leccion 5, La magia de multiplicar'),
('206','20', 'Leccion 19,La magia de multiplicar'),
('207','20', 'Leccion 7, La magia de multiplicar'),
('208','20', 'Leccion 8, La magia de multiplicar')
;

