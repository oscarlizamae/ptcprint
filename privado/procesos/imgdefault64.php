<?php
	//$imagen_temporal = $_POST['default'];
	$imagen_temporal = '../img/default.jpg';
	$fp = fopen($imagen_temporal, 'r+b');
	$data = fread($fp, filesize($imagen_temporal));
	$final = base64_encode($data);
	fclose($fp);
    echo json_encode($final);
?>