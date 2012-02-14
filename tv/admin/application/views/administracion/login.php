<?php
$email = array(
    'name' => 'email',
    'id' => 'email',
    'value' => set_value('email'),
    'class' => 'form-login',
    'size' => '30'
);
$password = array(
    'name' => 'contrasena',
    'id' => 'contrasena',
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
                Acceder a la administración del sitio de <?php echo anchor('administracion/ir_a_tienda', 'Comercial Franklin', 'class="enlace_normal" target="_blank"'); ?>
                <?php
                $atributos = array('id' => 'formulario_login');
                echo form_open('administracion/verificar_login', $atributos);
                ?>
                <div id="login-box-name" style="margin-top:20px;">
                    Email:
                </div>
                <div id="login-box-field" style="margin-top:20px;">
                    <?= form_input($email); ?>
                </div>
                <div id="login-box-name">
                    Contraseña:
                </div>
                <div id="login-box-field">
                    <?= form_password($password); ?>
                </div>
                <br />
                <span class="login-box-options">
                    <input type="checkbox" name="1" value="1"> 
                        Recordame 
                        <?php echo anchor('administracion/recuperar_password', 'Olvidó su Contraseña?', 'style="margin-left:30px;"'); ?>
                </span>
                <br />
                <br />
                <div id="posicion_boton_login">
                    <input class="boton_login" type="submit" name="enviar_datos" value="Entrar"/>
                </div>
                <?php echo form_close(); ?>
                <div>
                <?= validation_errors() ?>
                </div>
                <?php
                if (isset($Mensaje_Login)) {
                    echo '<div id="formato_de_error">';
                    echo $Mensaje_Login;
                    echo '</div>';
                    unset($Mensaje_Login);
                }
                if (isset($Mensaje_Recuperar_Password)) {
                    if (!empty($Mensaje_Recuperar_Password)) {
                        echo '<div class="formato_de_exito">';
                        echo $Mensaje_Recuperar_Password;
                        echo '</div>';
                    } else {
                        echo '<div id="formato_de_error">';
                        echo 'No se pudo enviar el email, intentelo de nuevo!';
                        echo '</div>';
                    }
                    unset($Mensaje_Recuperar_Password);
                }
                if (isset($Mensaje_Actulizar_Password)) {
                    echo '<div id="formato_de_error">';
                    echo $Mensaje_Actulizar_Password;
                    echo '</div>';
                    unset($Mensaje_Actulizar_Password);
                }
                if (isset($Mensaje_Password_Actualizado)) {
                    if (!empty($Mensaje_Password_Actualizado)) {
                        echo '<div class="formato_de_exito">';
                        echo $Mensaje_Password_Actualizado;
                        echo '</div>';
                    } else {
                        echo '<div id="formato_de_error">';
                        echo 'No se pudo actualizar su contraseña, intentelo de nuevo!';
                        echo '</div>';
                    }
                    unset($Mensaje_Password_Actualizado);
                }
                ?>
            </div>
        </div>
    </body>
</html>