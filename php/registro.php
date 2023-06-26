<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="author" content="Angel Gaston Mansilla">
        <meta name="keywords" content="html, bootstrap, php, sql, programcion web">
        <meta name="description" content="Formulario de registro de primer trabajo practico de programación web 2">

        <link rel="stylesheet" href="../css/estilo.css">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <title>Registro</title>
    </head>
    <body>
        <?php 

            require_once('conexion.php');

            if(!isset($nombre)){
                $nombre="";
                $apellido="";
                $usuario="";
                $email="";
            }
            
            $activar_col3 = "";
            $activar_p3 = "d-none";

            if(isset($_POST)){

                if (!empty($_POST['nombre']) and !empty($_POST['apellido']) and !empty($_POST['usuario']) and !empty($_POST ['email']) and !empty($_POST['clave']) and !empty($_POST['reclave'])) {
                    
                    $nombre = seguridad_campos($_POST['nombre']);
                    $apellido = seguridad_campos($_POST['apellido']); 
                    $usuario = seguridad_campos($_POST['usuario']); 
                    $email = seguridad_campos($_POST['email']); 
                    $clave = seguridad_campos($_POST['clave']);  
                    $reclave = seguridad_campos($_POST['reclave']);     

                    if($clave=== $reclave){

                        conectar_bbdd("INSERT INTO usuarios_final_web2(nombre, apellido, alias, email, password)VALUES(" . "'" . $nombre . "','" . $apellido . "','" . $usuario . "','" . $email . "','" . $clave . "');");

                        header('Location: ../index.php');

                    }else{
                        $activar_col3 = "d-flex pb-5";
                        $activar_p3 ="bg-danger text-light rounded-3 p-2 mb-5 align-self-end";
                        //echo "La contraseña y su confirmación deben ser iguales";
                    }
                }
            }

        ?>  
        <div class="container-fluid vh-100">
        
            <div class="row border border-light border-4 rounded-3 mx-5 my-4">
                <div class="col-3">

                </div>
                <div class="col-6 mt-2 mb-2 ">
                    <div class="row border border-light border-4 bg-info rounded-3 p-0 py-2 mx-5 flex justify-items-center">
                        <div class="col-2 col-md-1 d-flex align-items-center">
                            <img src="../img/user-add-white.png" alt="icono de nuevo usuario" weight="32" height="32">
                        </div>
                        <div class="col p-0">
                            <h1 class="text-light ms-3 d-inline">Registro de usuarios</h1>
                        </div>
                    </div>
                    
                </div>
            </div>
            
            <div class= "row mt-5">
                <div class="col-3"> 
                </div> 
                
                <div class="col-5 shadow p-4 rounded-3 mx-auto bg-light pb-3">
                    <form action="registro.php" method="post">
                        <div class="mb-3">
                            <input type="text" class="form-control" name="nombre" placeholder="Nombre/s" required="required" autofocus="autofocus" autocomplete="off" value="<?php echo $nombre?>">            
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="apellido" placeholder="Apellido/s" required="required" autocomplete="off" value="<?php echo $apellido?>">            
                        </div>
                        
                        <div class="mb-3">
                            <input type="text" class="form-control" name="usuario" placeholder="Nombre de Usuario (Alias)" required="required" autocomplete="off" value="<?php echo $usuario?>">            
                        </div>
                        
                        <div class="mb-3">
                            <input type="email" class="form-control" name="email" placeholder="Email" required="required" autocomplete="off" value="<?php echo $email?>">            
                        </div>

                        <div class="mb-3">    
                            <input type="password" class="form-control" name="clave" placeholder="Constraseña" required> 
                        </div>

                        <div class="mb-3">    
                            <input type="password" class="form-control" name="reclave" placeholder="Repetir Constraseña" required> 
                        </div>

                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </form>
                </div>

                  

                <div class="col-3 <?php echo $activar_col3?>">
                    <p class="text-center <?php echo $activar_p3?>" >La contraseña y su confirmación deben ser iguales</p>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    </body>
</html>