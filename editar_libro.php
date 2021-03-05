          <?php  
             //recibiendo datos para editar
            if(isset($_POST["submit"])){
  
            #Salir si alguno de los datos no está presente
            if(
	            !isset($_POST["codigoLibro"]) || 
            	!isset($_POST["nombreLibro"]) || 
	            !isset($_POST["existencias"]) || 
              !isset($_POST["precio"])||  
              !isset($_POST["codigoAutor"]) ||
              !isset($_POST["codigoEditorial"]) || 
              !isset($_POST["idGenero"])|| 
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
            $codigoLibro = $_POST["codigoLibro"];
            $nombreLibro = $_POST["nombreLibro"];
            $existencias = $_POST["existencias"];
            $precio = $_POST["precio"];
            $codigoAutor = $_POST["codigoAutor"];
            $codigoEditorial = $_POST["codigoEditorial"];
            $idGenero = $_POST["idGenero"];
            $descripcion = $_POST["descripcion"];

            $sentencia = $conn->prepare("UPDATE libros SET codigoLibro = ?, 
            nombreLibro = ?, existencias = ?, precio =?, codigoAutor = ?,  codigoEditorial = ?, 
            idGenero = ?, descripcion = ? WHERE codigoLibro = ?;");
            
            # Pasar en el mismo orden de los ?
            $resultado = $sentencia->execute([$codigoLibro, $nombreLibro, $existencias, $precio,  $codigoAutor,
            $codigoEditorial, $idGenero, $descripcion, $codigoLibro]);

           if($resultado === TRUE) echo "Cambios guardados";
           echo "Algo salió mal. Por favor verifica que la tabla exista, así como el ID del usuario";
          
           header('location: listar_libros.php');
          }
        ?>  

          <?php

           if(!isset($_GET["codigoLibro"])) exit();
           
           //recibo la variable por get
           $codigoLibro = $_GET["codigoLibro"];
           
           //conexion con la bd
           include 'conexion.php';
           $conn = OpenCon();

           // Verificamos la conexión
          if ($conn == null) {
             die("No se pudo conectar a la base de datos: " . $conn->connect_error);
            } 

           //consulta
            $sentencia = $conn->prepare("SELECT * FROM libros WHERE codigoLibro = ?;");
            $sentencia->execute([$codigoLibro]);

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
    <title>Libros</title>
  </head>
  <body>
    <br/>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>Editar Libro</h4>
            </div>
            <div class="card-body">
       
                <form action = "" method = "POST">
                <div class="row">
                <div class="col-lg-6">
                  <label>Código:</label>
                    <input type = "text" name = "codigoLibro" id = "codigoLibro" value="<?php echo $row->codigoLibro ?>" class="form-control" />
                    <br />
                    <label>Nombre:</label>
                    <input type = "text" name = "nombreLibro" id = "nombreLibro" value="<?php echo $row->nombreLibro ?>" class="form-control"/>
                    <br />
                    <label>Existencias:</label>
                    <input type = "number" name = "existencias" id = "existencias" value="<?php echo $row->existencias ?>" class="form-control"/>
                    <br />
                    <label>Precio:</label>
                    <input type = "number" name = "precio" id = "precio" value="<?php echo $row->precio ?>" class="form-control"/>
                    <br />
                    <label>Descripción:</label>
                    <input type = "text" name = "descripcion" id = "descripcion"  value="<?php echo $row->descripcion ?>"  class="form-control"/>
                    <br />
                   </div>
                   
                   <div class="col-lg-6">
                   <label>Código Autor:</label>
                   <select name="codigoAutor" id="codigoAutor"   class="form-control" >
                      <option><?php echo $row->codigoAutor ?></option>
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
                      <option><?php echo $row->codigoEditorial ?></option>
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
                    <select name="idGenero" id="idGenero"  class="form-control">
                      <option ><?php echo $row->idGenero ?></option>
                      <?php
                    // Realizamos la consulta para extraer los datos
                    $sql = "SELECT * FROM generos";
                    foreach ($conn->query($sql) as $row){
                      // En esta sección estamos llenando el select con datos extraidos de una base de datos.
                      echo '<option value="'.$row['idGenero'].'">'.$row['idGenero'].'</option>';
                    }?>
                    </select>
                    <br />
                    <br />
                    <input type = "Submit" value ="Actualizar" name = "submit" class="btn btn-success"/>
                    <a class="btn btn-info" href="listar_libros.php">Regresar</a>
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

