<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Clientes extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('Clientes_modelo');
        $this->load->model('Pedidos_modelo');
        $this->load->model('Carrito_de_compras_modelo');
        $this->load->library('form_validation');
        //$this->load->library('email');
    }

    function index() {
        
    }

    function login() {
        $data['titulo'] = "Acceso a sistema";
        $data ["contenido_principal"] = "clientes/login";
        $this->load->view("includes/template", $data);
    }

    function registrarse() {
        //consultando todas las ciudades
        $listarCiudades = $this->Clientes_modelo->listarCiudades();
        $data['listarCiudades'] = $listarCiudades;
        $data['titulo'] = "Crear nueva cuenta";
        $data ["contenido_principal"] = "clientes/registro_clientes";
        $this->load->view("includes/template", $data);
    }
    
    function cargandoComboParroquia(){
        $id_ciudad = $_REQUEST["id"];
        $listarParroquiasPorId = $this->db->query('select idparroquias, nombre from parroquias where estado = 1 and ciudades_idciudades ='.$id_ciudad);
        foreach ($listarParroquiasPorId->result() as $row) {
            echo '<option value="' . $row->idparroquias . '">' . $row->nombre . '</option>';
        }
    }

    function crearCuenta() {
        $this->form_validation->set_rules('nombres', 'Nombres', 'trim|required');
        $this->form_validation->set_rules('apellidos', 'Apellidos', 'trim|required');
        //$this->form_validation->set_rules('fecha_nacimiento', 'Cumpleaños', 'trim|required');
//        $this->form_validation->set_rules('dia', 'Dia', 'callback__verificarDiaFechaNacimiento');
//        $this->form_validation->set_rules('mes', 'Mes', 'callback__verificarMesFechaNacimiento');
//        $this->form_validation->set_rules('anio', 'Año', 'callback__verificarAnioFechaNacimiento');
        $this->form_validation->set_rules('f_date1', 'Cumpleaños', 'trim|required');
        $this->form_validation->set_rules('email', 'e-mail', 'trim|required|valid_email|callback__verificarEmail');
        $this->form_validation->set_rules('direccion', 'Direccion', 'trim|required');
        $this->form_validation->set_rules('parroquia', 'Parroquia', 'callback__verificarCiudadParroquia');
        $this->form_validation->set_rules('ciudad', 'Ciudad', 'callback__verificarCiudadParroquia');
        $this->form_validation->set_rules('telefono_fijo', 'Telefono', 'trim|required');
        $this->form_validation->set_rules('telefono_movil', 'Celular', 'trim|required');
        $this->form_validation->set_rules('password', 'Contraseña', 'trim|required|md5');
        $this->form_validation->set_rules('re_password', 'Repetir Contraseña', 'trim|required|matches[password]|md5');
        $this->form_validation->set_message('required', 'El campo %s es requerido');
        $this->form_validation->set_message('valid_email', 'El campo %s no es valido');
        $this->form_validation->set_message('_verificarEmail', 'Ya existe un usuario con este e-mail');
        $this->form_validation->set_message('matches', 'Las contraseñas no coinciden');
        $this->form_validation->set_message('_verificarCiudadParroquia', 'Por favor seleccione tanto la parroquia como la ciudad');
        $this->form_validation->set_message('_verificarDiaFechaNacimiento', 'Por favor seleccione el dia de su nacimiento');
        $this->form_validation->set_message('_verificarMesFechaNacimiento', 'Por favor seleccione el mes de su nacimiento');
        $this->form_validation->set_message('_verificarAnioFechaNacimiento', 'Por favor seleccione el año de su nacimiento');
        if ($this->form_validation->run() == FALSE) {
            $this->registrarse();
        } else {
            $nombres = $this->input->post('nombres');
            $apellidos = $this->input->post('apellidos');
            //$fechaNacimiento = $this->input->post('fecha_nacimiento');
            $fechaNacimiento  = $this->input->post('anio').'-'.$this->input->post('mes').'-'.$this->input->post('dia');
            $direccion = $this->input->post('direccion');
            $email = $this->input->post('email');
            $telefonoFijo = $this->input->post('telefono_fijo');
            $telefonoMovil = $this->input->post('telefono_movil');
            $password = $this->input->post('password');
            $codigoActivacion = $this->_random_string(10);
            $estado = 0;
            $recibirPromociones = 1;
            $nombrePersonaRecibePedido = $nombres . ' ' . $apellidos;
            $parroquia = $this->input->post('parroquia');
            $ciudad = $this->input->post('ciudad');
            //email de confirmacion
            $this->load->library('email');
            $this->email->from('almacenesfranklin@gmail.com', 'Comercial Franklin');
            $this->email->to($email);
            $this->email->subject('Verificacion de Registro Comercial Franklin');
            $this->email->message('Por favor confirme su registro dando click en el siguiente enlace: ' .
                    anchor('http://comercialfranklin.com/clientes/confirmar_registro/' . $codigoActivacion, 'Confirmar Registro'));
            //$this->email->send();
            $data['mensaje_crear_cuenta'] = '';
            if (!$this->email->send()) {
                //echo 'no se pudo enviar el email de confirmacion, revise su conexion a internet y vuelva a intentarlo';
                $data['mensaje_crear_cuenta'] = 'No se pudo enviar el email de confirmacion, revise su conexion a internet y vuelva a intentarlo';
            } else {
                $insertar = $this->Clientes_modelo->insertarClientes(
                                $nombres, $apellidos, $fechaNacimiento, $direccion, $email, $telefonoFijo, $telefonoMovil, $password, $codigoActivacion, $estado, $recibirPromociones, $nombrePersonaRecibePedido, $parroquia, $ciudad
                );
                //presentando la vista confirmar registro despues de enviar el email

                $data['mensaje_crear_cuenta'] = 'Se ha enviado un e-mail para confirmar su registro, reviselo y active su cuenta!';
            }
            $data['titulo'] = "Registro de Clientes";
            $data ["contenido_principal"] = "clientes/login";
            $this->load->view("includes/template", $data);
        }
    }

    function confirmar_registro($codigo_activacion='') {
        if ($codigo_activacion == '') {
            die('Codigo de activacion errado');
        } else {
            $update = $this->Clientes_modelo->confirmarRegistro($codigo_activacion);
            if ($update) {
                $data['mensaje_confirmar_registro'] = 'Su cuenta fue activada satisfactoriamente!';
                $data['titulo'] = "Acceso al sistema";
                $data ["contenido_principal"] = "clientes/login";
                $this->load->view("includes/template", $data);
            } else {
                $data['mensaje_confirmar_registro'] = 'Su confirmacion de registro falló, inténtelo otra vez';
                $data['titulo'] = "Acceso al sistema";
                $data ["contenido_principal"] = "clientes/login";
                $this->load->view("includes/template", $data);
            }
        }
    }

    function _verificarEmail($email) {
        return $this->Clientes_modelo->verificarEmail($email);
    }

    function _verificarEmailRecuperarPassword($email) {
        return $this->Clientes_modelo->verificarEmailRecuperarPassword($email);
    }

    function _random_string($tamanio) {
        $base = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789';
        $max = strlen($base) - 1;
        $codigo_activacion = '';
        while (strlen($codigo_activacion) < $tamanio)
            $codigo_activacion .= $base{mt_rand(0, $max)};
        return $codigo_activacion;
    }

    function _verificarCiudadParroquia($id) {
        if ($id != 0) {
            return true;
        } else {
            return false;
        }
    }
    
    function _verificarDiaFechaNacimiento($id) {
        if ($id != 0) {
            return true;
        } else {
            return false;
        }
    }
    
    function _verificarMesFechaNacimiento($id) {
        if ($id != 0) {
            return true;
        } else {
            return false;
        }
    }
    
    function _verificarAnioFechaNacimiento($id) {
        if ($id != 0) {
            return true;
        } else {
            return false;
        }
    }

    function recuperar_password() {
        $data['titulo'] = "Recuperar Contraseña";
        $data ["contenido_principal"] = "clientes/recuperar_password";
        $this->load->view("includes/template", $data);
    }

    function recuperando_password() {
        $this->form_validation->set_rules('recuperar_email', 'E-mail', 'trim|required|valid_email|callback__verificarEmailRecuperarPassword');
        $this->form_validation->set_message('required', 'El campo %s es requerido');
        $this->form_validation->set_message('valid_email', 'El campo %s no es valido');
        $this->form_validation->set_message('_verificarEmailRecuperarPassword', 'Este e-mail no esta registrado en el sistema, intenteló otra vez');
        if ($this->form_validation->run() == FALSE) {
            $this->recuperar_password();
        } else {
            $email = $this->input->post('recuperar_email');
            $nuevoPassword = $this->_random_string(10);
            $nuevoPasswordConMd5 = md5($nuevoPassword);
            $updatePassword = $this->Clientes_modelo->actualizarPassword($email, $nuevoPasswordConMd5);
            $data['mensaje_recuperar_password'] = '';
            if ($updatePassword) {
                //email cambio de password
                $this->load->library('email');
                $this->email->from('almacenesfranklin@gmail.com', 'Comercial Franklin');
                $this->email->to($email);
                $this->email->subject('Cambio de contraseña');
                $this->email->message('Su email: ' . $email . ' su contraseña es: ' . $nuevoPassword);
                $this->email->send();
                $data['mensaje_recuperar_password'] = 'Se ha enviado un e-mail con su nueva contraseña, revise su buzon!';
                $data['titulo'] = "Acceso al sistema";
                $data ["contenido_principal"] = "clientes/login";
                $this->load->view("includes/template", $data);
            } else {
                $data['mensaje_recuperar_password'] = 'Falló la actualizacion de su contraseña, inténtelo otra vez';
                $data['titulo'] = "Acceso al sistema";
                $data ["contenido_principal"] = "clientes/login";
                $this->load->view("includes/template", $data);
            }
        }
    }

    function verificar_login() {
        $this->form_validation->set_rules('email_login', 'E-mail', 'trim|required|valid_email');
        $this->form_validation->set_rules('clave', 'Contraseña', 'trim|required|md5');
        $this->form_validation->set_message('required', 'El campo %s es requerido');
        $this->form_validation->set_message('valid_email', 'El campo %s no es valido');

        if ($this->form_validation->run() == FALSE) {
            $this->login();
        } else {
            $email = $this->input->post('email_login');
            $password = $this->input->post('clave');
            $comenzarPedido = $this->input->post('comenzar_pedido');
            $login = $this->Clientes_modelo->verificarLogin($email, $password);
            if ($login) {
                $data = array(
                    'is_logged_in' => TRUE,
                    'email_cliente' => $login[0]->email,
                    'nombre' => $login[0]->nombres,
                    'id_cliente' => $login[0]->idclientes
                );
                $this->session->set_userdata($data);
                //cuando entra el cliente le asigna el carrito que se encuentra sin sesion
                $ip_maquina_actual = getenv('REMOTE_ADDR');
                $id_cliente = $this->session->userdata('id_cliente');
                $asignarCarritoSinSesion = $this->Carrito_de_compras_modelo->asignarCarritoSinSesion($id_cliente, $ip_maquina_actual);
                if ($comenzarPedido != '') {
                    redirect('pedidos/pedido');
                } else {
                    redirect('index');
                }
            } else {
                $data['mensaje_confirmar_acceso'] = '';
                $data['mensaje_confirmar_acceso'] = 'La cuenta solicitada no existe o no ha sido activada';
                $data['titulo'] = "Acceso al sistema";
                $data ["contenido_principal"] = "clientes/login";
                $this->load->view("includes/template", $data);
            }
        }
    }

    function verificarCarrito($idCarrito) {
        //if($sw == ''){
        //redirect('clientes/cerrar_sesion');
        //}
        //if ($sw == 'siExisteCarrito') {
        //redirect('clientes/cerrar_sesion');
        //}
    }

    function cerrar_sesion($idCarrito) {
        $ip_maquina_actual = getenv('REMOTE_ADDR');
        $cerrarCarrito = $this->Carrito_de_compras_modelo->cerrarCarrito($idCarrito, $ip_maquina_actual);
        $this->session->sess_destroy();
        redirect('clientes/login');
    }

    function cambiar_password() {
        $is_logged_in = $this->session->userdata('is_logged_in');
        $id_cliente = $this->session->userdata('id_cliente');
        if ($is_logged_in != TRUE OR $id_cliente == '') {
            redirect('clientes/login');
        } else {
            $data['titulo'] = "Cambiar contraseña";
            $data ["contenido_principal"] = "clientes/cambiar_password";
            $this->load->view("includes/template", $data);
        }
    }

    function cambiando_password() {
        $is_logged_in = $this->session->userdata('is_logged_in');
        $id_cliente = $this->session->userdata('id_cliente');
        if ($is_logged_in != TRUE OR $id_cliente == '') {
            redirect('clientes/login');
        } else {
            $this->form_validation->set_rules('password_actual', 'Contraseña Actual', 'trim|required|md5');
            $this->form_validation->set_rules('password_nuevo', 'Nueva Contraseña', 'trim|required|md5');
            $this->form_validation->set_rules('re_password_nuevo', 'Repita Contraseña', 'trim|required|matches[password_nuevo]|md5');
            $this->form_validation->set_message('required', 'El campo %s es requerido');
            $this->form_validation->set_message('matches', 'Las contraseñas no coinciden');
            if ($this->form_validation->run() == FALSE) {
                $this->cambiar_password();
            } else {
                $emailCambiar = $this->session->userdata('email_cliente');
                $passwordActual = $this->input->post('password_actual');
                $passwordNuevo = $this->input->post('password_nuevo');
                $actualizarPassword = $this->Clientes_modelo->cambiarPassword($emailCambiar, $passwordActual, $passwordNuevo);
                $data['mensaje_cambiar_password'] = '';
                if ($actualizarPassword) {
                    $data['mensaje_cambiar_password'] = 'Su contraseña se actualizo exitosamente!';
                    $data['titulo'] = "Bienvenido a su perfil";
                    $data ["contenido_principal"] = "index/index";
                    $this->load->view("includes/template", $data);
                    /* echo "<script type=\"text/javascript\">alert(\"Su contraseña fue cambiada exitosomente!\");</script>";
                      redirect('index'); */
                } else {
                    $data['mensaje_cambiar_password'] = 'Su contraseña actual no coincidio con la almacena en el sistema, vuelva a intentarlo';
                    $data['titulo'] = "Cambiar contraseña";
                    $data ["contenido_principal"] = "clientes/cambiar_password";
                    $this->load->view("includes/template", $data);
                }
            }
        }
    }
    
    function cambiar_informacion() {
        //obteniendo datos actuales del cliente
        $id_cliente = $this->session->userdata('id_cliente');
        $datosActualesCliente = $this->Clientes_modelo->datosActualesCliente($id_cliente);
        $data['datosActualesCliente'] = $datosActualesCliente;
        //consultando todas las ciudades
        $listarCiudades = $this->Clientes_modelo->listarCiudades();
        $data['listarCiudades'] = $listarCiudades;
        //consultando todas las parroquias
        $listarParroquias = $this->Clientes_modelo->listarParroquias();
        $data['listarParroquias'] = $listarParroquias;
        $data['titulo'] = "Información de mi cuenta";
        $data ["contenido_principal"] = "clientes/cambiar_informacion";
        $this->load->view("includes/template", $data);
    }
    
    function cambiarDatosEnvio(){
        $this->form_validation->set_rules('nombres', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('apellidos', 'Apellido', 'trim|required');
        $this->form_validation->set_rules('direccion', 'Direccion Exacta', 'trim|required');
        $this->form_validation->set_rules('parroquia', 'Parroquia', 'callback__verificarCiudadParroquia');
        $this->form_validation->set_rules('ciudad', 'Ciudad', 'callback__verificarCiudadParroquia');
        $this->form_validation->set_rules('telefono', 'Telefono', 'trim|required');
        $this->form_validation->set_message('required', 'El campo %s es requerido');
        $this->form_validation->set_message('_verificarCiudadParroquia', 'Por favor seleccione tanto la parroquia como la ciudad');
        if ($this->form_validation->run() == FALSE) {
            $this->cambiar_informacion();
        } else {
            $id_cliente = $this->session->userdata('id_cliente');
            $nombreApellido = $this->input->post('nombres').' '.$this->input->post('apellidos');
            $direccion = $this->input->post('direccion');
            $ciudad = $this->input->post('ciudad');
            $parroquia = $this->input->post('parroquia');
            $telefono = $this->input->post('telefono');
            $actualizarDatosDeEnvio = $this->Clientes_modelo->actualizarDatosEnvioCliente($id_cliente, $nombreApellido, $direccion, $telefono, $ciudad, $parroquia);
            
            $data['mensaje_cambiar_datos_envio'] = '';
                if ($actualizarDatosDeEnvio) {
                    $data['mensaje_cambiar_datos_envio'] = 'Sus datos se actualizaron exitosamente!';
                    $data ["contenido_principal"] = "index/index";
                    $this->load->view("includes/template", $data);
                } else {
                    $data['mensaje_cambiar_datos_envio'] = 'Sus datos no se actualizaron, vuelva a intentarlo';
                    $data ["contenido_principal"] = "index/index";
                    $this->load->view("includes/template", $data);
                }
            
        }
    }

}

?>
