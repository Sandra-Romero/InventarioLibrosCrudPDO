
<!doctype html>
<html lang="es">
  <head>    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" />
    <title>Editoriales</title>
  </head>
  <body>
    <br/>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>Editar editorial</h4>
            </div>
            <div class="card-body">

            <?php  
             //recibiendo datos para editar
            if(isset($_POST["submit"])){
  
            #Salir si alguno de los datos no está presente
            if(
	            !isset($_POST["codigoEditorial"]) || 
            	!isset($_POST["nombreEditorial"]) || 
	            !isset($_POST["contacto"]) || 
	            !isset($_POST["telefono"])
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
            $codigoEditorial = $_POST["codigoEditorial"];
            $nombreEditorial = $_POST["nombreEditorial"];
            $contacto = $_POST["contacto"];
            $telefono = $_POST["telefono"];

            $sentencia = $conn->prepare("UPDATE editoriales SET codigoEditorial = ?, nombreEditorial = ?, contacto = ?, telefono =?  WHERE codigoEditorial = ?;");
             # Pasar en el mismo orden de los ?
            $resultado = $sentencia->execute([$codigoEditorial, $nombreEditorial, $contacto, $telefono,  $codigoEditorial]);
            

            header('location: listar_editoriales.php');
          }
        ?>  

          <?php

           if(!isset($_GET["codigoEditorial"])) exit();
           
           //recibo la variable por get
           $codigoEditorial = $_GET["codigoEditorial"];
           
           //conexion con la bd
           include 'conexion.php';
           $conn = OpenCon();

           // Verificamos la conexión
          if ($conn == null) {
             die("No se pudo conectar a la base de datos: " . $conn->connect_error);
            } 

           //consulta
            $sentencia = $conn->prepare("SELECT * FROM editoriales WHERE codigoEditorial = ?;");
            $sentencia->execute([$codigoEditorial]);

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
                    <input type = "text" name = "codigoEditorial" id = "codigoEditorial" value="<?php echo $row->codigoEditorial ?>" class="form-control " />
                    <br />
                    <label>Nombre:</label>
                    <input type = "text" name = "nombreEditorial" id = "nombreEditorial" value="<?php echo $row->nombreEditorial ?>"  class="form-control nombreEditorial "/>
                    <br />
                    <label>Contacto:</label>
                    <input type = "text" name = "contacto" id = "contacto"   value="<?php echo $row->contacto ?>"  class="form-control"/>
                    <br />
                    <label>Teléfono:</label>
                    <input type = "text" name = "telefono" id = "telefono"  value="<?php echo $row->telefono ?>"  class="form-control"/>
                    <br />
                    <input type = "submit" value ="Actualizar" name = "submit" class="btn btn-success"/>
                    <a class="btn btn-info" href="listar_editoriales.php">Regresar</a>
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

