<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Promociones extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->_si_esta_logueado();
        $this->load->helper('form');
        $this->load->model('Promociones_modelo');
        $this->load->library('form_validation');
    }
    
    function _si_esta_logueado() {
        $si_esta_logueado = $this->session->userdata('esta_logueado');
        $idAdministradores = $this->session->userdata('idAdministrador');
        if ($si_esta_logueado != TRUE OR $idAdministradores == '') {
            redirect('administracion/loguearse');
        }
    }

    function mantenimiento_promociones() {
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_descuento'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo'; $data['item_activo_descuento_promocion'] = $item_activo;
        //obtener productos con promocion existentes
        $obtenerProductosPromocion = $this->Promociones_modelo->obtenerProductosPromocion();
        $data['obtenerProductosPromocion'] = $obtenerProductosPromocion;
        //obtener total de registros en tabla productos con promocion
        $obtenerTotalProductosPromocion = $this->Promociones_modelo->obtenerTotalProductosPromocion();
        $data['obtenerTotalProductosPromocion'] = $obtenerTotalProductosPromocion;
        //cargando la vista y enviando datos
        $data ["contenido_principal"] = "descuentos/mantenimiento_descuentos";
        $data ["titulo"] = "Administración de Descuentos";
        $this->load->view("includes/template_descuento", $data);
    }
    
    function buscar_promocion() {
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_descuento'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo'; $data['item_activo_descuento_promocion'] = $item_activo;
        //reglas de validacion
        $this->form_validation->set_rules('nombre_producto_buscar', 'Producto', 'trim|required');
        $this->form_validation->set_message('required', 'El campo %s es requerido');
        if ($this->form_validation->run() == FALSE) {
            $this->mantenimiento_promociones();
        } else {
            $nombre = $this->input->post('nombre_producto_buscar');
            $buscarPromociones = $this->Promociones_modelo->buscarPromocionesPorNombre($nombre);
            if ($buscarPromociones) {
                $data['obtenerPromocionesPorNombre'] = $buscarPromociones;
                //si existen resultados de la busqueda se cuentan cuantos registros hay
                $obtenerTotalPromocionesBusqueda = $this->Promociones_modelo->obtenerTotalPromocionesBuscarPorNombre($nombre);
                $data['obtenerTotalPromocionesBusqueda'] = $obtenerTotalPromocionesBusqueda;
            } else {
                $data['obtenerPromocionesPorNombre'] = '';
            }
            //cargando la vista y enviando datos
            $data['parametroPromocionBusqueda'] = $nombre;
            $data ["contenido_principal"] = "descuentos/mantenimiento_descuentos";
            $data ["titulo"] = "Administración de Descuentos";
            $this->load->view("includes/template_descuento", $data);
        }
    }
    
    function crear_promocion() {
        //mandando el estilo del menu activo
        $menu_activo = 'active';
        $data['menu_activo_descuento'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo';
        $data['item_activo_descuento_promocion'] = $item_activo;
        //obtener productos existentes para combo
        $obtenerProductos = $this->Promociones_modelo->obtenerProductos();
        $data['obtenerProductos'] = $obtenerProductos;
        //obtener productos con promocion existentes
        $obtenerProductosPromocion = $this->Promociones_modelo->obtenerProductosPromocion();
        $data['obtenerProductosPromocion'] = $obtenerProductosPromocion;
        //obtener total de registros en tabla productos con promocion
        $obtenerTotalProductosPromocion = $this->Promociones_modelo->obtenerTotalProductosPromocion();
        $data['obtenerTotalProductosPromocion'] = $obtenerTotalProductosPromocion;
        //cargando la vista y enviando datos
        $data ["contenido_principal"] = "descuentos/crear_descuentos";
        $data ["titulo"] = "Creación de Descuentos";
        $this->load->view("includes/template_descuento", $data);
    }
    
    function crearPromocion() {
        //mandando el estilo del menu activo
        $menu_activo = 'active';
        $data['menu_activo_descuento'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo';
        $data['item_activo_descuento_promocion'] = $item_activo;
        //reglas de validacion
        $this->form_validation->set_rules('cmb_promocion', 'Producto', 'callback__verificarProducto');
        $this->form_validation->set_rules('precio_producto_entero', 'Precio (Valor Entero)', 'trim|required|numeric|integer');
        $this->form_validation->set_rules('precio_producto_decimal', 'Precio (Valor Decimal)', 'trim|required|numeric|integer');
        $this->form_validation->set_message('required', 'El campo %s es requerido');
        $this->form_validation->set_message('numeric', 'El campo %s debe tener solo caracteres numéricos');
        $this->form_validation->set_message('integer', 'El campo %s debe tener solo números enteros');
        $this->form_validation->set_message('_verificarProducto', 'Por favor seleccione una producto');
        if ($this->form_validation->run() == FALSE) {
            $this->crear_promocion();
        } else {
            $producto = $this->input->post('cmb_promocion');
            $precio = $this->input->post('precio_producto_entero').'.'.$this->input->post('precio_producto_decimal');
            $crearPromocion = $this->Promociones_modelo->crearPromocion($producto, $precio);
            if ($crearPromocion) {
                $data ["Mensaje_Promocion_Creada"] = 'Promocion Creada';
            } else {
                $data ["Mensaje_Promocion_Creada"] = '';
            }
            //obtener productos con promocion existentes
            $obtenerProductosPromocion = $this->Promociones_modelo->obtenerProductosPromocion();
            $data['obtenerProductosPromocion'] = $obtenerProductosPromocion;
            //obtener total de registros en tabla productos con promocion
            $obtenerTotalProductosPromocion = $this->Promociones_modelo->obtenerTotalProductosPromocion();
            $data['obtenerTotalProductosPromocion'] = $obtenerTotalProductosPromocion;
            //cargando la vista y enviando datos
            $data ["contenido_principal"] = "descuentos/mantenimiento_descuentos";
            $data ["titulo"] = "Administración de Descuentos";
            $this->load->view("includes/template_descuento", $data);
        }
    }
    
    function _verificarProducto($id) {
        if ($id != 0) {
            return true;
        } else {
            return false;
        }
    }
    
    function actualizar_promocion($idproducto) {
        //mandando el estilo del menu activo
        $menu_activo = 'active';
        $data['menu_activo_descuento'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo';
        $data['item_activo_descuento_promocion'] = $item_activo;
        //obtener la promocion seleccionada segun idproductos
        $obtenerPromocionSeleccionada = $this->Promociones_modelo->obtenerPromocionSeleccionada($idproducto);
        $data['obtenerPromocionSeleccionada'] = $obtenerPromocionSeleccionada;
        //obtener promocion seleccionada
        $obtenerProductosPromocion = $this->Promociones_modelo->obtenerPromocionSeleccionada($idproducto);
        $data['obtenerProductosPromocion'] = $obtenerProductosPromocion;
        //cargando la vista y enviando datos
        $data ["contenido_principal"] = "descuentos/actualizar_descuentos";
        $data ["titulo"] = "Actualización de Descuentos";
        $this->load->view("includes/template_descuento", $data);
    }
    
    function actualizar_promocion_repoblar_textbox($idproducto) {
        //mandando el estilo del menu activo
        $menu_activo = 'active';
        $data['menu_activo_descuento'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo';
        $data['item_activo_descuento_promocion'] = $item_activo;
        //obtener la promocion seleccionada segun idproductos
        $obtenerDatosPromocionSeleccionada = $this->Promociones_modelo->obtenerPromocionSeleccionada($idproducto);
        $data['obtenerDatosPromocionSeleccionada'] = $obtenerDatosPromocionSeleccionada;
        //obtener promocion seleccionada
        $obtenerProductosPromocion = $this->Promociones_modelo->obtenerPromocionSeleccionada($idproducto);
        $data['obtenerProductosPromocion'] = $obtenerProductosPromocion;
        //cargando la vista y enviando datos
        $data ["contenido_principal"] = "descuentos/actualizar_descuentos";
        $data ["titulo"] = "Actualización de Descuentos";
        $this->load->view("includes/template_descuento", $data);
    }
    
    function actualizarPromocion() {
        //mandando el estilo del menu activo
        $menu_activo = 'active';
        $data['menu_activo_descuento'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo';
        $data['item_activo_descuento_promocion'] = $item_activo;
        $id_producto_seleccionado = $this->input->post('id_promocion_seleccionado');
        //reglas de validacion
        $this->form_validation->set_rules('precio_producto_entero', 'Precio (Valor Entero)', 'trim|required|numeric|integer');
        $this->form_validation->set_rules('precio_producto_decimal', 'Precio (Valor Decimal)', 'trim|required|numeric|integer');
        $this->form_validation->set_message('required', 'El campo %s es requerido');
        $this->form_validation->set_message('numeric', 'El campo %s debe tener solo caracteres numéricos');
        $this->form_validation->set_message('integer', 'El campo %s debe tener solo números enteros');
        if ($this->form_validation->run() == FALSE) {
            $this->actualizar_promocion_repoblar_textbox($id_producto_seleccionado);
        } else {
            $precio = $this->input->post('precio_producto_entero').'.'.$this->input->post('precio_producto_decimal');
            $actualizarPromocion = $this->Promociones_modelo->actualizarPromocion($id_producto_seleccionado, $precio);
            if ($actualizarPromocion) {
                $data ["Mensaje_Promocion_Actualizada"] = 'Promocion Actualizada';
            } else {
                $data ["Mensaje_Promocion_Actualizada"] = '';
            }
            //obtener productos con promocion existentes
            $obtenerProductosPromocion = $this->Promociones_modelo->obtenerProductosPromocion();
            $data['obtenerProductosPromocion'] = $obtenerProductosPromocion;
            //obtener total de registros en tabla productos con promocion
            $obtenerTotalProductosPromocion = $this->Promociones_modelo->obtenerTotalProductosPromocion();
            $data['obtenerTotalProductosPromocion'] = $obtenerTotalProductosPromocion;
            //cargando la vista y enviando datos
            $data ["contenido_principal"] = "descuentos/mantenimiento_descuentos";
            $data ["titulo"] = "Administración de Descuentos";
            $this->load->view("includes/template_descuento", $data);
        }
    }
    
//    function eliminar_promociones($idproductos) {
//        //mandando el estilo del menu activo
//        $menu_activo = 'active';
//        $data['menu_activo_descuento'] = $menu_activo;
//        //mandando el estilo del item activo
//        $item_activo = 'enlace_activo';
//        $data['item_activo_descuento_promocion'] = $item_activo;
//        //obtener promocion seleccionada
//        $obtenerProductosPromocion = $this->Promociones_modelo->obtenerPromocionSeleccionada($idproductos);
//        $data['obtenerProductosPromocion'] = $obtenerProductosPromocion;
//        //idproducto actual
//        $data['idProductoActual'] = $idproductos;
//        //cargando la vista y enviando datos
//        $data ["contenido_principal"] = "descuentos/eliminar_descuentos";
//        $data ["titulo"] = "Eliminación de Descuentos";
//        $this->load->view("includes/template_descuento", $data);
//    }
    
    function eliminarPromocion($idproductos) {
        //mandando el estilo del menu activo
        $menu_activo = 'active';
        $data['menu_activo_descuento'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo';
        $data['item_activo_descuento_promocion'] = $item_activo;
        $eliminarPromocion = $this->Promociones_modelo->eliminarPromocion($idproductos);
            if ($eliminarPromocion) {
                $data ["Mensaje_Promocion_Eliminada"] = 'Promocion Eliminada';
            } else {
                $data ["Mensaje_Promocion_Eliminada"] = '';
            }
        //obtener productos con promocion existentes
        $obtenerProductosPromocion = $this->Promociones_modelo->obtenerProductosPromocion();
        $data['obtenerProductosPromocion'] = $obtenerProductosPromocion;
        //obtener total de registros en tabla productos con promocion
        $obtenerTotalProductosPromocion = $this->Promociones_modelo->obtenerTotalProductosPromocion();
        $data['obtenerTotalProductosPromocion'] = $obtenerTotalProductosPromocion;
        //cargando la vista y enviando datos
        $data ["contenido_principal"] = "descuentos/mantenimiento_descuentos";
        $data ["titulo"] = "Administración de Descuentos";
        $this->load->view("includes/template_descuento", $data);
    }
    
}