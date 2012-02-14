<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Informacion_corporativa extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
    }
    
    function index(){
        
    }
    
    function nuestras_tiendas() {
        $data['titulo'] = "Nuestras Tiendas";
        $data ["contenido_principal"] = "informacion_corporativa/nuestras_tiendas";
        $this->load->view("includes/template", $data);
    }
    
    function aviso_legal(){
        $data['titulo'] = "Aviso Legal";
        $data ["contenido_principal"] = "informacion_corporativa/aviso_legal";
        $this->load->view("includes/template", $data);
    }
    
    function mision_vision(){
        $data['titulo'] = "Misión y Visión";
        $data ["contenido_principal"] = "informacion_corporativa/mision_vision";
        $this->load->view("includes/template", $data);
    }
    
    function donde_estamos(){
        $data['titulo'] = "Donde Estamos?";
        $data ["contenido_principal"] = "informacion_corporativa/donde_estamos";
        $this->load->view("includes/template", $data);
    }
    
    function acerca_de(){
        $data['titulo'] = "Acerca de:";
        $data ["contenido_principal"] = "informacion_corporativa/acerca_de";
        $this->load->view("includes/template", $data);
    }
    
    function contactenos(){
        $data['titulo'] = "Contactenos";
        $data ["contenido_principal"] = "informacion_corporativa/contactenos";
        $this->load->view("includes/template", $data);
    }
    
    function enviarEmailContactenos() {
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email');
        $this->form_validation->set_rules('telefono', 'Teléfono', 'trim|required');
        $this->form_validation->set_rules('asunto', 'Asunto', 'trim|required');
        $this->form_validation->set_rules('mensaje', 'Mensaje', 'trim|required');
        $this->form_validation->set_message('required', 'El campo %s es requerido');
        $this->form_validation->set_message('valid_email', 'El campo %s no es valido');
        if ($this->form_validation->run() == FALSE) {
            $this->contactenos();
        } else {
            $nombre = $this->input->post('nombre');
            $email = $this->input->post('email');
            $telefono = $this->input->post('telefono');
            $asunto = $this->input->post('asunto');
            $mensaje = $this->input->post('mensaje');
            $cadena ='
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
        .datos_pedido{
            color: gray; 
            font-family:verdana,arial; 
            width:700px;
            font-size:11px;
            padding-left: 50px;
            padding-top: 10px;
            text-align: justify;
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
            <h1> Dudas e Inquietudes: </h1>
            <p>El Sr(a), '.$nombre.' envia este email en el cual expresa lo siguiente:</p>
            <p class="datos_pedido"><b> Nombre:</b>'.$nombre.'</p>
            <p class="datos_pedido"><b> E-mail:</b>'.$email.'</p>
            <p class="datos_pedido"><b> Telefono:</b>'.$telefono.'</p>
            <p class="datos_pedido"><b> Asunto:</b>'.$asunto.'</p>
            <p class="datos_pedido"><b> Mensaje:</b></p><p>'.$mensaje.'</p>
            <p>
                <font color="red"><b>Nota:</b></font> Comercial Franklin se pondra en contacto con usted a la brevedad posible o puede comunicarce con nosotros via telefonica al (02)2338929.
            </p>
        </body>
        </html> 
            ';
            //enviando email de contactenos
            $this->load->library('email');
            $this->email->from('almacenesfranklin@gmail.com', 'Comercial Franklin');
            $this->email->to('almacenesfranklin@gmail.com');
            $this->email->cc($email);
            $this->email->subject($asunto);
            $this->email->message($cadena);
            $this->email->send();
            redirect('informacion_corporativa/emailEnviadoContactenos');
        }
    }
    
    function emailEnviadoContactenos() {
        $data['titulo'] = "E-mail Enviado";
        $data ["contenido_principal"] = "informacion_corporativa/contactanos_email_enviado";
        $this->load->view("includes/template", $data);
    }
    
    function ayuda(){
        $data['titulo'] = "Guía de Manejo Sistema Tienda Virtual";
        $data ["contenido_principal"] = "informacion_corporativa/ayuda";
        $this->load->view("includes/template", $data);
    }
    
    function mapa_sitio(){
        $data['titulo'] = "Mapa del Sitio";
        $data ["contenido_principal"] = "informacion_corporativa/mapa_sitio";
        $this->load->view("includes/template", $data);
    }
    
    function top_latino_radio(){
        $data['titulo'] = "Ahora Escuchas Top Latino Radio.....";
        $this->load->view("informacion_corporativa/top_latino_radio", $data);
    }
    
    function descargar_chrome(){
        redirect('http://www.google.co.jp/chrome/?hl=es');
    }
}
?>
