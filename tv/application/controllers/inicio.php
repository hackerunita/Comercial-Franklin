<?php
class Inicio extends CI_Controller{
    
    function index(){
        $data ["contenido_principal"] = "Principal";
        $data ["titulo"] = "Comercial Franklin";
        $this->load->view("includes/template", $data);
    }
}
?>
