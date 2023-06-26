CREATE DATABASE final_web2;

USE final_web2;

CREATE TABLE usuarios_final_web2(
	id_usuario INT NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(255),
	apellido VARCHAR(255),
	alias VARCHAR(255),
	email VARCHAR(255),
	password VARCHAR(255),
	INDEX(id_usuario),
	PRIMARY KEY(id_usuario)
);

INSERT INTO usuarios_final_web2(nombre,apellido,alias,email,password) 
VALUES
('Angel','Mansilla','agm','agm@gmail.com','algo'),
('Cintia','Brenta','petu','petu@gmail.com','234'),
('Estefania','Orellana','ore','ore@hotmail.com.ar','poi'),
('Juliana','Peña','juli','juli@gmail.com','tyu'),
('Arturo','Villafañe','artu','artu@gmail.com','iop'),
('Esteban','Gonardes','estegon','estegon@gmail.com','tyu'),
('Liliana','Villafañe','livi','livi@hotmail.com.ar','678'),
('Anibal','Laudano','lauda','lauda@gmail.com','345'),
('BART','SIMPSON','bsimpson','bsimpson@dominio.com','123456'),
('Anselmo','Medina','ansel','ansel@gmail.com','ert'),
('Estefania','Strofa','estefi','estefi@yahoo.com.ar','zxc');
