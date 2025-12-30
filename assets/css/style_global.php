<style>
    /* --------------------------------------------------------------------------------------------------------------
    ESTILOS GLOBALES
    -------------------------------------------------------------------------------------------------------------- */
    * {
        box-shadow: none !important;
        border-color: #ced4da !important;
    }

    html,
    body {
        font-size: 0.85rem;
        font: normal normal normal 14px / 22px "Arial", Helvetica, Arial, Verdana, sans-serif;
        word-spacing: normal;
        border-radius: 0 !important;
        background-color: #ffffff;
        background-image: url('assets/img/ag-square.png');
        background-repeat: repeat;
    }

    /* --------------------------------------------------------------------------------------------------------------
    LOADER
    -------------------------------------------------------------------------------------------------------------- */
    .loader_ajax {
        background: url('<?php echo IMG_PATH ?>load.gif') 50% 50% no-repeat rgba(0, 0, 0, 0.5);
        height: 100%;
        left: 0;
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 9998;
    }
</style>