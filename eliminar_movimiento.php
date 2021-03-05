<?php
    if (isset($_GET['codigo'])) {
        include 'conexion.php';
        $conn = OpenCon();
           
        // Verificamos la conexión
        if ($conn == null) {
            die("No se pudo conectar a la base de datos: ");
            header('Location: /inventarioPDO/listar_movimientos.php?result=0');
        } 
        
        $sql = 'DELETE FROM movimientos WHERE idMovimientos = ?';

        $sth = $conn->prepare($sql);
        $sth->execute(array($_GET['codigo']));

        $count = $sth->rowCount();
        
            if ($count > 0){
                header('Location: /inventarioPDO/listar_movimientos.php?result=1');                
                exit();
            } else {
                header('Location: /inventarioPDO/listar_movimientos.php?result=0');
            }
            $conn->close();
    } else {
        header('Location: /inventarioPDO/listar_movimientos.php?result=0');
    }
?>