<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Productos_imagenes extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->_si_esta_logueado();
        $this->load->helper('form');
        $this->load->model('Productos_imagenes_modelo');
        $this->load->library('form_validation');
        $this->load->library('upload');
    }
    
    function _si_esta_logueado() {
        $si_esta_logueado = $this->session->userdata('esta_logueado');
        $idAdministradores = $this->session->userdata('idAdministrador');
        if ($si_esta_logueado != TRUE OR $idAdministradores == '') {
            redirect('administracion/loguearse');
        }
    }
    
    function mantenimiento_agregar_imagenes(){
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_catalogo'] = $menu_activo;
        //obtener productos existentes
        $obtenerProductos = $this->Productos_imagenes_modelo->obtenerProductos();
        $data['obtenerProductos'] = $obtenerProductos;
        //obtener total de registros en tabla productos
        $obtenerTotalProductos = $this->Productos_imagenes_modelo->obtenerTotalProductos();
        $data['obtenerTotalProductos'] = $obtenerTotalProductos;
        //cargando la vista y enviando datos
        $data ["contenido_principal"] = "productos_imagenes/mantenimiento_agregar_imagenes";
        $data ["titulo"] = "Administración de Imagenes de Productos";
        $this->load->view("includes/template_catalogo", $data);
    }
    
    function buscar_producto() {
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_catalogo'] = $menu_activo;
        $this->form_validation->set_rules('nombre_producto_buscar', 'Nombre', 'trim|required');
        $this->form_validation->set_message('required', 'El campo %s es requerido');
        if ($this->form_validation->run() == FALSE) {
            $this->mantenimiento_agregar_imagenes();
        } else {
            $nombre = $this->input->post('nombre_producto_buscar');
            $buscarProductos = $this->Productos_imagenes_modelo->buscarProductosPorNombre($nombre);
            if ($buscarProductos) {
                $data['obtenerProductosPorNombre'] = $buscarProductos;
                //si existen resultados de la busqueda se cuentan cuantos registros hay
                $obtenerTotalProductosBusqueda = $this->Productos_imagenes_modelo->obtenerTotalProductosBuscarPorNombre($nombre);
                $data['obtenerTotalProductosBusqueda'] = $obtenerTotalProductosBusqueda;
            } else {
                $data['obtenerProductosPorNombre'] = '';
            }
            //cargando la vista y enviando datos
            $data['parametroProductoBusqueda'] = $nombre;
            $data ["contenido_principal"] = "productos_imagenes/mantenimiento_agregar_imagenes";
            $data ["titulo"] = "Administración de Imagenes de Productos";
            $this->load->view("includes/template_catalogo", $data);
        }
    }
    
    function agregar_imagen($idproducto) {
        //mandando mensajes a la columna derecha
        $titulo_aviso = 'Importante!'; $aviso_contenido =  'Recuerde que: El campo "imagen" solo permite subir archivos de este tipo (gif, jpg, png), de un ancho de 1024px y largo 768px y con un tamaño máximo de 200Kb, además su nombre no debe contener caracteres especiales caso contrario la imagen no se subirá al sitio web.';
        $data['titulo_aviso'] = $titulo_aviso; $data['aviso_contenido'] = $aviso_contenido;
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_catalogo'] = $menu_activo;
        //obtener imagenes del producto seleccionado segun idproducto
        $obtenerImagenesProductoSeleccionado = $this->Productos_imagenes_modelo->obtenerImagenesProductoSeleccionado($idproducto);
        $data['obtenerImagenesProductoSeleccionado'] = $obtenerImagenesProductoSeleccionado;
        //obtener el producto seleccionado segun idproducto
        $obtenerProductoSeleccionado = $this->Productos_imagenes_modelo->obtenerProductoSeleccionado($idproducto);
        $data['obtenerProductoSeleccionado'] = $obtenerProductoSeleccionado;
        $data ["contenido_principal"] = "productos_imagenes/agregar_imagenes";
        $data ["titulo"] = "Agregar Imagen de Productos";
        $this->load->view("includes/template_catalogo", $data);
    }
    
    function agregar_imagen_con_error($idproducto, $error_imagen) {
        //mandando mensajes a la columna derecha
        $titulo_aviso = 'Importante!'; $aviso_contenido =  'Recuerde que: El campo "imagen" solo permite subir archivos de este tipo (gif, jpg, png), de un ancho de 1024px y largo 768px y con un tamaño máximo de 200Kb, además su nombre no debe contener caracteres especiales caso contrario la imagen no se subirá al sitio web.';
        $data['titulo_aviso'] = $titulo_aviso; $data['aviso_contenido'] = $aviso_contenido;
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_catalogo'] = $menu_activo;
        $data ["error_imagen"] = $error_imagen;
        //obtener imagenes del producto seleccionado segun idproducto
        $obtenerImagenesProductoSeleccionado = $this->Productos_imagenes_modelo->obtenerImagenesProductoSeleccionado($idproducto);
        $data['obtenerImagenesProductoSeleccionado'] = $obtenerImagenesProductoSeleccionado;
        //obtener el producto seleccionado segun idproducto
        $obtenerProductoSeleccionado = $this->Productos_imagenes_modelo->obtenerProductoSeleccionado($idproducto);
        $data['obtenerProductoSeleccionado'] = $obtenerProductoSeleccionado;
        $data ["contenido_principal"] = "productos_imagenes/agregar_imagenes";
        $data ["titulo"] = "Agregar Imagen de Productos";
        $this->load->view("includes/template_catalogo", $data);
    }
    
    function agregarImagen() {
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_catalogo'] = $menu_activo;
        $id_producto_seleccionado = $this->input->post('id_producto_seleccionado');
        //subiendo la imagen de muestra del producto
        if (!$this->upload->do_upload()) {
            $error_imagen = 'El campo imagen no cumple con los criterios establecidos';
            $this->agregar_imagen_con_error($id_producto_seleccionado, $error_imagen);
        } else {
            //si entra por aqui es cuando ya subio la imagen a la carpeta seleccionada
            $datosImagen = $this->upload->data();
            $nombre_imagen = 'admin/images_productos/' . $datosImagen['file_name'];
            //entonces hay que guardar los datos de la imagen en la tabla productos_imagenes
            $agregarImagenProducto = $this->Productos_imagenes_modelo->agregarImagenProducto($id_producto_seleccionado, $nombre_imagen);
            if ($agregarImagenProducto) {
                $data ["Mensaje_Imagen_Creada"] = 'Imagen Agregada';
            } else {
                $data ["Mensaje_Imagen_Creada"] = '';
            }
            $this->agregar_imagen($id_producto_seleccionado);
        }
    }
    
    function eliminar_imagen($idproducto) {
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_catalogo'] = $menu_activo;
        //obtener imagenes del producto seleccionado segun idproducto
        $obtenerImagenesProductoSeleccionado = $this->Productos_imagenes_modelo->obtenerImagenesProductoSeleccionado($idproducto);
        $data['obtenerImagenesProductoSeleccionado'] = $obtenerImagenesProductoSeleccionado;
        //obtener el producto seleccionado segun idproducto
        $obtenerProductoSeleccionado = $this->Productos_imagenes_modelo->obtenerProductoSeleccionado($idproducto);
        $data['obtenerProductoSeleccionado'] = $obtenerProductoSeleccionado;
        $data ["contenido_principal"] = "productos_imagenes/eliminar_imagenes";
        $data ["titulo"] = "Eliminar Imagenes de Productos";
        $this->load->view("includes/template_catalogo", $data);
    }
    
    function eliminarImagen($idproducto_imagen, $idproducto) {
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_catalogo'] = $menu_activo;
        //obtener el producto seleccionado segun idproducto
        $obtenerProductoSeleccionado = $this->Productos_imagenes_modelo->obtenerProductoSeleccionado($idproducto);
        $data['obtenerProductoSeleccionado'] = $obtenerProductoSeleccionado;
        //obtener la imagen seleccionada segun idproducto_imagenes
        $obtenerImagenSeleccionada = $this->Productos_imagenes_modelo->obtenerImagenProductoSeleccionado($idproducto_imagen);
        $data['obtenerImagenSeleccionada'] = $obtenerImagenSeleccionada;
        $data['idProductoImagenActual'] = $idproducto_imagen;
        $data['idProductoActual'] = $idproducto;
        //cargando la vista y enviando datos
        $data ["contenido_principal"] = "productos_imagenes/presentar_imagen_eliminar";
        $data ["titulo"] = "Elimar Imagen de Producto";
        $this->load->view("includes/template_catalogo", $data);
    }
    
    function imagenEliminada($idproducto_imagen, $idproducto) {
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_catalogo'] = $menu_activo;
        $eliminarImagenProducto = $this->Productos_imagenes_modelo->eliminarImagenProducto($idproducto_imagen);
        if ($eliminarImagenProducto) {
            $data ["Mensaje_Imagen_Eliminada"] = 'Imagen Eliminada';
        } else {
            $data ["Mensaje_Imagen_Eliminada"] = '';
        }
        $this->eliminar_imagen($idproducto);
    }
    
}