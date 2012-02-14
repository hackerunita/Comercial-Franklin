<!-- contenido columna central -->
<div id="columna_central" class="grid_8 alpha">
    <div id="barra_navegacion" class="grid_1 alpha">
        <?php
        $imagen_aviso = array(
                    'src' => base_url().'/PlantillaComfranklin/iconos/Edit_Yes.png',
                    'class' => 'imagen_miniatura',
            );
        ?>
        <div id="principal" class="grid_1 alpha">
            <?= img($imagen_aviso).'';?>&nbsp;&nbsp;&nbsp;<?php echo $titulo; ?>
        </div>
    </div>

    <div id="datosColumnaCentral" class="grid_7 alpha">
        <?php
        $imagen_aviso = array(
            'src' => base_url().'/PlantillaComfranklin/iconos/Edit_Yes.png',
            'class' => 'imagen_mediana_icono',
        );
        ?>
        <h1>Aviso Legal&nbsp;&nbsp;&nbsp;<?= img($imagen_aviso);?></h1>
        <strong>Propiedad intelectual de la web:</strong>
        <p>
            Todos los derechos de propiedad intelectual del contenido de esta página web, su diseño gráfico y sus códigos fuente, son titularidad exclusiva de Comercial Franklin, correspondiéndonos el ejercicio exclusivo de los derechos de explotación de los mismos.
            Por tanto queda prohibida su reproducción, distribución, comunicación pública y transformación, total o parcial, sin la autorización expresa de la Ing. Sandra Suntaxi. Igualmente, todos los nombres comerciales, marcas o signos distintos de cualquier clase contenidos en este sitio Web están protegidos por ley.
        </p>
        <strong>Contenido de la web y enlaces:</strong>
        <p>
            Comercial Franklin no se responsabiliza del mal uso que se realice de los contenidos de nuestra página web, siendo exclusiva responsabilidad de la persona que accede a ellos o los utiliza.
            Tampoco asume ninguna responsabilidad por la información contenida en las páginas web de terceros a las que se pueda acceder por enlaces o buscadores desde la página web comercialfranklin.com.
        </p>
        <strong>Actualización y modificación de la página web:</strong>
        <p>
            Comercialfranklin.com se reserva el derecho a actualizar, modificar o eliminar la información contenida en su sitio Web, y la configuración o presentación del mismo, en cualquier momento, sin previo aviso, y sin asumir responsabilidad alguna por ello.
        </p>
    </div>
</div>