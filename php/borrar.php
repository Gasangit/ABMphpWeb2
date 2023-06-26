<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="author" content="Angel Gaston Mansilla">
        <meta name="keywords" content="html, bootstrap, php, sql, programcion web">
        <meta name="description" content="Página de borrado de usuarios">

        <link rel="stylesheet" href="../css/estilo.css">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <title>Borrar Usuario</title>
    </head>
    <body>
        <?php 
            session_start();
           
            if(!isset($_SESSION['usuario']) and !isset($_SESSION['clave'])){
                header('Location: ../html/false.html');
            }else if(isset($_SESSION['usuario']) and isset($_SESSION['clave']) and !isset($_SESSION['borrar_ok'])){
                header('Location: web_usuarios.php');
            }
        ?>
        <div class="container vh-100 d-flex justify-content-center">
            <div class="row justify-content-center align-content-center bg-danger my-5 rounded-3 border border-2 border-light">
                <div class="col-6 shadow bg-light rounded-3 p-2">
                    <div class="row">
                        <div class="col-12">
                            <p class="text-center">¿Confirma el borrado del usuario?</p>
                        </div>
                        <div class="col text-center">
                            <div class="row">
                                <div class="col">
                                    <form action="borrar.php" method="POST">
                                        <input type="hidden" name="confirmar" value="confirmado">
                                        <a href="web_usuarios.php"><button class="btn btn-danger px-4">Borrar</button></a>
                                    </form>
                                </div>
                                <div class="col">
                                    <form action="borrar.php" method="POST">
                                        <input type="hidden" name="cancelar" value="cancelado">
                                        <a href=""><button class="btn btn-warning px-3">Cancelar</button></a>
                                    </form>
                                </div>
                            </div>                                                             
                        </div>
                    </div>    
                </div>
            </div>
        </div>
        <?php 
            require_once('conexion.php');
            if(isset($_POST['confirmar'])){
                if(!empty($_POST['confirmar'])){

                    $sql = "DELETE FROM usuarios_final_web2 WHERE id_usuario = " . $_SESSION['id_borrar'] . ";";
                    conectar_bbdd($sql);                 
                    header('Location: web_usuarios.php');
                }
            }
            
            if(isset($_POST['cancelar'])){
                if (!empty($_POST['cancelar'])) {
                    
                    $_SESSION['borrar_ok'] = null;
                    header('Location: web_usuarios.php');
                }
            }
        ?>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>