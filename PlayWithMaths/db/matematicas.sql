CREATE DATABASE IF NOT EXISTS Maths;

USE Maths;

CREATE TABLE IF NOT EXISTS Usuarios (
  id_usuario INT AUTO_INCREMENT,
  nombre_usuario VARCHAR(50),
  edad INT,
  contraseña VARCHAR(100),
  id_avatar INT,
  PRIMARY KEY (id_usuario)
);

CREATE TABLE IF NOT EXISTS Correos (
  id_correo INT AUTO_INCREMENT,
  id_usuario INT,
  correo_electronico VARCHAR(100),
  PRIMARY KEY (id_correo),
  FOREIGN KEY (id_usuario) REFERENCES Usuarios (id_usuario)
  ON DELETE NO ACTION 
  ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS Avatares (
  id_avatar INT AUTO_INCREMENT,
  nombre_avatar VARCHAR(100),
  imagen_avatar VARCHAR(255),
  PRIMARY KEY (id_avatar)
);

CREATE TABLE IF NOT EXISTS Modulos (
  id_modulo INT AUTO_INCREMENT,
  nombre_modulo VARCHAR(100),
  descripcion_modulo TEXT,
  PRIMARY KEY (id_modulo)
);

CREATE TABLE IF NOT EXISTS Lecciones (
  id_leccion INT AUTO_INCREMENT,
  id_modulo INT,
  titulo_leccion VARCHAR(100),
  fecha_visita DATE,
  acreditado VARCHAR(3) DEFAULT 'NO',
  PRIMARY KEY (id_leccion),
  FOREIGN KEY (id_modulo) REFERENCES Modulos (id_modulo)
  ON DELETE NO ACTION 
  ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS Examenes (
  id_examen INT AUTO_INCREMENT,
  id_modulo INT,
  id_usuario INT,
  titulo_examen VARCHAR(100),
  fecha_realizacion DATE,
  calificacion FLOAT,
  PRIMARY KEY (id_examen),
  FOREIGN KEY (id_modulo) REFERENCES Modulos (id_modulo),
  FOREIGN KEY (id_usuario) REFERENCES Usuarios (id_usuario)
  ON DELETE NO ACTION 
  ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS Intentos_Examen (
  id_intento INT AUTO_INCREMENT,
  id_examen INT,
  id_usuario INT,
  fecha_realizacion DATE,
  calificacion FLOAT,
  PRIMARY KEY (id_intento),
  FOREIGN KEY (id_examen) REFERENCES Examenes (id_examen),
  FOREIGN KEY (id_usuario) REFERENCES Usuarios (id_usuario)
  ON DELETE NO ACTION 
  ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS Preguntas_Examene (
  id_pregunta INT AUTO_INCREMENT,
  id_examen INT,
  enunciado_pregunta TEXT,
  respuesta_correcta VARCHAR(255),
  PRIMARY KEY (id_pregunta),
  FOREIGN KEY (id_examen) REFERENCES Examenes (id_examen)
  ON DELETE NO ACTION 
  ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS Premios (
  id_premio INT AUTO_INCREMENT,
  nombre_premio VARCHAR(100),
  descripcion_premio TEXT,
  id_usuario INT,
  PRIMARY KEY (id_premio),
  FOREIGN KEY (id_usuario) REFERENCES Usuarios (id_usuario)
  ON DELETE NO ACTION 
  ON UPDATE CASCADE
);
