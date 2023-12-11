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
  id_modulo INT AUTO_INCREMENT,
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
  ON DELETE NO ACTION 
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
  ON DELETE NO ACTION 
  ON UPDATE CASCADE,
  FOREIGN KEY (id_leccion) REFERENCES Lecciones (id_leccion)
  ON DELETE NO ACTION 
  ON UPDATE CASCADE
);


INSERT INTO avatares (nombre_avatar, imagen_avatar) VALUES ("Avatar 1", "assets/img/avatar/Avatar1.jpeg");