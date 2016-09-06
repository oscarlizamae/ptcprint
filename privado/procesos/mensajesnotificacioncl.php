<?php 
	$id = $_POST['id'];
	$pasado = $_POST['pasado'];
	$anterior = $_POST['anterior'];
	///$pasado = 0;
	include 'conexion.php';
	$msj_anteriores = $anterior;
	$msj_nuevo = 0;
	$respuestas = array();
	$respuesta = 0;
	$sql = "SELECT COUNT(id_mensaje) FROM mensajes m, conversaciones c WHERE m.emisor=1 AND c.id_cliente = ?";
	//echo $sql;
	$stmt = $con->prepare($sql);
	$stmt->execute(array($id));
	while ($data = $stmt->fetch(PDO::FETCH_BOTH)) {
		if ($pasado == 0) {
			$msj_anteriores = $data[0];
			$msj_nuevo = $data[0];
		}else{
			$msj_nuevo = $data[0];
		}
	}
	if($msj_nuevo > $msj_anteriores){
		$msj_anteriores = $msj_nuevo;
		$respuesta = 1;
	}
	array_push($respuestas, $respuesta, $msj_anteriores);
	echo json_encode($respuestas);
?>