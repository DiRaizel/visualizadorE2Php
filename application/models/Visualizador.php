<?php

defined('BASEPATH') OR exit('No direct script access allowed');
//
date_default_timezone_set('America/Bogota');

class Visualizador extends CI_Model {

    //
    function login() {
        //
        $correo = $this->input->post("correo");
        $password = $this->input->post("password");
        //
        $query = $this->db->query("select usu_id, usu_nombres, usu_apellidos, "
                . "usu_rol, usu_identificacion, usu_estado, usu_usuario from "
                . "usuario where usu_correo = '$correo' and usu_estado = 0 and "
                . "usu_password = '" . hash('MD5', $password) . "'");
        //
        $datos = array();
        //
        if (count($query->result()) > 0) {
            //
            foreach ($query->result() as $row) {
                //
                $datos = array(
                    'estado' => 'Entra',
                    'idUsu' => $row->usu_id,
                    'identificacion' => $row->usu_identificacion,
                    'nombres' => $row->usu_nombres,
                    'apellidos' => $row->usu_apellidos,
                    'rol' => $row->usu_rol,
                    'estadoUsu' => $row->usu_estado,
                    'usuario' => $row->usu_usuario
                );
            }
            //
            return $datos;
        } else {
            //
            return $datos['estado'] = 'Error';
        }
    }

    //
    function guardarLlamado() {
        //capturar Valores enviados por post
        $habitacion = $this->input->post("habitacion");
        $caba = $this->input->post("caba");
        $estado = $this->input->post("estado");
        $codAzul = $this->input->post("codAzul");
        //
        $datos = array(
            'llam_habitacion' => $habitacion,
            'llam_cama_bano' => $caba,
            'llam_estado' => $estado,
            'llam_cod_azul' => $codAzul,
            'llam_hora' => date('h:i:s'),
            'llam_fecha' => date('Y-m-d'),
        );
        //
        $query = $this->db->query("select llam_id from llamado where llam_"
                . "habitacion = '$habitacion' and llam_cama_bano = '$caba' and "
                . "llam_cod_azul = $codAzul");
        //
        if (count($query->result()) > 0) {
            //
            foreach ($query->result() as $row) {
                //
//                $queryU = $this->db->query("update llamado set llam_estado = "
//                        . "$estado where llam_id = $row->llam_id");
                //
                if ($estado == 0) {
                    //
                    $query2 = $this->db->query("delete from llamado where "
                            . "llam_id = $row->llam_id");
                    //
                    if ($query2) {
                        //
                        return 'eliminado';
                    } else {
                        //
                        return 'error2';
                    }
                } else {
                    //
                    return 'sin cambios';
                }
            }
        } else {
            //
            if ($this->db->insert('llamado', $datos)) {
                //
                return 'guardado';
            } else {
                //
                return 'error';
            }
        }
    }

    //
    function guardarLlamadoR() {
        //capturar Valores enviados por post
        $habitacion = $this->input->post("habitacion");
        $caba = $this->input->post("caba");
        $estado = $this->input->post("estado");
        //
        $datos = array(
            'llam_habitacion' => $habitacion,
            'llam_cama_bano' => $caba,
            'llam_estado' => $estado,
            'llam_hora' => date('h:i:s'),
            'llam_fecha' => date('Y-m-d')
        );
        //
        if ($this->db->insert('llamado_reporte', $datos)) {
            //
            return 'guardado';
        } else {
            //
            return 'error';
        }
    }

    //
    function cargarLlamados($valor) {
        //
        $order = 'asc';
        //
        if ($valor === 2) {
            //
            $order = 'desc';
        }
        //
        $query = $this->db->query("SELECT llam_habitacion, llam_cama_bano, "
                . "llam_hora FROM llamado order by llam_id $order");
        //
        $datos = array();
        //
        if (count($query->result()) > 0) {
            //
            foreach ($query->result() as $row) {
                //
                array_push($datos, array(
                    'modulo' => $row->llam_habitacion,
                    'tipo' => $row->llam_cama_bano,
                    'hora' => $row->llam_hora
                ));
            }
        }
        //
        return $datos;
    }

    //
    function cargarCodigoAzules() {
        //
        $query = $this->db->query("SELECT coaz_codigo, coaz_descripcion FROM codigo_azul");
        //
        $datos = array();
        //
        if (count($query->result()) > 0) {
            //
            foreach ($query->result() as $row) {
                //
                array_push($datos, array(
                    'codigo' => (int) $row->coaz_codigo,
                    'descripcion' => $row->coaz_descripcion
                ));
            }
        }
        //
        return $datos;
    }

}
