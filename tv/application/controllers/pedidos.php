<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pedidos extends CI_Controller {

    function __construct() {
        parent::__construct();
        //$this->_is_logged_in();
        $this->load->helper('form');
        $this->load->model('Pedidos_modelo');
        $this->load->model('Clientes_modelo');
        $this->load->model('Carrito_de_compras_modelo');
        $this->load->library('form_validation');
    }

    function index() {
        
    }

    /*function _is_logged_in() {
        $is_logged_in = $this->session->userdata('is_logged_in');
        $id_cliente = $this->session->userdata('id_cliente');
        if ($is_logged_in != TRUE OR $id_cliente == '') {
            redirect('clientes/login');
        }
    }*/

    function pedido() {

        $is_logged_in = $this->session->userdata('is_logged_in');
        $id_cliente = $this->session->userdata('id_cliente');
        if ($is_logged_in != TRUE OR $id_cliente == '') {
            $data['mensajePedidos'] = '1';
            $data['titulo'] = "Iniciando Proceso de Pedido";
            $data ["contenido_principal"] = "clientes/login";
            $this->load->view("includes/template", $data);
        } else {
            $id_cliente = $this->session->userdata('id_cliente');
            $datosDeEnvio = $this->Pedidos_modelo->datosDeEnvio($id_cliente);
            $nombrePersonaRecibePedido = $datosDeEnvio->nombrePersonaRecibePedido;
            $direccion = $datosDeEnvio->direccion;
            $ciudad = $datosDeEnvio->ciudad;
            $parroquia = $datosDeEnvio->parroquia;
            $telefono = $datosDeEnvio->telefonoFijo;
            $nombreCiudad = $this->Pedidos_modelo->nombreCiudad($ciudad);
            $nombreParroquia = $this->Pedidos_modelo->nombreParroquia($parroquia);
            $datosPedido = array(
                'NombreApellido' => $nombrePersonaRecibePedido,
                'Direccion' => $direccion,
                'NombreParroquia' => $nombreParroquia,
                'NombreCiudad' => $nombreCiudad,
                'Telefono' => $telefono,
                'idCiudad' => $ciudad
            );
            $this->session->set_userdata($datosPedido);
            $data['titulo'] = "Proceso de Pedido de Productos";
            $data ["contenido_principal"] = "pedidos/informacion_entrega";
            $this->load->view("includes/template", $data);
        }
    }

    function actualizar_direccion_envio() {
        //consultando todas las ciudades
        $listarCiudades = $this->Clientes_modelo->listarCiudades();
        $data['listarCiudades'] = $listarCiudades;
        $data['titulo'] = "Actulizar direccion de envio";
        $data ["contenido_principal"] = "pedidos/informacion_entrega_direccion";
        $this->load->view("includes/template", $data);
    }

    function actualizarYValidarDatosEnvio() {
        $this->form_validation->set_rules('nombres', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('apellidos', 'Apellido', 'trim|required');
        $this->form_validation->set_rules('direccion', 'Direccion Exacta', 'trim|required');
        $this->form_validation->set_rules('parroquia', 'Parroquia', 'callback__verificarCiudadParroquia');
        $this->form_validation->set_rules('ciudad', 'Ciudad', 'callback__verificarCiudadParroquia');
        $this->form_validation->set_message('required', 'El campo %s es requerido');
        $this->form_validation->set_message('_verificarCiudadParroquia', 'Por favor seleccione tanto la parroquia como la ciudad');
        if ($this->form_validation->run() == FALSE) {
            $this->actualizar_direccion_envio();
        } else {
            $id_cliente = $this->session->userdata('id_cliente');
            $nombre = $this->input->post('nombres');
            $apellido = $this->input->post('apellidos');
            $nombrePersonaRecibePedido = $nombre . ' ' . $apellido;
            $direccion = $this->input->post('direccion');
            $parroquia = $this->input->post('parroquia');
            $ciudad = $this->input->post('ciudad');
            $actualizarDatosPedido = $this->Pedidos_modelo->actualizarDatosPedido($id_cliente, $nombrePersonaRecibePedido, $ciudad, $parroquia);
            if ($actualizarDatosPedido) {
                $datosDeEnvio = $this->Pedidos_modelo->datosDeEnvio($id_cliente);
                $nombrePersonaRecibePedido = $datosDeEnvio->nombrePersonaRecibePedido;
                $ciudad = $datosDeEnvio->ciudad;
                $parroquia = $datosDeEnvio->parroquia;
                $nombreCiudad = $this->Pedidos_modelo->nombreCiudad($ciudad);
                $nombreParroquia = $this->Pedidos_modelo->nombreParroquia($parroquia);
                $nuevosDatosPedido = array(
                    'NombreApellido' => $nombrePersonaRecibePedido,
                    'Direccion' => $direccion,
                    'NombreParroquia' => $nombreParroquia,
                    'NombreCiudad' => $nombreCiudad
                );
                $this->session->set_userdata($nuevosDatosPedido);
            }
            $data['titulo'] = "Proceso de Pedido de Productos(Actualizar Datos)";
            $data ["contenido_principal"] = "pedidos/informacion_entrega";
            $this->load->view("includes/template", $data);
        }
    }

    function informacion_pago() {
        //consultando las formas de pago
        $listarformasDePago = $this->Pedidos_modelo->formasDePago();
        $data['listarFormasPago'] = $listarformasDePago;
        $data['titulo'] = "Proceso de Pedido de Productos";
        $data ["contenido_principal"] = "pedidos/informacion_pago";
        $this->load->view("includes/template", $data);
    }

    function confirmacion() {
        $formaPago = $this->input->post('forma_pago');
        $masDatosPedido = array(
            'FormaPago' => $formaPago
        );
        $this->session->set_userdata($masDatosPedido);
        $ip_maquina_actual = getenv('REMOTE_ADDR');
        $idcarrito = $this->session->userdata('idCarrito');
        $mostrarCarrito = $this->Carrito_de_compras_modelo->mostrarCarrito($idcarrito);
        $totalCarrito = $this->Carrito_de_compras_modelo->totalCarrito($idcarrito, $ip_maquina_actual);

        $totalPedido = array(
            //creando el total incluido gastos de envio
            'totalPedido' => $totalCarrito + 5
        );
        $this->session->set_userdata($totalPedido);

        if ($mostrarCarrito) {
            $data['mostrarCarrito'] = $mostrarCarrito;
            $data['totalCarrito'] = $totalCarrito;
            $data['titulo'] = "Proceso de Pedido de Productos";
            $data ["contenido_principal"] = "pedidos/confirmacion";
            $this->load->view("includes/template", $data);
        }
    }

    function orden_confirmada() {
        //creando el pedido
        $nombrePersonaRecibe = $this->session->userdata('NombreApellido');
        $nombreParroquia = $this->session->userdata('NombreParroquia');
        $direccion = $this->session->userdata('Direccion');
        $NombreCiudad = $this->session->userdata('NombreCiudad');
        $telefono = $this->session->userdata('Telefono');
        $email = $this->session->userdata('email_cliente');
        $total = $this->session->userdata('totalPedido');
        $idFormaPago = $this->session->userdata('FormaPago');
        $idCiudad = $this->session->userdata('idCiudad');
        $idCarrito = $this->session->userdata('idCarrito');
        $crearPedido = $this->Pedidos_modelo->crearPedido($nombrePersonaRecibe, $nombreParroquia, $direccion, $telefono, $email, $total, $idFormaPago, $idCiudad, $idCarrito);
        //creamos el email
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
            <h1> Orden de Pedido: </h1>
            <p>Comercial Franklin envia este email como una confirmacion de los productos adquiridos en su sistema
                de tienda virtual, a continuacion se presenta el detalle de los productos adquiridos.</p>
            
            ';
            
            //obtener datos del pedido
            $obtenerDatosPedido = $this->Pedidos_modelo->obtenerDatosPedido($idCarrito);
            foreach ($obtenerDatosPedido as $row):
                $cadena .= '<p class="datos_pedido"><b> Persona que recibe: </b>'.$row->nombrePersonaRecibePedido.'</p>';
                $cadena .= '<p class="datos_pedido"><b> Direccion: </b>'.$row->direccion.'</p>';
                $cadena .= '<p class="datos_pedido"><b> Telefono: </b>'.$row->telefono.'</p>';
                $cadena .= '<p class="datos_pedido"><b> Forma de pago: </b>'.$row->nombre.'</p>';
            endforeach;
            
            $cadena .= '
               <p class="titulo_producto"> Producto(s):</p>
               <div class="tabla_detalle">
               <table>
            '; 
            
            //obtener el idpedido del carrito actual para listar el detalle del pedido
            $obtenerIdPedido = $this->Pedidos_modelo->obtenerIdPedido($idCarrito);
                foreach ($obtenerIdPedido as $row):
                    $cadena .='<tr>';
                    $cadena .= '<td width="20px">&nbsp;&nbsp;</td>';
                    $cadena .= '<td align="left" width="250px">' . $row->cantidad . ' x '.$row->descripcion.'</td>';
                    $cadena .= '<td width="50px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                    $cadena .= '<td align="right">$' . $row->precioTotal . '</td>';
                    $cadena .= '</tr>';
                endforeach;
            
            
            $cadena .= '
                    <tr>
                        <td width="20px">&nbsp;&nbsp;</td>
                        <td align="left" width="250px" height="30px">&nbsp;&nbsp;</td>
                        <td width="50px">&nbsp;&nbsp;</td>
                        <td align="right">&nbsp;&nbsp;</td>
                    </tr>
                    <tr>
                        <td width="20px">&nbsp;&nbsp;</td>
                        <td align="right" width="250px"><font color="red"><b>Total a pagar:</b></font></td>
                        <td width="50px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        ';
            foreach ($obtenerDatosPedido as $row):
                    $cadena .= '<td align="right">$' . $row->total . '</td>';
                endforeach;
             
            $cadena .= '
                    </tr>
                </table>
            </div>
            <p>
                <font color="red"><b>Nota:</b></font> Si desea agilizar el proceso de compra y pago contactese con un asesor al cliente a traves del siguiente telefono
                2338929 o escribanos al siguiente correo: almacenesfranklin@gmail.com
            </p>
        </body>
        </html>   
            ';
        //enviando email de confirmacion de compra
        $email = $this->session->userdata('email_cliente');
        $this->load->library('email');
        $this->email->from('almacenesfranklin@gmail.com', 'Comercial Franklin');
        $this->email->to($email);
        $this->email->cc('almacenesfranklin@gmail.com');
        $this->email->subject('Detalle orden de compra');
        $this->email->message($cadena);
        //si el email se envia crea el pedido
        if (!$this->email->send()) {
            //echo 'no se pudo enviar el email de confirmacion, revise su conexion a internet y vuelva a intentarlo';
        } else {
            $this->session->unset_userdata('idCarrito');
            redirect('pedidos/email_enviado_orden_confirmada');
        }
    }
    
    function email_enviado_orden_confirmada() {
        $data['titulo'] = "Orden Confirmada";
        $data ["contenido_principal"] = "pedidos/orden_confirmada";
        $this->load->view("includes/template", $data);
    }

    function _verificarCiudadParroquia($id) {
        if ($id != 0) {
            return true;
        } else {
            return false;
        }
    }
    
    function historialPedidos() {
        $id_cliente = $this->session->userdata('id_cliente');
        $datosHistorialPedido = $this->Pedidos_modelo->obtenerDatosHistorialPedido($id_cliente);
        $data['datosHistorialPedido'] = $datosHistorialPedido;
        $data['titulo'] = "Historial de Pedidos";
        $data ["contenido_principal"] = "pedidos/historial_pedidos";
        $this->load->view("includes/template", $data);
    }
    
    function detalleHistorialPedidos($idPedido, $numeroPedido){
        $detalleHistorialPedido = $this->Pedidos_modelo->obtenerDetalleHistorialPedido($idPedido);
        $data['detalleHistorialPedido'] = $detalleHistorialPedido;
        $datosDetalleHistorialPedido = $this->Pedidos_modelo->obtenerDatosDetalleHistorialPedido($idPedido);
        $data['datosDetalleHistorialPedido'] = $datosDetalleHistorialPedido;
        $data['numeroPedido'] = $numeroPedido;
        $data['titulo'] = "Detalle Historial de Pedido";
        $data ["contenido_principal"] = "pedidos/detalle_historial_pedido";
        $this->load->view("includes/template", $data);
    }

}

?>
