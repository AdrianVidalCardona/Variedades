<?php
	header('Content-type:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	
	include('BD.php');
	
	if (isset($_GET["Balance"])) {
		header('Content-Disposition: attachment; filename="Balance.xls"');
?>

<table border="1">
	<tr>
		<th style="background-color:red;">Fecha</th>
		<th style="background-color:red;">Valor</th>
		<th style="background-color:gray;">Observacion</th>
	</tr>
	<?php
		$valor = 0;
		foreach ($balance as $row) { ?>
				<tr>
					<td><?php echo $row['bDate']; ?></td>
					<td>$<?php echo $row['bValor']; ?></td>
					<td><?php echo $row['bObservacion']; ?></td>
				</tr>	
			<?php
		$valor = $valor + $row['bValor'];
		}
	?>
	<tr>
		<th style="background-color:red;">Total</th>
		<th style="background-color:red;">$<?php echo $valor; ?></th>
	</tr>
</table>

<?php }else { 
	header('Content-Disposition: attachment; filename="Inventario.xls"');

	//number_format());
	?>
	<table border="1">
	<tr>
		<th style="background-color:red;">Categoria</th>
		<th style="background-color:red;">Nombre</th>
		<th style="background-color:red;">Descripcion</th>
		<th style="background-color:red;">Al por mayor</th>
		<th style="background-color:red;">Cantidad disponible</th>
		<th style="background-color:red;">Valor a vender</th>
	</tr>
	<?php
		$valor = 0;
		foreach ($resultado as $row) { ?>
				<tr>
					<td><?php echo $row['mCategoria']; ?></td>
					<td><?php echo $row['mNombre']; ?></td>
					<td><?php echo $row['mDescripcion']; ?></td>
					<td>$<?php echo $row['mPorMayor']; ?></td>
					<td><?php echo number_format($row['mDisponible'],0,".","."); ?></td>
					<td>$<?php echo $row['mValor']; ?></td>
				</tr>	
			<?php
		}
	?>
</table>
<?php } ?>