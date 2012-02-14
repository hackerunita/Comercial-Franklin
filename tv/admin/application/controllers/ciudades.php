<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ciudades extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->_si_esta_logueado();
        $this->load->helper('form');
        $this->load->model('Ciudades_modelo');
        $this->load->library('form_validation');
    }
    
    function _si_esta_logueado() {
        $si_esta_logueado = $this->session->userdata('esta_logueado');
        $idAdministradores = $this->session->userdata('idAdministrador');
        if ($si_esta_logueado != TRUE OR $idAdministradores == '') {
            redirect('administracion/loguearse');
        }
    }
    
    function mantenimiento_ciudades() {
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_localizacion'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo'; $data['item_activo_localizacion_ciudades'] = $item_activo;
        //obtener ciudades existentes
        $obtenerCiudades = $this->Ciudades_modelo->obtenerCiudades();
        $data['obtenerCiudades'] = $obtenerCiudades;
        //obtener total de registros en tabla ciudades
        $obtenerTotalCiudades = $this->Ciudades_modelo->obtenerTotalCiudades();
        $data['obtenerTotalCiudades'] = $obtenerTotalCiudades;
        //cargando la vista y enviando datos
        $data ["contenido_principal"] = "ciudades/mantenimiento_ciudades";
        $data ["titulo"] = "Administración de Ciudades";
        $this->load->view("includes/template_localizacion", $data);
    }
    
    function buscar_ciudad() {
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_localizacion'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo'; $data['item_activo_localizacion_ciudades'] = $item_activo;
        //reglas y mensajes de validacion
        $this->form_validation->set_rules('nombre_ciudad', 'Nombre', 'trim|required');
        $this->form_validation->set_message('required', 'El campo %s es requerido');
        if ($this->form_validation->run() == FALSE) {
            $this->mantenimiento_ciudades();
        } else {
            $nombre = $this->input->post('nombre_ciudad');
            $buscarCiudades = $this->Ciudades_modelo->buscarCiudadesPorNombre($nombre);
            if ($buscarCiudades) {
                $data['obtenerCiudadesPorNombre'] = $buscarCiudades;
                //si existen resultados de la busqueda se cuentan cuantos registros hay
                $obtenerTotalCiudadesBusqueda = $this->Ciudades_modelo->obtenerTotalCiudadesBuscarPorNombre($nombre);
                $data['obtenerTotalCiudadesBusqueda'] = $obtenerTotalCiudadesBusqueda;
            } else {
                $data['obtenerCiudadesPorNombre'] = '';
            }
            //cargando la vista y enviando datos del resultado de la busqueda
            $data['parametroCiudadBusqueda'] = $nombre;
            $data ["contenido_principal"] = "ciudades/mantenimiento_ciudades";
            $data ["titulo"] = "Búsqueda de Ciudades";
            $this->load->view("includes/template_localizacion", $data);
        }
    }
    
    function crear_ciudades() {
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_localizacion'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo'; $data['item_activo_localizacion_ciudades'] = $item_activo;
        //obtener ciudades existentes
        $obtenerCiudades = $this->Ciudades_modelo->obtenerCiudades();
        $data['obtenerCiudades'] = $obtenerCiudades;
        //obtener total de registros en tabla ciudades
        $obtenerTotalCiudades = $this->Ciudades_modelo->obtenerTotalCiudades();
        $data['obtenerTotalCiudades'] = $obtenerTotalCiudades;
        //cargando la vista y enviando datos
        $data ["contenido_principal"] = "ciudades/crear_ciudades";
        $data ["titulo"] = "Creación de Ciudades";
        $this->load->view("includes/template_localizacion", $data);
    }

    function crearCiudad() {
        //mandando el estilo del menu activo
        $menu_activo = 'active';
        $data['menu_activo_localizacion'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo';
        $data['item_activo_localizacion_ciudades'] = $item_activo;
        //reglas y mensajes de validacion
        $this->form_validation->set_rules('nombre_ciudad_crear', 'Nombre', 'trim|required');
        $this->form_validation->set_message('required', 'El campo %s es requerido');
        if ($this->form_validation->run() == FALSE) {
            $this->crear_ciudades();
        } else {
            $nombre = $this->input->post('nombre_ciudad_crear');
            $crearCiudad = $this->Ciudades_modelo->crearCiudad($nombre);
            if ($crearCiudad) {
                $data ["Mensaje_Ciudad_Creada"] = 'Ciudad Creada';
            } else {
                $data ["Mensaje_Ciudad_Creada"] = '';
            }
            //obtener ciudades existentes
            $obtenerCiudades = $this->Ciudades_modelo->obtenerCiudades();
            $data['obtenerCiudades'] = $obtenerCiudades;
            //obtener total de registros en tabla ciudades
            $obtenerTotalCiudades = $this->Ciudades_modelo->obtenerTotalCiudades();
            $data['obtenerTotalCiudades'] = $obtenerTotalCiudades;
            //cargando la vista y enviando datos
            $data ["contenido_principal"] = "ciudades/mantenimiento_ciudades";
            $data ["titulo"] = "Administración de Ciudades";
            $this->load->view("includes/template_localizacion", $data);
        }
    }
    
    function actualizar_ciudades($idciudad) {
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_localizacion'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo'; $data['item_activo_localizacion_ciudades'] = $item_activo;
        //obtener la ciudad seleccionada segun idciudad
        $obtenerCiudadSeleccionada = $this->Ciudades_modelo->obtenerCiudadSeleccionada($idciudad);
        $data['obtenerCiudadSeleccionada'] = $obtenerCiudadSeleccionada;
        $data ["contenido_principal"] = "ciudades/actualizar_ciudades";
        $data ["titulo"] = "Actualización de Ciudades";
        $this->load->view("includes/template_localizacion", $data);
    }

    function actualizarCiudad() {
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_localizacion'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo'; $data['item_activo_localizacion_ciudades'] = $item_activo;
        $id_categoria_seleccionada = $this->input->post('id_categoria_seleccionada');
        //reglas y mensajes de validacion
        $id_ciudad_actual = $this->input->post('id_ciudad_seleccionada');
        $this->form_validation->set_rules('nombre_ciudad_actualizar', 'Nombre', 'trim|required');
        $this->form_validation->set_message('required', 'El campo %s es requerido');
        if ($this->form_validation->run() == FALSE) {
            $this->actualizar_ciudades($id_ciudad_actual);
        } else {
            $nombre = $this->input->post('nombre_ciudad_actualizar');
            $actualizarCiudad = $this->Ciudades_modelo->actualizarCiudad($id_ciudad_actual, $nombre);
            if ($actualizarCiudad) {
                $data ["Mensaje_Ciudad_Actualizada"] = 'Ciudad Actualizada';
            } else {
                $data ["Mensaje_Ciudad_Actualizada"] = '';
            }
            //obtener ciudades existentes
            $obtenerCiudades = $this->Ciudades_modelo->obtenerCiudades();
            $data['obtenerCiudades'] = $obtenerCiudades;
            //obtener total de registros en tabla ciudades
            $obtenerTotalCiudades = $this->Ciudades_modelo->obtenerTotalCiudades();
            $data['obtenerTotalCiudades'] = $obtenerTotalCiudades;
            //cargando la vista y enviando datos
            $data ["contenido_principal"] = "ciudades/mantenimiento_ciudades";
            $data ["titulo"] = "Administración de Ciudades";
            $this->load->view("includes/template_localizacion", $data);
        }
    }
    
    function actualizar_estado($idciudad, $estado) {
        //mandando el estilo del menu activo
        $menu_activo = 'active';
        $data['menu_activo_localizacion'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo';
        $data['item_activo_localizacion_ciudades'] = $item_activo;
        if ($estado == 0) {
            $actualizarEstado = $this->Ciudades_modelo->actualizarEstado($idciudad, 1);
            if ($actualizarEstado) {
                $data ["Mensaje_Ciudad_Estado"] = 'Estado Actualizado';
            } else {
                $data ["Mensaje_Ciudad_Estado"] = '';
            }
        }
        if ($estado == 1) {
            $actualizarEstado = $this->Ciudades_modelo->actualizarEstado($idciudad, 0);
            if ($actualizarEstado) {
                $data ["Mensaje_Ciudad_Estado"] = 'Estado Actualizado';
            } else {
                $data ["Mensaje_Ciudad_Estado"] = '';
            }
        }
        //obtener ciudades existentes
        $obtenerCiudades = $this->Ciudades_modelo->obtenerCiudades();
        $data['obtenerCiudades'] = $obtenerCiudades;
        //obtener total de registros en tabla ciudades
        $obtenerTotalCiudades = $this->Ciudades_modelo->obtenerTotalCiudades();
        $data['obtenerTotalCiudades'] = $obtenerTotalCiudades;
        //cargando la vista y enviando datos
        $data ["contenido_principal"] = "ciudades/mantenimiento_ciudades";
        $data ["titulo"] = "Administración de Ciudades";
        $this->load->view("includes/template_localizacion", $data);
    }
    
}