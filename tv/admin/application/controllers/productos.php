<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Productos extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->_si_esta_logueado();
        $this->load->model('Productos_modelo');
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
    
    function mantenimiento_productos(){
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_catalogo'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo'; $data['item_activo_inicio_productos'] = $item_activo;
        //obtener productos existentes
        $obtenerProductos = $this->Productos_modelo->obtenerProductos();
        $data['obtenerProductos'] = $obtenerProductos;
        //obtener total de registros en tabla productos
        $obtenerTotalProductos = $this->Productos_modelo->obtenerTotalProductos();
        $data['obtenerTotalProductos'] = $obtenerTotalProductos;
        //cargando la vista y enviando datos
        $data ["contenido_principal"] = "productos/mantenimiento_productos";
        $data ["titulo"] = "Administración de Productos";
        $this->load->view("includes/template_catalogo", $data);
    }
    
    function buscar_producto() {
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_catalogo'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo'; $data['item_activo_inicio_productos'] = $item_activo;
        $this->form_validation->set_rules('nombre_producto_buscar', 'Nombre', 'trim|required');
        $this->form_validation->set_message('required', 'El campo %s es requerido');
        if ($this->form_validation->run() == FALSE) {
            $this->mantenimiento_productos();
        } else {
            $nombre = $this->input->post('nombre_producto_buscar');
            $buscarProductos = $this->Productos_modelo->buscarProductosPorNombre($nombre);
            if ($buscarProductos) {
                $data['obtenerProductosPorNombre'] = $buscarProductos;
                //si existen resultados de la busqueda se cuentan cuantos registros hay
                $obtenerTotalProductosBusqueda = $this->Productos_modelo->obtenerTotalProductosBuscarPorNombre($nombre);
                $data['obtenerTotalProductosBusqueda'] = $obtenerTotalProductosBusqueda;
            } else {
                $data['obtenerProductosPorNombre'] = '';
            }
            //cargando la vista y enviando datos del resultado de la busqueda
            $data['parametroProductoBusqueda'] = $nombre;
            $data ["contenido_principal"] = "productos/mantenimiento_productos";
            $data ["titulo"] = "Administración de Productos";
            $this->load->view("includes/template_catalogo", $data);
        }
    }
    
    function crear_producto() {
        //mandando mensajes a la columna derecha
        $titulo_aviso = 'Importante!'; $aviso_contenido =  'Recuerde que: En el campo "características" por cada item debe existir un punto(.) de separación. No son necesarios los espacios en blanco. Ejemplo: Item1.Item2. Recuerde que: El campo "imagen" solo permite subir archivos de este tipo (gif, jpg, png), de un ancho de 1024px y largo 768px y con un tamaño máximo de 200Kb, además su nombre no debe contener caracteres especiales caso contrario la imagen no se subirá al sitio web.';
        $data['titulo_aviso'] = $titulo_aviso; $data['aviso_contenido'] = $aviso_contenido;
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_catalogo'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo'; $data['item_activo_inicio_productos'] = $item_activo;
        //cargando combo de fabricantes
        $obtenerFabricantes = $this->Productos_modelo->obtenerFabricantes();
        $data['obtenerFabricantesCombo'] = $obtenerFabricantes;
        //cargando combo de subcategorias
        $obtenerSubCategorias = $this->Productos_modelo->obtenerSubCategorias();
        $data['obtenerSubCategoriasCombo'] = $obtenerSubCategorias;
        //cargando la vista y enviando datos
        $data ["contenido_principal"] = "productos/crear_productos";
        $data ["titulo"] = "Creación de Productos";
        $this->load->view("includes/template_catalogo", $data);
    }
    
    function crearProducto() {
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_catalogo'] = $menu_activo;
        $this->form_validation->set_rules('nombre_producto', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('descripcion_producto', 'Descripción', 'trim|required');
        $this->form_validation->set_rules('caracteristicas_producto', 'Características', 'trim|required');
        $this->form_validation->set_rules('precio_producto_entero', 'Precio (Valor Entero)', 'trim|required|numeric|integer');
        $this->form_validation->set_rules('precio_producto_decimal', 'Precio (Valor Decimal)', 'trim|required|numeric|integer');
        $this->form_validation->set_rules('stock_producto', 'Stock', 'trim|required|numeric|integer');
        $this->form_validation->set_rules('cmb_subcategoria', 'SubCategoria', 'callback__verificarComboSubCategoria');
        $this->form_validation->set_rules('cmb_fabricante', 'Fabricante', 'callback__verificarComboFabricante');
        $this->form_validation->set_message('required', 'El campo %s es requerido');
        $this->form_validation->set_message('alpha', 'El campo %s debe tener solo letras');
        $this->form_validation->set_message('numeric', 'El campo %s debe tener solo caracteres numéricos');
        $this->form_validation->set_message('integer', 'El campo %s debe tener solo números enteros');
        $this->form_validation->set_message('_verificarComboSubCategoria', 'Por favor seleccione una SubCategoria');
        $this->form_validation->set_message('_verificarComboFabricante', 'Por favor seleccione un Fabricante');
        if ($this->form_validation->run() == FALSE) {
            $this->crear_producto();
        } else {
            $nombre = $this->input->post('nombre_producto');
            $descripcion = $this->input->post('descripcion_producto');
            $caracteristicas = $this->input->post('caracteristicas_producto');
            $precio = $this->input->post('precio_producto_entero') . '.' . $this->input->post('precio_producto_decimal');
            $stock = $this->input->post('stock_producto');
            $subcategoria = $this->input->post('cmb_subcategoria');
            $fabricante = $this->input->post('cmb_fabricante');
            //echo $nombre.','.$descripcion.','.$caracteristicas.','.$precio.','.$stock.','.$subcategoria.','.$fabricante.',';
            //subiendo la imagen de muestra del producto
            if (!$this->upload->do_upload()) {
                $data ["error_imagen"] = 'El campo imagen no cumple con los criterios establecidos';
                //cargando combo de fabricantes
                $obtenerFabricantes = $this->Productos_modelo->obtenerFabricantes();
                $data['obtenerFabricantesCombo'] = $obtenerFabricantes;
                //cargando combo de subcategorias
                $obtenerSubCategorias = $this->Productos_modelo->obtenerSubCategorias();
                $data['obtenerSubCategoriasCombo'] = $obtenerSubCategorias;
                //cargando la vista y enviando datos
                $data ["contenido_principal"] = "productos/crear_productos";
                $data ["titulo"] = "Creación de Productos";
                $this->load->view("includes/template_catalogo", $data);
            } else {
                //si entra entra por aqui es cuando ya subio la imagen a la carpeta seleccionada
                $datosImagen  = $this->upload->data();
                $nombre_imagen = 'admin/images_productos/'.$datosImagen['file_name'];
                //entonces hay que guadar los demas datos del producto.
                $crearProducto = $this->Productos_modelo->crearProducto($nombre, $descripcion, $caracteristicas, $precio, $stock, $nombre_imagen, $subcategoria, $fabricante);
                if ($crearProducto) {
                    $data ["Mensaje_Producto_Creado"] = 'Producto Creado';
                } else {
                    $data ["Mensaje_Producto_Creado"] = '';
                }
                //obtener productos existentes
                $obtenerProductos = $this->Productos_modelo->obtenerProductos();
                $data['obtenerProductos'] = $obtenerProductos;
                //obtener total de registros en tabla productos
                $obtenerTotalProductos = $this->Productos_modelo->obtenerTotalProductos();
                $data['obtenerTotalProductos'] = $obtenerTotalProductos;
                //cargando la vista y enviando datos
                $data ["contenido_principal"] = "productos/mantenimiento_productos";
                $data ["titulo"] = "Administración de Productos";
                $this->load->view("includes/template_catalogo", $data);
            }
        }
    }
    
    function _verificarComboSubCategoria($id) {
        if ($id != 0) {
            return true;
        } else {
            return false;
        }
    }
    
    function _verificarComboFabricante($id) {
        if ($id != 0) {
            return true;
        } else {
            return false;
        }
    }
    
    function actualizar_productos($idproducto) {
        //mandando mensajes a la columna derecha
        $titulo_aviso = 'Importante!'; $aviso_contenido =  'Recuerde que: En el campo "características" por cada item debe existir un punto(.) de separación. No son necesarios los espacios en blanco. Ejemplo: Item1.Item2. Recuerde que: El campo "imagen" solo permite subir archivos de este tipo (gif, jpg, png), de un ancho de 1024px y largo 768px y con un tamaño máximo de 200Kb, además su nombre no debe contener caracteres especiales caso contrario la imagen no se subirá al sitio web.';
        $data['titulo_aviso'] = $titulo_aviso; $data['aviso_contenido'] = $aviso_contenido;
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_catalogo'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo'; $data['item_activo_inicio_productos'] = $item_activo;
        //obtener el producto seleccionado segun idproducto
        $obtenerProductoSeleccionado = $this->Productos_modelo->obtenerProductoSeleccionado($idproducto);
        $data['obtenerProductoSeleccionado'] = $obtenerProductoSeleccionado;
        $data ["contenido_principal"] = "productos/actualizar_productos";
        $data ["titulo"] = "Actualización de Productos";
        $this->load->view("includes/template_catalogo", $data);
    }
    
    function actualizar_productos_nuevos_datos($idproducto, $error_imagen) {
        //mandando mensajes a la columna derecha
        $titulo_aviso = 'Importante!'; $aviso_contenido =  'Recuerde que: En el campo "características" por cada item debe existir un punto(.) de separación. No son necesarios los espacios en blanco. Ejemplo: Item1.Item2. Recuerde que: El campo "imagen" solo permite subir archivos de este tipo (gif, jpg, png), de un ancho de 1024px y largo 768px y con un tamaño máximo de 200Kb, además su nombre no debe contener caracteres especiales caso contrario la imagen no se subirá al sitio web.';
        $data['titulo_aviso'] = $titulo_aviso; $data['aviso_contenido'] = $aviso_contenido;
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_catalogo'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo'; $data['item_activo_inicio_productos'] = $item_activo;
        //enviando el idproducto
        $data ["idproducto"] = $idproducto;
        $data ["error_imagen"] = $error_imagen;
        $data ["contenido_principal"] = "productos/actualizar_productos_nuevos_datos";
        $data ["titulo"] = "Actualización de Productos";
        $this->load->view("includes/template_catalogo", $data);
    }

    function actualizarProducto() {
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_catalogo'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo'; $data['item_activo_inicio_productos'] = $item_activo;
        $id_producto_seleccionado = $this->input->post('id_producto_seleccionado');
        $this->form_validation->set_rules('nombre_producto', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('descripcion_producto', 'Descripción', 'trim|required');
        $this->form_validation->set_rules('caracteristicas_producto', 'Características', 'trim|required');
        $this->form_validation->set_rules('precio_producto_entero', 'Precio (Valor Entero)', 'trim|required|numeric|integer');
        $this->form_validation->set_rules('precio_producto_decimal', 'Precio (Valor Decimal)', 'trim|required|numeric|integer');
        $this->form_validation->set_rules('stock_producto', 'Stock', 'trim|required|numeric|integer');
        $this->form_validation->set_message('required', 'El campo %s es requerido');
        $this->form_validation->set_message('alpha', 'El campo %s debe tener solo letras');
        $this->form_validation->set_message('numeric', 'El campo %s debe tener solo caracteres numéricos');
        $this->form_validation->set_message('integer', 'El campo %s debe tener solo números enteros');
        if ($this->form_validation->run() == FALSE) {
            $error_imagen = '';
            $this->actualizar_productos_nuevos_datos($id_producto_seleccionado, $error_imagen);
        } else {
            $nombre = $this->input->post('nombre_producto');
            $descripcion = $this->input->post('descripcion_producto');
            $caracteristicas = $this->input->post('caracteristicas_producto');
            $precio = $this->input->post('precio_producto_entero') . '.' . $this->input->post('precio_producto_decimal');
            $stock = $this->input->post('stock_producto');
            //subiendo la imagen de muestra del producto
            if (!$this->upload->do_upload()) {
                $error_imagen = 'El campo imagen no cumple con los criterios establecidos';
                $this->actualizar_productos_nuevos_datos($id_producto_seleccionado, $error_imagen);
            } else {
                //si entra entra por aqui es cuando ya subio la imagen a la carpeta seleccionada
                $datosImagen = $this->upload->data();
                $nombre_imagen = 'admin/images_productos/' . $datosImagen['file_name'];
                //entonces hay que actualizar los demas datos del producto.
                $actualizarProducto = $this->Productos_modelo->actualizarProducto($id_producto_seleccionado, $nombre, $descripcion, $caracteristicas, $precio, $stock, $nombre_imagen);
                if ($actualizarProducto) {
                    $data ["Mensaje_Producto_Actualizado"] = 'Producto Actualizado';
                } else {
                    $data ["Mensaje_Producto_Actualizado"] = '';
                }
                //obtener productos existentes
                $obtenerProductos = $this->Productos_modelo->obtenerProductos();
                $data['obtenerProductos'] = $obtenerProductos;
                //obtener total de registros en tabla productos
                $obtenerTotalProductos = $this->Productos_modelo->obtenerTotalProductos();
                $data['obtenerTotalProductos'] = $obtenerTotalProductos;
                //cargando la vista y enviando datos
                $data ["contenido_principal"] = "productos/mantenimiento_productos";
                $data ["titulo"] = "Administración de Productos";
                $this->load->view("includes/template_catalogo", $data);
            }
        }
    }
    
    function actualizar_estado($idproducto, $estado) {
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_catalogo'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo'; $data['item_activo_inicio_productos'] = $item_activo;
        if ($estado == 0) {
            $actualizarEstado = $this->Productos_modelo->actualizarEstado($idproducto, 1);
            if ($actualizarEstado) {
                $data ["Mensaje_Producto_Estado"] = 'Estado Actualizado';
            } else {
                $data ["Mensaje_Producto_Estado"] = '';
            }
        }
        if ($estado == 1) {
            $actualizarEstado = $this->Productos_modelo->actualizarEstado($idproducto, 0);
            if ($actualizarEstado) {
                $data ["Mensaje_Producto_Estado"] = 'Estado Actualizado';
            } else {
                $data ["Mensaje_Producto_Estado"] = '';
            }
        }
        //obtener productos existentes
        $obtenerProductos = $this->Productos_modelo->obtenerProductos();
        $data['obtenerProductos'] = $obtenerProductos;
        //obtener total de registros en tabla productos
        $obtenerTotalProductos = $this->Productos_modelo->obtenerTotalProductos();
        $data['obtenerTotalProductos'] = $obtenerTotalProductos;
        //cargando la vista y enviando datos
        $data ["contenido_principal"] = "productos/mantenimiento_productos";
        $data ["titulo"] = "Administración de Productos";
        $this->load->view("includes/template_catalogo", $data);
    }
    
//    function eliminar_productos($idproductos){
//        //obtener el producto seleccionado segun idproducto
//        $obtenerProductoSeleccionado = $this->Productos_modelo->obtenerProductoSeleccionado($idproductos);
//        $data['obtenerProductoSeleccionado'] = $obtenerProductoSeleccionado;
//        //idproducto seleccionado
//        $data['idProductoSeleccionado'] = $idproductos;
//        $data ["contenido_principal"] = "productos/eliminar_productos";
//        $data ["titulo"] = "Eliminación de Productos";
//        $this->load->view("includes/template", $data);
//    }
//
//    function eliminarProducto($idproductos) {
//        $eliminarProducto = $this->Productos_modelo->eliminarProducto($idproductos);
//        if ($eliminarProducto) {
//            $data ["Mensaje_Producto_Eliminado"] = 'Producto Eliminado';
//        } else {
//            $data ["Mensaje_Producto_Eliminado"] = '';
//        }
//        //obtener productos existentes
//        $obtenerProductos = $this->Productos_modelo->obtenerProductos();
//        $data['obtenerProductos'] = $obtenerProductos;
//        //obtener total de registros en tabla productos
//        $obtenerTotalProductos = $this->Productos_modelo->obtenerTotalProductos();
//        $data['obtenerTotalProductos'] = $obtenerTotalProductos;
//        //cargando la vista y enviando datos
//        $data ["contenido_principal"] = "productos/mantenimiento_productos";
//        $data ["titulo"] = "Administración de Productos";
//        $this->load->view("includes/template", $data);
//    }
    
    
    //metodos para controlar el stock de productos (Menu Descuentos)
    
    function mantenimiento_stock() {
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_descuento'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo'; $data['item_activo_descuento_stock'] = $item_activo;
        //obtener productos existentes
        $obtenerProductosStock = $this->Productos_modelo->obtenerProductos();
        $data['obtenerProductosStock'] = $obtenerProductosStock;
        //obtener total de registros en tabla productos
        $obtenerTotalProductosStock = $this->Productos_modelo->obtenerTotalProductos();
        $data['obtenerTotalProductosStock'] = $obtenerTotalProductosStock;
        //cargando la vista y enviando datos
        $data ["contenido_principal"] = "productos/mantenimiento_stock";
        $data ["titulo"] = "Administración de Stock de Productos";
        $this->load->view("includes/template_descuento", $data);
    }
    
    function buscar_producto_stock() {
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_descuento'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo'; $data['item_activo_descuento_stock'] = $item_activo;
        //reglas de validacion
        $this->form_validation->set_rules('nombre_producto_buscar', 'Nombre', 'trim|required');
        $this->form_validation->set_message('required', 'El campo %s es requerido');
        if ($this->form_validation->run() == FALSE) {
            $this->mantenimiento_stock();
        } else {
            $nombre = $this->input->post('nombre_producto_buscar');
            $buscarProductosStock = $this->Productos_modelo->buscarProductosPorNombre($nombre);
            if ($buscarProductosStock) {
                $data['obtenerProductosStockPorNombre'] = $buscarProductosStock;
                //si existen resultados de la busqueda se cuentan cuantos registros hay
                $obtenerTotalProductosStockBusqueda = $this->Productos_modelo->obtenerTotalProductosBuscarPorNombre($nombre);
                $data['obtenerTotalProductosStockBusqueda'] = $obtenerTotalProductosStockBusqueda;
            } else {
                $data['obtenerProductosStockPorNombre'] = '';
            }
            //cargando la vista y enviando datos del resultado de la busqueda
            $data['parametroProductoStockBusqueda'] = $nombre;
            $data ["contenido_principal"] = "productos/mantenimiento_stock";
            $data ["titulo"] = "Administración de Stock de Productos";
            $this->load->view("includes/template_descuento", $data);
        }
    }
    
    function actualizar_producto_stock($idproducto) {
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_descuento'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo'; $data['item_activo_descuento_stock'] = $item_activo;
        //obtener el producto seleccionado segun idproducto
        $obtenerProductoSeleccionado = $this->Productos_modelo->obtenerProductoSeleccionado($idproducto);
        $data['obtenerProductoSeleccionado'] = $obtenerProductoSeleccionado;
        //idproducto actual
        $data['idProductoActual'] = $idproducto;
        $data ["contenido_principal"] = "productos/actualizar_stock";
        $data ["titulo"] = "Actualización de Productos";
        $this->load->view("includes/template_descuento", $data);
    }
    
    function actualizarProductoStock() {
        //mandando el estilo del menu activo
        $menu_activo = 'active';
        $data['menu_activo_descuento'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo';
        $data['item_activo_descuento_stock'] = $item_activo;
        $id_producto_seleccionado = $this->input->post('id_producto_seleccionado');
        //reglas de validacion
        $this->form_validation->set_rules('stock_producto', 'Stock', 'trim|required|numeric|integer');
        $this->form_validation->set_message('required', 'El campo %s es requerido');
        $this->form_validation->set_message('numeric', 'El campo %s debe tener solo caracteres numéricos');
        $this->form_validation->set_message('integer', 'El campo %s debe tener solo números enteros');
        if ($this->form_validation->run() == FALSE) {
            $this->actualizar_producto_stock($id_producto_seleccionado);
        } else {
            $stock = $this->input->post('stock_producto');
            $actualizarProductoStock = $this->Productos_modelo->actualizarProductoStock($id_producto_seleccionado, $stock);
            if ($actualizarProductoStock) {
                $data ["Mensaje_Stock_Actualizado"] = 'Stock Actualizado';
            } else {
                $data ["Mensaje_Stock_Actualizado"] = '';
            }
            //obtener productos existentes
            $obtenerProductosStock = $this->Productos_modelo->obtenerProductos();
            $data['obtenerProductosStock'] = $obtenerProductosStock;
            //obtener total de registros en tabla productos
            $obtenerTotalProductosStock = $this->Productos_modelo->obtenerTotalProductos();
            $data['obtenerTotalProductosStock'] = $obtenerTotalProductosStock;
            //cargando la vista y enviando datos
            $data ["contenido_principal"] = "productos/mantenimiento_stock";
            $data ["titulo"] = "Administración de Stock de Productos";
            $this->load->view("includes/template_descuento", $data);
        }
    }
}