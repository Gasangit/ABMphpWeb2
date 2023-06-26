<?php

$host = "localhost";
$base_datos = "final_web2";
$usuario_bbdd = "root";
$password = "7485"; //recordar sacar la contraseña al entregar el final

function verificar_bbdd(){
    $conexion = mysqli_connect($GLOBALS['host'],$GLOBALS['usuario_bbdd'],$GLOBALS['password'],$GLOBALS['base_datos']);
    
    if(mysqli_connect_errno() == 1049){

        $conexion_sin_bbdd = mysqli_connect($GLOBALS['host'],$GLOBALS['usuario_bbdd'],$GLOBALS['password']); 

        mysqli_query($conexion_sin_bbdd, "CREATE DATABASE final_web2;");
            
            $conexion = mysqli_connect($GLOBALS['host'],$GLOBALS['usuario_bbdd'],$GLOBALS['password'],$GLOBALS['base_datos']);
            mysqli_query($conexion, "CREATE TABLE usuarios_final_web2(
                                        id_usuario INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                        nombre VARCHAR(255), 
                                        apellido VARCHAR(255), 
                                        alias VARCHAR(255), 
                                        email VARCHAR(255), 
                                        password VARCHAR(255),
                                        INDEX(id_usuario));");
            mysqli_query($conexion, "INSERT INTO usuarios_final_web2(nombre, apellido, alias, email, password)
                                        VALUES('Angel Gaston','Mansilla','agm','agm@gmail.com','algo'),
                                                ('Cintia','Brenta','petu','petu@gmail.com','234'),
                                                ('Estefania','Orellana','ore','ore@hotmail.com.ar','poi'),
                                                ('Juliana','Peña','juli','juli@gmail.com','tyu'),
                                                ('Arturo','Villafañe','artu','artu@gmail.com','iop'),
                                                ('Esteban','Gonardes','estegon','estegon@gmail.com','tyu'),
                                                ('Liliana','Villafañe','livi','livi@hotmail.com.ar','678'),
                                                ('Anibal','Laudano','lauda','lauda@gmail.com','345'),
                                                ('BART','SIMPSON','bsimpson','bsimpson@dominio.com','123456'),
                                                ('Anselmo','Medina','ansel','ansel@gmail.com','ert'),
                                                ('Estefania','Strofa','estefi','estefi@yahoo.com.ar','zxc');");   
                                                
        mysqli_close($conexion);
    }   
}

function conectar_bbdd($sql){
    $conexion = mysqli_connect($GLOBALS['host'],$GLOBALS['usuario_bbdd'],$GLOBALS['password'],$GLOBALS['base_datos']);
    if($conexion){
        
        if(stripos($sql, "SELECT")==0){
            
            return mysqli_query($conexion, $sql);

        }else{

            mysqli_query($conexion, $sql);
        }    
            
        mysqli_close($conexion);
    }else{
        
            die ("La sentencia $sql no se ha enviado correctamente
            <br>Código de error: " . mysqli_connect_errno() .
            "<br>Descripción: " . mysqli_connect_error());

            $sql = "";
    }
    }

    function seguridad_campos($campo){
        $conexion = mysqli_connect($GLOBALS['host'],$GLOBALS['usuario_bbdd'],$GLOBALS['password'],$GLOBALS['base_datos']);
        
        $campo = trim($campo);
        $campo = stripslashes($campo);
        $campo = htmlspecialchars($campo);
        $campo = mysqli_real_escape_string($conexion, $campo);
        return $campo;
    }
?>