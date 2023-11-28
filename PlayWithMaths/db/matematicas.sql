DROP DATABASE IF EXISTS math;

CREATE DATABASE math;
USE math;

DROP TABLE IF EXISTS usuarios;
CREATE TABLE IF NOT EXISTS usuarios(
    id INT NOT NULL AUTO_INCREMENT COMMENT 'Clave primaria de la tabla personas',
    edad INT NOT NULL,
    usuario VARCHAR(50) NOT NULL COMMENT 'Usuariode la persona a registrar',
    activodesde DATETIME NOT NULL DEFAULT NOW() COMMENT 'Fecha y hora que se ingresó al sistema',
    CONSTRAINT PK_codigo PRIMARY KEY (id) COMMENT 'La clave primaria de la tabla es codigo'
);

DROP TABLE IF EXISTS correos;
CREATE TABLE correos(
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'Clave primaria de la tabla, Autoincrementable',
  id_usuario INT NOT NULL COMMENT 'Clave foránea para relacionar los correos con las personas',
  correo VARCHAR(150) NOT NULL COMMENT ' Correo de la persona, el cual debe ser único',
  UNIQUE (correo) COMMENT 'Únicos: correo',
  CONSTRAINT FK_correos_persona FOREIGN KEY (id_usuario) 
  REFERENCES usuarios(id)
  ON DELETE NO ACTION 
  ON UPDATE CASCADE
);

DROP TABLE IF EXISTS modulos;
CREATE TABLE modulos(
  id INT NOT NULL PRIMARY KEY,
  modulo VARCHAR(50) NOT NULL
);

DROP TABLE IF EXISTS lecciones;
CREATE TABLE lecciones(
  id INT NOT NULL PRIMARY KEY,
  id_modulo INT NOT NULL,
  leccion VARCHAR(50) NOT NULL,
  CONSTRAINT FK_lecciones_modulo FOREIGN KEY (id_modulo)
  REFERENCES modulos(id)
  ON DELETE NO ACTION 
  ON UPDATE CASCADE
);

DROP TABLE IF EXISTS progreso;
CREATE TABLE progreso(
  id INT NOT NULL PRIMARY KEY,
  id_user INT NOT NULL,
  id_leccion INT NOT NULL,
  id_modulo INT NOT NULL,
  progreso INT NOT NULL,
  CONSTRAINT FK_progreso_usario FOREIGN KEY(id_user)
  REFERENCES usuarios(id)
  ON DELETE NO ACTION 
  ON UPDATE CASCADE,
  CONSTRAINT FK_progreso_modulo FOREIGN KEY(id_modulo)
  REFERENCES modulos(id)
  ON DELETE NO ACTION 
  ON UPDATE CASCADE,
  CONSTRAINT FK_progreso_lecciones FOREIGN KEY(id_leccion)
  REFERENCES lecciones(id)
  ON DELETE NO ACTION 
  ON UPDATE CASCADE
);
