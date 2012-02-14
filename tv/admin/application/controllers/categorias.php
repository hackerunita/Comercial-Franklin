<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Categorias extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->_si_esta_logueado();
        $this->load->helper('form');
        $this->load->model('Categorias_modelo');
        $this->load->library('form_validation');
    }
    
    function _si_esta_logueado() {
        $si_esta_logueado = $this->session->userdata('esta_logueado');
        $idAdministradores = $this->session->userdata('idAdministrador');
        if ($si_esta_logueado != TRUE OR $idAdministradores == '') {
            redirect('administracion/loguearse');
        }
    }

    function mantenimiento_categorias() {
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_catalogo'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo'; $data['item_activo_inicio_categorias'] = $item_activo;
        //obtener categorias existentes
        $obtenerCategorias = $this->Categorias_modelo->obtenerCategorias();
        $data['obtenerCategorias'] = $obtenerCategorias;
        //obtener total de registros en tabla categorias
        $obtenerTotalCategorias = $this->Categorias_modelo->obtenerTotalCategorias();
        $data['obtenerTotalCategorias'] = $obtenerTotalCategorias;
        //cargando la vista y enviando datos
        $data ["contenido_principal"] = "categorias/mantenimiento_categorias";
        $data ["titulo"] = "Administración de Categorias";
        $this->load->view("includes/template_catalogo", $data);
    }

    function crear_categoria() {
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_catalogo'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo'; $data['item_activo_inicio_categorias'] = $item_activo;
        //obtener categorias existentes
        $obtenerCategorias = $this->Categorias_modelo->obtenerCategorias();
        $data['obtenerCategorias'] = $obtenerCategorias;
        //obtener total de registros en tabla categorias
        $obtenerTotalCategorias = $this->Categorias_modelo->obtenerTotalCategorias();
        $data['obtenerTotalCategorias'] = $obtenerTotalCategorias;
        //cargando la vista y enviando datos
        $data ["contenido_principal"] = "categorias/crear_categorias";
        $data ["titulo"] = "Creación de Categorias";
        $this->load->view("includes/template_catalogo", $data);
    }

    function crearCategoria() {
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_catalogo'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo'; $data['item_activo_inicio_categorias'] = $item_activo;
        $this->form_validation->set_rules('nombre_categoria', 'Nombre', 'trim|required');
        $this->form_validation->set_message('required', 'El campo %s es requerido');
        if ($this->form_validation->run() == FALSE) {
            $this->crear_categoria();
        } else {
            $nombre = $this->input->post('nombre_categoria');
            $crearCategoria = $this->Categorias_modelo->crearCategoria($nombre);
            if ($crearCategoria) {
                $data ["Mensaje_Categoria_Creada"] = 'Categoria Creada';
            } else {
                $data ["Mensaje_Categoria_Creada"] = '';
            }
            //obtener categorias existentes
            $obtenerCategorias = $this->Categorias_modelo->obtenerCategorias();
            $data['obtenerCategorias'] = $obtenerCategorias;
            //obtener total de registros en tabla categorias
            $obtenerTotalCategorias = $this->Categorias_modelo->obtenerTotalCategorias();
            $data['obtenerTotalCategorias'] = $obtenerTotalCategorias;
            //cargando la vista y enviando datos
            $data ["contenido_principal"] = "categorias/mantenimiento_categorias";
            $data ["titulo"] = "Administración de Categorias";
            $this->load->view("includes/template_catalogo", $data);
        }
    }

    function buscarCategoria() {
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_catalogo'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo'; $data['item_activo_inicio_categorias'] = $item_activo;
        $this->form_validation->set_rules('nombre_categoria', 'Nombre', 'trim|required');
        $this->form_validation->set_message('required', 'El campo %s es requerido');
        if ($this->form_validation->run() == FALSE) {
            $this->mantenimiento_categorias();
        } else {
            $nombre = $this->input->post('nombre_categoria');
            $buscarCategorias = $this->Categorias_modelo->buscarCategoriasPorNombre($nombre);
            if ($buscarCategorias) {
                $data['obtenerCategoriasPorNombre'] = $buscarCategorias;
                //si existen resultados de la busqueda se cuentan cuantos registros hay
                $obtenerTotalCategoriasBusqueda = $this->Categorias_modelo->obtenerTotalCategoriasBuscarPorNombre($nombre);
                $data['obtenerTotalCategoriasBusqueda'] = $obtenerTotalCategoriasBusqueda;
            } else {
                $data['obtenerCategoriasPorNombre'] = '';
            }
            //cargando la vista y enviando datos del resultado de la busqueda
            $data['parametroCategoriaBusqueda'] = $nombre;
            $data ["contenido_principal"] = "categorias/mantenimiento_categorias";
            $data ["titulo"] = "Búsqueda de Categorias";
            $this->load->view("includes/template_catalogo", $data);
        }
    }

    function actualizarCategoria($idcategoria) {
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_catalogo'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo'; $data['item_activo_inicio_categorias'] = $item_activo;
        //obtener la categoria seleccionada segun idcategorias
        $obtenerCategoriaSeleccionada = $this->Categorias_modelo->obtenerCategoriaSeleccionada($idcategoria);
        $data['obtenerCategoriaSeleccionada'] = $obtenerCategoriaSeleccionada;
        $data ["contenido_principal"] = "categorias/actualizar_categorias";
        $data ["titulo"] = "Actualización de Categorias";
        $this->load->view("includes/template_catalogo", $data);
    }

    function actualizar_categorias() {
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_catalogo'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo'; $data['item_activo_inicio_categorias'] = $item_activo;
        $id_categoria_seleccionada = $this->input->post('id_categoria_seleccionada');
        $this->form_validation->set_rules('nombre_categoria', 'Nombre', 'trim|required');
        $this->form_validation->set_message('required', 'El campo %s es requerido');
        if ($this->form_validation->run() == FALSE) {
            //redirect('categorias/actualizarCategoria/'.$id_categoria_seleccionada);
            $this->actualizarCategoria($id_categoria_seleccionada);
        } else {
            $nombre = $this->input->post('nombre_categoria');
            $actualizarCategoria = $this->Categorias_modelo->actualizarCategoria($id_categoria_seleccionada, $nombre);
            if ($actualizarCategoria) {
                $data ["Mensaje_Categoria_Actualizada"] = 'Categoria Actualizada';
            } else {
                $data ["Mensaje_Categoria_Actualizada"] = '';
            }
            //obtener categorias existentes
            $obtenerCategorias = $this->Categorias_modelo->obtenerCategorias();
            $data['obtenerCategorias'] = $obtenerCategorias;
            //obtener total de registros en tabla categorias
            $obtenerTotalCategorias = $this->Categorias_modelo->obtenerTotalCategorias();
            $data['obtenerTotalCategorias'] = $obtenerTotalCategorias;
            //cargando la vista y enviando datos de la actualizacion de la categoria
            $data ["contenido_principal"] = "categorias/mantenimiento_categorias";
            $data ["titulo"] = "Administración de Categorias";
            $this->load->view("includes/template_catalogo", $data);
        }
    }
    
    function actualizar_estado($idcategoria, $estado) {
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_catalogo'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo'; $data['item_activo_inicio_categorias'] = $item_activo;
        if ($estado == 0) {
            $actualizarEstado = $this->Categorias_modelo->actualizarEstado($idcategoria, 1);
            if ($actualizarEstado) {
                $data ["Mensaje_Categoria_Estado"] = 'Estado Actualizado';
            } else {
                $data ["Mensaje_Categoria_Estado"] = '';
            }
        }
        if ($estado == 1) {
            $actualizarEstado = $this->Categorias_modelo->actualizarEstado($idcategoria, 0);
            if ($actualizarEstado) {
                $data ["Mensaje_Categoria_Estado"] = 'Estado Actualizado';
            } else {
                $data ["Mensaje_Categoria_Estado"] = '';
            }
        }
        //obtener categorias existentes
        $obtenerCategorias = $this->Categorias_modelo->obtenerCategorias();
        $data['obtenerCategorias'] = $obtenerCategorias;
        //obtener total de registros en tabla categorias
        $obtenerTotalCategorias = $this->Categorias_modelo->obtenerTotalCategorias();
        $data['obtenerTotalCategorias'] = $obtenerTotalCategorias;
        //cargando la vista y enviando datos de la actualizacion de la categoria
        $data ["contenido_principal"] = "categorias/mantenimiento_categorias";
        $data ["titulo"] = "Administración de Categorias";
        $this->load->view("includes/template_catalogo", $data);
    }
    
