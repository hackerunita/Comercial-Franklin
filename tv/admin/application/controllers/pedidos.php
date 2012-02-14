<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pedidos extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->_si_esta_logueado();
        $this->load->helper('form');
        $this->load->model('Pedidos_modelo');
        $this->load->library('form_validation');
    }

    function _si_esta_logueado() {
        $si_esta_logueado = $this->session->userdata('esta_logueado');
        $idAdministradores = $this->session->userdata('idAdministrador');
        if ($si_esta_logueado != TRUE OR $idAdministradores == '') {
            redirect('administracion/loguearse');
        }
    }

    function mantenimiento_pedidos() {
        //mandando el estilo del menu activo
        $menu_activo = 'active';
        $data['menu_activo_cliente'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo';
        $data['item_activo_clientes_pedidos'] = $item_activo;
        //obtener pedidos existentes
        $obtenerPedidos = $this->Pedidos_modelo->obtenerPedidos();
        $data['obtenerPedidos'] = $obtenerPedidos;
        //obtener total de registros en tabla pedidos
        $obtenerTotalPedidos = $this->Pedidos_modelo->obtenerTotalPedidos();
        $data['obtenerTotalPedidos'] = $obtenerTotalPedidos;
        //cargando la vista y enviando datos
        $data ["contenido_principal"] = "pedidos/mantenimiento_pedidos";
        $data ["titulo"] = "Administración de Pedidos";
        $this->load->view("includes/template_cliente", $data);
    }
    
    function buscar_pedido() {
        //mandando el estilo del menu activo
        $menu_activo = 'active';
        $data['menu_activo_cliente'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo';
        $data['item_activo_clientes_pedidos'] = $item_activo;
        //reglas de validacion
        $this->form_validation->set_rules('nombre_pedido_buscar', 'Apellido', 'trim|required');
        $this->form_validation->set_message('required', 'El campo %s es requerido');
        if ($this->form_validation->run() == FALSE) {
            $this->mantenimiento_pedidos();
        } else {
            $nombre = $this->input->post('nombre_pedido_buscar');
            $buscarPedidos = $this->Pedidos_modelo->buscarPedidosPorNombre($nombre);
            if ($buscarPedidos) {
                $data['obtenerPedidosPorNombre'] = $buscarPedidos;
                //si existen resultados de la busqueda se cuentan cuantos registros hay
                $obtenerTotalPedidosBusqueda = $this->Pedidos_modelo->obtenerTotalPedidosBuscarPorNombre($nombre);
                $data['obtenerTotalPedidosBusqueda'] = $obtenerTotalPedidosBusqueda;
            } else {
                $data['obtenerPedidosPorNombre'] = '';
            }
            //cargando la vista y enviando datos
            $data['parametroPedidoBusqueda'] = $nombre;
            $data ["contenido_principal"] = "pedidos/mantenimiento_pedidos";
            $data ["titulo"] = "Administración de Pedidos";
            $this->load->view("includes/template_cliente", $data);
        }
    }
    
    function actualizar_pedidos($idpedido) {
        //mandando el estilo del menu activo
        $menu_activo = 'active';
        $data['menu_activo_cliente'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo';
        $data['item_activo_clientes_pedidos'] = $item_activo;
        //idpedido seleccionado
        $data['idpedidoActual'] = $idpedido;
        //obtener el estado del pedido seleccionado segun idpedido
        $obtenerEstadoPedidoSeleccionado = $this->Pedidos_modelo->obtenerEstadoPedidoSeleccionado($idpedido);
        $data['obtenerEstadoPedidoSeleccionado'] = $obtenerEstadoPedidoSeleccionado;
        //obtener el pedido seleccionado segun idpedido
        $obtenerPedidoSeleccionado = $this->Pedidos_modelo->obtenerPedidoSeleccionado($idpedido);
        $data['obtenerPedidoSeleccionado'] = $obtenerPedidoSeleccionado;
        //obtener el detalle del pedido seleccionado segun idpedido
        $obtenerDetallePedidoSeleccionado = $this->Pedidos_modelo->obtenerDetallePedidoSeleccionado($idpedido);
        $data['obtenerDetallePedidoSeleccionado'] = $obtenerDetallePedidoSeleccionado;
        //obtener el total del pedido seleccionado segun idpedido
        $obtenerTotalPedidoSeleccionado = $this->Pedidos_modelo->obtenerTotalPedidoSeleccionado($idpedido);
        $data['obtenerTotalPedidoSeleccionado'] = $obtenerTotalPedidoSeleccionado;
        $data ["contenido_principal"] = "pedidos/actualizar_pedidos";
        $data ["titulo"] = "Actualización de Pedidos";
        $this->load->view("includes/template_cliente", $data);
    }
    
    function actualizarPedido() {
        //mandando el estilo del menu activo
        $menu_activo = 'active';
        $data['menu_activo_cliente'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo';
        $data['item_activo_clientes_pedidos'] = $item_activo;
        $id_pedido_seleccionado = $this->input->post('id_pedido_seleccionado');
        $estado = $this->input->post('cmb_estado');
        //si el valor del combo trae 1(Confirmado) entonces hay que mandar a actualizar el stock del producto
        if($estado == 1){
            //obtener el o los idproductos asociado a este pedido para mandar a actualizar el stock en la tabla prodductos
            $obtenerCodigoCantidadProducto = $this->Pedidos_modelo->obtenerCodigoProducto($id_pedido_seleccionado);
            foreach ($obtenerCodigoCantidadProducto as $filaProducto):
                //obtener stock actual de la tabla productos
                $obtenerStock = $this->Pedidos_modelo->obtenerStock($filaProducto->productos_idproductos);
                $stockTotal = $obtenerStock - $filaProducto->cantidad;
                //se actualiza el stock en la tabla productos
                $actualizarStockProducto = $this->Pedidos_modelo->actualizarStockProducto($filaProducto->productos_idproductos, $stockTotal);
            endforeach;
        }
        $actualizarEstadoPedido = $this->Pedidos_modelo->actualizarEstadoPedido($id_pedido_seleccionado, $estado);
        if ($actualizarEstadoPedido) {
            $data ["Mensaje_Pedido_Estado"] = 'Estado Actualizado';
        } else {
            $data ["Mensaje_Pedido_Estado"] = '';
        }
        //obtener pedidos existentes
        $obtenerPedidos = $this->Pedidos_modelo->obtenerPedidos();
        $data['obtenerPedidos'] = $obtenerPedidos;
        //obtener total de registros en tabla pedidos
        $obtenerTotalPedidos = $this->Pedidos_modelo->obtenerTotalPedidos();
        $data['obtenerTotalPedidos'] = $obtenerTotalPedidos;
        //cargando la vista y enviando datos
        $data ["contenido_principal"] = "pedidos/mantenimiento_pedidos";
        $data ["titulo"] = "Administración de Pedidos";
        $this->load->view("includes/template_cliente", $data);
    }
    
    function eliminar_pedidos($idpedido) {
        //mandando el estilo del menu activo
        $menu_activo = 'active';
        $data['menu_activo_cliente'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo';
        $data['item_activo_clientes_pedidos'] = $item_activo;
        //idpedido seleccionado
        $data['idpedidoActual'] = $idpedido;
        //obtener el estado del pedido seleccionado segun idpedido
        $obtenerEstadoPedidoSeleccionado = $this->Pedidos_modelo->obtenerEstadoPedidoSeleccionado($idpedido);
        $data['obtenerEstadoPedidoSeleccionado'] = $obtenerEstadoPedidoSeleccionado;
        //obtener el pedido seleccionado segun idpedido
        $obtenerPedidoSeleccionado = $this->Pedidos_modelo->obtenerPedidoSeleccionado($idpedido);
        $data['obtenerPedidoSeleccionado'] = $obtenerPedidoSeleccionado;
        //obtener el detalle del pedido seleccionado segun idpedido
        $obtenerDetallePedidoSeleccionado = $this->Pedidos_modelo->obtenerDetallePedidoSeleccionado($idpedido);
        $data['obtenerDetallePedidoSeleccionado'] = $obtenerDetallePedidoSeleccionado;
        //obtener el total del pedido seleccionado segun idpedido
        $obtenerTotalPedidoSeleccionado = $this->Pedidos_modelo->obtenerTotalPedidoSeleccionado($idpedido);
        $data['obtenerTotalPedidoSeleccionado'] = $obtenerTotalPedidoSeleccionado;
        $data ["contenido_principal"] = "pedidos/eliminar_pedidos";
        $data ["titulo"] = "Eliminación de Pedidos";
        $this->load->view("includes/template_cliente", $data);
    }
    
    function eliminarPedido($idpedido) {
        //mandando el estilo del menu activo
        $menu_activo = 'active';
        $data['menu_activo_cliente'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo';
        $data['item_activo_clientes_pedidos'] = $item_activo;
        $eliminarPedido = $this->Pedidos_modelo->eliminarPedido($idpedido);
        if ($eliminarPedido) {
            $data ["Mensaje_Pedido_Eliminado"] = 'Pedido eliminado';
        } else {
            $data ["Mensaje_Pedido_Eliminado"] = '';
        }
        //obtener pedidos existentes
        $obtenerPedidos = $this->Pedidos_modelo->obtenerPedidos();
        $data['obtenerPedidos'] = $obtenerPedidos;
        //obtener total de registros en tabla pedidos
        $obtenerTotalPedidos = $this->Pedidos_modelo->obtenerTotalPedidos();
        $data['obtenerTotalPedidos'] = $obtenerTotalPedidos;
        //cargando la vista y enviando datos
        $data ["contenido_principal"] = "pedidos/mantenimiento_pedidos";
        $data ["titulo"] = "Administración de Pedidos";
        $this->load->view("includes/template_cliente", $data);
    }
    
    //metodos para el manejo de pedidos recientes
    
    function mantenimiento_pedidos_pendientes() {
        //mandando el estilo del menu activo
        $menu_activo = 'active';
        $data['menu_activo_cliente'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'activo';
        $data['item_activo_clientes_pedidos_pendientes'] = $item_activo;
        //obtener pedidos existentes
        $obtenerPedidos = $this->Pedidos_modelo->obtenerPedidosPendientes();
        $data['obtenerPedidos'] = $obtenerPedidos;
        //obtener total de registros en tabla pedidos
        $obtenerTotalPedidos = $this->Pedidos_modelo->obtenerTotalPedidosPendientes();
        $data['obtenerTotalPedidos'] = $obtenerTotalPedidos;
        //cargando la vista y enviando datos
        $data ["contenido_principal"] = "pedidos/mantenimiento_pedidos_pendientes";
        $data ["titulo"] = "Administración de Pedidos Pendientes";
        $this->load->view("includes/template_cliente", $data);
    }
    
    function buscar_pedido_pendiente() {
        //mandando el estilo del menu activo
        $menu_activo = 'active';
        $data['menu_activo_cliente'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'activo';
        $data['item_activo_clientes_pedidos_pendientes'] = $item_activo;
        //reglas de validacion
        $this->form_validation->set_rules('nombre_pedido_pendiente_buscar', 'Apellido', 'trim|required');
        $this->form_validation->set_message('required', 'El campo %s es requerido');
        if ($this->form_validation->run() == FALSE) {
            $this->mantenimiento_pedidos_pendientes();
        } else {
            $nombre = $this->input->post('nombre_pedido_pendiente_buscar');
            $buscarPedidos = $this->Pedidos_modelo->buscarPedidosPendientesPorNombre($nombre);
            if ($buscarPedidos) {
                $data['obtenerPedidosPorNombre'] = $buscarPedidos;
                //si existen resultados de la busqueda se cuentan cuantos registros hay
                $obtenerTotalPedidosBusqueda = $this->Pedidos_modelo->obtenerTotalPedidosPendientesBuscarPorNombre($nombre);
                $data['obtenerTotalPedidosBusqueda'] = $obtenerTotalPedidosBusqueda;
            } else {
                $data['obtenerPedidosPorNombre'] = '';
            }
            //cargando la vista y enviando datos
            $data['parametroPedidoBusqueda'] = $nombre;
            $data ["contenido_principal"] = "pedidos/mantenimiento_pedidos_pendientes";
            $data ["titulo"] = "Administración de Pedidos Pendientes";
            $this->load->view("includes/template_cliente", $data);
        }
    }
    
    function actualizar_pedidos_pendientes($idpedido) {
        //mandando el estilo del menu activo
        $menu_activo = 'active';
        $data['menu_activo_cliente'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'activo';
        $data['item_activo_clientes_pedidos_pendientes'] = $item_activo;
        //idpedido seleccionado
        $data['idpedidoActual'] = $idpedido;
        //obtener el estado del pedido seleccionado segun idpedido
        $obtenerEstadoPedidoSeleccionado = $this->Pedidos_modelo->obtenerEstadoPedidoSeleccionado($idpedido);
        $data['obtenerEstadoPedidoSeleccionado'] = $obtenerEstadoPedidoSeleccionado;
        //obtener el pedido seleccionado segun idpedido
        $obtenerPedidoSeleccionado = $this->Pedidos_modelo->obtenerPedidoSeleccionado($idpedido);
        $data['obtenerPedidoSeleccionado'] = $obtenerPedidoSeleccionado;
        //obtener el detalle del pedido seleccionado segun idpedido
        $obtenerDetallePedidoSeleccionado = $this->Pedidos_modelo->obtenerDetallePedidoSeleccionado($idpedido);
        $data['obtenerDetallePedidoSeleccionado'] = $obtenerDetallePedidoSeleccionado;
        //obtener el total del pedido seleccionado segun idpedido
        $obtenerTotalPedidoSeleccionado = $this->Pedidos_modelo->obtenerTotalPedidoSeleccionado($idpedido);
        $data['obtenerTotalPedidoSeleccionado'] = $obtenerTotalPedidoSeleccionado;
        $data ["contenido_principal"] = "pedidos/actualizar_pedidos_pendientes";
        $data ["titulo"] = "Actualización de Pedidos Pendientes";
        $this->load->view("includes/template_cliente", $data);
    }
    
    function actualizarPedidoPendiente() {
        //mandando el estilo del menu activo
        $menu_activo = 'active';
        $data['menu_activo_cliente'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'activo';
        $data['item_activo_clientes_pedidos_pendientes'] = $item_activo;
        $id_pedido_seleccionado = $this->input->post('id_pedido_seleccionado');
        $estado = $this->input->post('cmb_estado');
        $actualizarEstadoPedido = $this->Pedidos_modelo->actualizarEstadoPedido($id_pedido_seleccionado, $estado);
        //si el valor del combo trae 1(Confirmado) entonces hay que mandar a actualizar el stock del producto
        if($estado == 1){
            //obtener el o los idproductos asociado a este pedido para mandar a actualizar el stock en la tabla prodductos
            $obtenerCodigoCantidadProducto = $this->Pedidos_modelo->obtenerCodigoProducto($id_pedido_seleccionado);
            foreach ($obtenerCodigoCantidadProducto as $filaProducto):
                //obtener stock actual de la tabla productos
                $obtenerStock = $this->Pedidos_modelo->obtenerStock($filaProducto->productos_idproductos);
                $stockTotal = $obtenerStock - $filaProducto->cantidad;
                //se actualiza el stock en la tabla productos
                $actualizarStockProducto = $this->Pedidos_modelo->actualizarStockProducto($filaProducto->productos_idproductos, $stockTotal);
            endforeach;
        }
        if ($actualizarEstadoPedido) {
            $data ["Mensaje_Pedido_Estado"] = 'Estado Actualizado';
        } else {
            $data ["Mensaje_Pedido_Estado"] = '';
        }
        //obtener pedidos existentes
        $obtenerPedidos = $this->Pedidos_modelo->obtenerPedidosPendientes();
        $data['obtenerPedidos'] = $obtenerPedidos;
        //obtener total de registros en tabla pedidos
        $obtenerTotalPedidos = $this->Pedidos_modelo->obtenerTotalPedidosPendientes();
        $data['obtenerTotalPedidos'] = $obtenerTotalPedidos;
        //cargando la vista y enviando datos
        $data ["contenido_principal"] = "pedidos/mantenimiento_pedidos_pendientes";
        $data ["titulo"] = "Administración de Pedidos Pendientes";
        $this->load->view("includes/template_cliente", $data);
    }
    
    function eliminar_pedidos_pendientes($idpedido) {
        //mandando el estilo del menu activo
        $menu_activo = 'active';
        $data['menu_activo_cliente'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'activo';
        $data['item_activo_clientes_pedidos_pendientes'] = $item_activo;
        //idpedido seleccionado
        $data['idpedidoActual'] = $idpedido;
        //obtener el estado del pedido seleccionado segun idpedido
        $obtenerEstadoPedidoSeleccionado = $this->Pedidos_modelo->obtenerEstadoPedidoSeleccionado($idpedido);
        $data['obtenerEstadoPedidoSeleccionado'] = $obtenerEstadoPedidoSeleccionado;
        //obtener el pedido seleccionado segun idpedido
        $obtenerPedidoSeleccionado = $this->Pedidos_modelo->obtenerPedidoSeleccionado($idpedido);
        $data['obtenerPedidoSeleccionado'] = $obtenerPedidoSeleccionado;
        //obtener el detalle del pedido seleccionado segun idpedido
        $obtenerDetallePedidoSeleccionado = $this->Pedidos_modelo->obtenerDetallePedidoSeleccionado($idpedido);
        $data['obtenerDetallePedidoSeleccionado'] = $obtenerDetallePedidoSeleccionado;
        //obtener el total del pedido seleccionado segun idpedido
        $obtenerTotalPedidoSeleccionado = $this->Pedidos_modelo->obtenerTotalPedidoSeleccionado($idpedido);
        $data['obtenerTotalPedidoSeleccionado'] = $obtenerTotalPedidoSeleccionado;
        $data ["contenido_principal"] = "pedidos/eliminar_pedidos_pendientes";
        $data ["titulo"] = "Eliminación de Pedidos Pendientes";
        $this->load->view("includes/template_cliente", $data);
    }
    
    function eliminarPedidoPendiente($idpedido) {
        //mandando el estilo del menu activo
        $menu_activo = 'active';
        $data['menu_activo_cliente'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'activo';
        $data['item_activo_clientes_pedidos_pendientes'] = $item_activo;
        $eliminarPedido = $this->Pedidos_modelo->eliminarPedido($idpedido);
        if ($eliminarPedido) {
            $data ["Mensaje_Pedido_Eliminado"] = 'Pedido eliminado';
        } else {
            $data ["Mensaje_Pedido_Eliminado"] = '';
        }
        //obtener pedidos existentes
        $obtenerPedidos = $this->Pedidos_modelo->obtenerPedidos();
        $data['obtenerPedidos'] = $obtenerPedidos;
        //obtener total de registros en tabla pedidos
        $obtenerTotalPedidos = $this->Pedidos_modelo->obtenerTotalPedidos();
        $data['obtenerTotalPedidos'] = $obtenerTotalPedidos;
        //cargando la vista y enviando datos
        $data ["contenido_principal"] = "pedidos/mantenimiento_pedidos_pendientes";
        $data ["titulo"] = "Administración de Pedidos Pendientes";
        $this->load->view("includes/template_cliente", $data);
    }

}