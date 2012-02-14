<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Administracion extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('Administracion_modelo');
        $this->load->library('form_validation');
    }
    
    function loguearse(){
        $esta_logueado = $this->session->userdata('esta_logueado');
        $idAdministrador = $this->session->userdata('idAdministrador');
        if ($esta_logueado == TRUE OR $idAdministrador != '') {
            //mandando el estilo del menu activo
            $menu_activo = 'active'; $data['menu_activo_inicio'] = $menu_activo;
            $data ["contenido_principal"] = "Principal";
            $data ["titulo"] = "Administración Sistema Tienda Virtual";
            $this->load->view("includes/template", $data);
        } else {
            $data ["titulo"] = "Acceso al Sistema";
            $this->load->view("administracion/login", $data);
        }
    }
    
    function ir_a_tienda(){
        redirect('http://comercialfranklin.com');
    }
    
    function verificar_login() {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('contrasena', 'Comtraseña', 'trim|required|md5');
        $this->form_validation->set_message('required', 'El campo %s es requerido');
        $this->form_validation->set_message('valid_email', 'El campo %s no es valido');
        if ($this->form_validation->run() == FALSE) {
            $this->loguearse();
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('contrasena');
            $verificarLogin = $this->Administracion_modelo->verificarLogin($email, $password);
            if ($verificarLogin) {
                $data = array(
                    'esta_logueado' => TRUE,
                    'idAdministrador' => $verificarLogin[0]->idadministradores,
                    'nombre' => $verificarLogin[0]->nombres,
                    'apellido' => $verificarLogin[0]->apellidos,
                    'email' => $verificarLogin[0]->email,
                );
                $this->session->set_userdata($data);
                //mandando el estilo del menu activo
                $menu_activo = 'active'; $data['menu_activo_inicio'] = $menu_activo;
                $data ["contenido_principal"] = "Principal";
                $data ["titulo"] = "Administración Sistema Tienda Virtual";
                $this->load->view("includes/template", $data);
            } else {
                $data ["Mensaje_Login"] = "La cuenta solicitada no existe o no ha sido activada";
                $data ["titulo"] = "Acceso al Sistema";
                $this->load->view("administracion/login", $data);
            }
        }
    }
    
    function cerrar_sesion() {
        $this->session->sess_destroy();
        $data ["titulo"] = "Acceso al Sistema";
        $this->load->view("administracion/login", $data);
    }
    
    function recuperar_password(){
        $data ["titulo"] = "Recuperar Contraseña";
        $this->load->view("administracion/recuperar_password", $data);
    }
    
    function recuperarPassword() {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback__verificarUsuario');
        $this->form_validation->set_message('required', 'El campo %s es requerido');
        $this->form_validation->set_message('valid_email', 'El campo %s no es valido');
        $this->form_validation->set_message('_verificarUsuario', 'Este e-mail no esta registrado en el sistema, intenteló otra vez');
        if ($this->form_validation->run() == FALSE) {
            $this->recuperar_password();
        } else {
            $email = $this->input->post('email');
            //generar el numero aleatorio para mandarlo en el email y luego actualizar en la tabla administracion
            $codigoVerificacion = $this->_random_string(10);
            //cargando libreria para enviar email e inicalizando parametros de envio
            $this->load->library('email');
            $this->email->from('almacenesfranklin@gmail.com', 'Comercial Franklin');
            $this->email->to($email);
            $this->email->subject('Creación de Nueva Contraseña');
            $this->email->message('Si usted solicitó cambiar su contraseña porque se le olvidó, presione click en el siguiente enlace: ' .
                    anchor('administracion/actualizar_password/' . $email . '/' . $codigoVerificacion, 'Crear Nueva Contraseña') . ' caso contrario pase por alto este mensaje');
            if (!$this->email->send()) {
                $data['Mensaje_Recuperar_Password'] = '';
            } else {
                $data['Mensaje_Recuperar_Password'] = 'Revise su correo electrónico para obtener el enlace de confirmación.';
                //actualizando el codigo de verificacion del usuario administrador
                $actualizarCodigo = $this->Administracion_modelo->actualizarCodigo($email, $codigoVerificacion);
            }
            $data ["titulo"] = "Acceso al Sistema";
            $this->load->view("administracion/login", $data);
        }
    }
    
    function _verificarUsuario($email) {
        return $this->Administracion_modelo->verificarUsuario($email);;
    }
    
    function _random_string($tamanio) {
        $base = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789';
        $max = strlen($base) - 1;
        $codigo_activacion = '';
        while (strlen($codigo_activacion) < $tamanio)
            $codigo_activacion .= $base{mt_rand(0, $max)};
        return $codigo_activacion;
    }
    
    function actualizar_password($email, $codigo) {
        $verificarDatos = $this->Administracion_modelo->verificarDatos($email, $codigo);
        if ($verificarDatos) {
            $data ["email_cambiar"] = $email;
            $data ["codigo"] = $codigo;
            $data ["titulo"] = "Cambiar su contraseña";
            $this->load->view("administracion/actualizar_password", $data);
        } else {
            $data['Mensaje_Actualizar_Password'] = 'Sus datos no están registrados en el sistema, intentelo nuevamente!';
            $data ["titulo"] = "Acceso al Sistema";
            $this->load->view("administracion/login", $data);
        }
    }
    
    function actualizarPassword() {
        $email = $this->input->post('email_actual');
        $codigo = $this->input->post('codigo_actual');
        $this->form_validation->set_rules('contrasena_actualizar', 'Contraseña', 'trim|required|md5');
        $this->form_validation->set_rules('contrasena_actualizar_repetir', 'Repetir Contraseña', 'trim|required|matches[contrasena_actualizar]|md5');
        $this->form_validation->set_message('required', 'El campo %s es requerido');
        $this->form_validation->set_message('matches', 'Las contraseñas no coinciden');
        if ($this->form_validation->run() == FALSE) {
            $this->actualizar_password($email, $codigo);
        } else {
            $email = $this->input->post('email_actual');
            $password = $this->input->post('contrasena_actualizar');
            //actualizar otra vez el codigo y los datos de usuario
            $codigoVerificacion = $this->_random_string(10);
            $actualizarPassword = $this->Administracion_modelo->actualizarPassword($email, $codigoVerificacion, $password);
            if($actualizarPassword){
                $data['Mensaje_Password_Actualizado'] = 'Su contraseña se actualizó exitosamente!';
            }else{
                $data['Mensaje_Password_Actualizado'] = '';
            }
            $data ["titulo"] = "Acceso al Sistema";
            $this->load->view("administracion/login", $data);
        }
    }
    
    //metodos para controlar los usuarios administradores
    
    function mantenimiento_administracion() {
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_administracion'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo'; $data['item_activo_administracion_usuarios'] = $item_activo;
        //obtener usuarios administradores existentes
        $obtenerUsuarios = $this->Administracion_modelo->obtenerAdministradores();
        $data['obtenerUsuarios'] = $obtenerUsuarios;
        //obtener total de registros en tabla administracion
        $obtenerTotalUsuarios = $this->Administracion_modelo->obtenerTotalAdministradores();
        $data['obtenerTotalUsuarios'] = $obtenerTotalUsuarios;
        //cargando la vista y enviando datos
        $data ["contenido_principal"] = "administracion/mantenimiento_administracion";
        $data ["titulo"] = "Administración de Usuarios Administradores";
        $this->load->view("includes/template_administradores", $data);
    }
    
    function buscar_usuario() {
        //mandando el estilo del menu activo
        $menu_activo = 'active';
        $data['menu_activo_administracion'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo';
        $data['item_activo_administracion_usuarios'] = $item_activo;
        //reglas de validacion
        $this->form_validation->set_rules('nombre_usuario_buscar', 'Apellido', 'trim|required');
        $this->form_validation->set_message('required', 'El campo %s es requerido');
        if ($this->form_validation->run() == FALSE) {
            $this->mantenimiento_administracion();
        } else {
            $apellido = $this->input->post('nombre_usuario_buscar');
            $buscarUsuarios = $this->Administracion_modelo->buscarUsuariosPorNombre($apellido);
            if ($buscarUsuarios) {
                $data['obtenerUsuariosPorNombre'] = $buscarUsuarios;
                //si existen resultados de la busqueda se cuentan cuantos registros hay
                $obtenerTotalUsuariosBusqueda = $this->Administracion_modelo->obtenerTotalUsuariosBuscarPorNombre($apellido);
                $data['obtenerTotalUsuariosBusqueda'] = $obtenerTotalUsuariosBusqueda;
            } else {
                $data['obtenerUsuariosPorNombre'] = '';
            }
            //cargando la vista y enviando datos del resultado de la busqueda
            $data['parametroUsuarioBusqueda'] = $apellido;
            $data ["contenido_principal"] = "administracion/mantenimiento_administracion";
            $data ["titulo"] = "Administración de Usuarios Administradores";
            $this->load->view("includes/template_administradores", $data);
        }
    }
    
    function crear_usuarios() {
        //mandando el estilo del menu activo
        $menu_activo = 'active';
        $data['menu_activo_administracion'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo';
        $data['item_activo_administracion_usuarios'] = $item_activo;
        //obtener usuarios administradores existentes
        $obtenerUsuarios = $this->Administracion_modelo->obtenerAdministradores();
        $data['obtenerUsuarios'] = $obtenerUsuarios;
        //obtener total de registros en tabla administracion
        $obtenerTotalUsuarios = $this->Administracion_modelo->obtenerTotalAdministradores();
        $data['obtenerTotalUsuarios'] = $obtenerTotalUsuarios;
        //cargando la vista y enviando datos
        $data ["contenido_principal"] = "administracion/crear_usuarios";
        $data ["titulo"] = "Creación de Usuarios Administradores";
        $this->load->view("includes/template_administradores", $data);
    }
    
    function crearUsuario() {
        //mandando el estilo del menu activo
        $menu_activo = 'active';
        $data['menu_activo_administracion'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo';
        $data['item_activo_administracion_usuarios'] = $item_activo;
        //reglas de validacion
        $this->form_validation->set_rules('nombre_usuario', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('apellido_usuario', 'Apellido', 'trim|required');
        $this->form_validation->set_rules('email_usuario', 'E-mail', 'trim|required|valid_email|callback__verificarEmail');
        $this->form_validation->set_message('required', 'El campo %s es requerido');
        $this->form_validation->set_message('valid_email', 'El campo %s no es valido');
        $this->form_validation->set_message('_verificarEmail', 'Ya existe un usuario con este e-mail');
        if ($this->form_validation->run() == FALSE) {
            $this->crear_usuarios();
        } else {
            $nombre = $this->input->post('nombre_usuario');
            $apellido = $this->input->post('apellido_usuario');
            $email = $this->input->post('email_usuario');
            $password = $this->_random_string(10);
            $passwordConMd5 = md5($password);
            $codigoVerificacion = $this->_random_string(10);
            //cargando libreria para enviar email e inicalizando parametros de envio
            $this->load->library('email');
            $this->email->from('almacenesfranklin@gmail.com', 'Comercial Franklin');
            $this->email->to($email);
            $this->email->subject('Creación de Nuevo Usuario');
            $this->email->message('Se ha creado un nuevo usuario con los siguientes datos, Usuario: ' . $email . ' y su contraseña: ' . $password);
            if (!$this->email->send()) {
                $data ["Mensaje_Usuario_Creado"] = '';
            } else {
                $crearUsuario = $this->Administracion_modelo->crearUsuario($nombre, $apellido, $email, $passwordConMd5, $codigoVerificacion);
                $data ["Mensaje_Usuario_Creado"] = 'Usuario Creado';
            }
            //obtener usuarios administradores existentes
            $obtenerUsuarios = $this->Administracion_modelo->obtenerAdministradores();
            $data['obtenerUsuarios'] = $obtenerUsuarios;
            //obtener total de registros en tabla administracion
            $obtenerTotalUsuarios = $this->Administracion_modelo->obtenerTotalAdministradores();
            $data['obtenerTotalUsuarios'] = $obtenerTotalUsuarios;
            //cargando la vista y enviando datos
            $data ["contenido_principal"] = "administracion/mantenimiento_administracion";
            $data ["titulo"] = "Administración de Usuarios Administradores";
            $this->load->view("includes/template_administradores", $data);
        }
    }
    
    function _verificarEmail($email) {
        return $this->Administracion_modelo->verificarEmail($email);
    }
    
    function actualizar_usuario($idusuario) {
        //mandando el estilo del menu activo
        $menu_activo = 'active';
        $data['menu_activo_administracion'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo';
        $data['item_activo_administracion_usuarios'] = $item_activo;
        //obtener el usuario seleccionado segun idadministrador
        $obtenerUsuarioSeleccionado = $this->Administracion_modelo->obtenerUsuarioSeleccionado($idusuario);
        $data['obtenerUsuarioSeleccionado'] = $obtenerUsuarioSeleccionado;
        $data ["contenido_principal"] = "administracion/actualizar_usuarios";
        $data ["titulo"] = "Actualización de Usuarios Administradores";
        $this->load->view("includes/template_administradores", $data);
    }
    
    function actualizarUsuario() {
        //mandando el estilo del menu activo
        $menu_activo = 'active';
        $data['menu_activo_administracion'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo';
        $data['item_activo_administracion_usuarios'] = $item_activo;
        $id_usuario_seleccionado = $this->input->post('id_usuario_seleccionado');
        //reglas de validacion
        $this->form_validation->set_rules('nombre_usuario', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('apellido_usuario', 'Apellido', 'trim|required');
        $this->form_validation->set_rules('email_usuario', 'E-mail', 'trim|required|valid_email');
        $this->form_validation->set_message('required', 'El campo %s es requerido');
        $this->form_validation->set_message('valid_email', 'El campo %s no es valido');
        if ($this->form_validation->run() == FALSE) {
            $this->actualizar_usuario($id_usuario_seleccionado);
        } else {
            $nombre = $this->input->post('nombre_usuario');
            $apellido = $this->input->post('apellido_usuario');
            $email = $this->input->post('email_usuario');
            $actualizarUsuario = $this->Administracion_modelo->actualizarUsuario($id_usuario_seleccionado, $nombre, $apellido, $email);
            if ($actualizarUsuario) {
                $data ["Mensaje_Usuario_Actualizado"] = 'Usuario Actualizado';
            } else {
                $data ["Mensaje_Usuario_Actualizado"] = '';
            }
            //obtener usuarios administradores existentes
            $obtenerUsuarios = $this->Administracion_modelo->obtenerAdministradores();
            $data['obtenerUsuarios'] = $obtenerUsuarios;
            //obtener total de registros en tabla administracion
            $obtenerTotalUsuarios = $this->Administracion_modelo->obtenerTotalAdministradores();
            $data['obtenerTotalUsuarios'] = $obtenerTotalUsuarios;
            //cargando la vista y enviando datos
            $data ["contenido_principal"] = "administracion/mantenimiento_administracion";
            $data ["titulo"] = "Administración de Usuarios Administradores";
            $this->load->view("includes/template_administradores", $data);
        }
    }
    
//    function eliminar_usuario($idusuario) {
//        //mandando el estilo del menu activo
//        $menu_activo = 'active';
//        $data['menu_activo_administracion'] = $menu_activo;
//        //mandando el estilo del item activo
//        $item_activo = 'enlace_activo';
//        $data['item_activo_administracion_usuarios'] = $item_activo;
//        //idpedido seleccionado
//        $data['idUsuarioActual'] = $idusuario;
//        //obtener el usuario seleccionado segun idadministrador
//        $obtenerUsuarioSeleccionado = $this->Administracion_modelo->obtenerUsuarioSeleccionado($idusuario);
//        $data['obtenerUsuarioSeleccionado'] = $obtenerUsuarioSeleccionado;
//        //cargando la vista y enviando datos
//        $data ["contenido_principal"] = "administracion/eliminar_usuarios";
//        $data ["titulo"] = "Eliminación de Usuarios Administradores";
//        $this->load->view("includes/template_administradores", $data);
//    }
    
    function eliminarUsuario($idusuario) {
        //mandando el estilo del menu activo
        $menu_activo = 'active';
        $data['menu_activo_administracion'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo';
        $data['item_activo_administracion_usuarios'] = $item_activo;
        $eliminarUsuario = $this->Administracion_modelo->eliminarUsuario($idusuario);
        if ($eliminarUsuario) {
            $data ["Mensaje_Usuario_Eliminado"] = 'Usuario eliminado';
        } else {
            $data ["Mensaje_Usuario_Eliminado"] = '';
        }
        //obtener usuarios administradores existentes
        $obtenerUsuarios = $this->Administracion_modelo->obtenerAdministradores();
        $data['obtenerUsuarios'] = $obtenerUsuarios;
        //obtener total de registros en tabla administracion
        $obtenerTotalUsuarios = $this->Administracion_modelo->obtenerTotalAdministradores();
        $data['obtenerTotalUsuarios'] = $obtenerTotalUsuarios;
        //cargando la vista y enviando datos
        $data ["contenido_principal"] = "administracion/mantenimiento_administracion";
        $data ["titulo"] = "Administración de Usuarios Administradores";
        $this->load->view("includes/template_administradores", $data);
    }
    
    //metodos para el mantenimiento del usuario actual con datos de su sesion
    
    function actualizar_mis_datos() {
        //mandando el estilo del menu activo
        $menu_activo = 'active';
        $data['menu_activo_inicio'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo';
        $data['item_activo_inicio_mis_datos'] = $item_activo;
        //obtener mis datos de usuario segun idadministrador
        $idusuario = $this->session->userdata('idAdministrador');
        $obtenerUsuarioSeleccionado = $this->Administracion_modelo->obtenerUsuarioSeleccionado($idusuario);
        $data['obtenerUsuarioSeleccionado'] = $obtenerUsuarioSeleccionado;
        //cargando datos y enviando a la vista
        $data ["contenido_principal"] = "administracion/actualizar_mis_datos";
        $data ["titulo"] = "Actualización de Mis Datos";
        $this->load->view("includes/template", $data);
    }
    
    function actualizarMisDatos() {
        //mandando el estilo del menu activo
        $menu_activo = 'active';
        $data['menu_activo_inicio'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo';
        $data['item_activo_inicio_mis_datos'] = $item_activo;
        //mi id de usuario administrador
        $idusuario = $this->session->userdata('idAdministrador');
        //reglas de validacion
        $this->form_validation->set_rules('nombre_usuario', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('apellido_usuario', 'Apellido', 'trim|required');
        $this->form_validation->set_rules('email_usuario', 'E-mail', 'trim|required|valid_email');
        $this->form_validation->set_message('required', 'El campo %s es requerido');
        $this->form_validation->set_message('valid_email', 'El campo %s no es valido');
        if ($this->form_validation->run() == FALSE) {
            $this->actualizar_mis_datos();
        } else {
            $nombre = $this->input->post('nombre_usuario');
            $apellido = $this->input->post('apellido_usuario');
            $email = $this->input->post('email_usuario');
            $actualizarMiUsuario = $this->Administracion_modelo->actualizarUsuario($idusuario, $nombre, $apellido, $email);
            if ($actualizarMiUsuario) {
                $data ["Mensaje_Mis_Datos_Actualizados"] = 'Datos Actualizados';
            } else {
                $data ["Mensaje_Mis_Datos_Actualizados"] = '';
            }
            //obtener mis datos de usuario segun idadministrador
            $idusuario = $this->session->userdata('idAdministrador');
            $obtenerUsuarioSeleccionado = $this->Administracion_modelo->obtenerUsuarioSeleccionado($idusuario);
            $data['obtenerUsuarioSeleccionado'] = $obtenerUsuarioSeleccionado;
            //cargando datos y enviando a la vista
            $data ["contenido_principal"] = "administracion/actualizar_mis_datos";
            $data ["titulo"] = "Actualización de Mis Datos";
            $this->load->view("includes/template", $data);
        }
    }
    
    function actualizar_mi_password() {
        //mandando el estilo del menu activo
        $menu_activo = 'active';
        $data['menu_activo_inicio'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo';
        $data['item_activo_inicio_mi_password'] = $item_activo;
        //obtener mis datos de usuario segun idadministrador
        $idusuario = $this->session->userdata('idAdministrador');
        $obtenerUsuarioSeleccionado = $this->Administracion_modelo->obtenerUsuarioSeleccionado($idusuario);
        $data['obtenerUsuarioSeleccionado'] = $obtenerUsuarioSeleccionado;
        //cargando datos y enviando a la vista
        $data ["contenido_principal"] = "administracion/actualizar_mi_password";
        $data ["titulo"] = "Actualización de Mi Contraseña";
        $this->load->view("includes/template", $data);
    }
    
    function actualizarMiPassword() {
        //mandando el estilo del menu activo
        $menu_activo = 'active';
        $data['menu_activo_inicio'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo';
        $data['item_activo_inicio_mis_datos'] = $item_activo;
        //mi id de usuario administrador
        $idusuario = $this->session->userdata('idAdministrador');
        //reglas de validacion
        $this->form_validation->set_rules('password', 'Contraseña', 'trim|required|md5');
        $this->form_validation->set_rules('repetir_password', 'Repetir Contraseña', 'trim|required|matches[password]|md5');
        $this->form_validation->set_message('required', 'El campo %s es requerido');
        $this->form_validation->set_message('matches', 'Las contraseñas no coinciden');
        if ($this->form_validation->run() == FALSE) {
            $this->actualizar_mi_password();
        } else {
            $password = $this->input->post('password');
            $actualizarMiPassword = $this->Administracion_modelo->actualizarPasswordUsuario($idusuario, $password);
            if ($actualizarMiPassword) {
                $data ["Mensaje_Password_Actualizados"] = 'Datos Actualizados';
            } else {
                $data ["Mensaje_Password_Actualizados"] = '';
            }
            //obtener mis datos de usuario segun idadministrador
            $idusuario = $this->session->userdata('idAdministrador');
            $obtenerUsuarioSeleccionado = $this->Administracion_modelo->obtenerUsuarioSeleccionado($idusuario);
            $data['obtenerUsuarioSeleccionado'] = $obtenerUsuarioSeleccionado;
            //cargando datos y enviando a la vista
            $data ["contenido_principal"] = "administracion/actualizar_mi_password";
            $data ["titulo"] = "Actualización de Mi Contraseña";
            $this->load->view("includes/template", $data);
        }
    }

}