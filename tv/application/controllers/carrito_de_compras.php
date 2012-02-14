<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Carrito_de_compras extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('Carrito_de_compras_modelo');
        $this->load->library('form_validation');
    }

    function index() {
        
    }

    function comprar() {
        $ip_maquina_actual = getenv('REMOTE_ADDR');
        $is_logged_in = $this->session->userdata('is_logged_in');
        $id_cliente = $this->session->userdata('id_cliente');
        //TODO ESTO CUANDO ESTA LOGUEADO
        if ($is_logged_in == TRUE OR $id_cliente != '') {
            //recogo datos por el post recibiendo datos ocultos como:cliente actual,ip,estado de carrito(terminado)
            $idproductos = $this->input->post('idproductos');
            $precio = $this->input->post('precio');
            //mando a consultar en tabla carrito_de_compras si existe un carrito con parametro en le where ip,estado de carrito(terminado)
            $idcarrito = $this->Carrito_de_compras_modelo->obtenerIdCarrito($id_cliente);
            if ($idcarrito) {
                //si existe el carrito mando a agregar un producto en detalle_carrito_de_compras
                $idcarrito = $idcarrito->idcarrito_de_compras;
                redirect('carrito_de_compras/agregarProducto/' . $precio . '/' . $idproductos . '/' . $idcarrito);
            } else {
                //si no existe mando a crear el carrito y asignar el carrito al cliente
                $crearCarrito = $this->Carrito_de_compras_modelo->crearCarrito($id_cliente, $ip_maquina_actual);
                $idCarritoDeCompras = $crearCarrito;
                redirect('carrito_de_compras/agregarProducto/' . $precio . '/' . $idproductos . '/' . $idCarritoDeCompras);
            }
        } else {
            // cuando no hay sesion
            //recogo datos por el post recibiendo datos ocultos como:cliente actual,ip,estado de carrito(terminado)
            $idproductos = $this->input->post('idproductos');
            $precio = $this->input->post('precio');
            //mando a consultar en tabla carrito_de_compras si existe un carrito con parametro en le where ip,estado de carrito(terminado)
            $idCarritoSinSesion = $this->Carrito_de_compras_modelo->obtenerIdCarritoSinSesion($ip_maquina_actual);
            if ($idCarritoSinSesion) {
                //si existe mando a garegar un producto en detalle_carrito_de_compras
                $idCarritoSinSesion = $idCarritoSinSesion->idcarrito_de_compras;
                redirect('carrito_de_compras/agregarProducto/' . $precio . '/' . $idproductos . '/' . $idCarritoSinSesion);
            } else {
                //si no existe mando a crear el carrito
                $crearCarritoSinSesion = $this->Carrito_de_compras_modelo->crearCarritoSinSesion($ip_maquina_actual);
                $idCarritoDeComprasSinSesion = $crearCarritoSinSesion;
                redirect('carrito_de_compras/agregarProducto/' . $precio . '/' . $idproductos . '/' . $idCarritoDeComprasSinSesion);
            }
        }
    }

    function agregarProducto($precio, $idproductos, $idcarrito) {
        $ip_maquina_actual = getenv('REMOTE_ADDR');
        //antes de agregar hay que preguntar si existe un producto en ese carrito con ese idproducto
        $verificarProducto = $this->Carrito_de_compras_modelo->verificarExistenciaProducto($idproductos, $idcarrito);
        if ($verificarProducto) {
            $aumentarCantidad = $this->Carrito_de_compras_modelo->actualizarProductoSiExisteEnCarrito($precio, $idproductos, $idcarrito);
            $actualizarTotalCarrito = $this->Carrito_de_compras_modelo->actualizarTotalCarrito($idcarrito, $ip_maquina_actual);
            if ($actualizarTotalCarrito) {
                redirect('carrito_de_compras/mostrarCarrito/' . $idcarrito);
            }
        } else {
            $agregarProducto = $this->Carrito_de_compras_modelo->agregarProducto($precio, $idproductos, $idcarrito);
            if ($agregarProducto) {
                $actualizarTotalCarrito = $this->Carrito_de_compras_modelo->actualizarTotalCarrito($idcarrito, $ip_maquina_actual);
                if ($actualizarTotalCarrito) {
                    redirect('carrito_de_compras/mostrarCarrito/' . $idcarrito);
                }
            }
        }
    }

    function actualizarProducto() {
        $ip_maquina_actual = getenv('REMOTE_ADDR');
        $idproducto = $this->input->post('idproducto');
        $idcarrito = $this->input->post('idCarrito');
        $cantidad = $this->input->post('cantidad');
        $precio = $this->input->post('precio');
        $this->form_validation->set_rules('cantidad', 'Cantidad', 'trim|required|is_natural');
        $this->form_validation->set_message('required', 'El campo %s es requerido');
        if ($this->form_validation->run() == FALSE) {
            redirect('carrito_de_compras/mostrarCarrito/' . $idcarrito);
        } else {
            if ($cantidad == 0) {
                redirect('carrito_de_compras/eliminarProducto/' . $idproducto . '/' . $idcarrito);
            } else {
                //extraer el stock del producto a actualizar
                $stockActual = $this->Carrito_de_compras_modelo->comprobarStockProducto($idproducto);
                if ($cantidad <= $stockActual) {
                    //si la cantidad recogida es menor o igual al stock se manda a actualizar
                    $actualizarProducto = $this->Carrito_de_compras_modelo->actualizarProducto($idproducto, $idcarrito, $cantidad, $precio);
                    if ($actualizarProducto) {
                        $actualizarTotalCarrito = $this->Carrito_de_compras_modelo->actualizarTotalCarrito($idcarrito, $ip_maquina_actual);
                        if ($actualizarTotalCarrito) {
                            redirect('carrito_de_compras/mostrarCarrito/' . $idcarrito);
                        }
                    }
                } else {
                    //// si la cantidad es mayor al del stock entonces mandar el mensaje
                    $idproductoFueraStock = $idproducto;
                    redirect('carrito_de_compras/mostrarCarritoConMensaje/' . $idcarrito . '/' . $idproductoFueraStock);
                }
            }
        }
    }

    function eliminarProducto($idproducto, $idCarrito) {
        $ip_maquina_actual = getenv('REMOTE_ADDR');
        $eliminarProducto = $this->Carrito_de_compras_modelo->eliminarProducto($idproducto, $idCarrito);
        if ($eliminarProducto) {
            $actualizarTotalCarrito = $this->Carrito_de_compras_modelo->actualizarTotalCarrito($idCarrito, $ip_maquina_actual);
            if ($actualizarTotalCarrito) {
                $verificarCarrito = $this->Carrito_de_compras_modelo->verificarProductosEnCarrito($idCarrito, $ip_maquina_actual);
                if ($verificarCarrito) {
                    redirect('carrito_de_compras/mostrarCarrito/' . $idCarrito);
                } else {
                    $idCarrito = 'vacio';
                    redirect('carrito_de_compras/verificarCarrito/' . $idCarrito);
                }
            }
        }
    }

    function verificarCarrito($idCarrito) {
        if ($idCarrito != 'vacio') {
            redirect('carrito_de_compras/mostrarCarrito/' . $idCarrito);
        } else {
            $data['titulo'] = "Carrito de Compras Vacio";
            $data ["contenido_principal"] = "carrito_de_compras/carrito_vacio";
            $this->load->view("includes/template", $data);
        }
    }

    function mostrarCarrito($idcarrito) {
        $ip_maquina_actual = getenv('REMOTE_ADDR');
        $mostrarCarrito = $this->Carrito_de_compras_modelo->mostrarCarrito($idcarrito);
        $totalCarrito = $this->Carrito_de_compras_modelo->totalCarrito($idcarrito, $ip_maquina_actual);
        if ($mostrarCarrito) {
            $data['idCarrito'] = $idcarrito;
            $data['mostrarCarrito'] = $mostrarCarrito;
            $data['totalCarrito'] = $totalCarrito;
            $data['titulo'] = "Carrito de Compras";
            $data ["contenido_principal"] = "carrito_de_compras/carrito";
            $this->load->view("includes/template", $data);
        }
    }

    function mostrarCarritoConMensaje($idcarrito, $idproductoFueraStock) {
        $ip_maquina_actual = getenv('REMOTE_ADDR');
        $mostrarCarrito = $this->Carrito_de_compras_modelo->mostrarCarrito($idcarrito);
        $totalCarrito = $this->Carrito_de_compras_modelo->totalCarrito($idcarrito, $ip_maquina_actual);
        if ($mostrarCarrito) {
            $data['idCarrito'] = $idcarrito;
            $data['idproductoFueraStock'] = $idproductoFueraStock;
            $data['mostrarCarrito'] = $mostrarCarrito;
            $data['totalCarrito'] = $totalCarrito;
            $data['titulo'] = "Carrito de Compras";
            $data ["contenido_principal"] = "carrito_de_compras/carrito";
            $this->load->view("includes/template", $data);
        }
    }
}

?>