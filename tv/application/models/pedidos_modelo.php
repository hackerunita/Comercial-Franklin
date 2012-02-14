<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pedidos_modelo extends CI_Model {

    function datosDeEnvio($idCliente) {
        $query = $this->db->query('SELECT *
            FROM clientes
            WHERE idclientes =' . $idCliente);
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    function nombreCiudad($idCiudad) {
        $query = $this->db->query('SELECT nombre
            FROM ciudades
            WHERE idciudades =' . $idCiudad);
        if ($query->num_rows() > 0) {
            return $query->row()->nombre;
        } else {
            return false;
        }
    }

    function nombreParroquia($idParroquia) {
        $query = $this->db->query('SELECT nombre
            FROM parroquias
            WHERE idparroquias =' . $idParroquia);
        if ($query->num_rows() > 0) {
            return $query->row()->nombre;
        } else {
            return false;
        }
    }

    function actualizarDatosPedido($idCliente, $nombrePersonaRecibePedido, $ciudad, $parroquia) {
        $data = array(
            'nombrePersonaRecibePedido' => $nombrePersonaRecibePedido,
            'ciudad' => $ciudad,
            'parroquia' => $parroquia,
        );
        $this->db->where('idclientes', $idCliente);
        return $this->db->update('clientes', $data);
    }

    function formasDePago() {
        $query = $this->db->query('SELECT *
            FROM formas_de_pagos order by nombre');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function crearPedido($nombrePersonaRecibe, $nombreParroquia, $direccion, $telefono, $email, $total, $idFormaPago, $idCiudad, $idCarrito) {
        $agregarPedido = array(
            'nombrePersonaRecibePedido' => $nombrePersonaRecibe,
            'parroquia' => $nombreParroquia,
            'direccion' => $direccion,
            'telefono' => $telefono,
            'email' => $email,
            'total' => $total,
            'formas_de_pagos_idformasdepagos' => $idFormaPago,
            'ciudades_idciudades' => $idCiudad,
            'carrito_de_compras_idcarrito_de_compras' => $idCarrito,
        );
//insertando en tabla pedido
        $this->db->insert('pedidos', $agregarPedido);
//obtener el idpedido del recien creado a traves del idcarrito
        $query = $this->db->query('select *
            from pedidos
            where carrito_de_compras_idcarrito_de_compras=' . $idCarrito);
        if ($query->num_rows() > 0) {
            $idPedido = $query->row()->idpedidos;
//obtener datos para insertar en el detalle_pedidos
            $detallePedido = $this->db->query('SELECT p.idproductos, p.nombre, p.imagenMuestra, p.precio, p.precioPromocion, dc.cantidad, dc.subtotal
            FROM productos p, detalle_carrito_de_compras dc 
            WHERE dc.carrito_de_compras_idcarrito_de_compras=' . $idCarrito . ' and 
            p.idproductos=dc.productos_idproductos');
            foreach ($detallePedido->result() as $fila) {
//datos para insertar registros en la tabla detalle_pedidos
                $det_cantidad = $fila->cantidad;
                $det_descripcion = $fila->nombre;
                if ($fila->precioPromocion != 0.00) {
                    $det_precioUnitario = $fila->precioPromocion;
                } else {
                    $det_precioUnitario = $fila->precio;
                }
                $det_subtotal = $fila->subtotal;
                $det_idproducto = $fila->idproductos;
                $det_idpedido = $idPedido;
//insertar registros en la tabla detalle_pedidos
                $agregarDetallePedido = array(
                    'cantidad' => $det_cantidad,
                    'descripcion' => $det_descripcion,
                    'precioUnitario' => $det_precioUnitario,
                    'precioTotal' => $det_subtotal,
                    'productos_idproductos' => $det_idproducto,
                    'pedidos_idpedidos' => $det_idpedido,
                );
                $this->db->insert('detalle_pedidos', $agregarDetallePedido);
            }
//cambiando el estado del carrito a 1 (cerrando carrito)
            $data = array(
                'terminado' => 1
            );
            $this->db->where('idcarrito_de_compras', $idCarrito);
            $this->db->update('carrito_de_compras', $data);
            return TRUE;
        }
    }

    function obtenerIdPedido($idCarrito) {
        $query = $this->db->query('select *
            from pedidos
            where carrito_de_compras_idcarrito_de_compras=' . $idCarrito);
        if ($query->num_rows() > 0) {
            //idpedido actual
            $idPedidoActual = $query->row()->idpedidos;
            //consultar detalle del pedido
            $detalle = $this->db->query('select dp.cantidad, dp.descripcion, dp.precioTotal
                from detalle_pedidos dp
                where 
                dp.pedidos_idpedidos = ' . $idPedidoActual);
            if ($detalle->num_rows() > 0) {
                return $detalle->result();
            }
        }
    }
    
    function obtenerDatosPedido($idCarrito) {
        $query = $this->db->query('select
            ped.nombrePersonaRecibePedido, ped.direccion, ped.telefono, ped.total, f.nombre
            from pedidos ped, formas_de_pagos f
            where
            carrito_de_compras_idcarrito_de_compras = '.$idCarrito.' and
            f.idformasdepagos = ped.formas_de_pagos_idformasdepagos');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    
    function obtenerDatosHistorialPedido($idCliente){
        $query = $this->db->query('SELECT p.idpedidos, p.nombrePersonaRecibePedido, p.fecha, p.total, p.estado
            FROM pedidos p, carrito_de_compras cc, cliente_carrito clicar, clientes cli
            WHERE cc.idcarrito_de_compras = p.carrito_de_compras_idcarrito_de_compras
            AND cc.idcarrito_de_compras = clicar.carrito_de_compras_idcarrito
            AND cli.idclientes = clicar.clientes_idclientes
            AND cli.idclientes ='.$idCliente);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    function obtenerDatosDetalleHistorialPedido($idPedido){
        $query = $this->db->query('SELECT *
            FROM pedidos
            WHERE idpedidos ='.$idPedido);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
        
    }
    
    function obtenerDetalleHistorialPedido($idPedido){
        $query = $this->db->query('SELECT *
            FROM detalle_pedidos
            WHERE pedidos_idpedidos ='.$idPedido);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
        
    }

}
