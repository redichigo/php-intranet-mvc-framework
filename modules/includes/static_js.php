<?php

// PROTECCION DE ACCESO AL FICHERO
defined("ACCESS_SUCCESS") or header("Location: ../../error-403");

?>

<!-- JQUERY -->
<script src="<?php echo JQUERY_PATH; ?>"></script>
<script src="<?php echo JQUERY_UI_JS_PATH; ?>"></script>

<!-- POPPERJS -->
<script src="<?php echo POPPER_PATH; ?>"></script>

<!-- BOOTSTRAP -->
<script src="<?php echo BOOTSTRAP_JS_PATH; ?>"></script>

<!-- DATATABLE -->
<script src="<?php echo DATATABLE_JS_PATH; ?>"></script>
<script src="<?php echo DATATABLE_RESPONSIVE_JS_PATH; ?>"></script>

<!-- CHARTJS -->
<script src="<?php echo CHARTJS_JS_PATH; ?>"></script>
<script src="<?php echo CHARTJS_JS_DATALABEL_PATH; ?>"></script>

<!-- FUNCIONES JS -->
<?php include "config/functions_js.php"; ?>

<!-- JS GLOBAL APP -->
<?php include "assets/js/js_global.php"; ?>