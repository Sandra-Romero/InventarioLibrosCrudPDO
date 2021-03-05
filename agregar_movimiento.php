
<!doctype html>
<html lang="es">
  <head>    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" />
    <title>Moviminetos</title>
  </head>
  <body>
    <br/>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>Agregar movimientos</h4>
            </div>
            <div class="card-body">

            <?php

if(isset($_POST["submit"])){
      //conexion con la base de datos
      include 'conexion.php';
      $conn = OpenCon();
   
      // Verificamos la conexión
      if ($conn == null) {
       die("No se pudo conectar a la base de datos: " . $conn->connect_error);
      }


    try {
      //Establece un atributo en el manejador de la base de datos
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
      //inicia una transacción y ejecuta dos sentencias que modifican la base de datos antes de revertir los cambios.
      $conn->beginTransaction();


    //agregar
      $sql = "INSERT INTO movimientos(idMovimientos, accion, cantidad,codigoLibro, nombreLibro, fecha) 
      VALUES ('".$_POST["idMovimientos"]."','".$_POST["accion"]."','".$_POST["cantidad"]."','".$_POST["codigoLibro"]."','".$_POST["nombreLibro"]."',NOW())";
              
      $count = $conn->exec($sql);

      if ($count > 0 ){
        echo "<div class=\"alert alert-success\" role=\"alert\">";
        echo "Se ha guardado el libro";
        echo "</div>";
     } else {
        echo "<div class=\"alert alert-danger\" role=\"alert\">";
        echo "No se pudo guardar el libro. ";
        echo "Error: " . $sql;
        print_r($conn->errorInfo());
        echo "</div>";               
     }

     header('location: listar_movimientos.php'); 


      //confirma los cambios
      $conn->commit();


  } catch (Exception $e){
    echo $e->getMessage();
    //Reconocer un error y revertir los cambios
      $conn->rollback();
  };

}
    ?>
           
            <?php
            //conexion con la base de datos
            include 'conexion.php';
            $conn = OpenCon();
         
            // Verificamos la conexión
            if ($conn == null) {
             die("No se pudo conectar a la base de datos: " . $conn->connect_error);
            }
            ?>            
                <form action = "" method = "POST">
              <div class="row">
              <div class="col-lg-6">
                    <label>Código:</label>
                    <input type = "text" name = "idMovimientos" id = "idMovimientos" class="form-control" />
                    <br />
                    <label>Acción:</label>
                    <select name = "accion" id = "accion" class="form-control"> 
                    <option value="0">Seleccione el movimiento</option>
                    <option value="entrada">Entrada</option>
                    <option value="salida">Salida</option>
                     </select>
                    <br />
                    <label>Cantidad:</label>
                    <input type = "text" name = "cantidad" id = "cantidad" class="form-control"/>
                    <br />
                    <label>Fecha:</label>
                    <input type = "date" name = "fecha" id = "fecha" class="form-control"/>
                    <br />
                    </div>
                  <div class="col-lg-6">
                  <label>Nombre Libro:</label>
                   <select name="codigoLibro" id="codigoLibro" class="form-control">
                      <option value="0">Seleccione el Codigo Libro</option>
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
                   <select name="nombreLibro" id="nombreLibro" class="form-control">
                      <option value="0">Seleccione el Nombre Libro</option>
                      <?php
                    // Realizamos la consulta para extraer los datos
                    $sql = "SELECT * FROM libros";
                    foreach ($conn->query($sql) as $row){
                      // En esta sección estamos llenando el select con datos extraidos de una base de datos.
                      echo '<option value="'.$row['nombreLibro'].'">'.$row['nombreLibro'].'</option>';
                    }?>
                    </select>
                    <br />
                    <input type = "Submit" value ="Guardar" name = "submit" class="btn btn-success"/>
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

