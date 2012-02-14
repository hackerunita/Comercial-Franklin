<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Productos extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('Productos_modelo');
        $this->load->model('Fabricantes_modelo');
        //$this->load->library('pagination');
    }

    function index() {
        
    }

    function productos() {
        $data['titulo'] = "Listando productos";
        $data ["contenido_principal"] = "productos/listar_productos";
        $this->load->view("includes/template", $data);
    }
    
//    function listar_productos() {
//        $idSubCategoria = $this->input->post('idSubCategoria');
//        if (!empty($idSubCategoria)) {
//            $idSubCategoriaTrabajo = $idSubCategoria;
//            $data = array(
//                'idSubCategoriaTrabajo' => $idSubCategoria
//            );
//            $this->session->set_userdata($data);
//        } else {
//            $idSubCategoriaTrabajo = $this->session->userdata('idSubCategoriaTrabajo');
//        }
//        $listarSubcategoria = $this->Productos_modelo->listarSubcategoria($idSubCategoriaTrabajo);
//        $data = array(
//            'nombreSubCategoria' => $listarSubcategoria[0]->nombre,
//            'idSubCategoria' => $idSubCategoriaTrabajo
//        );
//        //parametros para la paginacion
//        $config['base_url'] = base_url() . '/productos/listar_productos';
//        $config['total_rows'] = $this->Productos_modelo->totalProductos($idSubCategoriaTrabajo);
//        $config['per_page'] = 2; 
//        $config['num_links'] = 2; //Numero de links mostrados en la paginación
//        $this->pagination->initialize($config);
//        $listarProductos = $this->Productos_modelo->listarProductosPaginacion($idSubCategoriaTrabajo, $config['per_page'],$this->uri->segment(3));;
//        if ($listarProductos) {
//            $data['listarProductos'] = $listarProductos;
//            $listarFabricantes = $this->Fabricantes_modelo->listarFrabricantesPorProducto($idSubCategoriaTrabajo);
//            $data['listarFabricantes'] = $listarFabricantes;
//            $data['mensajeProductos'] = "";
//            $data['ordenProducto'] = '';
//            $data['idFabricante'] = '';
//            $data['titulo'] = "Listando productos";
//            $data ["contenido_principal"] = "productos/listar_productos";
//            $this->load->view("includes/template", $data);
//        } else {
//            $data['mensajeProductos'] = "NO HAY PRODUCTOS ASOCIADOS A ESTA SUBCATEGORIA";
//            $data['titulo'] = "Listando productos";
//            $data ["contenido_principal"] = "productos/listar_productos";
//            $this->load->view("includes/template", $data);
//        }
//    }

    function listar_productos($idSubcategoria = '') {
        $listarSubcategoria = $this->Productos_modelo->listarSubcategoria($idSubcategoria);
        $data = array(
            'nombreSubCategoria' => $listarSubcategoria[0]->nombre,
            'idSubCategoria' => $idSubcategoria
        );
        $listarProductos = $this->Productos_modelo->listarProductos($idSubcategoria);
        if ($listarProductos) {
            $data['listarProductos'] = $listarProductos;
            $listarFabricantes = $this->Fabricantes_modelo->listarFrabricantesPorProducto($idSubcategoria);
            $data['listarFabricantes'] = $listarFabricantes;
            $data['mensajeProductos'] = "";
            $data['ordenProducto'] = '';
            $data['idFabricante'] = '';
            $data['titulo'] = "Listando productos";
            $data ["contenido_principal"] = "productos/listar_productos";
            $this->load->view("includes/template", $data);
        } else {
            $data['mensajeProductos'] = "NO HAY PRODUCTOS ASOCIADOS A ESTA SUBCATEGORIA";
            $data['titulo'] = "Listando productos";
            $data ["contenido_principal"] = "productos/listar_productos";
            $this->load->view("includes/template", $data);
        }
    }

    function listar_productos_por_orden($idSubcategoria, $campo, $recibirOrden='', $idFabricante='') {
        $listarProductosEnOrden = $this->Productos_modelo->listarProductosPorOrden($idSubcategoria, $campo, $recibirOrden, $idFabricante);
        $nombreSubcategoria = $this->Productos_modelo->listarSubcategoria($idSubcategoria);
        $data = array(
            'nombreSubCategoria' => $nombreSubcategoria[0]->nombre
        );
        if ($listarProductosEnOrden) {
            $data['idSubCategoria'] = $idSubcategoria;
            $data['ordenProducto'] = $recibirOrden;
            $listarFabricantes = $this->Fabricantes_modelo->listarFrabricantesPorProducto($idSubcategoria);
            $data['listarFabricantes'] = $listarFabricantes;
            $data['listarProductos'] = $listarProductosEnOrden;
            $data['idFabricante'] = $idFabricante;
            $data['titulo'] = "Listando productos por nombre";
            $data ["contenido_principal"] = "productos/listar_productos";
            $this->load->view("includes/template", $data);
        }
    }

    function listar_productos_por_fabricante() {
        $idFabricantes = $this->input->post('fabricantes');
        $idSubCategoria = $this->input->post('idSubCategoria');
        $listarSubcategoria = $this->Productos_modelo->listarSubcategoria($idSubCategoria);
        $data = array(
            'nombreSubCategoria' => $listarSubcategoria[0]->nombre,
            'idSubCategoria' => $idSubCategoria
        );
        $listaProductosPorFabricante = $this->Productos_modelo->listarProductosPorFabricante($idFabricantes, $idSubCategoria);
        if ($listaProductosPorFabricante) {
            $data['listarProductos'] = $listaProductosPorFabricante;
            $listarFabricantes = $this->Fabricantes_modelo->listarFrabricantesPorProducto($idSubCategoria);
            $data['listarFabricantes'] = $listarFabricantes;
            $data['idFabricante'] = $idFabricantes;
            $data['mensajeProductos'] = "";
            $data['ordenProducto'] = '';
            $data['titulo'] = "Lista de productos por fabricante";
            $data ["contenido_principal"] = "productos/listar_productos";
            $this->load->view("includes/template", $data);
        }
    }

    function presentar_producto($idproductos='') {
        $mostrarProducto = $this->Productos_modelo->MostrarProducto($idproductos);
        $imagenesProducto = $this->Productos_modelo->imagenesProductos($idproductos);
        if ($mostrarProducto) {
            $data['mostrarProducto'] = $mostrarProducto;
            $data['imagenesProducto'] = $imagenesProducto;
            $data['titulo'] = "Caracteristicas de producto";
            $data ["contenido_principal"] = "productos/producto";
            $this->load->view("includes/template", $data);
        }
    }
    
    function buscar_productos(){
        /*$direccion = $this->input->post('buscar');
        echo $direccion;*/
        $nombreProducto = $this->input->post('search');
        $listarProductos = $this->Productos_modelo->buscarProductosPorNombre($nombreProducto);
        $data['criterio_de_busqueda'] = $nombreProducto;
        if ($listarProductos) {
            $data['listarProductos'] = $listarProductos;
            $data['titulo'] = "Busqueda de Productos";
            $data ["contenido_principal"] = "productos/busqueda_por_nombre";
            $this->load->view("includes/template", $data);
        } else {
            $data['titulo'] = "Busqueda de Productos";
            $data ["contenido_principal"] = "productos/busqueda_vacio";
            $this->load->view("includes/template", $data);
        }
        
    }

}

?>
