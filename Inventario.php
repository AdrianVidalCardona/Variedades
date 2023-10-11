<?php include("BD.php") ?>
<?php include("Header.php"); ?>

<body class="container">
        <main>
            <div class="card">
                <div class="card-body">
                  <!-- Mostrando los datos -->
                      
                    <form method="get">
                        <div class="input-group">
                        <input type="text" class="form-control" placeholder="Dato a buscar" name="buscar" aria-label="Button" aria-describedby=""><button class="btn btn-secondary" type="submit" id=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/></svg>Buscar</button><a class="btn btn-primary btn-sm" href="Extractor.php?balance" role="button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16"><path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/><path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/></svg></a>
                        </div>
                    </form>
                    <?php if (isset($_GET["buscar"])) { 
                        $busqueda = $_GET["buscar"];
                        if ($busqueda != "") {
                            $sql = "SELECT * FROM materiales WHERE mUnion LIKE '%".$busqueda."%' ORDER BY mId DESC  ";
                            $resultado = $conection -> query($sql);
                        }
                    } ?>
                    <div class="table-responsive row tbl-fixedd">
                        <table class="table table-striped table-hover 	table-borderless table-primary align-middle" style="text-align:center">
                            <thead class="table-dark">
                                <tr>
                                    <th>Categoria</th>
                                    <th>Objeto</th>
                                    <th>Descripcion</th>
                                    <th>Valor coste</th>
                                    <th>Disponible</th>
                                    <th>Valor venta</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider ">
                                <?php foreach ($resultado as $registro) { ?>
                                    <tr>
                                        <td hidden><?php echo $registro["mId"]; ?></td>
                                        <td><?php echo $registro["mCategoria"]; ?></td>
                                        <td><?php echo $registro["mNombre"]; ?></td>
                                        <td><?php echo $registro["mDescripcion"]; ?></td>
                                        <td>$ <?php echo number_format($registro["mPorMayor"]); ?></td>
                                        <td><?php echo number_format($registro["mDisponible"]); ?></td>
                                        <td>$ <?php echo number_format($registro["mValor"]); ?></td>
                                        <td>
                                            <h6>
                                                <a href="Editar.php?eId=<?php echo $registro["mId"];?>"><span
                                                class="badge bg-warning text-dark"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16"><path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/></svg></span></a>
                                            </h6>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                            
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </body>
<?php include("Footer.php"); ?>