<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <meta name="author" content="Angel Gaston Mansilla">
        <meta name="keywords" content="html, bootstrap, php, sql, programcion web">
        <meta name="description" content="Login de primer trabajo practico de programación web 2">

        <link rel="stylesheet" href="css/estilo.css">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <title>Login</title>
    </head>
    <body>
        <?php 
        ob_start();
        $estado_p = "d-none";
        $estado_col = "";

        session_start();

        $_SESSION['usuario'] = null;
        $_SESSION['clave'] = null;
        ?>
        <div class="container vh-100">
            
            <div class="row d-flex justify-content-center">
                <div class="col-4 mt-5 mb-5 bg-primary border border-3 border-light rounded-3">
                    <h1 class="text-center h1 display-6 text-light">Logueo de usuarios</h1>
                </div>
            </div>
            
            <div class= "row mt-5">
                <div class="col-4 shadow p-4 rounded-3 mx-auto bg-light border-primary">
                    <form action="index.php" method="post">
                        <div class="mb-3">
                            <input type="text" class="form-control" name="usuario" placeholder="Usuario" required="required" autofocus="autofocus" autocomplete="off">            
                        </div>

                        <div class="mb-3">    
                            <input type="password" class="form-control" name="clave" placeholder="Constraseña" 
                            required> 
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary">Ingresar</button>
                            </div>
                            <div class="col-6 text-center d-flex justify-content-end">
                                <a href="php/registro.php"><button type="button" class="btn btn-primary">Registro</button></a>                
                            </div> 
                        </div>
                        
                    </form>
                </div>
            </div>

            <div class="row">
                 
                <?php 
                    $usuario = "";
                    $clave = "";

                    require_once('php/conexion.php');

                    if(isset($_POST)){  
                        if(!empty($_POST['usuario']) and !empty($_POST['clave'])){
                            verificar_bbdd();

                            $usuario = seguridad_campos($_POST['usuario']);
                            $clave = seguridad_campos($_POST['clave']);
                        
                            $resultado_consulta = conectar_bbdd("SELECT password  FROM usuarios_final_web2 WHERE alias = " . "'" . $usuario . "';");
                            
                            if(mysqli_num_rows($resultado_consulta)>0){
                            
                                while ($resultados = mysqli_fetch_array($resultado_consulta)) {

                                    $pass_en_bbdd = $resultados['password'];

                                }

                                if($pass_en_bbdd === $clave){

                                    $estado_p = "d-none";
                                    
                                    $_SESSION['usuario'] = $usuario;
                                    $_SESSION['clave'] = $clave;
                                    header('Location: php/web_usuarios.php');
                                                        
                                }else{
                                    
                                    $estado_col = "bg-danger border border-light border-3";
                                    $estado_p ="d-block text-light";
                                
                                }

                            }else{

                                $estado_col = "bg-danger border border-light border-3";
                                $estado_p ="d-block text-light";
                        
                            }
                        }
                    }
                    ob_end_flush();
                ?>  
                <div class="col-4 mx-auto mt-5 p-3 <?php echo $estado_col?> rounded-3">
                    <p class="text-center my-auto <?php echo $estado_p?>">Autenticación fallida</p>
                </div>
            </div>           
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>