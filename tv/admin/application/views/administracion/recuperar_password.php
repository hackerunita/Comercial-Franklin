<?php
$email = array(
    'name' => 'email',
    'id' => 'email',
    'value' => set_value('email'),
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
                Por favor, escriba su correo electrónico. Recibirá un enlace para crear la nueva contraseña por correo electrónico.
                <?php
                $atributos = array('id' => 'formulario_recuperar_password');
                echo form_open('administracion/recuperarPassword', $atributos);
                ?>
                <div id="login-box-name" style="margin-top:30px;">
                    Email:
                </div>
                <div id="login-box-field" style="margin-top:30px;">
                    <?= form_input($email); ?>
                </div>
                <br />
                <span class="login-box-options">
                    <?php echo anchor('administracion/loguearse', 'Acceso al Sistema', 'style="margin-left:120px;"'); ?>
                </span>
                <br />
                <br />
                <div id="posicion_boton_login">
                    <input class="boton_login" type="submit" name="enviar_datos" value="Enviar"/>
                </div>
                <?php echo form_close(); ?>
                <div>
                <?= validation_errors() ?>
                </div>
                <?php
                if (isset($Mensaje_Recuperar_Password)) {
                    echo '<div id="formato_de_error">';
                    echo $Mensaje_Recuperar_Password;
                    echo '</div>';
                    unset($Mensaje_Recuperar_Password);
                }
                ?>
            </div>
        </div>
    </body>
</html>