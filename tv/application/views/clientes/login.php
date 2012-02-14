<?php
$email = array(
    'name' => 'email_login',
    'id' => 'email_login',
    'value' => set_value('email_login')
);
$clave = array(
    'name' => 'clave',
    'id' => 'clave',
    'value' => '',
);
$dataEnviar = array(
    'name' => 'submit_login',
    'id' => 'submit_login',
    'value' => 'Entrar',
);
?>
<?php $this->form_validation->set_error_delimiters('<div class="formato_de_error">', '</div>'); ?>
<!-- contenido columna central -->
<div id="columna_central" class="grid_8 alpha">
    <div id="barra_navegacion" class="grid_1 alpha">
        <?php
        $imagen_login = array(
            'src' => base_url().'/PlantillaComfranklin/iconos/User.png',
            'class' => 'imagen_miniatura',
        );
        ?>
        <div id="principal" class="grid_1 alpha">
            <?= img($imagen_login).'';?>&nbsp;&nbsp;&nbsp;Login
        </div>
    </div>

    <div id="datosColumnaCentral" class="grid_8 alpha">
        <h1>Dejame Entrar</h1>
        <?= validation_errors() ?>
        <?php
        if (isset($mensaje_crear_cuenta)) {
            if ($mensaje_crear_cuenta != '') {
                echo '<div class="formato_de_exito">';
                echo $mensaje_crear_cuenta;
                echo '</div>';
            }
            unset($mensaje_crear_cuenta);
        }
        if (isset($mensaje_confirmar_registro)) {
            if ($mensaje_confirmar_registro == 'Su cuenta fue activada satisfactoriamente!') {
                echo '<div class="formato_de_exito">';
                echo $mensaje_confirmar_registro;
                echo '</div>';
            } else {
                echo '<div class="formato_de_error">';
                echo $mensaje_confirmar_registro;
                echo '</div>';
            }
            unset($mensaje_confirmar_registro);
        }
        if (isset($mensaje_confirmar_acceso)) {
            if ($mensaje_confirmar_acceso != '') {
                echo '<div class="formato_de_error">';
                echo $mensaje_confirmar_acceso;
                echo '</div>';
            }
            unset($mensaje_confirmar_acceso);
        }
        if (isset($mensaje_recuperar_password)) {
            if ($mensaje_recuperar_password == 'Se ha enviado un e-mail con su nueva contraseña, revise su buzon!') {
                echo '<div class="formato_de_exito">';
                echo $mensaje_recuperar_password;
                echo '</div>';
            } else {
                echo '<div class="formato_de_error">';
                echo $mensaje_recuperar_password;
                echo '</div>';
            }
            unset($mensaje_recuperar_password);
        }
        ?>
        <div id="bloque_cree_su_cuenta" class="grid_4">
            <?php
            $imagen_icono = array(
                'src' => base_url() . '/PlantillaComfranklin/iconos/User_add.png',
                'class' => 'imagen_mediana_icono',
            );
            ?>
            <p class="titilo_acceso">Nuevo Cliente</p>
            <p>
                Soy un nuevo cliente.&nbsp;&nbsp;&nbsp;<?= img($imagen_icono);?>
            </p>
            <p>
                Al crear una cuenta en Comercial Franklin usted podrá realizar sus compras rápidamente, estar al día en el estado de sus pedidos, y realizar un seguimiento de los pedidos que ha hecho anteriormente. 
            </p>
            <?php
            $imagen_propiedades = array(
                'src' => base_url() . '/PlantillaComfranklin/iconos/User_add.png',
                'class' => 'imagen_miniatura',
            );
            echo img($imagen_propiedades);
            ?>
            <?= anchor('clientes/registrarse', 'Crear nueva cuenta', 'class="enlaces_generales"'); ?>
        </div>

        <?php
        $atributos = array('id' => 'formulario_login');
        echo form_open('clientes/verificar_login', $atributos);
        ?>
        <?php
        //esto es para ver si comienza el proceso de pedido
        if (isset($mensajePedidos)) {
            echo form_hidden('comenzar_pedido', '1');
            unset($mensajePedidos);
        }
        ?>
        <p class="titilo_acceso">Soy Cliente</p>
        <p>
            Soy un cliente que vuelve.
        </p>
        <p class="label_formulario">
            Correo electronico:
            <?= form_input($email); ?>
            Contraseña:
            <?= form_password($clave); ?>
            <input class="boton_entrar" type="submit" name="entrar" value="">
        </p>
        
        <?php echo form_close(); ?>
        <?php
        $imagen_propiedades = array(
            'src' => base_url() . '/PlantillaComfranklin/iconos/Unlock.png',
            'class' => 'imagen_miniatura',
        );
        echo img($imagen_propiedades);
        ?>
        <?= anchor('clientes/recuperar_password', '¿Olvido su contraseña?', 'class="enlaces_generales"'); ?>
    </div>
</div>
