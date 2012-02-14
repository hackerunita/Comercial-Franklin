<!-- contenido columna central -->
<div id="columna_central" class="grid_8 alpha">
    <div id="barra_navegacion" class="grid_1 alpha">
        <div id="principal" class="grid_1 alpha">
            <?php echo $titulo; ?>
        </div>
    </div>

    <div id="datosColumnaCentral" class="grid_8 alpha">
        <h1>¡Recibimos Su Consulta!</h1>
        <div class="grid_7 alpha">
            Comercial Franklin ha recibido sus inquietudes a traves de un e-mail que a su vez le fue enviado a su cuenta de correo registrada en nuestro sistema de tienda virtual.
        </div>
        <div class="grid_7 alpha">
            <br>Un asesor de servicio al cliente se pondrá en contacto con usted para conversar mas detalladamente acerca del asunto de su e-mail.
        </div>
        <div id="continuar_orden" class="grid_7 alpha">
            <?php
            echo anchor(base_url(),'Continuar', 'class="enlaces_generales"');
            ?>
        </div>
        <div class="grid_7 alpha" id="gracias_por_su_compra">
            ¡Gracias Por Ponerse En Contacto Con Nosotros!
        </div>
    </div>
</div>
