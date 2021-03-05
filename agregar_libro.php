
<!doctype html>
<html lang="es">
  <head>    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" />
    <title>Libros</title>
  </head>
  <body>
    <br/>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>Agregar libro</h4>
            </div>
            <div class="card-body">

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
                    <input type = "text" name = "codigoLibro" id = "codigoLibro" class="form-control" />
                    <br />
                    <label>Nombre:</label>
                    <input type = "text" name = "nombreLibro" id = "nombreLibro" class="form-control"/>
                    <br />
                    <label>Existencias:</label>
                    <input type = "number" name = "existencias" id = "existencias" class="form-control"/>
                    <br />
                    <label>Precio:</label>
                    <input type = "number" name = "precio" id = "precio" class="form-control"/>
                   </div>
                   <div class="col-lg-6">
                   <label>Código Autor:</label>
                   <select name="codigoAutor" id="codigoAutor" class="form-control">
                      <option value="0">Seleccione el Código Autor</option>
                      <?php
                    // Realizamos la consulta para extraer los datos
                    $sql = "SELECT * FROM autores";
                    foreach ($conn->query($sql) as $row){
                      // En esta sección estamos llenando el select con datos extraidos de una base de datos.
                      echo '<option value="'.$row['codigoAutor'].'">'.$row['codigoAutor'].'</option>';
                    }?>
                    </select>
                    <br />
                    <label>Código Editorial:</label>
                    <select name="codigoEditorial" id="codigoEditorial" class="form-control">
                      <option value="0">Seleccione el Código Editorial</option>
                      <?php
                    // Realizamos la consulta para extraer los datos
                    $sql = "SELECT * FROM editoriales";
                    foreach ($conn->query($sql) as $row){
                      // En esta sección estamos llenando el select con datos extraidos de una base de datos.
                      echo '<option value="'.$row['codigoEditorial'].'">'.$row['codigoEditorial'].'</option>';
                    }?>
                   
                    </select>
                    <br />
                    <label>Código Genero:</label>
                    <select name="idGenero" id="idGenero" class="form-control">
                      <option name="idGenero" value="0">Seleccione el idGenero</option>
                      <?php
                    // Realizamos la consulta para extraer los datos
                    $sql = "SELECT * FROM generos";
                    foreach ($conn->query($sql) as $row){
                      // En esta sección estamos llenando el select con datos extraidos de una base de datos.
                      echo '<option value="'.$row['idGenero'].'">'.$row['idGenero'].'</option>';
                    }?>
                    </select>
                    <br />
                    <label>Descripción:</label>
                    <input type = "text" name = "descripcion" id = "descripcion" class="form-control"/>
                    <br />
                    <input type = "Submit" value ="Guardar" name = "submit" class="btn btn-success"/>
                    <a class="btn btn-info" href="listar_libros.php">Regresar</a>
                   </div>
                </div>
        
                </form>
            </div>
        </div>
    </div>

    <?php
  if(isset($_POST["submit"])){
    
    $sql = "INSERT INTO libros(codigoLibro,nombreLibro,existencias,precio,codigoAutor,codigoEditorial,idGenero,descripcion) 
    VALUES ('".$_POST["codigoLibro"]."','".$_POST["nombreLibro"]."','".$_POST["existencias"]."','".$_POST["precio"]."',
    '".$_POST["codigoAutor"]."','".$_POST["codigoEditorial"]."','".$_POST["idGenero"]."','".$_POST["descripcion"]."')";
            
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
   $conn->close();
  }

    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>

