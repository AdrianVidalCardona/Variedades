<?php

    $server = "localhost";
    $user = "root";
    $password = "";
    $bd = "variedades_vicar";
    //Conectando a la base de datos
        try {
            $conection = new PDO("mysql:host=$server;dbname=$bd", $user, $password);
            // echo "Conexion establecida";
        } catch (PDOException $e) {
            echo "Error al conectar: ".$e;
        }
    // Tabla Materiales
        // Agregando datos en la tabla Materiales
            if (isset($_POST["objeto"]) and ($_POST["id"] == "")) {
                $categoria = $_POST["categoria"];
                $objeto = $_POST["objeto"];
                $objetoDescripcion = $_POST["descripcion"];
                $valorMayor = $_POST["valorObjetoEmpresa"];
                $cantidadObjeto = $_POST["cantidadObjeto"];
                $valorObjeto = $_POST["valorObjeto"];
                $union = $categoria."".$objeto."".$objetoDescripcion;

                $sql = "INSERT INTO materiales (mCategoria, mNombre, mDescripcion, mPorMayor, mDisponible, mValor, mUnion) VALUE (?, ?, ?, ?, ?, ?, ?)";
                $sentencia = $conection -> prepare($sql);
                $sentencia -> execute([$categoria, $objeto, $objetoDescripcion, $valorMayor, $cantidadObjeto, $valorObjeto, $union]);

            }
        // Eliminando datos de la tabla Materiales
            if (isset($_GET["dId"])) {
                $id = $_GET["dId"];
                $sql = "DELETE FROM materiales WHERE mId=?";
                $setencia = $conection -> prepare($sql);
                $setencia -> execute([$id]);
            }
    // Tabla Materiales

    // Tabla Balance
        // Agregando datos en la tabla Balance
        if (isset($_POST["fecha"]) and ($_POST["id"] == "")) {
            if ($_POST["fecha"] == ""){
                $fecha = date("Y/m/d");
            }else {
                $fecha = $_POST["fecha"];
            }
            $valor = $_POST["valorDia"];
            $observacion = $_POST["observacion"];

            $sql = "INSERT INTO Balance (bDate, bValor, bObservacion) VALUE (?, ?, ?)";
            $sentencia = $conection -> prepare($sql);
            $sentencia -> execute([$fecha, $valor, $observacion]);
        }elseif (isset($_POST["edObservacion"])) {
            $id = $_POST["edId"];
            $observacion = $_POST["edObservacion"];
            $sql = "UPDATE balance SET bObservacion='$observacion' WHERE bId='".$id."'";
            $resultado = $conection -> query($sql);
        }

        // Eliminando datos tabla Balance
        if (isset($_GET["dId"])) {
            $id = $_GET["dId"];
            $sql = "DELETE FROM balance WHERE bId=?";
            $setencia = $conection -> prepare($sql);
            $setencia -> execute([$id]);
        }
    // Tabla Balance  
    
    $sql = "SELECT * FROM materiales ORDER BY mId DESC";
    $resultado = $conection -> query($sql);

    $sql = "SELECT * FROM balance ORDER BY bDate DESC, bId DESC";
    $balance = $conection -> query($sql);

?>