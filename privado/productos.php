<?php 
	require 'procesos/conexion.php';
	include 'procesos/autenticar.php';
	include 'procesos/lifeprivate.php';
	$button = "";
    if(!empty($_SESSION['autenticadop'])){
        $nombre = $_SESSION['autenticadop'];
        require '../privado/procesos/conexion.php';
        $sql = "SELECT id_permiso FROM usuarios WHERE id_usuario=?";
        $id = $_SESSION['idusr'];
        $stmt = $con->prepare($sql);
        $stmt->execute(array($id));
        $permiso = $stmt->fetch(PDO::FETCH_BOTH);
        $sql = "SELECT tbl_productos FROM permisos WHERE id_permiso=?";
        $id = $_SESSION['idusr'];
        $stmt = $con->prepare($sql);
        $stmt->execute(array($permiso[0]));
        $valor = $stmt->fetch(PDO::FETCH_BOTH);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Administración de Productos
	</title>
	<?php include 'links.php' ?>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<?php include 'menu_admin.php' ?>
			<br>
			<br>
			<br>
			<br>
			<div class="col-lg-12" id="frm">
				<div class="col-lg-6 col-md-6">
					<p id="id_reg" class="hide"></p>
					<input type="text" class="hide omitir" value="7" id="tbl" autocomplete='off'>
					<label for="" class="labels" data-toggle="tooltip" data-placement="right" title="No mayor a 20 caractéres.">Nombre del Producto</label>
                    <input type="text" class="form-control input" id="nombre" autocomplete='off'>
                    <br>
                    <label for="" class="labels">Calificacion Promedio</label>
                    <input type="text" class="form-control input omitir" value='0' id="calificacion" disabled autocomplete='off'>
                    <br>
				</div>
				<div class="col-lg-6 col-md-6">
                    <label for="" class="labels">Tipo de producto</label>
                    <select class="form-control" name="usuarios[]" id="tipo-prod" >
                    	<option value="0" selected="">SELECCIONE EL TIPO DE PRODUCTO</option>
						<?php 
                            $sql = "SELECT * FROM tipos_producto where estado_tipo_producto=?";
                            $stmt = $con->prepare($sql);
			    			$stmt->execute(array(1));
							while ($datos = $stmt->fetch(PDO::FETCH_BOTH))  {
                                echo "<option value='$datos[0]'>$datos[1]</option>";
                            }
                        ?>
					</select>
					<br>
					<label for="" class="labels" data-toggle="tooltip" data-placement="right" title="No mayor a 100 caractéres.">Descripcion del producto</label>
                    <textarea type="text" id="descripcion" class="form-control input estira" rows="5" autocomplete='off'></textarea>
                    <br>
				</div>
				<div class="col-lg-12">
					<?php  
						if ($valor[0] >= 4) {
							$button = 
							"<button class='btn btn-ag btn-scrud col-lg-3 col-md-3 col-sm-3'>
									AGREGAR
									<span class='flaticon-correct icon-ag icon-button'></span>
								</button>";
						}
						print($button);
						$button = "";
					?>
					<?php 
						if ($valor[0] == 2 || $valor[0] == 3 || $valor[0] == 6 || $valor[0] == 7) {
							$button = "
							<button class='btn btn-ed btn-scrud col-lg-3 col-md-3 col-sm-3 disabled' disabled=''>
								EDITAR
								<span class='flaticon-new-file icon-button icon-ed'></span>
							</button>";
							
						}
						print($button);
						$button = "";
					?>
					<?php 
						if ($valor[0] == 1 || $valor[0] == 3 || $valor[0] == 5 || $valor[0] == 7) {
							$button = 
							"<button class='btn btn-el btn-scrud col-lg-3 col-md-3 col-sm-3 disabled' disabled=''>
								ELIMINAR
								<span class='flaticon-cancel icon-button icon-el'></span>
							</button>";
						}
						print($button);
						$button = "";
					?>
					<?php 
						if ($valor[0] > 0) {
							$button = 
							"<button class='btn btn-nv btn-scrud col-lg-2 col-md-2 col-sm-2'>
								LIMPIAR
								<span class='flaticon-circular-arrow icon-button icon-nv'></span>
							</button>";
						}
						print($button);
						$button = "";
					?>
				</div>
			</div>
		</div>
	</div>
	<br>
	<br>
	<div class="container-fluid">
		<div class="row">
		<div class="col-lg-12">
			<label for="" class="labels">Buscar</label>
            <input type="text" class="form-control" id="buscar" autocomplete='off'>
            <br>
		</div>
		<div class="col-lg-12" id="tabla_div">
		<?php 
				$tabla = 
				"<table class='table-bk'>" .
					"<tr class='tb-heading'>".
						"<th><strong>#</strong></th>".
						"<th><strong>Nombre</strong></th>".
						"<th><strong>Tipo de Producto</strong></th>".
						"<th><strong></strong></th>".
					"</tr>";
			$sql = "SELECT id_producto,nombre_producto, TP.nombre_tipo_producto FROM productos P, tipos_producto TP WHERE estado_producto = ? AND P.id_tipo_producto = TP.id_tipo_producto";
				$stmt = $con->prepare($sql);
			    $stmt->execute(array(1));
			    $i = 1;
				while ($datos = $stmt->fetch(PDO::FETCH_BOTH)) {
				$tabla .= 
					"<tr>".
						"<td>$i</td>".
						"<td>$datos[1]</td>".
						"<td>$datos[2]</td>".
						"<td>".
							"<button class='btn-table' onclick='seleccionar_producto($datos[0])'>".
								"SELECCIONAR".
								"<span class='flaticon-loupe'></span>".
							"</button>".
						"</td>".
					"</tr>";
					$i = $i + 1;
				}
				$tabla .= "</table>";
				print($tabla);
			?>
		</div>
	</div>
	</div>
	<?php include 'scripts.php';?>
</body>
</html>