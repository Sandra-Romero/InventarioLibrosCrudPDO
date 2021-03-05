<!doctype html>
<html lang="es">
  <head>    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" />
    <title>Genero de Libros</title>
  </head>
  <body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Inventario de Libros</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link" href="listar_libros.php">Libros</a>
      <a class="nav-item nav-link" href="listar_editoriales.php">Editoriales</a>
      <a class="nav-item nav-link" href="listar_autores.php">Autores</a>
      <a class="nav-item nav-link" href="listar_genero.php">Generos</a> 
      <a class="nav-item nav-link" href="listar_movimientos.php">Movimientos</a>
    </div>
  </div>
</nav>

    <br/>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-10">
                        <h4>Lista de Generos</h4>
                    </div>
                    <div class="col-lg-2">
                        <a class="btn btn-success" href="agregar_genero.php"><i class="fas fa-plus"></i> Agregar</a>
                    </div>
                </div>                
            </div>

            <?php
            //conexion a la base de datos
            include 'conexion.php';
            $conn = OpenCon();
            
            //consulta a la bd
            $sql = "SELECT * FROM generos";
            ?>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Id Genero</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Opciones</th>
                        </tr>                        
                    </thead>
                    <tbody>
                <?php
                     foreach ($conn->query($sql) as $row) {
                        echo "<tr>";
                        echo "<td>" . $row["idGenero"]. "</td>";
                        echo "<td>" . $row["nombreGenero"]. "</td>";
                        echo "<td>" . $row["descripcion"]. "</td>";
                        echo "<td>";
                        echo "<a class=\"btn btn-warning\" href=\"http://localhost/inventarioPDO/editar_genero.php?idGenero=". $row["idGenero"]."\"><i class=\"fas fa-edit\"></i></a> ";
                        echo "<a class=\"btn btn-danger\" href=\"http://localhost/inventarioPDO/eliminar_genero.php?codigo=". $row["idGenero"]."\"><i class=\"far fa-trash-alt\"></i></a>";
                        echo "</td>";
                        echo "</tr>";
                    }

                    ?>
                    </tbody>
                </table>
    
             <?php
            CloseCon($conn);
            ?>

        </div>

        <?php
            if (isset($_GET['result'])) {
               if($_GET['result'] == 1) {
                    echo "<div class=\"alert alert-success\" role=\"alert\">";
                    echo "Se ha eliminado el genero";
                    echo "</div>";
               }else{
                    echo "<div class=\"alert alert-danger\" role=\"alert\">";
                    echo "No se pudo eliminar el genero. ";                
                    echo "</div>";  
               }
            }
        ?>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>

