<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Subcategorias extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->_si_esta_logueado();
        $this->load->helper('form');
        $this->load->model('Subcategorias_modelo');
        $this->load->library('form_validation');
    }
    
    function _si_esta_logueado() {
        $si_esta_logueado = $this->session->userdata('esta_logueado');
        $idAdministradores = $this->session->userdata('idAdministrador');
        if ($si_esta_logueado != TRUE OR $idAdministradores == '') {
            redirect('administracion/loguearse');
        }
    }
    
    function mantenimiento_subcategorias(){
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_catalogo'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo'; $data['item_activo_inicio_subcategorias'] = $item_activo;
        //obtener subcategorias existentes
        $obtenerSubCategorias = $this->Subcategorias_modelo->obtenerSubCategorias();
        $data['obtenerSubCategorias'] = $obtenerSubCategorias;
        //obtener total de registros en tabla subcategorias
        $obtenerTotalSubCategorias = $this->Subcategorias_modelo->obtenerTotalSubCategorias();
        $data['obtenerTotalSubCategorias'] = $obtenerTotalSubCategorias;
        //cargando vista asociada
        $data ["contenido_principal"] = "subcategorias/mantenimiento_subcategorias";
        $data ["titulo"] = "Administración de Subcategorias";
        $this->load->view("includes/template_catalogo", $data);
    }
    
    function buscar_subcategoria() {
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_catalogo'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo'; $data['item_activo_inicio_subcategorias'] = $item_activo;
        $this->form_validation->set_rules('nombre_subcategoria', 'Nombre', 'trim|required');
        $this->form_validation->set_message('required', 'El campo %s es requerido');
        if ($this->form_validation->run() == FALSE) {
            $this->mantenimiento_subcategorias();
        } else {
            $nombre = $this->input->post('nombre_subcategoria');
            $buscarSubCategorias = $this->Subcategorias_modelo->buscarSubCategoriasPorNombre($nombre);
            if ($buscarSubCategorias) {
                $data['obtenerSubCategoriasPorNombre'] = $buscarSubCategorias;
                //si existen resultados de la busqueda se cuentan cuantos registros hay
                $obtenerTotalSubCategoriasBusqueda = $this->Subcategorias_modelo->obtenerTotalSubCategoriasBuscarPorNombre($nombre);
                $data['obtenerTotalSubCategoriasBusqueda'] = $obtenerTotalSubCategoriasBusqueda;
            } else {
                $data['obtenerSubCategoriasPorNombre'] = '';
            }
            //cargando la vista y enviando datos del resultado de la busqueda
            $data['parametroSubCategoriaBusqueda'] = $nombre;
            $data ["contenido_principal"] = "subcategorias/mantenimiento_subcategorias";
            $data ["titulo"] = "Búsqueda de SubCategorias";
            $this->load->view("includes/template_catalogo", $data);
        }
    }
    
    function crear_subcategoria() {
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_catalogo'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo'; $data['item_activo_inicio_subcategorias'] = $item_activo;
        //obtener subcategorias existentes
        $obtenerSubCategorias = $this->Subcategorias_modelo->obtenerSubCategorias();
        $data['obtenerSubCategorias'] = $obtenerSubCategorias;
        //obtener total de registros en tabla subcategorias
        $obtenerTotalSubCategorias = $this->Subcategorias_modelo->obtenerTotalSubCategorias();
        $data['obtenerTotalSubCategorias'] = $obtenerTotalSubCategorias;
        //cargando combo de categorias
        $obtenerCategorias = $this->Subcategorias_modelo->obtenerCategorias();
        $data['obtenerCategoriasCombo'] = $obtenerCategorias;
        //cargando la vista y enviando datos
        $data ["contenido_principal"] = "subcategorias/crear_subcategorias";
        $data ["titulo"] = "Creación de SubCategorias";
        $this->load->view("includes/template_catalogo", $data);
    }
    
    function crearSubCategoria() {
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_catalogo'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo'; $data['item_activo_inicio_subcategorias'] = $item_activo;
        $this->form_validation->set_rules('nombre_subcategoria_crear', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('cmb_categoria', 'Categoria', 'callback__verificarCategoria');
        $this->form_validation->set_message('required', 'El campo %s es requerido');
        $this->form_validation->set_message('_verificarCategoria', 'Por favor seleccione una categoria');
        if ($this->form_validation->run() == FALSE) {
            $this->crear_subcategoria();
        } else {
            $nombre = $this->input->post('nombre_subcategoria_crear');
            $categoria = $this->input->post('cmb_categoria');
            $crearSubCategoria = $this->Subcategorias_modelo->crearSubCategoria($nombre, $categoria);
            if ($crearSubCategoria) {
                $data ["Mensaje_Subcategoria_Creada"] = 'SubCategoria Creada';
            } else {
                $data ["Mensaje_Subcategoria_Creada"] = '';
            }
            //obtener subcategorias existentes
            $obtenerSubCategorias = $this->Subcategorias_modelo->obtenerSubCategorias();
            $data['obtenerSubCategorias'] = $obtenerSubCategorias;
            //obtener total de registros en tabla subcategorias
            $obtenerTotalSubCategorias = $this->Subcategorias_modelo->obtenerTotalSubCategorias();
            $data['obtenerTotalSubCategorias'] = $obtenerTotalSubCategorias;
            //cargando la vista y enviando datos
            $data ["contenido_principal"] = "subcategorias/mantenimiento_subcategorias";
            $data ["titulo"] = "Administración de SubCategorias";
            $this->load->view("includes/template_catalogo", $data);
        }
    }
    
    function _verificarCategoria($id) {
        if ($id != 0) {
            return true;
        } else {
            return false;
        }
    }
    
    function actualizar_subcategoria($idsubcategoria) {
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_catalogo'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo'; $data['item_activo_inicio_subcategorias'] = $item_activo;
        //cargando combo de categorias
        $obtenerCategorias = $this->Subcategorias_modelo->obtenerCategorias();
        $data['obtenerCategoriasCombo'] = $obtenerCategorias;
        //obtener la subcategoria seleccionada segun idsubcategorias
        $obtenerSubCategoriaSeleccionada = $this->Subcategorias_modelo->obtenerSubCategoriaSeleccionada($idsubcategoria);
        $data['obtenerSubCategoriaSeleccionada'] = $obtenerSubCategoriaSeleccionada;
        $data ["contenido_principal"] = "subcategorias/actualizar_subcategorias";
        $data ["titulo"] = "Actualización de SubCategorias";
        $this->load->view("includes/template_catalogo", $data);
    }

    function actualizarSubCategoria() {
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_catalogo'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo'; $data['item_activo_inicio_subcategorias'] = $item_activo;
        $id_subcategoria_seleccionada = $this->input->post('id_subcategoria_seleccionada');
        $this->form_validation->set_rules('nombre_categoria_actualizar', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('cmb_categoria', 'Categoria', 'callback__verificarCategoria');
        $this->form_validation->set_message('required', 'El campo %s es requerido');
        $this->form_validation->set_message('_verificarCategoria', 'Por favor seleccione una categoria');
        if ($this->form_validation->run() == FALSE) {
            $this->actualizar_subcategoria($id_subcategoria_seleccionada);
        } else {
            $nombre = $this->input->post('nombre_categoria_actualizar');
            $categoria = $this->input->post('cmb_categoria');
            $actualizarSubCategoria = $this->Subcategorias_modelo->actualizarSubCategoria($id_subcategoria_seleccionada, $nombre, $categoria);
            if ($actualizarSubCategoria) {
                $data ["Mensaje_Subcategoria_Actualizada"] = 'SubCategoria Actualizada';
            } else {
                $data ["Mensaje_Subcategoria_Actualizada"] = '';
            }
            //obtener subcategorias existentes
            $obtenerSubCategorias = $this->Subcategorias_modelo->obtenerSubCategorias();
            $data['obtenerSubCategorias'] = $obtenerSubCategorias;
            //obtener total de registros en tabla subcategorias
            $obtenerTotalSubCategorias = $this->Subcategorias_modelo->obtenerTotalSubCategorias();
            $data['obtenerTotalSubCategorias'] = $obtenerTotalSubCategorias;
            //cargando la vista y enviando datos
            $data ["contenido_principal"] = "subcategorias/mantenimiento_subcategorias";
            $data ["titulo"] = "Administración de SubCategorias";
            $this->load->view("includes/template_catalogo", $data);
        }
    }
    
    function actualizar_estado($idsubcategoria, $estado) {
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_catalogo'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo'; $data['item_activo_inicio_subcategorias'] = $item_activo;
        if ($estado == 0) {
            $actualizarEstado = $this->Subcategorias_modelo->actualizarEstado($idsubcategoria, 1);
            if ($actualizarEstado) {
                $data ["Mensaje_SubCategoria_Estado"] = 'Estado Actualizado';
            } else {
                $data ["Mensaje_SubCategoria_Estado"] = '';
            }
        }
        if ($estado == 1) {
            $actualizarEstado = $this->Subcategorias_modelo->actualizarEstado($idsubcategoria, 0);
            if ($actualizarEstado) {
                $data ["Mensaje_SubCategoria_Estado"] = 'Estado Actualizado';
            } else {
                $data ["Mensaje_SubCategoria_Estado"] = '';
            }
        }
        //obtener subcategorias existentes
        $obtenerSubCategorias = $this->Subcategorias_modelo->obtenerSubCategorias();
        $data['obtenerSubCategorias'] = $obtenerSubCategorias;
        //obtener total de registros en tabla subcategorias
        $obtenerTotalSubCategorias = $this->Subcategorias_modelo->obtenerTotalSubCategorias();
        $data['obtenerTotalSubCategorias'] = $obtenerTotalSubCategorias;
        //cargando la vista y enviando datos
        $data ["contenido_principal"] = "subcategorias/mantenimiento_subcategorias";
        $data ["titulo"] = "Administración de SubCategorias";
        $this->load->view("includes/template_catalogo", $data);
    }
    
//    function eliminar_subcategoria($idsubcategoria){
//        //obtener la categoria seleccionada segun idcategorias
//        $obtenerSubCategoriaSeleccionada = $this->Subcategorias_modelo->obtenerSubCategoriaSeleccionada($idsubcategoria);
//        $data['obtenerSubCategoriaSeleccionada'] = $obtenerSubCategoriaSeleccionada;
//        $data['idSubCategoriaSeleccionada'] = $idsubcategoria;
//        $data ["contenido_principal"] = "subcategorias/eliminar_subcategorias";
//        $data ["titulo"] = "Eliminación de SubCategorias";
//        $this->load->view("includes/template", $data);
//    }
//
//    function eliminarSubCategoria($idsubcategoria) {
//        $eliminarSubCategoria = $this->Subcategorias_modelo->eliminarSubCategoria($idsubcategoria);
//        if ($eliminarSubCategoria) {
//            $data ["Mensaje_Subcategoria_Eliminada"] = 'SubCategoria Eliminada';
//        } else {
//            $data ["Mensaje_Subcategoria_Eliminada"] = '';
//        }
//        //obtener subcategorias existentes
//        $obtenerSubCategorias = $this->Subcategorias_modelo->obtenerSubCategorias();
//        $data['obtenerSubCategorias'] = $obtenerSubCategorias;
//        //obtener total de registros en tabla subcategorias
//        $obtenerTotalSubCategorias = $this->Subcategorias_modelo->obtenerTotalSubCategorias();
//        $data['obtenerTotalSubCategorias'] = $obtenerTotalSubCategorias;
//        //cargando la vista y enviando datos
//        $data ["contenido_principal"] = "subcategorias/mantenimiento_subcategorias";
//        $data ["titulo"] = "Administración de SubCategorias";
//        $this->load->view("includes/template", $data);
//    }
}