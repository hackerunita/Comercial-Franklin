<!--script para llenar combo de ciudad / parroquia-->
<script src="<?php echo base_url(); ?>js/jquery.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function(){
        $("#ciudad").change(function(){
            $.post("<?php echo base_url() ?>clientes/cargandoComboParroquia",{ id:$(this).val() },function(data){$("#parroquia").html(data);})
        });
    })
</script>
<!--fin de script para llenar combo de ciudad / parroquia-->
<!--script para el calendario-->
<script src="<?php echo base_url(); ?>Calendario/jscal2.js"></script>
<script src="<?php echo base_url(); ?>Calendario/es.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>Calendario/jscal2.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>Calendario/border-radius.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>Calendario/steel/steel.css" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>Calendario/reduce-spacing.css" /> 
<!--fin de script para el calendario-->
<?php
$atributos = array('id' => 'registro_usuarios');
echo form_open('clientes/crearCuenta', $atributos);
$nombres = array(
    'name' => 'nombres',
    'id' => 'nombres',
    'value' => set_value('nombres')
);
$apellidos = array(
    'name' => 'apellidos',
    'id' => 'apellidos',
    'value' => set_value('apellidos')
);
$fecha_nacimiento = array(
    'name' => 'fecha_nacimiento',
    'id' => 'fecha_nacimiento',
    'value' => set_value('fecha_nacimiento')
);
$direccion = array(
    'name' => 'direccion',
    'id' => 'direccion',
    'value' => set_value('direccion'),
    'rows' => '5',
    'cols' => '21'
);
$telefono_fijo = array(
    'name' => 'telefono_fijo',
    'id' => 'telefono_fijo',
    'value' => set_value('telefono_fijo')
);
$telefono_movil = array(
    'name' => 'telefono_movil',
    'id' => 'telefono_movil',
    'value' => set_value('telefono_movil')
);
$email = array(
    'name' => 'email',
    'id' => 'email',
    'value' => set_value('email')
);
$password = array(
    'name' => 'password',
    'id' => 'password',
    'value' => ''
);
$re_password = array(
    'name' => 're_password',
    'id' => 're_password',
    'value' => ''
);
?>
<?php $this->form_validation->set_error_delimiters('<div class="formato_de_error">', '</div>'); ?>
<!-- contenido columna central -->
<div id="columna_central" class="grid_8 alpha">
    <div id="barra_navegacion" class="grid_1 alpha">
        <?php
        $imagen_registro = array(
            'src' => base_url().'/PlantillaComfranklin/iconos/User_add.png',
            'class' => 'imagen_miniatura',
        );
        ?>
        <div id="principal" class="grid_1 alpha">
            <?= img($imagen_registro).'';?>&nbsp;&nbsp;&nbsp;Registro de clientes
        </div>
    </div>

    <div id="datosColumnaCentral" class="grid_7 alpha">
        <h1>Mi Informacion</h1>
        <div id="contenido_formulario_registro">
            <span><font color="red"><b>Nota:</b></font> Si usted ya dispone de una cuenta dirigase a este enlace:</span>
        <?php
        $imagen_sistema = array(
            'src' => base_url().'/PlantillaComfranklin/iconos/User.png',
            'class' => 'imagen_miniatura',
        );
        ?>
        <?= img($imagen_sistema).'';?>
        <?= anchor('clientes/login', 'Entrar al Sistema', 'class="enlaces_generales"'); ?>
        </div>
        <?= validation_errors() ?>

        <div id="titulo_registrar_clientes" class="grid_3 alpha suffix_2">
            Sus Datos Personales:
        </div>
        <div class="grid_2" id="aviso">
            * Informacion Requerida
        </div>
        <div class="grid_2 prefix_1" id="etiquetas_formulario_registro_clientes">
            Nombre:<font color="red">&nbsp;*</font>
        </div>
        <div class="grid_4 alpha" id="campos_formulario">
            <?= form_input($nombres); ?>
        </div>
        <div class="grid_2 prefix_1" id="etiquetas_formulario_registro_clientes">
            Apellido:<font color="red">&nbsp;*</font>
        </div>
        <div class="grid_4 alpha" id="campos_formulario">
            <?= form_input($apellidos); ?>
        </div>
        <div class="grid_2 prefix_1" id="etiquetas_formulario_registro_clientes">
            Cumpleaños:<font color="red">&nbsp;*</font>
        </div>
        <div class="grid_4 alpha" id="campos_formulario">
            <input size="10" id="f_date1" name="f_date1" value="<?php echo set_value('f_date1'); ?>" readonly/>
            <button class="boton_calendario" id="f_btn1"></button>
            <script type="text/javascript">//<![CDATA[
              Calendar.setup({
                inputField : "f_date1",
                trigger    : "f_btn1",
                onSelect   : function() { this.hide() },
                showTime   : false,
                //dateFormat : "%Y-%m-%d %I:%M %p"
                        dateFormat : "%Y-%m-%d"
              });
    //]]>   </script>
