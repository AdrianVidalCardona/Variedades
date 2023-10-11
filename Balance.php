<?php include("BD.php") ?>
<?php include("Header.php"); ?>

<body class="container">
    <main>
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <!-- Solicitando el ingreso de datos -->
                        <form method="post">
                            <input type="text" hidden name="id" id="id" value="">
                            <input type="date" class="form-control" name="fecha" id="fecha" aria-describedby="helpId">
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" name="valorDia" id="valorDia" aria-describedby="helpId" placeholder="Valor del día (sin puntos)">
                            </div>
                            <input type="text"
                            class="form-control" name="observacion" id="observacion" aria-describedby="helpId" placeholder="Agregar observacion (opcional)">
                            <button type="submit" class="btn btn-primary">Agregar</button>
                            <a class="btn btn-primary float-end" href="Extractor.php?Balance" role="button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16"><path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/><path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/></svg></a>
                        </form>
                </div>
                    <!-- Mostrando -->
                    <div class="mb-3">
                        <form method="get">
                            <div class="input-group">
                                <input type="date" class="form-control" name="fechaInicial" id="fechaInicial" aria-describedby="helpId">
                                <input type="date" class="form-control" name="fechaFinal" id="fechaFinal" aria-describedby="helpId" onChange="this.form.submit()">
                            </div>
                            <!--<button type="submit" class="btn btn-primary"></button>-->
                        </form>
                        <?php 
                            $total = 0;
                            if (isset($_GET["fechaInicial"])){
                                $inicial = $_GET["fechaInicial"];
                                $final = $_GET["fechaFinal"];
                                $sql = "SELECT bValor FROM balance WHERE bDate BETWEEN '".$inicial."' AND '".$final."'";
                                $actualizacion = $conection -> query($sql);
                                foreach ($actualizacion as $registro) {
                                    $total =  $total + $registro["bValor"];
                                }
                            }else {
                                date_default_timezone_set("America/Bogota");
                                $final =  date("Y/m/d");
                                $sql = "SELECT bValor FROM balance WHERE bDate <='".$final."'";
                                $actualizacion = $conection -> query($sql);
                                foreach ($actualizacion as $registro) {
                                    $total =  $total + $registro["bValor"];
                                }
                            }
                        ?>
                        <br><span class="d-inline p-2 bg-dark text-white">El balance total es $<?php echo number_format($total); ?></span>
                    </div>
                <div class="table-responsive row tbl-fixed">
                    <table class="table table-striped table-hover	table-borderless table-primary align-middle" style="text-align:center;">
                        <thead class="table-dark">
                            <tr>
                                <th>Fecha</th>
                                <th>Valor</th>
                                <th>Observacion</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <?php foreach ($balance as $registro) { ?>
                                <tr>
                                    <form method="post">
                                        <td><?php echo date_format(date_create_from_format('Y-m-d',$registro["bDate"]),"d/m/Y"); ?></td>
                                        <td>$<?php echo number_format($registro["bValor"]); ?></td>
                                        <td>
                                            <input hidden name="edId" id="edId" value="<?php echo $registro["bId"]; ?>"></input>
                                            <textarea class="form-control" name="edObservacion" id="edObservacion" cols="1" rows="1" onChange="this.form.submit()"><?php echo $registro["bObservacion"]; ?></textarea>
                                        </td>
                                    </form>
                                    <td>
                                        <h6 class="float-none">
                                            <a href="?dId=<?php echo $registro["bId"];?>"><span
                                            class="badge bg-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16"><path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/></svg></span></a>
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

<?php include("Footer.php") ?>