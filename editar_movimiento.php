<?php  
             //recibiendo datos para editar
            if(isset($_POST["submit"])){
  
            #Salir si alguno de los datos no está presente
            if(
              !isset($_POST["idMovimientos"]) || 
            	!isset($_POST["accion"]) || 
	            !isset($_POST["cantidad"]) || 
              !isset($_POST["fecha"])||
              !isset($_POST["codigoLibro"]) ||
              !isset($_POST["nombreLibro"])
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
            $idMovimientos = $_POST["idMovimientos"];
            $accion = $_POST["accion"];
            $cantidad = $_POST["cantidad"];
            $fecha = $_POST["fecha"];
            $codigoLibro = $_POST["codigoLibro"];
            $nombreLibro = $_POST["nombreLibro"];

            $sentencia = $conn->prepare("UPDATE movimientos SET idMovimientos = ?, accion = ?, cantidad = ?, fecha =?, codigoLibro =? ,nombreLibro =?  WHERE idMovimientos = ?;");
             # Pasar en el mismo orden de los ?
            $resultado = $sentencia->execute([$idMovimientos, $accion, $cantidad, $fecha, $codigoLibro, $nombreLibro,  $idMovimientos]);
            

            header('location: listar_movimientos.php');
          }
        ?>  

          <?php

           if(!isset($_GET["idMovimientos"])) exit();
           
           //recibo la variable por get
           $idMovimientos = $_GET["idMovimientos"];
           
           //conexion con la bd
           include 'conexion.php';
           $conn = OpenCon();

           // Verificamos la conexión
          if ($conn == null) {
             die("No se pudo conectar a la base de datos: " . $conn->connect_error);
            } 

           //consulta
            $sentencia = $conn->prepare("SELECT * FROM movimientos WHERE idMovimientos = ?;");
            $sentencia->execute([$idMovimientos]);

           $row = $sentencia->fetch(PDO::FETCH_OBJ);
           if($row === FALSE){
	         #No existe
	         echo "¡No existe el id del editorial!";
	         exit();
           }
          #Si la persona existe, se ejecuta esta parte del código
          ?>


<!doctype html>
<html lang="es">
  <head>    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" />
    <title>Movimiento</title>
  </head>
  <body>
    <br/>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>Editar Movimiento</h4>
            </div>
            <div class="card-body"> 
         
                   <form action = "" method = "POST">
                   <div class="row">
                    <div class="col-lg-6">
                    <label>Código:</label>
                    <input type = "text" name = "idMovimientos" id = "idMovimientos" value="<?php echo $row->idMovimientos ?>" class="form-control" />
                    <br />
                    <label>Acción:</label>
                    <select name = "accion" id = "accion" value="<?php echo $row->accion ?>" class="form-control"> 
                    <option value="0">Seleccione el movimiento</option>
                    <option value="entrada">Entrada</option>
                    <option value="salida">Salida</option>
                     </select>
                    <br />
                    <label>Cantidad:</label>
                    <input type = "text" name = "cantidad" id = "cantidad" value="<?php echo $row->cantidad ?>" class="form-control"/>
                    <br />
                    <label>Fecha:</label>
                    <input type = "date" name = "fecha" id = "fecha" value="<?php echo $row->fecha ?>" class="form-control"/>
                    <br />
                    </div>
                    <div class="col-lg-6">
                    <label>Codigo Libro:</label>
                   <select name="codigoLibro" id="codigoLibro" class="form-control">
                      <option value="0"><?php echo $row->codigoLibro ?></option>
                      <?php
                    // Realizamos la consulta para extraer los datos
                    $sql = "SELECT * FROM libros";
                    foreach ($conn->query($sql) as $row){
                      // En esta sección estamos llenando el select con datos extraidos de una base de datos.
                      echo '<option value="'.$row['codigoLibro'].'">'.$row['codigoLibro'].'</option>';
                    }?>
                    </select>
                    <br />
                    <label>Nombre Libro:</label>
                   <select name="nombreLibro" id="nombreLibro" value="<?php echo $row->nombreLibro ?>" class="form-control">
                      <option value="0"><?php echo $row->nombreLibro ?></option>
                      <?php
                    // Realizamos la consulta para extraer los datos
                    $sql = "SELECT * FROM libros";
                    foreach ($conn->query($sql) as $row){
                      // En esta sección estamos llenando el select con datos extraidos de una base de datos.
                      echo '<option value="'.$row['nombreLibro'].'">'.$row['nombreLibro'].'</option>';
                    }?>
                    </select>
                    <br />
                    <input type = "Submit" value ="Actualizar" name = "submit" class="btn btn-success"/>
                    <a class="btn btn-info" href="listar_movimientos.php">Regresar</a>
                    <br />
                    </div>
                   </div>
                  
                </form>
            </div>
        </div>
    </div>

   

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>

