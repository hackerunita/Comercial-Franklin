<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Clientes extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->_si_esta_logueado();
        $this->load->helper('form');
        $this->load->model('Clientes_modelo');
        $this->load->library('form_validation');
    }
    
    function _si_esta_logueado() {
        $si_esta_logueado = $this->session->userdata('esta_logueado');
        $idAdministradores = $this->session->userdata('idAdministrador');
        if ($si_esta_logueado != TRUE OR $idAdministradores == '') {
            redirect('administracion/loguearse');
        }
    }

    function mantenimiento_clientes() {
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_cliente'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo'; $data['item_activo_clientes_clientes'] = $item_activo;
        //obtener clientes existentes
        $obtenerClientes = $this->Clientes_modelo->obtenerClientes();
        $data['obtenerClientes'] = $obtenerClientes;
        //obtener total de registros en tabla clientes
        $obtenerTotalClientes = $this->Clientes_modelo->obtenerTotalClientes();
        $data['obtenerTotalClientes'] = $obtenerTotalClientes;
        //cargando la vista y enviando datos
        $data ["contenido_principal"] = "clientes/mantenimiento_clientes";
        $data ["titulo"] = "Administración de Clientes";
        $this->load->view("includes/template_cliente", $data);
    }
    
    function buscar_cliente() {
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_cliente'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo'; $data['item_activo_clientes_clientes'] = $item_activo;
        //reglas de validacion
        $this->form_validation->set_rules('nombre_cliente_buscar', 'Apellido', 'trim|required');
        $this->form_validation->set_message('required', 'El campo %s es requerido');
        if ($this->form_validation->run() == FALSE) {
            $this->mantenimiento_clientes();
        } else {
            $nombre = $this->input->post('nombre_cliente_buscar');
            $buscarClientes = $this->Clientes_modelo->buscarClientesPorNombre($nombre);
            if ($buscarClientes) {
                $data['obtenerClientesPorNombre'] = $buscarClientes;
                //si existen resultados de la busqueda se cuentan cuantos registros hay
                $obtenerTotalClientesBusqueda = $this->Clientes_modelo->obtenerTotalClientesBuscarPorNombre($nombre);
                $data['obtenerTotalClientesBusqueda'] = $obtenerTotalClientesBusqueda;
            } else {
                $data['obtenerClientesPorNombre'] = '';
            }
            //cargando la vista y enviando datos
            $data['parametroClienteBusqueda'] = $nombre;
            $data ["contenido_principal"] = "clientes/mantenimiento_clientes";
            $data ["titulo"] = "Administración de Clientes";
            $this->load->view("includes/template_cliente", $data);
        }
    }
    
    function actualizar_clientes($idcliente) {
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_cliente'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo'; $data['item_activo_clientes_clientes'] = $item_activo;
        //obtener el cliente seleccionado segun idcliente
        $obtenerClienteSeleccionado = $this->Clientes_modelo->obtenerClienteSeleccionado($idcliente);
        $data['obtenerClienteSeleccionado'] = $obtenerClienteSeleccionado;
        $data ["contenido_principal"] = "clientes/actualizar_clientes";
        $data ["titulo"] = "Actualización de Clientes";
        $this->load->view("includes/template_cliente", $data);
    }
    
    function actualizar_clientes_repoblar_textbox($idcliente) {
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_cliente'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo'; $data['item_activo_clientes_clientes'] = $item_activo;
        //idcliente actual
        $data['idClienteActual'] = $idcliente;
        $data ["contenido_principal"] = "clientes/actualizar_clientes";
        $data ["titulo"] = "Actualización de Clientes";
        $this->load->view("includes/template_cliente", $data);
    }
    
    function actualizarCliente() {
        //recogiendo datos para cuando exista un error mandar a poblar de nuevo los textbox
        $id_cliente_seleccionado = $this->input->post('id_cliente_seleccionado');
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_cliente'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo'; $data['item_activo_clientes_clientes'] = $item_activo;
        //reglas de validacion
        $this->form_validation->set_rules('nombre_cliente', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('apellido_cliente', 'Apellido', 'trim|required');
        $this->form_validation->set_rules('direccion_cliente', 'Dirección', 'trim|required');
        $this->form_validation->set_rules('email_cliente', 'E-mail', 'trim|required|valid_email');
        $this->form_validation->set_rules('telefono_cliente', 'Teléfono', 'trim|required|numeric|integer');
        $this->form_validation->set_rules('celular_cliente', 'Celular', 'trim|required|numeric|integer');
        $this->form_validation->set_message('required', 'El campo %s es requerido');
        $this->form_validation->set_message('valid_email', 'El campo %s no es valido');
        $this->form_validation->set_message('numeric', 'El campo %s debe tener solo caracteres numéricos');
        $this->form_validation->set_message('integer', 'El campo %s debe tener solo números enteros');
        if ($this->form_validation->run() == FALSE) {
            $this->actualizar_clientes_repoblar_textbox($id_cliente_seleccionado);
        } else {
            $nombre = $this->input->post('nombre_cliente');
            $apellido = $this->input->post('apellido_cliente');
            $direccion = $this->input->post('direccion_cliente');
            $email = $this->input->post('email_cliente');
            $telefono = $this->input->post('telefono_cliente');
            $celular = $this->input->post('celular_cliente');
            //echo $nombre.'/'.$apellido.'/'.$direccion.'/'.$email.'/'.$telefono.'/'.$celular;
            $actualizarCliente = $this->Clientes_modelo->actualizarCliente($id_cliente_seleccionado, $nombre, $apellido, $direccion, $email, $telefono, $celular);
            if ($actualizarCliente) {
                $data ["Mensaje_Cliente_Actualizado"] = 'Cliente Actualizado';
            } else {
                $data ["Mensaje_Cliente_Actualizado"] = '';
            }
            //obtener clientes existentes
            $obtenerClientes = $this->Clientes_modelo->obtenerClientes();
            $data['obtenerClientes'] = $obtenerClientes;
            //obtener total de registros en tabla clientes
            $obtenerTotalClientes = $this->Clientes_modelo->obtenerTotalClientes();
            $data['obtenerTotalClientes'] = $obtenerTotalClientes;
            //cargando la vista y enviando datos
            $data ["contenido_principal"] = "clientes/mantenimiento_clientes";
            $data ["titulo"] = "Administración de Clientes";
            $this->load->view("includes/template_cliente", $data);
        }
    }
    
    function actualizar_estado($idcliente, $estado) {
        //mandando el estilo del menu activo
        $menu_activo = 'active';
        $data['menu_activo_cliente'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo';
        $data['item_activo_clientes_clientes'] = $item_activo;
        if ($estado == 0) {
            $actualizarEstado = $this->Clientes_modelo->actualizarEstado($idcliente, 1);
            if ($actualizarEstado) {
                $data ["Mensaje_Cliente_Estado"] = 'Estado Actualizado';
            } else {
                $data ["Mensaje_Cliente_Estado"] = '';
            }
        }
        if ($estado == 1) {
            $actualizarEstado = $this->Clientes_modelo->actualizarEstado($idcliente, 0);
            if ($actualizarEstado) {
                $data ["Mensaje_Cliente_Estado"] = 'Estado Actualizado';
            } else {
                $data ["Mensaje_Cliente_Estado"] = '';
            }
        }
        //obtener clientes existentes
        $obtenerClientes = $this->Clientes_modelo->obtenerClientes();
        $data['obtenerClientes'] = $obtenerClientes;
        //obtener total de registros en tabla clientes
        $obtenerTotalClientes = $this->Clientes_modelo->obtenerTotalClientes();
        $data['obtenerTotalClientes'] = $obtenerTotalClientes;
        //cargando la vista y enviando datos
        $data ["contenido_principal"] = "clientes/mantenimiento_clientes";
        $data ["titulo"] = "Administración de Clientes";
        $this->load->view("includes/template_cliente", $data);
    }
    
    function enviar_email($idcliente){
        //mandando el estilo del menu activo
        $menu_activo = 'active';
        $data['menu_activo_cliente'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo';
        $data['item_activo_clientes_clientes'] = $item_activo;
        //id del cliente actual
        $data['idClienteActual'] = $idcliente;
        //obtener email del cliente actual
        $obtenerEmailCliente = $this->Clientes_modelo->obtenerEmailCliente($idcliente);
        $data['obtenerEmailCliente'] = $obtenerEmailCliente;
        //cargando la vista y enviando datos
        $data ["contenido_principal"] = "clientes/enviar_email_cliente";
        $data ["titulo"] = "Enviar E-mail al de Clientes";
        $this->load->view("includes/template_cliente", $data);
    }
    
    function enviarEmail() {
        //email cliente actual
        $email_cliente_actual = $this->input->post('email_cliente_actual');
        //id cliente actual
        $id_cliente_actual = $this->input->post('id_cliente_actual');
        //mandando el estilo del menu activo
        $menu_activo = 'active';
        $data['menu_activo_cliente'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo';
        $data['item_activo_clientes_clientes'] = $item_activo;
        //reglas de validacion
        $this->form_validation->set_rules('asunto', 'Asunto', 'trim|required');
        $this->form_validation->set_rules('mensaje', 'Mensaje', 'trim|required');
        $this->form_validation->set_message('required', 'El campo %s es requerido');
        if ($this->form_validation->run() == FALSE) {
            $this->enviar_email($id_cliente_actual);
        } else {
            $asunto = $this->input->post('asunto');
            $mensaje = $this->input->post('mensaje');
            //cargando libreria para enviar email e inicalizando parametros de envio
            $this->load->library('email');
            $this->email->from('almacenesfranklin@gmail.com', 'Comercial Franklin');
            $this->email->to($email_cliente_actual);
            $this->email->subject($asunto);
            $this->email->message($mensaje);
            if (!$this->email->send()) {
                $data['Mensaje_Email_Enviado'] = '';
            } else {
                $data['Mensaje_Email_Enviado'] = 'Email Enviado';
            }
            //obtener clientes existentes
            $obtenerClientes = $this->Clientes_modelo->obtenerClientes();
            $data['obtenerClientes'] = $obtenerClientes;
            //obtener total de registros en tabla clientes
            $obtenerTotalClientes = $this->Clientes_modelo->obtenerTotalClientes();
            $data['obtenerTotalClientes'] = $obtenerTotalClientes;
            //cargando la vista y enviando datos
            $data ["contenido_principal"] = "clientes/mantenimiento_clientes";
            $data ["titulo"] = "Administración de Clientes";
            $this->load->view("includes/template_cliente", $data);
        }
    }
    
}