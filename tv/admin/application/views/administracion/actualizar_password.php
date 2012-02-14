<?php
$password_actualizar = array(
    'name' => 'contrasena_actualizar',
    'id' => 'contrasena_actualizar',
    'value' => '',
    'class' => 'form-login',
    'size' => '30'
);
$password_actualizar_repetir = array(
    'name' => 'contrasena_actualizar_repetir',
    'id' => 'contrasena_actualizar_repetir',
    'value' => '',
    'class' => 'form-login',
    'size' => '30'
);
?>
<?php $this->form_validation->set_error_delimiters('<div id="formato_de_error">', '</div>'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo $titulo; ?></title>
        <link rel="shortcut icon" href="<?php echo base_url() ?>PlantillaAdmin/img/favicon.ico" />
        <link href="<?php echo base_url() ?>PlantillaLogin/login-box.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div style="padding: 100px 375px 0px 380px;">
            <div id="login-box">
                <h2>Comercial Franklin</h2>
                Cambiando la contraseña de: <?php echo $email_cambiar; ?>
                <?php
                $atributos = array('id' => 'formulario_actualizar_password');
                echo form_open('administracion/actualizarPassword', $atributos);
                ?>
                <div id="login-box-name" style="margin-top:20px;">
                    Contraseña:
                </div>
                <div id="login-box-field" style="margin-top:20px;">
                    <?= form_password($password_actualizar); ?>
                </div>
                <div id="login-box-name" style="margin-top:5px;">
                    Repita Contraseña:
                </div>
                <div id="login-box-field" style="margin-top:10px;">
                    <?= form_password($password_actualizar_repetir); ?>
                </div>
                <br />
                <span class="login-box-options">
                        <?php echo anchor('administracion/loguearse', 'Acceso al Sistema', 'style="margin-left:128px;"'); ?>
                </span>
                <br />
                <br />
                <div id="posicion_boton_login">
                    <input class="boton_login" type="submit" name="enviar_datos" value="Cambiar"/>
                </div>
                <?php
                if (isset($email_cambiar)) {
                    echo form_hidden('email_actual', $email_cambiar);
                    unset($email_cambiar);
                }
                if (isset($codigo)) {
                    echo form_hidden('codigo_actual', $codigo);
                    unset($codigo);
                }
                ?>
                <?php echo form_close(); ?>
                <div>
                <?= validation_errors() ?>
                </div>
            </div>
        </div>
    </body>
</html>