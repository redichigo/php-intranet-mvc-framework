<?php

// PROTECCION DE ACCESO AL FICHERO
defined("ACCESS_SUCCESS") or header("Location: ../../error-403");

?>

<!-- JQUERY -->
<link rel="stylesheet" href="<?php echo JQUERY_UI_CSS_PATH; ?>">

<!-- BOOTSTRAP -->
<link rel="stylesheet" href="<?php echo BOOTSTRAP_CSS_PATH; ?>">

<!-- DATATABLE -->
<link rel="stylesheet" href="<?php echo DATATABLE_CSS_PATH; ?>">
<link rel="stylesheet" href="<?php echo DATATABLE_RESPONSIVE_CSS_PATH; ?>">

<!-- FONTAWESOME -->
<link rel="stylesheet" href="<?php echo FONTAWESOME_CSS_PATH; ?>">

<!-- CSS GLOBAL -->
<?php include "assets/css/style_global.php"; ?>