<?php include("BD.php") ?>
<?php include("Header.php"); ?>

<body class="container">
        <main>
            <div class="card">
                <div class="card-body">
                    <!-- Solicitando actualizacion de datos -->
                        <div class="mb-3">
                            
                            <?php if(isset($_POST["Agregar"])){ ?>
                                <div class="alert alert-primary" role="alert">
                                    <strong>Actualizado exitosamente</strong>
                                </div>
                            <?php } 
                                if (isset($_POST["objeto"])) {
                                    $id = $_POST["id"];
                                    $sql = "UPDATE materiales SET mCategoria='".$_POST["categoria"]."', mNombre='".$_POST["objeto"]."', mDescripcion='".$_POST["descripcion"]."', mPorMayor='".$_POST["valorObjetoEmpresa"]."', mDisponible='".$_POST["cantidadObjeto"]."', mValor='".$_POST["valorObjeto"]."', mUnion='".$_POST["categoria"].$_POST["objeto"].$_POST["descripcion"]."' WHERE mId='".$id."'";
                                    $resultado = $conection -> query($sql);
                                    exit();
                                }else {
                                $id = $_GET["eId"];
                                $sql = "SELECT * FROM materiales WHERE mId='".$id."'";
                                $actualizacion = $conection -> query($sql);
                                foreach ($actualizacion as $registro) {
                            ?>
                                <form method="post">
                                    <input type="text" hidden name="id" value="<?php echo $id;?>">
                                    <!-- Solicitando Categoria -->
                                        <select class="form-select form-select-ls" name="categoria" id="categoria">
                                            <option value="Papeleria"  <?php echo ($registro["mCategoria"]=="Papeleria"?"selected":""); ?>>Papeleria</option>
                                            <option value="Electronico" <?php echo ($registro["mCategoria"]=="Electronico"?"selected":""); ?>>Electronico</option>
                                            <option value="Variedades" <?php echo ($registro["mCategoria"]=="Variedades"?"selected":""); ?>>Variedades</option>
                                            <option value="Otro" <?php echo ($registro["mCategoria"]=="Otro"?"selected":""); ?>>Otro</option>
                                        </select>
                                    <!-- Solicitando Nombre -->
                                        <input type="text" class="form-control" name="objeto" id="objeto" aria-describedby="helpId" placeholder="Nombre del objeto" value="<?php echo $registro["mNombre"]; ?>">
                                    <!-- Solicitando Descripcion -->
                                        <input type="text" class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Descripcion del objeto"value="<?php echo $registro["mDescripcion"]; ?>">
                                    <!-- Solicitando Valor al por mayor -->
                                        <div class="input-group">
                                            <span class="input-group-text">Valor de la compra $</span>
                                            <input type="number" class="form-control" name="valorObjetoEmpresa" id="valorObjetoEmpresa" aria-describedby="helpId" value="<?php echo $registro["mPorMayor"]; ?>">
                                        </div>
                                    <!-- Solicitando Cantidad disponible -->
                                        <div class="input-group">
                                            <span class="input-group-text">Disponible</span>
                                            <input type="number" class="form-control" name="cantidadObjeto" id="cantidadObjeto" aria-describedby="helpId" value="<?php echo $registro["mDisponible"]; ?>">
                                        </div>
                                    <!-- Solicitando Valor -->
                                        <div class="input-group">
                                            <span class="input-group-text">Valor de la venta $</span>
                                            <input type="number" class="form-control" name="valorObjeto" id="valorObjeto" aria-describedby="helpId" value="<?php echo $registro["mValor"]; ?>">
                                        </div>
                                    <br>
                                    <input class="btn btn-primary" type="submit" name="Agregar" value="Actualizar">
                                </form>
                                <?php } } 
                                ?>
                            </div>
                        </div>
                    </div>
        </main>
    </body>
<?php include("Footer.php"); ?>