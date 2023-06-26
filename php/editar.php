<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="author" content="Angel Gaston Mansilla">
        <meta name="keywords" content="html, bootstrap, php, sql, programcion web">
        <meta name="description" content="Página de edición de usuarios">

        <link rel="stylesheet" href="../css/estilo.css">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <title>Editar Usuario</title>
    </head>
    <body>
        <?php 
            session_start();
            if(!isset($_SESSION['usuario']) and !isset($_SESSION['clave'])){
                
                header('Location: ../html/false.html');
            }
        ?>
        <div class="container-fluid">
            <div class="row mt-4 mx-5 ps-5 border border-light border-3 p-2 rounded-3">
                <div class="col-4 bg-primary">
                    <div class="row py-1 border border-4 border-light rounded-3 bg-info">
                        <div class="col col-md-2 d-flex align-items-center">
                            <img src="../img/pencil-blanco.png" alt="icono de edición" weight="32" height="32" class="img-fluid">
                        </div>
                        <div class="col p-0">
                            <h1 class="text-light m-0" style="padding-right: 0em">Editar Usuario</h1>
                        </div>
                    </div>
                </div>
                <div class="col d-flex justify-content-end my-auto pe-4">
                    <a href="web_usuarios.php"><button class="btn btn-primary border border-light">Usuarios</button></a>
                </div>
            </div>

            <?php 
                require_once('conexion.php');   //llamada a conexión php para usar la función conectar_bbdd
                $reclave = "Repetir Password";
                $estado_reclave = "";

                // -----------------------se traen los datos del usuario para visualizar en el formulario

                if (isset($_POST['btn_editar'])) {
                    
                    foreach($_POST['btn_editar'] as $id_usuario){  
                        
                        $id_usuario = seguridad_campos($id_usuario);

                        $sql = 'SELECT * FROM usuarios_final_web2 WHERE id_usuario ='. $id_usuario . ';';
                        
                        $resultado_consulta = conectar_bbdd($sql); 
                        
                        if(mysqli_num_rows($resultado_consulta) > 0){
                            while($registros = mysqli_fetch_array($resultado_consulta)){
                                
                                $_SESSION['id'] = seguridad_campos($registros['id_usuario']);
                                
                                $_SESSION['nombre_cambio']  = seguridad_campos($registros['nombre']);
                                $_SESSION['apellido_cambio']  = seguridad_campos($registros['apellido']);
                                $_SESSION['alias_cambio'] = seguridad_campos($registros['alias']);
                                $_SESSION['email_cambio']  = seguridad_campos($registros['email']);
                                $_SESSION['password_cambio']  = seguridad_campos($registros['password']);
                            }
                        }                   
                    }                                     
                }
                //---------------------------------ejecución del UPDATE para cambiar los datos del usuario

                if(isset($_POST['nombre']) and isset($_POST['apellido']) and isset($_POST['usuario'])
                    and isset($_POST['email']) and isset($_POST['clave']) and isset($_POST['reclave'])){
                    
                    if(!empty($_POST['nombre']) and !empty($_POST['apellido']) and !empty($_POST['usuario'])
                        and !empty($_POST['email']) and !empty($_POST['clave']) and !empty($_POST['reclave'])){
                          
                            if($_POST['clave'] == ($_POST['reclave'])){

                                $nombre_cambio = seguridad_campos($_POST['nombre']);
                                $apellido_cambio = seguridad_campos($_POST['apellido']);
                                $alias_cambio = seguridad_campos($_POST['usuario']);
                                $email_cambio = seguridad_campos($_POST['email']);
                                $password_cambio = seguridad_campos($_POST['clave']);
                                
                                $id = $_SESSION['id'];

                                $sql = "UPDATE usuarios_final_web2 SET nombre = '" . $nombre_cambio . "' ,apellido = '" . $apellido_cambio . "' ,alias = '" . $alias_cambio . "' ,email = '" . $email_cambio . "' ,password = '" . $password_cambio . "' WHERE id_usuario = " .$id . ";";
                                
                                conectar_bbdd($sql);
                                header('Location: web_usuarios.php');
                            }else{
                                    
                                $reclave = "Password y repetición son diferentes";
                                $estado_reclave = "bg-danger rounded-3 text-light px-2";


                            }
                    }       
                }
                if(empty($_SESSION['nombre_cambio']  )){
                    header('Location: web_usuarios.php');
                } 
                
            ?>

            <div class="row mt-5 mx-5 shadow rounded-3 bg-light border border-2 border-primary">
                <div class="col-6 p-4 mx-auto">
                    <form action="editar.php" method="post">
                        <div class="mb-3">
                            <label for="campoNombre" class="form-label mb-2">Nombre</label>
                            <input id="campoNombre" type="text" class="form-control" name="nombre" placeholder="Nombre/s" value= "<?php echo $_SESSION['nombre_cambio'];?>" required="required" autocomplete="off" autofocus="autofocus">            
                        </div>
                        <div class="mb-3">
                            <label for="campoApellido" class="form-label mb-2">Apellido</label>
                            <input id="campoApellid" type="text" class="form-control" name="apellido" placeholder="Apellido/s" value= "<?php echo $_SESSION['apellido_cambio'];?>" required="required" autocomplete="off">            
                        </div>
                        
                        <div class="mb-3">
                            <label for="campoUsuario" class="form-label mb-2">Usuario</label>
                            <input id="campoUsuario" type="text" class="form-control" name="usuario" placeholder="Nombre de Usuario (Alias)" value= "<?php echo $_SESSION['alias_cambio'];?>" required="required" autocomplete="off">            
                        </div>
                    </div>
                    <div class="col-6 p-4 mx-auto">       
                        <div class="mb-3">
                            <label for="campoEmail" class="form-label mb-2">Email</label>
                            <input id="campoEmail" type="email" class="form-control" name="email" placeholder="Email" value= "<?php echo $_SESSION['email_cambio'];?>" required="required" autocomplete="off" >            
                        </div>

                        <div class="mb-3">  
                            <label for="campoPassword" class="form-label mb-2">Password</label>  
                            <input id="campoPassword" type="password" class="form-control" name="clave" placeholder="Constraseña" value= "<?php echo $_SESSION['password_cambio'];?>" required="required" autocomplete="off"> 
                        </div>

                        <div class="mb-3">    
                            <label for="campoConfirmarPass" class="form-label mb-2 <?php echo $estado_reclave?>"><?php echo $reclave ?></label>
                            <input id="campoConfirmarPass" type="password" class="form-control <?php $estado_reclave?>" name="reclave" placeholder="Repetir Constraseña" value= "<?php echo $_SESSION['password_cambio'];?>" required="required" autocomplete="off"> 
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Cambiar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>