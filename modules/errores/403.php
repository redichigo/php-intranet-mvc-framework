<?php 

// PROTECCION DE ACCESO AL FICHERO
defined("ACCESS_SUCCESS") or header("Location: ../../error-403");

?>

<!DOCTYPE html>
<html lang="es">
    <head>

        <meta charset="UTF-8" />

        <!-- TITULO DEL PROYECTO -->
        <title><?php echo PROJECT_NAME; ?></title>

        <!-- CSS ESTATICOS (BOOSTRAP, FONTAWESOME, APP...) -->
        <?php include STATIC_CSS; ?>

        <!-- JS ESTATICOS (JQUERY, BOOSTRAP, APP...) -->
        <?php include STATIC_JS; ?>

    </head>

    <body>

        <div class="container-fluid">

            <br>

    		<div class="text-center">
    			<img src="<?php echo IMG_PATH . '403.png' ?>" class="text-center">
    		</div>

    		<br>

    		<h1 style="text-align: center;">NO TIENE PERMISO DE EJECUCION</h1>
	   </div>
	
    </body>
	
</html>