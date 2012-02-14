<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Parroquias extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->_si_esta_logueado();
        $this->load->helper('form');
        $this->load->model('Parroquias_modelo');
        $this->load->library('form_validation');
        $this->load->library('pagination');
    }
    
    function _si_esta_logueado() {
        $si_esta_logueado = $this->session->userdata('esta_logueado');
        $idAdministradores = $this->session->userdata('idAdministrador');
        if ($si_esta_logueado != TRUE OR $idAdministradores == '') {
            redirect('administracion/loguearse');
        }
    }
    
    function mantenimiento_parroquias(){
        //parametros para la paginacion
        $config['base_url'] = base_url() . '/parroquias/mantenimiento_parroquias';
        $config['total_rows'] = $this->Parroquias_modelo->totalParroquias();
        $config['per_page'] = 10; //Numero de registros mostrados por páginas
        $this->pagination->initialize($config);
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_localizacion'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo'; $data['item_activo_localizacion_parroquias'] = $item_activo;
        //obtener parroquias existentes con resultados paginados
        $obtenerParroquias = $this->Parroquias_modelo->obtenerParroquiasPaginacion($config['per_page'],$this->uri->segment(3));
        $data['obtenerParroquias'] = $obtenerParroquias;
        //obtener total de registros en tabla parroquias
        $obtenerTotalParroquias = $this->Parroquias_modelo->obtenerTotalParroquias();
        $data['obtenerTotalParroquias'] = $obtenerTotalParroquias;
        //cargando vista asociada
        $data ["contenido_principal"] = "parroquias/mantenimiento_parroquias";
        $data ["titulo"] = "Administración de Parroquias";
        $this->load->view("includes/template_localizacion", $data);
    }
    
    function buscar_parroquia() {
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_localizacion'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo'; $data['item_activo_localizacion_parroquias'] = $item_activo;
        //reglas y mensajes de validacion
        $this->form_validation->set_rules('nombre_parroquia_buscar', 'Nombre', 'trim|required');
        $this->form_validation->set_message('required', 'El campo %s es requerido');
        if ($this->form_validation->run() == FALSE) {
            $this->mantenimiento_parroquias();
        } else {
            $nombre = $this->input->post('nombre_parroquia_buscar');
            $buscarParroquias = $this->Parroquias_modelo->buscarParroquiasPorNombre($nombre);
            if ($buscarParroquias) {
                $data['obtenerParroquiasPorNombre'] = $buscarParroquias;
                //si existen resultados de la busqueda se cuentan cuantos registros hay
                $obtenerTotalParroquiasBusqueda = $this->Parroquias_modelo->obtenerTotalParroquiasBuscarPorNombre($nombre);
                $data['obtenerTotalParroquiasBusqueda'] = $obtenerTotalParroquiasBusqueda;
            } else {
                $data['obtenerParroquiasPorNombre'] = '';
            }
            //cargando la vista y enviando datos del resultado de la busqueda
            $data['parametroParroquiaBusqueda'] = $nombre;
            $data ["contenido_principal"] = "parroquias/mantenimiento_parroquias";
            $data ["titulo"] = "Búsqueda de Parroquias";
            $this->load->view("includes/template_localizacion", $data);
        }
    }
    
    function crear_parroquias() {
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_localizacion'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo'; $data['item_activo_localizacion_parroquias'] = $item_activo;
        //parametros para la paginacion
        $config['base_url'] = base_url() . '/parroquias/mantenimiento_parroquias';
        $config['total_rows'] = $this->Parroquias_modelo->totalParroquias();
        $config['per_page'] = 10; //Numero de registros mostrados por páginas
        $this->pagination->initialize($config);
        //obtener parroquias existentes con paginacion
        $obtenerParroquias = $this->Parroquias_modelo->obtenerParroquiasPaginacion($config['per_page'],$this->uri->segment(3));
        $data['obtenerParroquias'] = $obtenerParroquias;
        //obtener total de registros en tabla parroquias
        $obtenerTotalParroquias = $this->Parroquias_modelo->obtenerTotalParroquias();
        $data['obtenerTotalParroquias'] = $obtenerTotalParroquias;
        //cargando combo de ciudades
        $obtenerCiudadesCombo = $this->Parroquias_modelo->obtenerCiudades();
        $data['obtenerCiudadesCombo'] = $obtenerCiudadesCombo;
        //cargando vista asociada
        $data ["contenido_principal"] = "parroquias/crear_parroquias";
        $data ["titulo"] = "Creación de Parroquias";
        $this->load->view("includes/template_localizacion", $data);
    }
    
    function crearParroquia() {
        //mandando el estilo del menu activo
        $menu_activo = 'active';
        $data['menu_activo_localizacion'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo';
        $data['item_activo_localizacion_parroquias'] = $item_activo;
        //reglas de validacion
        $this->form_validation->set_rules('nombre_parroquia_crear', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('cmb_ciudad', 'Ciudad', 'callback__verificarCiudad');
        $this->form_validation->set_message('required', 'El campo %s es requerido');
        $this->form_validation->set_message('_verificarCiudad', 'Por favor seleccione una ciudad');
        if ($this->form_validation->run() == FALSE) {
            $this->crear_parroquias();
        } else {
            $nombre = $this->input->post('nombre_parroquia_crear');
            $ciudad = $this->input->post('cmb_ciudad');
            $crearParroquia = $this->Parroquias_modelo->crearParroquia($nombre, $ciudad);
            if ($crearParroquia) {
                $data ["Mensaje_Parroquia_Creada"] = 'Parroquia Creada';
            } else {
                $data ["Mensaje_Parroquia_Creada"] = '';
            }
            //obtener parroquias existentes
            $obtenerParroquias = $this->Parroquias_modelo->obtenerParroquias();
            $data['obtenerParroquias'] = $obtenerParroquias;
            //obtener total de registros en tabla parroquias
            $obtenerTotalParroquias = $this->Parroquias_modelo->obtenerTotalParroquias();
            $data['obtenerTotalParroquias'] = $obtenerTotalParroquias;
            //cargando vista asociada
            $data ["contenido_principal"] = "parroquias/mantenimiento_parroquias";
            $data ["titulo"] = "Administración de Parroquias";
            $this->load->view("includes/template_localizacion", $data);
        }
    }
    
    function _verificarCiudad($id) {
        if ($id != 0) {
            return true;
        } else {
            return false;
        }
    }
    
    function actualizar_parroquias($idparroquias) {
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_localizacion'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo'; $data['item_activo_localizacion_parroquias'] = $item_activo;
        //cargando combo de ciudades
        $obtenerCiudadesCombo = $this->Parroquias_modelo->obtenerCiudades();
        $data['obtenerCiudadesCombo'] = $obtenerCiudadesCombo;
        //obtener la parroquia seleccionada segun idparroquias
        $obtenerParroquiaSeleccionada = $this->Parroquias_modelo->obtenerParroquiaSeleccionada($idparroquias);
        $data['obtenerParroquiaSeleccionada'] = $obtenerParroquiaSeleccionada;
        $data ["contenido_principal"] = "parroquias/actualizar_parroquias";
        $data ["titulo"] = "Actualización de Parroquias";
        $this->load->view("includes/template_localizacion", $data);
    }

    function actualizarParroquia() {
        //mandando el estilo del menu activo
        $menu_activo = 'active';
        $data['menu_activo_localizacion'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo';
        $data['item_activo_localizacion_parroquias'] = $item_activo;
        $id_parroquia_seleccionada = $this->input->post('id_parroquia_seleccionada');
        $this->form_validation->set_rules('nombre_parroquia_actualizar', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('cmb_ciudad', 'Ciudad', 'callback__verificarCiudad');
        $this->form_validation->set_message('required', 'El campo %s es requerido');
        $this->form_validation->set_message('_verificarCiudad', 'Por favor seleccione una ciudad');
        if ($this->form_validation->run() == FALSE) {
            $this->actualizar_parroquias($id_parroquia_seleccionada);
        } else {
            $nombre = $this->input->post('nombre_parroquia_actualizar');
            $ciudad = $this->input->post('cmb_ciudad');
            $actualizarParroquia = $this->Parroquias_modelo->actualizarParroquia($id_parroquia_seleccionada, $nombre, $ciudad);
            if ($actualizarParroquia) {
                $data ["Mensaje_Parroquia_Actualizada"] = 'Parroquia Actualizada';
            } else {
                $data ["Mensaje_Parroquia_Actualizada"] = '';
            }
            //obtener parroquias existentes
            $obtenerParroquias = $this->Parroquias_modelo->obtenerParroquias();
            $data['obtenerParroquias'] = $obtenerParroquias;
            //obtener total de registros en tabla parroquias
            $obtenerTotalParroquias = $this->Parroquias_modelo->obtenerTotalParroquias();
            $data['obtenerTotalParroquias'] = $obtenerTotalParroquias;
            //cargando vista asociada
            $data ["contenido_principal"] = "parroquias/mantenimiento_parroquias";
            $data ["titulo"] = "Administración de Parroquias";
            $this->load->view("includes/template_localizacion", $data);
        }
    }
    
    function actualizar_estado($idparroquia, $estado) {
        //mandando el estilo del menu activo
        $menu_activo = 'active';
        $data['menu_activo_localizacion'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo';
        $data['item_activo_localizacion_parroquias'] = $item_activo;
        if ($estado == 0) {
            $actualizarEstado = $this->Parroquias_modelo->actualizarEstado($idparroquia, 1);
            if ($actualizarEstado) {
                $data ["Mensaje_Parroquia_Estado"] = 'Estado Actualizado';
            } else {
                $data ["Mensaje_Parroquia_Estado"] = '';
            }
        }
        if ($estado == 1) {
            $actualizarEstado = $this->Parroquias_modelo->actualizarEstado($idparroquia, 0);
            if ($actualizarEstado) {
                $data ["Mensaje_Parroquia_Estado"] = 'Estado Actualizado';
            } else {
                $data ["Mensaje_Parroquia_Estado"] = '';
            }
        }
        //parametros para la paginacion
        $config['base_url'] = base_url() . '/parroquias/mantenimiento_parroquias';
        $config['total_rows'] = $this->Parroquias_modelo->totalParroquias();
        $config['per_page'] = 10; //Numero de registros mostrados por páginas
        $this->pagination->initialize($config);
        //obtener parroquias existentes con resultados paginados
        $obtenerParroquias = $this->Parroquias_modelo->obtenerParroquiasPaginacion($config['per_page'],$this->uri->segment(2));
        $data['obtenerParroquias'] = $obtenerParroquias;
        //obtener total de registros en tabla parroquias
        $obtenerTotalParroquias = $this->Parroquias_modelo->obtenerTotalParroquias();
        $data['obtenerTotalParroquias'] = $obtenerTotalParroquias;
        //cargando vista asociada
        $data ["contenido_principal"] = "parroquias/mantenimiento_parroquias";
        $data ["titulo"] = "Administración de Parroquias";
        $this->load->view("includes/template_localizacion", $data);
    }
}