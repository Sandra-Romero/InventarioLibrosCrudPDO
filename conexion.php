
<?php
//conexion a la bd por PDO

function OpenCon(){
  $dsn = 'mysql:dbname=inventario_libros;host=127.0.0.1';
  $usuario = 'root';
  $contraseña = 'sandra23';

  try{
    $mbd = new PDO($dsn,$usuario,$contraseña,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    
  }catch(PDOException $e){
    die("Fallo la conexion" . $e->getMessage());
    $mbd = null;
  }

  return $mbd;

}

function CloseCon($mbd){
  $mbd = null;
}

?>