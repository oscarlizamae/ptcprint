<?php 
  include '../privado/procesos/conexion.php';
?>
<html>
	<head>

        <title>Publicidad | Punto Print</title>
		<?php include 'links.php' ?>
	</head>
	<body>
		<?php include 'menu.php' ?>
    <br>
    <div>
        <div class="container-fluid div_conteni">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">TARJETAS</a></li>
            </ul>
            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <div class="uk-grid">
                        <div class="uk-width-1-1 uk-flex uk-flex-center publicidad-header">
                            <h2 class="titulos">Tarjetas personalizadas</h2>
                        </div>
                    </div>
                    <!--CONTENEDOR DE LA INFORMACION-->
                    <br>
                    <?php 
                        $id_max = "";
                        $descripcion = "";
                        $foto_producto = "";
                        $calificacion_promedio = "";
                        $maximo = "SELECT p.id_producto FROM productos p WHERE p.id_tipo_producto=5 AND p.calificacion_promedio = (SELECT MAX(p.calificacion_promedio) FROM productos) LIMIT 1";
                        foreach ($con->query($maximo) as $maximo) {
                          $id_max = $maximo[0];
                        }
                        $producto = "SELECT p.nombre_producto, p.descripcion_producto, p.calificacion_promedio,f.foto_producto FROM productos p INNER JOIN fotos_productos f ON f.id_producto = p.id_producto WHERE p.id_producto=$id_max";
                        foreach ($con->query($producto) as $productoa) {
                          $descripcion = $productoa[1];
                          $calificacion_promedio = $productoa[2];
                          $foto_producto = $productoa[3];
                        }
                        $divin = "";
                        $divin .= "<div class='container-fluid'>";
                          $divin .= "<div class='container-fluid'>";
                            $divin .= "<div class='uk-grid row'>";
                            $divin .= "<p id='idcl' class='hide'>$id_cl</p>";
                              $divin .= "<div class='uk-width-small-5-10 uk-width-medium-4-10 uk-width-large-3-10'>";
                                $divin .= "<img src='data:image/*;base64,$foto_producto' alt=''>";
                                $divin .= "<a href='src='data:image/*;base64,$foto_producto' data-uk-lightbox='' class='uk-button uk-button-link uk-button-large uk-flex uk-flex-center'>VER EJEMPLO</a>";
                              $divin .= "</div>";
                              //AQUI ESTA LA INFORMACION DEL PRODUCTO
                              $divin .= "<div class='uk-width-small-5-10 uk-width-medium-6-10 uk-width-large-7-10'>";
                                $divin .= "<div class='uk-grid'>";
                                  $divin .= "<div class='uk-width-small-1-1 uk-width-medium-5-10 uk-width-large-4-10'>";
                                    $divin .= "<p>Medida:</p>";
                                      $divin .= "<form class='uk-form' id='medidassl'>";
                                        $medidas = "SELECT m.medida FROM medidas_producto m INNER JOIN productos p ON m.id_producto = p.id_producto WHERE p.id_producto=$id_max";
                                        foreach ($con->query($medidas) as $medidasa) {
                                        $divin .= "<input type='radio' id='form-s-r' name='radio'><label for='form-s-r'>$medidasa[0]</label><br>";
                                        }
                                      $divin .= "</form>";
                                      $divin .= "<div class='uk-width-small-1-1 uk-width-medium-5-10 uk-width-large-4-10'>";
                                        $divin .= "<p>Cantidad:</p>";
                                        $divin .= "<select class='form-control' placeholder='Cantidad' id='cantidad'>";
                                            $divin .= "<option>1</option>";
                                            $divin .= "<option>2</option>";
                                            $divin .= "<option>3</option>";
                                            $divin .= "<option>4</option>";
                                            $divin .= "<option>103</option>";
                                        $divin .= "</select>";
                                      $divin .= "</div>";
                                    $divin .= "</div>";
                                    $divin .=  "<div class='uk-hidden-small uk-width-medium-5-10 uk-width-large-5-10'>";
                                      $divin .= "<p>DESCRIPCION:</p>";
                                      $divin .= "<p id='descripcion'>$productoa[1]</p>";
                                      $divin .= "<p class='uk-hidden-medium uk-hidden-small'>Puntuación:</p>";
                                      $divin .= "<div class='stars'>";
                                        if ($calificacion_promedio < 1) {
                                          for ($i=1; $i <=5 ; $i++) {
                                            $divin .= "<span class='uk-icon-star uk-icon-small uk-hidden-medium uk-hidden-small puntuar'></span>";
                                          }
                                        }
                                        if ($calificacion_promedio >= 1 && $calificacion_promedio < 2) {
                                          $divin .= "<span class='uk-icon-star uk-icon-small uk-hidden-medium uk-hidden-small puntuar'></span>";
                                          for ($i=1; $i <=4 ; $i++) {
                                            $divin .= "<span class='uk-icon-star uk-icon-small uk-hidden-medium uk-hidden-small puntuar'></span>";
                                          }
                                        }
                                        if ($calificacion_promedio >= 2 && $calificacion_promedio < 3) {
                                          for ($i=1; $i <=2 ; $i++) { 
                                            $divin .= "<span class='uk-icon-star uk-icon-small uk-hidden-medium uk-hidden-small puntuar'></span>";
                                          }
                                          for ($i=1; $i <=3 ; $i++) {
                                            $divin .= "<span class='uk-icon-star uk-icon-small uk-hidden-medium uk-hidden-small puntuar'></span>";
                                          }
                                        }
                                        if ($calificacion_promedio >= 3 && $calificacion_promedio < 4) {
                                          for ($i=1; $i <=3 ; $i++) { 
                                            $divin .= "<span class='uk-icon-star uk-icon-small uk-hidden-medium uk-hidden-small puntuar'></span>";
                                          }
                                          for ($i=1; $i <=2 ; $i++) {
                                            $divin .= "<span class='uk-icon-star uk-icon-small uk-hidden-medium uk-hidden-small puntuar'></span>";
                                          }
                                        }
                                        if ($calificacion_promedio >= 4 && $calificacion_promedio < 5) {
                                          for ($i=1; $i <=4 ; $i++) { 
                                            $divin .= "<span class='uk-icon-star uk-icon-small uk-hidden-medium uk-hidden-small puntuar'></span>";
                                          }
                                          for ($i=1; $i <=1 ; $i++) {
                                            $divin .= "<span class='uk-icon-star uk-icon-small uk-hidden-medium uk-hidden-small puntuar'></span>";
                                          }
                                        }
                                        if ($calificacion_promedio == 5) {
                                          for ($i=1; $i <=5 ; $i++) { 
                                            $divin .= "<span class='uk-icon-star uk-icon-small uk-hidden-medium uk-hidden-small puntuar'></span>";
                                          }
                                        }
                                    $divin .= "</div>";
                                  print($divin);
                                  ?>
                                        <br>
                                        <br>
                                        <!--SECCION DE COMENTARIOS-->
                                        <p class=" uk-hidden-small uk-hidden-medium">Mi comentario:</p>
                                        <form class="uk-form uk-hidden-small uk-hidden-medium">
                                          <div class="uk-form-row">
                                            <textarea cols="40" rows="3" placeholder="Danos tu opinón" class="uk-hidden-large"></textarea>
                                            <textarea cols="75" rows="3" placeholder="Danos tu opinón" class="uk-hidden-medium uk-hidden-small"></textarea>
                                            <br>
                                            <br>
                                            <button class="btn btn-default uk-width-4-10 uk-push-6-10">PUNTUAR</button>
                                          </div>
                                        </form>
                                    </div>
                                </div>
                                <br>
                                <!--BOTONES-->
                                <div class="uk-grid">
                                  <div class="uk-width-1-1">
                                      <div class="uk-grid">
                                          <button class="btn btn-primary uk-width-small-5-10 uk-width-medium-3-10 uk-width-large-5-10 btn-sb-xs"onclick="window.location.href='cotizarcliente.php'">CARGAR</button>
                                          <button class="btn btn-success uk-width-small-4-10 uk-width-medium-3-10 uk-width-large-4-10 btn-sb-xs"id="btn-el">ELEGIR DISEÑO</button>
                                          <button class="btn btn-default uk-width-small-9-10 uk-width-medium-3-10 btn-sb-xs uk-hidden-large">PUNTUAR</button>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="container-fluid" id="elegir_div">
                      <div class="row">
                        <div class="panel panel-default">
                          <div class="panel-heading">
                            <div class="row">
                              <div class="col-lg-11 text-center">
                                <h4>¡ELIGE TU DISEÑO!</h4>
                              </div>
                              <div class="col-lg-1 col-md-4 col-sm-4 col-xs-4">
                                <button class="btn btn-default btn-small" id="btn-crrel">Cerrar</button>
                              </div>
                            </div>
                          </div>
                          <div class="panel-body">
                            <?php 
                              $row = 1;
                              $divoep = "";
                              $sqlep = "SELECT DISTINCT productos.id_producto,foto_producto,nombre_producto FROM ((productos INNER JOIN tipos_producto ON productos.id_tipo_producto = tipos_producto.id_tipo_producto) INNER JOIN fotos_productos ON fotos_productos.id_producto = productos.id_producto) INNER JOIN medidas_producto ON medidas_producto.id_producto = productos.id_producto WHERE productos.id_tipo_producto=5 AND estado_producto=1 AND estado_foto_producto=1";
                                foreach ($con->query($sqlep) as $datos) {
                                  $divoep .= "<div class='col-lg-3 col-md-4 col-sm-6 col-xs-12 imagenesael' id='imagenel".$datos[0]."'>";
                                    $divoep .= "<a href='javascript:elegido($datos[0])'><img src='data:image/*;base64,$datos[1]' class='img-responsive' id='img$datos[0]'></a>";
                                  $divoep .= "</div>";
                                }
                                print($divoep);
                            ?>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <div class="uk-width-1-1 uk-text-center">
            <div id="productos-solicitados">
                <br>
                <p class="productos-titulo">
                    <h2 class="titulos uk-hidden-small">NUESTROS PRODUCTOS</h2>
                    <h3 class="titulos uk-hidden-large uk-hidden-medium">NUESTROS PRODUCTOS</h3>
                </p>
                <br>
                <br>
            </div>
        <?php 
        $slidenavb = "";
        $slidenavb .= "<div class='uk-slidenav-position' data-uk-slider>";
          $slidenavb .= "<div class='uk-slider-container'>";
            $slidenavb .= "<ul class='uk-slider uk-grid-small uk-grid-width-small-1-2 uk-grid-width-medium-1-4 uk-grid-width-large-1-4'>";
                $sql = "SELECT productos.id_producto,foto_producto,nombre_producto FROM (productos INNER JOIN tipos_producto ON productos.id_tipo_producto = tipos_producto.id_tipo_producto) INNER JOIN fotos_productos ON fotos_productos.id_producto = productos.id_producto WHERE productos.id_tipo_producto=5 AND estado_producto=1";
                foreach ($con->query($sql) as $datos) {
                    $slidenavb .= "<a href='#'><li><img src='data:image/*;base64,$datos[1]' alt='$datos[2]'></li></a>";
                }
              $slidenavb .= "</ul>";
            $slidenavb .= "</div>";
          $slidenavb .= "<a href='#' class='uk-slidenav uk-slidenav-contrast uk-slidenav-previous' data-uk-slider-item='previous'></a>";
          $slidenavb .= "<a href='#' class='uk-slidenav uk-slidenav-contrast uk-slidenav-next' data-uk-slider-item='next'></a>";
        $slidenavb .= "</div>";
        $con = null;
        print($slidenavb);
      ?>
    </div>
    <?php include 'footer.php' ?>
    <?php include 'scripts.php' ?>
</body>
</html>
                    
