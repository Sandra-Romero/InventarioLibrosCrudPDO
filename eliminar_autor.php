<?php
    if (isset($_GET['codigo'])) {
        include 'conexion.php';
        $conn = OpenCon();
           
       // Verificamos la conexión
       if ($conn == null) {
        die("No se pudo conectar a la base de datos: ");
        header('Location: /inventarioPDO/listar_editoriales.php?result=0');
       } 
    
        
        $sql = "DELETE FROM autores WHERE codigoAutor = ?";

        $sth = $conn->prepare($sql);
        $sth->execute(array($_GET['codigo']));

        $count = $sth->rowCount();

            if ($count > 0) {
                header('Location: /inventarioPDO/listar_autores.php?result=1');                
                exit();
            } else {
                header('Location: /inventarioPDO/listar_autores.php?result=0');
            }
            $conn->close();
    } else {
        header('Location: /inventarioPDO/listar_autores.php?result=0');
    }
?>