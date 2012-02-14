<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pedidos_modelo extends CI_Model{
    
    function obtenerPedidos() {
        $query = $this->db->query('SELECT p.idpedidos, c.nombres, c.apellidos, p.total, DATE_FORMAT(p.fecha,"%d/%m/%Y") AS fecha, p.estado
            FROM clientes c, pedidos p, carrito_de_compras car, cliente_carrito cc
            WHERE car.idcarrito_de_compras = p.carrito_de_compras_idcarrito_de_compras
            AND car.idcarrito_de_compras = cc.carrito_de_compras_idcarrito
            AND c.idclientes = cc.clientes_idclientes AND c.estado = 1 order by p.fecha desc');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    
    function obtenerTotalPedidos() {
        $query = $this->db->query('SELECT COUNT( * )  "total"
            FROM clientes c, pedidos p, carrito_de_compras car, cliente_carrito cc
            WHERE car.idcarrito_de_compras = p.carrito_de_compras_idcarrito_de_compras
            AND car.idcarrito_de_compras = cc.carrito_de_compras_idcarrito
            AND c.idclientes = cc.clientes_idclientes AND c.estado = 1');
        if ($query->num_rows() > 0) {
             $total = $query->row()->total;
             return $total;
        }
    }
    
    function buscarPedidosPorNombre($nombre) {
        $query = $this->db->query('SELECT p.idpedidos, c.nombres, c.apellidos, p.total, DATE_FORMAT(p.fecha,"%d/%m/%Y") AS fecha, p.estado
            FROM clientes c, pedidos p, carrito_de_compras car, cliente_carrito cc
            WHERE car.idcarrito_de_compras = p.carrito_de_compras_idcarrito_de_compras
            AND car.idcarrito_de_compras = cc.carrito_de_compras_idcarrito
            AND c.idclientes = cc.clientes_idclientes 
            AND c.apellidos like "%'.$nombre.'%" AND c.estado = 1 order by p.fecha desc');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    function obtenerTotalPedidosBuscarPorNombre($nombre) {
        $query = $this->db->query('SELECT COUNT( * )  "total"
            FROM clientes c, pedidos p, carrito_de_compras car, cliente_carrito cc
            WHERE car.idcarrito_de_compras = p.carrito_de_compras_idcarrito_de_compras
            AND car.idcarrito_de_compras = cc.carrito_de_compras_idcarrito
            AND c.idclientes = cc.clientes_idclientes
            AND c.apellidos like "%'.$nombre.'%" AND c.estado = 1');
        if ($query->num_rows() > 0) {
            $totalBusqueda = $query->row()->total;
             return $totalBusqueda;
        }
    }
    
    function obtenerPedidoSeleccionado($idpedido) {
        $query = $this->db->query('SELECT c.nombres, c.apellidos, c.direccion AS DireccionCliente, c.telefonoFijo, c.email, p.nombrePersonaRecibePedido, p.direccion AS DireccionEnvio, f.nombre
            FROM clientes c, pedidos p, carrito_de_compras car, cliente_carrito cc, formas_de_pagos f
            WHERE car.idcarrito_de_compras = p.carrito_de_compras_idcarrito_de_compras
            AND car.idcarrito_de_compras = cc.carrito_de_compras_idcarrito
            AND c.idclientes = cc.clientes_idclientes
            AND f.idformasdepagos = p.formas_de_pagos_idformasdepagos
            AND p.idpedidos = '.$idpedido);
        if ($query->num_rows() > 0) {
             return $query->result();
        }
    }
    
    function obtenerDetallePedidoSeleccionado($idpedido) {
        $query = $this->db->query('SELECT *
            FROM detalle_pedidos
            WHERE pedidos_idpedidos = '.$idpedido);
        if ($query->num_rows() > 0) {
             return $query->result();
        }
    }
    
    function obtenerTotalPedidoSeleccionado($idpedido) {
        $query = $this->db->query('SELECT total
            FROM pedidos
            WHERE idpedidos = '.$idpedido);
        if ($query->num_rows() > 0) {
             $total = $query->row()->total;
             return $total;
        }
    }
    
    function obtenerEstadoPedidoSeleccionado($idpedido) {
        $query = $this->db->query('SELECT estado
            FROM pedidos
            WHERE idpedidos = '.$idpedido);
        if ($query->num_rows() > 0) {
             $total = $query->row()->estado;
             return $total;
        }
    }
    
    function actualizarEstadoPedido($id_pedido_seleccionado, $estado){
        $data = array(
            'estado' => $estado,
        );
        $this->db->where('idpedidos', $id_pedido_seleccionado);
        return $this->db->update('pedidos', $data);
    }
    
    function eliminarPedido($idpedido) {
        $this->db->where('idpedidos', $idpedido);
        return $this->db->delete('pedidos');
    }
    
    //metodos para pedidos pendientes
    
    function obtenerPedidosPendientes() {
        $query = $this->db->query('SELECT p.idpedidos, c.nombres, c.apellidos, p.total, DATE_FORMAT(p.fecha,"%d/%m/%Y") AS fecha, p.estado
            FROM clientes c, pedidos p, carrito_de_compras car, cliente_carrito cc
            WHERE car.idcarrito_de_compras = p.carrito_de_compras_idcarrito_de_compras
            AND car.idcarrito_de_compras = cc.carrito_de_compras_idcarrito
            AND c.idclientes = cc.clientes_idclientes AND p.estado = 0 AND c.estado = 1 order by p.fecha desc');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    
    function obtenerTotalPedidosPendientes() {
        $query = $this->db->query('SELECT COUNT( * )  "total"
            FROM clientes c, pedidos p, carrito_de_compras car, cliente_carrito cc
            WHERE car.idcarrito_de_compras = p.carrito_de_compras_idcarrito_de_compras
            AND car.idcarrito_de_compras = cc.carrito_de_compras_idcarrito
            AND c.idclientes = cc.clientes_idclientes AND p.estado = 0 AND c.estado = 1');
        if ($query->num_rows() > 0) {
             $total = $query->row()->total;
             return $total;
        }
    }
    
    function buscarPedidosPendientesPorNombre($nombre) {
        $query = $this->db->query('SELECT p.idpedidos, c.nombres, c.apellidos, p.total, DATE_FORMAT(p.fecha,"%d/%m/%Y") AS fecha, p.estado
            FROM clientes c, pedidos p, carrito_de_compras car, cliente_carrito cc
            WHERE car.idcarrito_de_compras = p.carrito_de_compras_idcarrito_de_compras
            AND car.idcarrito_de_compras = cc.carrito_de_compras_idcarrito
            AND c.idclientes = cc.clientes_idclientes 
            AND c.apellidos like "%'.$nombre.'%" AND p.estado = 0 AND c.estado = 1 order by p.fecha desc');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    function obtenerTotalPedidosPendientesBuscarPorNombre($nombre) {
        $query = $this->db->query('SELECT COUNT( * )  "total"
            FROM clientes c, pedidos p, carrito_de_compras car, cliente_carrito cc
            WHERE car.idcarrito_de_compras = p.carrito_de_compras_idcarrito_de_compras
            AND car.idcarrito_de_compras = cc.carrito_de_compras_idcarrito
            AND c.idclientes = cc.clientes_idclientes
            AND c.apellidos like "%'.$nombre.'%" AND p.estado = 0 AND c.estado = 1');
        if ($query->num_rows() > 0) {
            $totalBusqueda = $query->row()->total;
             return $totalBusqueda;
        }
    }
    
    function obtenerCodigoProducto($id_pedido_seleccionado) {
        $query = $this->db->query('SELECT cantidad, productos_idproductos
            FROM detalle_pedidos
            WHERE pedidos_idpedidos = '.$id_pedido_seleccionado);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    function obtenerStock($idproducto) {
        $query = $this->db->query('SELECT stock
            FROM productos
            WHERE idproductos = '.$idproducto);
        if ($query->num_rows() > 0) {
            $totalBusqueda = $query->row()->stock;
             return $totalBusqueda;
        }
    }
    
    function actualizarStockProducto($idproducto, $stockTotal){
        $data = array(
            'stock' => $stockTotal,
        );
        $this->db->where('idproductos', $idproducto);
        return $this->db->update('productos', $data);
    }
}