<?php
 //conexion a la bd por PDO
$dsn = 'mysql: dbname=inventario_libros; host=127.0.0.1';
$usuario = 'root';
$contraseña = 'sandra23';

$mbd = new PDO($dsn,$usuario,$contraseña);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" />
    <title>Inventario de Libros</title>

    <style>
      body{
  
          background: url(inventariolibros.jpg) no-repeat center center fixed; 
          -webkit-background-size: cover;
          -moz-background-size: cover;
          -o-background-size: cover;
          background-size: cover;
      }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Inventario de Libros</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link" href="listar_editoriales.php">Editoriales</a>
      <a class="nav-item nav-link" href="listar_autores.php">Autores</a>
      <a class="nav-item nav-link" href="listar_genero.php">Generos</a> 
      <a class="nav-item nav-link" href="listar_movimientos.php">Movimientos</a>
    </div>
  </div>
</nav>


</body>
</html>



