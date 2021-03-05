
<!doctype html>
<html lang="es">
  <head>    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" />
    <title>Generos</title>
  </head>
  <body>
    <br/>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>Editar generos</h4>
            </div>
            <div class="card-body">
 
        <?php
         //recibiendo datos para editar
         if(isset($_POST["submit"])){

           #Salir si alguno de los datos no está presente
           if(
            !isset($_POST["idGenero"]) || 
            !isset($_POST["nombreGenero"]) || 
            !isset($_POST["descripcion"])
            ) exit();

          #Si todo va bien, se ejecuta esta parte del código...
          //conexion a la bd
         include 'conexion.php';
         $conn = OpenCon();
  
         // Verificamos la conexión
         if ($conn == null) {
          die("No se pudo conectar a la base de datos: " . $conn->connect_error);
         } 
  
         //recibimos los datos del form
          $idGenero =$_POST['idGenero'];
          $nombreGenero=$_POST['nombreGenero'];
          $descripcion=$_POST['descripcion'];
     
         //consulta a la base de datos
         $sentencia = $conn->prepare("UPDATE generos SET idGenero = ?, nombreGenero = ?, descripcion = ? where idGenero = ?;");
          
         # Pasar en el mismo orden de los ?
         $resultado = $sentencia->execute([$idGenero, $nombreGenero, $descripcion, $idGenero]);
            
           header('location: listar_genero.php'); 
          }      
          
          ?>
  
            <?php  
            
            if(!isset($_GET["idGenero"])) exit();

            //recibo la variable por get
            $idGenero = $_GET["idGenero"];

            //conexion a la bd
            include 'conexion.php';
            $conn = OpenCon();
           
            // Verificamos la conexión
           if ($conn == null) {
            die("No se pudo conectar a la base de datos: " . $conn->connect_error);
           }

            //consulta
            $sentencia = $conn->prepare("SELECT * FROM  generos WHERE idGenero= ?;");
            $sentencia->execute([$idGenero]);

            $row = $sentencia->fetch(PDO::FETCH_OBJ);
            if($row === FALSE){
            #No existe
            echo "¡No existe el id del editorial!";
            exit();
            }
           #Si la persona existe, se ejecuta esta parte del código
           ?>

                <form action="" method = "POST">
                    <label>Código:</label>
                    <input type = "text" name = "idGenero" id = "idGenero" value="<?php echo $row->idGenero ?>" class="form-control " />
                    <br />
                    <label>Nombre:</label>
                    <input type = "text" name = "nombreGenero" id = "nombreGenero" value="<?php echo $row->nombreGenero ?>" class="form-control"/>
                    <br />
                    <label>Descripción:</label>
                    <input type = "text" name = "descripcion" id = "descripcion"  value="<?php echo $row->descripcion ?>" class="form-control"/>
                    <br />
                    <input type = "submit" value ="Actualizar" name = "submit" class="btn btn-success"/>
                    <a class="btn btn-info" href="listar_autores.php">Regresar</a>
                    <br />
                </form>

            </div>
        </div>
    </div>

  

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>