<!--            <select name="dia">
            <option value="0">dia</option>
            <option value="01">1</option><option value="02">2</option><option value="03">3</option>
            <option value="04">4</option><option value="05">5</option><option value="06">6</option>
            <option value="07">7</option><option value="08">8</option><option value="09">9</option>
            <option value="10">10</option><option value="11">11</option><option value="12">12</option>
            <option value="13">13</option><option value="14">14</option><option value="15">15</option>
            <option value="16">16</option><option value="17">17</option><option value="18">18</option>
            <option value="19">19</option><option value="20">20</option><option value="21">21</option>
            <option value="22">22</option><option value="23">23</option><option value="24">24</option>
            <option value="25">25</option><option value="26">26</option><option value="27">27</option>
            <option value="28">28</option><option value="29">29</option><option value="30">30</option>
            <option value="31">31</option>
            </select>            
            <select name="mes">
            <option value="0">mes</option>
            <option value="01">Enero</option><option value="02">Febrero</option><option value="03">Marzo</option>
            <option value="04">Abril</option><option value="05">Mayo</option><option value="06">Junio</option>
            <option value="07">Julio</option><option value="08">Agosto</option><option value="09">Septiembre</option>
            <option value="10">Octubre</option><option value="11">Noviembre</option><option value="12">Diciembre</option>
            </select>
            <select name="anio">
            <option value="0">año</option>
            <option value="1960">1960</option><option value="1961">1961</option><option value="1962">1962</option><option value="1963">1963</option><option value="1964">1964</option><option value="1965">1965</option><option value="1966">1966</option><option value="1967">1967</option><option value="1968">1968</option><option value="1969">1969</option>
            <option value="1970">1970</option><option value="1971">1971</option><option value="1972">1972</option><option value="1973">1973</option><option value="1974">1974</option><option value="1975">1975</option><option value="1976">1976</option><option value="1977">1977</option><option value="1978">1978</option><option value="1979">1979</option>
            <option value="1980">1980</option><option value="1981">1981</option><option value="1982">1982</option><option value="1983">1983</option><option value="1984">1984</option><option value="1985">1985</option><option value="1986">1986</option><option value="1987">1987</option><option value="1988">1988</option><option value="1989">1989</option>
            <option value="1990">1990</option><option value="1991">1991</option><option value="1992">1992</option><option value="1993">1993</option><option value="1994">1994</option><option value="1995">1995</option><option value="1996">1996</option><option value="1997">1997</option><option value="1998">1998</option><option value="1999">1999</option>
            <option value="2000">2000</option><option value="2001">2001</option><option value="2002">2002</option><option value="2003">2003</option><option value="2004">2004</option><option value="2005">2005</option><option value="2006">2006</option><option value="2007">2007</option><option value="2008">2008</option><option value="2009">2009</option>
            <option value="2010">2010</option><option value="2011">2011</option><option value="2012">2012</option>
            </select>-->
        </div>
        <div class="grid_2 prefix_1" id="etiquetas_formulario_registro_clientes">
            E-mail:<font color="red">&nbsp;*</font>
        </div>
        <div class="grid_4 alpha" id="campos_formulario">
            <?= form_input($email); ?>
        </div>
        <div id="titulo_registrar_clientes" class="grid_3 alpha suffix_2">
            Su Direccion:
        </div>
        <div class="grid_2 prefix_1" id="etiquetas_formulario_registro_clientes">
            Direccion Exacta:<font color="red">&nbsp;*</font>
        </div>
        <div class="grid_4 alpha" id="campos_formulario">
            <?= form_textarea($direccion); ?>
        </div>
        <div class="grid_2 prefix_1" id="etiquetas_formulario_registro_clientes">
            Ciudad/Cantón:<font color="red">&nbsp;*</font>
        </div>
        <div class="grid_4 alpha" id="campos_formulario">
            <select name="ciudad" id="ciudad">
                <option selected value="0">Elegir</option>
                <?php
            foreach ($listarCiudades as $fila):
                echo '<option value="' . $fila->idciudades . '">' . $fila->nombre . '</option>';
            endforeach;
            ?>
            </select>
        </div>
        <div class="grid_2 prefix_1" id="etiquetas_formulario_registro_clientes">
            Parroquia:<font color="red">&nbsp;*</font>
        </div>
        <div class="grid_4 alpha" id="campos_formulario">
            <select name="parroquia" id="parroquia">
            <option selected value="0">Elegir</option>
            </select>
        </div>
        <div id="titulo_registrar_clientes" class="grid_3 alpha suffix_2">
            Su Informacion de Contacto:
        </div>
        <div class="grid_2 prefix_1" id="etiquetas_formulario_registro_clientes">
            Telefono Fijo:<font color="red">&nbsp;*</font>
        </div>
        <div class="grid_4 alpha" id="campos_formulario">
            <?= form_input($telefono_fijo); ?>
        </div>
        <div class="grid_2 prefix_1" id="etiquetas_formulario_registro_clientes">
            Celular:<font color="red">&nbsp;*</font>
        </div>
        <div class="grid_4 alpha" id="campos_formulario">
            <?= form_input($telefono_movil); ?>
        </div>
        <div id="titulo_registrar_clientes" class="grid_3 alpha suffix_2">
            Su Contraseña:
        </div>
        <div class="grid_2 prefix_1" id="etiquetas_formulario_registro_clientes">
            Contraseña:<font color="red">&nbsp;*</font>
        </div>
        <div class="grid_4 alpha" id="campos_formulario">
            <?= form_password($password); ?>
        </div>
        <div class="grid_2 prefix_1" id="etiquetas_formulario_registro_clientes">
            Repita Contraseña:<font color="red">&nbsp;*</font>
        </div>
        <div class="grid_4 alpha" id="campos_formulario">
            <?= form_password($re_password); ?>
        </div>
        <div class="grid_6" id="boton_enviar_registro">
            <input class="boton_continuar" type="submit" name="continuar" value="">
        </div>
        <?php echo form_close(); ?>
    </div>
</div>