//    function eliminar_categoria($idcategoria){
//        //obtener la categoria seleccionada segun idcategorias
//        $obtenerCategoriaSeleccionada = $this->Categorias_modelo->obtenerCategoriaSeleccionada($idcategoria);
//        $data['obtenerCategoriaSeleccionada'] = $obtenerCategoriaSeleccionada;
//        $data['idCategoriaSeleccionada'] = $idcategoria;
//        $data ["contenido_principal"] = "categorias/eliminar_categorias";
//        $data ["titulo"] = "Eliminación de Categorias";
//        $this->load->view("includes/template", $data);
//    }
//
//    function eliminarCategoria($idcategoria) {
//        $eliminarCategoria = $this->Categorias_modelo->eliminarCategoria($idcategoria);
//        if ($eliminarCategoria) {
//            $data ["Mensaje_Categoria_Eliminada"] = 'Categoria Eliminada';
//        } else {
//            $data ["Mensaje_Categoria_Eliminada"] = '';
//        }
//        //obtener categorias existentes
//        $obtenerCategorias = $this->Categorias_modelo->obtenerCategorias();
//        $data['obtenerCategorias'] = $obtenerCategorias;
//        //obtener total de registros en tabla categorias
//        $obtenerTotalCategorias = $this->Categorias_modelo->obtenerTotalCategorias();
//        $data['obtenerTotalCategorias'] = $obtenerTotalCategorias;
//        //cargando la vista y enviando datos de la actualizacion de la categoria
//        $data ["contenido_principal"] = "categorias/mantenimiento_categorias";
//        $data ["titulo"] = "Administración de Categorias";
//        $this->load->view("includes/template", $data);
//    }

}