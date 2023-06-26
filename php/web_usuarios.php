<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="author" content="Angel Gaston Mansilla">
        <meta name="keywords" content="html, bootstrap, php, sql, programcion web">
        <meta name="description" content="Página principal con tabla de usuarios de primer trabajo practico de programación web 2">

        <link rel="stylesheet" href="../css/estilo.css">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <title>Web Usuarios</title>
    </head>
    <body>

        <?php 
            session_start();

            if(!isset($_SESSION['usuario']) and !isset($_SESSION['clave'])){
                header('Location: ../html/false.html');
            }

            $_SESSION['borrar_ok']=null;
        ?>
        <div class="container-fluid">
            
            <div class="row mt-4 ps-5 border border-light border-3 mx-5 p-2 rounded-3">
                <div class="col ps-1 ms-1 border border-4 border-light rounded-3 bg-info">
                    <h1 class="text-center text-light">Web de usuarios</h1>
                </div>
                <div class="col">
                    
                </div>        
                <div class="col my-auto d-flex justify-content-end pe-5">
                        <form action="web_usuarios.php" method="POST">
                            <input type="hidden" name="salir" value="salir">
                            <button type="submit" class="btn btn-danger border-light">Cerrar Sesión</button>
                        </form>                        
                        <?php 
                            if(isset($_POST['salir'])){
                                session_unset();
                                session_destroy();
                                header('Location: ../index.php');
                            } 
                        ?>
                </div>
            </div>
            
            <div class="row mt-5 mb-5">
                <div class="col-11 bg-light shadow mx-auto p-4 rounded-3 border border-2 border-primary">
                    <?php 
                        require_once('conexion.php');
                       
                        if(isset($_POST['btn_borrar'])){
                            if(!empty($_POST['btn_borrar']))

                                session_start();
                                foreach($_POST['btn_borrar'] as $usuario_a_borrar){
                                    
                                    $_SESSION['id_borrar'] = seguridad_campos($usuario_a_borrar);
                                                                        
                            }
                            $_SESSION['borrar_ok'] = true;
                            header('Location: borrar.php'); 
                        }

                        $resultado_consulta = conectar_bbdd("SELECT * from usuarios_final_web2");

                        if(mysqli_num_rows($resultado_consulta)>0){
                            
                            
                            echo "<table class='table table-striped'>";
                                echo "<thead>
                                        <tr> 
                                            <th scope='col'>Nombre/s</th>
                                            <th scope='col'>Apellido/s</th>
                                            <th scope='col'>Alias (Usuario)</th>
                                            <th scope='col'>Email</th>
                                            <th scope='col'>Contraseña</th> 
                                            <th scope='col'></th> 
                                            <th scope='col'></th> 
                                        </tr> 
                                    </thead>
                                        <tbody>";
                            
                            $rows_num = 0;

                            while($filas = mysqli_fetch_array($resultado_consulta)){
                               
                                echo "<tr>" . 
                                        "<td>" . $filas['nombre'] . "</td>" . 
                                        "<td>" . $filas['apellido'] ."</td>" . 
                                        "<td>" . $filas['alias'] . "</td>" . 
                                        "<td>" . $filas['email'] . "</td>" . 
                                        "<td>" . $filas['password'] . "</td>" .
                                        "<td>
                                            <form action='editar.php' method='POST'>
                                                <button type= 'submit' class='btn btn-primary py-0  px-1'>Editar</button>
                                                <input type='hidden' name='" . 'btn_editar[]' . "' value='". $filas['id_usuario'] . "'> 
                                            </form>  
                                        </td>" . 
                                        "<td>
                                            <form action='web_usuarios.php' method='POST'>
                                                <a href=''><button type= 'submit' class='btn btn-primary py-0 px-1'>Borrar</button></a>
                                                <input type='hidden' name='" . 'btn_borrar[]' . "' value='" . $filas['id_usuario'] . "'> 
                                            </form> 
                                        </td>" .
                                    "</tr>";
                            }

                            echo "</tbody>
                                    </table>";
                        }

                        
                    ?>
                </div>
            </div>
        </div>   
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        
    </body>
</html>