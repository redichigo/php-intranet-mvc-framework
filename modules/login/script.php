<script>
    $(document).ready(function() {

        // FOCO EN EL IDENTIFICADOR
        $('#identificador_login').focus();

        // CLICK EN ACCEDER CON ENTER
        $(document).keypress(function(event) {
            if (event.which == 13) {
                $("#btn_acceder").click();
            }
        });

        // --------------------------------------------------------------------------------------------------------------
        // ACCEDER
        // -------------------------------------------------------------------------------------------------------------- 
        $('#btn_acceder').on('click', function() {

            var identificador_login = $('#identificador_login').val();
            var pass = $('#pass').val();

            if (identificador_login === '' || pass === '') {
                $('#info_login').text("Tiene que rellenar IDENTIFICADOR y PASSWORD.")
            } else {

                $.ajax({
                    data: {
                        'identificador_login': identificador_login,
                        'pass': pass
                    },
                    url: '<?php echo CURRENT_MODULE ?>login',
                    type: 'POST',
                    beforeSend: function() {
						console.log(this.url)
                    },
                    success: function(data) {

                        data = JSON.parse(data);
                        console.log(data);

                        if (data === 'error_sql') {
                            $('#info_login').text("Ha ocurrido un error, contacta con el responsable.")
                        } else if (data === 'sin_acceso') {
                            $('#info_login').text("No tienes acceso a la web, contacta con el responsable.")
                        } else if (data === 'sin_roles') {
                            $('#info_login').text("No tienes permisos asignados, contacta con el responsable.")
                        } else if (data === 'error_token') {
                            $('#info_login').text("Hayn un error de seguridad, consulte al responsable.")
                        } else {
                            // REDIRIJO AL AREA PRIVADA
                            window.location.href = 'panel_de_administracion';
			
                        }

                    }
                });

            }

        });

    });
</script>