<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Carrito_de_compras_modelo extends CI_Model {

    function crearCarrito($id_cliente, $ip_maquina_actual) {
        $crearCarrito = array(
            'descripcion' => $ip_maquina_actual
        );
        //insertar en carrito de compras
        $this->db->insert('carrito_de_compras', $crearCarrito);
        //obtener el id del carrito del ultimo registro creado para mandar a asignar a cliente_carrito
        $query = $this->db->query('select idcarrito_de_compras
            from carrito_de_compras
            where descripcion="' . $ip_maquina_actual . '" and
            terminado = 0 and
            total =0.00
            order by total desc limit 1');
        if ($query->num_rows() > 0) {
            $idCarrito = $query->row()->idcarrito_de_compras;
            $asignarCarrito = array(
                'clientes_idclientes' => $id_cliente,
                'carrito_de_compras_idcarrito' => $idCarrito
            );
            $this->db->insert('cliente_carrito', $asignarCarrito);

            $data = array(
                'idCarrito' => $idCarrito
            );
            $this->session->set_userdata($data);
            return $idCarrito;
        } else {
            return false;
        }
    }

    function crearCarritoSinSesion($ip_maquina_actual) {
        $crearCarrito = array(
            'descripcion' => $ip_maquina_actual
        );
        //insertar en carrito de compras
        $this->db->insert('carrito_de_compras', $crearCarrito);
        //obtener el id del carrito del ultimo registro creado
        $query = $this->db->query('select idcarrito_de_compras
            from carrito_de_compras
            where descripcion="' . $ip_maquina_actual . '" and
            terminado = 0 and
            total =0.00
            order by idcarrito_de_compras desc limit 1');
        if ($query->num_rows() > 0) {
            $idCarritoSinSesion = $query->row()->idcarrito_de_compras;
            return $idCarritoSinSesion;
        }
    }

    function obtenerIdCarrito($idClienteActual) {
        $query = $this->db->query('SELECT DISTINCT c.idcarrito_de_compras
            FROM carrito_de_compras c, cliente_carrito cc, clientes cli
            WHERE c.terminado =0
            AND c.idcarrito_de_compras = cc.carrito_de_compras_idcarrito
            AND clientes_idclientes =' . $idClienteActual . '
            AND cli.idclientes = cc.clientes_idclientes');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    function obtenerIdCarritoSinSesion($ip_maquina_actual) {
        $query = $this->db->query('SELECT idcarrito_de_compras
            FROM carrito_de_compras
            WHERE terminado =0
            AND descripcion ="' . $ip_maquina_actual . '"');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    function agregarProducto($subtotal, $idproducto, $idcarrito) {
        $agregarProducto = array(
            'subtotal' => $subtotal,
            'productos_idproductos' => $idproducto,
            'carrito_de_compras_idcarrito_de_compras' => $idcarrito,
        );
        return $this->db->insert('detalle_carrito_de_compras', $agregarProducto);
    }

    function eliminarProducto($idproducto, $idcarrito) {
        $this->db->where('productos_idproductos', $idproducto);
        $this->db->where('carrito_de_compras_idcarrito_de_compras', $idcarrito);
        return $this->db->delete('detalle_carrito_de_compras');
    }

    function actualizarProducto($idproducto, $idcarrito, $cantidad, $precio) {
        $query = $this->db->query('SELECT cantidad, subtotal
            FROM detalle_carrito_de_compras WHERE productos_idproductos =' . $idproducto . ' and 
            carrito_de_compras_idcarrito_de_compras = ' . $idcarrito);
        if ($query->num_rows() > 0) {
            $subtotalCalculado = $precio * $cantidad;
            $subtotalActualizado = $subtotalCalculado;
            $data = array(
                'cantidad' => $cantidad,
                'subtotal' => $subtotalActualizado
            );
            $this->db->where('productos_idproductos', $idproducto);
            $this->db->where('carrito_de_compras_idcarrito_de_compras', $idcarrito);
            $this->db->update('detalle_carrito_de_compras', $data);
            return true;
        } else {
            return false;
        }
    }

    function mostrarCarrito($idcarrito) {
        $query = $this->db->query('SELECT p.idproductos, p.nombre, p.imagenMuestra, p.precio, p.precioPromocion, dc.cantidad, dc.subtotal
            FROM productos p, detalle_carrito_de_compras dc 
            WHERE dc.carrito_de_compras_idcarrito_de_compras=' . $idcarrito . ' and 
            p.idproductos=dc.productos_idproductos');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function totalCarrito($idcarrito, $ip_maquina_actual) {
        $query = $this->db->query('SELECT total
            FROM carrito_de_compras WHERE idcarrito_de_compras =' . $idcarrito . ' and 
            descripcion = "' . $ip_maquina_actual . '"');
        if ($query->num_rows() > 0) {
            return $query->row()->total;
        }
    }

    function verificarExistenciaProducto($idproductos, $idcarrito) {
        $query = $this->db->query('SELECT *
            FROM detalle_carrito_de_compras 
            WHERE productos_idproductos =' . $idproductos . ' and 
            carrito_de_compras_idcarrito_de_compras=' . $idcarrito);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function actualizarProductoSiExisteEnCarrito($precio, $idproducto, $idcarrito) {
        $query = $this->db->query('SELECT cantidad, subtotal
            FROM detalle_carrito_de_compras WHERE productos_idproductos =' . $idproducto . ' and 
            carrito_de_compras_idcarrito_de_compras = ' . $idcarrito);
        if ($query->num_rows() > 0) {
            $cantidad = $query->row()->cantidad;
            $cantidad += 1;
            $subtotal = $query->row()->subtotal;
            $subtotal = $subtotal + $precio;
            $data = array(
                'cantidad' => $cantidad,
                'subtotal' => $subtotal
            );
            $this->db->where('productos_idproductos', $idproducto);
            $this->db->where('carrito_de_compras_idcarrito_de_compras', $idcarrito);
            $this->db->update('detalle_carrito_de_compras', $data);
            return true;
        } else {
            return false;
        }
    }

    function actualizarTotalCarrito($idcarrito, $ip_maquina_actual) {
        $query = $this->db->query('SELECT sum(subtotal) as subtotal
            FROM detalle_carrito_de_compras WHERE carrito_de_compras_idcarrito_de_compras =' . $idcarrito);
        if ($query->num_rows() > 0) {
            $subtotal = $query->row()->subtotal;
            $data = array(
                'total' => $subtotal
            );
            $this->db->where('idcarrito_de_compras', $idcarrito);
            $this->db->where('descripcion', $ip_maquina_actual);
            $this->db->update('carrito_de_compras', $data);
            return true;
        } else {
            return false;
        }
    }

    function verificarProductosEnCarrito($idcarrito, $ip_maquina_actual) {
        $verProductos = $this->db->query('SELECT dc.iddetalle_carrito_de_compras
            FROM detalle_carrito_de_compras dc, carrito_de_compras c WHERE c.idcarrito_de_compras=' . $idcarrito . ' and c.descripcion ="' . $ip_maquina_actual . '" 
            and idcarrito_de_compras = carrito_de_compras_idcarrito_de_compras');
        if ($verProductos->num_rows() > 0) {
            return $verProductos->result();
        } else {
            return false;
        }
    }

    function cerrarCarrito($idcarrito, $ip_maquina_actual) {
        $data = array(
            'terminado' => 1
        );
        $this->db->where('idcarrito_de_compras', $idcarrito);
        $this->db->where('descripcion', $ip_maquina_actual);
        $this->db->update('carrito_de_compras', $data);
    }

    function asignarCarritoSinSesion($id_cliente, $ip_maquina_actual) {
        //obteniendo el id de carrito que no esta asignado en la tabla cliente_carrito
        $query = $this->db->query('SELECT idcarrito_de_compras
            FROM carrito_de_compras
            LEFT JOIN cliente_carrito ON carrito_de_compras.idcarrito_de_compras = cliente_carrito.carrito_de_compras_idcarrito
            WHERE carrito_de_compras_idcarrito IS NULL 
            AND terminado =0
            AND descripcion =  "' . $ip_maquina_actual . '"');
        if ($query->num_rows() > 0) {
            $idCarritoSinSesion = $query->row()->idcarrito_de_compras;
            $data = array(
                'idCarrito' => $idCarritoSinSesion
            );
            $this->session->set_userdata($data);
            //asignar carrito al cliente creando un registrp en la tabla cliente_carrito
            $asignarCarritoSinSesion = array(
                'clientes_idclientes' => $id_cliente,
                'carrito_de_compras_idcarrito' => $idCarritoSinSesion,
            );
            return $this->db->insert('cliente_carrito', $asignarCarritoSinSesion);
        }
    }

    function comprobarStockProducto($idProducto) {
        $query = $this->db->query('SELECT stock
            FROM productos WHERE idproductos =' . $idProducto);
        if ($query->num_rows() > 0) {
            $stock = $query->row()->stock;
            return $stock;
        }
    }

}
