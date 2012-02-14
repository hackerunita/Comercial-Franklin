<?php
$this->load->view("includes/header");
$this->load->view("includes/columnaIzquierdaReportes");
$this->load->view($contenido_principal);
$this->load->view("includes/columnaDerecha");
$this->load->view("includes/footer");
?>