<?php
class Index extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->_is_logged_in();
    }

    function index() {
        $data ['titulo'] = 'Pagina de bienvenida';
        $data ["contenido_principal"] = "index/index";
        $this->load->view("includes/template", $data);
    }

    function _is_logged_in() {
        $is_logged_in = $this->session->userdata('is_logged_in');
        $id_cliente = $this->session->userdata('id_cliente');
        if ($is_logged_in != TRUE OR $id_cliente == '') {
            redirect('clientes/login');
        }
    }

}
?>