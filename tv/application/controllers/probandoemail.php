<?php

class Probandoemail extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('Carrito_de_compras_modelo');
    }
    
    

    function enviar() {
        $logo_propiedades = array(
                'src' => base_url() . 'PlantillaComfranklin/images/logo.png',
                'class' => 'comfranklin',
            );
        
        $email = 'mac_ozzi@yahoo.com';
        $this->load->library('email');
        $this->email->from('almacenesfranklin@gmail.com', 'Comercial Franklin');
        $this->email->to($email);
        $this->email->cc('almacenesfranklin@gmail.com');
        $this->email->subject('Verificacion de Registro Comercial Franklin');
        $this->email->message('
        <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <link href="<?php echo base_url(); ?>PlantillaComfranklin/mi estilo.css" rel="stylesheet" type="text/css" />
                <style type="text/css">
        h1 { 
            color: red; 
            font-family:verdana,arial; 
            font-size: bold;
            font-size:12px;
            padding-left: 50px;  
        }

        p { 
            color: gray; 
            font-family:verdana,arial; 
            width:700px;
            font-size:11px;
            padding-left: 50px;
            padding-top: 10px;
            text-align: justify;
        }

        .titulo_producto{ 
            font-size:10px; 
            font-family:verdana,arial;
            font-weight:bold;
            padding-top: 20px;
            padding-bottom: 10px;
            padding-left: 150px;
            color: black;
            }

        div

        .tabla_detalle{
            padding-left: 150px;
            font-family:verdana,arial;font-size:11px;
        }

        .contenido_imagen_logo{
            width:755px;
            text-align: right;
        }

        .logo{
            height:58px;
            width:167px; 
            margin-top:3px;
            margin-left:3px;
        }
        </style>
        </head>
        <body>
            <div class="contenido_imagen_logo">
                <img src="'.base_url().'PlantillaComfranklin/images/logo.png" class="logo">             
            </div>
            <h1> Orden de Pedido: </h1>
            <p>Comercial Franklin envia este email como una confirmacion de los productos adquiridos en su sistema
                de tienda virtual, a continuacion se presenta el detalle de los productos adquiridos.</p>
            <p class="titulo_producto"> Producto(s):</p>
            <div class="tabla_detalle">
                <table>
                    <tr>
                        <td width="20px">&nbsp;&nbsp;</td>
                        <td align="left" width="250px">1 x tele sony </td>
                        <td width="50px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td align="right">$1234.90</td>
                    </tr>
                    <tr>
                        <td width="20px">&nbsp;&nbsp;</td>
                        <td align="left" width="250px">1 x tele samsung</td>
                        <td width="50px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td align="right">$34.90</td>
                    </tr>
                    <tr>
                        <td width="20px">&nbsp;&nbsp;</td>
                        <td align="left" width="250px">1 x cocina indurama</td>
                        <td width="50px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td align="right">$34.90</td>
                    </tr>
                    <tr>
                        <td width="20px">&nbsp;&nbsp;</td>
                        <td align="left" width="250px" height="30px">&nbsp;&nbsp;</td>
                        <td width="50px">&nbsp;&nbsp;</td>
                        <td align="right">&nbsp;&nbsp;</td>
                    </tr>
                    <tr>
                        <td width="20px">&nbsp;&nbsp;</td>
                        <td align="right" width="250px"><font color="red"><b>Subtotal:</b></font></td>
                        <td width="50px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td align="right">$1234.90</td>
                    </tr>
                    <tr>
                        <td width="20px">&nbsp;&nbsp;</td>
                        <td align="right" width="250px"><font color="red"><b>Gastos de envio:</b></font></td>
                        <td width="50px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td align="right">$1234.90</td>
                    </tr>
                    <tr>
                        <td width="20px">&nbsp;&nbsp;</td>
                        <td align="right" width="250px"><font color="red"><b>Total:</b></font></td>
                        <td width="50px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td align="right"><b>$111234.90</b></td>
                    </tr>
                </table>
            </div>
            <p>
                <font color="red"><b>Nota:</b></font> Si desea agilizar el proceso de compra y pago contactese con un asesor al cliente a traves del siguiente telefono
                2338929 o escribanos al siguiente correo: almacenesfranklin@gmail.com
            </p>
        </body>
        </html>
        ');
        $this->email->send();
    }
    
    function estiloemail(){
        $ip_maquina_actual = getenv('REMOTE_ADDR');
        $idcarrito = $this->session->userdata('idCarrito');
        $mostrarCarrito = $this->Carrito_de_compras_modelo->mostrarCarrito($idcarrito);
        $totalCarrito = $this->Carrito_de_compras_modelo->totalCarrito($idcarrito, $ip_maquina_actual);
        
        $data['titulo'] = "ESTILO DE EMAIL";
            $data ["contenido_principal"] = "estilo_email";
            $this->load->view("includes/template", $data);
    }

}
